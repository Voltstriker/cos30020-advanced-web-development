USE s100684019_db;

DROP TABLE IF EXISTS `vipmembers`;

CREATE TABLE `vipmembers` (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(40),
    lname VARCHAR(40),
    gender VARCHAR(1),
    email VARCHAR(40),
    phone VARCHAR(20)
);