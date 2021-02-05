<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-12-01         Created NetBeans project and empty folders.
#YASH (2014107)     2020-12-02         Created constructor and getter and setter method for all fields.
#YASH (2014107)     2020-12-06         Removed Bug in feching columns.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Added column constants.

require_once 'database-connection.php';
require_once 'Collection.php';
require_once 'product.php';

class products extends collection {

    function __construct() {
        #when this code will be called
        #when we create object of the class then cunstructor is called

        #global Database Connection
        global $pdo;
        
        #sql Stored procedure call
        $sqlQuery = "CALL select_products()";
        try{
            if ($stmt = $pdo->prepare($sqlQuery)) {
                // Attempt to execute the prepared statement
                $stmt->execute();
                //fetch the results
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //add it to product object
                    $product = new product($row[COLUMN_PRODUCT_UUID], $row[COLUMN_PRODUCT_CODE], $row[COLUMN_PRODUCT_DESCRIPTION], $row[COLUMN_PRODUCT_SELLING_PRICE], $row[COLUMN_PRODUCT_COST_PRICE]);
                    //add product object to the array list
                    $this->add($row[COLUMN_PRODUCT_UUID], $product);
                }
                // close statement
                unset($stmt);
            }            
        } catch (PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }

        // close connection
        unset($pdo);
    }

}

?>