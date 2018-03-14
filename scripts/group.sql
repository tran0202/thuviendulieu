CREATE TABLE IF NOT EXISTS `group` (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	tournament_id INT,
	FOREIGN KEY (tournament_id) REFERENCES tournament(id)
);

INSERT INTO `group` (name, tournament_id)
VALUES ('Group A', 1),
		('Group B', 1),
		('Group C', 1),
		('Group D', 1),
		('Group E', 1),
		('Group F', 1),
		('Group G', 1),
		('Group H', 1);

UPDATE `group`
SET name = SUBSTRING(name, 7, 1);
