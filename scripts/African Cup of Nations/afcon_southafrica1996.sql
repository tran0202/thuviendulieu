# Insert new tournament
# Replace all the tournament_id

# 1996 African Cup of Nations South Africa

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1996 African Cup of Nations South Africa', '1996-01-13', '1996-02-03', 14, 'afcon_1996.jpg', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (165, 41, 1, 39, 1),
	   (165, 43, 1, 40, 2),
	   (165, 44, 2, 40, 2),
	   (165, 45, 3, 40, 2),
	   (165, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Sierra Leone', 1, 167);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (205, 165, 1, 1),
	   (8, 165, 1, 2),
	   (194, 165, 1, 3),
	   (212, 165, 1, 4),
	   (984, 165, 2, 1),
	   (193, 165, 2, 2),
	   (998, 165, 2, 3),
	   (975, 165, 2, 4),
	   (976, 165, 3, 1),
	   (239, 165, 3, 2),
	   (997, 165, 3, 3),
	   (195, 165, 4, 1),
	   (12, 165, 4, 2),
	   (196, 165, 4, 3),
	   (993, 165, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (205, 3, 194, 0, 165, '1996-01-13', '190000', 1, 41, 39),
	   (984, 0, 193, 0, 165, '1996-01-14', '190000', 2, 41, 39),
	   (195, 2, 196, 0, 165, '1996-01-14', '190000', 3, 41, 39),
	   (8, 2, 212, 1, 165, '1996-01-15', '190000', 4, 41, 39),
	   (998, 2, 975, 1, 165, '1996-01-15', '190000', 5, 41, 39),
	   (976, 1, 997, 2, 165, '1996-01-16', '190000', 6, 41, 39),
	   (12, 1, 993, 1, 165, '1996-01-16', '190000', 7, 41, 39),
	   (194, 2, 8, 1, 165, '1996-01-18', '190000', 8, 41, 39),
	   (193, 2, 998, 0, 165, '1996-01-18', '190000', 9, 41, 39),
	   (976, 2, 239, 0, 165, '1996-01-19', '190000', 10, 41, 39),
	   (195, 2, 12, 1, 165, '1996-01-19', '190000', 11, 41, 39),
	   (205, 1, 212, 0, 165, '1996-01-20', '190000', 12, 41, 39),
	   (984, 5, 975, 1, 165, '1996-01-20', '190000', 13, 41, 39),
	   (196, 1, 993, 0, 165, '1996-01-21', '190000', 14, 41, 39),
	   (205, 0, 8, 1, 165, '1996-01-24', '190000', 15, 41, 39),
	   (212, 3, 194, 3, 165, '1996-01-24', '190000', 16, 41, 39),
	   (193, 2, 975, 1, 165, '1996-01-24', '190000', 17, 41, 39),
	   (984, 4, 998, 0, 165, '1996-01-24', '190000', 18, 41, 39),
	   (239, 2, 997, 0, 165, '1996-01-25', '190000', 19, 41, 39),
	   (12, 3, 196, 1, 165, '1996-01-25', '190000', 20, 41, 39),
	   (195, 2, 993, 0, 165, '1996-01-25', '190000', 21, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (205, 2, null, null, 193, 1, null, null, 165, '1996-01-27', '190000', 22, 43, 40, 22),
	   (984, 3, null, null, 8, 1, null, null, 165, '1996-01-27', '190000', 23, 43, 40, 24),
	   (976, 1, 0, 1, 12, 1, 0, 4, 165, '1996-01-28', '190000', 24, 43, 40, 25),
	   (195, 1, null, null, 239, 0, null, null, 165, '1996-01-28', '190000', 25, 43, 40, 23),
	   (205, 3, null, null, 195, 0, null, null, 165, '1996-01-31', '190000', 26, 44, 40, 26),
	   (984, 2, null, null, 12, 4, null, null, 165, '1996-01-31', '190000', 27, 44, 40, 27),
	   (195, 0, null, null, 984, 1, null, null, 165, '1996-02-03', '190000', 28, 45, 40, 29),
	   (205, 2, null, null, 12, 0, null, null, 165, '1996-02-03', '190000', 29, 46, 40, 28);

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
