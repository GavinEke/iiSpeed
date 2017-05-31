CREATE DATABASE iiSpeed;
CREATE USER 'iiSpeed'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON iiSpeed.* TO 'iiSpeed'@'localhost';
FLUSH PRIVILEGES;
USE iiSpeed;
CREATE TABLE data ( sample_date_utc bigint unsigned, ping decimal(8,3), downspeed decimal(12,6), upspeed decimal(12,6) );
QUIT;
