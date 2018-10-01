DROP DATABASE yeticave;
CREATE DATABASE IF NOT EXISTS yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
  id  INT AUTO_INCREMENT PRIMARY KEY,
  email CHAR(128),
  password  CHAR(64),
  init_date  TIMESTAMP,
  name  CHAR(128),
  avatar  CHAR(128),
  contacts  TEXT
);

CREATE TABLE bets (
  init_date  TIMESTAMP,
  sum INT
);

CREATE TABLE categories (
  name  CHAR(128)
);

CREATE TABLE lots (
  sum  INT,
  init_date  TIMESTAMP,
  end_date  TIMESTAMP,
  name  CHAR(128),
  description CHAR(128),
  img  CHAR(128),
  bet_step  INT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX id ON users(id);
CREATE UNIQUE INDEX name ON categories(name);
CREATE INDEX name ON lots(name);
CREATE INDEX description ON lots(description);
