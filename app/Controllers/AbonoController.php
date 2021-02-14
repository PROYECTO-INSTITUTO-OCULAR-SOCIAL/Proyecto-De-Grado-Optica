<?php

namespace app\Controllers;
require_once(__DIR__.'/../Models/Abono.php');




require_once(__DIR__.'/../Models/Abono.php');


use app\Models\Abono;
use App\Models\GeneralFunctions;


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
        }
    }

    static public function Create()
    {
        try {
            $arrayAbono = array();
            $arrayAbono['fecha'] = date('Y-m-d'); //Fecha
            $arrayAbono['valor'] = 0;
            $Abono = new Abono($arrayAbono);
            if ($Abono->Create()) {
                header("Location: ../../Views/Modules/Abono/Create.php?id_abono=" . $Abono->getid_abono());
            }
        } catch (Exception $e) {
            GeneralFunctions::console($e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Abono/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit()
    {
        try {
            $arrayAbono = array();
            $arrayAbono['fecha'] = $_POST['fecha'];
            $arrayAbono['valor'] = $_POST['valor'];
            $arrayAbono['id_abono'] = $_POST['id_abono'];

            $Abono = new Abono($arrayAbono);
            $Abono->update();

            header("Location: ../../Views/Modules/Abono/Show.php?id_abono=" . $Abono->getid_abono() . "&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Abono/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function searchForid_abono($id_abono)
    {
        try {
            return Abono::searchForid_abono($id_abono);
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'error', 'errorStack');
            //header("Location: ../../Views/Modules/Abono/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Abono::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'log', 'errorStack');
            header("Location: ../Views/Modules/Abono/manager.php?respuesta=error");
        }
    }
}