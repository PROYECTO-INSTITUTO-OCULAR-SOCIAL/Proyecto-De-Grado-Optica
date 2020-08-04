<?php


namespace App\Models;
require_once (__DIR__ .'/../../vendor/autoload.php');
require_once('BasicModel.php');
require_once ('Persona.php');
use Carbon\Carbon;


class Compra extends BasicModel
{
    private int $id_compra;
    private carbon $fecha;
    private float $valor_total;
    private $Persona;
    /**
     * Usuarios constructor.
     * @param int $id_compra
     * @param carbon $fecha
     * @param float $valor_total
     * * @param $Persona
     */
    public function __construct($Compra = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_compra = $Compra['id_compra'] ?? 0;
        $this->fecha = $Compra['fecha'] ?? new carbon();
        $this->valor_total= $Compra['valor_total'] ?? 0.0;
        $this->Persona = $Compra['Persona'] ?? '';
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
    public function getfecha() : carbon
    {
        return $this->fecha-> locale('es');
    }

    /**
     * @param mixed $fecha_venta
     */
    public function setfecha(carbon $fecha): void
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
    public function setvalor_total(float $valor_total): void
    {
        $this->valor_total = $valor_total;
    }
    /**
     * @return Persona
     */
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

    public function Create()
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Compra VALUES (NULL, ?, ?, ?)", array(
                $this->fecha->toDateString(), //YYYY-MM-DD
                $this->valor_total,
                $this->Persona->getIdPersona(),

            )
        );
        $this->setid_compra(($result) ? $this->getLastId() : null);
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
            $Compra->fecha = Carbon::parse($valor['fecha']);
            $Compra->valor_total = $valor['valor_total'];
            $Compra->Persona= Persona::searchForId($valor['persona']);
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
            $Compra->fecha= Carbon::parse($getrow['fecha']);
            $Compra->valor_total= $getrow['valor_total'];
            $Compra->Persona = Persona::searchForId($getrow['persona']);

        }
        $Compra->Disconnect();
        return $Compra;
    }


    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Compra SET fecha= ?, valor_total = ?, Persona = ?  WHERE id_compra = ?", array(
                $this->fecha->toDateString(),
                $this->valor_total,
                $this->Persona->getIdPersona(),
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