<?php
session_start();
require 'env.php';

function displaySingleProd($sql)
{
    $getProduct = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($getProduct->connect_error) {
        echo "Failed to establish a connection. Please try again later";
    }

    $singleProduct = $getProduct->query($sql);

    if ($singleProduct->num_rows > 0) {
        while ($row = $singleProduct->fetch_assoc()) {
            if ($row['prodDescription'] == "Women's Roll On Fragrance - 1oz" || $row['prodDescription'] == "Women's Roll On Fragrance - 3oz" ){
                $longDescription="Women fragrances releases a dainty, bold aroma, along with mixes of fresh smelling 
                flowers, fresh linen, soft, and fruity long lasting oil scent that awakens your atmosphere.";
            }
            if ($row['prodDescription'] == "Men's Roll On Fragrance - 1oz" || $row['prodDescription'] == "Men's Roll On Fragrance - 3oz" ){
                $longDescription="Jason’s UnLymited men fragrances are smooth textures and manly scents of soft wood, 
                fresh linen, a touch of sweet, and spice, yet masculine enough to reach the senses of satisfaction.";
            }
            if ($row['productCategory'] == 'BurningOil'){
                $longDescription="I am the joy that relaxes your senses, and that which sets the tone for your 
                environment! What am I? I am your aroma! or burning oil aroma!";
            }
            echo '<div class="row">
                    <div class="col-sm-4">
                        <img src="' . $row['prodImageURL'] . '" alt="Product Image" width="200px" />
                    </div>
                    <div class="col-sm-6" style="padding-top:5%">
                        <h2>' . $row['prodName'] . '</h2>
                        <p style="color:darkgrey">' . $row['prodDescription'] . '</p>
                        <p>'.$longDescription.'</p>
                        <h2>$ ' . $row['price'] . '.00</h2>';
            if ($row['inventoryCount'] <= 0) {
                echo '<h1 style="color:orangered">Currently out of stock</h1></div></div>';
            } else {
                echo '<p>
                        <form class="form-control" method="POST" action="hwgCart.php">
                        <strong>Quantity: </strong> &nbsp; 
                            <input class="input-group-sm" name="quantity" value="1" id="quantity" type="number" required/> 
                                <button class="btn btn-warning" name="addToCart" type="submit">Add To Cart</button>
                      </p>
                            <span style="color:orangered"><strong>' . $row['inventoryCount'] . ' In Stock</strong></span>
                            <br/>
                            <input type="hidden" name="productID" id="productID" value="' . $_GET['productID'] . '" />
                            <input type="hidden" name="prodName" id="prodName" value="' . $row['prodName'] . '" />
                            <input type="hidden" name="prodDescription" id="prodDescription" value="' . $row['prodDescription'] . '" />
                            <input type="hidden" name="price" id="price" value="' . $row['price'] . '" />
                        </form>
                    </div>
                  </div>';
            }
        }
        $getProduct->close();

    } else {
        echo '<div class="text-center">
                <h1 style="color:orangered">Unfortunately, that item does not exist in our system</h1>
                </div>';
    }
}

function loginCheck($sql)
{
    $loginCheck = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($loginCheck->connect_error) {
        echo '<p style="color:orangered">Unable to establish connection. Please try again later or contact the administrator</p>';
    }
    $checkUser = $loginCheck->query($sql);
    if ($checkUser->num_rows > 0) {
        while ($row = $checkUser->fetch_assoc()) {
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['userRole'] = $row['userRole'];
            $_SESSION['userName'] = $row['emailAddress'];
        }
        $_SESSION['loggedIn'] = TRUE;
        header('Location:orders_console.php?statusQuery=PENDING');
        $loginCheck->close();
    } else {
        header('Location:login.php?loginStatus=FAILED');
//        echo $sql;
    }
}

function displayAllOrders($sql){
    $getOrders = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($getOrders ->connect_error){
        echo "Unable to establish connection";
    }
    $getOrderData = $getOrders ->query($sql);
    if ($getOrderData -> num_rows > 0){
        while($row = $getOrderData ->fetch_assoc()){
            echo '<div style="background-color:navajowhite;margin-bottom:20px;padding:20px;width:90%;margin-left:5%">
                  <p><strong>Order ID#: </strong> '.$row['orderID'].' &nbsp; <strong>Order Date: </strong>'.$row['orderDateTime'].' &nbsp; &nbsp; 
                  <a href="singleOrderEdit.php?orderID='.$row['orderID'].'">
                  <button class="btn btn-outline-dark">'.$row['orderStatus'].'</button></a></p>
                  <p><strong>Customer ID#: </strong>'.$row['customerID'].'</p>
                  <p><strong>Order Total: </strong>$'.number_format($row['orderTotal'], 2).'</p>
                  </div>';
        }
        $getOrders ->close();
    }else{
        echo "O Results";
        $getOrders ->close();
    }
}

function displaySingleOrder($sql){
    $getOrderConn = new mysqli(SERVER,USERNAME, PASSWORD, DATABASE);
    if($getOrderConn -> connect_error){
        echo "Unable to establish connection. Please try again later";
    }
    $getOrder = $getOrderConn ->query($sql);
    if ($getOrder -> num_rows > 0){
        while($row = $getOrder ->fetch_assoc()){
            echo '<div style="padding:20px;background-color:antiquewhite;margin-left:5%;width:90%">
                        <p><strong>Order #: </strong>'.$row['orderID'].'   &nbsp; &nbsp; <strong>Order Placed: </strong>  '.$row['orderDateTime'].'</p>
                        <p><strong>Order Status: </strong>'.$row['orderStatus'].'</p> <hr />
                        <h3><strong>Customer: </strong>'.$row['firstName'].' '.$row['lastName'].' </h3>
                        <p><a href="mailto:'.$row['emailAddress'].'">'.$row['emailAddress'].'</a> &nbsp; &nbsp; '.$row['phoneNumber'].'</p>
                        <table>
                        <tr>
                            <td><p><strong>Shiping Address: </strong></p></td>
                        </tr>
                        <tr>
                        <td style="padding-right:15px"><p>'.$row['shipAddress'].' '.$row['shipAddress2'].'<br/>'.$row['shipCity'].', '.$row['shipState'].' '.$row['shipZipCode'].'</p></td>
                        
                        </tr>
                        </table><hr />
                        <h4>Order Total: '.number_format($row['orderTotal'], 2).'</h4>
                        
                    </div>';
        }
        $getOrderConn -> close();
    }else{
        echo "Sorry, that order does not exist. ";
        $getOrderConn -> close();
    }
}

function displayInventory($sql)
{
    $consoleConnection = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($consoleConnection->connect_error) {
        echo "An Error Has occurred";
    }
    $getProducts = $consoleConnection->query($sql);
    if ($getProducts->num_rows > 0) {
        while ($row = $getProducts->fetch_assoc()) {
            echo '<table style="border-style:solid;width:90%;border-bottom-color:navajowhite">
                        <tr>
                            <td>
                                <p>' . $row['productID'] . '</p><h4>' . $row['prodName'] . '</h4>
                            </td>
                            <td>
                                <p>' . $row['prodDescription'] . '</p>
                            </td>
                            <td>
                                <p><strong>Count: </strong>' . $row['inventoryCount'] . '</p>
                            </td>  
                            <td>
                                <p><strong>Price: $</strong>' . number_format($row['price'], 2) . '</p>
                            </td> 
                            <td>
                                <a href="inventory_edit.php?editInv=' . $row['productID'] . '"><button class="btn-danger btn">Edit</button></a>
                            </td> 
                        </tr>
                    </table>';
        }
        $consoleConnection->close();
    } else {
        echo "0 Results";
        $consoleConnection->close();
    }
}

function displaySingleInventory($sql)
{
    $consoleConnection = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($consoleConnection->connect_error) {
        echo "An Error Has occurred";
    }
    $getProducts = $consoleConnection->query($sql);
    if ($getProducts->num_rows > 0) {
        while ($row = $getProducts->fetch_assoc()) {


            echo '<form action="" method="POST">
                    <table style="border-style:solid;width:90%;border-bottom-color:navajowhite">
                        <tr>
                            <td>
                                <p>' . $row['productID'] . '</p><h4>' . $row['prodName'] . '</h4>
                            </td>
                            <td>
                                <p>' . $row['prodDescription'] . '</p> 
                            </td>
                            <td>
                                <p><strong>Count: <input type="number" name="newCount" value="' . $row['inventoryCount'] . '"/></p>
                            </td>  
                            <td>
                                <p><strong>Price: $</strong>' . number_format($row['price'], 2) . '</p>
                            </td> 
                            <td>
                                <button name="update" type="submit" class="btn-success btn">Update</button>
                            </td> 
                        </tr>
                    </table></form>';
        }

        $consoleConnection->close();
    } else {
        echo "0 Results";
        $consoleConnection->close();
    }
}

function updateQuery($sql)
{
    $connectionForUpdate = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($connectionForUpdate->connect_error) {
        echo 'Unable to submit changes at this time. Please try again later';
    }
    if ($connectionForUpdate->query($sql) === TRUE) {
        echo '<br><h2>Successfully updated this item</h2>';


    } else {
        echo '<br><h2>Unable to update this record</h2>';
    }
}

function insertQuery($sql)
{
    $connectionForUpdate = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($connectionForUpdate->connect_error) {
        echo 'Unable to submit changes at this time. Please try again later';
    }
    if ($connectionForUpdate->query($sql) === TRUE) {
        echo '<br><h2>Entry successfully added!</h2>';


    } else {
        echo '<br><h2>Unable to update this record</h2>';
    }
}

function saveCustomerOrder($sql){
    $databaseConn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($databaseConn -> connect_error){
        echo "<p>Unable to complete order at this time due to a connection error<br /> Please try again at a later time</p>";
    }
    if ($databaseConn->query($sql) === TRUE){
//        echo "Success".PHP_EOL;
//        echo $sql . PHP_EOL;
    }else{
//        echo $sql . PHP_EOL;
        echo "Unable to process request at this time";
    }
}

function displayOrderedItems($sql){
    $dbIConn = new mysqli(SERVER, USERNAME, PASSWORD,DATABASE);
    if ($dbIConn -> connect_error){
        echo "Unable to display items, due to a connection error.";
    }
    $getItems = $dbIConn ->query($sql);
    if($getItems ->num_rows > 0){
        while($row = $getItems ->fetch_assoc()){
            echo'<table style="width:90%;margin-left:5%;margin-bottom:10px;background-color:lightblue">
                    <tr>
                    <td><strong>Product ID: </strong> '.$row['productID'].'
                    <td><strong>Product Name: </strong>'.$row['prodName'].'</td>
                    <td><strong>Description: </strong>'.$row['prodDescription'].'</td>
                    <td><strong>Qty: </strong>'.$row['quantity'].'</td>
                    <td><strong>Price: </strong>$'.number_format($row['price'], 2).'</td>
                    <td><strong>Line Total: </strong>$'.number_format($row['lineTotal'], 2).'</td>
                    </tr>
                </table>';
        }
        $dbIConn ->close();
    }else{
        echo "No Items to Display on this order";
        $dbIConn ->close();
    }
}

function currentUserDisplay($sql){
    $connectToUsers = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if($connectToUsers -> connect_error){
        echo "Unable to retrieve listed users at this time";
    }
    $getUsers = $connectToUsers -> query($sql);
    if($getUsers ->num_rows > 0){
        while($row = $getUsers -> fetch_assoc()){
            echo '
                    <table style="width:90%;padding-left:5%;margin-top:5px;margin-bottom:10px;border-style:solid;border-color:black">
                        <tr>
                            <td><strong>NAME: </strong></td>
                            <td>'.$row['firstName']. ' ' .$row['lastName'].'</td> 
                            <td><strong>USERNAME: </strong></td>
                            <td>'.$row['emailAddress'].'</td>      
                        </tr>
                    </table>';

        }
    }
}