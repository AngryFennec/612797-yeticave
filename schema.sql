DROP DATABASE 612797-yeticave;
CREATE DATABASE IF NOT EXISTS 612797-yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
  user_id  INT AUTO_INCREMENT PRIMARY KEY,
  email CHAR(128) UNIQUE,
  password  CHAR(64),
  init_date  TIMESTAMP,
  name  CHAR(128),
  avatar  CHAR(128),
  contacts  TEXT
);

CREATE TABLE bets (
  bet_id INT PRIMARY KEY,
  init_date  TIMESTAMP,
  sum INT
);

CREATE TABLE categories (
  category_id INT PRIMARY KEY,
  name  CHAR(128) UNIQUE
);

CREATE TABLE lots (
  sum  INT,
  init_date  TIMESTAMP,
  end_date  TIMESTAMP,
  name  CHAR(128),
  description CHAR(128),
  img  CHAR(128),
  bet_step  INT,
  user_id INT
  category_id INT FOREIGN KEY,
  lot_id INT PRIMATY KEY
);
