<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-12-01         Created NetBeans project and empty folders.
#YASH (2014107)     2020-12-05         Created constructor and getter and setter method for all fields.
#YASH (2014107)     2020-12-07         setter for optional parameter date.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Added column constants.

require_once('database-connection.php');
require_once 'Collection.php';
require_once 'purchase.php';

class purchases extends collection {

    private $purchase_date = "";

    function __construct($purchase_date = "") {
        #when this code will be called
        #when we create object of the class then cunstructor is called

        # if purchase date is not empty set purchase date
        if ($purchase_date != " ") {
            $this->purchase_date = $purchase_date;
        }
        
        #global Database Connection
        global $pdo;

        #sql Stored procedure call
        $sqlQuery = "CALL filter_purchases(:p_purchases_customer_uuid, :p_date)";
        try{
            if ($stmt = $pdo->prepare($sqlQuery)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':p_purchases_customer_uuid', $purchases_customer_uuid, PDO::PARAM_STR);
                $stmt->bindParam(':p_date', $purchase_order_date, PDO::PARAM_STR);
                // set parameters
                $purchases_customer_uuid = $_SESSION["id"];
                $purchase_order_date = $this->purchase_date;
                // Attempt to execute the prepared statement
                $stmt->execute();
                //fetch the results
                if ($stmt->rowCount() == 0) {
                    echo "No orders found.Please select another date";
                } else {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $purchase = new purchase($row[COLUMN_PURCHASES_UUID], $row[COLUMN_PURCHASES_CUSTOMER_UUID], $row[COLUMN_PURCHASES_PRODUCT_UUID], $row[COLUMN_PURCHASES_PRICE], 
                                                 $row[COLUMN_PURCHASES_SUBTOTAL], $row[COLUMN_PURCHASES_TAXES], $row[COLUMN_PURCHASES_GRANDTOTAL], $row[COLUMN_PURCHASES_QUANTITY], 
                                                 $row[COLUMN_PURCHASES_COMMENTS], $row[COLUMN_CUSTOMER_FIRSTNAME], $row[COLUMN_CUSTOMER_LASTNAME], $row[COLUMN_CUSTOMER_CITY], $row[COLUMN_PRODUCT_CODE]);
                        $this->add($row[COLUMN_PURCHASES_UUID], $purchase);
                    }
                }
                unset($stmt);
            }
        } catch(PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        unset($pdo);
    }

}

?>