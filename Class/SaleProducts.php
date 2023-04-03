<?php
if (!file_exists('Product.php')) {
    throw new Exception('Product.php não encontrado');
}

require_once 'Product.php';

class SaleProducts {
    public static $products = array();

    public static function addProduct($product) {
        session_start();

        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = array();
        }

        if (is_a($product, 'Product')) {
            array_push($_SESSION['products'], $product);
            return $_SESSION['products'];
        } else {
            throw new Exception('O parâmetro deve ser uma instância da classe Product');
        }
    }

    public static function getProducts() {
        session_start();
        return isset($_SESSION['products']) ? $_SESSION['products'] : array();
    }

    public static function clearProducts() {
        session_start();
        unset($_SESSION['products']);
    }
  
    public static function getTotal() {
        session_start();
        $total = 0;
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product) {
                $total += $product->getPrice();
            }
        }
        return $total;
    }

    public static function getTotalTax() {
        session_start();
        $total = 0;
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product) {
                $total += $product->getTotalPrice();
            }
        }
        return $total;
    }
}
?>
