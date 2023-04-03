<?php

require_once 'connect.php';

class TypeProductModel {

    public static function insert($name, $percent){
        $database = Connection::getInstance();

        if ($database->isConnected()) {
            $sql = "INSERT INTO typeproduct (nmtypeproduct, tax) VALUES ( '$name', $percent )";
            $result = $database->execute($sql);
            if ($result) {
                return "OK";
            } else {
               return "Erro";
            }
        }else{
            echo "Erro ao conectar com o banco de dados.";
        }
    }

    public static function selectTypeProductAll(){
       $database = Connection::getInstance();

        if ( $database->isConnected()) {
            $result = $database->query("SELECT cdtypeproduct, nmtypeproduct, tax FROM typeproduct ORDER BY cdtypeproduct, nmtypeproduct ASC");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }else{
            echo "Erro ao conectar com o banco de dados.";
        }
    }

    public static function delete($cdTypeProduct){
        $database = Connection::getInstance();
 
         if ($database->isConnected()) {
            try{
                $sql = "DELETE FROM typeproduct WHERE cdtypeproduct=$cdTypeProduct";
                $result = $database->execute($sql);

            }catch(Exception $e){
                return 'Error:'.$e->getMessage();
            }
        }else{
            echo "Erro ao conectar com o banco de dados.";
        }
    }
}
?>