<?php


namespace App\Models;
require('BasicModel.php');

class Formula extends BasicModel
{
    private $id_formula;
    private $od_esfera;
    private $oi_esfera;
    private $od_cilindro;
    private $oi_cilindro;
    private $od_eje;
    private $oi_eje;
    private $od_av;
    private $oi_av;
    private $dp;
    private $color;
    private $numero_montura;
    private $observaciones;
    private $bifocal;
    private $material;
    private $valor;

    /**
     * Formula constructor.
     * @param $id_formula
     * @param $od_esfera
     * @param $oi_esfera
     * @param $od_cilindro
     * @param $oi_cilindro
     * @param $od_eje
     * @param $oi_eje
     * @param $od_av
     * @param $oi_av
     * @param $dp
     * @param $color
     * @param $numero_montura
     * @param $observaciones
     * @param $bifocal
     * @param $material
     * @param $valor
     */
    public function __construct($Formula = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_formula = $Formula['id_formula'] ?? null;
        $this->od_esfera = $Formula['od_esfera'] ?? null;
        $this->oi_esfera = $Formula['oi_esfera'] ?? null;
        $this->od_cilindro = $Formula['od_cilindro'] ?? null;
        $this->oi_cilindro = $Formula['oi_cilindro'] ?? null;
        $this->od_eje= $Formula['od_eje'] ?? null;
        $this->oi_eje = $Formula['oi_eje'] ?? null;
        $this->od_av = $Formula['od_av'] ?? null;
        $this->oi_eje = $Formula['oi_eje'] ?? null;
        $this->dp = $Formula['dp'] ?? null;
        $this->color = $Formula['color'] ?? null;
        $this->numero_montura = $Formula['numero_montura'] ?? null;
        $this->observaciones = $Formula['observaciones'] ?? null;
        $this->bifocal = $Formula['bifocal'] ?? null;
        $this->material = $Formula['material'] ?? null;
        $this->valor = $Formula['valor'] ?? null;
    }
    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }/**
      * @return int
      */
    public function getId() : int
    {
        return $this->id_formula;
    }
    /**
     * @param int $id_formula
     *
     */
    public function setId(int $id_formula): void
    {
        $this->id_formula = $id_formula;
    }
    /**
     * @return string
     */
    public function getod_esfera() : string
    {
        return $this->od_esfera;
    }

    /**
     * @param string $od_esfera
     */
    public function setod_esfera(string $od_esfera): void
    {
        $this->od_esfera = $od_esfera;
    }
    /**
     * @return string
     */
    public function getoi_esfera() : string
    {
        return $this->oi_esfera;
    }

    /**
     * @param string $oi_esfera
     */
    public function setoi_esfera(string $oi_esfera): void
    {
        $this->oi_esfera = $oi_esfera;
    }
    /**
     * @return string
     */
    public function getod_cilindro() : string
    {
        return $this->od_cilindro;
    }

    /**
     * @param string $od_cilindro
     */
    public function setod_cilindro(string $od_cilindro): void
    {
        $this->od_cilindro = $od_cilindro;
    }
    /**
     * @return string
     */
    public function getoi_cilindro() : string
    {
        return $this->oi_cilindro;
    }
    /**
     * @param string $oi_cilindro
     */
    public function setoi_cilindro(string $oi_cilindro): void
    {
        $this->oi_cilindro = $oi_cilindro;
    }
    /**
     * @return string
     */
    public function getod_eje() : string
    {
        return $this->od_eje;
    }
    /**
     * @param string $od_eje
     */
    public function setod_eje(string $od_eje): void
    {
        $this->od_eje = $od_eje;
    }
    /**
     * @return string
     */
    public function getoi_eje() : string
    {
        return $this->oi_eje;
    }
    /**
     * @param string $oi_eje
     */
    public function setoi_eje(string $oi_eje): void
    {
        $this->oi_eje = $oi_eje;
    }
    /**
     * @return string
     */
    public function getod_av() : string
    {
        return $this->od_av;
    }
    /**
     * @param string $od_av
     */
    public function setod_av(string $od_av): void
    {
        $this->od_av = $od_av;
    }
    /**
     * @return string
     */
    public function getoi_av() : string
    {
        return $this->oi_av;
    }
    /**
     * @param string $oi_av
     */
    public function setoi_av(string $oi_av): void
    {
        $this->oi_av = $oi_av;
    }
    /**
     * @return string
     */
    public function getdp() : string
    {
        return $this->dp;
    }
    /**
     * @param string $dp
     */
    public function setdp(string $dp): void
    {
        $this->dp = $dp;
    }
    /**
     * @return string
     */
    public function getcolor() : string
    {
        return $this->color;
    }
    /**
     * @param string $color
     */
    public function setcolor(string $color): void
    {
        $this->color = $color;
    }
    /**
     * @return int
     */
    public function getnumero_montura() : int
    {
        return $this->numero_montura;
    }
    /**
     * @param int $numero_montura
     */
    public function setnumero_montura(int $numero_montura): void
    {
        $this->numero_montura = $numero_montura;
    }
    /**
     * @return string
     */
    public function getobservaciones() :string
    {
        return $this->observaciones;
    }
    /**
     * @param string $observaciones
     */
    public function setobservaciones(string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }
    /**
     * @return string
     */
    public function getbifocal() : string
    {
        return $this->bifocal;
    }
    /**
     * @param string $bifocal
     */
    public function setbifocal(string $bifocal): void
    {
        $this->bifocal = $bifocal;
    }
    /**
     * @return string
     */
    public function getmaterial() : string
    {
        return $this->material;
    }
    /**
     * @param string $material
     */
    public function setmaterial(string $material): void
    {
        $this->material = $material;
    }
    /**
     * @return double
     */
    public function getvalor() : double
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
        $result = $this->insertRow("INSERT INTO Proyecto-De-Grado-Optica.Formula VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
        $this->id_formula,
        $this->od_esfera,
        $this->oi_esfera,
        $this->od_cilindro,
        $this->oi_cilindro,
        $this->od_eje,
        $this->oi_eje,
        $this->od_av,
        $this->oi_eje,
        $this->dp,
        $this->color,
        $this->numero_montura,
        $this->observaciones,
        $this->bifocal,
        $this->material,
        $this->valor
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE Proyecto-De-Grado-Optica.Formula SET  =od_esfera ?, oi_esfera = ?, od_cilindro = ?, oi_cilindro = ?, od_eje = ?, oi_eje= ?, od_av = ?, oi_av = ?, dp = ?, color = ?, numero_montura = ?, observaciones = ?,bifocal = ?, material = ?, valor = ? WHERE id_formula = ?", array(

                $this->od_esfera,
                $this->oi_esfera,
                $this->od_cilindro,
                $this->oi_cilindro,
                $this->od_eje,
                $this->oi_eje,
                $this->od_av,
                $this->oi_eje,
                $this->dp,
                $this->color,
                $this->numero_montura,
                $this->observaciones,
                $this->bifocal,
                $this->material,
                $this->valor,
                $this->id_formula
            )
        );
        $this->Disconnect();
        return $result;
    }

    protected static function search($query)
    {

        $arrFormula = array();
        $tmp = new Formula();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Formula = new Formula();
            $Formula->id_formula = $valor['id_formula'];
            $Formula->od_esfera = $valor['od_esfera'];
            $Formula->oi_esfera = $valor['oi_esfera'];
            $Formula->od_cilindro = $valor['od_cilindro'];
            $Formula->oi_cilindro = $valor['oi_cilindro'];
            $Formula->od_eje = $valor['od_eje'];
            $Formula->oi_eje = $valor['oi_eje'];
            $Formula->od_av = $valor['od_av'];
            $Formula->oi_av = $valor['oi_av'];
            $Formula->dp = $valor['dp'];
            $Formula->color = $valor['color'];
            $Formula->numero_montura = $valor['numero_montura'];
            $Formula->observaciones = $valor['observaciones'];
            $Formula->bifocal = $valor['bifocal'];
            $Formula->material = $valor['material'];
            $Formula->valor = $valor['valor'];
            $Formula->Disconnect();
            array_push($arrFormula, $Formula);
        }
        $tmp->Disconnect();
        return $arrFormula;

    }

    protected static function getAll()
    {

            return Formula::search("SELECT * FROM Proyecto-De-Grado-Optica.Formula");
        }

        public static function FormulaRegistrada ($id_formula) : bool
        {
            $result = Formula::search("SELECT id_formula FROM royecto-De-Grado-Optica.Formula where id_formula = " . $id_formula);
            if (count($result) > 0) {
                return true;
            } else {
                return false;
            }
        }

    protected static function searchForId($id_formula)
    {
        $Formula = null;
        if ($id_formula> 0){
            $Formula = new Formula();
            $getrow = $Formula->getRow("SELECT * FROM Proyecto-De-Grado-Optica.Formula WHERE id_formula =?", array($id_formula));
            $Formula->id_formula = $getrow['id_formula'];
            $Formula->od_esfera = $getrow['od_esfera '];
            $Formula->oi_esfera = $getrow['oi_esfera'];
            $Formula->od_cilindro = $getrow['od_cilindro'];
            $Formula->oi_cilindro = $getrow['oi_cilindro'];
            $Formula->od_eje = $getrow['od_eje'];
            $Formula->oi_eje = $getrow['oi_eje'];
            $Formula->od_av = $getrow['od_av'];
            $Formula->oi_av = $getrow['oi_av'];
            $Formula->dp = $getrow['dp'];
            $Formula->color = $getrow['color'];
            $Formula->numero_montura = $getrow['numero_montura'];
            $Formula->observaciones = $getrow['observaciones'];
            $Formula->bifocal = $getrow['bifocal'];
            $Formula->material= $getrow['material'];
            $Formula->valor = $getrow['valor'];
        }
        $Formula->Disconnect();
        return $Formula;
    }
    protected function deleted($id)
    {
        // TODO: Implement deleted() method.
    }
}