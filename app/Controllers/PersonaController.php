<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Persona.php');
require_once(__DIR__.'/../Models/Municipio.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');
use App\Models\Departamento;
use App\Models\GeneralFunctions;
use App\Models\Municipio;
use App\Models\Persona;

if(!empty($_GET['action'])){
    PersonaController::main($_GET['action']);
}

class PersonaController
{

    static function main($action)
    {
        if ($action == "create") {
            PersonaController::Create();
        } else if ($action == "edit") {
            PersonaController::Edit();
        } else if ($action == "searchForID") {
            PersonaController::searchForID($_REQUEST['id_persona']);
        } else if ($action == "searchAll") {
            PersonaController:: getAll();
        } else if ($action == "activate") {
            PersonaController::activate();
        } else if ($action == "inactivate") {
            PersonaController::inactivate();
        }

    }

    static public function Create()
    {
        try {
            $arrayPersona = array();
            $arrayPersona['tipo_documento'] = $_POST['tipo_documento'];
            $arrayPersona['documento'] = $_POST['documento'];
            $arrayPersona['nombre'] = $_POST['nombre'];
            $arrayPersona['apellido'] = $_POST['apellido'];
            $arrayPersona['direccion'] = $_POST['direccion'];
            $arrayPersona['telefono'] = $_POST['telefono'];
            $arrayPersona['municipio'] = Municipio::searchForId($_POST['municipio']);
            $arrayPersona['rol'] = $_POST['rol'];
            $arrayPersona['contrasena'] = $_POST['contrasena'];
            $arrayPersona['estado'] = $_POST['estado'];
            $Persona = new Persona($arrayPersona);
            if ($Persona->create()) {
                header("Location: ../../Views/Modules/Persona/index.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            GeneralFunctions::console($e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Persona/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit()
    {
        try {
            $arrayPersona = array();
            $arrayPersona['tipo_documento'] = $_POST['tipo_documento'];
            $arrayPersona['documento'] = $_POST['documento'];
            $arrayPersona['nombre'] = $_POST['nombre'];
            $arrayPersona['apellido'] = $_POST['apellido'];
            $arrayPersona['direccion'] = $_POST['direccion'];
            $arrayPersona['telefono'] = $_POST['telefono'];
            $arrayPersona['municipio'] = Municipio::searchForId($_POST['municipio']);
            $arrayPersona['rol'] = $_POST['rol'];
            $arrayPersona['contrasena'] = $_POST['contrasena'];
            $arrayPersona['estado'] = $_POST['estado'];
            $arrayPersona['id_persona'] = $_POST['id_persona'];
            $Persona = new Persona($arrayPersona);
            $Persona->update();

            header("Location: ../../Views/Modules/Persona/Show.php?id_persona=" . $Persona->getIdPersona() . "&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'error', 'errorStack');
            header("Location: ../../Views/Modules/Persona/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function getAll()
    {
        try {
            return Persona::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console($e, 'log', 'errorStack');
            header("Location: ../Vista/Modules/Persona/manager.php?respuesta=error");
        }
    }

    static public function activate()
    {
        try {
            $ObjPersona = Persona::searchForID($_GET['id_persona']);
            if ($ObjPersona->update()) {
                header("Location: ../../Views/Modules/Persona/index.php");
            } else {
                header("Location: ../../Views/Modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Persona/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function inactivate()
    {
        try {
            $ObjPersona = Persona::searchForId($_GET['id_persona']);
            if ($ObjPersona->update()) {
                header("Location: ../../Views/Modules/Persona/index.php");
            } else {
                header("Location: ../../Views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/Modules/Persona/index.php?respuesta=error");
        }
    }

    static public function searchForID($id)
    {
        try {
            return Persona::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../Views/Modules/Persona/manager.php?respuesta=error");
        }
    }

    public static function PersonaIsInArray($id_Persona, $ArrPersona)
    {
        if (count($ArrPersona) > 0) {
            foreach ($ArrPersona as $Persona) {
                if ($Persona->getIdPersona() == $id_Persona) {
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectPersona($isMultiple = false,
                                         $isRequired = true,
                                         $id = "id_persona",
                                         $nombre = "id_persona",
                                         $defaultValue = "",
                                         $class = "",
                                         $where = "",
                                         $arrExcluir = array())
    {
        $arrPersona = array();
        if ($where != "") {
            $base = "SELECT * FROM Persona WHERE ";
            $arrPersona = Persona::search($base . $where);
        } else {
            $arrPersona = Persona:: getAll();
        }

        $htmlSelect = "<select " . (($isMultiple) ? "multiple" : "") . " " . (($isRequired) ? "required" : "") . " id= '" . $id . "' name='" . $nombre . "' class='" . $class . "'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (count($arrPersona) > 0) {
            foreach ($arrPersona as $Persona)
                if (!PersonaController::PersonaIsInArray($Persona->getIdPersona(), $arrExcluir))
                    $htmlSelect .= "<option " . (($Persona != "") ? (($defaultValue == $Persona->getIdPersona()) ? "selected" : "") : "") . " value='" . $Persona->getIdPersona() . "'> - " . $Persona->getNombre() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
}
