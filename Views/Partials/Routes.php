<?php
//$RutaAbsoluta = "\Proyecto-De-Grado-Optica\views\index.php"; //https://www.php.net/manual/es/regexp.reference.escape.php
//$RutaRelativa = "../index.php";

//Carga las librerias importadas del composer
require(__DIR__ .'/../../vendor/autoload.php');
//__DIR__ => D:\laragon\www\Proyecto-De-Grado-Optica\views\partials
?>
<?php
$dotenv = Dotenv\Dotenv::create(__DIR__ ."../../../"); //Cargamos el archivo .env de la raiz del sitio
$dotenv->load(); //Carga las variables del archivo .env


$baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".getenv('ROOT_FOLDER');
//https://localhost/Proyecto-De-Grado-Optica/
$adminlteURL = $baseURL."/vendor/almasaeed2010/adminlte";
//https://localhost/Proyecto-De-Grado-Optica/vendor/almasaeed2010/adminlte
?>