# Insert new tournament
# Replace all the tournament_id

# 1997 Copa America Bolivia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('1997 Copa America Bolivia', '1997-06-11', '1997-06-29', 12, 'copa-1997.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (90, 41, 1, 39, 1),
	   (90, 43, 1, 40, 1),
	   (90, 44, 2, 40, 2),
	   (90, 45, 3, 40, 3),
	   (90, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Venezuela', 1, 206);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (200, 90, 1, 1),
	   (3, 90, 1, 2),
	   (207, 90, 1, 3),
	   (199, 90, 1, 4),
	   (227, 90, 2, 1),
	   (31, 90, 2, 2),
	   (32, 90, 2, 3),
	   (963, 90, 2, 4),
	   (1, 90, 3, 1),
	   (28, 90, 3, 2),
	   (30, 90, 3, 3),
	   (27, 90, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (200, 0, 3, 0, 90, '1997-06-11', '190000', 1, 41, 39),
	   (207, 1, 199, 0, 90, '1997-06-11', '190000', 2, 41, 39),
	   (227, 1, 963, 0, 90, '1997-06-12', '190000', 3, 41, 39),
	   (31, 1, 32, 0, 90, '1997-06-12', '190000', 4, 41, 39),
	   (1, 5, 27, 0, 90, '1997-06-13', '190000', 5, 41, 39),
	   (30, 1, 28, 2, 90, '1997-06-13', '190000', 6, 41, 39),
	   (3, 2, 199, 0, 90, '1997-06-14', '190000', 7, 41, 39),
	   (207, 0, 200, 2, 90, '1997-06-14', '190000', 8, 41, 39),
	   (32, 2, 963, 0, 90, '1997-06-15', '190000', 9, 41, 39),
	   (227, 2, 31, 0, 90, '1997-06-15', '190000', 10, 41, 39),
	   (1, 3, 28, 2, 90, '1997-06-16', '190000', 11, 41, 39),
	   (30, 4, 27, 1, 90, '1997-06-16', '190000', 12, 41, 39),
	   (200, 2, 199, 1, 90, '1997-06-17', '190000', 13, 41, 39),
	   (207, 1, 3, 1, 90, '1997-06-17', '190000', 14, 41, 39),
	   (31, 2, 963, 0, 90, '1997-06-18', '190000', 15, 41, 39),
	   (227, 1, 32, 0, 90, '1997-06-18', '190000', 16, 41, 39),
	   (1, 2, 30, 0, 90, '1997-06-19', '190000', 17, 41, 39),
	   (28, 1, 27, 1, 90, '1997-06-19', '190000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(31, 2, null, null, 3, 1, null, null, 90, '1997-06-21', '190000', 19, 43, 40, 21),
		(227, 2, null, null, 30, 1, null, null, 90, '1997-06-21', '190000', 20, 43, 40, 19),
		(28, 1, 0, 4, 200, 1, 0, 3, 90, '1997-06-22', '190000', 21, 43, 40, 20),
		(1, 2, null, null, 207, 0, null, null, 90, '1997-06-22', '173000', 22, 43, 40, 22),
		(227, 3, null, null, 28, 1, null, null, 90, '1997-06-25', '190000', 23, 44, 40, 23),
		(31, 0, null, null, 1, 7, null, null, 90, '1997-06-26', '190000', 24, 44, 40, 24),
		(28, 1, null, null, 31, 0, null, null, 90, '1997-06-28', '190000', 25, 45, 40, 26),
		(227, 1, null, null, 1, 3, null, null, 90, '1997-06-29', '170000', 26, 46, 40, 25);

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
