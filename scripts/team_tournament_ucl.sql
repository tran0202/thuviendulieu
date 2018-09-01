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
VALUES (573, 29), (571, 29), (579, 29), (581, 29),
	   (575, 29), (576, 29), (599, 29), (588, 29),
	   (563, 29), (567, 29), (572, 29), (561, 29),
	   (602, 29), (577, 29), (589, 29), (598, 29),
	   (569, 29), (580, 29), (583, 29), (565, 29),
	   (597, 29), (592, 29), (603, 29), (593, 29),
	   (555, 29), (596, 29), (564, 29), (578, 29),
	   (600, 29), (582, 29), (570, 29), (585, 29),
	   (586, 29), (601, 29), (587, 29), (584, 29),
	   (568, 29), (558, 29), (566, 29), (556, 29),
	   (553, 29), (552, 29), (595, 29),
	   (551, 29), (560, 29), (591, 29), (594, 29),
	   (554, 29), (574, 29), (557, 29), (590, 29),
	   (562, 29), (559, 29);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (562, 29), (559, 29);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (540, 29, 1, 1),
	   (530, 29, 1, 2),
	   (525, 29, 1, 3),
	   (528, 29, 1, 4),
	   (526, 29, 2, 1),
	   (533, 29, 2, 2),
	   (549, 29, 2, 4),
	   (535, 29, 3, 2),
	   (542, 29, 3, 3),
	   (541, 29, 3, 4),
	   (536, 29, 4, 1),
	   (544, 29, 4, 2),
	   (547, 29, 4, 3),
	   (531, 29, 4, 4),
	   (527, 29, 5, 3),
	   (548, 29, 6, 1),
	   (538, 29, 6, 2),
	   (537, 29, 6, 3),
	   (532, 29, 6, 4),
	   (546, 29, 7, 1),
	   (543, 29, 7, 2),
	   (529, 29, 7, 3),
	   (545, 29, 7, 4),
	   (534, 29, 8, 2),
	   (539, 29, 8, 3),
	   (550, 29, 8, 4);
