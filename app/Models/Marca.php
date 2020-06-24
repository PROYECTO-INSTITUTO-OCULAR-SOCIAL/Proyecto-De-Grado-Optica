<?php

namespace App\Models;

require('BasicModel.php');

class Marca extends BasicModel
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
    public function __construct($Marca = array())
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
        $result = $this->insertRow("INSERT INTO Marca VALUES (NULL, ?, ?, ?)", array(
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
        $result = $this->updateRow("UPDATE Marca SET nombre = ? user = ?, password = ?, estado = ? WHERE id_marca = ?", array(
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

    public static function searchForId($id_marca) : Marca
    {
        $Marca = null;
        if ($id_marca > 0){
            $Marca = new marca();
            $getrow = $Marca->getRow("SELECT * FROM Marca WHERE id_marca =?", array($id_marca));
            $Marca->id_marca = $getrow['id_marca'];
            $Marca->nombre = $getrow['nombre'];
            $Marca->estado = $getrow['estado'];
        }
        $Marca->Disconnect();
        return $Marca;
    }

    public static function getAll() : array
    {
        return Marca::search("SELECT * FROM Marca");
    }

    public static function Marca ($id_marca) : bool
    {
        $result = Marca::search("SELECT id_marca FROM Marca where id_marca = ".$id_marca);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}





