<?php


namespace App\Models;


class Departamento extends BasicModel
{
    private $id_departamento;
    private $nombre;
    private $codigo_dane;
/**
 * Usuarios constructor.
 * @param $id_departamento
 * @param $nombre
 * @param $codigo_dane
 */
    public function __construct($Departamento = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_departamento = $Departamento['id_departamento'] ?? null;
        $this->nombre = $Departamento['nombre'] ?? null;
        $this->codigo_dane= $Departamento['codigo_dane'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getid_departamento() : int
    {
        return $this->id_departamento;
    }

    /**
     * @param int $id_departamento
     */
    public function setId(int $id_departamento): void
    {
        $this->id_departamento = $id_departamento;
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
     * @return mediumint
     */
    public function getcodigo_dane() : mediumint
    {
        return $this->codigo_dane;
    }

    /**
     * @param string $codigo_dane
     */
    public function setcodigo_dane(mediumint $codigo_dane): void
    {
        $this->codigo_dane = $codigo_dane;
    }
    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO Proyecto-De-Grado-Optica.Departamento VALUES (NULL, ?, ?, ?)", array(
                $this->nombre,
                $this->codigo_dane,
                            )
        );
        $this->Disconnect();
        return $result;
    }
    protected static function search($query): array
    {

        $arrDepartamento = array();
        $tmp = new Departamento();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Departamento = new Departamento();
            $Departamento->id_departamento = $valor['id_departamento'];
            $Departamento->nombre = $valor['nombre'];
            $Departamento->codigo_dane  = $valor['codigo_dane'];
            $Departamento->Disconnect();
            array_push($arrDepartamento, $Departamento);
        }
        $tmp->Disconnect();
        return $arrDepartamento;
    }

    protected static function getAll()

        {
            return Departamento::search("SELECT * FROM Proyecto-De-Grado-Optica.Departamento");
        }

        public static function DepartamentoRegistrado ($nombre) : bool
    {
        $result = Departamento::search("SELECT id_departamento FROM Proyecto-De-Grado-Optica.Departamento where nombre = ".$nombre);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }

    }

    protected static function searchForId($id):Departamento
    {
        $Departamento = null;
        if ($id > 0){
            $Departamento= new Departamento();
            $getrow = $Departamento->getRow("SELECT * FROM Proyecto-De-Grado-Optica.Departamento WHERE id_departamento =?", array($id));
            $Departamento->id_departamento = $getrow['id_departamento'];
            $Departamento->nombre = $getrow['nombre'];
            $Departamento->codigo_dane = $getrow['codigo_dane'];

        }
        $Departamento->Disconnect();
        return $Departamento;
    }


    protected function update()
    {
        $result = $this->updateRow("UPDATE Proyecto-De-Grado-Optica.Departamento SET nombre = ?, codigo_dane = ? WHERE id_departamento = ?", array(
                $this->nombre,
                $this->codigo_dane,
                $this->id_departamento
            )
        );
        $this->Disconnect();
        return $result;
    }

    protected function deleted($id)
    {
        // TODO: Implement deleted() method.
    }
}