CREATE TABLE IF NOT EXISTS sport (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO sport (name)
VALUES ('Soccer'),
		('Football'),
		('Tennis');
