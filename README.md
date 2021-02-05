# Ecommerce-Website-PHP
This repository is a demonstration of how to create a Ecommerce website in PHP.
Please Check the requirements given by the professor.
The requirements are mentioned in Database-Requirement.pdf and Website-Requirement.pdf

Database-Requirement:

You have to do this project by implementing all the following working methods:
1. At the very top of all the stored procedures and views you submit you must
write your name and student number. Also write the date of the file
creation. You must also write comment(s) to describe what occured at the
written date(s). Use comments similar to the following ones (you may
improve them, for example, by adding a VERSION column, like v1.0):
#Revision history:
#DEVELOPER DATE COMMENTS
#Bill Torvalds (1244556) 2020-03-14 Created the customers_insert
# stored procedure.
#
#Bill Torvalds (1244556) 2020-03-16 GRANT permission to webuser.
2. Your database and all the fields it contains must use utf8mb4_general_ci
collation setting.
3. Give clear names to your database, tables, fields, views and stored procedures.
4. Create a primary key for all tables. Use a new UUID (Universally Unique
Identifier) as the default value for all the primary keys.
5. Create UNIQUE indexes for all fields who require it.
6. Create indexes for all fields used for sorting or filtering.
7. Prevent NULL values when a field is mandatory.
8. All the SQL code must be placed in stored procedures.
9. Use indentation in the stored procedures. Your SQL code must never be
written entirely in one single line. Press ENTER before SQL keywords.
10. Use comments in every table, view and stored procedure to include the
revision history and to explain briefly what the SQL code is doing. Use only
# or - - (you can use /* */ but only for debugging).
11. Create a SQL user. Use the word "user-" followed by your student number
as the account name (for example user-1244556). Give permissions to this
user so he/she will be able to call all the stored procedures and views. Don’t
give any other access to this user.
Description of the project
For this project, you have to build a database that will be used to improve the
website you created in project 1. The database name should be
database-xxxxxxx (replace xxxxxxx with your student number).
Tables
You must create 3 tables. Read carefully the requirements to determine which fields
are required. For all these fields, give a relevant name, select the correct data type,
and an appropriate field length large enough to store all the required data, but not
too big to waste space on disk (see ColumnStore Data Types in MariaDB doc).
Every table must have 2 extra fields to store the date and time of the object
creation and modification. It is not acceptable for these fields to contain no value,
so the default value for both of them should be the current date and time..
A)customers
We need to keep track of the customers who buy products on the website. We
thus need the firstname and the lastname (20 characters maximum for both),
the address, the city and the province (maximum 25 chars for all these fields,
including the city (8 characters was not big enough)) and the postal code (7
chars max). It should also contain 2 fields to store the username (maximum 12
characters, and it is forbidden for 2 different customers to use the same
username) and the password (maximum 255 characters) required for login.
B)products
This table is used to store all the products sold on your website. Each product
is identified by a product code of maximum 12 characters. We need to store
the description of the product (maximum 100 characters). We also need
to store the price of the product (number with 2 decimals only, never save
more than 2 decimals in the database. Maximum amounts should be 10000$).
We should also have a cost price (i.e. the price the company paid for it before
selling it, use 2 decimals), but this field is optional.
C)purchases
This is used to store the purchases. It should contain foreign keys pointing to
the primary keys of customers and products tables. The table should also
contain the quantity sold (max 999) and the price of the product at the
moment of the sale (so the past sales will not be affected if we change the
price of the products in the database). All these fields are mandatory. Add
another field for the comments (maximum 200 characters) which is optional.
Views
Create a view to show all the fields from the products table. Sort by product
code.
Stored procedures
You must create stored procedures to SELECT, INSERT, UPDATE and
DELETE data in all the created tables (3 tables * 4 stored procedures = 12 stored
procedures). The SELECT stored procedure should select all the data and sort it.
The UPDATE and DELETE stored procedure needs to have a primary key passed
as a parameter. Figure out which parameters are needed for the INSERT procedure.
In addition to the basic stored procedures, you must also create the following 2
stored procedures:
1. Get the password for a given username
This stored procedure should accept a username and return its
corresponding password (which will be encrypted later) if it exists.
2. Filter the purchases
This stored procedure should accept an optional DATETIME parameter. If a
date is passed as the parameter, you should return all the purchases made on
that date or later. If no parameter is specified, or if NULL is passed as a
parameter, it should return all the purchases for a specific customer. The fields
should be sorted from the most recent to the oldest purchases.
In both cases (parameter passed or not) sort the returned data by create
DATETIME from the most recent purchase to the oldest one.
Files to submit
Submit your database backup in a file called database-xxxxxxx.sql (replace
xxxxxxx with your student number, for example database-1244556.sql).
This SQL file should be able to create the database, all the tables, all the all data
they contain (INSERT INTO ...), and all the views and stored procedures.
Submit another SQL file (or include it in the previous file) to create the SQL user
required to run your website, and all its permissions (GRANT) for the stored
procedures. The filename should be called permissions-xxxxxxx.sql (replace
xxxxxxx with your student number, for example permissions-1244556.sql).
Warning, HeidiSQL GUI cannot export the objects permissions, so if you want to
get points for the user and permissions, use the SHOW GRANTS command.


Website-Requirement:

You have to do this project by implementing all the following working methods:
1. All the files required in this project must be included in a Subversion
repository. Everytime you work on the project, and the end of every day of
work, you must commit your work to the repository (even if the code
temporarily contains errors). For every commit you do, write a commit
message which should include your name and student number, the date of
the commit, and a short description of what you did during that day. For
example, this is a valid commit message:
Bill Torvalds (1244556) 2020-09-30 Created NetBeans project and empty folders.
Note: You may also add more information in the commit message, like a version number, or important steps in
the development of your website.
2. At the very top of all the text files you submit (i.e. all your .php files, .css
file(s), your PHP cheat sheet, etc. (EXCEPT the Subversion dump file) you
must write a revision history which should include all the commit messages,
including your name and student number, the date of the commit, and a
short description of the work done:
#Revision history:
#
#DEVELOPER DATE COMMENTS
#Bill Torvalds (1244556) 2020-09-30 Created NetBeans project and empty folders.
#Bill Torvalds (1244556) 2020-10-01 Created buy.php file and completed about
# 50% of requirements for this page.
#Bill Torvalds (1244556) 2020-10-03 Created and completed purchase.php file.
#Bill Torvalds (1244556) 2020-10-05 Fixed the bug in the taxes calculation.
#Bill Torvalds (1244556) 2020-10-10 Commented debugging code. Entire project
# completed at 100%.
3. Use a lot of comments in the code of all your files. Use only // or # (except
for debugging).
4. Use folders for CSS, Images, JavaScript, PHP common functions, and more.
5. Use constants to avoid hard-coding. For example use:
define(“CUSTOMER_FIRSTNAME_MAX_LENGTH”, 15); #Max length of firstname
define(“FILE_PHP_COMMON”, FOLDER_PHP . “commonFunctions.php”);
Note: MAX is an abbreviation but its meaning is clear.
6. Always use relative paths. Never use absolute paths for files and folders.
Make sure the variables containing files and folders are using the correct
letter case. For example if a filename is PHPFunctions.php, don’t create a
constant with the value “phpfunctions.php” (lowercase) or your website may
crash (on your server or on a Linux server).
7. Give clear names to your variables and functions.
8. Use correct indentation for the code and the curly brackets.
9. You must always use functions to generate the HTML code. For example,
<!DOCTYPE html> should only be typed once in all the project, even if three
different pages echo it. These common functions should be placed in a PHP
file located in the PHP functions folder.
10. Every page of your website must send all the HTTP headers required to
prevent page caching, so when users will reload the page, they will always
get the latest version of your files.
11. Every page of your website should be able to display all the canadian french
characters. So all the files from your website must handle UTF-8 properly
with the correct HTML tag and UTF-8 HTTP header.
12. You must always send all the network headers before you start to echo the
<!DOCTYPE html> text and the rest of the HTML code.
13. Your PHP code must always generate valid HTML. Use View Page Source
in your browser to make sure all your pages contain no malformed html
(which would be displayed in red).
14. You must protect all the PHP pages against HTML and JavaScript injection.
15. If an error/exception occurs in your code, save the details into a specific
folder and log file (give them names). The log file should contain all these
details: the description of the error, the error code (if available), the date and
time when the problem happened (format should be year/month/day
hour:minute:second.microsecond), the name of the PHP file, the line number of
the error, and the browser version of the client. You should also create a
boolean constant to show the details in the browser, for debugging, or to hide
the details to the users (client side) and just display a generic error.
16. When all your tests are done and conclusive, comment all your debugging
code and set the constant of guideline 15. to false because the browser (client
side) must never show technical (server side) information to the users.
Guidelines added since Project 1:
17. You must protect all your PHP pages against SQL injection.
18. In the entire project, there must be only one connection string. If we need to
connect on another database, or with another MySQL user/password, we have
to change only one single centralized connection string that will impact the
whole website.
19. The entire website must use only the MySQL user/account you created in
Project 2. This user account should have very limited rights on stored
procedures and views only. When submitting your project never use root in
the connection string. You can use root to debug your website, but don’t forget
to put back the secure MySQL user before delivering your website.
20. All the website should use a certificate and private key to encrypt the
network communications. Force the website to use the HTTPS port. Submit
the .key and .crt files.
Description of the project
For this project, you have to finish the website you started with Project 1 and
Project 2.
All the PHP files that generate HTML code should use a common PHP functions
file (like Project 1).
All the website should use a secure (HTTPS) connection. When submitting your
project, also include the .crt and .key file which should contain your student
number, for example, 1234567.crt and 1234567.key. When creating the files, enter
your student number for the Organization Name. Submit also the Apache
configuration file necessary to enable these 2 files. Finally, force all the users of
your website to use the HTTPS connection. If a user tries to acces it with HTTP
(port), redirect him/her on the secure port.
Objects:
You need to write plural and singular objects/classes to manage the data which is
in the database. There are 3 tables in the database so you will need 6 classes and 6
different files in a folder:
• customer
• customers
• product
• products
• purchase
• purchases
Each singular class must follow these requirements:
1. Every field in the tables must have a private variable in the object.
2. The constructor of the object should fill-in these variables if they are passed
as parameters. The parameters should be optional. The constructor should use
the Add method to validate the data (see plural class section).
3. All the private variables (except the primary key) must have corresponding
public get/set functions. For example, for the field called "firstname" in the
database, you will need these functions:
getFirstname()
setFirstname($newFirstname)
The set function should be used to validate the data. Return an appropriate
error message if the validation fails (for example, "The firsname could not
contain more than CONSTANT characters"). Return NULL or FALSE when
the field is valid. These error messages are intended to be displayed in red
near the corresponding fields when there is a validation error (Project 1). You
must also retain the typed value
4. You must create 3 functions to load, save and delete the data in the database.
You should use the stored procedures you created in Project 2. The save
function should be able to save new data (INSERT) or existing data
(UPDATE). You can solve that in PHP or in the stored procedure(s). You may
create any other stored procedure if you need it (grant EXECUTE rights to
your MySQL user if you do it). You may also add any others functions to the
object if you need it.
Each plural class must follow these requirements:
1. You must use inheritance to centralize the following:
• A variable used to store the list/collection/array of all the singular
objects. For example, the customers object should keep a
list/collection/array of many customer objects.
• Functions to add, remove, get and count the objects in the list (not in
regards to the database).
2. The constructor of the class should fill the list/collection/array with all the
rows returned by the SELECT stored procedure you created in Project 2. For
the purchases, load the collection only with the purchases made by the logged
in user.
Your entire website must always use these objects to manage the customers,
products and purchases.
Website pages
You must not use any style attribute directly in HTML tags. All the pages should
make use of at least one .css file and all the pages must have a background color
or image. The design of your pages must not look too minimalistic.
The website consists of 4 (or 5) pages, which must display a different <title> in the
browser tab. All the pages of the website should call a single PHP function to
manage the login and the logout:
Function for login/logout
This code should be placed in a function located in the common functions PHP file
because it must be used on all pages of your website. So on all pages of the
website, if a user is not connected, you should display a login <form> like this:
Username:
Password:
Login
Need a user account ? Register
If the user clicks the Login button, validate the username and password against
the encrypted password in the database (in the customers table). If the username
and/or password are not valid, display a general error message on the screen and
let the user try again (for that form, no need to fill-in the username/password
previously entered). If the user clicks Register, simply redirect him/her to the
register.php page (explained later).
If the user enters a valid username/password, create a $_SESSION variable to
store the primary key of this user/customer, and reload the page. When a user is
logged-in, the function that usually display a login <form> on all pages should
instead display a logout <form>:
Welcome firstname lastname
Logout
The firstname and lastname should correspond to the logged-in customer, so you
have to load them with a customer->login($username, $password) function
which will load all the object properties if the username/password are correct.
If the user clicks Logout, it should destroy the $_SESSION variable and reload
the page, thus preventing the access to many pages on the website.
Pages required for your website
• index.php
This page can be consulted even by a user which is not connected to your website.
This is the welcome page that displays the logo of the company and the description
you made of it. The logo should also be included in all the pages of your website.
This page, and all the others, should display the same navigation menu to browse
all the following pages: index.php, buy.php, purchases.php and account.php.
In addition of the company description, this page should contain a link to open
your latest CHEAT SHEET which is asked since the beginning of the semester.
• register.php
This page can be consulted only by a user which is not connected to your website.
This page is used to create a customer. You should display a register <form> like
this (your website should display * = required and display the red * near the
required textboxes):
Firstname: *
Lastname: *
Address: *
City: *
Postal code: *
Username: *
Password: *
Register
Note: When we type the password, we must not see the letters. Also you
must encrypt the password before saving it in the database.
Like in Project 1, validate the data (but use the get functions to do it) and
display each error message near the corresponding field. There is no need to
write a clear message if the user tries to create an already existing username
(which is UNIQUE in the database). The code may raise an error. It’s correct
as long as the system does not permit duplicate usernames in the table.
Note: This register.php page must NOT be displayed in the Navigation menu
visible on every page. It can only be accessed via the login <form>.
• buy.php
This page can only be viewed if a user is connected to your system. If the user is
not connected, display a message which tells the user he/she must login to the
system to access this part of the website. Display also the login <form>.
Else, display the logout <form> and the following buy <form> used to perform a
purchase (your website should display * = required and display the red * near
required textboxes):
Product code: ▼ *
Comments:
Quantity: *
Buy
The product code dropdown should be filled with the data from the database.
The product code dropdown should display the product code, a hyphen, and the
description, for example "P43helmet – Motorcycle Full Face Helmet". However
when saving data, don’t save the code or description but the product_uuid that
corresponds to them.
The comments field is optional but must not exceed 200 characters.
The quantity field must be a numeric value between 1 and 99. No decimals are
allowed, so a quantity of 1.3 is not valid.
If the data from some fields is not valid, you have to write in red, near every
corresponding field, a clear error message telling the user how to solve the
problem (for example: The last name cannot contain more than 20 characters).
When all the data is valid, you have to save it in the database (purchases table).
Don’t forget to specify the UUID of the user that is currently logged in the system
for the purchases.customer foreign key.
Some fields were not mentionned in Project 2 so you have to add them to the table,
stored procedures and code. Always follow good working methods (field size, etc.).
Backup the new database definition before you submit project 2.
The first missing field you need to add to the table is the subtotal which represents
the price of the product (available in product object) multiplied by the quantity. You
then have to apply the local taxes of 15.2% (the taxes rate changed since Project 1)
to this subtotal to get the taxes amount in dollars (second missing field). Finally,
add the subtotal to the taxes amount to get the grand total (third missing field).
Save these 3 fields in the database and make sure you always save only 2 digits for
all amounts in the database.
Example of taxes calculation
Let say a user selects P43helmet – Motorcycle Full Face Helmet in the dropdown.
When you POST the buy <form> you receive the product_uuid. Use that primary_key
to call the product->load() function. Then get the price for this product. For example:
#Load the product
$product->load( htmlspecialchars($_POST["product"]);
#Let say the price is 49$ in the database
$price = $product->getPrice().
#and the quantity 2
$quantity = htmlspecialchars($_POST["quantity"]); #not secure against HTML injection
#Then you multiply the price by the quantity, which gives you the subtotal:
$subtotal = 49 multiplied by 2; #98$
#calculate the taxes amount by multiplying the subtotal with the taxes rate
$taxesAmount = $subtotal multiplied by the TAX_RATE; #use a constant!
#This gives 14.896
#finally add the subtotal to the taxes amount
$grandTotal = 98 plus 14.896; #this gives 112.896
Then instead of saving all this information in a file, save all these fields in the
purchases table:
product_uuid (the product selected in the dropdown)
customer_uuid (the customer selected in the dropdown)
quantity (how many items the user wanted)
price (actual price of product. If tommorow we change product price
in products table, we’ll still be able to see the billed price)
comments, subtotal, taxes_amount, grandtotal (as explained earlier)
When a purchase is complete, redirect automatically to the purchases page.
• purchases.php
This page can only be viewed if a user is connected to your website. If the user is
not connected, display a message which tells the user he/she must login to the
system to access this part of the website. Display also the login <form>.
Else, display the logout <form> and a search <form> similar to this one:
Show purchases made
on this date or later: 2020-03-13
Search
When the user clicks the Search button, you should call the customer object, which
should call the stored procedure you created in Project 2 to filter the purchases.
Modify the stored procedure (and backup your DB) because you need to show the
purchases only for the customer which is logged to the website. The
customer_uuid which is in the $_SESSION variable should help you with this
requirement.
If the user specifies a valid date, use it to show the purchases made on that day or
later, or if you prefer, show purchases made on a create_datetime greater or equal
to the valid date. Sort by the create_datetime field.
If the user specifies a date which is not valid, it is not mandatory to write an "error"
message but you must show all the purchases in the database for this customer.
To fetch the data from the purchases table, use AJAX and the purchases object.
The AJAX call should query a page which will generate only a HTML <table>
with the appropriate column headers, <tr> and <td>. This table should show only
the purchases made by the user which is logged in the website. You must also
find a way to delete a purchase.
All the borders must be visible, so the table may look like this:
Delete Product
code
First
name
Last name City Comments Price Qty Subtotal Taxes Grand
total
Delete Phelmet4b Ben Masvidal Montréal 49.99$ 2 99.98$ 12.05$ 112.03$
Delete Pgloves675 Justin Legault Québec 10 % rebate 22.49$ 1 22.49$ 2.71$ 25.20$
Important: the dollar ($) signs must not be saved in the text file, but should only be added in the
HTML <table> for display. Always display amounts with 2 decimals.
To avoid multiple calls to the database, the stored procedure which filters the
purchases should make use of the JOIN command to fetch data from the 3 tables.
The Delete button should delete the corresponding purchase row in the database
(no confirmation needed). If you prefer to use another way to delete a purchase
(even outside of the HTML table and AJAX call) you will get the marks for it.
• account.php
This page can only be viewed if a user is connected to your system. If the user is
not connected, display a message which tells the user he/she must login to the
system to access this part of the website. Display also the login <form>.
Else, display the logout <form> and the same register <form> which is in the
register.php page. The form should be filled-in with the information found in
the database for the current user (except the password which needs to be typed
again (old password or new password, just save the new password encrypted in
the database)):
Firstname: Linus *
Lastname: Gates *
Address: 1 OS Drive *
City: Freedom *
Postal code: G1B 6D2 *
Username: Linux *
Password: ●●●●●● *
Update info
Note: When typing the password, we must not see the letters. Also
you must encrypt the password before saving it in the database.
The validation is all the same than the register.php page except that when the
data is valid, you must UPDATE the data in the database instead of inserting it.
Even if you change the password for the user, there is no need to logout the user
from the website. However, next time he/she will have to use the new password.
Optional (advanced): Instead of creating an account.php page, you can modify
the register.php page to accomplish both tasks (INSERT (register) and
UPDATE (Update info). If you do this, make sure not to create any bug.
Files to submit
When your website is ready, place all your files (the whole PHP project including
your PHP cheat sheet) in a single compressed folder (.zip file). Make sure your .zip
file is not corrupted by extracting its contents into a different folder. Upload that
single verified .zip file on Omnivox to submit your project.
Don’t forget to also submit your latest database backup and GRANTS .sql files
required with Project 2, and required to run your Project 3 properly.
