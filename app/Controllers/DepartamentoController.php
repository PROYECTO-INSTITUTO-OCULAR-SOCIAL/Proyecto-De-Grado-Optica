<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Departamento.php');
use App\Models\Departamento;

if(!empty($_GET['action'])){
    DepartamentoController::main($_GET['action']);
}

class DepartamentoController
{

    static function main($action)
    {
        if ($action == "Create") {
            DepartamentoController::Create();
        } else if ($action == "Edit") {
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
                }
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

            $user = new Departamento($arrayDepartamento);
            $user->update();

            header("Location: ../../Views/Modules/Departamento/Show.php?id_departamento=" . $user->getId() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Departamento/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function activate()
    {
        try {
            $ObjDepartamento = Departamento::searchForId($_GET['id_departamento']);
            $ObjDepartamento->setEstado("Activo");
            if ($ObjDepartamento->update()) {
                header("Location: ../../Views/Modules/Departamento/index.php");
            } else {
                header("Location: ../../Views/Modules/Departamento/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Departamento/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function inactivate()
    {
        try {
            $ObjDepartamento = Departamento::searchForId($_GET['id_departamento']);
            $ObjDepartamento->setEstado("Inactivo");
            if ($ObjDepartamento->update()) {
                header("Location: ../../Views/Modules/Departamento/index.php");
            } else {
                header("Location: ../../Views/modules/Departamento/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Departamento/index.php?respuesta=error");
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
            //header("Location: ../Views/Modules/Municipio/manager.php?respuesta=error");
        }
    }
}