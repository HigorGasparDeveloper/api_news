<?php 
namespace app\controllers;
use app\models\Noticia;
class NoticiaController{
  private $model;
  public function __construct(){
   $this->model = new Noticia(); 
  }

  public function listAll($get){
    $list = $this->model->list($get);
    returnJson("Success","List all news.", $list, 200);
  }

  public function postNew($data){
    // $data = protect($data);
    $verifica = verifyKey($data, ["title", "description", "image"]);
    if(!$verifica)
      returnJson("Error", "Key not found.", [], 400);
    $this->model->setTitle($data['title']);
    $this->model->setDescription($data['description']);
    $this->model->setImage($data['image']);
    $this->model->setUniqid();
    $this->model->insert();
  }
}
?>