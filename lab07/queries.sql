USE s100684019_db;

/* Query all records */
SELECT * FROM cars;

/* Make, model, and price, sorted by make and model */
SELECT make, model, price FROM cars ORDER BY make, model;

/* Query all records with a price greater than or equal to $20000 */
SELECT * FROM cars WHERE price >= 20000;

/* Query all records with a price less than $15000 */
SELECT * FROM cars WHERE price < 15000;

/* Query the average price of cars of a similar make */
SELECT make, AVG(price) AS 'Average Price' FROM cars GROUP BY make;