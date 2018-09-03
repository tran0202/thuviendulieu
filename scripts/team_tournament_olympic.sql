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

# Rio 2016
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (835, 32, 1, 1),
	(836, 32, 1, 2),
	(837, 32, 1, 3),
	(838, 32, 1, 4),
	(839, 32, 2, 1),
	(840, 32, 2, 2),
	(841, 32, 2, 3),
	(842, 32, 2, 4),
	(843, 32, 3, 1),
	(844, 32, 3, 2),
	(845, 32, 3, 3),
	(846, 32, 3, 4),
	(847, 32, 4, 1),
	(848, 32, 4, 2),
	(849, 32, 4, 3),
	(850, 32, 4, 4);