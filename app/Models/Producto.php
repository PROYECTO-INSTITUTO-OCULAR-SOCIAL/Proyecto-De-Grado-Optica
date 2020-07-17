<?php


namespace App\Models;

require_once('BasicModel.php');

class Producto extends BasicModel
{
    private $id_producto;
    private $nombre;
    private $id_categoria;
    private $id_marca;
    private $descripcion;
    private $iva;
    private $stock;
    private $estado;



    /**
     * Producto constructor.
     * @param $id_producto
     * @param $nombre
     * @param $id_categoria
     * @param $id_marca
     * @param $descripcion
     *  @param $iva
     * @param $stock
     * @param $estado

     */
    public function __construct($Producto = array())
    {
        parent::__construct();
        $this->id_producto = $Producto['id_producto'] ?? null;
        $this->nombre = $Producto['nombre'] ?? null;
        $this->id_categoria = $Producto['id_categoria'] ?? null;
        $this->id_marca = $Producto['id_marca'] ?? null;
        $this->descripcion = $Producto['descripcion'] ?? null;
        $this->iva = $Producto['iva'] ?? null;
        $this->stock = $Producto['stock'] ?? null;
        $this->estado = $Producto['estado'] ?? null;
    }

    /**
     * @return int
     */
    public function getIdProducto(): ? int
    {
        return $this->id_producto;
    }

    /**
     * @param int $id_producto
     */
    public function setIdProducto(? int $id_producto): void
    {
        $this->id_producto = $id_producto;
    }

    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Categoria
     */
    public function getIdCategoria(): Categoria
    {
        return $this->id_categoria;
    }

    /**
     * @param mixed|null $id_categoria
     */
    public function setIdCategoria(Categoria $id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }

    /**
     * @return Marca
     */
    public function getIdMarca(): Marca
    {
        return $this->id_marca;
    }

    /**
     * @param mixed|null $id_marca
     */
    public function setIdMarca(Marca $id_marca): void
    {
        $this->id_marca = $id_marca;
    }



    /**
     * @return string
     */
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return int
     */
    public function getIva(): ? int
    {
        return $this->iva;
    }

    /**
     * @param int $iva
     */
    public function setIva(? int $iva): void
    {
        $this->iva = $iva;
    }

    /**
     * @return int
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(?int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return string
     */
    public function getEstado(): ?string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado(?string $estado): void
    {
        $this->estado = $estado;
    }


    public static function search($query)
    {
        $arrProducto = array();
        $tmp = new Producto();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Producto = new Producto();
            $Producto->id_producto = $valor['id_producto'];
            $Producto->nombre = $valor['nombre'];
            $Producto->id_categoria = Categoria::searchForId($valor['id_categoria']);
            $Producto->id_marca = Marca::searchForId($valor['id_marca']);
            $Producto->descripcion = $valor['descripcion'];
            $Producto->iva = $valor['iva'];
            $Producto->stock = $valor['stock'];
            $Producto->estado = $valor['estado'];
            $Producto->Disconnect();
            array_push($arrProducto, $Producto);
        }
        $tmp->Disconnect();
        return $arrProducto;
    }

    /**
     * @return Producto |array|mixed
     */
    public static function getAll()
    {
        return Producto::search("SELECT * FROM mer_optica.Producto");
    }

    /**
     * @param $id_producto
     * @return Producto|null
     * @throws \Exception
     */
    public static function searchForId($id_producto)
    {
        $Producto = null;
        if ($id_producto > 0) {
            $Producto = new Producto();
            $getrow = $Producto->getRow("SELECT * FROM mer_optica.Producto WHERE id_producto =?", array($id_producto));
            $Producto->id_producto = $getrow['id_producto'];
            $Producto->nombre = $getrow['nombre'];
            $Producto->id_categoria = Categoria::searchForId($getrow['id_categoria']);
            $Producto->id_marca = Marca::searchForId($getrow['id_marca']);
            $Producto->descripcion = $getrow['descripcion'];
            $Producto->iva = $getrow['iva'];
            $Producto->stock = $getrow['stock'];
            $Producto->estado = $getrow['estado'];
        }
        $Producto->Disconnect();
        return $Producto;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Producto VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->nombre,
                $this->id_categoria->getIdCategoria(),
                $this->id_marca->getIdMarca(),
                $this->descripcion,
                $this->iva,
                $this->stock,
                $this->estado
            )
        );
        $this->setIdProducto(($result) ? $this->getLastIdProducto() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Producto SET nombre = ?, id_categoria = ?, id_marca = ?, descripcion = ?, iva = ?, stock = ?, estado = ? WHERE id_producto = ?", array(
                $this->nombre,
                $this->id_categoria->getIdCategoria(),
                $this->id_marca->getIdMarca(),
                $this->descripcion,
                $this->iva,
                $this->stock,
                $this->estado,
                $this->id_producto
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
    public function deleted($id_producto)
    {
        $Producto = Producto::searchForId($id_producto); //Buscando un usuario por el ID
        $Producto->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $Producto->update();                    //Guarda los cambios..
    }


    /**
     * @param $nombres
     * @return bool
     */


    /**
     * @return string
     */
    public function __toString()
    {
        return "Nombre: $this->nombre, Categoria: $this->id_categoria, Marca: $this->id_marca, Descripcion: $this->descripcion, iva: $this->iva, Stock: $this->stock, Estado: $this->estado";
    }

}