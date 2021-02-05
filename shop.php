<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-10-21         Created Shopping Filer.
#YASH (2014107)     2020-10-29         Fixed CSS, Added code for Advertizing, removed unwanted files.
#YASH (2014107)     2020-10-29         Added form to add orders in the cart, changed constants.
#YASH (2014107)     2020-10-30         Validation for form and saving order details.
#YASH (2014107)     2020-10-30         Completed Project. Final Commit. Fixed Everything.
#YASH (2014107)     2020-11-24         Fixed the issuses given in project 1.
#YASH (2014107)     2020-11-29         Removed Bug and Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-11-30         Created classes for product and products and loaded data.
#YASH (2014107)     2020-12-02         Fixed bugs in product class.

//include and define require files and constants
require_once 'products.php';
require_once 'purchase.php';

// set error handler
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

// check session. if session is not set redirect to login page
if (!readSession()) {
    header("location: login.php");
}

// create header and set the title of the page
createPageHeader('Shop', " ");

//set all the variables for input field
$productCodeErr = $commentErr = $quantityErr = "";
$productSelectedValid = $commentValid = $quantityValid = false;
$productCode = $comment = $quantity = $orderSucess = $product_uuid = "";

// check for post request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // create purchase object to save the order
    $purchase = new purchase();

    // check for product uuid
    if (empty($_POST['productcode'])) {
        $productCodeErr = "Product code is required";
    } else {
        $purchase->setPurchaseProductUUID(test_input($_POST['productcode']));
    }

    // filter comment with test input to prevent html injection
    $comment = test_input($_POST['comment']);
    $purchase->setPurchaseComment($comment);
    // filter quantity with test input to prevent html injection
    $quantity = test_input($_POST['quantity']);
    $purchase->setPurchaseQuantity($quantity);

    // check for purchase field valid or not
    if ($productSelectedValid && $commentValid && $quantityValid) {
        echo '<script type="text/javascript">';
        echo ' alert("Form Data Saved Successfully")';  //not showing an alert box.
        echo '</script>';
        //place the order for that customer
        $purchase->save($productCode, $comment, $quantity);
        /*
          placeOrder($productCode, $fname, $lname, $city, $comment, round($price, ROUND_DECIMAL_PLACES), intval($quantity));
         */
        $productCode = $comment = $quantity = "";
    } else {
        echo '<script type="text/javascript">';
        echo ' alert("Form Data not Saved")';  //not showing an alert box.
        echo '</script>';
        $orderSucess = "Something went wrong. Please try ordering again.";
    }
}
?>

<div class="wrapper">
    <!--display page title-->
    <h2>Shop</h2>
    <!--form for purchase product-->
    <form  id="shop" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h6>Please fill the item you want to order with the details.</h6>
        <p><?php echo $orderSucess; ?></p>
        <!--product code input field-->
        <div class="form-group container <?php echo (!empty($productCodeErr)) ? 'has-error' : ''; ?>">
            <label>Product Code: </label><span class="help-block error">*<?php echo $productCodeErr; ?></span>
            <!--select from product code and description into the combobox-->
            <select id="shop-input" type="text" placeholder="Product Code" name="productcode" value="<?php echo $productCode; ?>">
                <!--set option value-->
                <option value="Please select product code" disabled selecte
                        d>Please select product code</option>;
                        <?php
                        //create products objectW
                        $products = new products();
                        // for each to itterate over items and get product uuid , product code and product description
                        foreach ($products->items as $product) {
                            ?>
                    <option value="<?php echo $product->getProductUUID(); ?>" id="<?php echo $product->getProductUUID(); ?>"><?php echo $product->getProductCode() . "-" . $product->getProductDescription(); ?></option>;
                    <?php
                }
                ?>   
            </select>
        </div>    

        <!--input comment div-->
        <div class="form-group container <?php echo (!empty($commentErr)) ? 'has-error' : ''; ?>">
            <label>Comments: </label><span class="help-block error"><?php echo $commentErr; ?></span>
            <textarea id="shop-input" type="text" placeholder="Comment" name="comment" rows="1" cols="3" value="<?php echo isset($comment) ? $comment : ''; ?>"></textarea>
        </div>

        <!--input quantity field-->`
        <div class="form-group container <?php echo (!empty($quantityErr)) ? 'has-error' : ''; ?>">
            <label>Quantity: </label><span class="help-block error">*<?php echo $quantityErr; ?></span>
            <input id="shop-input" type="number" placeholder="Quantity" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        </div>

        <!--on submit validate and insert new order-->
        <div id="order-placed" class="form-group">
            <button class="w3-button w3-black" type="submit">
                <i class="fa fa-paper-plane"></i> PLACE ORDER
            </button>
            <button class="w3-button w3-black" type="reset">
                <i class="fa fa-paper-plane"></i> CLEAR
            </button>
        </div>
    </form>
</div>

<?php
// create footer using common function
createPageFooter('footer');
?>