# Insert new tournament
# Replace all the tournament_id

# 2007 AFC Asian Cup Indonesia-Malaysia-Thailand-Vietnam

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2007 AFC Asian Cup Indonesia-Malaysia-Thailand-Vietnam', '2007-07-07', '2007-07-29', 15, 'aac_2007.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (187, 41, 1, 39, 1),
	   (187, 43, 1, 40, 1),
	   (187, 44, 2, 40, 2),
	   (187, 45, 3, 40, 3),
	   (187, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Thailand', 1, 189, null),
	   ('Malaysia', 1,119, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (235, 187, 1, 1),
	   (13, 187, 1, 2),
	   (1022, 187, 1, 3),
	   (1008, 187, 1, 4),
	   (15, 187, 2, 1),
	   (1000, 187, 2, 2),
	   (229, 187, 2, 3),
	   (1011, 187, 2, 4),
	   (14, 187, 3, 1),
	   (1009, 187, 3, 2),
	   (219, 187, 3, 3),
	   (1023, 187, 3, 4),
	   (17, 187, 4, 1),
	   (16, 187, 4, 2),
	   (245, 187, 4, 3),
	   (1010, 187, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1022, 1, 235, 1, 187, '2007-07-07', '193000', 1, 41, 39),
	   (13, 1, 1008, 1, 187, '2007-07-08', '171500', 2, 41, 39),
	   (1000, 2, 229, 0, 187, '2007-07-08', '193000', 3, 41, 39),
	   (15, 1, 1011, 1, 187, '2007-07-09', '171500', 4, 41, 39),
	   (1023, 1, 219, 5, 187, '2007-07-10', '203000', 5, 41, 39),
	   (245, 2, 1010, 1, 187, '2007-07-10', '171500', 6, 41, 39),
	   (14, 2, 1009, 1, 187, '2007-07-11', '181500', 7, 41, 39),
	   (16, 1, 17, 1, 187, '2007-07-11', '193000', 8, 41, 39),
	   (1008, 0, 1022, 2, 187, '2007-07-12', '171500', 9, 41, 39),
	   (1011, 1, 1000, 1, 187, '2007-07-12', '193000', 10, 41, 39),
	   (235, 3, 13, 1, 187, '2007-07-13', '171500', 11, 41, 39),
	   (229, 1, 15, 3, 187, '2007-07-13', '203000', 12, 41, 39),
	   (1009, 5, 1023, 0, 187, '2007-07-14', '181500', 13, 41, 39),
	   (17, 2, 245, 1, 187, '2007-07-14', '193000', 14, 41, 39),
	   (219, 2, 14, 2, 187, '2007-07-15', '181500', 15, 41, 39),
	   (1010, 2, 16, 1, 187, '2007-07-15', '193000', 16, 41, 39),
	   (1022, 0, 13, 4, 187, '2007-07-16', '193000', 17, 41, 39),
	   (1008, 0, 235, 0, 187, '2007-07-16', '193000', 18, 41, 39),
	   (1000, 1, 15, 4, 187, '2007-07-16', '171500', 19, 41, 39),
	   (1011, 1, 229, 2, 187, '2007-07-16', '171500', 20, 41, 39),
	   (1023, 0, 14, 2, 187, '2007-07-18', '203000', 21, 41, 39),
	   (1009, 3, 219, 0, 187, '2007-07-18', '203000', 22, 41, 39),
	   (245, 0, 16, 1, 187, '2007-07-18', '171500', 23, 41, 39),
	   (17, 4, 1010, 0, 187, '2007-07-18', '171500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (15, 1, 0, 4, 13, 1, 0, 3, 187, '2007-07-21', '171500', 25, 43, 40, 27),
	   (235, 2, null, null, 1000, 0, null, null, 187, '2007-07-21', '201500', 26, 43, 40, 25),
	   (14, 0, 0, 2, 16, 0, 0, 4, 187, '2007-07-22', '181500', 27, 43, 40, 26),
	   (17, 2, null, null, 1009, 1, null, null, 187, '2007-07-22', '201500', 28, 43, 40, 28),
	   (235, 0, 0, 4, 16, 0, 0, 3, 187, '2007-07-25', '181500', 29, 44, 40, 29),
	   (15, 2, null, null, 17, 3, null, null, 187, '2007-07-25', '201500', 30, 44, 40, 30),
	   (16, 0, 0, 6, 15, 0, 0, 5, 187, '2007-07-28', '193000', 31, 45, 40, 32),
	   (235, 1, null, null, 17, 0, null, null, 187, '2007-07-29', '193000', 32, 46, 40, 31);

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
