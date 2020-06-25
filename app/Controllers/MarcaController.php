<?php
namespace App\Controllers;
require(__DIR__ . '/../Models/Marca.php');
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
            $arrayMarca['estado'] = 'Activo';
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

            $user = new Marca($arrayMarca);
            $user->update();

            header("Location: ../../views/Modules/Marca/Show.php?id=".$user->getid_marca()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Marca/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activo(){
        try {
            $ObjMarca = Marca::searchForid_marca($_GET['id_marca']);
            $ObjMarca->setestado("Activo");
            if($ObjMarca->update()){
                header("Location: ../../views/Modules/Marca/index.php");
            }else{
                header("Location: ../../views/Modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Marca/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivo (){
        try {
            $ObjMarca = Marca::searchForid_marca($_GET['id_marca']);
            $ObjMarca->setestado("Inactivo");
            if($ObjMarca->update()){
                header("Location: ../../views/Modules/Marca/index.php");
            }else{
                header("Location: ../../views/Modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Marca/index.php?respuesta=error");
        }
    }

    static public function searchForid_marca ($id_marca){
        try {
            return Marca::searchForid_marca($id_marca);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/Modules/Marca/Marca.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Marca::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/Modules/Marca/Marca.php?respuesta=error");
        }
    }


}