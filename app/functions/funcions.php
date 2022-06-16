<?php 
function dd($var, $die = false){
  echo "<pre>";
    var_dump($var);
  echo "</pre>";
  if($die)
    die();
}
function returnJson(string $status, string $message, array $data, int $http_response_code){
  http_response_code($http_response_code);
  die(json_encode([
    "Status"=> $status,
    "Message"=> $message,
    "Data"=> $data
  ],JSON_UNESCAPED_UNICODE));
}
function verifyKey(array $array, array $keys){
  $verifica = true;
  foreach($array as $key=>$data){
    if(!in_array($key,$keys)){
      $verifica = false;
      break;
    }
  }
  return $verifica;
}
function verifyNull(array $dados){
    $verifica = false;
    foreach($dados as $data){
        if($data == "" || $data == NULL)
            $verifica = true;
   }
    return $verifica;
}
?>