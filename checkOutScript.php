<?php
function submitOrder($firstName, $lastName, $emailAddress, $shipAddress, $shipAddress2, $shipCity, $shipState, $shipZipCode){
    include 'databaseQuery.php';
// BLOCK 1 - SAVE CUSTOMER

    $lineItems = $_SESSION['lineItems'];
//Customer Information


    $customerID = rand(0, 9) . rand(111, 999) . rand(111, 999) . rand(111, 999) . rand(0, 9);


    $insertNewCustomer = 'INSERT INTO customers (customerID, emailAddress, firstName, lastName, shipAddress, shipAddress2, 
                       shipCity, shipState, shipZipCode)
                       VALUES 
                              ("' . $customerID . '", "' . $emailAddress . '", "' . $firstName . '", "' . $lastName . '",
                              "' . $shipAddress . '", "' . $shipAddress2 . '", "' . $shipCity . '", "' . $shipState . '", "' . $shipZipCode . '");';

    saveCustomerOrder($insertNewCustomer);

// BLOCK 2  - SAVE ORDER

    $orderDateTime = date("Y-m-d h:i:s");
    $orderID = "OPO-" . rand(111, 999) . rand(111, 999) . rand(111, 999);
    $orderStatus = "PENDING";

    $_SESSION['customerOrderInfo'] = array($firstName, $lastName, $emailAddress, $shipAddress, $shipAddress2, $shipCity, $shipState, $shipZipCode, $orderID);

    $insertNewOrder = 'INSERT INTO customerOrders (orderID, orderDateTime, orderTotal, customerID, orderStatus) VALUES
("' . $orderID . '", "' . $orderDateTime . '","' . $_SESSION['grandTotal'] . '", "' . $customerID . '", "' . $orderStatus . '")';
    sendMail($orderID, $firstName, $lastName, $emailAddress, $shipAddress, $shipAddress2, $shipCity, $shipState, $shipZipCode);
    saveCustomerOrder($insertNewOrder);
    echo "<br /><br />";
//var_dump($_SESSION['lineItems']);

// BLOCK 2 - END
//BLOCK 3 - INSERT LINE ITEMS
    $cartToDB = $_SESSION['lineItems'];
    foreach ($cartToDB as $row) {
        $rowArray = [];
        foreach ($row as $key => $value) {
            if ($key === 'productID') {
                $value = '"' . $value . '"';
                array_push($rowArray, $value);
            }
            if ($key === 'quantity') {
                $value = '"' . $value . '"';
                array_push($rowArray, $value);
            }
            if ($key === 'lineTotal') {
                $value = '"' . $value . '"';
                array_push($rowArray, $value);
            }
        }
        $rowString = implode(', ', $rowArray);
//        echo $rowString;
//        echo "<br />";
        $insertItemQuery = 'INSERT INTO orderedLineItems (orderID, productID, quantity, lineTotal ) VALUES
                        ("' . $orderID . '", ' . $rowString . ' )';

        saveCustomerOrder($insertItemQuery);
        $rowArray = [];
    }


}

function sendMail($orderID, $firstName, $lastName, $emailAddress, $shipAddress, $shipAddress2, $shipCity, $shipState, $shipZipCode){
    $to = 'leatkins@aboveall-media.tech, '. $emailAddress;
    $subject = "HWG-Unlymited :: New Online Order";

    $message =
        '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HWG Unlymited - Completed Order</title>
</head>
<body style="background-color:black;width:100%">

<div style="padding:10%;margin-top:20px;margin-left:5%;width:70%;background-color:whitesmoke; border-radius:3em;text-align:center">

    <img src="https://hwg-unlymited.com/assets/web_img/coverAd_HWG.png" target="_blank" width="35%" alt="HWG-Unlymited">
    <a href="https://www.hwg-unlymited.com"><p>www.HWG-UNLYMITED.com</p></a>
    <hr/>
    <h1 style="color:orangered">NEW ONLINE ORDER CREATED </h1>
    <p><strong>Order Number: </strong>'.$orderID.'</p>
    <p><strong>Order Total: </strong>'.number_format($_SESSION['grandTotal'] ,2).'</p><br />
    
    <p><strong>SHIP TO</strong></p><hr />
    <p>'.$firstName .' '. $lastName. '| <a href="mailto:'.$emailAddress.'">'.$emailAddress.'</a></p>
    <p>'.$shipAddress.' '.$shipAddress2.'</p>
    <p>'.$shipCity.' '. $shipState .' '. $shipZipCode .'</p>
</div>

</body>
</html>
        ';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <no-reply@hwg-unlymited.com>' . "\r\n";

    mail($to,$subject,$message,$headers);

}
