<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-24         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-24         Created Single database connection string.
#YASH (2014107)     2020-12-11         Added Column Constants.
#YASH (2014107)     2020-12-11         Changed connection string for granted user.

// Database connection string constants
define('DB_SERVER', 'localhost');
define('DB_NAME', 'database-2014107');
define('DB_USERNAME', 'user-2014107');
define('DB_PASSWORD', '1234');

// Customer Table Columns
define('COLUMN_CUSTOMER_UUID', 'customer_uuid');
define('COLUMN_CUSTOMER_LASTNAME', 'customer_lastname');
define('COLUMN_CUSTOMER_FIRSTNAME', 'customer_firstname');
define('COLUMN_CUSTOMER_ADDRESS', 'address');
define('COLUMN_CUSTOMER_CITY', 'city');
define('COLUMN_CUSTOMER_PROVINCE', 'province');
define('COLUMN_CUSTOMER_POSTALCODE', 'postal_code');
define('COLUMN_CUSTOMER_USERNAME', 'customer_username');
define('COLUMN_CUSTOMER_PASSWORD', 'customer_password');

// Products Table Columns
define('COLUMN_PRODUCT_UUID', 'product_uuid');
define('COLUMN_PRODUCT_CODE', 'product_code');
define('COLUMN_PRODUCT_DESCRIPTION', 'product_description');
define('COLUMN_PRODUCT_SELLING_PRICE', 'product_selling_price');
define('COLUMN_PRODUCT_COST_PRICE', 'product_cost_price');

// Purchases Table Columns
define('COLUMN_PURCHASES_UUID', 'purchases_uuid');
define('COLUMN_PURCHASES_CUSTOMER_UUID', 'purchases_customer_uuid');
define('COLUMN_PURCHASES_PRODUCT_UUID', 'purchases_product_uuid');
define('COLUMN_PURCHASES_PRICE', 'purchases_price');
define('COLUMN_PURCHASES_SUBTOTAL', 'purchases_subtotal');
define('COLUMN_PURCHASES_TAXES', 'purchases_taxes');
define('COLUMN_PURCHASES_GRANDTOTAL', 'purchases_grandtotal');
define('COLUMN_PURCHASES_QUANTITY', 'purchases_quantity');
define('COLUMN_PURCHASES_COMMENTS', 'purchases_comments');

try {
    //global pdo connection
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //show error
    databaseErrorMessage($e);
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>