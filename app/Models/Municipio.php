<?php


namespace App\Models;

require('BasicModel.php');

class Municipio extends BasicModel
{

    private $id_municipio;
    private $nombre;
    private $codigo_dane;

    /* Relaciones */
    private $departamento;

    /**
     *  Usuarios constructor.
     * @param $id_municipio
     * @param $nombre
     * @param $codigo_dane
     */
    public function __construct($Municipio = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_municipio = $Municipio['id_municipio'] ?? null;
        $this->nombre = $Municipio['nombre'] ?? null;
        $this->codigo_dane = $Municipio['codigo_dane'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id_municipio;
    }

    /**
     * @param int $id_municipio
     */
    public function setId(int $id_municipio): void
    {
        $this->id_municipio = $id_municipio;
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
     * @return int
     */
    public function getCodigo_dane(): string
    {
        return $this->codigo_dane;
    }

    /**
     * @param string $codigo_dane
     */
    public function setCodigo_dane(string $codigo_dane): void
    {
        $this->codigo_dane = $codigo_dane;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->Departamento;
    }

    /**
     * @param mixed $Departamento
     */
    public function setDepartamento($Departamento): void
    {
        $this->Departamento= $Departamento;
    }


    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO weber.Municipio VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->nombre,
                $this->codigo_dane,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE weber.Municipio SET nombre = ?, codigo_dane = ?,  WHERE id_municipio = ?", array(
                $this->nombre,
                $this->codigo_dane,
                $this->id_municipio
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($id_municipio) : bool
    {
        $User = Municipio::searchForId($id_municipio); //Buscando un usuario por el ID
        $User->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $User->update();                    //Guarda los cambios..
    }

    public static function search($query) : array
    {
        $arrMunicipio = array();
        $tmp = new Municipio();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Municipio = new Municipio();
            $Municipio->id_municipio = $valor['id_municipio'];
            $Municipio->nombre = $valor['nombre'];
            $Municipio->codigo_dane = $valor['codigo_dane'];
            $Municipio->Disconnect();
            array_push($arrMunicipio, $Municipio);
        }
        $tmp->Disconnect();
        return $arrMunicipio;
    }

    public static function searchForId($id_municipio) : Municipio
    {
        $Municipio = null;
        if ($id_municipio > 0){
            $Municipio = new Municipio();
            $getrow = $Municipio->getRow("SELECT * FROM weber.Municipio WHERE id_municipio = ?", array($id_municipio));
            $Municipio->id_municipio = $getrow['id_municipio'];
            $Municipio->nombre = $getrow['nombre'];
            $Municipio->codigo_dane = $getrow['codigo_dane'];
        }
        $Municipio->Disconnect();
        return $Municipio;
    }

    public static function getAll() : array
    {
        return Municipio::search("SELECT * FROM weber.municipio");
    }

    public static function municipioRegistrado ($nombre) : bool
    {
        $result = Municipio::search("SELECT id FROM weber.municipio where nombre = ".$nombre);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}