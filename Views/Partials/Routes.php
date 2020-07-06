<?php
require('../../../vendor/autoload.php'); ?>
<?php
$dotenv = Dotenv\Dotenv::Create("../../../");
$dotenv->load();
$baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".getenv('ROOT_FOLDER');
//https://localhost/Proyecto-De-Grado-Optica/
$adminlteURL = $baseURL."/vendor/almasaeed2010/adminlte";
//https://localhost/WebER/vendor/almasaeed2010/adminlte
?>
