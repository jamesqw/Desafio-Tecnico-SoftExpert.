<?php

namespace MyApp\Controllers;

use MyApp\Models\ProductModel;
use MyApp\Controllers\SaleManager;

class ProductController
{
    public static function getProductById($productId, $amount)
    {
        $product = ProductModel::getProductById($productId);

        if (!empty($product)) {
            $productArray = SaleManager::addProductSale($product, $amount);
        } else {
            $productArray = ['findProduct' => false];
        }
        
        return $productArray;
    }

    public static function selectAllProducts()
    {
        return ProductModel::selectAllProducts();
    }

    public static function insertProduct($productName, $productType, $price)
    {
        return ProductModel::insertProduct($productName, $productType, $price);
    }

    public static function deleteProduct($productId)
    {
        $result = ProductModel::deleteProduct($productId);
        
        if (strstr($result, "Foreign key violation")) {
            throw new \Exception("Foreign key violation");
        }
        
        return ['return' => 'OK'];
    }
}
