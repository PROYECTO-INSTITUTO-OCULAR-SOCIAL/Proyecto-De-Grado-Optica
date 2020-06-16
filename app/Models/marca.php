<?php

namespace App\Models;

require('BasicModel.php');

class marca extends BasicModel
{
    private $id_marca;
    private $nombre;
    private $estado;


    /**
     * Usuarios constructor.
     * @param $id_marca
     * @param $nombre
     * @param $estado
     */
    public function __construct($marca = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_marca = $Marca['id_marca'] ?? null;
        $this->nombre = $Marca['nombre'] ?? null;
        $this->estado = $Marca['estado'] ?? null;
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
     * @return string
     */
    public function getnombre() : string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setnombre(string $nombre): void
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
        $result = $this->insertRow("INSERT INTO marca VALUES (NULL, ?, ?, ?)", array(
                $this->id_marca,
                $this->nombre,
                $this->estado
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE marca SET nombre = ? user = ?, password = ?, estado = ? WHERE id_marca = ?", array(
            $this->id_marca,
            $this->nombre,
                $this->estado

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
        $arrmarca = array();
        $tmp = new Marca();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $marca = new marca();
            $marca->id_marca = $valor['id_marca'];
            $marca->nombre = $valor['nombre'];
            $marca->estado = $valor['estado'];
            $marca->Disconnect();
            array_push($arrmarca, $marca);
        }
        $tmp->Disconnect();
        return $arrmarca;
    }

    public static function searchForId($id_marca) : marca
    {
        $marca = null;
        if ($id_marca > 0){
            $marca = new marca();
            $getrow = $marca->getRow("SELECT * FROM marca WHERE id_marca =?", array($id_marca));
            $marca->id_marca = $getrow['id_marca'];
            $marca->nombre = $getrow['nombre'];
            $marca->estado = $getrow['estado'];
        }
        $marca->Disconnect();
        return $marca;
    }

    public static function getAll() : array
    {
        return marca::search("SELECT * FROM marca");
    }

    public static function marca ($id_marca) : bool
    {
        $result = marca::search("SELECT id_marca FROM marca where id_marca = ".$id_marca);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}





