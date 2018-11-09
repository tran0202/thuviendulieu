# Insert new tournament
# Replace all the tournament_id

# 2006 Africa Cup of Nations Egypt

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2006 Africa Cup of Nations Egypt', '2006-01-20', '2006-02-10', 14, 'afcon_2006.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (158, 41, 1, 39, 1),
	   (158, 43, 1, 40, 2),
	   (158, 44, 2, 40, 2),
	   (158, 45, 3, 40, 2),
	   (158, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Namibia', 1, 133);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (8, 158, 1, 1),
	   (196, 158, 1, 2),
	   (9, 158, 1, 3),
	   (1105, 158, 1, 4),
	   (194, 158, 2, 1),
	   (1107, 158, 2, 2),
	   (212, 158, 2, 3),
	   (214, 158, 2, 4),
	   (985, 158, 3, 1),
	   (12, 158, 3, 2),
	   (984, 158, 3, 3),
	   (205, 158, 3, 4),
	   (10, 158, 4, 1),
	   (11, 158, 4, 2),
	   (195, 158, 4, 3),
	   (978, 158, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (8, 3, 1105, 0, 158, '2006-01-20', '190000', 1, 41, 39),
	   (9, 0, 196, 1, 158, '2006-01-21', '140000', 2, 41, 39),
	   (194, 3, 212, 1, 158, '2006-01-21', '171500', 3, 41, 39),
	   (214, 0, 1107, 2, 158, '2006-01-21', '200000', 4, 41, 39),
	   (12, 4, 984, 1, 158, '2006-01-22', '171500', 5, 41, 39),
	   (205, 0, 985, 2, 158, '2006-01-22', '200000', 6, 41, 39),
	   (10, 1, 195, 0, 158, '2006-01-23', '171500', 7, 41, 39),
	   (978, 0, 11, 2, 158, '2006-01-23', '200000', 8, 41, 39),
	   (1105, 1, 196, 2, 158, '2006-01-24', '171500', 9, 41, 39),
	   (8, 0, 9, 0, 158, '2006-01-24', '200000', 10, 41, 39),
	   (212, 0, 1107, 0, 158, '2006-01-25', '171500', 11, 41, 39),
	   (194, 2, 214, 0, 158, '2006-01-25', '200000', 12, 41, 39),
	   (984, 1, 985, 2, 158, '2006-01-26', '171500', 13, 41, 39),
	   (12, 2, 205, 0, 158, '2006-01-26', '200000', 14, 41, 39),
	   (195, 1, 11, 0, 158, '2006-01-27', '171500', 15, 41, 39),
	   (10, 2, 978, 0, 158, '2006-01-27', '200000', 16, 41, 39),
	   (8, 3, 196, 1, 158, '2006-01-28', '190000', 17, 41, 39),
	   (1105, 0, 9, 0, 158, '2006-01-28', '190000', 18, 41, 39),
	   (212, 3, 214, 2, 158, '2006-01-29', '190000', 19, 41, 39),
	   (194, 2, 1107, 0, 158, '2006-01-29', '190000', 20, 41, 39),
	   (12, 0, 985, 3, 158, '2006-01-30', '190000', 21, 41, 39),
	   (984, 1, 205, 0, 158, '2006-01-30', '190000', 22, 41, 39),
	   (10, 2, 11, 1, 158, '2006-01-31', '190000', 23, 41, 39),
	   (195, 1, 978, 2, 158, '2006-01-31', '190000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (985, 2, null, null, 11, 3, null, null, 158, '2006-02-03', '150000', 25, 43, 40, 26),
	   (8, 4, null, null, 1107, 1, null, null, 158, '2006-02-03', '190000', 26, 43, 40, 25),
	   (10, 1, 0, 6, 12, 1, 0, 5, 158, '2006-02-04', '150000', 27, 43, 40, 28),
	   (194, 0, 1, 11, 196, 0, 1, 12, 158, '2006-02-04', '190000', 28, 43, 40, 27),
	   (8, 2, null, null, 11, 1, null, null, 158, '2006-02-07', '190000', 29, 44, 40, 29),
	   (10, 0, null, null, 196, 1, null, null, 158, '2006-02-07', '150000', 30, 44, 40, 30),
	   (11, 0, null, null, 10, 1, null, null, 158, '2006-02-09', '180000', 31, 45, 40, 32),
	   (8, 0, 0, 4, 196, 0, 0, 2, 158, '2006-02-10', '180000', 32, 46, 40, 31);

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
