<?php

require_once './Class/Product.php';
require_once './Class/SaleProducts.php';
require_once './Model/SaleModel.php';

class SaleController 
{
    public static function addProductSale($sale, $amount)
    {
        $product = new Product($sale[0]['cdproduct'], $sale[0]['nmproduct'], $amount, $sale[0]['price'], $sale[0]['tax'], '');
        $product->getPriceTax();
       
        SaleProducts::addProduct($product);
        return ['findProduct' => true];
    }

    public static function saveSale()
    {
        $products = SaleProducts::getProducts(); 
        $total = SaleProducts::getTotal();
        $totalTax = SaleProducts::getTotalTax(); 
        $dateSale = date('Y-m-d');

        $return = SaleModel::saveSale($products, $total, $totalTax, $dateSale);   
        return $return;
    }

    public static function clearProducts()
    {
        SaleProducts::clearProducts();
    }

    public static function getSaleProducts()
    {
        $products = SaleProducts::getProducts(); 
        $total = SaleProducts::getTotal();
        $totalTax = SaleProducts::getTotalTax();       

        return [
            'products' => $products,
            'total' => $total,
            'taxTotal' => $totalTax
        ];
    }
}
