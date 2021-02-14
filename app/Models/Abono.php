<?php


namespace App\Models;
require_once ('BasicModel.php');


class Abono extends BasicModel
{
    private $id_abono;
    private $fecha;
    private $valor;


    /**
     * Ventas constructor.
     * @param int $id_abono
     * @param Carbon $fecha
     * @param Double $valor
     */


    public function __construct($Abono = array())
    {
        parent::__construct();
        $this->id_abono = $Abono['id_abono'] ?? 0;
        $this->fecha = $Abono['fecha'] ?? new Carbon();
        $this->valor = $Abono['valor'] ?? new Double;
    }

    /**
     *
     */
    function __destruct()
    {
        $this->Disconnect();
    }


    /**
     * @return int|mixed
     * @return int|mixed
     */
    public function getid_abono(): int
    {
        return $this->id_abono;
    }

    /**
     * @param int|mixed $id_abono
     */
    public function setid_abono(int $id_abono): void
    {
        $this->id_abono = $id_abono;
    }


    /**
     * @return Carbon|mixed
     */
    public function getfecha(): Carbon
    {
        return $this->fecha->locale('es');
    }

    /**
     * @param Carbon|mixed $fecha
     */
    public function setfecha(Carbon $fecha): void
    {
        $this->fecha = $fecha;
    }


    /**
     * @return Double|mixed
     */
    public function getvalor(): float
    {
        return $this->valor;
    }

    /**
     * @param Double|mixed $valor
     */
    public function setvalor(float $valor): void
    {
        $this->valor = $valor;
    }


    public function create(): bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Abono VALUES (NULL, ?, ?)", array(
                $this->fecha->toDateTimeString(), //YYYY-MM-DD HH:MM:SS
                $this->valor
            )
        );
        $this->setid_abono(($result) ? $this->getLastid_abono() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return mixed
     */
    public function update(): bool
    {
        $result = $this->updateRow("UPDATE mer_optica.Abono SET  fecha = ?, valor = ? WHERE id_abono = ?", array(
                $this->fecha->toDateTimeString(),
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
    public function deleted($id_abono): bool
    {
        $Abono = Abono::searchForid_abono($id_abono); //Buscando un usuario por el ID
        return $Abono->update();                    //Guarda los cambios..
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function search($query): array
    {
        $arrAbono = array();
        $tmp = new Abono();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Abono = new Abono();
            $Abono->id = $valor['id_abono'];
            $Abono->fecha = Carbon::parse($valor['fecha']);
            $Abono->valor = $valor['valor'];
            $Abono->Disconnect();
            array_push($arrAbono, $Abono);
        }

        $tmp->Disconnect();
        return $arrAbono;
    }

    /**
     * @param $id_abono
     * @return mixed
     */
    public static function searchForid_abono($id_abono): Abono
    {
        $Abono = null;
        if ($id_abono > 0) {
            $Abono = new Abono();
            $getrow = $Abono->getRow("SELECT * FROM mer_optica.Abono WHERE id_abono =?", array($id_abono));
            $Abono->id_abono = $getrow['id_abono'];
            $Abono->fecha = Carbon::parse($getrow['fecha']);
            $Abono->valor = $getrow['valor'];
        }
        $Abono->Disconnect();
        return $Abono;
    }

    /**
     * @return mixed
     */
    public static function getAll(): array
    {
        return Abono::search("SELECT * FROM mer_optica.Abono");
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "fecha: $this->fecha->toDateTimeString(), valor: $this->valor";
    }

    protected static function searchForId($id)
    {
        // TODO: Implement searchForId() method.
    }
}