# Insert new tournament
# Replace all the tournament_id

# 2012 OFC Nations Cup Solomon Islands

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2012 OFC Nations Cup Solomon Islands', '2012-06-01', '2012-06-10', 16, 'OFCcup.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (202, 41, 1, 39, 1),
	   (202, 44, 1, 40, 1),
	   (202, 45, 2, 40, 2),
	   (202, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Papua New Guinea', 1, 147, null),
	   ('New Caledonia', 1, 136, null),
	   ('Tahiti', 1, 186, null),
	   ('Samoa', 1, 159, null),
	   ('Solomon Islands', 1, 171, null),
	   ('Fiji', 1, 69, null),
	   ('Vanuatu', 1, 205, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1039, 202, 1, 1),
	   (1038, 202, 1, 2),
	   (1043, 202, 1, 3),
	   (1040, 202, 1, 4),
	   (208, 202, 2, 1),
	   (1041, 202, 2, 2),
	   (1042, 202, 2, 3),
	   (1037, 202, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1040, 1, 1039, 10, 202, '2012-06-01', '120000', 1, 41, 39),
	   (1043, 2, 1038, 5, 202, '2012-06-01', '150000', 2, 41, 39),
	   (1042, 0, 208, 1, 202, '2012-06-02', '120000', 3, 41, 39),
	   (1041, 1, 1037, 0, 202, '2012-06-02', '150000', 4, 41, 39),
	   (1043, 5, 1040, 0, 202, '2012-06-03', '120000', 5, 41, 39),
	   (1039, 4, 1038, 3, 202, '2012-06-03', '150000', 6, 41, 39),
	   (1037, 1, 208, 2, 202, '2012-06-04', '120000', 7, 41, 39),
	   (1042, 0, 1041, 0, 202, '2012-06-04', '150000', 8, 41, 39),
	   (1038, 9, 1040, 0, 202, '2012-06-05', '120000', 9, 41, 39),
	   (1039, 4, 1043, 1, 202, '2012-06-05', '150000', 10, 41, 39),
	   (1037, 1, 1042, 1, 202, '2012-06-06', '120000', 11, 41, 39),
	   (208, 1, 1041, 1, 202, '2012-06-06', '150000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1039, 1, null, null, 1041, 0, null, null, 202, '2012-06-08', '110000', 13, 44, 40, 13),
	   (208, 0, null, null, 1038, 2, null, null, 202, '2012-06-08', '150000', 14, 44, 40, 14),
	   (1041, 3, null, null, 208, 4, null, null, 202, '2012-06-10', '110000', 15, 45, 40, 16),
	   (1039, 1, null, null, 1038, 0, null, null, 202, '2012-06-10', '150000', 16, 46, 40, 15);

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
