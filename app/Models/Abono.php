<?php

namespace app\Models;

require('BasicModel.php');

class Abono extends BasicModel
{
    private $id_abono;
    private $fecha;
    private $valor;


    /**
     * Usuarios constructor.
     * @param $id_abono
     * @param $fecha
     * @param $valor
     */
    public function __construct($Abono = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_abono = $Abono['id_abono'] ?? null;
        $this->fecha = $Abono['fecha'] ?? null;
        $this->valor = $Abono['valor'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getid_abono() : int
    {
        return $this->id_abono;
    }

    /**
     * @param int $id_abono
     */
    public function setid_abono(int $id_abono): void
    {
        $this->id_abono = $id_abono;
    }

    /**
     * @return datetime
     */
    public function getfecha() : datetime
    {
        return $this->fecha;
    }

    /**
     * @param datetime $fecha
     */
    public function setfecha(datetime $Abono): void
    {
        $this->fecha = $Abono;
    }



    /**
     * @return double
     */
    public function getvalor(): double
    {
        return $this->valor;
    }

    /**
     * @param double $valor
     */
    public function setvalor(double $valor): void
    {
        $this->valor = $valor;
    }




    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Abono VALUES (NULL, ?, ?)", array(
                $this->fecha,
                $this->valor
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE mer_optica.Abono SET fecha = ? , valor = ? WHERE id_abono = ?", array(

                $this->fecha,
                $this->valor,
                $this->id_abono,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($id_abono) : void
    {
        // TODO: Implement deleted() method.
    }



    protected static function searchForId($id)
    {
        // TODO: Implement searchForId() method.
    }
}
