<?php

class Product {
    public $cdproduct;
    public $nmproduct;
    public $amount;
    public $price;
    public $tax;
    public $taxValue;

    public function __construct($cdproduct, $nmproduct, $amount, $price, $tax, $taxValue) {
        $this->cdproduct = $cdproduct;
        $this->nmproduct = $nmproduct;
        $this->amount = $amount;
        $this->price = $price;
        $this->tax = $tax;
        $this->taxValue = $taxValue;
    }

    public function getProduct(){
   
       return array(
            "cdproduct" =>  $this->cdproduct,
            "nmproduct" => $this->nmproduct,
            "amount" => $this->amount ,
            "price" => $this->price,
            "tax" => $this->tax,
            "taxValue" => $this->taxValue 
        );
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTax() {
        return $this->tax;
    }

    public function getTotalPrice() {
        return $this->getPrice() * ($this->getTax() / 100);
    }

    public function getPriceTax(){
        $this->price = $this->price * $this->amount;
        $total = $this->getTotalPrice();
        $this->taxValue =  $total;
        return  $this->taxValue;
    }
}
?>