<?php


namespace App\Models;
require_once('BasicModel.php');
require_once ('Persona.php');


class Compra extends BasicModel
{
    private $id_compra;
    private $fecha;
    private $valor_total;
    private $Persona;
    /**
     * Usuarios constructor.
     * @param $id_compra
     * @param $fecha
     * @param $valor_total
     * * @param $Persona
     */
    public function __construct($Compra = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_compra = $Compra['id_compra'] ?? null;
        $this->fecha = $Compra['fecha'] ?? null;
        $this->valor_total= $Compra['valor_total'] ?? null;
        $this->Persona = $Persona['Persona'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getid_compra() : int
    {
        return $this->id_compra;
    }

    /**
     * @param int $id_compra
     */
    public function setid_compra(int $id_compra): void
    {
        $this->id_compra= $id_compra;
    }

    /**
     * @return mixed
     */
    public function getfecha()
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     */
    public function setfecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return float
     */
    public function getvalor_total() : float
    {
        return $this->valor_total;
    }

    /**
     * @param double $valor_total
     */
    public function setvalor_total($valor_total): void
    {
        $this->valor_total = $valor_total;
    }

    public function getPersona(): Persona
    {
        return $this->Persona;
    }

    /**
     * @param mixed $Persona
     */
    public function setPersona(Persona $Persona): void
    {
        $this->Persona = $Persona;
    }

    public function Create() : bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Compra VALUES (NULL, ?, ? ,?)", array(
                $this->fecha,
                $this->valor_total,
                $this->Persona->getid_persona(),

            )
        );
        $this->Disconnect();
        return $result;
    }
    public static function search($query): array
    {

        $arrCompra = array();
        $tmp = new Compra();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Compra = new Compra();
            $Compra->id_compra = $valor['id_compra'];
            $Compra->fecha = $valor['fecha'];
            $Compra->valor_total = $valor['valor_total'];
            $Compra->Persona= Persona::searchForId($valor['Persona']);
            $Compra->Disconnect();
            array_push($arrCompra, $Compra);
        }
        $tmp->Disconnect();
        return $arrCompra;
    }

    public static function getAll()

    {
        return Compra::search("SELECT * FROM mer_optica.Compra");
    }

    public static function CompraRegistrado ($fecha) : bool
    {
        $result = Compra::search("SELECT fecha FROM mer_optica.Compra where fecha ='".$fecha."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }

    }

    public static function searchForId($id):Compra
    {
        $Compra = null;
        if ($id > 0){
            $Compra= new Compra();
            $getrow = $Compra->getRow("SELECT * FROM mer_optica.Compra WHERE id_compra =?", array($id));
            $Compra->id_compra = $getrow['id_compra'];
            $Compra->fecha = $getrow['fecha'];
            $Compra->valor_total= $getrow['valor_total'];
            $Compra->Persona = Persona::searchForId($getrow['Persona']);

        }
        $Compra->Disconnect();
        return $Compra;
    }


    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Compra SET fecha= ?, valor_total = ?, Persona = ?  WHERE id_compra = ?", array(
                $this->fecha,
                $this->valor_total,
                $this->Persona->getid_persona(),
                $this->id_compra
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($id)
    {
        // TODO: Implement deleted() method.
    }
}