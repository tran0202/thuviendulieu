# Insert new tournament
# Replace all the tournament_id

# 2015 Africa Cup of Nations Equatorial Guinea

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2015 Africa Cup of Nations Equatorial Guinea', '2015-01-17', '2015-02-08', 14, 'afcon_2015.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (153, 41, 1, 39, 1),
	   (153, 43, 1, 40, 2),
	   (153, 44, 2, 40, 2),
	   (153, 45, 3, 40, 2),
	   (153, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Congo', 1, 46),
	   ('Equatorial Guinea', 1, 64),
	   ('Cape Verde Islands', 1, 37),
	   ('Zambia', 1, 210),
	   ('Guinea', 1, 83);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (981, 153, 1, 1),
	   (982, 153, 1, 2),
	   (976, 153, 1, 3),
	   (975, 153, 1, 4),
	   (12, 153, 2, 1),
	   (241, 153, 2, 2),
	   (983, 153, 2, 3),
	   (984, 153, 2, 4),
	   (195, 153, 3, 1),
	   (193, 153, 3, 2),
	   (11, 153, 3, 3),
	   (205, 153, 3, 4),
	   (196, 153, 4, 1),
	   (985, 153, 4, 2),
	   (979, 153, 4, 3),
	   (194, 153, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (982, 1, 981, 1, 153, '2015-01-17', '170000', 1, 41, 39),
	   (975, 0, 976, 2, 153, '2015-01-17', '200000', 2, 41, 39),
	   (984, 1, 241, 1, 153, '2015-01-18', '170000', 3, 41, 39),
	   (12, 1, 983, 1, 153, '2015-01-18', '200000', 4, 41, 39),
	   (195, 1, 11, 2, 153, '2015-01-19', '170000', 5, 41, 39),
	   (193, 3, 205, 1, 153, '2015-01-19', '200000', 6, 41, 39),
	   (196, 1, 985, 1, 153, '2015-01-20', '170000', 7, 41, 39),
	   (979, 1, 194, 1, 153, '2015-01-20', '200000', 8, 41, 39),
	   (982, 0, 975, 0, 153, '2015-01-21', '170000', 9, 41, 39),
	   (976, 0, 981, 1, 153, '2015-01-21', '200000', 10, 41, 39),
	   (984, 1, 12, 2, 153, '2015-01-22', '170000', 11, 41, 39),
	   (983, 0, 241, 0, 153, '2015-01-22', '200000', 12, 41, 39),
	   (195, 1, 193, 0, 153, '2015-01-23', '170000', 13, 41, 39),
	   (205, 1, 11, 1, 153, '2015-01-23', '200000', 14, 41, 39),
	   (196, 1, 979, 1, 153, '2015-01-24', '170000', 15, 41, 39),
	   (194, 1, 985, 1, 153, '2015-01-24', '200000', 16, 41, 39),
	   (976, 0, 982, 2, 153, '2015-01-25', '200000', 17, 41, 39),
	   (981, 2, 975, 1, 153, '2015-01-25', '200000', 18, 41, 39),
	   (983, 0, 984, 0, 153, '2015-01-26', '200000', 19, 41, 39),
	   (241, 1, 12, 1, 153, '2015-01-26', '200000', 20, 41, 39),
	   (205, 1, 195, 2, 153, '2015-01-27', '200000', 21, 41, 39),
	   (11, 0, 193, 2, 153, '2015-01-27', '200000', 22, 41, 39),
	   (194, 0, 196, 1, 153, '2015-01-28', '200000', 23, 41, 39),
	   (985, 1, 979, 1, 153, '2015-01-28', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (981, 2, null, null, 241, 4, null, null, 153, '2015-01-31', '170000', 25, 43, 40, 25),
	   (12, 1, 0, null, 982, 1, 1, null, 153, '2015-01-31', '203000', 26, 43, 40, 28),
	   (195, 3, null, null, 985, 0, null, null, 153, '2015-02-01', '170000', 27, 43, 40, 27),
	   (196, 3, null, null, 193, 1, null, null, 153, '2015-02-01', '203000', 28, 43, 40, 26),
	   (241, 1, null, null, 196, 3, null, null, 153, '2015-02-04', '200000', 29, 44, 40, 29),
	   (195, 3, null, null, 982, 0, null, null, 153, '2015-02-05', '200000', 30, 44, 40, 30),
	   (241, 0, null, 4, 982, 0, null, 2, 153, '2015-02-07', '170000', 31, 45, 40, 32),
	   (196, 0, 0, 9, 195, 0, 0, 8, 153, '2015-02-08', '200000', 32, 46, 40, 31);

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
