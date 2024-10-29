class Instrumento
	{
	    private string $nombre;
	    private int $cantidad_cuerdas;
	    public function __construct(string $nombre, int $cantidad_cuerdas)
	    {
	        $this->nombre = $nombre;
	        $this->cantidad_cuerdas = $cantidad_cuerdas;
	    }
	}
