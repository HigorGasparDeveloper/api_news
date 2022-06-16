<?php 
namespace app\models;
use app\bd\Connection;
class Noticia extends Connection{
  private $title, $description, $image, $uniqid, $id;
  //setters
  public function setId($id) {
    $this->id = $id;
  }

  public function setTitle(string $title){
    $this->title = $title;
  }

  public function setImage(string $image){
    $this->image = $image;
  }

  public function setDescription(string $description){
    $this->description = $description;
  }

  public function setUniqid(){
    $this->uniqid = uniqid("",true);
  }

  //getters
  private function getTitle(){
    return $this->title;
  }

  private function getDescription(){
    return $this->description;
  }

  private function getUniqid(){
    return $this->uniqid;
  }

  private function getImage(){
    return $this->image;
  }

  private function getId(){
    return $this->id;
  }

  public function list($args){
    $this->setTable("noticia");
    $this->setColumns(["*"]);
    $list = $this->selectTable(($args != '') ? " WHERE id = :id" : "", ($args != '') ? [":id"=>$args] : null);
    return $list;
  }

  public function insert(){
    $verificaVazio = verifyNull(["title"=>$this->getTitle(), "description"=>$this->getDescription()]);
    if($verificaVazio)
      returnJson("Error","Unfilled fields.",[],400);
    $this->setTable("noticia");
    $this->setColumns(["uniqid","title","description","image"]);
    $query = $this->insertTable(":uniqid, :title, :description, :image",[
      ":uniqid"=>$this->getUniqid(),
      ":title"=>$this->getTitle(),
      ":description"=>$this->getDescription(),
      ":image"=>($this->getImage() == "") ? NULL : $this->getImage()
    ]);
    if(!$query)
      returnJson("Error","Query error.", [],400);
    returnJson("Success","News successfully added.",["title"=>$this->getTitle(), "description"=>$this->getDescription(), "image"=>$this->getImage()],201);
  }
}
?>