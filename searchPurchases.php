<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-12-06         Created NetBeans project and empty folders.
#YASH (2014107)     2020-12-07         Created Ajax function response call.
#YASH (2014107)     2020-12-11         Fixed css for table orders.

// include all file/ constants needed
include_once 'purchases.php';

// check search purchase query
if (isset($_POST["searchQuery"])) {
    if (empty($_POST["searchQuery"])) {
        $searchQuery = null;
    } else {
        $searchQuery = $_POST["searchQuery"];
    }
    // create purchases object to load data for purchases by customer logged in
    $purchases = new purchases($searchQuery);
    global $showPrint, $showColor, $div_color;
    // create table columns and their headers
    echo '<table id="t01">
        <tr>
            <th>Delete</th>
            <th>Product Code</th>
            <th>Customer First Name</th>
            <th>Customer Last Name</th>
            <th>City</th>
            <th>Comments</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Taxes</th>
            <th>Grand Total</th>
        </tr>';
    
    // itterate over purchases array to show purchases data
    foreach ($purchases->items as $data) {
        // check for command equal to color and set the div value
        if ($showColor) {
            if ($data->getPurchaseProductPrice() < 100) {
                $div_color = 'color-red';
            } else if ($data->getPurchaseProductPrice() >= 100 && $data->getPurchaseProductPrice() < 999.99) {
                $div_color = 'color-orange';
            } else {
                $div_color = 'color-green';
            }
        }
        
        //display each row
        echo '  <tr id="' . $data->getPurchaseUUID() . '" value="' . $data->getPurchaseUUID() . '">';
        //display delete button
        echo '<th><button class="w3-button w3-black" id="' . $data->getPurchaseUUID() . '" onclick="deletePurchases()">DELETE</button> </th>';
        // display purchases details
        echo "<th>" . $data->getProductCode() . "</th>
                <th>" . $data->getCustomerFirstName() . "</th>
                <th>" . $data->getCustomerLastName() . "</th>
                <th>" . $data->getCustomerCity() . "</th>
                <th>" . $data->getPurchaseComment() . "</th>
                <th>$" . $data->getPurchaseProductPrice() . "</th>
                <th>" . $data->getPurchaseQuantity() . "</th>
                <th class='" . $div_color . "'>$" . $data->getPurchaseProductSubtotal() . "</th>
            <th>$" . $data->getPurchaseProductTaxes() . "</th>
            <th>$" . $data->getPurchaseProductGrandTotal() . "</th>
            </tr>
            ";
    }
    echo '</table>';
}
?>