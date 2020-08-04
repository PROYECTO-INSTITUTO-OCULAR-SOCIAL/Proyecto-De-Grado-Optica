<?php


namespace App\Models;
require_once('BasicModel.php');
class Categoria extends BasicModel
{
    private  int $id_categoria;
    private  string $nombre;
    private  string $estado;


    /**
     * Formula constructor.
     * @param int  $id_categoria
     * @param  string $nombre
     * @param  string $estado
     */
    public function __construct($Categoria = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_categoria = $Categoria['id_categoria'] ?? 0;
        $this->nombre = $Categoria['nombre'] ?? '';
        $this->estado = $Categoria['estado'] ?? '';

    }

    /* Metodo destructor cierra la conexion. */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdCategoria(): ? int
    {
        return $this->id_categoria;
    }

    /**
     * @param int $id_categoria
     */
    public function setIdCategoria(?int $id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }

    /**
     * @return String
     */
    public function getNombre(): String
    {
        return $this->nombre;
    }

    /**
     * @param String $nombre
     */
    public function setNombre(String $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return String
     */
    public function getEstado(): String
    {
        return $this->estado;
    }

    /**
     * @param String $estado
     */
    public function setEstado(String $estado): void
    {
        $this->estado = $estado;
    }






    public function create(): bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Categoria VALUES (NULL, ?, ?)", array(
                $this->nombre,
                $this->estado,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update(): bool
    {
        $result = $this->updateRow("UPDATE mer_optica.Categoria SET  nombre = ?, estado = ? WHERE id_categoria = ?", array(

                $this->nombre,
                $this->estado,
                $this->id_categoria,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public static function search($query)
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

    public static function getAll() : array
    {
        return Categoria::search("SELECT * FROM mer_optica.Categoria");
    }

    public static function CategoriaRegistrado ($nombre) : bool
    {
        $result = Categoria::search("SELECT nombre FROM mer_optica.Categoria where nombre = '".$nombre."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function searchForId($id_categoria) : Categoria
    {
        $Categoria = null;
        if ($id_categoria > 0) {
            $Categoria = new Categoria();
            $getrow = $Categoria->getRow("SELECT * FROM mer_optica.Categoria WHERE id_categoria =?", array($id_categoria));
            $Categoria->id_categoria = $getrow['id_categoria'];
            $Categoria->nombre = $getrow['nombre'];
            $Categoria->estado = $getrow['estado'];
        }
        $Categoria->Disconnect();
        return $Categoria;
    }

    public function deleted($id)
    {
        // TODO: Implement deleted() method.
    }
}
