DROP DATABASE IF EXISTS tma;
CREATE DATABASE tma;
USE tma;

CREATE TABLE users (
  id_user CHAR(11) NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_user),
  CONSTRAINT `uq_email` UNIQUE (email)
);

CREATE TABLE activities (
  id_activity INT NOT NULL AUTO_INCREMENT,
  id_user CHAR(11) NOT NULL,
  title VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  repetition ENUM('none', 'daily', 'weekly', 'monthly') NOT NULL,
  priority ENUM('none', 'important') NOT NULL,
  PRIMARY KEY (id_activity),
  CONSTRAINT fk_activity_user
  FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE history_activities (
  id_history INT NOT NULL AUTO_INCREMENT,
  id_user CHAR(11) NOT NULL,
  title VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (id_history),
  CONSTRAINT fk_history_user 
  FOREIGN KEY (id_user) REFERENCES users(id_user)
);
