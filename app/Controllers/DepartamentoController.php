<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Departamento.php');
use App\Models\Departamento;
use App\Models\Productos;

if(!empty($_GET['action'])){
    DepartamentoController::main($_GET['action']);
}

class DepartamentoController
{

    static function main($action)
    {
        if ($action == "Create") {
            DepartamentoController::Create();
        } else if ($action == "edit") {
            DepartamentoController::Edit();
        } else if ($action == "searchForId") {
            DepartamentoController::searchForId($_REQUEST['id_departamento']);
        } else if ($action == "searchAll") {
            DepartamentoController::getAll();
        } else if ($action == "activate") {
            DepartamentoController::activate();
        } else if ($action == "inactivate") {
            DepartamentoController::inactivate();
        }/*else if ($action == "login"){
            DepartamentoController::login();
        }else if($action == "cerrarSession"){
            DepartamentoController::cerrarSession();
        }*/

    }

    static public function Create()
    {
        try {
            $arrayDepartamento = array();
            $arrayDepartamento['nombre'] = $_POST['nombre'];
            $arrayDepartamento['codigo_dane'] = $_POST['codigo_dane'];

            if (!Departamento::DepartamentoRegistrado($arrayDepartamento['nombre'])) {
                $Departamento = new Departamento ($arrayDepartamento);
                if ($Departamento->create()) {
                    header("Location: ../../Views/Modules/Departamento/index.php?respuesta=correcto");
                } else{echo "Error";}
            } else {
                header("Location: ../../Views/Modules/Departamento/Create.php?respuesta=error&mensaje=Departamento ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/Modules/Departamento/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit()
    {
        try {
            $arrayDepartamento = array();
            $arrayDepartamento['nombre'] = $_POST['nombre'];
            $arrayDepartamento['codigo_dane'] = $_POST['codigo_dane'];
            $arrayDepartamento['id_departamento'] = $_POST['id_departamento'];

            $Departamento = new Departamento($arrayDepartamento);
            $Departamento->update();

            header("Location: ../../Views/Modules/Departamento/Show.php?id_departamento=".$Departamento->getid_departamento() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Departamento/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }




    static public function searchForId($id_departamento)
    {
        try {
            return Departamento::searchForId($id_departamento);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Departamento/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Departamento::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Departamento/manager.php?respuesta=error");
        }
    }

    public static function DepartamentoIsInArray($id_departamento, $ArrDepartamento){
        if(count($ArrDepartamento) > 0){
            foreach ($ArrDepartamento as $Departamento){
                if($Departamento->getid_departamento() == $id_departamento){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectDepartamento ($isMultiple=false,
                                           $isRequired=true,
                                           $id="id_departamento",
                                           $nombre="id_departamento",
                                           $defaultValue="",
                                           $class="",
                                           $where="",
                                           $arrExcluir = array()){
        $arrDepartamento = array();
        if($where != ""){
            $base = "SELECT * FROM Departamento WHERE ";
            $arrDepartamento = Departamento::search($base.$where);
        }else{
            $arrDepartamento= Departamento::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrDepartamento) > 0){
            foreach ($arrDepartamento as $Departamento)
                if (!DepartamentoController::DepartamentoIsInArray($Departamento->getid_departamento(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Departamento != "") ? (($defaultValue == $Departamento->getid_departamento()) ? "selected" : "" ) : "")." value='".$Departamento->getid_departamento()."'>"." - ".$Departamento->getnombre()." - ".$Departamento->getcodigo_dane()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

}