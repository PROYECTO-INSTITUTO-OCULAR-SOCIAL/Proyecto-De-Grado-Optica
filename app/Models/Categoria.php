<?php


namespace App\Models;
require('BasicModel.php');

class Categoria extends BasicModel
{
    private $id_categoria;
    private $nombre;
    private $estado;


    /**
     * Formula constructor.
     * @param $id_categoria
     * @param $nombre
     * @param $estado
     */
    public function __construct($Categoria = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_categoria = $Categoria['id_categoria'] ?? null;
        $this->nombre = $Categoria['nombre'] ?? null;
        $this->estado = $Categoria['estado'] ?? null;

    }

    /* Metodo destructor cierra la conexion. */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdCategoria(): int
    {
        return $this->id_categoria;
    }

    /**
     * @param int $id_categoria
     */
    public function setIdCategoria(int $id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function create(): bool
    {
        $result = $this->insertRow("INSERT INTO proyecto-De-Grado-Optica.Categoria VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->nombre,
                $this->estado,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update(): bool
    {
        $result = $this->updateRow("UPDATE proyecto-De-Grado-Optica.Categoria SET  =nombre ?, estado = ? WHERE id_categoria = ?", array(
                $this->id_categoria,
                $this->nombre,
                $this->estado,

            )
        );
        $this->Disconnect();
        return $result;
    }

    protected static function search($query)
    {

        $arrCategoria = array();
        $tmp = new Categoria();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Categoria = new Categoria();
            $Categoria->id_categoria = $valor['id_categoria'];
            $Categoria->nombre = $valor['nombre'];
            $Categoria->estado = $valor['estado'];
            $Categoria->Disconnect();
            array_push($arrCategoria, $Categoria);
        }
        $tmp->Disconnect();
        return $arrCategoria;

    }

    protected static function getAll()
    {

        return Categoria::search("SELECT * FROM proyecto-De-Grado-Optica.Formula");
    }

    public static function CategoriaRegistrada($nombre): bool
    {
        $result = Categoria::search("SELECT id_categoria FROM proyecto-De-Grado-Optica.Categoria where nombre = " . $nombre);
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected static function searchForId($id_categoria)
    {
        $Categoria = null;
        if ($id_categoria > 0) {
            $Categoria = new Categoria();
            $getrow = $Categoria->getRow("SELECT * FROM proyecto-De-Grado-Optica.Categoria WHERE id_categoria =?", array($id_categoria));
            $Categoria->id_formula = $getrow['id_categoria'];
            $Categoria->od_esfera = $getrow['nombre '];
            $Categoria->oi_esfera = $getrow['estado'];
        }
        $Categoria->Disconnect();
        return $Categoria;
    }

    protected function deleted($id)
    {
        // TODO: Implement deleted() method.
    }
}