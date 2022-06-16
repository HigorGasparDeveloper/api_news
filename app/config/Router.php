<?php 
  $this->get('/', "HomeController@welcome");
  $this->get('/news', "NoticiaController@listAll");
  $this->post('/news', "NoticiaController@postNew");
?>