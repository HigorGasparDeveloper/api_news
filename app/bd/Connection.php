<?php
namespace app\bd;
abstract class Connection {
    protected $conn, $table, $columns = array();
    protected function setTable(string $table){
      $this->table = $table;
    }
    
    protected function setColumns(array $columns){
      $this->columns = $columns;
    }

    public function __construct(){
      try{
        $this->conn = new \PDO(DB_DRIVER .":host=" . DB_HOST . ";port=" . PORT . ";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
      }catch(\PDOException $e){
        die(json_encode([
          "Status"=>"Error",
          "Message"=>"Erro de conexão com o banco de dados. Log: ".$e->getMessage()
        ]));
      }
    }

    protected function selectTable(string $where,$args){
      $columns = implode(",", $this->columns);
      $sql = "SELECT " . $columns . " from " . $this->table . $where;
      $query = $this->conn->prepare($sql);
      $query->execute($args);
      if(!$query) returnJson("Error", "Query not worked.",[],400);
      return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function insertTable($args, $params){
        $columns = implode(',', $this->columns);
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES (".$args.")";
        $query = $this->conn->prepare($sql);
        return $query->execute($params);
    }
  }
?>