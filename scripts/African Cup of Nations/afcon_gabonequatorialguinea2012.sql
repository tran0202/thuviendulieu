# Insert new tournament
# Replace all the tournament_id

# 2012 Africa Cup of Nations Gabon-Equatorial Guinea

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2012 Africa Cup of Nations Gabon-Equatorial Guinea', '2012-01-21', '2012-02-12', 14, 'afcon_2012.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (155, 41, 1, 39, 1),
	   (155, 43, 1, 40, 2),
	   (155, 44, 2, 40, 2),
	   (155, 45, 3, 40, 2),
	   (155, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Libya', 1, 112),
	   ('Sudan', 1, 180),
	   ('Botswana', 1, 27);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (984, 155, 1, 1),
	   (982, 155, 1, 2),
	   (988, 155, 1, 3),
	   (11, 155, 1, 4),
	   (196, 155, 2, 1),
	   (989, 155, 2, 2),
	   (212, 155, 2, 3),
	   (975, 155, 2, 4),
	   (976, 155, 3, 1),
	   (12, 155, 3, 2),
	   (9, 155, 3, 3),
	   (986, 155, 3, 4),
	   (195, 155, 4, 1),
	   (979, 155, 4, 2),
	   (985, 155, 4, 3),
	   (990, 155, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (982, 1, 988, 0, 155, '2012-01-21', '170000', 1, 41, 39),
	   (11, 1, 984, 2, 155, '2012-01-21', '200000', 2, 41, 39),
	   (196, 1, 989, 0, 155, '2012-01-22', '170000', 3, 41, 39),
	   (975, 1, 212, 2, 155, '2012-01-22', '200000', 4, 41, 39),
	   (976, 2, 986, 0, 155, '2012-01-23', '170000', 5, 41, 39),
	   (9, 1, 12, 2, 155, '2012-01-23', '200000', 6, 41, 39),
	   (195, 1, 990, 0, 155, '2012-01-24', '170000', 7, 41, 39),
	   (979, 1, 985, 0, 155, '2012-01-24', '200000', 8, 41, 39),
	   (988, 2, 984, 2, 155, '2012-01-25', '170000', 9, 41, 39),
	   (982, 2, 11, 1, 155, '2012-01-25', '200000', 10, 41, 39),
	   (989, 2, 212, 2, 155, '2012-01-26', '170000', 11, 41, 39),
	   (196, 2, 975, 0, 155, '2012-01-26', '200000', 12, 41, 39),
	   (986, 1, 12, 2, 155, '2012-01-27', '170000', 13, 41, 39),
	   (976, 3, 9, 2, 155, '2012-01-27', '200000', 14, 41, 39),
	   (990, 1, 985, 6, 155, '2012-01-28', '170000', 15, 41, 39),
	   (195, 2, 979, 0, 155, '2012-01-28', '200000', 16, 41, 39),
	   (982, 0, 984, 1, 155, '2012-01-29', '200000', 17, 41, 39),
	   (988, 2, 11, 1, 155, '2012-01-29', '200000', 18, 41, 39),
	   (989, 2, 975, 1, 155, '2012-01-30', '200000', 19, 41, 39),
	   (196, 2, 212, 0, 155, '2012-01-30', '200000', 20, 41, 39),
	   (976, 1, 12, 0, 155, '2012-01-31', '200000', 21, 41, 39),
	   (986, 0, 9, 1, 155, '2012-01-31', '200000', 22, 41, 39),
	   (990, 1, 979, 2, 155, '2012-02-01', '200000', 23, 41, 39),
	   (195, 1, 985, 1, 155, '2012-02-01', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (984, 3, null, null, 989, 0, null, null, 155, '2012-02-04', '170000', 25, 43, 40, 25),
	   (196, 3, null, null, 982, 0, null, null, 155, '2012-02-04', '200000', 26, 43, 40, 28),
	   (976, 1, 0, 4, 979, 1, 0, 5, 155, '2012-02-05', '170000', 27, 43, 40, 27),
	   (195, 1, 1, null, 12, 1, 0, null, 155, '2012-02-05', '200000', 28, 43, 40, 26),
	   (984, 1, null, null, 195, 0, null, null, 155, '2012-02-08', '170000', 29, 44, 40, 29),
	   (979, 0, null, null, 196, 1, null, null, 155, '2012-02-08', '200000', 30, 44, 40, 30),
	   (195, 0, null, null, 979, 1, null, null, 155, '2012-02-11', '200000', 31, 45, 40, 32),
	   (984, 0, 0, 8, 196, 0, 0, 7, 155, '2012-02-12', '203000', 32, 46, 40, 31);

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
