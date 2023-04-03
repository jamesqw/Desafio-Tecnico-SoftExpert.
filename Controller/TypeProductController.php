<?php
require_once 'Model/TypeProductModel.php';
require_once 'Controller/SaleController.php';

Class TypeProductController{

    public static function selectTypeProductAll(){
        return TypeProductModel::selectTypeProductAll();
    }

    public static function insert($nameType, $percent){
        return TypeProductModel::insert($nameType, $percent);
    }
   
    public static function deleteTypeProduct($cdtype){
        $return =TypeProductModel::delete($cdtype);
        if (strstr($return, "Foreign key violation")) {
            $return = array('return' => "Foreign key violation");
         } else{
            $return = array('return' => "OK");
        }
        return $return;
    }
}
?>