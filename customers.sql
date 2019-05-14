USE ecommerce


CREATE TABLE hat_states (
	hat_states_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	state VARCHAR(30) NOT NULL,
	abbr CHAR(2) NOT NULL,
	PRIMARY KEY (hat_states_id)
) ENGINE = InnoDB;

INSERT INTO hat_states(state, abbr) VALUES
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

CREATE TABLE hat_customers (
	hat_customers_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, 
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
	PRIMARY KEY(hat_customers_id),
	INDEX ind_hat_states_id (hat_states_id),
	CONSTRAINT fk_hat_states_id FOREIGN KEY (hat_states_id) REFERENCES hat_states(hat_states_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

create table hat_transactions(
	hat_transactions_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount_charged DECIMAL(6, 3) NOT NULL, 
	type VARCHAR(100) NOT NULL, 
	response_code VARCHAR(200) NOT NULL, 
	response_reason VARCHAR(200) NOT NULL, 
	response_text VARCHAR(400) NOT NULL, 
	date_created TIMESTAMP NOT NULL, 
	PRIMARY KEY(hat_transactions_id)
) ENGINE = InnoDB;

create table hat_shipping_addresses(
	hat_shipping_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT NULL, 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT NULL, 
	hat_states_id TINYINT UNSIGNED NOT NULL, 
	zip CHAR(5) NOT NULL, 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(hat_shipping_addresses_id)
) ENGINE = InnoDB;

create table hat_billing_addresses(
	hat_billing_addresses_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	address_1 VARCHAR(100) NOT NULL, 
	address_2 VARCHAR(100), 
	city VARCHAR(50) NOT NULL, 
	hat_states_id TINYINT UNSIGNED NOT NULL, 
	zip CHAR(5) NOT NULL, 
	date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(hat_billing_addresses_id)
) ENGINE = InnoDB;

create table hat_carriers_methods(
	hat_carriers_methods_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	carrier VARCHAR(50) NOT NULL, 
	method VARCHAR(50) NOT NULL, 
	fee DECIMAL(6, 3) NOT NULL, 
	PRIMARY KEY(hat_carriers_methods_id)
) ENGINE = InnoDB;

INSERT INTO hat_carriers_methods (carrier, method, fee) VALUES 
('UPS', 'Ground', '4.99'),
('UPS', 'Express', '9.99'),
('USPS', 'Standard', '3.99'),
('USPS', 'Expedited', '6.99'),
('FEDEX', 'Same Day', '49.99'),
('FEDEX', 'One Day', '29.99'),
('FEDEX', 'Three Days', '9.99');

create table hat_orders(
	hat_orders_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	hat_customers_id MEDIUMINT UNSIGNED NOT NULL,
	hat_transactions_id INT UNSIGNED NOT NULL,
	hat_shipping_addresses_id INT UNSIGNED NOT NULL,
	hat_carriers_methods_id TINYINT UNSIGNED NOT NULL,
	hat_billing_addresses_id INT UNSIGNED NOT NULL,
	credit_no CHAR(4) NOT NULL, 
	credit_type VARCHAR(20) NOT NULL, 
	order_total DECIMAL(7, 3) NOT NULL, 
	shipping_fee DECIMAL(6, 3) NOT NULL, 
	order_date TIMESTAMP NOT NULL, 
	shipping_date TIMESTAMP NOT NULL, 
	PRIMARY KEY(hat_orders_id),
	INDEX ind_hat_customers_id (hat_customers_id),
	CONSTRAINT fk_hat_customers_id FOREIGN KEY (hat_customers_id) REFERENCES hat_customers(hat_customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hat_transactions_id (hat_transactions_id),
	CONSTRAINT fk_hat_transactions_id FOREIGN KEY (hat_transactions_id) REFERENCES hat_transactions(hat_transactions_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hat_shipping_addresses_id (hat_shipping_addresses_id),
	CONSTRAINT fk_hat_shipping_addresses_id FOREIGN KEY (hat_shipping_addresses_id) REFERENCES hat_shipping_addresses(hat_shipping_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hat_carriers_methods_id (hat_carriers_methods_id),
	CONSTRAINT fk_hat_carriers_methods_id FOREIGN KEY (hat_carriers_methods_id) REFERENCES hat_carriers_methods(hat_carriers_methods_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hat_billing_addresses_id (hat_billing_addresses_id),
	CONSTRAINT fk_hat_billing_addresses_id FOREIGN KEY (hat_billing_addresses_id) REFERENCES hat_billing_addresses(hat_billing_addresses_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

create table hat_categories(
	hat_categories_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	category VARCHAR(100) NOT NULL,
	description VARCHAR(1000),
	PRIMARY KEY(hat_categories_id)
) ENGINE = InnoDB;

create table hat_sizes(
	hat_sizes_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	size VARCHAR(20) NOT NULL,
	PRIMARY KEY(hat_sizes_id)
) ENGINE = InnoDB;

INSERT INTO hat_sizes (size) VALUES
	('xxx-small'),
	('xx-small'),
	('x-small'),
	('small'),
	('medium'),
	('large'),
	('x-large'),
	('xx-large'),
	('xxx-large');
	
create table hat_colors(
	hat_colors_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	keyword VARCHAR(20) NOT NULL,
	code VARCHAR(20) NOT NULL,
	PRIMARY KEY(hat_colors_id)
) ENGINE = InnoDB;

INSERT INTO hat_colors (keyword, code) VALUES
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

create table hats(
	hats_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	hat_categories_id SMALLINT UNSIGNED NOT NULL,
	hat_sizes_id TINYINT UNSIGNED NOT NULL,
	hat_colors_id TINYINT UNSIGNED NOT NULL,
	price DECIMAL(6,3) NOT NULL,
	photo VARCHAR(100),
	stock_quantity MEDIUMINT UNSIGNED NOT NULL,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(hats_id),
	INDEX ind_hat_categories_id (hat_categories_id),
	CONSTRAINT fk_hat_categories_id FOREIGN KEY (hat_categories_id) REFERENCES hat_categories(hat_categories_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX fk_hat_sizes_id (hat_sizes_id),
	CONSTRAINT fk_hat_sizes_id FOREIGN KEY (hat_sizes_id) REFERENCES hat_sizes(hat_sizes_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hat_colors_id (hat_colors_id),
	CONSTRAINT fk_hat_colors_id FOREIGN KEY (hat_colors_id) REFERENCES hat_colors(hat_colors_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;

create table hat_orders_hats(
	hat_orders_hats_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	hat_orders_id INT UNSIGNED NOT NULL,
	hats_id MEDIUMINT UNSIGNED NOT NULL,
	quantity TINYINT UNSIGNED NOT NULL,
	price DECIMAL(7,3) NOT NULL,
	PRIMARY KEY(hat_orders_hats_id),
	INDEX ind_hat_orders_id (hat_orders_id),
	CONSTRAINT fk_hat_orders_id FOREIGN KEY (hat_orders_id) REFERENCES hat_orders(hat_orders_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hats_id (hats_id),
	CONSTRAINT fk_hats_id FOREIGN KEY (hats_id) REFERENCES hats(hats_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;


create table hat_carts(
	hat_carts_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	hat_customers_id MEDIUMINT UNSIGNED NOT NULL, 
	hats_id MEDIUMINT UNSIGNED NOT NULL, 
	quantity TINYINT UNSIGNED NOT NULL, 
	date_added TIMESTAMP NOT NULL, 
	date_modified TIMESTAMP NOT NULL, 
	PRIMARY KEY(hat_carts_id),
	INDEX ind_hat_customers_id (hat_customers_id),
	CONSTRAINT fk_carts_hat_customers_id FOREIGN KEY (hat_customers_id) REFERENCES hat_customers(hat_customers_id)
	ON DELETE CASCADE on UPDATE CASCADE,
	INDEX ind_hats_id (hats_id),
	CONSTRAINT fk_carts_hats_id FOREIGN KEY (hats_id) REFERENCES hats(hats_id)
	ON DELETE CASCADE on UPDATE CASCADE
) ENGINE = InnoDB;