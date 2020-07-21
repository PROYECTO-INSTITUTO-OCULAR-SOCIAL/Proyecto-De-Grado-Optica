<?php


namespace App\Models;
require_once ('BasicModel.php');
require_once ('Departamento.php');

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
     * @param $departamento
     */
    public function __construct($Municipio = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_municipio = $Municipio['id_municipio'] ?? null;
        $this->nombre = $Municipio['nombre'] ?? null;
        $this->codigo_dane = $Municipio['codigo_dane'] ?? null;
        $this->departamento = $Municipio['departamento'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdMunicipio(): int
    {
        return $this->id_municipio;
    }

    /**
     * @param int $id_municipio
     */
    public function setIdMunicipio(int $id_municipio): void
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
    public function getCodigoDane(): int
    {
        return $this->codigo_dane;
    }

    /**
     * @param int $codigo_dane
     */
    public function setCodigoDane(int $codigo_dane): void
    {
        $this->codigo_dane = $codigo_dane;
    }

    public function getDepartamento(): Departamento
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento(Departamento $departamento): void
    {
        $this->departamento = $departamento;
    }


    public function create()
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Municipio VALUES (NULL, ?, ?, ?)", array(
                $this->nombre,
                $this->codigo_dane,
                $this->departamento->getid_departamento(),

            )
        );
        $this->setIdMunicipio(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Municipio SET nombre = ?, codigo_dane = ?, departamento = ? WHERE id_municipio = ?", array(
                $this->nombre,
                $this->codigo_dane,
                $this->departamento->getid_departamento(),
                $this->id_municipio,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public static function getAll()

    {
        return Municipio::search("SELECT * FROM mer_optica.Municipio");
    }

    public static function MunicipioRegistrado($nombre): bool
    {
        $result = Municipio::search("SELECT nombre FROM mer_optica.Municipio where nombre = '" . $nombre . "'");
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }

    }

    public static function search($query)
    {

        $arrMunicipio = array();
        $tmp = new Municipio();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Municipio = new Municipio();
            $Municipio->id_municipio = $valor['id_municipio'];
            $Municipio->nombre = $valor['nombre'];
            $Municipio->codigo_dane = $valor['codigo_dane'];
            $Municipio->departamento = Departamento::searchForId($valor['departamento']);
            $Municipio->Disconnect();
            array_push($arrMunicipio, $Municipio);
        }
        $tmp->Disconnect();
        return $arrMunicipio;
    }

    public static function searchForId($id)
    {
        $Municipio = null;
        if ($id > 0) {
            $Municipio = new Municipio();
            $getrow = $Municipio->getRow("SELECT * FROM mer_optica.Municipio WHERE id_municipio =?", array($id));
            $Municipio->id_municipio = $getrow['id_municipio'];
            $Municipio->nombre = $getrow['nombre'];
            $Municipio->codigo_dane = $getrow['codigo_dane'];
            $Municipio->departamento = Departamento::searchForId($getrow['departamento']);
        }
        $Municipio->Disconnect();
        return $Municipio;
    }

    public function deleted($id)
    {
        $Municipio = Municipio::searchForId($id); //Buscando un usuario por el ID
        $Municipio->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $Municipio->update();                    //Guarda los cambios..
    }
    public function nombresCompletos()
    {
        return $this->nombre . " ";
    }
}

