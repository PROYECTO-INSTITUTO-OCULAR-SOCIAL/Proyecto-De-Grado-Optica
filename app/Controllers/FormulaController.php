<?php

namespace app\Controllers;
require(__DIR__.'/../Models/Formula.php');
use app\Models\Formula;

if(!empty($_GET['action'])){
    FormulaController::main($_GET['action']);
}

class FormulaController{

    static function main($action)
    {
        if ($action == "create") {
            FormulaController::create();
        } else if ($action == "edit") {
            FormulaController::edit();
        } else if ($action == "searchForID") {
            FormulaController::searchForID($_REQUEST['idFormula']);
        } else if ($action == "searchAll") {
            FormulaController::getAll();
        }
    }

    static public function create()
    {
        try {
            $arrayFormula = array();
            $arrayFormula['od_esfera'] = $_POST['od_esfera'];
            $arrayFormula['oi_esfera'] = $_POST['oi_esfera'];
            $arrayFormula['od_cilindro'] = $_POST['od_cilindro'];
            $arrayFormula['oi_cilindro'] = $_POST['oi_cilindro'];
            $arrayFormula['od_eje'] = $_POST['od_eje'];
            $arrayFormula['oi_eje'] = $_POST['oi_eje'];
            $arrayFormula['od_av'] = $_POST['od_av'];
            $arrayFormula['oi_av'] = $_POST['oi_av'];
            $arrayFormula['dp'] = $_POST['dp'];
            $arrayFormula['color'] = $_POST['color'];
            $arrayFormula['numero_montura'] = $_POST['numero_montura'];
            $arrayFormula['observaciones'] = $_POST['observaciones'];
            $arrayFormula['bifocal'] = $_POST['bifocal'];
            $arrayFormula['material'] = $_POST['material'];
            $arrayFormula['valor'] = $_POST['valor'];

            if(!Formula::FormulaRegistrado($arrayFormula['id_formula'])){
                $Formula = new Formula ($arrayFormula);
                if($Formula->create()){
                    header("Location: ../../Views/Modules/Formula/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../Views/Modules/Formula/Create.php?respuesta=error&mensaje=Formula ya registrada");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/Modules/Formula/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayFormula = array();
            $arrayFormula['od_esfera'] = $_POST['od_esfera'];
            $arrayFormula['oi_esfera'] = $_POST['oi_esfera'];
            $arrayFormula['od_cilindro'] = $_POST['od_cilindro'];
            $arrayFormula['oi_cilindro'] = $_POST['oi_cilindro'];
            $arrayFormula['od_eje'] = $_POST['od_eje'];
            $arrayFormula['oi_eje'] = $_POST['oi_eje'];
            $arrayFormula['od_av'] = $_POST['od_av'];
            $arrayFormula['oi_av'] = $_POST['oi_av'];
            $arrayFormula['dp'] = $_POST['dp'];
            $arrayFormula['color'] = $_POST['color'];
            $arrayFormula['numero_montura'] = $_POST['numero_montura'];
            $arrayFormula['observaciones'] = $_POST['observaciones'];
            $arrayFormula['bifocal'] = $_POST['bifocal'];
            $arrayFormula['material'] = $_POST['material'];
            $arrayFormula['valor'] = $_POST['valor'];
            $arrayFormula['id_formula'] = $_POST['id_formula'];

            $user = new Formula($arrayFormula);
            $user->update();

            header("Location: ../../Views/Modules/Formula/Show.php?id=".$user->getidFormula()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Formula/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    static public function searchForID ($id_formula)
    {
        try {
            return Formula::searchForid_formula($id_formula);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Formula/manager.php?respuesta=error");
        }
    }
}
