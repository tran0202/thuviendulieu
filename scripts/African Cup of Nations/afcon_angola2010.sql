# Insert new tournament
# Replace all the tournament_id

# 2010 Africa Cup of Nations Angola

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2010 Africa Cup of Nations Angola', '2010-01-10', '2010-01-31', 14, 'afcon_2010.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (156, 41, 1, 39, 1),
	   (156, 43, 1, 40, 2),
	   (156, 44, 2, 40, 2),
	   (156, 45, 3, 40, 2),
	   (156, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Malawi', 1, 118),
	   ('Benin', 1, 22),
	   ('Mozambique', 1, 131);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (212, 156, 1, 1),
	   (193, 156, 1, 2),
	   (979, 156, 1, 3),
	   (991, 156, 1, 4),
	   (196, 156, 2, 1),
	   (195, 156, 2, 2),
	   (975, 156, 2, 3),
	   (214, 156, 2, 4),
	   (8, 156, 3, 1),
	   (10, 156, 3, 2),
	   (992, 156, 3, 3),
	   (993, 156, 3, 4),
	   (984, 156, 4, 1),
	   (194, 156, 4, 2),
	   (976, 156, 4, 3),
	   (12, 156, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (212, 4, 979, 4, 156, '2010-01-10', '200000', 1, 41, 39),
	   (991, 3, 193, 0, 156, '2010-01-11', '144500', 2, 41, 39),
	   (196, 0, 975, 0, 156, '2010-01-11', '170000', 3, 41, 39),
	   (195, null, 214, null, 156, '2010-01-11', '193000', 4, 41, 39),
	   (8, 3, 10, 1, 156, '2010-01-12', '170000', 5, 41, 39),
	   (993, 2, 992, 2, 156, '2010-01-12', '193000', 6, 41, 39),
	   (194, 0, 976, 1, 156, '2010-01-13', '170000', 7, 41, 39),
	   (984, 1, 12, 1, 156, '2010-01-13', '193000', 8, 41, 39),
	   (979, 0, 193, 1, 156, '2010-01-14', '170000', 9, 41, 39),
	   (212, 2, 991, 0, 156, '2010-01-14', '193000', 10, 41, 39),
	   (975, null, 214, null, 156, '2010-01-15', '170000', 11, 41, 39),
	   (196, 3, 195, 1, 156, '2010-01-15', '193000', 12, 41, 39),
	   (10, 1, 992, 0, 156, '2010-01-16', '170000', 13, 41, 39),
	   (8, 2, 993, 0, 156, '2010-01-16', '193000', 14, 41, 39),
	   (976, 0, 12, 0, 156, '2010-01-17', '170000', 15, 41, 39),
	   (194, 3, 984, 2, 156, '2010-01-17', '193000', 16, 41, 39),
	   (212, 0, 193, 0, 156, '2010-01-18', '170000', 17, 41, 39),
	   (979, 3, 991, 1, 156, '2010-01-18', '170000', 18, 41, 39),
	   (975, 0, 195, 1, 156, '2010-01-19', '170000', 19, 41, 39),
	   (196, null, 214, null, 156, '2010-01-19', '170000', 20, 41, 39),
	   (8, 2, 992, 0, 156, '2010-01-20', '170000', 21, 41, 39),
	   (10, 3, 993, 0, 156, '2010-01-20', '170000', 22, 41, 39),
	   (976, 1, 984, 2, 156, '2010-01-21', '170000', 23, 41, 39),
	   (194, 2, 12, 2, 156, '2010-01-21', '170000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (212, 0, null, null, 195, 1, null, null, 156, '2010-01-24', '170000', 25, 43, 40, 25),
	   (196, 2, 0, null, 193, 2, 1, null, 156, '2010-01-24', '203000', 26, 43, 40, 27),
	   (8, 1, 2, null, 194, 1, 0, null, 156, '2010-01-25', '170000', 27, 43, 40, 28),
	   (984, 0, 0, 4, 10, 0, 0, 5, 156, '2010-01-25', '203000', 28, 43, 40, 26),
	   (195, 1, null, null, 10, 0, null, null, 156, '2010-01-28', '160000', 29, 44, 40, 29),
	   (193, 0, null, null, 8, 4, null, null, 156, '2010-01-28', '203000', 30, 44, 40, 30),
	   (10, 1, null, null, 193, 0, null, null, 156, '2010-01-30', '170000', 31, 45, 40, 32),
	   (195, 0, null, null, 8, 1, null, null, 156, '2010-01-31', '170000', 32, 46, 40, 31);

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
