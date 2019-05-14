USE ecommer_online2016;

CREATE TABLE supplement_states (
	supplement_states_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	state VARCHAR(30) NOT NULL,
	abbr CHAR(2) NOT NULL,
	PRIMARY KEY (supplement_states_id)
) ENGINE = InnoDB;

INSERT INTO supplement_states(state, abbr) VALUES
	('Alabama', 'AL'),
	('Alaska', 'AK'),
	('Arizona', 'AZ'),
	('Arkansas', 'AR'),
	('California', 'CA'),
	('Colorado', 'CO'),
	('Connecticut', 'CT'),
	('Delaware', 'DE'),
	('District of Columbia', 'DC'),
	('Florida', 'FL'),
	('Georgia', 'GA'),
	('Hawaii', 'HI'),
	('Idaho', 'ID'),
	('Illinois', 'IL'),
	('Indiana', 'IN'),
	('Iowa', 'IA'),
	('Kansas', 'KS'),
	('Kentucky', 'KY'),
	('Louisiana', 'LA'),
	('Maine', 'ME'),
	('Maryland', 'MD'),
	('Massachusetts', 'MA'),
	('Michigan', 'MI'),
	('Minnesota', 'MN'),
	('Mississippi', 'MS'),
	('Missouri', 'MO'),
	('Montana', 'MT'),
	('Nebraska', 'NE'),
	('Nevada', 'NV'),
	('New Hampshire', 'NH'),
	('New Jersey', 'NJ'),
	('New Mexico', 'NM'),
	('New York', 'NY'),
	('North Carolina', 'NC'),
	('North Dakota', 'ND'),
	('Ohio', 'OH'),
	('Oklahoma', 'OK'),
	('Oregon', 'OR'),
	('Pennsylvania', 'PA'),
	('Rhode Island', 'RI'),
	('South Carolina', 'SC'),
	('South Dakota', 'SD'),
	('Tennessee', 'TN'),
	('Texas', 'TX'),
	('Utah', 'UT'),
	('Vermont', 'VT'),
	('Virginia', 'VA'),
	('Washington', 'WA'),
	('West Virginia', 'WV'),
	('Wisconsin', 'WI'),
	('Wyoming', 'WY');

CREATE TABLE supplement_customers (
	supplement_customers_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, 
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	email VARCHAR(40) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	password CHAR(255) NOT NULL,
	address_1 VARCHAR(100) NOT NULL,
	address_2 VARCHAR(100),
	city VARCHAR(50) NOT NULL,
	supplement_states_id TINYINT UNSIGNED NOT NULL,
	zip CHAR(5) NOT NULL,
	date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(supplement_customers_id),
	INDEX ind_supplement_states_id (supplement_states_id),
	CONSTRAINT fk_supplement_states_id FOREIGN KEY (supplement_states_id) REFERENCES supplement_states(supplement_states_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

create table supplement_transactions(
	supplement_transactions_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount_charged DECIMAL(6, 3) NOT 
	type VARCHAR(100) NOT 
	response_code VARCHAR(200) NOT 
	response_reason VARCHAR(200) NOT 
	response_text VARCHAR(400) NOT 
	date_created TIMESTAMP NOT 
	PRIMARY KEY(supplement_transactions_id)
) ENGINE = InnoDB;

create table supplement_shipping_addresses(
	supplement_shipping_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT 
	supplement_states_id TINYINT UNSIGNED NOT 
	zip CHAR(5) NOT 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(supplement_shipping_addresses_id)
) ENGINE = InnoDB;

create table supplement_billing_addresses(
	supplement_billing_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT 
	supplement_states_id TINYINT UNSIGNED NOT 
	zip CHAR(5) NOT 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(supplement_billing_addresses_id)
) ENGINE = InnoDB;

create table supplement_carriers_methods(
	supplement_carriers_methods_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	carrier VARCHAR(50) NOT 
	method VARCHAR(50) NOT 
	fee DECIMAL(6, 3) NOT 
	PRIMARY KEY(supplement_carriers_methods_id)
) ENGINE = InnoDB;

INSERT INTO supplement_carriers_methods (carrier, method, fee) VALUES 
('UPS', 'Ground', '4.99'),
('UPS', 'Express', '9.99'),
('USPS', 'Standard', '3.99'),
('USPS', 'Expedited', '6.99'),
('FEDEX', 'Same Day', '49.99'),
('FEDEX', 'One Day', '29.99'),
('FEDEX', 'Three Days', '9.99');

create table supplement_orders(
	supplement_orders_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_customers_id MEDIUMINT UNSIGNED NOT NULL,
	supplement_transactions_id INT UNSIGNED NOT NULL,
	supplement_shipping_addresses_id INT UNSIGNED NOT NULL,
	supplement_carriers_methods_id TINYINT UNSIGNED NOT NULL,
	supplement_billing_addresses_id INT UNSIGNED NOT NULL,
	credit_no CHAR(4) NOT 
	credit_type VARCHAR(20) NOT 
	order_total DECIMAL(7, 3) NOT 
	shipping_fee DECIMAL(6, 3) NOT 
	order_date TIMESTAMP NOT 
	shipping_date TIMESTAMP NOT 
	PRIMARY KEY(supplement_orders_id),
	INDEX ind_supplement_customers_id (supplement_customers_id),
	CONSTRAINT fk_supplement_customers_id FOREIGN KEY (supplement_customers_id) REFERENCES supplement_customers(supplement_customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplement_transactions_id (supplement_transactions_id),
	CONSTRAINT fk_supplement_transactions_id FOREIGN KEY (supplement_transactions_id) REFERENCES supplement_transactions(supplement_transactions_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplement_shipping_addresses_id (supplement_shipping_addresses_id),
	CONSTRAINT fk_supplement_shipping_addresses_id FOREIGN KEY (supplement_shipping_addresses_id) REFERENCES supplement_shipping_addresses(supplement_shipping_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplement_carriers_methods_id (supplement_carriers_methods_id),
	CONSTRAINT fk_supplement_carriers_methods_id FOREIGN KEY (supplement_carriers_methods_id) REFERENCES supplement_carriers_methods(supplement_carriers_methods_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplement_billing_addresses_id (supplement_billing_addresses_id),
	CONSTRAINT fk_supplement_billing_addresses_id FOREIGN KEY (supplement_billing_addresses_id) REFERENCES supplement_billing_addresses(supplement_billing_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

create table supplement_categories(
	supplement_categories_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	category VARCHAR(100) NOT NULL,
	description VARCHAR(1000),
	PRIMARY KEY(supplement_categories_id)
) ENGINE = InnoDB;

create table supplement_sizes(
	supplement_sizes_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	size VARCHAR(20) NOT NULL,
	PRIMARY KEY(supplement_sizes_id)
) ENGINE = InnoDB;

INSERT INTO supplement_sizes (size) VALUES
	('xxx-small'),
	('xx-small'),
	('x-small'),
	('small'),
	('medium'),
	('large'),
	('x-large'),
	('xx-large'),
	('xxx-large');
	
create table supplement_colors(
	supplement_colors_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	keyword VARCHAR(20) NOT NULL,
	code VARCHAR(20) NOT NULL,
	PRIMARY KEY(supplement_colors_id)
) ENGINE = InnoDB;

INSERT INTO supplement_colors (keyword, code) VALUES
	('black', '#000000'),
	('white', '#ffffff'),
	('blue', '#0000FF'),
	('dark blue', '#0000A0'),
	('light blue', '#ADD8E6'),
	('red', '#FF0000'),
	('cyan', '#00FFFF'),
	('purple', '#800080'),
	('yellow', '#FFFF00'),
	('lime', '#00FF00'),
	('magenta', '#FF00FF'),
	('silver', '#C0C0C0'),
	('gray', '#808080'),
	('orange', '#FFA500'),
	('brown', '#A52A2A'),
	('maroon', '#800000'),
	('green', '#008000'),
	('olive', '#808000');

create table supplements(
	supplements_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_categories_id SMALLINT UNSIGNED NOT NULL,
	supplement_sizes_id TINYINT UNSIGNED NOT NULL,
	supplement_colors_id TINYINT UNSIGNED NOT NULL,
	price DECIMAL(6,3) NOT NULL,
	photo VARCHAR(100),
	stock_quantity MEDIUMINT UNSIGNED NOT NULL,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(supplements_id),
	INDEX ind_supplement_categories_id (supplement_categories_id),
	CONSTRAINT fk_supplement_categories_id FOREIGN KEY (supplement_categories_id) REFERENCES supplement_categories(supplement_categories_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX fk_supplement_sizes_id (supplement_sizes_id),
	CONSTRAINT fk_supplement_sizes_id FOREIGN KEY (supplement_sizes_id) REFERENCES supplement_sizes(supplement_sizes_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplement_colors_id (supplement_colors_id),
	CONSTRAINT fk_supplement_colors_id FOREIGN KEY (supplement_colors_id) REFERENCES supplement_colors(supplement_colors_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

create table supplement_orders_supplements(
	supplement_orders_supplements_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_orders_id INT UNSIGNED NOT NULL,
	supplements_id MEDIUMINT UNSIGNED NOT NULL,
	quantity TINYINT UNSIGNED NOT NULL,
	price DECIMAL(7,3) NOT NULL,
	PRIMARY KEY(supplement_orders_supplements_id),
	INDEX ind_supplement_orders_id (supplement_orders_id),
	CONSTRAINT fk_supplement_orders_id FOREIGN KEY (supplement_orders_id) REFERENCES supplement_orders(supplement_orders_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplements_id (supplements_id),
	CONSTRAINT fk_supplements_id FOREIGN KEY (supplements_id) REFERENCES supplements(supplements_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;


create table supplement_carts(
	supplement_carts_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_customers_id MEDIUMINT UNSIGNED NOT 
	supplements_id MEDIUMINT UNSIGNED NOT 
	quantity TINYINT UNSIGNED NOT 
	date_added TIMESTAMP NOT 
	date_modified TIMESTAMP NOT 
	PRIMARY KEY(supplement_carts_id),
	INDEX ind_supplement_customers_id (supplement_customers_id),
	CONSTRAINT fk_carts_supplement_customers_id FOREIGN KEY (supplement_customers_id) REFERENCES supplement_customers(supplement_customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_supplements_id (supplements_id),
	CONSTRAINT fk_carts_supplements_id FOREIGN KEY (supplements_id) REFERENCES supplements(supplements_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

INSERT INTO supplement_customers (supplement_customers_id,first_name,last_name,email,phone,password,address_1,address_2,city,zip) VALUES
	('1', 'John', 'Smith', 'jsmith@yahoo.com','330-754-0000','password1','134 mahoning avenue','youngstown','44515')
	('2', 'Jennifer', 'Brown', 'jbrown@hotmail.com','330-754-0001','password2','135 mahoning avenue','youngstown','44515')
	('3', 'Michael', 'Doe', 'mdoe@yahoo.com','330-754-0002','password3','136 mahoning avenue','youngstown','44515')
	
INSERT INTO supplement_transactions (supplement_transactions_id,amount_charged,response_code,response_reason,response_text,date_created) VALUES
	('1', '39.99', 'response code1', 'response_reason1','response_text1','10-22-2016')
	('2', '49.99', 'response code2', 'response_reason1','response_text1','10-21-2016')
	('3', '59.99', 'response code2', 'response_reason1','response_text1','10-23-2016')
	
INSERT INTO supplement_shipping_addresses (supplement_shipping_addresses_id, address_1, address_2, city, supplement_states_id, zip, date_created) VALUES
	('1', 'addressid1','134 mahoning avenue', 'nashville', 'TN', '37214','10-22-2016')
    ('2', 'addressid2','135 mahoning avenue', 'Austintown', 'OH', '44514','10-21-216')
	('3', 'addressid3','136 mahoning avenue','Youngstown','OH','44515','20-23-2016')

INSERT INTO supplement_billing_addresses (supplement_billing_addresses_id, address_1, address_2, city, supplement_states_id, zip, date_created) VALUES
	('1', 'addressid1','134 mahoning avenue', 'nashville', 'TN', '37214','10-22-2016')
    ('2', 'addressid2','135 mahoning avenue', 'Austintown', 'OH', '44514','10-21-216')
	('3', 'addressid3','136 mahoning avenue','Youngstown','OH','44515','20-23-2016')

INSERT INTO supplement_carriers_methods (supplement_carriers_methods_id, carrier, method, fee)
	('1', 'UPS', 'Ground', '4.99')
	('2', 'UPS', 'Express', '9.99')
	('3', 'USPS', 'Standard', '3.99')

INSERT INTO supplement_orders (supplement_orders_id, supplement_customers_id, supplement_transactions_id, supplement_shipping_addresses_id, supplement_carriers_methods_id, supplement_billing_addresses_id,
credit_no, credit_type, order_total,shipping_fee,order_date, shipping_date)

		('1','1','1','1','1','1', 'credit1','debit card','39.99','10/22/2016','10/22/2016')
		('2','2','2','2','2','2', 'credit2','debit card','49.99','10/21/2016','10/21/2016')
		('3','3','3','3','3','3', 'credit3','debit card','59.99','10/23/2016','10/23/2016')
		
INSERT INTO supplement_categories (supplement_categories_id,category,description)
	('1','protein','gains')
	('2','pre-workout','energy')
	('3','protein','gains')

INSERT INTO supplement_sizes (supplement_sizes_id,size)
	('1','large')
	('2','medium')	
	('3','large')
	
INSERT INTO supplement_colors (supplement_colors_id,keyword,code)
	('1','black','#000000')
	('2','red','#FF0000')
	('3','green','#008000')
	
INSERT INTO supplements (supplements_id,supplement_categories_id,supplement_sizes_id,supplement_colors_id,price,photo,stock_quantity,date_added)
	('1','1','1','1','39.99','quantity1','10-22-2016')
	('2','2','2','2','49.99','quantity1','10-21-2016')
	('3','3','3','3','59.99','quantity1','10-23-2016')

INSERT INTO supplement_orders_supplements (supplement_orders_supplements_id,supplement_orders_id,quantity,price)
	('1','1','quantity1','39.99')
	('2','2','quantity1','49.99')
	('3','3','quantity1','49.99')	
	
INSERT INTO supplemenjt_carts (supplement_carts_id,supplement_customers_id,supplements_id,quantity,date_added,date_modified)
	('1','1','1','quantity1','10-22-2016')
	('2','2','2','quantity1','10-21-2016')
	('3','3','3','quantity1','10-23-2016')	