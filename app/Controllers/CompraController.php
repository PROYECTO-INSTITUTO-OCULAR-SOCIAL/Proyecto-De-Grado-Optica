<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Compra.php');
require_once(__DIR__.'/../Models/Persona.php');

use App\Models\Compra;
use App\Models\Persona;
use Carbon\Carbon;

if(!empty($_GET['action'])){
    CompraController::main($_GET['action']);
}

class CompraController
{

    static function main($action)
    {
        if ($action == "Create") {
            CompraController::Create();
        } else if ($action == "edit") {
            CompraController::Edit();
        } else if ($action == "searchForId") {
            CompraController::searchForId($_REQUEST['id_compra']);
        } else if ($action == "searchAll") {
            CompraController::getAll();
        } else if ($action == "activate") {
            CompraController::activate();
        } else if ($action == "inactivate") {
            CompraController::inactivate();
        }/*else if ($action == "login"){
           CompraController::login();
        }else if($action == "cerrarSession"){
            CompraController::cerrarSession();
        }*/

    }

    static public function Create()
    {
        try {
            $arrayCompra = array();
            $arrayCompra['fecha'] =Carbon::parse($_POST['fecha']);
            $arrayCompra['valor_total'] = 0;
            $arrayCompra['Persona'] = Persona::searchForId($_POST['Persona']);

            $Compra = new Compra ($arrayCompra);

            if($Compra->Create()){
                header("Location: ../../Views/Modules/Compra/index.php?respuesta=correcto");
            }

        } catch (Exception $e) {
            header("Location: ../../views/modules/Compra/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function Edit()
    {
        try {
            $arrayCompra = array();
            $arrayCompra['fecha'] = Carbon::parse($_POST['fecha']);
            $arrayCompra['valor_total'] = $_POST['valor_total'];
            $arrayCompra['Persona'] =Persona::searchForId($_POST['persona']);
            $arrayCompra['id_compra'] = $_POST['id_compra'];

            $Compra= new Compra($arrayCompra);
            $Compra->update();

            header("Location: ../../Views/Modules/Compra/Show.php?id_compra=" .$Compra->getid_compra() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Compra/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }




    static public function searchForId($id_compra)
    {
        try {
            return Compra::searchForId($id_compra);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Compra/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Compra::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Compra/manager.php?respuesta=error");
        }
    }
}