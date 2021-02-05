<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-10-19         Created NetBeans project and empty folders.
#YASH (2014107)     2020-10-21         Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-10-21         Removed <!DOCTYPE HTML> as it should be used only Once.
#YASH (2014107)     2020-10-29         Fixed CSS, Added code for Advertizing.
#YASH (2014107)     2020-10-29         Changed url from static to constant for script file.
#YASH (2014107)     2020-10-30         Completed Project. Final Commit. Fixed Everything.
#YASH (2014107)     2020-11-24         Fixed the issuses given in project 1. 
#YASH (2014107)     2020-11-27         Removed Bug and Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-11-29         Load Welcome label using session and name using class.
#YASH (2014107)     2020-12-04         Fixed bug while loading data.

//required constants and classes
require 'customer.php';
define('SCRIPT_FILE', FOLDER_JAVASCRIPT . 'script.js');

//error handlers if error occurs in php
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

//create header and set title
createPageHeader('Index', " ");
//shuffle advertisement images
shuffle($advertisingBikes);
//create new object of customer to load it's first name and last name
$customer = new customer();
?>
<!-- this div is to view/download cheatsheet -->
<div class="w3-container w3-padding-4" id="contact">
    Cheat Sheet: <button type="submit" onclick="window.open('cheat_sheet.txt')">Click here to View!</button>
    <button>
        <a id="download" href="cheat_sheet.txt" download>Click here to Download!</a>
    </button>
</div>
<!--common div to load advertising images-->
<div class="w3-content w3-display-container">
    <h2><span class="index-title">
            <?php
            //if session is set load customer first name, last name and then show welcome message
            if (readSession()) {
                $customer->load($_SESSION["id"]);
                $customerFirstName = $customer->getFirstname();
                $customerLastName = $customer->getLastname();
                echo '<div>WELCOME ' . $customerFirstName . " " . $customerLastName . '</div>';
            }
            ?>
            <!--website description-->
            Power up your Journey</span> 
        <br>Take the streets</h2>

    <?php
    //set index for shuffled advertising image to load price accordingly 
    $i = 0;
    //load advertising image from array
    foreach ($advertisingBikes as $advertise) {
        $i = $i + 1;
        if ($advertise['name'] == "NCM Supreme") {
            echo '<span class="mySlides my-slide-border">';
            echo '<a href="https://www.newegg.ca/" target="_blank"><img class="advertising" src="' . $advertise['src'] . '"></a>';
            $advertisingBikes[$i]['price'] = 2 * $advertise['price'];
            $advertise['price'] = $advertisingBikes[$i]['price'];
        } else {
            echo '<span class="mySlides">';
            echo '<a href="https://www.newegg.ca/" target="_"><img class="advertising" id="advertise" src="' . $advertise['src'] . '"></a>';
        }
        ?>
        <!--display price of advertising product-->
        <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black price-tag">
            Price: $<?php echo $advertise['price']; ?>
        </div>
    </span>

    <?php
}
?>
<!--buttons to nav between advertising images-->
<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

</div>

<?php
// create common footer using createPageFooter function
createPageFooter('footer');
?>
<!--call script file-->
<script src="<?php echo SCRIPT_FILE; ?>"></script>