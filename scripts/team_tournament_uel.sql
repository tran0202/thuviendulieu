CREATE TABLE IF NOT EXISTS team_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT NOT NULL,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	seed TINYINT UNSIGNED,
	FOREIGN KEY (team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id)
);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (733, 30), (686, 30), (676, 30), (721, 30),
	   (658, 30), (700, 30), (661, 30), (749, 30),
	   (653, 30), (744, 30), (675, 30), (681, 30),
	   (751, 30), (654, 30);
