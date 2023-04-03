<?php
require_once 'Controller/SaleController.php';
require_once 'Controller/ProductController.php';
require_once 'Controller/TypeProductController.php';

    switch ($_REQUEST['endpoint']) {
        case 'selectTypeProduct':
            $return = TypeProductController::selectTypeProductAll();
            echo json_encode($return);
            break;
        case 'insertTypeProduct':
            $return = TypeProductController::insert($_REQUEST['nameType'], $_REQUEST['percent']);
            echo json_encode($return);
            break;
        case 'delTypeProduct':
            $return = TypeProductController::deleteTypeProduct($_REQUEST['idItem']);
            echo json_encode($return);
            break;
        case 'listProducts':
            $return = ProductController::selectProductAll();
            echo json_encode($return);
            break;
        case 'addProduct':
            $return = ProductController::insert($_REQUEST['nameProduct'], $_REQUEST['typeProduct'],$_REQUEST['price']);
            echo json_encode($return);
            break;
        case 'getProductbyId':
            $return = ProductController::getProductId($_REQUEST['cdProduct'], $_REQUEST['amountProduct']);
            echo json_encode($return);
            break;
        case 'delProduct':
            $return = ProductController::deleteProduct($_REQUEST['idItem']);
            echo json_encode($return);
            break;
        case 'listProductSale':
            $return = SaleController::getSaleProducts();
            echo json_encode($return);
            break;
        case 'saveSale':
            $return = SaleController::saveSale();
            echo json_encode($return);
            break;
        case 'clearProductsSale':
            $return = SaleController::clearProducts();
            echo json_encode($return);
            break;
         default:
            return json_encode(array('error' => 'Invalid action'));
            break;
    }
?>