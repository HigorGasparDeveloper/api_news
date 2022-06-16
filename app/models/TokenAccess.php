<?php 
namespace app\models;

use app\bd\Connection;

class TokenAccess extends Connection {
  private $token;
  public function setToken(string $token) {
    $this->token = $token;
  }

  private function getToken() { return $this->token; }

  public function verifyToken() {
    $this->setTable("tk_api");
    $this->setColumns(["(
      CASE
        WHEN COUNT(*) = 0 OR isValid = 0
            THEN
          'API key not valid. Please pass a valid API key.'
            ELSE
          'OK'
      END) as message"]);
    $list = $this->selectTable(" WHERE token = :token", [":token"=>$this->getToken()]);
    return $list;
  }
}

?>