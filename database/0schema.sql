CREATE DATABASE IF NOT EXISTS reporting DEFAULT CHARACTER SET utf8;

CREATE TABLE admin (
  admin_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  last_name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  email VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  password VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  PRIMARY KEY (admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE affiliate_status (
  affiliate_status_id TINYINT UNSIGNED NOT NULL,
  name VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (affiliate_status_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `reporting`.`affiliate_status` (`affiliate_status_id`, `name`) VALUES (0, 'disabled'), (1, 'enabled'), (2, 'unverified');

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

CREATE TABLE conversion_track (
  conversion_track_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  affiliate_id SMALLINT UNSIGNED NOT NULL,
  affiliate_key CHAR(64),
  conversion_id CHAR(64),
  created_at datetime NOT NULL,
  PRIMARY KEY (conversion_track_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE conversion_track ADD CONSTRAINT fk_conversion_track_affiliate_affiliate_id FOREIGN KEY (affiliate_id) REFERENCES affiliate (affiliate_id);

CREATE TABLE cancellation_track (
  cancellation_track_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  affiliate_id SMALLINT UNSIGNED NOT NULL,
  affiliate_key CHAR(64),
  cancellation_id CHAR(64),
  created_at datetime NOT NULL,
  PRIMARY KEY (cancellation_track_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE cancellation_track ADD CONSTRAINT fk_cancellation_track_affiliate_affiliate_id FOREIGN KEY (affiliate_id) REFERENCES affiliate (affiliate_id);

CREATE TABLE click_track (
  click_track_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  affiliate_id SMALLINT UNSIGNED NOT NULL,
  affiliate_key CHAR(64),
  click_id CHAR(64),
  created_at datetime NOT NULL,
  PRIMARY KEY (click_track_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE click_track ADD CONSTRAINT fk_click_track_affiliate_affiliate_id FOREIGN KEY (affiliate_id) REFERENCES affiliate (affiliate_id);