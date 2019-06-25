CREATE DATABASE bdcrud
GO
CREATE TABLE IF NOT EXISTS persona(
    idPersona INT NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    edad INT,
    genero CHAR(1),
    fechaNac DATE,
    imagen VARCHAR(300),
    PRIMARY KEY (idPersona)
)
GO
CREATE USER 'bdcrud'@'localhost' IDENTIFIED BY ''
GO
GRANT ALL PRIVILEGES ON * . * TO 'bdcrud'@'localhost'
GO

INSERT INTO persona(idPersona, nombre, apellido, edad, genero, fechaNac, imagen)
  VALUES(1, 'Adrian', 'Castillo', 26, 'M', '2019-06-04', '...')
GO
SELECT * FROM bdcrud.persona
 