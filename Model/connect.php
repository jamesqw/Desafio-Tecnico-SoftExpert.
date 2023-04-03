<?php
class Connection {
    private static $instance = null;
    private $conn;
    
    // Método construtor privado para evitar a criação de novas instâncias.
    private function __construct() {
        $jsonString = file_get_contents('./databaseConfig.json');
        $config = json_decode($jsonString, true);
        $host = $config['database']['host'];
        $user = $config['database']['user'];
        $password = $config['database']['password'];
        $dbname = $config['database']['databaseName'];

        $this->conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    // Design Pattern - Singleton 
    //Método estático público que retorna a instância única da classe.
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }

    public function isConnected() {
        $status= str_contains($this->conn->getAttribute(PDO::ATTR_CONNECTION_STATUS),'Connection OK');
        return (bool) $status;
    }

    public function query($sql) {
      return $this->conn->query($sql);
    }

    public function execute($sql) {
        $smt = $this->conn->prepare($sql);
        return $smt->execute();
    }

    public function prepare($sql){
        $smt = $this->conn->prepare($sql);
        return $smt;
    }

    public function executeAll($sql){
        return $this->conn->execute();
    }

    public function lastInsertId(){
        return $this->conn->lastInsertId();
    }

    public function close() {
        $this->conn->close();
    }
  }
?>