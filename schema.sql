CREATE DATABASE doingsdone
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;
 USE doingsdone;
 CREATE TABLE project (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    user_id INT    
 );
 CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status INT,
    title VARCHAR(255),
    file_link VARCHAR(255) ,
    dt_compleat DATETIME ,
    id_user INT,
    id_project INT 
 );  
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128), 
    name VARCHAR(50),
    password VARCHAR(50)
);


