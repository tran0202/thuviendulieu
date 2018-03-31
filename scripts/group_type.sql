CREATE TABLE IF NOT EXISTS group_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO group_type (name)
VALUES ('Group'),
		('Conference'),
		('Division'),
		('Stage'),
		('Round');

INSERT INTO group_type (name)
VALUES ('Nation'),
	('Association');
