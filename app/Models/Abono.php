<?php


namespace app\Models;

require_once('BasicModel.php');


class Abono extends BasicModel
{
    private $id_abono;
    private $fecha;
    private $valor;


    /**
     * Ventas constructor.
     * @param $id_abono
     * @param $fecha
     * @param $valor
     */


    public function __construct($Abono = array())
    {
        parent::__construct();
        $this->id_abono = $Abono['id_abono'] ?? null;
        $this->fecha = $Abono['fecha'] ?? null;
        $this->valor = $Abono['monto'] ?? null;
    }

    /**
     *
     */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return mixed
     */
    public function getid_abono()
    {
        return $this->id_abono;
    }



    /**
     * @param mixed $id_abono
     */
    public function setid_abono($id_abono): void
    {
        $this->id = $id_abono;
    }



    /**
     * @return mixed
     */
    public function getfecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setfecha($fecha): void
    {
        $this->fecha = $fecha;
    }



    /**
     * @return mixed
     */
    public function getvalor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setvalor($valor): void
    {
        $this->valor = $valor;
    }


    /**
     * @param $query
     * @return mixed
     */
    public static function search($query)
    {

        $arrAbono = array();
        $tmp = new Abono();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Abono = new Abono();
            $Abono->id_abono = $valor['id_abono'];
            $Abono->fecha = $valor['fecha'];
            $Abono->valor = $valor['valor'];
            $Abono->Disconnect();
            array_push($arrAbono, $Abono);
        }
        $tmp->Disconnect();
        return $arrAbono;
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        return Abono::search("SELECT * FROM mer_optica.Abono");
    }

    /**
     * @param $id_abono
     * @return mixed
     */
    public static function searchForId($id_abono)
    {
        $Abono = null;
        if ($id_abono > 0) {
            $Abono= new Abono();
            $getrow = $Abono->getRow("SELECT * FROM mer_optica.Abono WHERE id_abonno =?", array($id_abono));
            $Abono->id_abono = $getrow['id_abono'];
            $Abono->fecha = $getrow['fecha'];
            $Abono->valor = $getrow['valor'];

        }
        $Abono->Disconnect();
        return $Abono;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Abono VALUES (NULL, ?, ?)", array(

                $this->fecha,
                $this->valor,
            )
        );
        $this->setid_abono(($result) ? $this->getLastid_abono() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Abono SET fecha = ?, valor = ? WHERE id_abono = ?", array(
                $this->fecha,
                $this->valor,
                $this->id_abono
            )
        );
        $this->Disconnect();
        return $result;
    }


    /**
     * @param $id_abono
     * @return mixed
     */
    public function deleted($id_abono)
    {
        $Abono = Abono::searchForid_abono($id_abono); //Buscando abono por el ID
        return $Abono->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "fecha: $this->fecha, valor: $this->valor";
    }

}