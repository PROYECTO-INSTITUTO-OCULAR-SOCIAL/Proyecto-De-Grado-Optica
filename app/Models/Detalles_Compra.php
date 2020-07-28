<?php


namespace App\Models;

require_once('BasicModel.php');

class Detalles_Compra extends BasicModel
{
    private $id_detalles_compra;
    private $cantidad;
    private $precio;
    private $compra;
    private $producto;




    /**
     * Producto constructor.
     * @param $id_detalles_compra
     * @param $cantidad
     * @param $precio
     *  @param $compra
     * @param $producto

     */
    public function __construct($Detalles_Compra = array())
    {
        parent::__construct();
        $this->id_detalles_compra = Detalles_Compra['id_detalles_compra'] ?? null;
        $this->cantidad = Detalles_Compra['cantidad'] ?? null;
        $this->precio = Detalles_Compra['precio'] ?? null;
        $this->compra = Detalles_Compra['compra'] ?? null;
        $this->producto = Detalles_Compra['producto'] ?? null;
    }

    /**
     * @return int
     */
    public function getIdDetallesCompra(): int
    {
        return $this->id_detalles_compra;
    }

    /**
     * @param int $id_detalles_compra
     */
    public function setIdDetallesCompra(int $id_detalles_compra): void
    {
        $this->id_detalles_compra = $id_detalles_compra;
    }

    /**
     * @return int
     */
    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    /**
     * @param int $cantidad
     */
    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return int
     */
    public function getPrecio(): int
    {
        return $this->precio;
    }

    /**
     * @param int $precio
     */
    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return Compra
     */
    public function getCompra(): Compra
    {
        return $this->compra;
    }

    /**
     * @param |null $compra
     */
    public function setCompra(Compra$compra): void
    {
        $this->compra = $compra;
    }

    /**
     * @return Producto
     */
    public function getProducto(): Producto
    {
        return $this->producto;
    }

    /**
     * @param |null $producto
     */
    public function setProducto(Producto$producto): void
    {
        $this->producto = $producto;
    }




    public static function search($query)
    {
        $arrDetalles_Compra = array();
        $tmp = new Detalles_Compra();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Detalles_Compra = new Detalles_Compra();
            $Detalles_Compra->id_detalles_compra = $valor['id_detalles_compra'];
            $Detalles_Compra->cantidad = $valor['cantidad'];
            $Detalles_Compra->precio = $valor['precio'];
            $Detalles_Compra->compra = Compra::searchForid_marca($valor['compra']);
            $Detalles_Compra->producto = Producto::searchForId($valor['producto']);
            $Detalles_Compra->Disconnect();
            array_push($arrDetalles_Compra, $Detalles_Compra);
        }
        $tmp->Disconnect();
        return $arrDetalles_Compra;
    }

    /**
     * @return Detalles_Compra |array|mixed
     */
    public static function getAll()
    {
        return Detalles_Compra::search("SELECT * FROM mer_optica.Detalles_Compra");
    }

    /**
     * @param $id_detalles_compra
     * @return Detalles_Compra|null
     * @throws \Exception
     */
    public static function searchForId($id_detalles_compra)
    {
        $Detalles_Compra = null;
        if ($id_detalles_compra > 0) {
            $id_detalles_compra = new Detalles_Compra();
            $getrow = $id_detalles_compra->getRow("SELECT * FROM mer_optica.Detalles_Compra WHERE id_detalles_compra =?", array($id_detalles_compra));
            $id_detalles_compra->id_detalles_compra = $getrow['id_detalles_compra'];
            $id_detalles_compra->cantidad = $getrow['cantidad'];
            $id_detalles_compra->precio = $getrow['precio'];
            $id_detalles_compra->Compra = Compra::searchForid_marca($getrow['compra']);
            $id_detalles_compra->producto = Producto::searchForId($getrow['producto']);
        }
        $id_detalles_compra->Disconnect();
        return $Detalles_Compra;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Detalles_Compra VALUES (NULL, ?, ?, ?, ?)", array(
                $this->cantidad,
                $this->precio,
                $this->compra->getid_marca(),
                $this->producto->getIdProducto(),

            )
        );
        $this->setIdDetallesCompra(($result) ? $this->getIdDetallesCompra() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Detalles_Compra SET  cantidad= ?, precio = ?, compra = ?, producto = ? WHERE id_detalles_compra = ?", array(
                $this->cantidad,
                $this->precio,
                $this->compra->getid_marca(),
                $this->producto->getIdProducto(),
                $this->id_detalles_compra
            )
        );
        $this->Disconnect();
        return $result;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function deleted($id_detalles_compra)
    {
        $id_detalles_compra = Producto::searchForId($id_detalles_compra); //Buscando un usuario por el ID
        $id_detalles_compra->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $id_detalles_compra->update();                    //Guarda los cambios..
    }


    /**
     * @param $nombres
     * @return bool
     */


    /**
     * @return string
     */


}