require_once 'connect.php';

class SaleModel
{
    public static function saveSale($products, $total, $totalTax , $dateSale)
    {
        $database = Connection::getInstance();

        if ($database->isConnected()) {
            $sql = "INSERT INTO sales (amounttotal, taxtotal, dtsale) VALUES ($total, $totalTax, '$dateSale')";
            $result = $database->execute($sql);

            $cdSale = $database->lastInsertId();
            $conn = $database->getConnection();
 
            $sql = "INSERT INTO itenssale (fkcdsale, fkcdproduct, amount, valuetotal, taxtotal) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            foreach ($products as $item) {
                $cdProduct = $item->cdproduct;
                $amount = $item->amount;
                $price = $item->price;
                $taxtotal = $item->tax;
                $return = $stmt->execute([$cdSale, $cdProduct, $amount, $price, $taxtotal]);
            }
    
            if ($result) {
                return "OK";
            } else {
               return "Erro";
            }
        } else {
            echo "Erro ao conectar com o banco de dados.";
        }
    }
}
