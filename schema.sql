CREATE DATABASE IF NOT EXISTS college_db;
USE college_db;

CREATE TABLE students (
                          id         INT AUTO_INCREMENT PRIMARY KEY,
                          student_id VARCHAR(20)  NOT NULL UNIQUE,
                          name       VARCHAR(100) NOT NULL,
                          email      VARCHAR(100) NOT NULL,
                          course     VARCHAR(100) NOT NULL,
                          phone      VARCHAR(15)  NOT NULL
);