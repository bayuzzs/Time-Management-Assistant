DROP DATABASE IF EXISTS tma;
CREATE DATABASE tma;
USE tma;

CREATE TABLE users (
  id_user INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_user),
  CONSTRAINT `uq_email` UNIQUE (email)
);

CREATE TABLE activities (
  id_activity INT NOT NULL AUTO_INCREMENT,
  id_user INT NOT NULL,
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
  id_user INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (id_history),
  CONSTRAINT fk_history_user 
  FOREIGN KEY (id_user) REFERENCES users(id_user)
);

-- INSERT INTO users (name, email, password) VALUES
-- ('bayu', 'bayu@gmail', '333'),
-- ('ibnu', 'ibnu@gmail', '333'),
-- ('ali', 'ali@gmail', '333'),
-- ('dwi', 'dwi@gmail', '333'),
-- ('fazra', 'fazra@gmail', '333'),
-- ('ajeng', 'ajeng@gmail', '333');

-- INSERT INTO activities 
-- (id_activity, id_user, title, description, date, time, repetition, priority) VALUES 
-- (1, 1, 'Title 1', 'Description 1', '2021-01-01', '10:00:00', 'none', 'none'),
-- (2, 2, 'Title 2', 'Description 2', '2021-01-02', '10:00:00', 'daily', 'none'),
-- (3, 3, 'Title 3', 'Description 3', '2021-01-03', '10:00:00', 'weekyly', 'important'),
-- (4, 4, 'Title 4', 'Description 4', '2021-01-04', '10:00:00', 'monthly', 'none'),
-- (5, 5, 'Title 5', 'Description 5', '2021-01-05', '10:00:00', 'none', 'important');

-- INSERT INTO history_activities
-- (id_history, id_user, title, description, date) VALUES
-- (1, 1, 'Title 1', 'Description 1', '2021-01-01'),
-- (2, 2, 'Title 2', 'Description 2', '2021-01-02'),
-- (3, 3, 'Title 3', 'Description 3', '2021-01-03'),
-- (4, 4, 'Title 4', 'Description 4', '2021-01-04'),
-- (5, 5, 'Title 5', 'Description 5', '2021-01-05');

-- SELECT id_activity, title, description, date, time, repetition, priority
-- FROM activities JOIN users ON (activities.id_user = users.id_user) 
-- WHERE email = 'bayu@gmail';

-- SELECT id_history, title, description, date FROM history_activities 
-- JOIN users ON (history_activities.id_user = users.id_user) 
-- WHERE email = 'bayu@gmail';