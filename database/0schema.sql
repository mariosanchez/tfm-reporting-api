CREATE DATABASE IF NOT EXISTS reporting DEFAULT CHARACTER SET utf8;

CREATE TABLE affiliate_status (
  affiliate_status_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (affiliate_status_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `reporting`.`affiliate_status` (`affiliate_status_id`, `name`) VALUES (null, 'enabled'), (null, 'unverified'), (null, 'disabled');

CREATE TABLE affiliate (
  affiliate_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  affiliate_status_id TINYINT UNSIGNED NOT NULL,
  affiliate_key CHAR(64),
  name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  last_name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  email VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  PRIMARY KEY (affiliate_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE affiliate ADD CONSTRAINT fk_affiliate_status_affiliate_id_status FOREIGN KEY (affiliate_status_id) REFERENCES affiliate_status (affiliate_status_id);