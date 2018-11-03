# Insert new tournament
# Replace all the tournament_id

# 2005 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2005 Gold Cup United States', '2005-07-06', '2005-07-24', 13, 'gc_2005.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (134, 41, 1, 39, 1),
	   (134, 43, 1, 40, 1),
	   (134, 44, 2, 40, 2),
	   (134, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Grenada', 1, 80),
# 	   ('Guadeloupe', 1, 231);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (197, 134, 1, 1),
	   (29, 134, 1, 2),
	   (30, 134, 1, 3),
	   (211, 134, 1, 4),
	   (198, 134, 2, 1),
	   (27, 134, 2, 2),
	   (232, 134, 2, 3),
	   (246, 134, 2, 4),
	   (28, 134, 3, 1),
	   (205, 134, 3, 2),
	   (225, 134, 3, 3),
	   (968, 134, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (30, 0, 29, 1, 134, '2005-07-06', '190000', 1, 41, 39),
	   (211, 1, 197, 1, 134, '2005-07-06', '190000', 2, 41, 39),
	   (232, 0, 27, 1, 134, '2005-07-07', '190000', 3, 41, 39),
	   (240, 1, 198, 4, 134, '2005-07-07', '190000', 4, 41, 39),
	   (205, 2, 28, 1, 134, '2005-07-07', '190000', 5, 41, 39),
	   (968, 3, 225, 4, 134, '2005-07-07', '190000', 6, 41, 39),
	   (29, 2, 211, 2, 134, '2005-07-09', '190000', 7, 41, 39),
	   (197, 2, 30, 1, 134, '2005-07-09', '190000', 8, 41, 39),
	   (27, 3, 246, 1, 134, '2005-07-09', '190000', 9, 41, 39),
	   (198, 2, 232, 0, 134, '2005-07-09', '190000', 10, 41, 39),
	   (28, 4, 968, 0, 134, '2005-07-09', '190000', 11, 41, 39),
	   (225, 3, 205, 3, 134, '2005-07-09', '190000', 12, 41, 39),
	   (30, 2, 211, 0, 134, '2005-07-11', '190000', 13, 41, 39),
	   (197, 1, 29, 0, 134, '2005-07-11', '190000', 14, 41, 39),
	   (198, 0, 27, 0, 134, '2005-07-11', '190000', 15, 41, 39),
	   (232, 2, 246, 1, 134, '2005-07-11', '190000', 16, 41, 39),
	   (968, 1, 205, 1, 134, '2005-07-11', '190000', 17, 41, 39),
	   (28, 1, 225, 0, 134, '2005-07-11', '190000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (197, 3, null, null, 27, 2, null, null, 134, '2005-07-16', '130000', 19, 43, 40, 19),
	   (198, 3, null, null, 225, 1, null, null, 134, '2005-07-16', '160000', 20, 43, 40, 20),
	   (28, 1, null, null, 30, 2, null, null, 134, '2005-07-17', '150000', 21, 43, 40, 21),
	   (205, 1, 0, 3, 29, 1, 0, 5, 134, '2005-07-17', '180000', 22, 43, 40, 22),
	   (197, 1, null, null, 198, 2, null, null, 134, '2005-07-21', '180000', 23, 44, 40, 23),
	   (30, 2, null, null, 29, 3, null, null, 134, '2005-07-21', '210000', 24, 44, 40, 24),
	   (198, 0, 0, 3, 29, 0, 0, 1, 134, '2005-07-24', '150000', 25, 46, 40, 25);

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

CREATE TABLE IF NOT EXISTS nation (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	alternative_name VARCHAR(255),
	code VARCHAR(255),
	flag_filename VARCHAR(255),
	alternative_flag_filename VARCHAR(255),
	parent_nation_id INT,
	nation_type_id INT,
	FOREIGN KEY (parent_nation_id) REFERENCES nation(id),
	FOREIGN KEY (nation_type_id) REFERENCES group_type(id)
);
