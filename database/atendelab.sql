CREATE DATABASE IF NOT EXISTS atendelab;
USE atendelab;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
 id INT AUTO_INCREMENT PRIMARY KEY, 
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL UNIQUE,
 senha VARCHAR(255) NOT NULL,
 perfil ENUM('admin', 'atendente') DEFAULT 'atendente',
 status ENUM('ativo', 'inativo') DEFAULT 'ativo',
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS pessoa;
CREATE TABLE pessoa (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 data_atendimento date NOT NULL,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS tipo_atendimento;
CREATE TABLE tipo_atendimento (
 id INT AUTO_INCREMENT PRIMARY KEY,
 mentoria VARCHAR(100) NOT NULL,
 avaliacao VARCHAR(100) NOT NULL,
 a VARCHAR(255) NOT NULL,
 perfil ENUM('admin', 'atendente') DEFAULT 'atendente',
 status ENUM('ativo', 'inativo') DEFAULT 'ativo',
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS atendimentos;
CREATE TABLE atendimentos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL UNIQUE,
 senha VARCHAR(255) NOT NULL,
 perfil ENUM('admin', 'atendente') DEFAULT 'atendente',
 status ENUM('ativo', 'inativo') DEFAULT 'ativo',
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);