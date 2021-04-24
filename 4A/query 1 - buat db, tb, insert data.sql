CREATE DATABASE db_dumb_library;

CREATE TABLE tb_writer (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE tb_category (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE tb_book (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    category_id int(5),
    writer_id int(5),
    publication_year int(5),
    img blob,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES tb_category(id),
    FOREIGN KEY (writer_id) REFERENCES tb_writer(id)
);

INSERT INTO tb_writer
  (name)
VALUES
  ('Aziz Union'),
  ('Egi Sajak'),
  ('Haris Astina'),
  ('Rizky Bar');

INSERT INTO tb_category
  (name)
VALUES
  ('Javascript'),
  ('Python'),
  ('Unity'),
  ('Miscellaneous');

INSERT INTO tb_book
  (name, category_id, writer_id, publication_year, img)
VALUES
  ('Angular JS Essentials', 1, 1, 2018, LOAD_FILE('c:\\Angular JS Essentials.jpg')),
  ('Learn To Code With Javascript', 1, 1, 2017, LOAD_FILE('c:\\Learn To Code With Javascript.jpg')),
  ('Unity 2018 By Example', 3, 2, 2018, LOAD_FILE('c:\\Unity 2018 By Example.jpg')),
  ('Building an RPG with Unity 2018', 3, 2, 2018, LOAD_FILE('c:\\Building an RPG with Unity 2018.jpg')),
  ('Python GUI Programming Cookbook', 2, 3, 2019, LOAD_FILE('c:\\Python GUI Programming Cookbook.jpg')),
  ('SQL Server Security Distilled', 4, 4, 2020, LOAD_FILE('c:\\SQL Server Security Distilled.jpg'));
