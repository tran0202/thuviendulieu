# Insert new tournament
# Replace all the tournament_id

# 1980 OFC Nations Cup New Caledonia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1980 OFC Nations Cup New Caledonia', '1980-02-24', '1980-03-01', 16, 'OFCcup.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (209, 41, 1, 39, 1),
	   (209, 45, 1, 40, 2),
	   (209, 46, 2, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
VALUES ('New Hebrides', 'New_Hebrides.png', 205, 6, 'HEB');

INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Papua New Guinea', 1, 147, null),
	   ('New Caledonia', 1, 136, null),
	   ('Tahiti', 1, 186, null),
	   ('Samoa', 1, 159, null),
	   ('Solomon Islands', 1, 171, null),
	   ('Fiji', 1, 69, null),
	   ('Vanuatu', 1, 205, null),
	   ('Cook Islands', 1, 48, null),
	   ('New Hebrides', 1, 235, 1043);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1039, 209, 1, 1),
	   (1042, 209, 1, 2),
	   (208, 209, 1, 3),
	   (1041, 209, 1, 4),
	   (13, 209, 2, 1),
	   (1109, 209, 2, 2),
	   (1037, 209, 2, 3),
	   (1110, 209, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1037, 4, 1110, 3, 209, '1980-02-24', '190000', 1, 41, 39),
	   (13, 8, 1109, 0, 209, '1980-02-24', '190000', 2, 41, 39),
	   (1042, 3, 1041, 1, 209, '1980-02-25', '190000', 3, 41, 39),
	   (1039, 3, 208, 1, 209, '1980-02-25', '190000', 4, 41, 39),
	   (13, 11, 1037, 2, 209, '1980-02-26', '190000', 5, 41, 39),
	   (1109, 4, 1110, 3, 209, '1980-02-26', '190000', 6, 41, 39),
	   (1042, 4, 208, 0, 209, '1980-02-27', '190000', 7, 41, 39),
	   (1039, 12, 1041, 1, 209, '1980-02-27', '190000', 8, 41, 39),
	   (13, 1, 1110, 0, 209, '1980-02-28', '190000', 9, 41, 39),
	   (1109, 8, 1037, 0, 209, '1980-02-28', '190000', 10, 41, 39),
	   (1039, 6, 1042, 3, 209, '1980-02-29', '190000', 11, 41, 39),
	   (208, 6, 1041, 1, 209, '1980-02-29', '190000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1109, 2, null, null, 1042, 1, null, null, 209, '1980-03-01', '190000', 13, 45, 40, 14),
	   (13, 4, null, null, 1039, 2, null, null, 209, '1980-03-01', '190000', 14, 46, 40, 13);

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
