<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-28         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-28         Add customers to the array/list.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Added column constants.

require_once 'database-connection.php';
require_once 'Collection.php';
require_once 'customer.php';

class customers extends collection {

    function __construct() {
        #when this code will be called
        #when we create object of the class then cunstructor is called

        #global Database Connection
        global $pdo;
        
        #sql Stored procedure call
        $sqlQuery = "CALL select_customers()";
        try{
            if ($stmt = $pdo->prepare($sqlQuery)) {
                // Attempt to execute the prepared statement
                $stmt->execute();
                //fetch the results
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //add it to customer object
                    $customer = new customer($row[COLUMN_CUSTOMER_UUID], $row[COLUMN_CUSTOMER_FIRSTNAME], $row[COLUMN_CUSTOMER_LASTNAME], $row[COLUMN_CUSTOMER_ADDRESS],
                                             $row[COLUMN_CUSTOMER_CITY], $row[COLUMN_CUSTOMER_PROVINCE], $row[COLUMN_CUSTOMER_POSTALCODE], $row[COLUMN_CUSTOMER_USERNAME], $row[COLUMN_CUSTOMER_PASSWORD]);
                    //add customer object to array/list
                    $this->add($row[COLUMN_CUSTOMER_UUID    ], $customer);
                }
                //close statement
                unset($stmt);
            }            
        } catch(PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        //close connection
        unset($pdo);
    }

}

?>