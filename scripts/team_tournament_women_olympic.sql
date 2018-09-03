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
VALUES (851, 33, 5, 1),
	(852, 33, 5, 2),
	(853, 33, 5, 3),
	(854, 33, 5, 4),
	(855, 33, 6, 1),
	(856, 33, 6, 2),
	(857, 33, 6, 3),
	(858, 33, 6, 4),
	(859, 33, 7, 1),
	(860, 33, 7, 2),
	(861, 33, 7, 3),
	(862, 33, 7, 4);
