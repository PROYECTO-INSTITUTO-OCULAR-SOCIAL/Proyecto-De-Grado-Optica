<?php
namespace App\Controllers;
require(__DIR__ . '/../Models/Abono.php');
use app\Models\abono;

if(!empty($_GET['action'])){
    AbonoController::main($_GET['action']);
}


class AbonoController
{

    static function main($action)
    {
        if ($action == "Create") {
            AbonoController::Create();
        } else if ($action == "Edit") {
            AbonoController::Edit();
        } else if ($action == "searchForid_abono") {
            AbonoController::searchForid_abono($_REQUEST['id_abono']);
        } else if ($action == "searchAll") {
            AbonoController::getAll();
        }/*else if ($action == "login"){
            MarcaController::login();
        }else if($action == "cerrarSession"){
            MarcaController::cerrarSession();
        }*/

    }

    static public function Create()
    {
        try {
            $arrayAbono = array();
            $arrayAbono['fecha'] = date('Y-m-d H:i:s'); //Fecha Completa Hoy
            $arrayAbono['valor'] = 0;
            if(!Abono::AbonoRegistrado($arrayAbono['fecha'])){
                $Abono = new Abono ($arrayAbono);
                if($Abono->Create()){
                    header("Location: ../../Views/Modules/Abono/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../Views/Modules/Abono/Create.php?respuesta=error&mensaje=Abono ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/Modules/Abono/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit (){
        try {
            $arrayAbono = array();
            $arrayAbono['fecha'] = $_POST['fecha'];
            $arrayAbono['valor'] = $_POST['valor'];
            $arrayAbono['id_abono'] = $_POST['id_abono'];

            $Abono = new Abono($arrayAbono);
            $Abono->update();

            header("Location: ../../Views/Modules/Abono/Show.php?id_abono=".$Abono->getid_abono()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Abono/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }



    static public function searchForid_abono ($id_abono){
        try {
            return Abono::searchForid_abono($id_abono);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Abono/Abono.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Abono::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Abono/Abono.php?respuesta=error");
        }
    }
















    static public function selectMarca ($isMultiple=false,
                                        $isRequired=true,
                                        $id="idMarca",
                                        $nombre="idMarca",
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
                if (!MarcaControllers::MarcaIsInArray($Marca->getid_marca(), $arrExcluir))
                    $htmlSelect .= "<option " . (($Marca != "") ? (($defaultValue == $Marca->getid_marca()) ? "selected" : "") : "") . " value='" . $Marca->getId() . "'>" . $Marca->getStock() . " - " . $Marca->getNombres() . " - " . $Marca->getPrecio() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

}