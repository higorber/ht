-- Crie o banco de dados hotel_db se ele ainda não existir
CREATE DATABASE IF NOT EXISTS hotel_db;

-- Use o banco de dados hotel_db
USE hotel_db;

-- Desative o modo de não gerar valores automáticos em zero
SET SQL_MODE = "";

-- Crie a tabela users
CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telefone VARCHAR(11) NOT NULL,
  documento VARCHAR(11) NOT NULL,
  observacao VARCHAR(255) NULL,
  endereco VARCHAR(255) NULL,
  celiaco VARCHAR(3) NULL,
  password VARCHAR(80) NOT NULL,
  join_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_login DATETIME NOT NULL,
  permissions VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela users
INSERT INTO users (full_name, email, telefone, documento, password, join_date, last_login, permissions) VALUES
('Thulani Tembo', 'tembothulani@gmail.com', '1234567890', '12345678901', '$2y$10$KKRlG5O2UA0aIY/7YBBzs.5IsqAB38pr8dr0eM2OmXtaB/lv0vG8S', '2017-08-25 14:20:37', '2017-12-13 23:50:22', 'admin, editor'),
('Theresa Nayame', 'theresanayame@gmail.com', '0987654321', '09876543210', '$2y$10$NuwKjycWxGZ9qOqXzLOoEeB1R1O5H5bEiRS2ChFiqa7.jg8x9BlAK', '2017-11-11 00:11:15', '2017-12-11 01:36:21', 'editor,admin'),
('admin', 'admin@admin.com', '0123456789', '01234567890', '$2y$10$Dhgz8tgcOjuI08Y0o5wsS.gK3.kNDRNpc.z9Q0qJ3mGpJMYDaIQBi', '2017-12-13 23:12:51', '0000-00-00 00:00:00', 'editor,admin');

-- Crie a tabela rooms
CREATE TABLE IF NOT EXISTS rooms (
  id INT(11) NOT NULL AUTO_INCREMENT,
  room_number VARCHAR(255) NOT NULL,
  rooms INT(11) NOT NULL,
  type VARCHAR(255) NOT NULL,
  price TEXT NOT NULL,
  details TEXT NOT NULL,
  photo TEXT NOT NULL,
  PRIMARY KEY (id),
  usuario_id INT(11) NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela rooms
INSERT INTO rooms (room_number, rooms, type, price, details, photo, usuario_id) VALUES
('Victoria Falls Hotel', 20, 'Executive', '550', 'it is a self-contained room with room service', 'images/38a42bea45f24cbe580972a30694fe4a.jpg', 1),
('Chita Samfya Lodge', 15, 'Regular', '450', 'it is a self-contained room with room service', 'images/e434cecc6cfa3b049462b124681bd0b8.jpg', 1),
('Inter-Continental Hotel', 24, 'Executive', '650', 'it is a self-contained room with room service.', 'images/2ff14dfea91787d539b7509427338e97.jpg', 1);

-- Crie a tabela reservations
CREATE TABLE IF NOT EXISTS reservations (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  checkin DATE NOT NULL,
  checkout DATE NOT NULL,
  phone TEXT NOT NULL,
  people INT(11) NOT NULL,
  email VARCHAR(255) NOT NULL,
  room VARCHAR(255) NOT NULL,
  aprovacao VARCHAR (100) NOT NULL,
  price TEXT NOT NULL,
  user_id INT(11) NOT NULL,
  rooms_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (rooms_id) REFERENCES rooms (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela reservations
INSERT INTO reservations (name, checkin, checkout, phone, people, email, room, user_id, rooms_id) VALUES
('Tul', '2017-12-16', '2017-12-26', '0976245430', 2, 'tembothulani@gmail.com', 'Inter-Continental Hotel', 1, 1);

-- Crie a tabela events
CREATE TABLE IF NOT EXISTS events (
  id INT(11) NOT NULL AUTO_INCREMENT,
  event_topic VARCHAR(255) NOT NULL,
  image TEXT NOT NULL,
  venue VARCHAR(255) NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  short_details VARCHAR(255) NOT NULL,
  full_details TEXT NOT NULL,
  past_event INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crie a tabela gallery
CREATE TABLE IF NOT EXISTS gallery (
  id INT(11) NOT NULL AUTO_INCREMENT,
  image TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela gallery
INSERT INTO gallery (image) VALUES
('assets/img/1282be579df4c8d45861b715d7cb818c.jpg'),
('assets/img/61a4288a79b1ddb39e4a62f14b361744.jpg'),
('assets/img/a6b8705ac3ad304a92ffdd5ad7b33253.jpg'),
('assets/img/09eab40045315449141e6c40e47a8393.png'),
('assets/img/daa87a8335af717e27dd749a655aec8a.jpg');

-- Crie a tabela tourism
CREATE TABLE IF NOT EXISTS tourism (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  photo TEXT NOT NULL,
  location VARCHAR(255) NOT NULL,
  details TEXT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  price VARCHAR(255) NOT NULL,
  reservations INT(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela tourism
INSERT INTO tourism (title, photo, location, details, date, time, price, reservations) VALUES
('Kuomboka ceremony', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'Mongu', 'It is a traditional ceremony found in Zambia. It is done once every year.', '2017-04-08', '07:00:00', '100', 15);

-- Crie a tabela tour_reserves
CREATE TABLE IF NOT EXISTS tour_reserves (
  id INT(11) NOT NULL AUTO_INCREMENT,
  tour_id INT(11) NOT NULL,
  reservations INT(11) NOT NULL,
  cus_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela tour_reserves
INSERT INTO tour_reserves (tour_id, reservations, cus_name, email, phone) VALUES
(3, 5, 'Tutu', 'te@gmail.com', '0976245430');

-- Defina a restrição de chave estrangeira para a tabela reservations
ALTER TABLE reservations ADD CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE reservations ADD CONSTRAINT rooms_id FOREIGN KEY (rooms_id) REFERENCES rooms (id);
ALTER TABLE rooms ADD CONSTRAINT usuario_id FOREIGN KEY (usuario_id) REFERENCES users (id);

