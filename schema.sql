CREATE TABLE users (
id INTEGER PRIMARY KEY AUTO_INCREMENT,
level INTEGER,
username VARCHAR(50),
email VARCHAR(50),
password VARCHAR(255)
);

CREATE TABLE jobs (
id INTEGER PRIMARY KEY AUTO_INCREMENT,
jobtype INTEGER,
jobname VARCHAR(100),
location VARCHAR(100),
description VARCHAR(1000),
jobstart DATE,
jobend DATE,
firmid INT,
);
