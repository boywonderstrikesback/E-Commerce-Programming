USE ecommerce


CREATE TABLE  bjj_matches (
	bjj_matches_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	Opponent VARCHAR(30) NOT NULL,
    Win_Loss VARCHAR(30) NOT NULL,
	Method VARCHAR(30) NOT NULL,
	PRIMARY KEY (bjj_matches_id)
) ENGINE = InnoDB;

INSERT INTO bjj_matches(Opponent,Win_Loss,Method) VALUES
	('Unkown','Win','Refee Stoppage'),
	('Unkown','Loss','Darce'),
	('Rocc Lafonce','Win' ,'Guillotine'),
	('Benjamin Lance', 'Loss','Advantage'),
    ('Mike Glenn', 'Loss', 'Darce' ),
    ('Rob Hazon','win','Rear Naked choke'),
	('Mike Merlo','win','Guillotine Choke'),
	('Dave Rogers', 'Win','Darce Choke');


	CREATE TABLE bjj_customer( (
	bjj_customer_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, 
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	email VARCHAR(40) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	password CHAR(255) NOT NULL,
	address_1 VARCHAR(100) NOT NULL,
	address_2 VARCHAR(100),
	city VARCHAR(50) NOT NULL,
	hat_states_id TINYINT UNSIGNED NOT NULL,
	zip CHAR(5) NOT NULL,
	date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(bjj_customers_id),
	INDEX ind_hat_states_id (bjj_customers_id),
	CONSTRAINT fk_hat_states_id FOREIGN KEY (bjj_matches_id) REFERENCES bjj_matches(bjj_matches_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

create table bjj_transactions(
	bjj_transactions_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount_charged DECIMAL(6, 3) NOT NULL, 
	type VARCHAR(100) NOT NULL, 
	response_code VARCHAR(200) NOT NULL, 
	response_reason VARCHAR(200) NOT NULL, 
	response_text VARCHAR(400) NOT NULL, 
	date_created TIMESTAMP NOT NULL, 
	PRIMARY KEY9(bjj_matches_id)
) ENGINE = InnoDB;

create table bjj_shipping_addresses(
	bjj_shipping_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT NULL, 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT NULL, 
	bjj_matches_id TINYINT UNSIGNED NOT NULL, 
	zip CHAR(5) NOT NULL, 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(bjj_shipping_addresses_id)
) ENGINE = InnoDB;

create table bjj_billing_addresses(
	bjj_billing_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT NULL, 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT NULL, 
	bjj_matches_id TINYINT UNSIGNED NOT NULL, 
	zip CHAR(5) NOT NULL, 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(bjj_billing_addresses_id)
) ENGINE = InnoDB;

create table bjj_carriers_methods(
	bjj_carriers_methods_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	carrier VARCHAR(50) NOT NULL, 
	method VARCHAR(50) NOT NULL, 
	fee DECIMAL(6, 3) NOT NULL, 
	PRIMARY KEY(bjj_carriers_methods_id)
) ENGINE = InnoDB;

INSERT INTO bjj_carriers_methods (carrier, method, fee) VALUES 
('UPS', 'Ground', '4.99'),


create table bjj_orders(
	bjj_orders_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	bjj_customers_id MEDIUMINT UNSIGNED NOT NULL,
	bjj_transactions_id INT UNSIGNED NOT NULL,
	bjj_shipping_addresses_id INT UNSIGNED NOT NULL,
	bjj_carriers_methods_id TINYINT UNSIGNED NOT NULL,
	bjj_billing_addresses_id INT UNSIGNED NOT NULL,
	bjj_credit_no CHAR(4) NOT NULL, 
	bjj_credit_type VARCHAR(20) NOT NULL, 
	bjj_order_total DECIMAL(7, 3) NOT NULL, 
	bjj_shipping_fee DECIMAL(6, 3) NOT NULL, 
	bjj_order_date TIMESTAMP NOT NULL, 
	bjj_shipping_date TIMESTAMP NOT NULL, 
	PRIMARY KEY(bjj_orders_id),
	INDEX ind_bjj_customers_id (bjj_customers_id),
	CONSTRAINT fk_bjj_customers_id FOREIGN KEY (bjj_customers_id) REFERENCES bjj_customers(bjj_customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_bjj_transactions_id (bjj_transactions_id),
	CONSTRAINT fk_bjj_transactions_id FOREIGN KEY (bjj_transactions_id) REFERENCES transactions(bjj_transactions_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_bjj_shipping_addresses_id (bjj_shipping_addresses_id),
	CONSTRAINT fk_bjj_shipping_addresses_id FOREIGN KEY (bjj_shipping_addresses_id) REFERENCES bjj_shipping_addresses(bjj_shipping_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_bjj_carriers_methods_id (carriers_methods_id),
	CONSTRAINT fk_hat_carriers_methods_id FOREIGN KEY (bjj_carriers_methods_id) REFERENCES bjj_carriers_methods(bjj_carriers_methods_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_bjj_billing_addresses_id (billing_addresses_id),
	CONSTRAINT fk_bjj_billing_addresses_id FOREIGN KEY (bjj_billing_addresses_id) REFERENCES billing_addresses(bjj_billing_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

create table dvd(
	bjj_dvd_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	dvd VARCHAR(100) NOT NULL,
	description VARCHAR(1000),
	PRIMARY KEY(categories_id)
) ENGINE = InnoDB;

create table numberofmatches(
	bjj_numbers_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	numbers VARCHAR(20) NOT NULL,
	PRIMARY KEY(sizes_id)
) ENGINE = InnoDB;

INSERT INTO bjj_numbers (numbers) VALUES
	('1'),
	('2'),
	('3');
	

create table bjj(
	bjj_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	bjj_dvd_id SMALLINT UNSIGNED NOT NULL,
	bjj_numbers_id TINYINT UNSIGNED NOT NULL,
	price DECIMAL(6,3) NOT NULL,
	photo VARCHAR(100),
	stock_quantity MEDIUMINT UNSIGNED NOT NULL,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(bjj_id),
	INDEX bjj_dvd_id (bjj_dvd_id),
	CONSTRAINT bjj_dvd_id FOREIGN KEY (bjj_dvd_id) REFERENCES categories(bjj_dvd_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX fk_bjj_numbers_id (bjj_numbers_id),
	CONSTRAINT fk_bjj_numbers_id FOREIGN KEY (bjj_numbers_id) REFERENCES sizes(bjj_numbers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
) ENGINE = InnoDB;

create table bjj_orders(
	bjj_orders_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	bjj_orders_id INT UNSIGNED NOT NULL,
	bjj_id MEDIUMINT UNSIGNED NOT NULL,
	quantity TINYINT UNSIGNED NOT NULL,
	price DECIMAL(7,3) NOT NULL,
	PRIMARY KEY(bjj_orders_bjj_id),
	INDEX ind_hat_orders_id (bjj_orders_id),
	CONSTRAINT fk_hat_orders_id FOREIGN KEY (bjj_orders_id) REFERENCES bjj_orders(bjj_orders_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hats_id (hats_id),
	CONSTRAINT fk_hats_id FOREIGN KEY (hats_id) REFERENCES hats(hats_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;


create table carts(
	carts_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	customers_id MEDIUMINT UNSIGNED NOT NULL, 
	id MEDIUMINT UNSIGNED NOT NULL, 
	quantity TINYINT UNSIGNED NOT NULL, 
	date_added TIMESTAMP NOT NULL, 
	date_modified TIMESTAMP NOT NULL, 
	PRIMARY KEY(carts_id),
	INDEX ind_bjj_customers_id (customers_id),
	CONSTRAINT fk_carts_hat_customers_id FOREIGN KEY (customers_id) REFERENCES customers(customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hats_id (bjj_id),
	CONSTRAINT fk_carts_hats_id FOREIGN KEY (bjj_id) REFERENCES bjj(bjj_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

ALTER TABLE bjj_customers MODIFY COLUMN address_2 varchar(100);
ALTER TABLE bjj_shipping_addresses MODIFY COLUMN address_2 varchar(100);
ALTER TABLE bjj_billing_addresses MODIFY COLUMN address_2 varchar(100);


INSERT INTO customers (first_name, last_name, email, phone, password, address_1, address_2, city, hat_states_id, zip, date_created) VALUES
	('David', 'Steel', 'dsteel@ysu.edu', '330-333-4444', 'mypassword', 'One University Plaza', 'Youngstown State University - Meshel Hall #123', 'Youngstown', 36, '44555', current_timestamp),
	('Mark', 'Jordan', 'mjordan@gmail.com', '330-444-5555', 'mypassword', '123 Main Street', '', 'Youngstown', 36, '44555', current_timestamp),
	('Mary', 'Alan', 'malan@yahoo.com', '330-555-6666', 'mypassword', '5068 South Avenue', '', 'Boardman', 36, '44512', current_timestamp);
	
INSERT INTO transactions (amount_charged, type, response_code, response_reason, response_text, date_created) VALUES
	(48.98, 'regular', '100', '', 'OK', current_timestamp),
	(22.98, 'regular', '100', '', 'OK', current_timestamp);

INSERT INTO shipping_addresses (address_1, address_2, city, hat_states_id, zip, date_created) VALUES 
	('One University Plaza', 'Youngstown State University - Meshel Hall #123', 'Youngstown', 36, '44555', current_timestamp);

INSERT INTO billing_addresses (address_1, address_2, city, hat_states_id, zip, date_created) VALUES
	('100 Lockwood Avenue', '', 'Canfield', 36, '44406', current_timestamp);	

INSERT INTO bjj_orders (bjj_customers_id, bjj_transactions_id, bjj_shipping_addresses_id, bjj_billing_addresses_id, bjj_carriers_methods_id, credit_no, credit_type, order_total, shipping_fee, shipping_date, order_date) VALUES
	(1, 1, 1, 1, 3, '4345', 'Visa', 43.99, 4.99, current_timestamp, current_timestamp),
	(1, 2, 1, 1, 4, '4345', 'Visa', 19.99, 2.99, current_timestamp, current_timestamp);
	
select * from bjj_customers;
select * from bjj_transactions;
select * from bjj_shipping_addresses;
select * from bjj_billing_addresses;
select * from bjj_orders;

SELECT first_name, last_name, credit_no, credit_type FROM bjj_customers, bjj_orders 
	WHERE bjj_customers.bjj_customers_id = bjj_orders.bjj_customers_id;

SELECT first_name, last_name, credit_no, credit_type FROM bjj_customers 
	INNER JOIN bjj_orders ON bjj_customers.bjj_customers_id = bjj_orders.bjj_customers_id;

SELECT first_name, last_name, credit_no, credit_type FROM bjj_customers 
	INNER JOIN bjj_orders USING (bjj_customers_id);
	
SELECT first_name, last_name, credit_no, credit_type, CONCAT_WS(' ', bjj_shipping_addresses.address_1, bjj_shipping_addresses.address_2, bjj_shipping_addresses.city, state, bjj_shipping_addresses.zip) as 'Shipping Address' FROM bjj_customers 
	INNER JOIN bjj_orders USING (bjj_customers_id)
	INNER JOIN bjj_shipping_addresses USING (bjj_shipping_addresses_id)
	INNER JOIN bjj_states ON bjj_shipping_addresses.bjj_states_id = bjj_states.bjj_states_id;

SELECT first_name, last_name, credit_no, credit_type, CONCAT_WS(' ', bjj_shipping_addresses.address_1, bjj_shipping_addresses.address_2, bjj_shipping_addresses.city, state, bjj_shipping_addresses.zip) as 'Shipping Address' FROM bjj_customers 
	LEFT JOIN bjj_orders USING (bjj_customers_id)
	LEFT JOIN bjj_shipping_addresses USING (bjj_shipping_addresses_id)
	LEFT JOIN bjj_states ON bjj_shipping_addresses.bjj_matches_id = bjj_matches.bjj_matches_id 
	WHERE bjj_shipping_addresses.city = 'Youngstown'
	ORDER BY last_name ASC
	;
	
SELECT first_name, last_name, credit_no, credit_type, CONCAT_WS(' ', hat_shipping_addresses.address_1, hat_shipping_addresses.address_2, hat_shipping_addresses.city, state, hat_shipping_addresses.zip) as 'Shipping Address' FROM hat_states 
	RIGHT JOIN shipping_addresses ON hat_shipping_addresses.hat_states_id = hat_states.hat_states_id 
	RIGHT JOIN orders USING (bjj_shipping_addresses_id)
	RIGHT JOIN customers USING (bjj_customers_id);
	
	

	
/*
 
 
 
 */
 
