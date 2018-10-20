# Insert new tournament
# Replace all the tournament_id

# 2002 African Cup of Nations Mali

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2002 African Cup of Nations Mali', '2002-01-19', '2002-02-10', 14, 'afcon_2002.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (160, 41, 1, 39, 1),
	   (160, 43, 1, 40, 1),
	   (160, 44, 2, 40, 2),
	   (160, 45, 3, 40, 3),
	   (160, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Liberia', 1, 111);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (10, 160, 1, 1),
	   (979, 160, 1, 2),
	   (997, 160, 1, 3),
	   (193, 160, 1, 4),
	   (205, 160, 2, 1),
	   (195, 160, 2, 2),
	   (9, 160, 2, 3),
	   (975, 160, 2, 4),
	   (194, 160, 3, 1),
	   (241, 160, 3, 2),
	   (214, 160, 3, 3),
	   (196, 160, 3, 4),
	   (11, 160, 4, 1),
	   (8, 160, 4, 2),
	   (12, 160, 4, 3),
	   (984, 160, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (979, 1, 997, 1, 160, '2002-01-19', '160000', 1, 41, 39),
	   (205, 0, 975, 0, 160, '2002-01-20', '193000', 2, 41, 39),
	   (194, 1, 241, 0, 160, '2002-01-20', '173000', 3, 41, 39),
	   (8, 0, 11, 1, 160, '2002-01-20', '153000', 4, 41, 39),
	   (193, 0, 10, 1, 160, '2002-01-21', '160000', 5, 41, 39),
	   (9, 0, 195, 0, 160, '2002-01-21', '160000', 6, 41, 39),
	   (214, 0, 196, 0, 160, '2002-01-21', '180000', 7, 41, 39),
	   (984, 0, 12, 0, 160, '2002-01-21', '190000', 8, 41, 39),
	   (979, 0, 10, 0, 160, '2002-01-24', '190000', 9, 41, 39),
	   (205, 0, 195, 0, 160, '2002-01-24', '160000', 10, 41, 39),
	   (997, 2, 193, 2, 160, '2002-01-25', '193000', 11, 41, 39),
	   (194, 1, 196, 0, 160, '2002-01-25', '173000', 12, 41, 39),
	   (8, 1, 12, 0, 160, '2002-01-25', '153000', 13, 41, 39),
	   (975, 1, 9, 2, 160, '2002-01-26', '153000', 14, 41, 39),
	   (241, 0, 214, 0, 160, '2002-01-26', '173000', 15, 41, 39),
	   (11, 1, 984, 0, 160, '2002-01-26', '193000', 16, 41, 39),
	   (979, 2, 193, 0, 160, '2002-01-28', '180000', 17, 41, 39),
	   (997, 0, 10, 1, 160, '2002-01-28', '180000', 18, 41, 39),
	   (194, 3, 214, 0, 160, '2002-01-29', '160000', 19, 41, 39),
	   (241, 3, 196, 1, 160, '2002-01-29', '160000', 20, 41, 39),
	   (205, 3, 9, 1, 160, '2002-01-30', '160000', 21, 41, 39),
	   (975, 1, 195, 2, 160, '2002-01-30', '160000', 22, 41, 39),
	   (8, 2, 984, 1, 160, '2002-01-31', '160000', 23, 41, 39),
	   (11, 0, 12, 0, 160, '2002-01-31', '160000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (205, 0, null, null, 979, 2, null, null, 160, '2002-02-03', '160000', 25, 43, 40, 27),
	   (10, 1, null, null, 195, 0, null, null, 160, '2002-02-03', '190000', 26, 43, 40, 25),
	   (194, 1, null, null, 8, 0, null, null, 160, '2002-02-04', '160000', 27, 43, 40, 28),
	   (11, 2, null, null, 241, 0, null, null, 160, '2002-02-04', '190000', 28, 43, 40, 26),
	   (10, 1, 0, null, 11, 1, 1, null, 160, '2002-02-07', '160000', 29, 44, 40, 29),
	   (979, 0, null, null, 194, 3, null, null, 160, '2002-02-07', '190000', 30, 44, 40, 30),
	   (10, 1, null, null, 979, 0, null, null, 160, '2002-02-09', '160000', 31, 45, 40, 32),
	   (11, 0, 0, 2, 194, 0, 0, 3, 160, '2002-02-10', '190000', 32, 46, 40, 31);

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
