<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-24         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-24         Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-11-26         Created Login Form.
#YASH (2014107)     2020-11-29         Tested login form.
#YASH (2014107)     2020-11-30         Load and login using customer class.

// include/require all the files required for the page
require_once "database-connection.php";
require "customer.php";

//set error handlers
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

//create header from common function
createPageHeader('login', " ");

// Initialize the session
// Check if the user is already logged in, if yes then redirect him to welcome page
if (readSession()) {
    header("location: index.php");
    exit;
}


$customer = new customer();
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(test_input($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = test_input($_POST["username"]);
    }

    // Check if password is empty
    if (empty(test_input($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        $customer->login($username, $password);
    }
}
?>
<!--html for login-->
<div class="wrapper">
    <h2>Login</h2>
    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h6>Please fill in your credentials to login.</h6>
        <div class="imgcontainer">
            <img src="<?php echo AVATAR_FILE_IMAGE; ?>" alt="Avatar" class="avatar">
        </div>
        
        <!--take input for username and show error message if exist-->
        <div class="form-group container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input id="login-input" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block error"><?php echo $username_err; ?></span>
        </div>
        
        <!--take input for password and show error message if exist-->
        <div class="form-group container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input id="login-input" type="password" name="password" class="form-control">
            <span class="help-block error"><?php echo $password_err; ?></span>
        </div>
        
        <!--if valid login else show error message on the page-->
        <div class="form-group">
            <button id="button" class="w3-button w3-black" type="submit">
                <i class="fa fa-sign-in"></i> LOGIN
            </button>
        </div>
        
        <!--remeber me check box-->
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        <!--redirect to account page if user wants to register-->
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</div>
<?php
//create page footer using common function
createPageFooter('footer');
?>