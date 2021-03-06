<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/Producto.php');
require_once(__DIR__.'/../Models/Categoria.php');
require_once(__DIR__.'/../Models/Marca.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');


use App\Models\Categoria;
use App\Models\GeneralFunctions;
use App\Models\Marca;
use App\Models\Producto;


if(!empty($_GET['action'])){
    ProductoController::main($_GET['action']);
}

class ProductoController{

    static function main($action)
    {
        if ($action == "create") {
            ProductoController::create();
        } else if ($action == "edit") {
            ProductoController::edit();
        } else if ($action == "searchForID") {
            ProductoController::searchForID($_REQUEST['idProducto']);
        } else if ($action == "searchAll") {
            ProductoController::getAll();
        } else if ($action == "activate") {
            ProductoController::activate();
        } else if ($action == "inactivate") {
            ProductoController::inactivate();
        }/*else if ($action == "login"){
            UsuariosController::login();
        }else if($action == "cerrarSession"){
            UsuariosController::cerrarSession();
        }*/
    }

    static public function create()
    {
        try {
            $arrayProducto = array();
            $arrayProducto['nombre'] = $_POST['nombre'];
            $arrayProducto['descripcion'] = $_POST['descripcion'];
            $arrayProducto['iva'] = $_POST['iva'];
            $arrayProducto['stock'] = $_POST['stock'];
            $arrayProducto['categoria'] = Categoria::searchForId($_POST['categoria']);
            $arrayProducto['marca'] = marca::searchForid_marca($_POST['marca']);
            $arrayProducto['estado'] = $_POST['estado'];
            $Producto = new Producto($arrayProducto);

            if($Producto->create()){
                header("Location: ../../views/modules/Producto/index.php?id=".$Producto->getIdProducto());
            }
        } catch (Exception $e){
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Producto/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function edit (){
        try {
            $arrayProducto = array();
            $arrayProducto['nombre'] = $_POST['nombre'];
            $arrayProducto['descripcion'] = $_POST['descripcion'];
            $arrayProducto['iva'] = $_POST['iva'];
            $arrayProducto['stock'] = $_POST['stock'];
            $arrayProducto['estado'] = $_POST['estado'];
            $arrayProducto['categoria'] = Categoria::searchForId($_POST['categoria']);
            $arrayProducto['marca'] = Marca::searchForid_marca($_POST['marca']);
            $arrayProducto['id_producto'] = $_POST['id_producto'];

            $Producto = new Producto($arrayProducto);
            $Producto->update();

            header("Location: ../../Views/Modules/Producto/Show.php?idProducto=".$Producto->getIdProducto()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Producto/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjProducto = Producto::searchForId($_GET['IdProducto']);
            $ObjProducto->setEstado("Activo");
            if($ObjProducto->update()){
                header("Location: ../../Views/Modules/Producto/index.php");
            }else{
                header("Location: ../../Views/Modules/Producto/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Producto/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjProducto = Producto::searchForId($_GET['Id']);
            $ObjProducto->setEstado("Inactivo");
            if($ObjProducto->update()){
                header("Location: ../../Views/Modules/Producto/index.php");
            }else{
                header("Location: ../../Views/Modules/Producto/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Producto/index.php?respuesta=error");
        }
    }

    static public function searchForID ($id_producto){
        try {
            return Producto::searchForId($id_producto);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Producto/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Producto::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/Modules/Producto/Producto.php?respuesta=error");
        }
    }

    public static function ProductoIsInArray($id_producto, $ArrProducto){
        if(count($ArrProducto) > 0){
            foreach ($ArrProducto as $Producto){
                if($Producto->getIdProducto() == $id_producto){
                    return true;
                }
            }
        }
        return false;
    }
    static public function selectProducto ($isMultiple=false,
                                            $isRequired=true,
                                            $id="id_producto",
                                            $nombre="id_producto",
                                            $defaultValue="",
                                            $class="",
                                            $where="",
                                            $arrExcluir = array()){
        $arrProducto = array();
        if($where != ""){
            $base = "SELECT * FROM Producto WHERE ";
            $arrProducto = Producto::search($base.$where);
        }else{
            $arrProducto= Producto::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrProducto) > 0){
            foreach ($arrProducto as $Producto)
                if (!ProductoController::ProductoIsInArray($Producto->getIdProducto(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Producto != "") ? (($defaultValue == $Producto->getIdProducto()) ? "selected" : "" ) : "")." value='".$Producto->getIdProducto()." '> ".$Producto->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    /*
    public function buscar ($Query){
        try {
            return Persona::buscar($Query);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    static public function asociarEspecialidad (){
        try {
            $Persona = new Persona();
            $Persona->asociarEspecialidad($_POST['Persona'],$_POST['Especialidad']);
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=correcto&id=".$_POST['Persona']);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function eliminarEspecialidad (){
        try {
            $ObjPersona = new Persona();
            if(!empty($_GET['Persona']) && !empty($_GET['Especialidad'])){
                $ObjPersona->eliminarEspecialidad($_GET['Persona'],$_GET['Especialidad']);
            }else{
                throw new Exception('No se recibio la informacion necesaria.');
            }
            header("Location: ../Vista/modules/persona/managerSpeciality.php?id=".$_GET['Persona']);
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    public static function login (){
        try {
            if(!empty($_POST['Usuario']) && !empty($_POST['Contrasena'])){
                $tmpPerson = new Persona();
                $respuesta = $tmpPerson->Login($_POST['Usuario'], $_POST['Contrasena']);
                if (is_a($respuesta,"Persona")) {
                    $hydrator = new ReflectionHydrator(); //Instancia de la clase para convertir objetos
                    $ArrDataPersona = $hydrator->extract($respuesta); //Convertimos el objeto persona en un array
                    unset($ArrDataPersona["datab"],$ArrDataPersona["isConnected"],$ArrDataPersona["relEspecialidades"]); //Limpiamos Campos no Necesarios
                    $_SESSION['UserInSession'] = $ArrDataPersona;
                    echo json_encode(array('type' => 'success', 'title' => 'Ingreso Correcto', 'text' => 'Sera redireccionado en un momento...'));
                }else{
                    echo json_encode(array('type' => 'error', 'title' => 'Error al ingresar', 'text' => $respuesta)); //Si la llamda es por Ajax
                }
                return $respuesta; //Si la llamada es por funcion
            }else{
                echo json_encode(array('type' => 'error', 'title' => 'Datos Vacios', 'text' => 'Debe ingresar la informacion del usuario y contraseña'));
                return "Datos Vacios"; //Si la llamada es por funcion
            }
        } catch (Exception $e) {
            var_dump($e);
            header("Location: ../login.php?respuesta=error");
        }
    }

    public static function cerrarSession (){
        session_unset();
        session_destroy();
        header("Location: ../Vista/modules/persona/login.php");
    }*/

}