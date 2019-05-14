USE ecommer_online2016;

CREATE TABLE supplement_states(
	supplement_states_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	state VARCHAR(30) NOT NULL,
	abbr  CHAR(2) NOT NULL,
	PRIMARY KEY (supplement_states_id)
) ENGINE = InnoDB;


CREATE TABLE supplement_customers (
	supplement_customers_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(40) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	address_1 VARCHAR(20) NOT NULL,
	address_2 VARCHAR(20) NOT NULL,
	city VARCHAR(20) NOT NULL,
	supplement_states_id TINYINT UNSIGNED NOT NULL,
	zip VARCHAR(20) NOT NULL,
	date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(supplement_customers_id),
	INDEX  ind_supplent_states_id(supplement_states_id),
	CONSTRAINT fk_supplement_states_id FOREIGN KEY (supplement_states_id) REFERENCES supplement_states(supplement_states_id)
		ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

CREATE TABLE supplement_orders(
	supplement_orders_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_transactions_id VARCHAR(30) NOT NULL,
	orders_total VARCHAR(40) NOT NULL,
	shipping VARCHAR(30) NOT NULL,
	order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	supplement_quantity VARCHAR(30) NOT NULL
	PRIMARY KEY(supplement_carriers_methods_id)
) ENGINE = InnoDB
	
 
 CREATE TABLE supplement_carriers_methods (
	supplement_carriers_methods_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	carrier VARCHAR(30) NOT NULL,
	method VARCHAR(30) NOT NULL,
	PRIMARY KEY(supplement_carriers_methods_id)
 ) ENGINE = InnoDB
 
 CREATE TABLE supplement_sales (
	supplement_customers_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT
	supplements_id VARCHAR(30) NOT NULL,
	sale_price VARCHAR(30) NOT NULL,
	open_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	close_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY(supplement_customers_id)
) ENGINE = InnoDB

CREATE TABLE supplement_carts (
	supplement_carts_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT
	supplement_customers_id VARCHAR(30) NOT NULL,
	supplements_id VARCHAR(30) NOT NULL,
	quantity VARCHAR(30) NOT NULL,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY(suppllement_carts_id)
) ENGINE = InnoDB

CREATE TABLE supplement_transactions (
	supplement_transactions_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_billing_address_id VARCHAR(30) NOT NULL,
	amount_charged VARCHAR(30) NOT NULL,
	response_code VARCHAR(30) NOT NULL,
	response_reason VARCHAR(30) NOT NULL,
	response_text VARCHAR(30) NOT NULL,
	date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY(supplement_transactions_id)
) ENGINE = InnoDB

CREATE TABLE supplement_shipping_address (
	supplement_billing_address_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_customers_id VARCHAR(30) NOT NULL,
	address_1 VARCHAR (30) NOT NULL,
	city VARCHAR(30) NOT NULL,
	supplement_state VARCHAR(30) NOT NULL,
	zip VARCHAR(30) NOT NULL,
	date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY(supplement_billing_address_id)
) ENGINE = InnoDB

CREATE TABLE supplement_categories (
	supplement_categories_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	category VARCHAR(30) NOT NULL,
	PRIMARY KEY(supplement_categories_id)
) ENGINE = InnoDB

CREATE TABLE supplement_sizes (
	supplement_sizes_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	size VARCHAR(30) NOT NULL
	PRIMARY KEY(supplement_sizes_id)
) ENGINE = InnoDB

CREATE TABLE supplement_billing_address (
	supplement_billing_address_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	supplement_customers_id VARCHAR(30) NOT NULL,
	address_1 VARCHAR(30) NOT NULL,
	city VARCHAR(30) NOT NULL,
	supplement_state VARCHAR(30) NOT NULL,
	zip VARCHAR(30) NOT NULL,
	date_created VARCHAR(30) NOT NULL
	PRIMARY KEY(supplement_billing_address_id)
) ENGINE = InnoDB
 
 