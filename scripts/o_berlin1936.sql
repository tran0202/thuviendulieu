# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Berlin 1936

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Berlin 1936', '1936-08-03', '1936-08-15', 9, '1936.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (57, 47, 1, 40, 1),
	   (57, 43, 2, 40, 2),
	   (57, 44, 3, 40, 3),
	   (57, 132, 4, 40, 4),
	   (57, 133, 5, 40, 5);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Afghanistan', 4, 1), ('Republic of Ireland', 4, 155);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (1070, 57), (886, 57), (912, 57), (931, 57),
	   (841, 57), (842, 57), (1076, 57), (936, 57),
	   (905, 57), (1074, 57), (937, 57), (1075, 57),
	   (933, 57), (919, 57), (871, 57), (932, 57);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1070, 1, null, null, 886, 0, null, null, 57, '1936-08-03', '173000', 1, 47, 40, 1),
	   (912, 4, null, null, 931, 0, null, null, 57, '1936-08-03', '173000', 2, 47, 40, 3),
	   (841, 3, null, null, 842, 2, null, null, 57, '1936-08-04', '173000', 3, 47, 40, 2),
	   (1076, 2, null, null, 936, 1, null, null, 57, '1936-08-04', '173000', 4, 47, 40, 4),
	   (905, 3, null, null, 1074, 0, null, null, 57, '1936-08-05', '173000', 5, 47, 40, 7),
	   (937, 3, null, null, 1075, 1, null, null, 57, '1936-08-05', '173000', 6, 47, 40, 5),
	   (933, 7, null, null, 919, 3, null, null, 57, '1936-08-06', '173000', 7, 47, 40, 6),
	   (871, 2, null, null, 932, 0, null, null, 57, '1936-08-06', '173000', 8, 47, 40, 8),
	   (1070, 8, null, null, 841, 0, null, null, 57, '1936-08-07', '173000', 9, 43, 40, 9),
	   (1076, 0, null, null, 912, 2, null, null, 57, '1936-08-07', '173000', 10, 43, 40, 10),
	   (905, 5, null, null, 871, 4, null, null, 57, '1936-08-08', '173000', 11, 43, 40, 12),
	   (933, 2, 2, null, 937, 2, 0, null, 57, '1936-08-08', '173000', 12, 43, 40, 11),
	   (1070, 1, 1, null, 912, 1, 0, null, 57, '1936-08-10', '170000', 13, 44, 40, 13),
	   (937, 3, null, null, 905, 1, null, null, 57, '1936-08-11', '170000', 14, 44, 40, 14),
	   (912, 3, null, null, 905, 2, null, null, 57, '1936-08-13', '160000', 15, 132, 40, 16),
	   (1070, 1, 1, null, 937, 1, 0, null, 57, '1936-08-15', '160000', 16, 133, 40, 15);

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
