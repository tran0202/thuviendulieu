# Insert new tournament
# Replace all the tournament_id

# 2015 AFC Asian Cup Australia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2015 AFC Asian Cup Australia', '2015-01-09', '2015-01-31', 15, 'aac_2015.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (185, 41, 1, 39, 1),
	   (185, 43, 1, 40, 2),
	   (185, 44, 2, 40, 2),
	   (185, 45, 3, 40, 2),
	   (185, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Oman', 1, 143, null),
	   ('Uzbekistan', 1, 204, null),
	   ('Bahrain', 1, 16, null),
	   ('Qatar', 1, 154, null),
	   ('Jordan', 1, 99, null),
	   ('Palestine', 1, 145, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (16, 185, 1, 1),
	   (13, 185, 1, 2),
	   (1008, 185, 1, 3),
	   (237, 185, 1, 4),
	   (219, 185, 2, 1),
	   (1009, 185, 2, 2),
	   (17, 185, 2, 3),
	   (210, 185, 2, 4),
	   (14, 185, 3, 1),
	   (229, 185, 3, 2),
	   (1010, 185, 3, 3),
	   (1011, 185, 3, 4),
	   (15, 185, 4, 1),
	   (1064, 185, 4, 2),
	   (1012, 185, 4, 3),
	   (1013, 185, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (13, 4, 237, 1, 185, '2015-01-09', '200000', 1, 41, 39),
	   (16, 1, 1008, 0, 185, '2015-01-10', '200000', 2, 41, 39),
	   (1009, 1, 210, 0, 185, '2015-01-10', '200000', 3, 41, 39),
	   (17, 0, 219, 1, 185, '2015-01-10', '200000', 4, 41, 39),
	   (229, 4, 1011, 1, 185, '2015-01-11', '200000', 5, 41, 39),
	   (14, 2, 1010, 0, 185, '2015-01-11', '200000', 6, 41, 39),
	   (15, 4, 1013, 0, 185, '2015-01-12', '200000', 7, 41, 39),
	   (1012, 0, 1064, 1, 185, '2015-01-12', '200000', 8, 41, 39),
	   (237, 0, 16, 1, 185, '2015-01-13', '200000', 9, 41, 39),
	   (1008, 0, 13, 4, 185, '2015-01-13', '200000', 10, 41, 39),
	   (210, 1, 17, 4, 185, '2015-01-14', '200000', 11, 41, 39),
	   (219, 2, 1009, 1, 185, '2015-01-14', '200000', 12, 41, 39),
	   (1010, 1, 229, 2, 185, '2015-01-15', '200000', 13, 41, 39),
	   (1011, 0, 14, 1, 185, '2015-01-15', '200000', 14, 41, 39),
	   (1013, 1, 1012, 5, 185, '2015-01-16', '200000', 15, 41, 39),
	   (1064, 0, 15, 1, 185, '2015-01-16', '200000', 16, 41, 39),
	   (13, 0, 16, 1, 185, '2015-01-17', '200000', 17, 41, 39),
	   (1008, 1, 237, 0, 185, '2015-01-17', '200000', 18, 41, 39),
	   (1009, 3, 17, 1, 185, '2015-01-18', '200000', 19, 41, 39),
	   (219, 2, 210, 1, 185, '2015-01-18', '200000', 20, 41, 39),
	   (14, 1, 229, 0, 185, '2015-01-19', '200000', 21, 41, 39),
	   (1011, 1, 1010, 2, 185, '2015-01-19', '200000', 22, 41, 39),
	   (15, 2, 1012, 0, 185, '2015-01-20', '200000', 23, 41, 39),
	   (1064, 2, 1013, 0, 185, '2015-01-20', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (16, 0, 2, null, 1009, 0, 0, null, 185, '2015-01-22', '183000', 25, 43, 40, 25),
	   (219, 0, null, null, 13, 2, null, null, 185, '2015-01-22', '203000', 26, 43, 40, 27),
	   (14, 1, 2, 6, 1064, 1, 2, 7, 185, '2015-01-23', '173000', 27, 43, 40, 26),
	   (15, 1, 0, 4, 229, 1, 0, 5, 185, '2015-01-23', '203000', 28, 43, 40, 28),
	   (16, 2, null, null, 1064, 0, null, null, 185, '2015-01-26', '200000', 29, 44, 40, 29),
	   (13, 2, null, null, 229, 0, null, null, 185, '2015-01-27', '200000', 30, 44, 40, 30),
	   (1064, 2, null, null, 229, 3, null, null, 185, '2015-01-30', '200000', 31, 45, 40, 32),
	   (16, 1, 0, null, 13, 1, 1, null, 185, '2015-01-31', '200000', 32, 46, 40, 31);

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
