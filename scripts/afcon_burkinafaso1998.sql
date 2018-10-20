# Insert new tournament
# Replace all the tournament_id

# 1998 African Cup of Nations Burkina Faso

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1998 African Cup of Nations Burkina Faso', '1998-02-07', '1998-02-28', 14, 'afcon_1998.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (164, 41, 1, 39, 1),
	   (164, 43, 1, 40, 1),
	   (164, 44, 2, 40, 2),
	   (164, 45, 3, 40, 3),
	   (164, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Liberia', 1, 111);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (194, 164, 1, 1),
	   (975, 164, 1, 2),
	   (985, 164, 1, 3),
	   (193, 164, 1, 4),
	   (12, 164, 2, 1),
	   (241, 164, 2, 2),
	   (195, 164, 2, 3),
	   (214, 164, 2, 4),
	   (196, 164, 3, 1),
	   (205, 164, 3, 2),
	   (212, 164, 3, 3),
	   (994, 164, 3, 4),
	   (9, 164, 4, 1),
	   (8, 164, 4, 2),
	   (984, 164, 4, 3),
	   (993, 164, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (975, 0, 194, 1, 164, '1998-02-07', '160000', 1, 41, 39),
	   (193, 0, 985, 1, 164, '1998-02-08', '203000', 2, 41, 39),
	   (205, 0, 212, 0, 164, '1998-02-08', '150000', 3, 41, 39),
	   (196, 4, 994, 3, 164, '1998-02-08', '180000', 4, 41, 39),
	   (241, 2, 214, 1, 164, '1998-02-09', '160000', 5, 41, 39),
	   (195, 2, 12, 0, 164, '1998-02-09', '203000', 6, 41, 39),
	   (9, 1, 984, 1, 164, '1998-02-09', '181500', 7, 41, 39),
	   (8, 2, 993, 0, 164, '1998-02-10', '180000', 8, 41, 39),
	   (194, 2, 985, 2, 164, '1998-02-11', '150000', 9, 41, 39),
	   (975, 2, 193, 1, 164, '1998-02-11', '200000', 10, 41, 39),
	   (196, 1, 205, 1, 164, '1998-02-11', '171500', 11, 41, 39),
	   (12, 2, 241, 1, 164, '1998-02-12', '160000', 12, 41, 39),
	   (214, 2, 195, 1, 164, '1998-02-12', '203000', 13, 41, 39),
	   (212, 3, 994, 3, 164, '1998-02-12', '181500', 14, 41, 39),
	   (8, 4, 984, 0, 164, '1998-02-13', '170000', 15, 41, 39),
	   (9, 3, 993, 0, 164, '1998-02-13', '200000', 16, 41, 39),
	   (975, 1, 985, 0, 164, '1998-02-15', '160000', 17, 41, 39),
	   (194, 2, 193, 1, 164, '1998-02-15', '160000', 18, 41, 39),
	   (241, 1, 195, 0, 164, '1998-02-16', '170000', 19, 41, 39),
	   (12, 3, 214, 1, 164, '1998-02-16', '170000', 20, 41, 39),
	   (196, 5, 212, 2, 164, '1998-02-16', '200000', 21, 41, 39),
	   (205, 4, 994, 1, 164, '1998-02-16', '200000', 22, 41, 39),
	   (984, 3, 993, 1, 164, '1998-02-17', '160000', 23, 41, 39),
	   (9, 1, 8, 0, 164, '1998-02-17', '160000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (194, 0, null, null, 241, 1, null, null, 164, '1998-02-20', '160000', 25, 43, 40, 25),
	   (12, 1, 0, 7, 975, 1, 0, 8, 164, '1998-02-21', '170000', 26, 43, 40, 27),
	   (196, 0, 0, 4, 8, 0, 0, 5, 164, '1998-02-21', '200000', 27, 43, 40, 28),
	   (9, 1, null, null, 205, 2, null, null, 164, '1998-02-22', '160000', 28, 43, 40, 26),
	   (241, 1, 0, null, 205, 1, 1, null, 164, '1998-02-25', '160000', 29, 44, 40, 29),
	   (975, 0, null, null, 8, 2, null, null, 164, '1998-02-25', '200000', 30, 44, 40, 30),
	   (241, 4, 0, 4, 975, 4, 0, 1, 164, '1998-02-27', '160000', 31, 45, 40, 32),
	   (205, 0, null, null, 8, 2, null, null, 164, '1998-02-27', '160000', 32, 46, 40, 31);

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
