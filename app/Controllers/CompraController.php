<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Compra.php');
require(__DIR__.'/../Models/Persona.php');
use App\Models\Compra;
use App\Models\Persona;

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
            $arrayCompra['fecha'] = date('Y-m-d H:i:s'); //Fecha Completa Hoy
            $arrayCompra['valor_total'] = $_POST['valor_total'];
            $arrayCompra['persona'] = Persona::searchForId($_POST['persona']);

            if (!Compra::CompraRegistrado($arrayCompra['fecha'])) {
                $Compra = new Compra ($arrayCompra);
                if ($Compra->create()) {
                    header("Location: ../../Views/Modules/Compra/index.php?respuesta=correcto");
                } else{echo "Error";}
            } else {
                header("Location: ../../Views/Modules/Compra/Create.php?respuesta=error&mensaje=Compra ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/Modules/Compra/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit()
    {
        try {
            $arrayCompra = array();
            $arrayCompra['fecha'] = date('Y-m-d H:i:s');
            $arrayCompra['valor_total'] = $_POST['valor_total'];
            $arrayCompra['persona'] =Persona::searchForId($_POST['persona']);
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