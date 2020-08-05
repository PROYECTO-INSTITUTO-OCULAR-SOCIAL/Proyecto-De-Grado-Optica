<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/Detalles_Compra.php');
require_once(__DIR__.'/../Models/Producto.php');
require_once(__DIR__.'/../Models/Compra.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');


use App\Models\Detalles_Compra;
use App\Models\GeneralFunctions;
use App\Models\Compra;
use App\Models\Producto;


if(!empty($_GET['action'])){
    Detalles_CompraController::main($_GET['action']);
}

class Detalles_CompraController{

    static function main($action)
    {
        if ($action == "create") {
            Detalles_CompraController::create();
        } else if ($action == "edit") {
            Detalles_CompraController::edit();
        } else if ($action == "searchForID") {
            Detalles_CompraController::searchForID($_REQUEST['idDetalles_Compra']);
        } else if ($action == "searchAll") {
            Detalles_CompraController::getAll();
        } else if ($action == "activate") {
            Detalles_CompraController::activate();
        } else if ($action == "inactivate") {
            Detalles_CompraController::inactivate();
        }/*else if ($action == "login"){
            UsuariosController::login();
        }else if($action == "cerrarSession"){
            UsuariosController::cerrarSession();
        }*/
    }

    static public function create()
    {
        try {
            $arrayDetalles_Compra = array();
            $arrayDetalles_Compra['cantidad'] = $_POST['cantidad'];
            $arrayDetalles_Compra['precio'] = $_POST['precio'];
            $arrayDetalles_Compra['compra'] = Compra::searchForId($_POST['compra']);
            $arrayDetalles_Compra['producto'] = Producto::searchForId($_POST['producto']);
            $Detalles_Compra = new Detalles_Compra($arrayDetalles_Compra);

            if($Detalles_Compra->create()){
                header("Location: ../../views/modules/Detalles_Compra/index.php?id=".$Detalles_Compra->getIdProducto());
            }
        } catch (Exception $e){
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Detalles_Compra/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayDetalles_Compra = array();
            $arrayDetalles_Compra['cantidad'] = $_POST['cantidad'];
            $arrayDetalles_Compra['precio'] = $_POST['precio'];
            $arrayDetalles_Compra['compra'] = Compra::searchForId($_POST['categoria']);
            $arrayDetalles_Compra['producto'] = Producto::searchForId($_POST['producto']);
            $arrayDetalles_Compra['id_detalles_compra'] = $_POST['id_detalles_compra'];

            $Detalles_Compra = new Detalles_Compra($arrayDetalles_Compra);
            $Detalles_Compra->update();

            header("Location: ../../Views/Modules/Detalles_Compra/Show.php?idProducto=".$Detalles_Compra->getIdDetallesCompra()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Detalles_Compra/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjDetalles_Compra = Detalles_Compra::searchForId($_GET['getIdDetallesCompra']);
            if($ObjDetalles_Compra->update()){
                header("Location: ../../Views/Modules/Detalles_Compra/index.php");
            }else{
                header("Location: ../../Views/Modules/Detalles_Compra/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Detalles_Compra/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjDetalles_Compra = Detalles_Compra::searchForId($_GET['Id']);
            if($ObjDetalles_Compra->update()){
                header("Location: ../../Views/Modules/Detalles_Compra/index.php");
            }else{
                header("Location: ../../Views/Modules/Detalles_Compra/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Detalles_Compra/index.php?respuesta=error");
        }
    }

    static public function searchForID ($id_detalles_compra){
        try {
            return Detalles_Compra::searchForId($id_detalles_compra);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Detalles_Compra/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Detalles_Compra::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/Modules/Detalles_Compra/Detalles_Compra.php?respuesta=error");
        }
    }

    /* public static function Detalles_CompraIsInArray($id_detalles_compra, $ArrDetalles_Compra){
         if(count($ArrDetalles_Compra) > 0){
             foreach ($ArrDetalles_Compra as $Detalles_Compra){
                 if($Detalles_Compra->getIdDetallesCompra() == $id_detalles_compra){
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