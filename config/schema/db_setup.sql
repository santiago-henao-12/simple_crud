# Creation of Database
CREATE DATABASE crud_data;

# Creation of user
CREATE USER 'crud_user'@'localhost' IDENTIFIED BY 'xrlf8900';

GRANT ALL PRIVILEGES ON crud_data.* TO 'crud_user'@'localhost';

FLUSH PRIVILEGES;
