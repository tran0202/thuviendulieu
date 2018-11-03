# Insert new tournament
# Replace all the tournament_id

# 2016 Copa America Centenario USA

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2016 Copa America Centenario USA', '2016-06-03', '2016-06-26', 12, 'copa-centenario.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (83, 41, 1, 39, 1),
	   (83, 43, 1, 40, 1),
	   (83, 44, 2, 40, 2),
	   (83, 45, 3, 40, 3),
	   (83, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Venezuela', 1, 206);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (198, 83, 1, 1),
	   (30, 83, 1, 2),
	   (27, 83, 1, 3),
	   (207, 83, 1, 4),
	   (31, 83, 2, 1),
	   (200, 83, 2, 2),
	   (1, 83, 2, 3),
	   (240, 83, 2, 4),
	   (28, 83, 3, 1),
	   (963, 83, 3, 2),
	   (32, 83, 3, 3),
	   (225, 83, 3, 4),
	   (3, 83, 4, 1),
	   (199, 83, 4, 2),
	   (29, 83, 4, 3),
	   (227, 83, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (198, 0, 30, 2, 83, '2016-06-03', '213000', 1, 41, 39),
	   (27, 0, 207, 0, 83, '2016-06-04', '170000', 2, 41, 39),
	   (240, 0, 31, 1, 83, '2016-06-04', '193000', 3, 41, 39),
	   (1, 0, 200, 0, 83, '2016-06-04', '220000', 4, 41, 39),
	   (225, 0, 963, 1, 83, '2016-06-05', '170000', 5, 41, 39),
	   (28, 3, 32, 1, 83, '2016-06-05', '200000', 6, 41, 39),
	   (29, 2, 227, 1, 83, '2016-06-06', '190000', 7, 41, 39),
	   (3, 2, 199, 1, 83, '2016-06-06', '220000', 8, 41, 39),
	   (198, 4, 27, 0, 83, '2016-06-07', '200000', 9, 41, 39),
	   (30, 2, 207, 1, 83, '2016-06-07', '223000', 10, 41, 39),
	   (1, 7, 240, 1, 83, '2016-06-08', '193000', 11, 41, 39),
	   (200, 2, 31, 2, 83, '2016-06-08', '220000', 12, 41, 39),
	   (32, 0, 963, 1, 83, '2016-06-09', '193000', 13, 41, 39),
	   (28, 2, 225, 0, 83, '2016-06-09', '220000', 14, 41, 39),
	   (199, 2, 227, 1, 83, '2016-06-10', '190000', 15, 41, 39),
	   (3, 5, 29, 0, 83, '2016-06-10', '213000', 16, 41, 39),
	   (198, 1, 207, 0, 83, '2016-06-11', '190000', 17, 41, 39),
	   (30, 2, 27, 3, 83, '2016-06-11', '210000', 18, 41, 39),
	   (200, 4, 240, 0, 83, '2016-06-12', '183000', 19, 41, 39),
	   (1, 0, 31, 1, 83, '2016-06-12', '203000', 20, 41, 39),
	   (28, 1, 963, 1, 83, '2016-06-13', '200000', 21, 41, 39),
	   (32, 3, 225, 0, 83, '2016-06-13', '220000', 22, 41, 39),
	   (199, 4, 29, 2, 83, '2016-06-14', '200000', 23, 41, 39),
	   (3, 3, 227, 0, 83, '2016-06-14', '220000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(198, 2, null, null, 200, 1, null, null, 83, '2016-06-16', '213000', 25, 43, 40, 25),
	   	(31, 0, 0, 2, 30, 0, 0, 4, 83, '2016-06-17', '200000', 26, 43, 40, 27),
		(3, 4, null, null, 963, 1, null, null, 83, '2016-06-18', '190000', 27, 43, 40, 26),
		(28, 0, null, null, 199, 7, null, null, 83, '2016-06-18', '220000', 28, 43, 40, 28),
		(198, 0, null, null, 3, 4, null, null, 83, '2016-06-21', '210000', 29, 44, 40, 29),
		(30, 0, null, null, 199, 2, null, null, 83, '2016-06-22', '200000', 30, 44, 40, 30),
		(198, 0, null, null, 30, 1, null, null, 83, '2016-06-25', '200000', 31, 45, 40, 32),
		(3, 0, 0, 2, 199, 0, 0, 4, 83, '2016-06-26', '200000', 32, 46, 40, 31);

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
