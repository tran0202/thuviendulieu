# Insert new tournament
# Replace all the tournament_id

# 2011 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2011 Gold Cup United States', '2011-06-05', '2011-06-25', 13, 'gc_2011.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (131, 41, 1, 39, 1),
	   (131, 43, 1, 40, 2),
	   (131, 44, 2, 40, 2),
	   (131, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO nation (name, flag_filename, nation_type_id, code)
VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Grenada', 1, 80),
	   ('Guadeloupe', 1, 231);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (28, 131, 1, 1),
	   (27, 131, 1, 2),
	   (236, 131, 1, 3),
	   (246, 131, 1, 4),
	   (225, 131, 2, 1),
	   (197, 131, 2, 2),
	   (968, 131, 2, 3),
	   (970, 131, 2, 4),
	   (29, 131, 3, 1),
	   (198, 131, 3, 2),
	   (232, 131, 3, 3),
	   (971, 131, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (27, 5, 246, 0, 131, '2011-05-05', '180000', 1, 41, 39),
	   (28, 5, 236, 0, 131, '2011-05-05', '200000', 2, 41, 39),
	   (225, 4, 970, 0, 131, '2011-05-06', '210000', 3, 41, 39),
	   (197, 0, 968, 0, 131, '2011-05-06', '230000', 4, 41, 39),
	   (29, 3, 971, 2, 131, '2011-05-07', '180000', 5, 41, 39),
	   (198, 2, 232, 0, 131, '2011-05-07', '200000', 6, 41, 39),
	   (27, 1, 236, 1, 131, '2011-05-09', '190000', 7, 41, 39),
	   (246, 0, 28, 5, 131, '2011-05-09', '210000', 8, 41, 39),
	   (225, 2, 968, 0, 131, '2011-05-10', '190000', 9, 41, 39),
	   (970, 1, 197, 7, 131, '2011-05-10', '210000', 10, 41, 39),
	   (232, 1, 971, 0, 131, '2011-05-11', '180000', 11, 41, 39),
	   (198, 1, 29, 2, 131, '2011-05-11', '200000', 12, 41, 39),
	   (236, 6, 246, 1, 131, '2011-05-12', '180000', 13, 41, 39),
	   (28, 4, 27, 1, 131, '2011-05-12', '200000', 14, 41, 39),
	   (968, 4, 970, 0, 131, '2011-05-13', '190000', 15, 41, 39),
	   (197, 0, 225, 1, 131, '2011-05-13', '210000', 16, 41, 39),
	   (232, 1, 29, 1, 131, '2011-05-14', '190000', 17, 41, 39),
	   (971, 0, 198, 1, 131, '2011-05-14', '210000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (27, 1, 0, 2, 197, 1, 0, 4, 131, '2011-05-18', '170000', 19, 43, 40, 19),
	   (28, 2, null, null, 968, 1, null, null, 131, '2011-05-18', '200000', 20, 43, 40, 20),
	   (225, 0, null, null, 198, 2, null, null, 131, '2011-05-19', '150000', 21, 43, 40, 21),
	   (29, 1, 0, 5, 236, 1, 0, 3, 131, '2011-05-19', '180000', 22, 43, 40, 22),
	   (198, 1, null, null, 29, 0, null, null, 131, '2011-05-22', '190000', 23, 44, 40, 23),
	   (197, 0, 0, null, 28, 0, 2, null, 131, '2011-05-22', '220000', 24, 44, 40, 24),
	   (198, 2, null, null, 28, 4, null, null, 131, '2011-05-25', '210000', 25, 46, 40, 25);

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
