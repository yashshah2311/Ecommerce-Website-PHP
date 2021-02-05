-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database-2014107
CREATE DATABASE IF NOT EXISTS `database-2014107` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database-2014107`;

-- Dumping structure for procedure database-2014107.check_login
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_login`(
	IN `p_username` VARCHAR(12)
)
BEGIN 

	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for verify login.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT customer_uuid, 
           customer_username, 
           customer_password 
    FROM   customers 
    WHERE  customer_username = p_username; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.check_username
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_username`(
	IN `p_username` VARCHAR(12)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for check customer username.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT customer_username 
    FROM   customers 
    WHERE  customer_username = p_username; 
END//
DELIMITER ;

-- Dumping structure for table database-2014107.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_uuid` char(36) NOT NULL DEFAULT uuid(),
  `customer_firstname` varchar(20) NOT NULL,
  `customer_lastname` varchar(20) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `postal_code` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_estonian_ci NOT NULL,
  `customer_username` varchar(12) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`customer_uuid`),
  UNIQUE KEY `customer_username` (`customer_username`),
  KEY `customer_lastname` (`customer_lastname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2014107.customers: ~9 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`customer_uuid`, `customer_firstname`, `customer_lastname`, `address`, `city`, `province`, `postal_code`, `customer_username`, `customer_password`, `created_on`, `modified_on`) VALUES
	('03736eec-3469-11eb-908f-2fcf821e10f4', 'Yash', 'Shah', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'alka99', '$2y$10$h4wpe3ArRlQ2G65BNRWeSu7aXCJzJhWCDdlGgSEuUbxaJ5yOpaIIu', '2020-12-02 01:38:36', '2020-12-02 01:38:36'),
	('3daedc85-3bd4-11eb-a7c2-bc542fdfa9a7', 'Yash', 'Shah', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'YASH231195', '$2y$10$0nZRnyFWgX5Hz13nG1yegOnOasBi0DT8dpNBiuH8OXTRWGacFHcWW', '2020-12-11 12:13:40', '2020-12-11 13:01:26'),
	('4dd7a678-32c7-11eb-9d1a-0991bd00c6e3', 'Ya', 'Sha', '1225 rue saint', 'Montreal', 'Quebec', 'H3H2E7', 'yash999', '$2y$10$8mtPx4M8nplIf4orfsa53OmQnQw7/nw1U1cs5iMr8xpIXCQ0bH5V2', '2020-11-29 23:48:26', '2020-11-29 23:48:26'),
	('68070949-2a7e-11eb-9ac3-bc542fdfa9a7', 'Yas', 'Shah', '1225 rue saint mard', 'Montréal', 'Québec', 'H3H2E7', 'yash_9999', '$2y$10$bJOGRDNyoAgwyXJs2d47Su2JCIuVXL6bD12YG2.GIVwTCE4w2Op9y', '2020-11-19 10:46:25', '2020-11-30 02:39:16'),
	('970db448-3469-11eb-908f-2fcf821e10f4', 'Yas', 'Sha', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'YASH231', '$2y$10$0dtrcNKgNQaGi5Uwz5a5fe/pmchC3ChxfBanMaIGX1zaMRd2zr.nC', '2020-12-02 01:42:44', '2020-12-02 01:44:26'),
	('a853f913-32c6-11eb-9d1a-0991bd00c6e3', 'Yash', 'Shah', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'yash_99', '$2y$10$cuAFVB39eFWeSR3OgfjnZO7dJWjriz3vxqVblzxH5IxQ7YeZJpL2G', '2020-11-29 23:43:49', '2020-11-29 23:43:49'),
	('a996b08e-32c7-11eb-9d1a-0991bd00c6e3', 'Ya', 'Sha', '1225 rue saint', 'Montreal', 'Quebec', 'H3H2E7', 'yash_', '$2y$10$MrddkddHocEp5GSWYGk/wuE2L6ybgbK08n8qHDwrTKIopiyr/4nGe', '2020-11-29 23:51:00', '2020-11-29 23:51:00'),
	('af432bc3-2a7e-11eb-9ac3-bc542fdfa9a7', 'Rahul', 'Pipaliya', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'rahul_123', '$2y$10$Ul7Y/yRAg2mMbIs5N5TfquMi11OFnDm0e2AHuoquZvZYx1lCswO4W', '2020-11-19 10:48:25', '2020-11-30 16:07:31'),
	('c9e51854-32c6-11eb-9d1a-0991bd00c6e3', 'Yash', 'Shah', '1225 rue saint marc', 'Montreal', 'Quebec', 'H3H2E7', 'YASH2311', '$2y$10$M89Lg3fQN4HW9eT.LkUC0.dFTjElxiuN/oA0sPNC2UDb/bOmeMnT2', '2020-11-29 23:44:45', '2020-11-30 15:53:25');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for procedure database-2014107.delete_customer
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_customer`(
	IN `p_customer_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for delete product.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    DELETE FROM customers 
    WHERE customer_uuid = p_customer_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.delete_product
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product`(
	IN `p_product_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for delete product.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    DELETE FROM products 
    WHERE product_uuid = p_product_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.delete_purchase
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_purchase`(
	IN `p_purchases_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for delete purchase.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    DELETE FROM purchases 
    WHERE  purchases_uuid = p_purchases_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.filter_purchases
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `filter_purchases`(
	IN `p_purchases_customer_uuid` CHAR(36),
	IN `p_date` DATE
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-10         Created Stored procedure for filter purchase.
	#YASH (2014107)     2020-12-10         Tested and removed bug.
  IF p_date IS NOT NULL THEN 
    SELECT pr.product_code, 
           cu.customer_firstname, 
           cu.customer_lastname, 
           cu.city, 
           pu.purchases_uuid, 
           pu.purchases_customer_uuid, 
           pu.purchases_product_uuid, 
           pu.purchases_comments, 
           pu.purchases_price, 
           pu.purchases_quantity, 
           pu.purchases_subtotal, 
           pu.purchases_taxes, 
           pu.purchases_grandtotal 
    FROM   customers cu, 
           products pr, 
           purchases pu 
    WHERE  cu.customer_uuid = pu.purchases_customer_uuid 
           AND pu.purchases_product_uuid = pr.product_uuid 
           AND DATE(p_date) <= pu.created_on 
           AND pu.purchases_customer_uuid = p_purchases_customer_uuid 
    ORDER  BY pu.created_on; 
  ELSE 
    SELECT pr.product_code, 
           cu.customer_firstname, 
           cu.customer_lastname, 
           cu.city, 
           pu.purchases_uuid, 
           pu.purchases_customer_uuid, 
           pu.purchases_product_uuid, 
           pu.purchases_comments, 
           pu.purchases_price, 
           pu.purchases_quantity, 
           pu.purchases_subtotal, 
           pu.purchases_taxes, 
           pu.purchases_grandtotal 
    FROM   customers cu, 
           products pr, 
           purchases pu 
    WHERE  cu.customer_uuid = pu.purchases_customer_uuid 
           AND pu.purchases_product_uuid = pr.product_uuid 
           AND pu.purchases_customer_uuid = p_purchases_customer_uuid 
    ORDER  BY pu.created_on; 
  END IF; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.insert_customer
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_customer`(
	IN `p_customer_firstname` VARCHAR(20),
	IN `p_customer_lastname` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` VARCHAR(7),
	IN `p_customer_username` VARCHAR(12),
	IN `p_customer_password` VARCHAR(255)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for insert new customer.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    INSERT INTO customers 
                (customer_firstname, 
                 customer_lastname, 
                 address, 
                 city, 
                 province, 
                 postal_code, 
                 customer_username, 
                 customer_password) 
    VALUES      (p_customer_firstname, 
                 p_customer_lastname, 
                 p_address, 
                 p_city, 
                 p_province, 
                 p_postal_code, 
                 p_customer_username, 
                 p_customer_password); 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.insert_product
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_product`(
	IN `p_product_code` VARCHAR(12),
	IN `p_product_description` VARCHAR(100),
	IN `p_product_selling_price` DECIMAL(6,2),
	IN `p_product_cost_price` DECIMAL(6,2)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for insert product.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    INSERT INTO products 
                (product_code, 
                 product_description, 
                 product_selling_price, 
                 product_cost_price) 
    VALUES      (p_product_code, 
                 p_product_description, 
                 p_product_selling_price, 
                 p_product_cost_price);
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.insert_purchase
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_purchase`(
	IN `p_purchases_customer_uuid` CHAR(36),
	IN `p_purchases_product_uuid` CHAR(36),
	IN `p_purchases_price` DECIMAL(6,2),
	IN `p_purchases_subtotal` DECIMAL(9,2),
	IN `p_purchases_taxes` DECIMAL(9,2),
	IN `p_purchases_grandtotal` DECIMAL(9,2),
	IN `p_purchases_quantity` SMALLINT,
	IN `p_purchases_comments` VARCHAR(200)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for insert purchase.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    INSERT INTO purchases 
                (purchases_customer_uuid, 
                 purchases_product_uuid, 
                 purchases_price, 
                 purchases_subtotal, 
                 purchases_taxes, 
                 purchases_grandtotal, 
                 purchases_quantity, 
                 purchases_comments) 
    VALUES      (p_purchases_customer_uuid, 
                 p_purchases_product_uuid, 
                 p_purchases_price, 
                 p_purchases_subtotal, 
                 p_purchases_taxes, 
                 p_purchases_grandtotal, 
                 p_purchases_quantity, 
                 p_purchases_comments);
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.load_customer
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `load_customer`(
	IN `p_customer_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for load customer.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   customers 
    WHERE  customer_uuid = p_customer_uuid
	 ORDER BY customer_lastname; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.load_product
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `load_product`(
	IN `p_product_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for load product.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   products 
    WHERE  product_uuid = p_product_uuid
	 ORDER BY product_selling_price; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.load_purchase
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `load_purchase`(
	IN `p_purchases_uuid` CHAR(36)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for load purchase.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   purchases 
    WHERE  purchases_uuid = p_purchases_uuid
	 ORDER BY purchases_price; 
END//
DELIMITER ;

-- Dumping structure for table database-2014107.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_uuid` char(36) NOT NULL DEFAULT uuid(),
  `product_code` varchar(12) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_selling_price` decimal(6,2) DEFAULT 0.00,
  `product_cost_price` decimal(6,2) DEFAULT 0.00,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_uuid`),
  UNIQUE KEY `product_code` (`product_code`),
  KEY `product_selling_price` (`product_selling_price`),
  KEY `product_cost_price` (`product_cost_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2014107.products: ~6 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_uuid`, `product_code`, `product_description`, `product_selling_price`, `product_cost_price`, `created_on`, `modified_on`) VALUES
	('22e87e43-35e0-11eb-908f-2fcf821e10f4', 'pMouse12', 'Mouse', 150.00, 50.00, '2020-12-03 22:23:36', '2020-12-03 22:23:38'),
	('316e4dc9-36ba-11eb-908f-2fcf821e10f4', 'p12Processor', 'Super good processing', 9999.99, 500.00, '2020-12-05 00:24:21', '2020-12-05 00:28:07'),
	('ac6d893f-36b9-11eb-908f-2fcf821e10f4', 'p23Bike', 'Best bike', 1000.00, 500.00, '2020-12-05 00:20:38', '2020-12-05 00:20:38'),
	('bc6f6a96-36ba-11eb-908f-2fcf821e10f4', 'p23Laptop', 'Super good processing laptop', 9999.99, 5000.00, '2020-12-05 00:28:14', '2020-12-05 00:49:29'),
	('d4016a2c-36b9-11eb-908f-2fcf821e10f4', 'p231Bike', 'Best bike', 9999.99, 500.00, '2020-12-05 00:21:44', '2020-12-05 00:21:44'),
	('eba1fe33-2a85-11eb-9ac3-bc542fdfa9a7', 'pEBike225', 'Electonic bike', 6000.00, 1400.00, '2020-11-19 11:40:12', '2020-12-05 13:35:49');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table database-2014107.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchases_uuid` char(36) NOT NULL DEFAULT uuid(),
  `purchases_customer_uuid` char(36) NOT NULL,
  `purchases_product_uuid` char(36) NOT NULL,
  `purchases_price` decimal(6,2) NOT NULL DEFAULT 0.00,
  `purchases_subtotal` decimal(9,2) NOT NULL DEFAULT 0.00,
  `purchases_taxes` decimal(9,2) NOT NULL DEFAULT 0.00,
  `purchases_grandtotal` decimal(9,2) NOT NULL DEFAULT 0.00,
  `purchases_quantity` smallint(3) NOT NULL DEFAULT 0,
  `purchases_comments` varchar(200) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchases_uuid`),
  KEY `customers_fk` (`purchases_customer_uuid`),
  KEY `products_fk` (`purchases_product_uuid`),
  KEY `purchases_price` (`purchases_price`),
  KEY `created_on` (`created_on`),
  CONSTRAINT `customers_fk` FOREIGN KEY (`purchases_customer_uuid`) REFERENCES `customers` (`customer_uuid`),
  CONSTRAINT `products_fk` FOREIGN KEY (`purchases_product_uuid`) REFERENCES `products` (`product_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2014107.purchases: ~10 rows (approximately)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` (`purchases_uuid`, `purchases_customer_uuid`, `purchases_product_uuid`, `purchases_price`, `purchases_subtotal`, `purchases_taxes`, `purchases_grandtotal`, `purchases_quantity`, `purchases_comments`, `created_on`, `modified_on`) VALUES
	('2c4cc77f-3742-11eb-908f-2fcf821e10f4', 'af432bc3-2a7e-11eb-9ac3-bc542fdfa9a7', 'bc6f6a96-36ba-11eb-908f-2fcf821e10f4', 9999.99, 9999.99, 1520.00, 11519.99, 1, '', '2020-12-05 16:37:33', '2020-12-05 16:37:33'),
	('45a8cd88-398a-11eb-908f-2fcf821e10f4', 'c9e51854-32c6-11eb-9d1a-0991bd00c6e3', '22e87e43-35e0-11eb-908f-2fcf821e10f4', 150.00, 300.00, 45.60, 345.60, 2, '2 pieces', '2020-12-08 14:18:08', '2020-12-08 14:18:08'),
	('45e58900-3853-11eb-908f-2fcf821e10f4', 'c9e51854-32c6-11eb-9d1a-0991bd00c6e3', '316e4dc9-36ba-11eb-908f-2fcf821e10f4', 9999.99, 9999.99, 1520.00, 11519.99, 1, '123456789', '2020-12-07 01:12:07', '2020-12-07 01:12:07'),
	('4a65b965-3b3f-11eb-a3a5-892d45d45631', '970db448-3469-11eb-908f-2fcf821e10f4', 'ac6d893f-36b9-11eb-908f-2fcf821e10f4', 1000.00, 2000.00, 304.00, 2304.00, 2, '', '2020-12-10 18:27:38', '2020-12-10 18:27:38'),
	('a112a09d-3728-11eb-908f-2fcf821e10f4', 'c9e51854-32c6-11eb-9d1a-0991bd00c6e3', 'eba1fe33-2a85-11eb-9ac3-bc542fdfa9a7', 5000.00, 10000.00, 1520.00, 11520.00, 2, 'ncm moscow snow tire', '2020-12-05 13:34:47', '2020-12-05 13:34:47'),
	('b571b77b-3bcb-11eb-a7c2-bc542fdfa9a7', 'af432bc3-2a7e-11eb-9ac3-bc542fdfa9a7', '22e87e43-35e0-11eb-908f-2fcf821e10f4', 150.00, 1800.00, 273.60, 2073.60, 12, '12 piece', '2020-12-11 11:12:39', '2020-12-11 11:12:39'),
	('b8c74af3-37f2-11eb-908f-2fcf821e10f4', 'af432bc3-2a7e-11eb-9ac3-bc542fdfa9a7', 'eba1fe33-2a85-11eb-9ac3-bc542fdfa9a7', 6000.00, 24000.00, 3648.00, 27648.00, 4, '10% rebate', '2020-12-06 13:41:10', '2020-12-06 13:41:10'),
	('d12912bd-3728-11eb-908f-2fcf821e10f4', 'c9e51854-32c6-11eb-9d1a-0991bd00c6e3', 'eba1fe33-2a85-11eb-9ac3-bc542fdfa9a7', 6000.00, 6000.00, 912.00, 6912.00, 1, 'new bike', '2020-12-05 13:36:08', '2020-12-05 13:36:08'),
	('e41cb624-3bcc-11eb-a7c2-bc542fdfa9a7', 'af432bc3-2a7e-11eb-9ac3-bc542fdfa9a7', '22e87e43-35e0-11eb-908f-2fcf821e10f4', 150.00, 14850.00, 2257.20, 17107.20, 99, '', '2020-12-11 11:21:07', '2020-12-11 11:21:07'),
	('fa6d4adf-3727-11eb-908f-2fcf821e10f4', 'c9e51854-32c6-11eb-9d1a-0991bd00c6e3', 'bc6f6a96-36ba-11eb-908f-2fcf821e10f4', 9999.99, 9999.99, 1520.00, 11519.99, 1, '', '2020-12-05 13:30:07', '2020-12-05 13:30:07');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Dumping structure for procedure database-2014107.select_customers
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_customers`()
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for select customers.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   customers 
    ORDER  BY customer_lastname; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.select_products
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_products`()
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for select products.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   products
	 ORDER BY product_selling_price;
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.select_purchases
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_purchases`()
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for select products.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    SELECT * 
    FROM   purchases
	 ORDER BY purchases_price;
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.update_customer
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_customer`(
	IN `p_customer_uuid` CHAR(36),
	IN `p_customer_firstname` VARCHAR(20),
	IN `p_customer_lastname` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` VARCHAR(7),
	IN `p_customer_username` VARCHAR(12),
	IN `p_customer_password` VARCHAR(255)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for update existing customer details.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    UPDATE customers 
    SET    customer_firstname = p_customer_firstname, 
           customer_lastname = p_customer_lastname, 
           address = p_address, 
           city = p_city, 
           province = p_province, 
           postal_code = p_postal_code, 
           customer_username = p_customer_username, 
           customer_password = p_customer_password 
    WHERE  customer_uuid = p_customer_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.update_product
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product`(
	IN `p_product_uuid` CHAR(36),
	IN `p_product_code` VARCHAR(12),
	IN `p_product_description` VARCHAR(100),
	IN `p_product_selling_price` DECIMAL(6,2),
	IN `p_product_cost_price` DECIMAL(6,2)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for update product.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    UPDATE products 
    SET    product_code = p_product_code, 
           product_description = p_product_description, 
           product_selling_price = p_product_selling_price, 
           product_cost_price = p_product_cost_price 
    WHERE  product_uuid = p_product_uuid;
END//
DELIMITER ;

-- Dumping structure for procedure database-2014107.update_purchase
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_purchase`(
	IN `p_purchases_uuid` CHAR(36),
	IN `p_purchases_product_uuid` CHAR(36),
	IN `p_purchases_price` DECIMAL(6,2),
	IN `p_purchases_subtotal` DECIMAL(9,2),
	IN `p_purchases_taxes` DECIMAL(9,2),
	IN `p_purchases_grandtotal` DECIMAL(9,2),
	IN `p_purchases_quantity` SMALLINT,
	IN `p_purchases_comments` VARCHAR(200)
)
BEGIN 
	#Revision History
	#DEV                DATE               DESC
	#YASH (2014107)     2020-12-11         Created Stored procedure for update purchase.
	#YASH (2014107)     2020-12-11         Tested and removed bug.
    UPDATE purchases 
    SET    purchases_product_uuid = p_purchases_product_uuid, 
           purchases_price = p_purchases_price, 
           purchases_subtotal = p_purchases_subtotal, 
           purchases_taxes = p_purchases_taxes, 
           purchases_grandtotal = p_purchases_grandtotal, 
           purchases_quantity = p_purchases_quantity, 
           purchases_comments = p_purchases_comments 
    WHERE  purchases_uuid = p_purchases_uuid; 
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
