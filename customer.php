<?php

#Revision History
#DEV                DATE               DESC
#YASH (2014107)     2020-11-24         Created NetBeans project and empty folders.
#YASH (2014107)     2020-11-25         Created constructor and getter and setter method for all fields.
#YASH (2014107)     2020-11-26         Created Load, Save, Delete, login , logout function.
#YASH (2014107)     2020-11-27         Added validation for all the fields.
#YASH (2014107)     2020-12-04         Added global error field.
#YASH (2014107)     2020-12-11         Replaced sql query with stored procedure.
#YASH (2014107)     2020-12-11         Added column constants.

require_once('database-connection.php');
include 'PHPFunctions/PHPFunctions.php';

class customer {
    // All private fields only for class
    private $customer_uuid = "";                        // Customer's uuid
    private $customer_firstname = "";                   // Customer's fname
    private $customer_lastname = "";                    // Customer's lname
    private $address = "";                              // Customer's address
    private $city = "";                                 // Customer's city
    private $province = "";                             // Customer's province
    private $postal_code = "";                          // Customer's postal code
    private $customer_username = "";                    // Customer's username
    private $customer_password = "";                    // Customer's hashed and salted password

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     */
    public function __construct($customer_uuid = " ", $customer_firstname = " ", $customer_lastname = " ", $address = " ", $city = " ", $province = " ", $postalcode = " ", $customer_username = " ", $customer_password = " ") {
        //check if customer uuid is set or not . if it's set assign all other values of the fields.
        if ($customer_uuid != " ") {
            $this->customer_uuid = $customer_uuid;
            $this->customer_firstname = $customer_firstname;
            $this->customer_lastname = $customer_lastname;
            $this->address = $address;
            $this->city = $city;
            $this->province = $province;
            $this->postalcode = $postalcode;
            $this->customer_username = $customer_username;
            $this->customer_password = $customer_password;
        }
    }

    #################################################################
    ###### Getter and Setter method for all the private fields ######
    #################################################################
    
    # getter methods will return the value of the private fields
    # setter methods will validate the value. if not valid it will return error message else assign the values to private fields.

    function getFirstname() {
        return $this->customer_firstname;
    }

    function setFirstname($newFirstname) {
        global $firstname_err, $firstname;
        $firstname = $newFirstname;
        if (mb_strlen($newFirstname) == ZERO_UNIVERSAL) {
            $firstname_err = "The firstname cannot be empty";
        } else {
            if (mb_strlen($newFirstname) >= FIRSTNAME_MAX_LENGTH) {
                $firstname_err = "The firstname cannot conatin more than " .
                        FIRSTNAME_MAX_LENGTH . " characters ";
            } else {
                $this->customer_firstname = $newFirstname;
            }
        }
    }

    function getLastname() {
        return $this->customer_lastname;
    }

    function setLastname($newLastname) {
        global $lastname_err, $lastname;
        $lastname = $newLastname;
        if (mb_strlen($newLastname) == ZERO_UNIVERSAL) {
            $lastname_err = "The Lastname cannot be empty";
        } else {
            if (mb_strlen($newLastname) >= LASTNAME_MAX_LENGTH) {
                $lastname_err = "The lastname cannot conatin more than " .
                        LASTNAME_MAX_LENGTH . " characters ";
            } else {
                $this->customer_lastname = $newLastname;
            }
        }
    }

    function getAddress() {
        return $this->address;
    }

    function setAddress($newAddress) {
        global $address_err, $address;
        $address = $newAddress;
        if (mb_strlen($newAddress) == ZERO_UNIVERSAL) {
            $address_err = "Address cannot be empty";
        } else {
            if (mb_strlen($newAddress) >= ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
                $address_err = "Address cannot conatin more than " .
                        ADDRESS_CITY_PROVINCE_MAX_LENGTH . " characters ";
            } else {
                $this->address = $newAddress;
            }
        }
    }

    function getCity() {
        return $this->city;
    }

    function setCity($newCity) {
        global $city_err, $city;
        $city = $newCity;
        if (mb_strlen($newCity) == ZERO_UNIVERSAL) {
            $city_err = "City cannot be empty";
        } else {
            if (mb_strlen($newCity) >= ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
                $city_err = "City cannot conatin more than " .
                        ADDRESS_CITY_PROVINCE_MAX_LENGTH . " characters ";
            } else {
                $this->city = $newCity;
            }
        }
    }

    function getProvince() {
        return $this->province;
    }

    function setProvince($newProvince) {
        global $province_err, $province;
        $province = $newProvince;
        if (mb_strlen($newProvince) == ZERO_UNIVERSAL) {
            $province_err = "Province cannot be empty";
        } else {
            if (mb_strlen($newProvince) >= ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
                $province_err = "Province cannot conatin more than " .
                        ADDRESS_CITY_PROVINCE_MAX_LENGTH . " characters ";
            } else {
                $this->province = $newProvince;
            }
        }
    }

    function getPostalCode() {
        return $this->postal_code;
    }

    function setPostalCode($newPostalCode) {
        global $postalcode_err, $postalcode;
        $postalcode = $newPostalCode;
        if (mb_strlen($newPostalCode) == ZERO_UNIVERSAL) {
            $postalcode_err = "Postal Code cannot be empty";
        } else {
            if (mb_strlen($newPostalCode) >= POSTAL_CODE_MAX_LENGTH) {
                $postalcode_err = "Postal Code cannot conatin more than " .
                        POSTAL_CODE_MAX_LENGTH . " characters ";
            } else {
                $this->postal_code = $newPostalCode;
            }
        }
    }

    function getUsername() {
        return $this->customer_username;
    }

    function setUsername($newUsername) {
        global $username_err, $username;
        $username = $newUsername;
        if (mb_strlen($newUsername) == ZERO_UNIVERSAL) {
            $username_err = "The Username cannot be empty";
        } else {
            if (mb_strlen($newUsername) >= USERNAME_MAX_LENGTH) {
                $username_err = "The Username cannot conatin more than " .
                        USERNAME_MAX_LENGTH . " characters ";
                //self is constant
            } else {
                $this->customer_username = $newUsername;
            }
        }
    }

    function getPassword() {
        return $this->customer_password;
    }

    function setPassword($newPassword) {
        global $password_err;
        if (mb_strlen($newPassword) == ZERO_UNIVERSAL) {
            $password_err = "The Password cannot be empty";
        } else {
            if (mb_strlen($newPassword) >= PASSWORD_MAX_LENGTH) {
                $password_err = "The password cannot conatin more than " .
                        PASSWORD_MAX_LENGTH . " characters ";
                //self is constant
            } else {
                $this->customer_password = $newPassword;
            }
        }
    }

    #############################################################
    ######        End of getter and setter method         #######
    #############################################################
    
    //load the customer's details using uuid
    public function load($customer_uuid) {
        global $pdo;
        $sql = "CALL load_customer(:p_customer_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':p_customer_uuid', $param_customer_uuid, PDO::PARAM_STR);
                // Set parameters
                $param_customer_uuid = $customer_uuid;
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $this->customer_uuid = $row[COLUMN_CUSTOMER_UUID];
                            $this->customer_firstname = $row[COLUMN_CUSTOMER_FIRSTNAME];
                            $this->customer_lastname = $row[COLUMN_CUSTOMER_LASTNAME];
                            $this->address = $row[COLUMN_CUSTOMER_ADDRESS];
                            $this->city = $row[COLUMN_CUSTOMER_CITY];
                            $this->province = $row[COLUMN_CUSTOMER_PROVINCE];
                            $this->postal_code = $row[COLUMN_CUSTOMER_POSTALCODE];
                            $this->customer_username = $row[COLUMN_CUSTOMER_USERNAME];
                            $this->customer_password = $row[COLUMN_CUSTOMER_PASSWORD];
                        }
                    } else {
                        $username_err = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }
        }catch(PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        //close connection
        unset($pdo);
    }
    
    //Insert or update the customer's details using save method
    public function save($firstname, $lastname, $address, $city, $province, $postalcode, $username, $password, $oldUsername) {
        global $pdo;
        global $firstname_err;
        global $lastname_err;
        global $address_err;
        global $city_err;
        global $province_err;
        global $postalcode_err;
        global $username_err;
        global $password_err;
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setAddress($address);
        $this->setCity($city);
        $this->setProvince($province);
        $this->setPostalCode($postalcode);
        $sql = "CALL check_username(:p_username)";
        try {
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":p_username", $param_username, PDO::PARAM_STR);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if (!empty($username) && $username !== $oldUsername) {
                    if ($stmt->execute()) {
                        if ($stmt->rowCount() == 1) {
                            $username_err = "This username is already taken.";
                        } else {
                            $this->setUsername($username);
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                } else {
                    $this->setUsername($username);
                }
                // Close statement
                unset($stmt);
            }            
        }catch(PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        if (!empty($password)) {
            //if password not empty create hash password and set it to private field after validation
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->setPassword($encryptedPassword);
        } else {
            // if empty set directly so that empty error will come from there.
            $this->setPassword($password);
        }

        if (empty($firstname_err) && empty($lastname_err) && empty($address_err) && empty($city_err) && empty($province_err) && empty($postalcode_err) && empty($username_err) && empty($password_err)) {
            // if no error and if customer uuid is empty then it is register so take insert query.
            if ($this->customer_uuid == "") {
                $sqlQuery = "CALL insert_customer(:p_customer_firstname, :p_customer_lastname, :p_address, :p_city, :p_province, :p_postal_code, :p_customer_username, :p_customer_password)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        $stmt->bindParam(':p_customer_firstname', $customer_firstname, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_lastname', $customer_lastname, PDO::PARAM_STR);
                        $stmt->bindParam(':p_address', $customer_address, PDO::PARAM_STR);
                        $stmt->bindParam(':p_city', $customer_city, PDO::PARAM_STR);
                        $stmt->bindParam(':p_province', $customer_province, PDO::PARAM_STR);
                        $stmt->bindParam(':p_postal_code', $customer_postal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_username', $customer_username, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_password', $customer_password, PDO::PARAM_STR);
                        $customer_firstname = $this->customer_firstname;
                        $customer_lastname = $this->customer_lastname;
                        $customer_username = $this->customer_username;
                        $customer_password = $this->customer_password;
                        $customer_address = $this->address;
                        $customer_city = $this->city;
                        $customer_province = $this->province;
                        $customer_postal = $this->postal_code;
                        try {
                            $stmt->execute();
                            // Redirect to login page
                            header("location: login.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
                        }
                        unset($stmt);
                    }                    
                }catch(PDOException $e){
                    echo "Something went wrong. Please try again later.";
                    databaseErrorMessage($e);
                }
                unset($pdo);
                return true;
            } else {
                // if update profile . customer uuid is already set. update into that customer row of database.
                $sqlQuery = "CALL update_customer(:p_customer_uuid, :p_customer_firstname, :p_customer_lastname, :p_address, :p_city, :p_province, :p_postal_code, :p_customer_username, :p_customer_password)";
//                $sqlQuery = "CALL employee_insert(:firstname, :lastname, :username, :password)";
                try{
                    if ($stmt = $pdo->prepare($sqlQuery)) {
                        $stmt->bindParam(':p_customer_uuid', $this->customer_uuid);
                        $stmt->bindParam(':p_customer_firstname', $customer_firstname, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_lastname', $customer_lastname, PDO::PARAM_STR);
                        $stmt->bindParam(':p_address', $customer_address, PDO::PARAM_STR);
                        $stmt->bindParam(':p_city', $customer_city, PDO::PARAM_STR);
                        $stmt->bindParam(':p_province', $customer_province, PDO::PARAM_STR);
                        $stmt->bindParam(':p_postal_code', $customer_postal, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_username', $customer_username, PDO::PARAM_STR);
                        $stmt->bindParam(':p_customer_password', $customer_password, PDO::PARAM_STR);
                        $customer_firstname = $this->customer_firstname;
                        $customer_lastname = $this->customer_lastname;
                        $customer_username = $this->customer_username;
                        $customer_password = $this->customer_password;
                        $customer_address = $this->address;
                        $customer_city = $this->city;
                        $customer_province = $this->province;
                        $customer_postal = $this->postal_code;
                        try {
                            $stmt->execute();
                            // Redirect to login page
                            header("location: register.php");
                        } catch (PDOException $e) {
                            echo "Something went wrong. Please try again later.";
                        }
                        unset($stmt);
                    }                    
                } catch(PDOException $e){
                    echo "Something went wrong. Please try again later.";
                    databaseErrorMessage($e);
                }
                unset($pdo);
                return true;
            }
        }
    }

    //delete customer information
    public function delete($customer_uuid) {
        global $pdo;
        $this->customer_uuid = $customer_uuid;
        $sql = "CALL delete_customer(:p_customer_uuid)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":p_customer_uuid", $param_uuid, PDO::PARAM_STR);
                $param_uuid = $this->customer_uuid;
                if ($stmt->execute()) {
                    $affectedRows = $stmt->rowCount();
                    return $affectedRows;
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                unset($stmt);
            }            
        }catch (PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        // Close connection
        unset($pdo);
    }
    
    // check login credentials for user trying to log in
    public function login($username, $password) {
        global $pdo;
        global $password_err;
        global $username_err;
        $sql = "CALL check_login(:p_username)";
        try{
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":p_username", $param_username, PDO::PARAM_STR);
                $param_username = test_input($username);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $id = $row[COLUMN_CUSTOMER_UUID];
                            $username = $row[COLUMN_CUSTOMER_USERNAME];
                            $hashed_password = $row[COLUMN_CUSTOMER_PASSWORD];
    /*                      $encryptedPassword =  password_hash($password, PASSWORD_DEFAULT);
                            echo "\n".$encryptedPassword;
                            echo "\nH ".$hashed_password;
     */
                            $password = test_input($password);
                            if (password_verify($password, $hashed_password)) {
                                createSession($id);
                            } else {
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        $username_err = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                unset($stmt);
            }            
        } catch (PDOException $e){
            echo "Oops! Something went wrong. Please try again later.";
            databaseErrorMessage($e);
        }
        // Close connection
        unset($pdo);
    }

    public function logout() {
        //on logout delete/destroy session
        deleteSession();
    }

}

?>