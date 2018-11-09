# Insert new tournament
# Replace all the tournament_id

# 2007 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2007 Gold Cup United States', '2007-06-06', '2007-06-24', 13, 'gc_2007.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (133, 41, 1, 39, 1),
	   (133, 43, 1, 40, 2),
	   (133, 44, 2, 40, 2),
	   (133, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Grenada', 1, 80),
# 	   ('Guadeloupe', 1, 231);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (232, 133, 1, 1),
	   (27, 133, 1, 2),
	   (971, 133, 1, 3),
	   (240, 133, 1, 4),
	   (198, 133, 2, 1),
	   (968, 133, 2, 2),
	   (236, 133, 2, 3),
	   (211, 133, 2, 4),
	   (197, 133, 3, 1),
	   (28, 133, 3, 2),
	   (29, 133, 3, 3),
	   (246, 133, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (27, 1, 232, 2, 133, '2007-06-06', '190000', 1, 41, 39),
	   (971, 1, 240, 1, 133, '2007-06-06', '210000', 2, 41, 39),
	   (198, 1, 968, 0, 133, '2007-06-07', '180000', 3, 41, 39),
	   (236, 2, 211, 1, 133, '2007-06-07', '200000', 4, 41, 39),
	   (29, 3, 197, 2, 133, '2007-06-08', '190000', 5, 41, 39),
	   (28, 2, 246, 1, 133, '2007-06-08', '210000', 6, 41, 39),
	   (232, 1, 971, 2, 133, '2007-06-09', '190000', 7, 41, 39),
	   (240, 1, 27, 1, 133, '2007-06-09', '210000', 8, 41, 39),
	   (968, 1, 236, 0, 133, '2007-06-09', '120000', 9, 41, 39),
	   (211, 0, 198, 2, 133, '2007-06-09', '140000', 10, 41, 39),
	   (197, 2, 28, 1, 133, '2007-06-10', '160000', 11, 41, 39),
	   (29, 2, 246, 2, 133, '2007-06-10', '180000', 12, 41, 39),
	   (27, 1, 971, 0, 133, '2007-06-11', '190000', 13, 41, 39),
	   (240, 0, 232, 2, 133, '2007-06-11', '210000', 14, 41, 39),
	   (198, 4, 236, 0, 133, '2007-06-12', '190000', 15, 41, 39),
	   (211, 1, 968, 1, 133, '2007-06-12', '210000', 16, 41, 39),
	   (246, 0, 197, 5, 133, '2007-06-13', '190000', 17, 41, 39),
	   (28, 1, 29, 0, 133, '2007-06-13', '210000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (232, 3, null, null, 968, 0, null, null, 133, '2007-06-16', '130000', 19, 43, 40, 19),
	   (198, 2, null, null, 29, 1, null, null, 133, '2007-06-16', '160000', 20, 43, 40, 20),
	   (28, 0, 1, null, 27, 0, 0, null, 133, '2007-06-17', '140000', 21, 43, 40, 21),
	   (197, 1, null, null, 971, 2, null, null, 133, '2007-06-17', '170000', 22, 43, 40, 22),
	   (232, 1, null, null, 198, 2, null, null, 133, '2007-06-21', '180000', 23, 44, 40, 23),
	   (28, 1, null, null, 971, 0, null, null, 133, '2007-06-21', '210000', 24, 44, 40, 24),
	   (198, 2, null, null, 28, 1, null, null, 133, '2007-06-24', '140000', 25, 46, 40, 25);

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
