CREATE DATABASE EvaluacionIA;
USE EvaluacionIA;

CREATE TABLE Rol (
	id_rol INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre_rol VARCHAR(10) NOT NULL
);

CREATE TABLE Usuario (
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
	primer_apellido VARCHAR(50) NOT NULL,
	segundo_apellido VARCHAR(50),
	usuario VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	fecha_registro DATE NOT NULL
);

CREATE TABLE Materia(
    id_materia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nombre_materia VARCHAR(100) NOT NULL
);

CREATE TABLE Evaluacion (
	id_evaluacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_materia INT NOT NULL,
	tema VARCHAR(100) NOT NULL 
);

CREATE TABLE Calificacion(
	id_calificacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_evaluacion INT NOT NULL,
	calificacion TINYINT
);

CREATE TABLE Pregunta(
	id_pregunta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_evaluacion INT NOT NULL,
	pregunta VARCHAR(255),
    palabras_clave VARCHAR(255)
);

CREATE TABLE Respuesta(
	id_respuesta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_evaluacion INT NOT NULL,
	id_pregunta INT NOT NULL,
	id_usuario INT NOT NULL,
	respuesta VARCHAR(255)
);

/*Llaves foraneas*/
ALTER TABLE Usuario ADD CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES Rol(id_rol);
ALTER TABLE Materia ADD CONSTRAINT fk_materia_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario);
ALTER TABLE Evaluacion ADD CONSTRAINT fk_evaluacion_materia FOREIGN KEY (id_materia) REFERENCES Materia(id_materia);
ALTER TABLE Calificacion ADD CONSTRAINT fk_usuario_calificacion FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario);
ALTER TABLE Calificacion ADD CONSTRAINT fk_evaluacion_calificacion FOREIGN KEY (id_evaluacion) REFERENCES Evaluacion(id_evaluacion);
ALTER TABLE Pregunta ADD CONSTRAINT fk_pregunta_evaluacion FOREIGN KEY (id_evaluacion) REFERENCES Evaluacion(id_evaluacion);
ALTER TABLE Respuesta ADD CONSTRAINT fk_respuesta_evaluacion FOREIGN KEY (id_evaluacion) REFERENCES Evaluacion(id_evaluacion);
ALTER TABLE Respuesta ADD CONSTRAINT fk_respuesta_pregunta FOREIGN KEY (id_pregunta) REFERENCES Pregunta(id_pregunta);
ALTER TABLE Respuesta ADD CONSTRAINT fk_respuesta_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario);