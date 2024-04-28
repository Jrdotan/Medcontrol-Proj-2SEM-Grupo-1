create database medcontrol_db; 
use medcontrol_db;

create table usuario (
	id bigint AUTO_INCREMENT primary key,
	email tinytext, 
	username tinytext,
	pwd longtext,
	date_ini TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);