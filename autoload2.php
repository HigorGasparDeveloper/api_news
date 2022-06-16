<?php
spl_autoload_register(function($classe){
  $paths = [
    "../app/bd/",
    "../app/controllers/",
    "../app/core/",
    "../app/entity/",
    "../app/models/",
    "../../app/bd/",
    "../../app/controllers/",
    "../../app/core/",
    "../../app/entity/",
    "../../app/models/"
  ];
  foreach($paths as $path){
    if(file_exists($path."$classe.php")){
      require $path."$classe.php";
    }
  }
});
?>