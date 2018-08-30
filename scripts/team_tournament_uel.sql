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

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (732, 30), (748, 30), (656, 30), (734, 30),
	   (724, 30), (691, 30), (754, 30), (707, 30),
	   (680, 30), (759, 30),
	   (684, 30), (634, 30), (723, 30), (755, 30),
	   (756, 30), (710, 30), (662, 30), (657, 30),
	   (731, 30), (719, 30), (712, 30),
	   (701, 30), (631, 30), (706, 30), (674, 30),
	   (694, 30), (750, 30), (761, 30),
	   (655, 30), (699, 30), (703, 30), (679, 30),
	   (682, 30), (722, 30), (693, 30), (739, 30),
	   (708, 30), (688, 30), (714, 30), (740, 30),
	   (677, 30), (633, 30), (649, 30), (702, 30),
	   (720, 30), (718, 30), (665, 30), (735, 30),
	   (667, 30), (669, 30), (715, 30), (752, 30),
	   (746, 30), (622, 30), (666, 30), (727, 30),
	   (692, 30), (639, 30), (697, 30),
	   (685, 30), (760, 30), (747, 30),
	   (725, 30), (757, 30), (738, 30), (672, 30),
	   (736, 30), (648, 30), (730, 30), (636, 30),
	   (660, 30), (642, 30), (690, 30), (717, 30),
	   (705, 30), (683, 30), (663, 30), (716, 30),
	   (742, 30), (664, 30), (726, 30),
	   (673, 30), (670, 30), (745, 30), (698, 30);
