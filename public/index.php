<?php  
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Content-Type, Origin");
  header('Content-Type: application/json');
  require "../vendor/autoload.php";
  require '../app/config/config.php';
  require '../app/functions/funcions.php';
  (new \app\core\RouterCore());
?>