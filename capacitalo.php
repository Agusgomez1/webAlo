<?php
declare(strict_types=1);

const WORKSHOP_DESTINATION = 'info@alo-eventos.com.ar';
const WORKSHOP_FROM = 'no-reply@alo-eventos.com.ar';
const WORKSHOP_REDIRECT = 'capacitalo.html';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metodo no permitido.');
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$workshopName = normalize_text($_POST['workshop_name'] ?? '', 120);
$workshopDate = normalize_text($_POST['workshop_date'] ?? '', 80);
$name = normalize_text($_POST['name'] ?? '', 80);
$email = (string)filter_var((string)($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone = normalize_text($_POST['phone'] ?? '', 50);
$honeypot = trim((string)($_POST['empresa_web'] ?? ''));
$loadedAt = (int)($_POST['form_loaded_at'] ?? 0);

if (
    $honeypot !== '' ||
    !passes_timing_check($loadedAt) ||
    !passes_rate_limit($ip, 'workshop', 3, 3600) ||
    !valid_payload($workshopName, $workshopDate, $name, $email, $phone) ||
    looks_like_spam($workshopName . ' ' . $workshopDate . ' ' . $name . ' ' . $email . ' ' . $phone)
) {
    redirect_with_status('error');
}

$safeWorkshop = escape_html($workshopName);
$safeDate = escape_html($workshopDate);
$safeName = escape_html($name);
$safeEmail = escape_html($email);
$safePhone = escape_html($phone);
$subjectWorkshop = preg_replace('/[^a-zA-Z0-9\s\.\-áéíóúÁÉÍÓÚñÑ]/u', '', $workshopName) ?? '';
$subject = 'Inscripcion CapacitAlo - ' . trim($subjectWorkshop);

$message = "
<html>
<head>
  <title>Inscripcion al Workshop</title>
  <style>
    body { font-family: Arial, sans-serif; line-height: 1.6; color: #181516; }
    h2 { color: #181516; }
    p { color: #555; }
  </style>
</head>
<body>
  <h2>Datos de inscripcion</h2>
  <p><strong>Workshop:</strong> {$safeWorkshop}</p>
  <p><strong>Fecha:</strong> {$safeDate}</p>
  <p><strong>Nombre:</strong> {$safeName}</p>
  <p><strong>Email:</strong> {$safeEmail}</p>
  <p><strong>Telefono:</strong> {$safePhone}</p>
  <p><strong>IP:</strong> " . escape_html($ip) . "</p>
</body>
</html>";

if (mail(WORKSHOP_DESTINATION, $subject, $message, build_mail_headers($email))) {
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

function valid_payload(string $workshopName, string $workshopDate, string $name, string $email, string $phone): bool
{
    if ($workshopName === '' || $workshopDate === '' || $name === '' || $email === '' || $phone === '') {
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return !has_header_injection($workshopName)
        && !has_header_injection($workshopDate)
        && !has_header_injection($name)
        && !has_header_injection($email)
        && !has_header_injection($phone);
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
    $blockedTerms = ['factory direct', 'wholesale', 'flower wall', 'seo', 'backlink', 'casino', 'crypto', 'viagra'];

    foreach ($blockedTerms as $term) {
        if (strpos($lower, $term) !== false) {
            return true;
        }
    }

    preg_match_all('/https?:\/\/|www\.|\.com|\.cn|\.ru/i', $lower, $links);
    return count($links[0]) >= 2;
}

function build_mail_headers(string $replyTo): string
{
    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: Alo Eventos <' . WORKSHOP_FROM . '>';
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
    header('Location: ' . WORKSHOP_REDIRECT . '?status=' . rawurlencode($status));
    exit;
}
