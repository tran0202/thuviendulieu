# Insert new tournament
# Replace all the tournament_id

# 2000 African Cup of Nations Ghana-Nigeria

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2000 African Cup of Nations Ghana-Nigeria', '2000-01-22', '2000-02-13', 14, 'afcon_2000.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (162, 41, 1, 39, 1),
	   (162, 43, 1, 40, 1),
	   (162, 44, 2, 40, 2),
	   (162, 45, 3, 40, 3),
	   (162, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Liberia', 1, 111);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (194, 162, 1, 1),
	   (195, 162, 1, 2),
	   (196, 162, 1, 3),
	   (214, 162, 1, 4),
	   (205, 162, 2, 1),
	   (193, 162, 2, 2),
	   (1106, 162, 2, 3),
	   (976, 162, 2, 4),
	   (8, 162, 3, 1),
	   (11, 162, 3, 2),
	   (984, 162, 3, 3),
	   (975, 162, 3, 4),
	   (10, 162, 4, 1),
	   (12, 162, 4, 2),
	   (9, 162, 4, 3),
	   (981, 162, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (195, 1, 194, 1, 162, '2000-01-22', '160000', 1, 41, 39),
	   (205, 3, 976, 1, 162, '2000-01-23', '194500', 2, 41, 39),
	   (8, 2, 984, 0, 162, '2000-01-23', '183000', 3, 41, 39),
	   (10, 4, 12, 2, 162, '2000-01-23', '160000', 4, 41, 39),
	   (196, 1, 214, 1, 162, '2000-01-24', '160000', 5, 41, 39),
	   (1106, 0, 193, 0, 162, '2000-01-24', '194500', 6, 41, 39),
	   (975, 1, 11, 3, 162, '2000-01-25', '170000', 7, 41, 39),
	   (9, 1, 981, 0, 162, '2000-01-25', '193000', 8, 41, 39),
	   (195, 2, 214, 0, 162, '2000-01-27', '160000', 9, 41, 39),
	   (205, 1, 1106, 0, 162, '2000-01-27', '194500', 10, 41, 39),
	   (194, 3, 196, 0, 162, '2000-01-28', '194500', 11, 41, 39),
	   (8, 1, 11, 0, 162, '2000-01-28', '183000', 12, 41, 39),
	   (10, 0, 981, 0, 162, '2000-01-28', '160000', 13, 41, 39),
	   (193, 3, 976, 1, 162, '2000-01-29', '194500', 14, 41, 39),
	   (984, 1, 975, 1, 162, '2000-01-29', '183000', 15, 41, 39),
	   (12, 0, 9, 0, 162, '2000-01-29', '160000', 16, 41, 39),
	   (195, 0, 196, 2, 162, '2000-01-31', '160000', 17, 41, 39),
	   (194, 0, 214, 1, 162, '2000-01-31', '160000', 18, 41, 39),
	   (205, 1, 193, 1, 162, '2000-02-02', '160000', 19, 41, 39),
	   (1106, 0, 976, 0, 162, '2000-02-02', '160000', 20, 41, 39),
	   (8, 4, 975, 2, 162, '2000-02-02', '170000', 21, 41, 39),
	   (984, 2, 11, 2, 162, '2000-02-02', '170000', 22, 41, 39),
	   (10, 2, 9, 0, 162, '2000-02-03', '170000', 23, 41, 39),
	   (12, 1, 981, 0, 162, '2000-02-03', '170000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (194, 2, null, null, 193, 1, null, null, 162, '2000-02-06', '160000', 25, 43, 40, 25),
	   (205, 1, null, null, 195, 0, null, null, 162, '2000-02-06', '193000', 26, 43, 40, 27),
	   (8, 0, null, null, 12, 1, null, null, 162, '2000-02-07', '160000', 27, 43, 40, 26),
	   (10, 1, 1, null, 11, 1, 0, null, 162, '2000-02-07', '190000', 28, 43, 40, 28),
	   (10, 2, null, null, 205, 0, null, null, 162, '2000-02-10', '163000', 29, 44, 40, 30),
	   (194, 3, null, null, 12, 0, null, null, 162, '2000-02-10', '183000', 30, 44, 40, 29),
	   (205, 2, 0, 4, 12, 2, 0, 3, 162, '2000-02-12', '160000', 31, 45, 40, 32),
	   (10, 2, 0, 3, 194, 2, 0, 4, 162, '2000-02-13', '160000', 32, 46, 40, 31);

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
