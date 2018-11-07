# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Paris 1924

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Paris 1924', '1924-05-25', '1924-06-09', 9, '1924.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (59, 60, 1, 40, 1),
	   (59, 47, 2, 40, 2),
	   (59, 59, 3, 40, 3),
	   (59, 43, 4, 40, 4),
	   (59, 44, 5, 40, 5),
	   (59, 132, 6, 40, 6),
	   (59, 137, 7, 40, 7),
	   (59, 133, 8, 40, 8);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Lithuania', 4, 114), ('Estonia', 4, 66), ('Latvia', 4, 108);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (1070, 59), (1072, 59), (916, 59), (931, 59),
	   (876, 59), (941, 59), (886, 59), (942, 59),
	   (873, 59), (1071, 59), (1074, 59), (905, 59),
	   (902, 59), (943, 59), (885, 59), (930, 59),
	   (940, 59), (928, 59), (936, 59), (842, 59),
	   (887, 59), (1075, 59);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1070, 1, null, null, 1072, 0, null, null, 59, '1924-05-25', '153000', 1, 60, 40, null),
	   (916, 5, null, null, 931, 2, null, null, 59, '1924-05-25', '153000', 2, 60, 40, null),
	   (876, 9, null, null, 941, 0, null, null, 59, '1924-05-25', '153000', 3, 60, 40, null),
	   (886, 1, null, null, 942, 0, null, null, 59, '1924-05-25', '171500', 4, 60, 40, null),
	   (873, 7, null, null, 1071, 0, null, null, 59, '1924-05-26', '160000', 5, 60, 40, null),
	   (1074, 5, null, null, 905, 0, null, null, 59, '1924-05-26', '170000', 6, 60, 40, null),
	   (902, 7, null, null, 943, 0, null, null, 59, '1924-05-27', '170000', 7, 47, 40, 8),
	   (885, 6, null, null, 930, 0, null, null, 59, '1924-05-27', '160000', 8, 47, 40, 9),
	   (876, 1, 0, null, 916, 1, 0, null, 59, '1924-05-28', '170000', 9, 47, 40, 11),
	   (940, 1, null, null, 928, 0, null, null, 59, '1924-05-28', '160000', 10, 47, 40, 10),
	   (1070, 2, null, null, 936, 0, null, null, 59, '1924-05-29', '141500', 11, 47, 40, 12),
	   (842, 8, null, null, 887, 1, null, null, 59, '1924-05-29', '160000', 12, 47, 40, 13),
	   (1075, 3, null, null, 1074, 0, null, null, 59, '1924-05-29', '170000', 13, 47, 40, 14),
	   (873, 3, null, null, 886, 0, null, null, 59, '1924-05-29', '170000', 14, 47, 40, 7),
	   (876, 1, null, null, 916, 0, null, null, 59, '1924-05-30', '170000', 15, 59, 40, null),
	   (902, 1, null, null, 873, 5, null, null, 59, '1924-06-01', '160000', 16, 43, 40, 16),
	   (842, 5, null, null, 1075, 0, null, null, 59, '1924-06-01', '160000', 17, 43, 40, 19),
	   (876, 2, null, null, 1070, 1, null, null, 59, '1924-06-02', '170000', 18, 43, 40, 18),
	   (885, 1, 1, null, 940, 1, 0, null, 59, '1924-06-02', '170000', 19, 43, 40, 17),
	   (876, 2, null, null, 842, 1, null, null, 59, '1924-06-05', '170000', 20, 44, 40, 21),
	   (873, 2, null, null, 885, 1, null, null, 59, '1924-06-06', '170000', 21, 44, 40, 20),
	   (842, 1, 0, null, 885, 1, 0, null, 59, '1924-06-08', '160000', 22, 132, 40, 24),
	   (842, 3, null, null, 885, 1, null, null, 59, '1924-06-09', '143000', 23, 137, 40, null),
	   (873, 3, null, null, 876, 0, null, null, 59, '1924-06-09', '163000', 24, 133, 40, 22);

CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	logo_filename VARCHAR(255),
	tournament_type_id INT,
	parent_tournament_id INT,
	points_for_win TINYINT UNSIGNED,
	golden_goal_rule TINYINT UNSIGNED,
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id),
	FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id)
);

CREATE TABLE IF NOT EXISTS team (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	nation_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id),
	FOREIGN KEY (nation_id) REFERENCES nation(id),
	FOREIGN KEY (parent_team_id) REFERENCES team(id),
	code VARCHAR(255),
	short_name VARCHAR(255),
	official_name VARCHAR(255)
);

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

CREATE TABLE IF NOT EXISTS `match` (
	id INT AUTO_INCREMENT PRIMARY KEY,
	home_team_id INT,
	home_team_score TINYINT UNSIGNED,
	away_team_id INT,
	away_team_score TINYINT UNSIGNED,
	home_team_first_leg_score TINYINT UNSIGNED,
	away_team_first_leg_score TINYINT UNSIGNED,
	tournament_id INT NOT NULL,
	match_date DATE,
	match_time TIME,
	match_order SMALLINT UNSIGNED,
	bracket_order TINYINT UNSIGNED,
	waiting_home_team VARCHAR(255),
	waiting_away_team VARCHAR(255),
	home_team_extra_time_score TINYINT UNSIGNED,
	away_team_extra_time_score TINYINT UNSIGNED,
	home_team_penalty_score TINYINT UNSIGNED,
	away_team_penalty_score TINYINT UNSIGNED,
	round_id INT,
	round_order TINYINT UNSIGNED,
	stage_id INT,
	stage_order TINYINT UNSIGNED,
	group_id INT,
	home_retired TINYINT UNSIGNED,
	away_retired TINYINT UNSIGNED,
	home_set1_score TINYINT UNSIGNED,
	away_set1_score TINYINT UNSIGNED,
	home_set1_tiebreak TINYINT UNSIGNED,
	away_set1_tiebreak TINYINT UNSIGNED,
	home_set2_score TINYINT UNSIGNED,
	away_set2_score TINYINT UNSIGNED,
	home_set2_tiebreak TINYINT UNSIGNED,
	away_set2_tiebreak TINYINT UNSIGNED,
	home_set3_score TINYINT UNSIGNED,
	away_set3_score TINYINT UNSIGNED,
	home_set3_tiebreak TINYINT UNSIGNED,
	away_set3_tiebreak TINYINT UNSIGNED,
	home_set4_score TINYINT UNSIGNED,
	away_set4_score TINYINT UNSIGNED,
	home_set4_tiebreak TINYINT UNSIGNED,
	away_set4_tiebreak TINYINT UNSIGNED,
	home_set5_score TINYINT UNSIGNED,
	away_set5_score TINYINT UNSIGNED,
	home_set5_tiebreak TINYINT UNSIGNED,
	away_set5_tiebreak TINYINT UNSIGNED,
	FOREIGN KEY (home_team_id) REFERENCES team(id),
	FOREIGN KEY (away_team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (round_id) REFERENCES `group`(id),
	FOREIGN KEY (stage_id) REFERENCES `group`(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id)
);

CREATE TABLE IF NOT EXISTS group_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id)
);
