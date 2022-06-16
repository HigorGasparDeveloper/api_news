<?php 
namespace app\controllers;

use app\models\TokenAccess;

class AuthController {
  private $model;
  public function __construct($token){
    $this->model = new TokenAccess();
    $this->model->setToken($token);
  }
  public function validate() {
    $response = $this->model->verifyToken();
    if($response[0]['message'] != 'OK')
      returnJson("Error",$response[0]['message'], [], 404);
  }
}
?>