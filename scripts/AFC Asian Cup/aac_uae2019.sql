# Insert new tournament
# Replace all the tournament_id

# 2019 AFC Asian Cup United Arab Emirates

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, head_to_head_tiebreaker, third_place_ranking, golden_goal_rule, points_for_win)
VALUES ('2019 AFC Asian Cup United Arab Emirates', '2019-01-05', '2019-02-01', 15, 'aac_2019.png', 1, 1, null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (221, 41, 1, 39, 1),
	   (221, 42, 1, 40, 2),
	   (221, 43, 2, 40, 2),
	   (221, 44, 3, 40, 2),
	   (221, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Kyrgyzstan', 1, 106, null),
	('Philippines', 1, 150, null),
	   ('Yemen', 1, 209, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (229, 221, 1, 1),
	   (1022, 221, 1, 2),
	   (1021, 221, 1, 3),
	   (1010, 221, 1, 4),
	   (13, 221, 2, 1),
	   (1020, 221, 2, 2),
	   (1013, 221, 2, 3),
	   (1012, 221, 2, 4),
	   (16, 221, 3, 1),
	   (219, 221, 3, 2),
	   (1114, 221, 3, 3),
	   (1115, 221, 3, 4),
	   (14, 221, 4, 1),
	   (1064, 221, 4, 2),
	   (1000, 221, 4, 3),
	   (1116, 221, 4, 4),
	   (17, 221, 5, 1),
	   (1011, 221, 5, 2),
	   (1025, 221, 5, 3),
	   (210, 221, 5, 4),
	   (15, 221, 6, 1),
	   (1009, 221, 6, 2),
	   (1008, 221, 6, 3),
	   (1024, 221, 6, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (229, null, 1010, null, 221, '2019-01-05', '200000', 1, 41, 39),
	   (13, null, 1012, null, 221, '2019-01-06', '150000', 2, 41, 39),
	   (1022, null, 1021, null, 221, '2019-01-06', '173000', 3, 41, 39),
	   (1020, null, 1013, null, 221, '2019-01-06', '200000', 4, 41, 39),
	   (219, null, 1114, null, 221, '2019-01-07', '150000', 5, 41, 39),
	   (16, null, 1115, null, 221, '2019-01-07', '173000', 6, 41, 39),
	   (14, null, 1116, null, 221, '2019-01-07', '200000', 7, 41, 39),
	   (1064, null, 1000, null, 221, '2019-01-08', '173000', 8, 41, 39),
	   (17, null, 210, null, 221, '2019-01-08', '200000', 9, 41, 39),
	   (15, null, 1024, null, 221, '2019-01-09', '150000', 10, 41, 39),
	   (1009, null, 1008, null, 221, '2019-01-09', '173000', 11, 41, 39),
	   (1011, null, 1025, null, 221, '2019-01-09', '200000', 12, 41, 39),
	   (1010, null, 1022, null, 221, '2019-01-10', '150000', 13, 41, 39),
	   (1012, null, 1020, null, 221, '2019-01-10', '173000', 14, 41, 39),
	   (1021, null, 229, null, 221, '2019-01-10', '200000', 15, 41, 39),
	   (1013, null, 13, null, 221, '2019-01-11', '150000', 16, 41, 39),
	   (1115, null, 219, null, 221, '2019-01-11', '173000', 17, 41, 39),
	   (1114, null, 16, null, 221, '2019-01-11', '200000', 18, 41, 39),
	   (1000, null, 14, null, 221, '2019-01-12', '150000', 19, 41, 39),
	   (1116, null, 1064, null, 221, '2019-01-12', '173000', 20, 41, 39),
	   (1025, null, 17, null, 221, '2019-01-12', '200000', 21, 41, 39),
	   (210, null, 1011, null, 221, '2019-01-13', '150000', 22, 41, 39),
	   (1008, null, 15, null, 221, '2019-01-13', '173000', 23, 41, 39),
	   (1024, null, 1009, null, 221, '2019-01-13', '200000', 24, 41, 39),
	   (229, null, 1022, null, 221, '2019-01-14', '200000', 25, 41, 39),
	   (1021, null, 1010, null, 221, '2019-01-14', '200000', 26, 41, 39),
	   (13, null, 1020, null, 221, '2019-01-15', '173000', 27, 41, 39),
	   (1013, null, 1012, null, 221, '2019-01-15', '173000', 28, 41, 39),
	   (16, null, 219, null, 221, '2019-01-16', '173000', 29, 41, 39),
	   (1114, null, 1115, null, 221, '2019-01-16', '173000', 30, 41, 39),
	   (1000, null, 1116, null, 221, '2019-01-16', '200000', 31, 41, 39),
	   (14, null, 1064, null, 221, '2019-01-16', '200000', 32, 41, 39),
	   (1008, null, 1024, null, 221, '2019-01-17', '173000', 33, 41, 39),
	   (15, null, 1009, null, 221, '2019-01-17', '173000', 34, 41, 39),
	   (17, null, 1011, null, 221, '2019-01-17', '200000', 35, 41, 39),
	   (1025, null, 210, null, 221, '2019-01-17', '200000', 36, 41, 39);

INSERT INTO `match` (waiting_home_team, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 waiting_away_team, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES ('1B', null, null, null, '3A/C/D', null, null, null, 221, '2019-01-20', '150000', 37, 42, 40, 39),
	   ('2A', null, null, null, '2C', null, null, null, 221, '2019-01-20', '180000', 38, 42, 40, 37),
	   ('1D', null, null, null, '3B/E/F', null, null, null, 221, '2019-01-20', '210000', 39, 42, 40, 38),
	   ('1F', null, null, null, '2E', null, null, null, 221, '2019-01-21', '150000', 40, 42, 40, 40),
	   ('2B', null, null, null, '2F', null, null, null, 221, '2019-01-21', '180000', 41, 42, 40, 44),
	   ('1A', null, null, null, '3C/D/E', null, null, null, 221, '2019-01-21', '210000', 42, 42, 40, 43),
	   ('1C', null, null, null, '3A/B/F', null, null, null, 221, '2019-01-22', '170000', 43, 42, 40, 41),
	   ('1E', null, null, null, '2D', null, null, null, 221, '2019-01-22', '200000', 44, 42, 40, 42),
	   ('W37', null, null, null, 'W40', null, null, null, 221, '2019-01-24', '170000', 45, 43, 40, 46),
	   ('W38', null, null, null, 'W39', null, null, null, 221, '2019-01-24', '200000', 46, 43, 40, 45),
	   ('W43', null, null, null, 'W44', null, null, null, 221, '2019-01-25', '170000', 47, 43, 40, 47),
	   ('W42', null, null, null, 'W41', null, null, null, 221, '2019-01-25', '200000', 48, 43, 40, 48),
	   ('W46', null, null, null, 'W45', null, null, null, 221, '2019-01-28', '180000', 49, 44, 40, 49),
	   ('W47', null, null, null, 'W48', null, null, null, 221, '2019-01-29', '180000', 50, 44, 40, 50),
	   ('W49', null, null, null, 'W50', null, null, null, 221, '2019-02-01', '180000', 51, 46, 40, 51);

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
	head_to_head_tiebreaker TINYINT UNSIGNED,
	third_place_ranking TINYINT UNSIGNED,
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
