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

-- INSERT INTO users (id_user, name, email, password) VALUES
-- ('udpcu37snc1', 'bayu', 'bayu@gmail', '333'),
-- ('udpcu37snc2', 'ibnu', 'ibnu@gmail', '333'),
-- ('udpcu37snc3', 'ali', 'ali@gmail', '333'),
-- ('udpcu37snc4', 'dwi', 'dwi@gmail', '333'),
-- ('udpcu37snc5', 'fazra', 'fazra@gmail', '333'),
-- ('udpcu37snc6', 'ajeng', 'ajeng@gmail', '333');

-- INSERT INTO activities 
-- (id_activity, id_user, title, description, date, time, repetition, priority) VALUES 
-- ('1', 'udpcu37snc4', 'Title 1', 'Description 1', '2021-01-01', '10:00:00', 'none', 'none'),
-- ('2', 'udpcu37snc2', 'Title 2', 'Description 2', '2021-01-02', '10:00:00', 'daily', 'none'),
-- ('3', 'udpcu37snc5', 'Title 3', 'Description 3', '2021-01-03', '10:00:00', 'weekyly', 'important'),
-- ('4', 'udpcu37snc2', 'Title 4', 'Description 4', '2021-01-04', '10:00:00', 'monthly', 'none'),
-- ('5', 'udpcu37snc1', 'Title 5', 'Description 5', '2021-01-05', '10:00:00', 'none', 'important');

-- INSERT INTO history_activities
-- (id_history, id_user, title, description, date) VALUES
-- ('1', 'udpcu37snc4', 'Title 1', 'Description 1', '2021-01-01',),
-- ('2', 'udpcu37snc2', 'Title 2', 'Description 2', '2021-01-02',),
-- ('3', 'udpcu37snc5', 'Title 3', 'Description 3', '2021-01-03',),
-- ('4', 'udpcu37snc2', 'Title 4', 'Description 4', '2021-01-04',),
-- ('5', 'udpcu37snc1', 'Title 5', 'Description 5', '2021-01-05',);

-- UPDATE activities SET 
-- priority = 'important', 
-- repetition = 'none', 
-- time = '10:00:00', 
-- date = '2021-01-01', 
-- WHERE id_activity = '1';

-- DELETE FROM activities WHERE id_activity = '2';
-- SELECT * FROM history_activities WHERE id_user = 'udpcu37snc1';
