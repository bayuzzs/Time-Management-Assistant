CREATE DATABASE tma;
USE tma;

CREATE TABLE users (
  id_user INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_user)
);

CREATE TABLE activities (
  id_activity INT NOT NULL AUTO_INCREMENT,
  id_user INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  timeZone VARCHAR(50) NOT NULL,
  repetition ENUM('none', 'daily', 'weekly', 'monthly') NOT NULL,
  priority ENUM('none', 'important') NOT NULL,
  PRIMARY KEY (id_activity),
  CONSTRAINT fk_activity_user
  FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE history_activities (
  id_history INT NOT NULL AUTO_INCREMENT,
  id_user INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (id_history),
  CONSTRAINT fk_history_user 
  FOREIGN KEY (id_user) REFERENCES users(id_user)
);

INSERT INTO users (name, email, password) VALUES
('admin', 'admin@gmail.com', '333'),
('user', 'user@gmail.com', '333'),
('bayu', 'bayu@gmail', '333'),
('ibnu', 'ibnu@gmail', '333'),
('ali', 'ali@gmail', '333');

INSERT INTO activities (id_user, title, description, date, time, timeZone, repetition, priority) VALUES
-- add activities here with different time
(1, 'meeting', 'meeting with client', '2022-01-01', '10:00:00', 'Asia/Jakarta', 'none', 'none'),
(2, 'lunch', 'lunch with client', '2022-01-01', '12:00:00', 'Asia/Jakarta', 'none', 'none');
