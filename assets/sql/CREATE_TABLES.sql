USE hwg_unlymited; 

CREATE TABLE products (
	productID varchar(25), 
	productCategory varchar(100) NOT NULL, 
	prodName varchar(50) NOT NULL, 
	prodDescription varchar(255) NOT NULL, 
    prodImageURL varchar(255), 
    inventoryCount int (6) NOT NULL, 
	price double NOT NULL, 
	PRIMARY KEY (productID) 
);

CREATE TABLE customers (
	customerID varchar(20) NOT NULL,
    emailAddress varchar(100) NOT NULL,
    firstName varchar(100) NOT NULL,
    lastName varchar(100) NOT NULL,
    shipAddress varchar(255) NOT NULL,
    shipAddress2 varchar(255) NOT NULL,
    shipCity varchar(150) NOT NULL,
    shipState varchar(50) NOT NULL,
    shipZipCode int(5) NOT NULL,
	billAddress varchar(255), 
    billAddress2 varchar(255), 
    billCity varchar(150), 
    billState varchar(50),
    billZipCode int(5), 
    PRIMARY KEY (customerID)
); 
 

CREATE TABLE customerOrders (
	orderID varchar(25),
    orderDateTime datetime NOT NULL,
    customerID varchar(20),
    orderStatus varchar(50),
    FOREIGN KEY (customerID) REFERENCES customers(customerID),
    PRIMARY KEY (orderID)  
);

CREATE TABLE orderedLineItems (
	lineItemID int AUTO_INCREMENT, 
	quantity int (3) NOT NULL,
    orderID varchar(25),
    productID varchar(25),
    lineTotal double,
    FOREIGN KEY (orderID) REFERENCES customerOrders(orderID),
	FOREIGN KEY (productID) REFERENCES products(productID),
    PRIMARY KEY (lineItemID)
); 

CREATE TABLE loginUsers (
	userID int AUTO_INCREMENT,
    emailAddress varchar (100) NOT NULL,
    userPassword varchar (255) NOT NULL,
    firstName varchar (100) NOT NULL,
    lastName varchar (100) NOT NULL,
    PRIMARY KEY (userID)
);

+-------------------------+
| Tables_in_hwg_unlymited |
+-------------------------+
| customerOrders          |
| customers               |
| loginUsers              |
| orderedLineItems        |
| products                |
+-------------------------+

customerOrders
+---------------+-------------+------+-----+---------+-------+
| Field         | Type        | Null | Key | Default | Extra |
+---------------+-------------+------+-----+---------+-------+
| orderID       | varchar(25) | NO   | PRI | NULL    |       |
| orderDateTime | datetime    | NO   |     | NULL    |       |
| customerID    | varchar(20) | YES  | MUL | NULL    |       |
| orderStatus   | varchar(50) | YES  |     | NULL    |       |
| orderTotal    | double      | YES  |     | NULL    |       |
+---------------+-------------+------+-----+---------+-------+

customers
+--------------+--------------+------+-----+---------+-------+
| Field        | Type         | Null | Key | Default | Extra |
+--------------+--------------+------+-----+---------+-------+
| customerID   | varchar(20)  | NO   | PRI | NULL    |       |
| emailAddress | varchar(100) | YES  |     | NULL    |       |
| firstName    | varchar(100) | YES  |     | NULL    |       |
| lastName     | varchar(100) | YES  |     | NULL    |       |
| shipAddress  | varchar(255) | YES  |     | NULL    |       |
| shipAddress2 | varchar(255) | YES  |     | NULL    |       |
| shipCity     | varchar(150) | YES  |     | NULL    |       |
| shipState    | varchar(2)   | YES  |     | NULL    |       |
| shipZipCode  | int(5)       | YES  |     | NULL    |       |
| billAddress  | varchar(255) | YES  |     | NULL    |       |
| billAddress2 | varchar(255) | YES  |     | NULL    |       |
| billCity     | varchar(150) | YES  |     | NULL    |       |
| billState    | varchar(2)   | YES  |     | NULL    |       |
| billZipCode  | int(5)       | YES  |     | NULL    |       |
| phoneNumber  | varchar(20)  | YES  |     | NULL    |       |
+--------------+--------------+------+-----+---------+-------+

orderedLineItems
+------------+-------------+------+-----+---------+----------------+
| Field      | Type        | Null | Key | Default | Extra          |
+------------+-------------+------+-----+---------+----------------+
| lineItemID | int(11)     | NO   | PRI | NULL    | auto_increment |
| quantity   | int(3)      | NO   |     | NULL    |                |
| orderID    | varchar(25) | NO   | MUL | NULL    |                |
| productID  | varchar(25) | NO   | MUL | NULL    |                |
| lineTotal  | double      | NO   |     | NULL    |                |
+------------+-------------+------+-----+---------+----------------+

