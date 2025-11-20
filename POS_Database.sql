CREATE DATABASE IF NOT EXISTS pos_system;
USE pos_system;
CREATE TABLE products (
    BarCode INT(50) PRIMARY KEY, 
    ItemName VARCHAR(255) NOT NULL,
    DateBought date,
	BoughtFrom VARCHAR(255) NOT NULL,
    CostPrice DECIMAL(10, 2) NOT NULL,
    SalesPrice DECIMAL(10, 2) NOT NULL,
    Quantity INT(10)
);

CREATE TABLE IF NOT EXISTS cashiers (
    EMP_num INT(10) PRIMARY KEY, 
    FNAME VARCHAR(50) NOT NULL,
    LNAME VARCHAR(50) NOT NULL,
    Contacts INT(11),
    PlaceOFResidence VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL
    
);
SELECT * FROM products;
SELECT * FROM cashiers;

