CREATE DATABASE prueba_tecnica;
use prueba_tecnica;
CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NULL,
    last_name VARCHAR(50) NULL,
    email VARCHAR(255) NOT NULL,
    code BIGINT NOT NULL
) AUTO_INCREMENT = 1;