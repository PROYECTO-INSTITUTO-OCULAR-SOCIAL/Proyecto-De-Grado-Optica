<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Municipio.php');

use App\Models\Departamento;
use App\Models\Municipio;

if(!empty($_GET['action'])){
    MunicipioController::main($_GET['action']);
}

class MunicipioController
{

    static function main($action)
    {
        if ($action == "create") {
            MunicipioController::Create();
        } else if ($action == "edit") {
            MunicipioController::Edit();
        } else if ($action == "searchForID") {
            MunicipioController::searchForID($_REQUEST['id_municipio']);
        } else if ($action == "searchAll") {
            MunicipioController:: getAll();
        } else if ($action == "activate") {
            MunicipioController::activate();
        } else if ($action == "inactivate") {
            MunicipioController::inactivate();
        }

    }

    static public function create()
    {
        try {
            $arrayMunicipio = array();
            $arrayMunicipio['nombre'] = $_POST['nombre'];
            $arrayMunicipio['codigo_dane'] = $_POST['codigo_dane'];
            $arrayMunicipio['id_departamento'] = Departamento::searchForId($_POST['id_departamento']);
            $Municipio = new Municipio($arrayMunicipio);
            if($Municipio->create()){
                header("Location: ../../Views/Modules/Municipio/index.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Municipio/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayMunicipio= array();
            $arrayMunicipio['nombre'] = $_POST['nombre'];
            $arrayMunicipio['codigo_dane'] = $_POST['codigo_dane'];
            $arrayMunicipio['id_departamento'] = Departamento::searchForId($_POST['id_departamento']);
            $arrayMunicipio['id_municipio'] = $_POST['id_municipio'];

            $Municipio = new Municipio($arrayMunicipio);
            $Municipio->update();

            header("Location: ../../Views/Modules/Municipio/Show.php?id_municipio=".$Municipio->getIdMunicipio()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Municipio/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function getAll ()
    {
        try {
            return Municipio::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'log', 'errorStack');
            header("Location: ../Vista/Modules/Municipio/manager.php?respuesta=error");
        }
    }
            static public function activate()
    {
        try {
            $ObjMunicipio = Municipio::searchForID($_GET['id_municipio']);
            if ($ObjMunicipio->update()) {
                header("Location: ../../Views/Modules/Municipio/index.php");
            } else {
                header("Location: ../../Views/Modules/Municipio/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Municipio/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function inactivate(){
        try {
            $ObjMunicipio = Municipio::searchForId($_GET['id_municipio']);
            if ($ObjMunicipio->update()) {
                header("Location: ../../Views/Modules/Municipio/index.php");
            } else {
                header("Location: ../../Views/modules/Municipio/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Municipio/index.php?respuesta=error");
        }
    }

    static public function searchForID($id)
    {
        try {
            return Municipio::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Municipio/manager.php?respuesta=error");
        }
    }


    static public function selectMunicipio ($isMultiple=false,
                                           $isRequired=true,
                                           $id="id_municipio",
                                           $nombre="id_municipio",
                                           $defaultValue="",
                                           $class="",
                                           $where="",
                                           $arrExcluir = array()){
        $arrMunicipio = array();
        if($where != ""){
            $base = "SELECT * FROM Municipio WHERE ";
            $arrMunicipio = Municipio::search($base.$where);
        }else{
            $arrMunicipio = Municipio:: getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrMunicipio) > 0){
            foreach ($arrMunicipio as $Municipio)
                if (!MunicipioController::MunicipioIsInArray($Municipio->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Municipio != "") ? (($defaultValue == $Municipio->getId()) ? "selected" : "" ) : "")." value='".$Municipio->getId()."'>".$Municipio->getStock()." - ".$Municipio->getNombre()." - ".$Municipio->getCodigo_Dane()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
}