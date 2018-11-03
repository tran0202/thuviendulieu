# Insert new tournament
# Replace all the tournament_id

# 2001 Copa America Colombia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2001 Copa America Colombia', '2001-07-11', '2001-07-29', 12, 'copa-2001.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (88, 41, 1, 39, 1),
	   (88, 43, 1, 40, 1),
	   (88, 44, 2, 40, 2),
	   (88, 45, 3, 40, 3),
	   (88, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Venezuela', 1, 206);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (30, 88, 1, 1),
	   (199, 88, 1, 2),
	   (200, 88, 1, 3),
	   (1091, 88, 1, 4),
	   (1, 88, 2, 1),
	   (28, 88, 2, 2),
	   (31, 88, 2, 3),
	   (207, 88, 2, 4),
	   (27, 88, 3, 1),
	   (197, 88, 3, 2),
	   (32, 88, 3, 3),
	   (227, 88, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (200, 1, 199, 4, 88, '2001-07-11', '180000', 1, 41, 39),
	   (30, 2, 1091, 0, 88, '2001-07-11', '204500', 2, 41, 39),
	   (31, 3, 207, 3, 88, '2001-07-12', '173000', 3, 41, 39),
	   (1, 0, 28, 1, 88, '2001-07-12', '194500', 4, 41, 39),
	   (227, 0, 32, 1, 88, '2001-07-13', '180000', 5, 41, 39),
	   (197, 0, 27, 1, 88, '2001-07-13', '201500', 6, 41, 39),
	   (199, 1, 1091, 0, 88, '2001-07-14', '161500', 7, 41, 39),
	   (30, 1, 200, 0, 88, '2001-07-14', '183000', 8, 41, 39),
	   (1, 2, 31, 0, 88, '2001-07-15', '160000', 9, 41, 39),
	   (207, 0, 28, 0, 88, '2001-07-15', '181500', 10, 41, 39),
	   (32, 1, 27, 1, 88, '2001-07-16', '180000', 11, 41, 39),
	   (197, 2, 227, 0, 88, '2001-07-16', '201500', 12, 41, 39),
	   (200, 4, 1091, 0, 88, '2001-07-17', '183000', 13, 41, 39),
	   (30, 2, 199, 0, 88, '2001-07-17', '204500', 14, 41, 39),
	   (31, 1, 28, 0, 88, '2001-07-18', '173000', 15, 41, 39),
	   (1, 3, 207, 1, 88, '2001-07-18', '194500', 16, 41, 39),
	   (227, 0, 27, 4, 88, '2001-07-19', '180000', 17, 41, 39),
	   (197, 1, 32, 0, 88, '2001-07-19', '201500', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(199, 0, null, null, 28, 2, null, null, 88, '2001-07-22', '150000', 19, 43, 40, 19),
		(32, 2, null, null, 27, 1, null, null, 88, '2001-07-22', '173000', 20, 43, 40, 20),
		(1, 0, null, null, 197, 2, null, null, 88, '2001-07-23', '173000', 21, 43, 40, 21),
		(30, 3, null, null, 31, 0, null, null, 88, '2001-07-23', '194500', 22, 43, 40, 22),
		(28, 2, null, null, 32, 1, null, null, 88, '2001-07-25', '194500', 23, 44, 40, 23),
		(30, 2, null, null, 197, 0, null, null, 88, '2001-07-26', '194500', 24, 44, 40, 24),
		(32, 2, 0, 4, 197, 2, 0, 5, 88, '2001-07-28', '140000', 25, 45, 40, 26),
		(30, 1, null, null, 28, 0, null, null, 88, '2001-07-29', '163000', 26, 46, 40, 25);

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
