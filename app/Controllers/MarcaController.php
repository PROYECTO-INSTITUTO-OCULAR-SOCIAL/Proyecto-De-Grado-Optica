<?php
namespace App\Controllers;
require_once(__DIR__ . '/../Models/Marca.php');
use App\Models\Marca;

if(!empty($_GET['action'])){
    MarcaController::main($_GET['action']);
}


class MarcaController
{

    static function main($action)
    {
        if ($action == "Create") {
            MarcaController::Create();
        } else if ($action == "Edit") {
            MarcaController::Edit();
        } else if ($action == "searchForid_marca") {
            MarcaController::searchForid_marca($_REQUEST['id_marca']);
        } else if ($action == "searchAll") {
            MarcaController::getAll();
        } else if ($action == "Activo") {
            MarcaController::Activo();
        } else if ($action == "Inactivo") {
            MarcaController::Inactivo();
        }/*else if ($action == "login"){
            MarcaController::login();
        }else if($action == "cerrarSession"){
            MarcaController::cerrarSession();
        }*/

    }

    static public function Create()
    {
        try {
            $arrayMarca = array();
            $arrayMarca['nombre'] = $_POST['nombre'];
            $arrayMarca['estado'] = $_POST['estado'];
            if(!Marca::MarcaRegistrada($arrayMarca['nombre'])){
                $Marca = new Marca ($arrayMarca);
                if($Marca->Create()){
                    header("Location: ../../views/Modules/Marca/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/Modules/Marca/Create.php?respuesta=error&mensaje=Marca ya registrada");
            }
        } catch (Exception $e) {
            header("Location: ../../views/Modules/Marca/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit (){
        try {
            $arrayMarca = array();
            $arrayMarca['nombre'] = $_POST['nombre'];
            $arrayMarca['estado'] = $_POST['estado'];
            $arrayMarca['id_marca'] = $_POST['id_marca'];

            $Marca = new Marca($arrayMarca);
            $Marca->update();

            header("Location: ../../Views/Modules/Marca/Show.php?id_marca=".$Marca->getid_marca()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Marca/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function Activo(){
        try {
            $ObjMarca = Marca::searchForid_marca($_GET['id_marca']);
            $ObjMarca->setestado("Activo");
            if($ObjMarca->update()){
                header("Location: ../../Views/Modules/Marca/index.php");
            }else{
                header("Location: ../../Views/Modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Marca/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function Inactivo (){
        try {
            $ObjMarca = Marca::searchForid_marca($_GET['id_marca']);
            $ObjMarca->setestado("Inactivo");
            if($ObjMarca->update()){
                header("Location: ../../Views/Modules/Marca/index.php");
            }else{
                header("Location: ../../Views/Modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Marca/index.php?respuesta=error");
        }
    }

    static public function searchForid_marca ($id_marca){
        try {
            return Marca::searchForid_marca($id_marca);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Marca/Marca.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Marca::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Marca/Marca.php?respuesta=error");
        }
    }
    public static function MarcaIsInArray($id_marca, $ArrMarca){
        if(count($ArrMarca) > 0){
            foreach ($ArrMarca as $Marca){
                if($Marca->getid_marca() == $id_marca){
                    return true;
                }
            }
        }
        return false;
    }

    public static function MarcaIsInArray($id_marca, $ArrMarca){
        if(count($ArrMarca) > 0){
            foreach ($ArrMarca as $Marca){
                if($Marca->getid_marca() == $id_marca){
                    return true;
                }
            }
        }
        return false;
    }


    static public function selectMarca ($isMultiple=false,
                                           $isRequired=true,
                                           $id="id_marca",
                                           $nombre="id_marca",
                                           $defaultValue="",
                                           $class="",
                                           $where="",
                                           $arrExcluir = array())
    {
        $arrMarca = array();
        if ($where != "") {
            $base = "SELECT * FROM Marca WHERE ";
            $arrMarca = Marca::search($base . $where);
        } else {
            $arrMarca = Marca::getAll();
        }

        $htmlSelect = "<select " . (($isMultiple) ? "multiple" : "") . " " . (($isRequired) ? "required" : "") . " id= '" . $id . "' name='" . $nombre . "' class='" . $class . "'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (count($arrMarca) > 0) {
            foreach ($arrMarca as $Marca)
                if (!MarcaController::MarcaIsInArray($Marca->getid_marca(), $arrExcluir))
                    $htmlSelect .= "<option " . (($Marca != "") ? (($defaultValue == $Marca->getid_marca()) ? "selected" : "") : "") . " value='" . $Marca->getid_marca() . "'>" . $Marca->getNombre(). "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

}