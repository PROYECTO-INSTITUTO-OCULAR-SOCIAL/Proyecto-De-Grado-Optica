<?php

namespace App\Models;
require_once('BasicModel.php');

class Marca extends BasicModel
{
    private  int $id_marca;
    private string $nombre;
    private string  $estado;


    /**
     * Usuarios constructor.
     * @param int $id_marca
     * @param  string $nombre
     * @param  string $estado
     */
    public function __construct($Marca = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_marca = $Marca['id_marca'] ?? 0;
        $this->nombre = $Marca['nombre'] ?? '';
        $this->estado = $Marca['estado'] ?? '';
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getid_marca() : int
    {
        return $this->id_marca;
    }

    /**
     * @param int $id_marca
     */
    public function setid_marca(int $id_marca): void
    {
        $this->id_marca = $id_marca;
    }

    /**
     * @return String
     */
    public function getnombre() : String
    {
        return $this->nombre;
    }

    /**
     * @param String $nombre
     */
    public function setnombre(String $nombre): void
    {
        $this->nombre = $nombre;
    }



    /**
     * @return string
     */
    public function getestado(): string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setestado(string $estado): void
    {
        $this->estado = $estado;
    }




    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Marca VALUES (NULL, ?, ?)", array(
                $this->nombre,
                $this->estado
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE mer_optica.Marca SET nombre = ? , estado = ? WHERE id_marca = ?", array(

            $this->nombre,
                $this->estado,
                $this->id_marca,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($id_marca) : void
    {
        // TODO: Implement deleted() method.
    }

    public static function search($query) : array
    {
        $arrMarca = array();
        $tmp = new Marca();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Marca = new marca();
            $Marca->id_marca = $valor['id_marca'];
            $Marca->nombre = $valor['nombre'];
            $Marca->estado = $valor['estado'];
            $Marca->Disconnect();
            array_push($arrMarca, $Marca);
        }
        $tmp->Disconnect();
        return $arrMarca;
    }

    public static function searchForid_marca($id_marca) : Marca
    {
        $Marca = null;
        if ($id_marca > 0){
            $Marca = new marca();
            $getrow = $Marca->getRow("SELECT * FROM mer_optica.Marca WHERE id_marca =?", array($id_marca));
            $Marca->id_marca = $getrow['id_marca'];
            $Marca->nombre = $getrow['nombre'];
            $Marca->estado = $getrow['estado'];
        }
        $Marca->Disconnect();
        return $Marca;
    }

    public static function getAll() : array
    {
        return Marca::search("SELECT * FROM mer_optica.Marca");
    }

    public static function MarcaRegistrada ($nombre) : bool
    {
        $result = Marca::search("SELECT nombre FROM mer_optica.Marca where nombre = '".$nombre."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    protected static function searchForId($id)
    {
        // TODO: Implement searchForId() method.
    }
}





