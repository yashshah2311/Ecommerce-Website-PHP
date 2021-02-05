<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-29         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-29         Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-11-30         Created form for register and update.
#YASH (2014107)     2020-11-30         Load, Insert and Update data from class customer.
#YASH (2014107)     2020-12-01         Removed minor bug.

//require/include all required files or constants
require_once "database-connection.php";
require "customer.php";

// call error handlers
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

// create new customer object to register/update.
$customer = new customer();
// if session exists set customer details for update.
if (readSession()) {
    // create header and title for update.
    createPageHeader('update-profile', " ");
    // load customer details in all the fields of customer object and set input field to the values get from customer class fields
    $customer->load($_SESSION["id"]);
    // get all the details of customer's fields.
    $firstname = $customer->getFirstname();
    $lastname = $customer->getLastname();
    $address = $customer->getAddress();
    $city = $customer->getCity();
    $province = $customer->getProvince();
    $postalcode = $customer->getPostalCode();
    $username = $customer->getUsername();
    $password = "";
} else {
    // create header and title for new customer.
    createPageHeader('register', " ");
    // set input field value to null
    $firstname = $lastname = $address = $city = $province = $postalcode = $username = $password = "";
}

// Define variables and initialize with empty values
$firstname_err = $lastname_err = $address_err = $city_err = $province_err = $postalcode_err = $username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //save customer details either update/register
    $customer->save(test_input($_POST["firstname"]), test_input($_POST["lastname"]), test_input($_POST["address"]), test_input($_POST["city"]), test_input($_POST["province"]), test_input($_POST["postalcode"]), test_input($_POST["username"]), test_input($_POST["password"]), $username);
}
?>

<div class="wrapper">
    <h2>
        <?php
        // check for session variables set or not
        if (readSession()) {
            // if set display update title
            echo 'Update Your Info';
        } else {
            // else show sign up title
            echo 'Sign Up Now';
        }
        ?></h2><br>

    <!--show sign up / update profile form-->
    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h6><?php
            if (readSession()) {
                echo 'Please update your details here. ';
            } else {
                echo 'Please fill the details to Sign Up Now. ';
            }
            ?>
        <span class="help-block error">* = required</span></h6>
        <div class="imgcontainer">
            <img src="<?php echo AVATAR_FILE_IMAGE; ?>" alt="Avatar" class="avatar">
        </div>
        
        <!--input customer firstname-->
        <div class="form-group container <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Firstname</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
            <span class="help-block error"><?php echo $firstname_err; ?></span>
        </div>
        
        <!--input customer lastname-->
        <div class="form-group container <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Lastname</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
            <span class="help-block error"><?php echo $lastname_err; ?></span>
        </div>
        
        <!--input customer address-->
        <div class="form-group container <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
            <label>Address</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block error"><?php echo $address_err; ?></span>
        </div>
        
        <!--input customer city--> 
        <div class="form-group container <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
            <label>City</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="city" class="form-control" value="<?php echo $city; ?>">
            <span class="help-block error"><?php echo $city_err; ?></span>
        </div>
        
        <!--input customer province-->
        <div class="form-group container <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
            <label>Province</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="province" class="form-control" value="<?php echo $province; ?>">
            <span class="help-block error"><?php echo $province_err; ?></span>
        </div>
        
        <!--input customer postal code-->
        <div class="form-group container <?php echo (!empty($postalcode_err)) ? 'has-error' : ''; ?>">
            <label>Postal code</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="postalcode" class="form-control" value="<?php echo $postalcode; ?>">
            <span class="help-block error"><?php echo $postalcode_err; ?></span>
        </div>
        
        <!--input customer username-->
        <div class="form-group container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label><span class="help-block error">*</span>
            <input id="login-input" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block error"><?php echo $username_err; ?></span>
        </div>
        
        <!--input customer password-->
        <div class="form-group container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label><span class="help-block error">*</span>
            <input id="login-input" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block error"><?php echo $password_err; ?></span>
        </div>
        
        <!--submit for signup or update profile-->
        <div class="form-group">
            <button id="button" class="w3-button w3-black" type="submit">
                <i class="fa fa-sign-in"></i> 
                <?php
                if (readSession()) {
                    echo "UPDATE INFO";
                } else {
                    echo "SIGN UP";
                }
                ?>
            </button>
        </div>
        <?php
        if (!readSession()) {
            echo '<label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <p>Already have an account? <a href="login.php">Login</a>.</p>';
        }
        ?>

    </form>
</div>
<?php
createPageFooter('register-footer');
?>