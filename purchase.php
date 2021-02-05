<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-12-01         Created NetBeans project and empty folders.
#YASH (2014107)     2020-12-04         Created constructor and getter and setter method for all fields.
#YASH (2014107)     2020-12-05         Fixed bugs in purchase class.
#YASH (2014107)     2020-12-06         Added fields for customer firname, lastname, city and product code.
#YASH (2014107)     2020-12-09         Removed bug for delete.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Removed bug in Update query.
#YASH (2014107)     2020-12-11         Added column constants.

require_once('database-connection.php');
include 'PHPFunctions/PHPFunctions.php';

class purchase {
    private $purchases_uuid = "";                       // purchases uuid
    private $purchases_customer_uuid = "";              // purchases customer uuid
    private $purchases_product_uuid = "";               // purchases product uuid
    private $purchases_price = "";                      // purchases price
    private $purchases_subtotal = "";                   // purchases subtotal
    private $purchases_taxes = "";                      // purchases taxes
    private $purchases_grandtotal = "";                 // purchases grandtotal
    private $purchases_quantity = "";                   // purchases quantity
    private $purchases_comments = "";                   // purchases comments
    private $customer_fname = "";                       // customer firstname
    private $customer_lname = "";                       // customer lastname
    private $product_code = "";                         // product code
    private $customer_city = "";                        // customer city

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     */
    public function __construct($purchases_uuid = " ", $purchases_customer_uuid = " ", $purchases_product_uuid = " ", $purchases_price = " ", $purchases_subtotal = " ", $purchases_taxes = " ", $purchases_grandtotal = " ", $purchases_quantity = " ", $purchases_comments = " ", $customer_fname = " ", $customer_lname = " ", $customer_city = " ", $product_code = " ") {
        //check if purchases uuid is set in constructor or not . if it's set assign all other values of the fields.
        if ($purchases_uuid != " ") {
            $this->purchases_uuid = $purchases_uuid;
            $this->purchases_customer_uuid = $purchases_customer_uuid;
            $this->purchases_product_uuid = $purchases_product_uuid;
            $this->purchases_price = $purchases_price;
            $this->purchases_subtotal = $purchases_subtotal;
            $this->purchases_taxes = $purchases_taxes;
            $this->purchases_grandtotal = $purchases_grandtotal;
            $this->purchases_quantity = $purchases_quantity;
            $this->purchases_comments = $purchases_comments;
            $this->customer_fname = $customer_fname;
            $this->customer_lname = $customer_lname;
            $this->customer_city = $customer_city;
            $this->product_code = $product_code;
        }
    }
    
    #################################################################
    ###### Getter and Setter method for all the private fields ######
    #################################################################
    
    # getter methods will return the value of the private fields
    # setter methods will validate the value. if not valid it will return error message else assign the values to private fields.    

    function getPurchaseUUID() {
        return $this->purchases_uuid;
    }

    function getProductCode() {
        return $this->product_code;
    }

    function getCustomerFirstName() {
        return $this->customer_fname;
    }

    function getCustomerLastName() {
        return $this->customer_lname;
    }

    function getCustomerCity() {
        return $this->customer_city;
    }

    function getPurchaseCustomerUUID() {
        return $this->purchases_customer_uuid;
    }

    function setPurchaseCustomerUUID() {
        if (readSession()) {
            $this->purchases_customer_uuid = $_SESSION['id'];
        }
    }

    function getPurchaseProductUUID() {
        return $this->purchases_product_uuid;
    }

    function setPurchaseProductUUID($newProductUUID) {
        global $productCodeErr, $productSelectedValid, $productCode;
        if (empty($newProductUUID)) {
            $productCodeErr = "Product code is required";
        } else if (!empty($newProductUUID)) {
            $productCode = test_input($newProductUUID);
            $this->purchases_product_uuid = test_input($newProductUUID);
            $productSelectedValid = true;
        }
    }

    function getPurchaseProductPrice() {
        return $this->purchases_price;
    }

    function setPurchaseProductPrice() {
        $product = new product();
        $product->load($this->purchases_product_uuid);
        $this->purchases_price = $product->getProductSellingPrice();
    }

    function getPurchaseProductSubtotal() {
        return $this->purchases_subtotal;
    }

    function setPurchaseProductSubtotal() {
        $this->purchases_subtotal = $this->purchases_price * $this->purchases_quantity;
    }

    function getPurchaseProductTaxes() {
        return $this->purchases_taxes;
    }

    function setPurchaseProductTaxes() {
        $this->purchases_taxes = ($this->purchases_subtotal * LOCAL_TAX_VALUE) / UNIVERSAL_HUNDRED;
    }

    function getPurchaseProductGrandTotal() {
        return $this->purchases_grandtotal;
    }

    function setPurchaseProductGrandTotal() {
        $this->purchases_grandtotal = $this->purchases_subtotal + $this->purchases_taxes;
    }

    function getPurchaseQuantity() {
        return $this->purchases_quantity;
    }

    function setPurchaseQuantity($newQuantity) {
        global $quantityErr, $quantityValid, $quantity;
        if (empty($newQuantity)) {
            $quantityErr = "Quantity is required";
            $quantity = $newQuantity;
        } else if (intval($newQuantity) < ZERO_UNIVERSAL || intval($newQuantity) > MAX_QUANTITY) {
            $quantityErr = "Quantity should be numeric value between " . ZERO_UNIVERSAL . " and " . MAX_QUANTITY;
            $quantity = $newQuantity;
        } else {
            $this->purchases_quantity = test_input($newQuantity);
            $quantityValid = true;
        }
    }

    function getPurchaseComment() {
        return $this->purchases_comments;
    }

    function setPurchaseComment($newComment) {
        global $commentErr, $commentValid, $comment;
        if (empty($newComment)) {
            $this->purchases_comments = "";
            $commentValid = true;
        } else if (strlen($newComment) > COMMENTS_MAX_LENGTH) {
            $commentErr = "Comment cannot contain more than " . COMMENTS_MAX_LENGTH . " characters";
            $comment = $newComment;
        } else {
            $this->purchases_comments = test_input($newComment);
            $commentValid = true;
        }
    }

    #############################################################
    ######        End of getter and setter method         #######
    #############################################################
    
    //load the purchases details using uuid
    public function load($purchases_uuid) {
        global $pdo;
        //run stored routine
        $sql = "CALL load_purchase(:p_purchases_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':p_purchases_uuid', $param_purchases_uuid, PDO::PARAM_STR);
                // Set parameters
                $param_purchases_uuid = $purchases_uuid;
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $this->purchases_uuid = $row[COLUMN_PURCHASES_UUID];
                            $this->purchases_customer_uuid = $row[COLUMN_PURCHASES_CUSTOMER_UUID];
                            $this->purchases_product_uuid = $row[COLUMN_PURCHASES_PRODUCT_UUID];
                            $this->purchases_price = $row[COLUMN_PURCHASES_PRICE];
                            $this->purchases_subtotal = $row[COLUMN_PURCHASES_SUBTOTAL];
                            $this->purchases_taxes = $row[COLUMN_PURCHASES_TAXES];
                            $this->purchases_grandtotal = $row[COLUMN_PURCHASES_GRANDTOTAL];
                            $this->purchases_quantity = $row[COLUMN_PURCHASES_QUANTITY];
                            $this->purchases_comments = $row[COLUMN_PURCHASES_COMMENTS];
                        }
                    } else {
                        $purchase_err = "No Product found with that productcode.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
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
    
    //Insert or update the purchase details using save method
    public function save($purchaseProductCode, $purchaseProductComment, $purchaseProductQuantity) {
        global $pdo, $productSelectedValid, $quantityValid, $commentValid;
        $this->setPurchaseCustomerUUID();
        $this->setPurchaseProductUUID($purchaseProductCode);
        $this->setPurchaseQuantity($purchaseProductQuantity);
        $this->setPurchaseProductPrice();
        $this->setPurchaseProductSubtotal();
        $this->setPurchaseProductTaxes();
        $this->setPurchaseProductGrandTotal();
        $this->setPurchaseComment($purchaseProductComment);
        if ($productSelectedValid && $quantityValid && $commentValid) {
            // if all the fields are valid check for purchase uuid. if it is empty then insert new order else update existing order
            if ($this->purchases_uuid == "") {
                $sqlQuery = "CALL insert_purchase(:p_purchases_customer_uuid, :p_purchases_product_uuid, :p_purchases_price, :p_purchases_subtotal, :p_purchases_taxes, :p_purchases_grandtotal, :p_purchases_quantity, :p_purchases_comments)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(':p_purchases_customer_uuid', $purchases_customer_uuid, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_product_uuid', $purchases_product_uuid, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_price', $purchases_price, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_subtotal', $purchases_subtotal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_taxes', $purchases_taxes, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_grandtotal', $purchases_grandtotal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_quantity', $purchases_quantity, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_comments', $purchases_comments, PDO::PARAM_STR);
                        // Set parameters
                        $purchases_customer_uuid = $this->purchases_customer_uuid;
                        $purchases_product_uuid = $this->purchases_product_uuid;
                        $purchases_price = $this->purchases_price;
                        $purchases_subtotal = $this->purchases_subtotal;
                        $purchases_taxes = $this->purchases_taxes;
                        $purchases_grandtotal = $this->purchases_grandtotal;
                        $purchases_quantity = $this->purchases_quantity;
                        $purchases_comments = $this->purchases_comments;
                        try {
                            $stmt->execute();
                            // Attempt to execute the prepared statement
                            global $orderSucess;
                            $orderSucess = "Order placed successfully. Thank you for ordering products from DYAD Bikes. Please continue to order new product.";
                            // Redirect to orders page if successfull
                            header("location: orders.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
                        }
                        unset($stmt);
                    }                    
                } catch(PDOException $e){
                    echo "Something went wrong. Please try again later.";
                    databaseErrorMessage($e);
                }
                unset($pdo);
                return true;
            } else {
                // if update purchase . purchase uuid is already set. update into that purchase row of database.
                $sqlQuery = "CALL update_purchase(:p_purchases_uuid, :p_purchases_product_uuid, :p_purchases_price, :p_purchases_subtotal, :p_purchases_taxes, :p_purchases_grandtotal, :p_purchases_quantity, :p_purchases_comments)";
//                $sqlQuery = "CALL employee_insert(:firstname, :lastname, :username, :password)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(':p_purchases_uuid', $param_purchases_uuid, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_product_uuid', $purchases_product_uuid, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_price', $purchases_price, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_subtotal', $purchases_subtotal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_taxes', $purchases_taxes, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_grandtotal', $purchases_grandtotal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_quantity', $purchases_quantity, PDO::PARAM_STR);
                        $stmt->bindParam(':p_purchases_comments', $purchases_comments, PDO::PARAM_STR);
                        // Set parameters
                        $param_purchases_uuid = $this->purchases_uuid;
                        $purchases_product_uuid = $this->purchases_product_uuid;
                        $purchases_price = $this->purchases_price;
                        $purchases_subtotal = $this->purchases_subtotal;
                        $purchases_taxes = $this->purchases_taxes;
                        $purchases_grandtotal = $this->purchases_grandtotal;
                        $purchases_quantity = $this->purchases_quantity;
                        $purchases_comments = $this->purchases_comments;
                        try {
                            // Attempt to execute the prepared statement
                            $stmt->execute();
                            // Redirect to index page
                            header("location: orders.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
                            databaseErrorMessage($e);
                        }
                        //close statement
                        unset($stmt);
                    }
                } catch(PDOException $e){
                    echo "Something went wrong. Please try again later.";
                    databaseErrorMessage($e);
                }
                //close connection
                unset($pdo);
                return true;
            }
        }
    }
    
    //delete purchase information
    public function delete($purchases_uuid) {
        global $pdo;
        $sql = "CALL delete_purchase(:p_purchases_customer_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":p_purchases_customer_uuid", $purchases_uuid, PDO::PARAM_STR);
                // Set parameters
                $param_uuid = $purchases_uuid;
                // Attempt to execute the prepared statement
                $stmt->execute();
                $affectedRows = $stmt->rowCount();
                return $affectedRows;
                //close statement
                unset($stmt);
            }
        } catch (PDOException $e){
            echo "Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        // Close connection
        unset($pdo);
    }
}
?>