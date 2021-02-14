<?php
namespace app\Controllers;
require_once(__DIR__.'/../Models/Formula.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');
use App\Models\Departamento;
use App\Models\Formula;
use App\Models\GeneralFunctions;
use App\Models\Municipio;

if(!empty($_GET['action'])){
    FormulaController::main($_GET['action']);
}

class FormulaController
{

    static function main($action)
    {
        if ($action == "create") {
            FormulaController::Create();
        } else if ($action == "edit") {
            FormulaController::Edit();
        } else if ($action == "searchForID") {
            FormulaController::searchForID($_REQUEST['id_formula']);
        } else if ($action == "searchAll") {
            FormulaController:: getAll();
        } else if ($action == "activate") {
            PersonaController::activate();
        } else if ($action == "inactivate") {
            PersonaController::inactivate();
        }
    }

    static public function Create()
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

            $Formula = new Formula($arrayFormula);
            if($Formula->create()){
                header("Location: ../../Views/Modules/Formula/index.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Formula/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit (){
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

            $Formula = new Formula($arrayFormula);
            $Formula->update();

            header("Location: ../../Views/Modules/Formula/Show.php?id_formula=".$Formula->getIdFormula()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Formula/Edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate()
    {
        try {
            $ObjFormula = Formula::searchForID($_GET['id_formula']);
            if ($ObjFormula->update()) {
                header("Location: ../../Views/Modules/Formula/index.php");
            } else {
                header("Location: ../../Views/Modules/Formula/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Formula/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    static public function inactivate()
    {
        try {
            $ObjFormula = Formula::searchForId($_GET['id_formula']);
            if ($ObjFormula->update()) {
                header("Location: ../../Views/Modules/Formula/index.php");
            } else {
                header("Location: ../../Views/modules/Formula/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Persona/index.php?respuesta=error");
        }
    }

    static public function getAll ()
    {
        try {
            return Formula::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'log', 'errorStack');
            header("Location: ../Vista/Modules/Formula/manager.php?respuesta=error");
        }
    }

    static public function searchForID($id)
    {
        try {
            return Formula::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Formula/manager.php?respuesta=error");
        }
    }
    public static function FormulaIsInArray($id_formula, $ArrFormula){
        if(count($ArrFormula) > 0){
            foreach ($ArrFormula as $Formula){
                if($Formula->getIdFormula() == $id_formula){
                    return true;
                }
            }
        }
        return false;
    }
}
