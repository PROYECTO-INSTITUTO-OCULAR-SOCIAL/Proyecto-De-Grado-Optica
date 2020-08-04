<?php


namespace App\Models;
require_once('BasicModel.php');

class Producto extends BasicModel
{
    private  int $id_producto;
    private  string $nombre;
    private  string $descripcion;
    private  int $iva;
    private  int $stock;
    private  ?Marca $marca;
    private ?Categoria $categoria;
    private  string $estado;



    /**
     * Producto constructor.
     * @param  int $id_producto
     * @param  string $nombre
     * @param string $descripcion
     *  @param  int $iva
     * @param  int $stock
     * * @param Marca $marca
     * * @param Categoria $categoria
     * @param string $estado

     */
    public function __construct($Producto = array())
    {
        parent::__construct();
        $this->id_producto = $Producto['id_producto'] ?? 0;
        $this->nombre = $Producto['nombre'] ?? '';
        $this->descripcion = $Producto['descripcion'] ?? '';
        $this->iva = $Producto['iva'] ?? 0;
        $this->stock = $Producto['stock'] ?? 0;
        $this->marca = $Producto['marca'] ?? null;
        $this->categoria = $Producto['categoria'] ?? null;
        $this->estado = $Producto['estado'] ?? '';
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
     * @param String $nombre
     */
    public function setNombre(String $nombre): void
    {
        $this->nombre = $nombre;
    }



    /**
     * @return String
     */
    public function getDescripcion(): String
    {
        return $this->descripcion;
    }

    /**
     * @param String $descripcion
     */
    public function setDescripcion(String $descripcion): void
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
    public function getStock() : int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
    /**
     * @return Categoria
     */
    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    /**
     * @param mixed|null $categoria
     */
    public function setCategoria(Categoria $categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return Marca
     */
    public function getMarca(): Marca
    {
        return $this->marca;
    }

    /**
     * @param mixed|null $marca
     */
    public function setMarca(Marca $marca): void
    {
        $this->marca = $marca;
    }


    /**
     * @return String
     */
    public function getEstado(): String
    {
        return $this->estado;
    }

    /**
     * @param String $estado
     */
    public function setEstado(String $estado): void
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
            $Producto->descripcion = $valor['descripcion'];
            $Producto->iva = $valor['iva'];
            $Producto->stock = $valor['stock'];
            $Producto->marca = Marca::searchForid_marca($valor['marca']);
            $Producto->categoria = Categoria::searchForId($valor['categoria']);
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
            $Producto->descripcion = $getrow['descripcion'];
            $Producto->iva = $getrow['iva'];
            $Producto->stock = $getrow['stock'];
            $Producto->marca = Marca::searchForid_marca($getrow['marca']);
            $Producto->categoria = Categoria::searchForId($getrow['categoria']);
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
                $this->descripcion,
                $this->iva,
                $this->stock,
                $this->marca->getid_marca(),
                $this->categoria->getIdCategoria(),
                $this->estado
            )
        );
        $this->setIdProducto(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Producto SET nombre = ?, descripcion = ?, iva = ?, stock = ?, marca = ?,categoria = ?,  estado = ? WHERE id_producto = ?", array(
                $this->nombre,
                $this->descripcion,
                $this->iva,
                $this->stock,
                $this->marca->getid_marca(),
                $this->categoria->getIdCategoria(),
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


}