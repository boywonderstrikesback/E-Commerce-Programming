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