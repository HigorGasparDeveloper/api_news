<?php 
  namespace app\core;

  use app\controllers\AuthController;

  class RouterCore {
    private $uri, $method, $router = [], $routerPost = [], $headers;
    public function __construct()
    {
      $this->start();
      require '../app/config/Router.php';
      $this->execute();
    }

    private function getHeaders() {
      $this->headers = apache_request_headers();
      if(!isset($this->headers['x-api-key']))
        returnJson("Error","The request is missing a valid API key.", [] ,404);
      $aut = new AuthController($this->headers['x-api-key']);
      $aut->validate();
    }
    
    private function start(){
      $this->method = $_SERVER['REQUEST_METHOD'];
      $this->uri = str_replace("/api's/php/api_news", "", $_SERVER['REQUEST_URI']);
      $this->uri = (substr($this->uri, strlen($this->uri)- 1, 1) == '/' && $this->uri != '/') ? substr($this->uri, 0, strlen($this->uri) - 1) : $this->uri;
      $this->getHeaders();
    }
    public function get($var, $isCallable){
      $this->router[] = [
        'router'=>$var,
        'call'=>$isCallable
      ];
    }
    public function post($var, $isCallable){
      $this->routerPost[] = [
        'router'=> $var,
        'call'=> $isCallable
      ];
    }
    private function executeGet(){
      $param = explode("/", $this->uri);
      if(array_search($this->uri, array_column($this->router, 'router')) === false && !isset($param[2])){
        returnJson("Error", "Invalid URI.",[],404);
      }
      $param = (isset($param[2]) && $param[2] != '') ? $param[2] : '/';
      if($param != '/')
        $this->uri = str_replace("/".$param, "", $this->uri);
      foreach($this->router as $rout){
        if($this->uri == $rout['router']){
          if(is_callable($rout['call'])){ //se for "chamável"
            $rout['call']();
            break;
          }else{ 
            self::callController($rout['call'],$param);
          }
        }
      }
    }
    private function executePost(){
      if(array_search($this->uri, array_column($this->routerPost, 'router')) === false){
        returnJson("Error", "Invalid URI.",[],404);
      }
      $post = (isset($_POST) && count($_POST) > 0) ? $_POST  : json_decode(file_get_contents("php://input"),true);
      if($post != NULL && count($post) > 0){
        foreach($this->routerPost as $rout){
          if($this->uri == $rout['router']){
            if(is_callable($rout['call'])){ //se for "chamável"
              $rout['call']();
              break;
            }else{ 
              self::callController($rout['call'],$post);
            }
          }
        }
      }
    }
    private static function callController($call,$param){
      $call = explode("@",$call);
      $class = "\\app\\controllers\\".$call[0];
      $method = $call[1];
      if(!class_exists($class))
        returnJson("Error", "Class not found.", [], 404);
      if(!method_exists($class, $method))
        returnJson("Error","Method not found.",[],404);
      $controller = new $class();
      call_user_func_array([$controller, $method],[($param != '/') ? $param : '']);
    }
    private function execute(){
      switch($this->method){
        case 'GET':
          $this->executeGet();
          break;
        case 'POST':
          $this->executePost();
          break;
      }
    }
  }
?>