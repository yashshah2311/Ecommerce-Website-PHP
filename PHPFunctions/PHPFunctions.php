<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-10-21         Created PHPFunctions File and folder.
#YASH (2014107)     2020-10-21         Created Header and Footer Functions.
#YASH (2014107)     2020-10-21         Created Small Functions.
#YASH (2014107)     2020-10-29         Fixed CSS, Added code for Advertizing.
#YASH (2014107)     2020-10-30         Added constants and function for saving orders.
#YASH (2014107)     2020-10-30         Completed Project. Final Commit. Fixed Everything.
#YASH (2014107)     2020-10-30         Fixed exception function.
#YASH (2014107)     2020-11-24         Fixed the issuses given in project 1.
#YASH (2014107)     2020-11-24         Forced user to load HTTPS connection.
#YASH (2014107)     2020-11-25         Created session functions.
#YASH (2014107)     2020-11-25         Added more navigation menu.
#YASH (2014107)     2020-11-26         Fixed issues to load pages before and after .
#YASH (2014107)     2020-12-04         Added Constants.

//define all constants here
define('PAGE_LOGIN', 'login.php');
define('PAGE_LOGOUT', 'logout.php');
define('PAGE_INDEX', 'index.php');
define('PAGE_SHOP', 'shop.php');
define('PAGE_CONTACT', 'contact-us.php');
define('PAGE_ORDERS', 'orders.php');
define('PAGE_REGISTER', 'register.php');
define('FOLDER_IMAGES', 'IMAGES/');
define('FOLDER_CSS', 'CSS/');
define('MAIN_FILE_CSS', FOLDER_CSS . 'Main.css');
define('LOGO_FILE_IMAGE', FOLDER_IMAGES . 'Logo.jpg');
define('AVATAR_FILE_IMAGE', FOLDER_IMAGES . 'avatar.png');
define('FOLDER_JAVASCRIPT', 'JS/');
define('FOLDER_ORDERS', 'order/');
define('FILE_ORDERS', FOLDER_ORDERS . 'orders.txt');
define('FILE_EOL', '\r\n');
define('NAME_MAX_LENGTH', 20);
define('PRODUCT_CODE_MAX_LENGTH', 12);
define('PRODUCT_DESCRIPTION_MAX_LENGTH', 100);
define('CITY_MAX_LENGTH', 8);
define('COMMENTS_MAX_LENGTH', 200);
define('MAX_PRICE', 10001);
define('MAX_QUANTITY', 99);
define('ZERO_UNIVERSAL', 0);
define('ROUND_DECIMAL_PLACES', 2);
define('LOCAL_TAX_VALUE', 15.2);
define('UNIVERSAL_HUNDRED', 100);
define('FIRSTNAME_MAX_LENGTH', 20);
define('LASTNAME_MAX_LENGTH', 20);
define('USERNAME_MAX_LENGTH', 12);
define('PASSWORD_MAX_LENGTH', 255);
define('ADDRESS_CITY_PROVINCE_MAX_LENGTH', 25);
define('POSTAL_CODE_MAX_LENGTH', 7);

//staring the session on load of the page using single file
session_start();

//single error reporting function call for all the pages
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

//advertisement images, name, price array for index/home page.
$advertisingBikes = array(
    array(
        "name" => "NCM Moscow",
        "price" => 1900,
        "src" => FOLDER_IMAGES . 'download.jpg'
    ),
    array(
        "name" => "NCM Moscow Fat",
        "price" => 2020,
        "src" => FOLDER_IMAGES . 'images1.jpg'
    ),
    array(
        "name" => "NCM Supreme",
        "price" => 2400,
        "src" => FOLDER_IMAGES . 'download1.jpg'
    ),
    array(
        "name" => "Moscow",
        "price" => 1000,
        "src" => FOLDER_IMAGES . 'download3.jpg'
    ),
    array(
        "name" => "NCM",
        "price" => 1500,
        "src" => 'IMAGES/download2.jpg'
        ));


//common header function for all the pages. 
function createPageHeader($title, $cssClass) {   
    //common HTML page Header
    //forced browser url to connect to secure url
    if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
    
    //sending all the headers.
    header('Content-Type: text/html; charset=UTF-8');
    header("Expires: Fri, 02 Dec 1994 16:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ?><!DOCTYPE HTML>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
            <link href="<?php echo MAIN_FILE_CSS; ?>" rel='stylesheet' type='text/css' />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- set title of the page dynamically -->
            <title><?php echo $title; ?></title>
        </head>
        <?php
        // set body class to null from pages. and for print pass the css class as parameter.
        echo '<body class="' . $cssClass . '">';
        //function to display navigation menu
        displayNavigationMenu($cssClass);
    }

    
    //Common footer function to set footer in all the pages
    function createPageFooter($id) {   
        //common HTML page Footer
        ?> 
        <footer class="w3-container w3-padding-64 w3-center w3-black w3-large" id="<?php echo $id; ?>">
            <?php displayContactIcons(); ?>
            <p class="w3-medium">
                <?php displayCopyright(); ?>
            </p>
        </footer>
    </body>
    </html>
    <?php
}


//function to display copyrights
function displayCopyright() {
    echo "<span id='copyright'> Powered by &copy; Yash Ashokkumar Shah- 2014107 " . date("Y") . "</span>";
}

//function to load navigation menu
function displayNavigationMenu($cssClass) {
    echo '<header>';
    echo '<nav class="w3-bar w3-red" id="header">';
    //call displayLogo function to load the logo.
    displayLogo($cssClass);
    //array for all the navigation page links. add new page links here for navigation here.
    $navigation_menu_array = array(
        array(
            "name" => "HOME",
            "src" => PAGE_INDEX
        ),
        array(
            "name" => "SHOP",
            "src" => PAGE_SHOP
        ),
        array(
            "name" => "ORDERS",
            "src" => PAGE_ORDERS
        ),
        array(
            "name" => "CONTACT",
            "src" => PAGE_CONTACT
        ),
        array(
            "name" => "LOGIN",
            "src" => PAGE_LOGIN
        ),
        array(
            "name" => "LOGOUT",
            "src" => PAGE_LOGOUT
    ));
    
    //dynamically load nav menu
    foreach ($navigation_menu_array as $nav_menu) {
        //check for session login logout
        if ($nav_menu['name'] == "LOGIN" || $nav_menu['name'] == "LOGOUT") {
            if ($nav_menu['name'] == "LOGOUT" && readSession()) {
                echo '&nbsp<a href = "' . PAGE_REGISTER . '" class="w3-button w3-bar-item" id="nav-button">UPDATE PROFILE</a>';
                echo '&nbsp<a href = "' . $nav_menu['src'] . '" class="w3-button w3-bar-item" id="session">' . $nav_menu['name'] . '</a>';
            } else if ($nav_menu['name'] == "LOGIN" && !readSession()) {
                echo '&nbsp<a href = "' . $nav_menu['src'] . '" class="w3-button w3-bar-item" id="session">' . $nav_menu['name'] . '</a>';
            }
        } else {
            if (!readSession() && ($nav_menu['src'] == PAGE_SHOP || $nav_menu['src'] == PAGE_ORDERS)) {
                $nav_menu['src'] = PAGE_LOGIN;
            }
            echo '&nbsp<a href = "' . $nav_menu['src'] . '" class="w3-button w3-bar-item" id="nav-button">' . $nav_menu['name'] . '</a>';
        }
    }

    echo '</nav>';
    echo '</header>';
}

function displayLogo($cssClass) { 
    //Common Display Logo Function. If Admin wants to change the Logo Do it from here
    echo '&nbsp<img class="' . $cssClass . ' w3-button w3-bar-item" src="' . LOGO_FILE_IMAGE . '"  id="logo">';
}

function displayContactIcons() {
    //change links to personalised Contact
    $contacts_array = array(
        array(
            "class" => "fa fa-facebook-official",
            "src" => PAGE_INDEX
        ),
        array(
            "class" => "fa fa-twitter",
            "src" => PAGE_SHOP
        ),
        array(
            "class" => "fa fa-instagram",
            "src" => PAGE_CONTACT
        ),
        array(
            "class" => "fa fa-linkedin",
            "src" => PAGE_CONTACT
    ));

    foreach ($contacts_array as $contact) {
        echo '&nbsp<a href = "#" ><i class="' . $contact['class'] . '"></i>';
    }
}
/*
place order code node needed now
function placeOrder($productCode, $fname, $lname, $city, $comment, $price, $quantity) {
    $price = round($price, ROUND_DECIMAL_PLACES);
    $subtotal = round($price * $quantity, ROUND_DECIMAL_PLACES);
    $taxes = round($subtotal * LOCAL_TAX_VALUE / 100, ROUND_DECIMAL_PLACES);
    $total = round($subtotal + $taxes, ROUND_DECIMAL_PLACES);
    $purchase = array('productCode' => $productCode, 'firstName' => $fname, 'lastName' => $lname, 'city' => $city, 'comment' => $comment, 'price' => $price, 'quantity' => $quantity, 'subTotal' => $subtotal, 'taxes' => $taxes, 'total' => $total);
    $purchaseString = json_encode($purchase);

    $myfile = fopen("./" . FILE_ORDERS, "a") or die("File not found");
    $file = "./" . FILE_ORDERS;
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    $stack = json_decode($contents);
    array_push($stack, $purchase);
    $purchaseString = json_encode($stack);
    file_put_contents("./" . FILE_ORDERS, $purchaseString . FILE_EOL);
    fclose($myfile);
}
*/

//save error message fucntion if error occured
function errorMsg($errorNum, $errorString, $errorfile, $errorline, $errorconn) {
    $debug = true;

    if ($debug) {
        echo "<br>Error Level: " . $errorNum;
        echo "<br>Error : " . $errorString;
        echo "<br>File Name : " . $errorfile;
        echo "<br>File Line : " . $errorline;
        echo "<br>Error Code: " . $errorconn;
        echo "<br>Browser: " . json_encode(get_browser($HTTP_USER_AGENT));
        echo "<br>Date: " . date('Y-m-d H:i:s.u');
        $errorArray = array($errorNum, $errorString, $errorfile, $errorline, $errorconn, json_encode(get_browser($HTTP_USER_AGENT)), date('Y-m-d H:i:s.u'));
        //convert array to string
        $errorString = json_encode($errorArray);
        //open the log.txt file
        $myfile = fopen("./LOG/log.txt", "a") or die("File not found");
        //save the error string in log.txt
        fwrite($myfile, $errorString . FILE_EOL);
        //close the file
        fclose($myfile);
    }

    die("<br>");
}

function databaseErrorMessage($e){
        $debug = true;

    if ($debug) {
        echo "<br>Error: ";
        echo "<br>Error Mesage: " . $e->getMessage();
        echo "<br>File Name : " . $e->getFile();
        echo "<br>File Line : " . $e->getLine();
        echo "<br>Error Code: " . (int)$Exception->getCode( );
        echo "<br>Browser: " . json_encode(get_browser($HTTP_USER_AGENT));
        echo "<br>Date: " . date('Y-m-d H:i:s.u');
        $errorArray = array($e->getMessage(), $e->getFile(), $e->getLine(), (int)$Exception->getCode( ), json_encode(get_browser($HTTP_USER_AGENT)), date('Y-m-d H:i:s.u'));
        //convert array to string
        $errorString = json_encode($errorArray);
        //open the log.txt file
        $myfile = fopen("./LOG/log.txt", "a") or die("File not found");
        //save the error string in log.txt
        fwrite($myfile, $errorString . FILE_EOL);
        //close the file
        fclose($myfile);
    }

    die("<br>");
}

function ExceptionMsg($exception) {
    $debug = true;

    if ($debug) {
        echo "<br>Error Level: " . $exception->getLevel();
        echo "<br>Error : " . $exception->getMessage();
        echo "<br>File Name : " . $exception->getFile();
        echo "<br>File Line : " . $exception->getLine();
        echo "<br>Error Code: " . $exception->getCode();
        echo "<br>Browser: " . json_encode(get_browser($HTTP_USER_AGENT));
        echo "<br>Date: " . date('Y-m-d H:i:s.u');
        $errorArray = array($exception->getLevel(), $exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getCode(), json_encode(get_browser($HTTP_USER_AGENT)), date('Y-m-d H:i:s.u'));
        $errorString = json_encode($errorArray);
        $myfile = fopen("./LOG/log.txt", "a") or die("File not found");

        fwrite($myfile, $errorString . FILE_EOL);

        fclose($myfile);
    }

    die("<br>");
}

//remove and test for HTML injection
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create session function
function createSession($id) {
    // Initialize the session
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    // Redirect user to welcome page
    header("location: index.php");
    die();
}

// Return true if session is set else false.
function readSession() {
    $loginBool = false;
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $loginBool = true;
    }
    return $loginBool;
}

function deleteSession() {
    // Initialize the session.
    // If you are using session_name("something"), don't forget it now!
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
        );
    }


    // Finally, destroy the session.
    session_destroy();

    // Redirect to login page
    header('location: index.php');
    die();
}

/* function checkPrintCommand() {
    $showPrint = false;
    if (!empty($_GET['command'])) {
        if ($_GET['command'] === 'print') {
            $showPrint = true;
        }
    }
    return $showPrint;
} */
?>