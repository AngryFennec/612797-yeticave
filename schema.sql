--DROP DATABASE 612797_yeticave;
CREATE DATABASE IF NOT EXISTS 612797_yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE 612797_yeticave;

CREATE TABLE users (
  user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(128) UNIQUE,
  password  VARCHAR(64),
  init_date  TIMESTAMP,
  name  VARCHAR(128),
  avatar  VARCHAR(128),
  contacts  TEXT
);


CREATE TABLE categories (
  category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  class VARCHAR(128) UNIQUE,
  cat_name  VARCHAR(128) UNIQUE
);

CREATE TABLE lots (
  lot_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sum  INT,
  init_date  TIMESTAMP,
  end_date  TIMESTAMP,
  name  VARCHAR(128),
  description VARCHAR(128),
  img  VARCHAR(128),
  bet_step  INT,
  user_id INT UNSIGNED,
  category_id INT UNSIGNED,
  winner_id INT,

  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (category_id) REFERENCES categories (category_id)
);

CREATE TABLE bets (
  bet_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  init_date  TIMESTAMP,
  user_id INT UNSIGNED,
  lot_id INT UNSIGNED,
  sum INT,

  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (lot_id) REFERENCES lots (lot_id)
);

CREATE FULLTEXT INDEX name_description ON lots(name, description)
