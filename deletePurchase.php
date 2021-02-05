<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-12-07         Created NetBeans project and empty folders.
#YASH (2014107)     2020-12-08         Created Ajax function response call.

// include all file/ constants needed
include_once 'purchase.php';

    $purchase = new purchase();
    // check delete purchase query
    if(isset($_POST["deleteQuery"])){
        $purchase_id = $_POST["deleteQuery"];
        // if delete query not empty call delete function
        if(!empty($_POST["deleteQuery"])){
            // set query value in the variable
            $purchase_id = $_POST["deleteQuery"];
            $purchase->delete($purchase_id);
        }
    }