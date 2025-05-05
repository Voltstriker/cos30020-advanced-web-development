USE s100684019_db;

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `car_id` INT NOT NULL AUTO_INCREMENT,
  `make` VARCHAR(250) NOT NULL,
  `model` VARCHAR(250) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `yom` INT NOT NULL,
  PRIMARY KEY (`car_id`)
);
INSERT INTO `cars` (`make`, `model`, `price`, `yom`) VALUES
('Holden', 'Astra', 14000.00, 2005),
('BMW', 'X3', 35000.00, 2004),
('Ford', 'Falcon', 39000.00, 2011),
('Toyota', 'Corolla', 20000.00, 2012),
('Holden', 'Commodore', 13500.00, 2005),
('Holden', 'Astra', 8000.00, 2001),
('Holden', 'Commodore', 28000.00, 2009),
('Ford', 'Falcon', 14000.00, 2007),
('Ford', 'Falcon', 7000.00, 2003),
('Ford', 'Laser', 10000.00, 2010),
('Mazda', 'RX-7', 26000.00, 2000),
('Toyota', 'Corolla', 12000.00, 2001),
('Mazda', '3', 14500.00, 2009);
