<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Municipio.php');
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
            MunicipioController::getAll();
        } else if ($action == "activate") {
            MunicipioController::activate();
        } else if ($action == "inactivate") {
            MunicipioController::inactivate();
        }/*else if ($action == "login"){
            MunicipioController::login();
        }else if($action == "cerrarSession"){
            MunicipioController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {
            $arrayMunicipio = array();
            $arrayMunicipio['nombre'] = $_POST['nombre'];
            $arrayMunicipio['codigo_dane'] = $_POST['codigo_dane'];

            if (!Municipio::MunicipioRegistrado($arrayMunicipio['nombre'])) {
                $Municipio = new Municipio ($arrayMunicipio);
                if ($Municipio->create()) {
                    header("Location: ../../Views/Modules/Municipio/index.php?respuesta=correcto");
                }else{
                    echo "Error";
                }
            } else {
                header("Location: ../../Views/Modules/Municipio/Create.php?respuesta=error&mensaje=Municipio ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/Modules/Municipio/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit()
    {
        try {
            $arrayMunicipio = array();
            $arrayMunicipio['nombre'] = $_POST['nombre'];
            $arrayMunicipio['codigo_dane'] = $_POST['codigo_dane'];
            $arrayMunicipio['id_municipio'] = $_POST['id_municipio'];

            $user = new Municipio($arrayMunicipio);
            $user->update();

            header("Location: ../../Views/Modules/Municipio/Show.php?id_municipio=" . $user->getIdMunicipio() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Municipio/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function activate()
    {
        try {
            $ObjMunicipio = Municipio::searchForId($_GET['id_municipio']);
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

    static public function inactivate()
    {
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

    static public function searchForID($id_municipio)
    {
        try {
            return Municipio::searchForId($id_municipio);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Municipio/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Municipio::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Municipio/manager.php?respuesta=error");
        }
    }
}