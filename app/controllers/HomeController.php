<?php 
namespace app\controllers;
class HomeController{
  public function welcome(){
    returnJson("Success","Welcome!",[],200);
  }
}
?>