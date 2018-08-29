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
VALUES (573, 29), (571, 29), (579, 29), (581, 29);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (575, 29), (576, 29), (599, 29), (588, 29),
	   (563, 29), (567, 29), (572, 29), (561, 29),
	   (602, 29), (577, 29), (589, 29), (598, 29),
	   (569, 29), (580, 29), (583, 29), (565, 29),
	   (597, 29), (592, 29), (603, 29), (593, 29),
	   (555, 29), (596, 29), (564, 29), (578, 29),
	   (600, 29), (582, 29), (570, 29), (585, 29),
	   (586, 29), (601, 29), (587, 29);
