<?php

namespace App\Controllers;
require(__DIR__.'/../Models/Categoria.php');
use App\Models\Categoria;

if(!empty($_GET['action'])){
    CategoriaController::main($_GET['action']);
}

class CategoriaController
{

    static function main($action)
    {
        if ($action == "create") {
            CategoriaController::Create();
        } else if ($action == "edit") {
            CategoriaController::Edit();
        } else if ($action == "searchForId") {
            CategoriaController::searchForId($_REQUEST['idCategoria']);
        } else if ($action == "searchAll") {
            CategoriaController::getAll();
        } else if ($action == "activate") {
            CategoriaController::activate();
        } else if ($action == "inactivate") {
            CategoriaController::inactivate();
        }/*else if ($action == "login"){
            UsuariosController::login();
        }else if($action == "cerrarSession"){
            UsuariosController::cerrarSession();
        }*/

    }

    static public function Create()
    {
        try {
            $arrayCategoria = array();
            $arrayCategoria['nombre'] = $_POST['nombre'];
            $arrayCategoria['estado'] = $_POST['estado'];
            if (!Categoria::CategoriaRegistrado($arrayCategoria['nombre'])) {
                $Categoria = new Categoria ($arrayCategoria);
                if ($Categoria->create()) {
                    header("Location: ../../views/Modules/Categoria/index.php?respuesta=correcto");
                }else{
                    echo "error";
                }
            } else {
                header("Location: ../../views/Modules/Categoria/Create.php?respuesta=error&mensaje=Categoria ya registrada");
            }
        } catch (Exception $e) {
            header("Location: ../../views/Modules/Categoria/Create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function Edit()
    {
        try {
            $arrayCategoria = array();
            $arrayCategoria['id_categoria'] = $_POST['id_categoria'];
            $arrayCategoria['nombre'] = $_POST['nombre'];
            $arrayCategoria['estado'] = $_POST['estado'];


            $user = new Categoria($arrayCategoria);
            $user->update();

            header("Location: ../../views/Modules/Categoria/Show.php?id=" . $user->getIdCategoria() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Categoria/Edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function activate()
    {
        try {
            $ObjCategoria = Categoria::searchForId($_GET['idCategoria']);
            $ObjCategoria->setestado("Activo");
            if ($ObjCategoria->update()) {
                header("Location: ../../views/Modules/Categoria/index.php");
            } else {
                header("Location: ../../views/Modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Categoria/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function inactivate()
    {
        try {
            $ObjCategoria = Categoria::searchForId($_GET['idCategoria']);
            $ObjCategoria->setestado("Inactivo");
            if ($ObjCategoria->update()) {
                header("Location: ../../views/modules/Categoria/index.php");
            } else {
                header("Location: ../../views/Modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/Modules/Categoria/index.php?respuesta=error");
        }
    }

    static public function searchForId($id_categoria)
    {
        try {
            return Categoria::searchForId($id_categoria);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/Modules/Categoria/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Categoria::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/Modules/Categoria/Categoria.php?respuesta=error");
        }
    }


    /*public static function personaIsInArray($idPersona, $ArrPersonas){
        if(count($ArrPersonas) > 0){
            foreach ($ArrPersonas as $Persona){
                if($Persona->getIdPersona() == $idPersona){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectPersona ($isMultiple=false,
                                          $isRequired=true,
                                          $id="idConsultorio",
                                          $nombre="idConsultorio",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrPersonas = array();
        if($where != ""){
            $base = "SELECT * FROM persona WHERE ";
            $arrPersonas = Persona::buscar($base.$where);
        }else{
            $arrPersonas = Persona::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrPersonas) > 0){
            foreach ($arrPersonas as $persona)
                if (!UsuariosController::personaIsInArray($persona->getIdPersona(),$arrExcluir))
                    $htmlSelect .= "<option ".(($persona != "") ? (($defaultValue == $persona->getIdPersona()) ? "selected" : "" ) : "")." value='".$persona->getIdPersona()."'>".$persona->getNombres()." ".$persona->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }*/

    /*
    public function buscar ($Query){
        try {
            return Persona::buscar($Query);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    static public function asociarEspecialidad (){
        try {
            $Persona = new Persona();
            $Persona->asociarEspecialidad($_POST['Persona'],$_POST['Especialidad']);
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=correcto&id=".$_POST['Persona']);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function eliminarEspecialidad (){
        try {
            $ObjPersona = new Persona();
            if(!empty($_GET['Persona']) && !empty($_GET['Especialidad'])){
                $ObjPersona->eliminarEspecialidad($_GET['Persona'],$_GET['Especialidad']);
            }else{
                throw new Exception('No se recibio la informacion necesaria.');
            }
            header("Location: ../Vista/modules/persona/managerSpeciality.php?id=".$_GET['Persona']);
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    public static function login (){
        try {
            if(!empty($_POST['Usuario']) && !empty($_POST['Contrasena'])){
                $tmpPerson = new Persona();
                $respuesta = $tmpPerson->Login($_POST['Usuario'], $_POST['Contrasena']);
                if (is_a($respuesta,"Persona")) {
                    $hydrator = new ReflectionHydrator(); //Instancia de la clase para convertir objetos
                    $ArrDataPersona = $hydrator->extract($respuesta); //Convertimos el objeto persona en un array
                    unset($ArrDataPersona["datab"],$ArrDataPersona["isConnected"],$ArrDataPersona["relEspecialidades"]); //Limpiamos Campos no Necesarios
                    $_SESSION['UserInSession'] = $ArrDataPersona;
                    echo json_encode(array('type' => 'success', 'title' => 'Ingreso Correcto', 'text' => 'Sera redireccionado en un momento...'));
                }else{
                    echo json_encode(array('type' => 'error', 'title' => 'Error al ingresar', 'text' => $respuesta)); //Si la llamda es por Ajax
                }
                return $respuesta; //Si la llamada es por funcion
            }else{
                echo json_encode(array('type' => 'error', 'title' => 'Datos Vacios', 'text' => 'Debe ingresar la informacion del usuario y contraseña'));
                return "Datos Vacios"; //Si la llamada es por funcion
            }
        } catch (Exception $e) {
            var_dump($e);
            header("Location: ../login.php?respuesta=error");
        }
    }

    public static function cerrarSession (){
        session_unset();
        session_destroy();
        header("Location: ../Vista/modules/persona/login.php");
    }*/

}
