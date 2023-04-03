<?php
require_once 'connect.php';

class ProductModel {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $id_tipo_produto;
    
    public static function insert($name, $typeProduct, $price){
        $database = Connection::getInstance();

        if ($database->isConnected()) {
            $sql = "INSERT INTO product (nmproduct, fkcdtypeproduct, price) VALUES ( '$name', $typeProduct, $price)";
            $result = $database->execute($sql);
            if ($result) {
                return "OK";
            } else {
                return "Erro";
            }  
        }
    }

    public static function selectProductAll(){
       $database = Connection::getInstance();

        if ( $database->isConnected()) {
            $result = $database->query("SELECT cdproduct, nmproduct, price, nmtypeproduct
                FROM product prod
                JOIN typeproduct type ON prod.fkcdtypeproduct = type.cdtypeproduct
                ORDER BY cdproduct, nmproduct ASC");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }else{
            echo "Erro ao conectar com o banco de dados.";
        }
    }

    public static function getProductById($cdProduct){
        $database = Connection::getInstance();

        if ($database->isConnected()) {
            $result = $database->query("SELECT cdproduct, nmproduct, price, tax 
                FROM product prod JOIN typeproduct type ON prod.fkcdtypeproduct = type.cdtypeproduct
                WHERE cdproduct=$cdProduct 
                ORDER BY cdproduct, nmproduct ASC");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }

    public static function delete($id){
        $database = Connection::getInstance();
 
        if ($database->isConnected()) {
        try{
            $sql = "DELETE FROM product WHERE cdproduct=$id";
            $result = $database->execute($sql);
            return $result;
        }catch(Exception $e){
            return 'Error:'.$e->getMessage();
        }
        }else{
            echo "Erro ao conectar com o banco de dados.";
        }
    }
}
?>