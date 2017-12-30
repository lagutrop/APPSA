CREATE DATABASE if not exists APPSA;

USE APPSA;

CREATE USER if not exists 'appsa_admin'@'localhost' IDENTIFIED BY 'appsa_admin';

GRANT SELECT, INSERT, UPDATE, DELETE ON APPSA.* TO 'appsa_admin'@'localhost' IDENTIFIED BY 'appsa_admin';

CREATE TABLE if not exists socio (numero_socio INT NOT NULL, quota YEAR NOT NULL, data DATE NOT NULL,PRIMARY KEY(numero_socio, quota));

SELECT DATE_FORMAT(data, '%d/%m/%Y') FROM socio;

CREATE TABLE if not exists utilizador (
nome varchar(20) NOT NULL,
senha varchar(200) NOT NULL,
PRIMARY KEY(nome));

CREATE TABLE if not exists sessao (
id varchar(32) NOT NULL,
nome varchar(200) NOT NULL,
data int(11) NOT NULL,
PRIMARY KEY(id));

INSERT IGNORE INTO utilizador (nome,senha) VALUES('appsa', '$2a$10$IWFudetlANtBaWxFUnH73OMoHaZzMG7qRMyc6WWSMo7dG23gLWLue');

INSERT IGNORE INTO socio VALUES(1,2017,STR_TO_DATE('1-12-2016','%d-%m-%Y'));