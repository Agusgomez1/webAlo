<?php
declare(strict_types=1);

const CONTACT_DESTINATION = 'info@alo-eventos.com.ar';
const CONTACT_FROM = 'no-reply@alo-eventos.com.ar';
const CONTACT_REDIRECT = 'contactanos.html';

$localConfig = __DIR__ . '/alo-config.php';
if (is_file($localConfig)) {
    require_once $localConfig;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metodo no permitido.');
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$nombre = normalize_text($_POST['nombre'] ?? '', 80);
$email = (string)filter_var((string)($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$telefono = normalize_text($_POST['telefono'] ?? '', 50);
$mensaje = normalize_text($_POST['mensaje'] ?? '', 3000);
$honeypot = trim((string)($_POST['empresa_web'] ?? ''));
$loadedAt = (int)($_POST['form_loaded_at'] ?? 0);
$recaptchaResponse = (string)($_POST['g-recaptcha-response'] ?? '');

if (
    $honeypot !== '' ||
    !passes_timing_check($loadedAt) ||
    !passes_rate_limit($ip, 'contact', 4, 3600) ||
    !valid_contact_payload($nombre, $email, $telefono, $mensaje) ||
    looks_like_spam($nombre . ' ' . $email . ' ' . $telefono . ' ' . $mensaje) ||
    !verify_recaptcha($recaptchaResponse, $ip)
) {
    redirect_with_status('error');
}

$safeNombre = escape_html($nombre);
$safeEmail = escape_html($email);
$safeTelefono = escape_html($telefono);
$safeMensaje = nl2br(escape_html($mensaje), false);
$subjectName = preg_replace('/[^a-zA-Z0-9\s\.\-áéíóúÁÉÍÓÚñÑ]/u', '', $nombre) ?? '';
$subject = 'Nueva consulta de Alo Eventos - ' . trim($subjectName);

$content = "
<html>
<head>
  <title>Nueva Consulta de Contacto</title>
  <style>
    body { font-family: Arial, sans-serif; line-height: 1.6; color: #181516; }
    h2 { color: #181516; }
    p { color: #555; }
    .info { margin-bottom: 20px; }
    .info strong { display: inline-block; min-width: 100px; color: #181516; }
  </style>
</head>
<body>
  <h2>Nueva Consulta de Contacto</h2>
  <div class='info'>
    <p><strong>Nombre:</strong> {$safeNombre}</p>
    <p><strong>Email:</strong> {$safeEmail}</p>
    <p><strong>Telefono:</strong> {$safeTelefono}</p>
    <p><strong>IP:</strong> " . escape_html($ip) . "</p>
  </div>
  <div>
    <h3>Mensaje:</h3>
    <p>{$safeMensaje}</p>
  </div>
</body>
</html>";

$headers = build_mail_headers($email);

if (mail(CONTACT_DESTINATION, $subject, $content, $headers)) {
    redirect_with_status('success');
}

redirect_with_status('error');

function normalize_text($value, int $maxLength): string
{
    $value = trim((string)$value);
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value) ?? '';
    $value = preg_replace('/[ \t]+/', ' ', $value) ?? '';

    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength, 'UTF-8');
    }

    return substr($value, 0, $maxLength);
}

function valid_contact_payload(string $nombre, string $email, string $telefono, string $mensaje): bool
{
    if ($nombre === '' || $email === '' || $telefono === '' || $mensaje === '') {
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if (has_header_injection($nombre) || has_header_injection($email) || has_header_injection($telefono)) {
        return false;
    }

    if (strlen($mensaje) < 12 || strlen($mensaje) > 3000) {
        return false;
    }

    return true;
}

function has_header_injection(string $value): bool
{
    return (bool)preg_match('/[\r\n]|%0a|%0d/i', $value);
}

function passes_timing_check(int $loadedAt): bool
{
    if ($loadedAt <= 0) {
        return false;
    }

    $elapsed = time() - $loadedAt;
    return $elapsed >= 3 && $elapsed <= 7200;
}

function passes_rate_limit(string $ip, string $scope, int $maxAttempts, int $windowSeconds): bool
{
    $key = hash('sha256', $scope . '|' . $ip);
    $file = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'alo_rate_' . $key . '.json';
    $now = time();
    $attempts = [];

    $handle = fopen($file, 'c+');
    if (!$handle) {
        return true;
    }

    flock($handle, LOCK_EX);
    $raw = stream_get_contents($handle);
    if ($raw) {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $attempts = $decoded;
        }
    }

    $attempts = array_values(array_filter($attempts, function ($timestamp) use ($now, $windowSeconds) {
        return is_int($timestamp) && ($now - $timestamp) < $windowSeconds;
    }));

    if (count($attempts) >= $maxAttempts) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }

    $attempts[] = $now;
    ftruncate($handle, 0);
    rewind($handle);
    fwrite($handle, json_encode($attempts));
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);

    return true;
}

function looks_like_spam(string $text): bool
{
    $lower = function_exists('mb_strtolower') ? mb_strtolower($text, 'UTF-8') : strtolower($text);
    $score = 0;

    $blockedTerms = [
        'factory direct',
        'wholesale',
        'flower wall',
        'artificial flowers',
        'roll up',
        'backdrop',
        'seo',
        'backlink',
        'casino',
        'crypto',
        'viagra',
        'tiktok:',
        'unsubscribe',
    ];

    foreach ($blockedTerms as $term) {
        if (strpos($lower, $term) !== false) {
            $score += 2;
        }
    }

    preg_match_all('/https?:\/\/|www\.|\.com|\.cn|\.ru/i', $lower, $links);
    $score += count($links[0]) >= 2 ? 3 : 0;

    preg_match_all('/[^\x00-\x7F]/', $text, $unicodeMatches);
    if (count($unicodeMatches[0]) > 25 && preg_match('/[\x{4E00}-\x{9FFF}]/u', $text)) {
        $score += 3;
    }

    return $score >= 3;
}

function verify_recaptcha(string $token, string $ip): bool
{
    if ($token === '') {
        return false;
    }

    $secret = getenv('ALO_RECAPTCHA_SECRET') ?: (defined('ALO_RECAPTCHA_SECRET') ? ALO_RECAPTCHA_SECRET : '');
    if ($secret === '') {
        return false;
    }

    $payload = http_build_query([
        'secret' => $secret,
        'response' => $token,
        'remoteip' => $ip,
    ]);

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $payload,
            'timeout' => 6,
        ],
    ]);

    $response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    if ($response === false) {
        return false;
    }

    $decoded = json_decode($response, true);
    return is_array($decoded) && !empty($decoded['success']);
}

function build_mail_headers(string $replyTo): string
{
    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: Alo Eventos <' . CONTACT_FROM . '>';
    $headers[] = 'Reply-To: ' . $replyTo;
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    return implode("\r\n", $headers);
}

function escape_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect_with_status(string $status): void
{
    header('Location: ' . CONTACT_REDIRECT . '?status=' . rawurlencode($status));
    exit;
}
