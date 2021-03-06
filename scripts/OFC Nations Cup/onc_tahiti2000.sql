# Insert new tournament
# Replace all the tournament_id

# 2000 OFC Nations Cup Tahiti

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2000 OFC Nations Cup Tahiti', '2000-06-19', '2000-06-28', 16, 'OFCcup.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (206, 41, 1, 39, 1),
	   (206, 44, 1, 40, 2),
	   (206, 45, 2, 40, 2),
	   (206, 46, 3, 40, 2);

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
	   ('Vanuatu', 1, 205, null),
	   ('Cook Islands', 1, 48, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (13, 206, 1, 1),
	   (1041, 206, 1, 2),
	   (1044, 206, 1, 3),
	   (208, 206, 2, 1),
	   (1043, 206, 2, 2),
	   (1039, 206, 2, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (13, 17, 1044, 0, 206, '2000-06-19', '120000', 1, 41, 39),
	   (208, 2, 1039, 0, 206, '2000-06-19', '120000', 2, 41, 39),
	   (1041, 5, 1044, 1, 206, '2000-06-21', '120000', 3, 41, 39),
	   (208, 3, 1043, 1, 206, '2000-06-21', '120000', 4, 41, 39),
	   (13, 6, 1041, 0, 206, '2000-06-22', '120000', 5, 41, 39),
	   (1043, 3, 1039, 2, 206, '2000-06-23', '120000', 6, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (13, 1, null, null, 1043, 0, null, null, 206, '2000-06-25', '150000', 7, 44, 40, 7),
	   (208, 2, null, null, 1041, 0, null, null, 206, '2000-06-25', '150000', 8, 44, 40, 8),
	   (1041, 2, null, null, 1043, 1, null, null, 206, '2000-06-28', '150000', 9, 45, 40, 10),
	   (13, 2, null, null, 208, 0, null, null, 206, '2000-06-28', '150000', 10, 46, 40, 9);

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
