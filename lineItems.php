<?php
class ProductOrder {
    function __construct($productID, $productName, $prodDescription, $quantity){
        $this -> productID = $productID; 
        $this -> productName = $productName;
        $this -> prodDescription = $prodDescription;
        $this -> quantity = $quantity; 
    }
    function setItemPrice($inputPrice, $quantity){
        $this -> itemPrice = $inputPrice;
        $this -> lineTotal = $inputPrice * $quantity;
    }

}


