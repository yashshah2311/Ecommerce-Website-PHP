<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-10-29         Created Shopping Filer.
#YASH (2014107)     2020-10-30         Created Header footer and body.
#YASH (2014107)     2020-10-30         Completed Project. Final Commit. Fixed Everything.
#YASH (2014107)     2020-11-24         Fixed the issuses given in project 1.
#YASH (2014107)     2020-11-29         Removed Bug and Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-12-03         Removed form and implemented AJAX function call.
#YASH (2014107)     2020-12-04         Added Date input.
#YASH (2014107)     2020-12-11         Added css for scroll the orders in small screens

//include and define require files and constants
include 'PHPFunctions/PHPFunctions.php';
define('SCRIPT_FILE', FOLDER_JAVASCRIPT . 'AJAX.js');

//set error handlers
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

//check session and if not logged in then redirect to index page
if (!readSession()) {
    header("location: login.php");
}

//set empty variables
$showPrint = $showColor = false;
$div_color = " ";
//check in headers for get command equal to color/print
if (!empty($_GET['command'])) {
    if ($_GET['command'] === 'color') {
        //if color set showcolor true
        $showColor = true;
    } else if ($_GET['command'] === 'print') {
        //if print set showprint true
        $showPrint = true;
    }

    if ($showPrint) {
        $div_color = 'color-print';
    }
}

//create header using common function
createPageHeader('Orders', $div_color . ' scroll');
?>
<!--call script file for ajax-->
<script language="javascript" type="text/javascript" src="<?php echo SCRIPT_FILE; ?>"></script>
<div class="w3-container w3-padding-16" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-4">Orders</h3>
    <p>Order details.</p>
    <p>
        <!--input for date search and button-->
        <label><b>*</b>Show purchase made on this date or later :</label>
        <input type="date" id="searchQuery" class="purchase-date" name="purchase-date">
        <!--On click searchPurchases() will load ajax response-->
        <button class="w3-button w3-black" onclick="searchPurchases();"><i class="fa fa-paper-plane"></i> SEARCH ORDERS</button>
    </p>
    <!--ajax response will be loaded here-->
    <div id="searchResults"></div>
</div>
<?php
//create footer using common page
createPageFooter('footer');
?>
