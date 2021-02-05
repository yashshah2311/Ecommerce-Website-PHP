<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-24         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-25         Created constructor and getter and setter method for all fields.
#YASH (2014107)     2020-11-26         Created Load, Save, Delete, login , logout function.
#YASH (2014107)     2020-11-27         Added validation for all the fields.
#YASH (2014107)     2020-12-02         Removed bug and tested well.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Added column constants.

//include all require files
require_once('database-connection.php');


class product {
    //all private fields
    private $product_uuid = "";                       // product uuid
    private $product_code = "";                       // product code
    private $product_description = "";                // product description
    private $product_selling_price = "";              // product selling price
    private $product_cost_price = "";                 // product cost price

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     */
    public function __construct($product_uuid = " ", $product_code = " ", $product_description = " ", $product_selling_price = " ", $product_cost_price = " ") {
        //check if product uuid is set or not . if it's set assign all other values of the fields.
        if ($product_uuid != " ") {
            $this->product_uuid = $product_uuid;
            $this->product_code = $product_code;
            $this->product_description = $product_description;
            $this->product_selling_price = $product_selling_price;
            $this->product_cost_price = $product_cost_price;
        }
    }


    #################################################################
    ###### Getter and Setter method for all the private fields ######
    #################################################################
    
    # getter methods will return the value of the private fields
    # setter methods will validate the value. if not valid it will return error message else assign the values to private fields.

    function getProductUUID() {
        return $this->product_uuid;
    }

    function getProductCode() {
        return $this->product_code;
    }

    function setProductCode($newProductCode) {
        global $productcode_err;
        if (mb_strlen($newProductCode) == ZERO_UNIVERSAL) {
            $productcode_err = "Product code is required";
        } else if (strpos(strtolower($newProductCode), 'p') !== ZERO_UNIVERSAL) {
            $productcode_err = "Product code is not valid";
        } else if (strlen($newProductCode) > PRODUCT_CODE_MAX_LENGTH) {
            $productcode_err = "Product code cannot contain more than " . PRODUCT_CODE_MAX_LENGTH . " characters";
        } else {
            $this->product_code = $newProductCode;
        }
    }

    function getProductDescription() {
        return $this->product_description;
    }

    function setProductDescription($newProductDescription) {
        global $productdescription_err;
        if (mb_strlen($newProductDescription) == ZERO_UNIVERSAL) {
            $productdescription_err = "Product description is required";
        } else if (strlen($newProductDescription) > PRODUCT_DESCRIPTION_MAX_LENGTH) {
            $productdescription_err = "Product description cannot contain more than " . PRODUCT_DESCRIPTION_MAX_LENGTH . " characters";
        } else {
            $this->product_description = $newProductDescription;
        }
    }

    function getProductSellingPrice() {
        return $this->product_selling_price;
    }

    function setProductSellingPrice($newProductSellingPrice) {
        global $productsellingprice_err;
        if (empty($newProductSellingPrice)) {
            $productsellingprice_err = "Selling Price is required";
        } else if (!is_numeric($newProductSellingPrice)) {
            $productsellingprice_err = "Selling Price should be numeric";
        } else if (floatval($newProductSellingPrice) > MAX_PRICE || floatval($newProductSellingPrice) <= ZERO_UNIVERSAL) {
            $productsellingprice_err = "Selling Price should be greater than $" . ZERO_UNIVERSAL . " and less than " . MAX_PRICE;
        } else {
            $this->product_selling_price = $newProductSellingPrice;
        }
    }

    function getProductCostPrice() {
        return $this->product_cost_price;
    }

    function setProductCostPrice($newProductCostPrice) {
        global $productcostprice_err;
        if (!is_numeric($newProductCostPrice)) {
            $productcostprice_err = "Selling Price should be numeric";
        } else if (floatval($newProductCostPrice) > MAX_PRICE || floatval($newProductCostPrice) <= ZERO_UNIVERSAL) {
            $productcostprice_err = "Selling Price should be greater than $" . ZERO_UNIVERSAL . " and less than " . MAX_PRICE;
        } else {
            $this->product_cost_price = $newProductCostPrice;
        }
    }

    #############################################################
    ######        End of getter and setter method         #######
    #############################################################
    
    //load the product details using uuid
    public function load($product_uuid) {
        global $pdo;
        $sql = "CALL load_product(:p_product_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':p_product_uuid', $param_product_uuid, PDO::PARAM_STR);
                // Set parameters
                $param_product_uuid = $product_uuid;
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $this->product_uuid = $row[COLUMN_PRODUCT_UUID];
                            $this->product_code = $row[COLUMN_PRODUCT_CODE];
                            $this->product_description = $row[COLUMN_PRODUCT_DESCRIPTION];
                            $this->product_selling_price = $row[COLUMN_PRODUCT_SELLING_PRICE];
                            $this->product_cost_price = $row[COLUMN_PRODUCT_COST_PRICE];
                        }
                    } else {
                        $productcode_err = "No Product found with that productcode.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }            
        }catch (PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        // Close connection
        unset($pdo);
    }

    //Insert or update the product details using save method    
    public function save($productCode, $productDescription, $productSellingPrice, $productCostPrice) {
        global $pdo;
        $productcode_err = "";
        $productdescription_err = "";
        $productsellingprice_err = "";
        $productcostprice_err = "";
        $this->setProductCode($productCode);
        $this->setProductDescription($productDescription);
        $this->setProductSellingPrice($productSellingPrice);
        $this->setProductCostPrice($productCostPrice);

        if (empty($productcode_err) && empty($productdescription_err) && empty($productsellingprice_err) && empty($productcostprice_err)) {
            if ($this->product_uuid == "") {
                $sqlQuery = "CALL insert_product(:p_product_code, :p_product_description, :p_product_selling_price, :p_product_cost_price)";
//                $sqlQuery = "CALL employee_insert(:firstname, :lastname, :username, :password)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(':p_product_code', $product_code, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_description', $product_description, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_selling_price', $product_selling_price, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_cost_price', $product_cost_price, PDO::PARAM_STR);

                        // Set parameters
                        $product_code = $this->product_code;
                        $product_description = $this->product_description;
                        $product_selling_price = $this->product_selling_price;
                        $product_cost_price = $this->product_cost_price;
                        try {
                            // Attempt to execute the prepared statement                        
                            $stmt->execute();
                            // Redirect to index page
                            header("location: index.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
                            databaseErrorMessage($e);
                        }
                        // Close statement
                        unset($stmt);
                    }                    
                }catch (PDOException $e){
                    echo "Something went wrong. Please try again later.";
                    databaseErrorMessage($e);
                }
                // close connection
                unset($pdo);
                return true;
            } else {
                // if update product . product uuid is already set. update into that product row of database.
                // Call stored procedure for update
                $sqlQuery = "CALL update_product(:p_product_uuid, :p_product_code, :p_product_description, :p_product_selling_price, :p_product_cost_price)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        //bind params
                        $stmt->bindParam(':p_product_uuid', $this->product_uuid);
                        $stmt->bindParam(':p_product_code', $product_code, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_description', $product_description, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_selling_price', $product_selling_price, PDO::PARAM_STR);
                        $stmt->bindParam(':p_product_cost_price', $product_cost_price, PDO::PARAM_STR);

                        //set parameters
                        $product_code = $this->product_code;
                        $product_description = $this->product_description;
                        $product_selling_price = $this->product_selling_price;
                        $product_cost_price = $this->product_cost_price;
                        try {
                            //try to execute
                            $stmt->execute();
                            // Redirect to index page
                            header("location: index.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
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
    
    //delete Product
    public function delete($product_uuid) {
        global $pdo;
        $product_uuid = $this->product_uuid;
        $sql = "CALL delete_product(:p_product_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {

                $stmt->bindParam(":p_product_uuid", $param_uuid, PDO::PARAM_STR);
                $param_uuid = $this->product_uuid;
                if ($stmt->execute()) {
                    $affectedRows = $stmt->rowCount();
                    return $affectedRows;
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }            
        }catch (PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        // Close connection
        unset($pdo);
    }
    
}

?>