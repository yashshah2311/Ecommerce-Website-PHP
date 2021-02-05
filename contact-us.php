<?php
#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-10-19         Created Contact-us page.
#YASH (2014107)     2020-10-30         Completed Project. Final Commit. Fixed Everything.
#YASH (2014107)     2020-10-30         Removed Bugs.
#YASH (2014107)     2020-12-04         tested errors here.

include 'PHPFunctions/PHPFunctions.php';
createPageHeader('Contact US', " ");
?><div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact Us</h3>
    <p>Write us here for any product related inquiries.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width: 30%;">
        <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
        <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="Email">
        <input class="w3-input w3-section w3-border" type="text" placeholder="Subject" required name="Subject">
        <input class="w3-input w3-section w3-border" type="text" placeholder="Comment" required name="Comment">
        <button class="w3-button w3-black w3-section" type="submit">
            <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
    </form>
</div><?php
createPageFooter('footer');
?>