<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-24         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-24         Tested Header and Footer PHPFunctions.
#YASH (2014107)     2020-11-29         Logout from function in Customer class.

require_once 'customer.php';

//set error handlers
error_reporting(0);
set_error_handler("errorMsg");
set_exception_handler("ExceptionMsg");

//on logout click this page will load and destroy the session
$customer = new customer();
$customer->logout();
?>