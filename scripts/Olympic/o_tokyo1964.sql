# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Tokyo 1964

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Tokyo 1964', '1964-10-11', '1964-10-23', 9, '1964.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (52, 41, 1, 39, 1),
	   (52, 43, 1, 40, 2),
	   (52, 44, 2, 40, 2),
	   (52, 134, 3, 40, 2),
	   (52, 135, 4, 40, 2),
	   (52, 132, 5, 40, 2),
	   (52, 133, 6, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Romania', 4, 156);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1081, 52, 1, 1),
	   (1082, 52, 1, 2),
	   (845, 52, 1, 3),
	   (1083, 52, 1, 4),
	   (904, 52, 2, 1),
	   (911, 52, 2, 2),
	   (880, 52, 2, 3),
	   (916, 52, 3, 1),
	   (877, 52, 3, 2),
	   (835, 52, 3, 3),
	   (843, 52, 3, 4),
	   (1084, 52, 4, 1),
	   (841, 52, 4, 2),
	   (849, 52, 4, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1082, 3, 845, 1, 52, '1964-10-11', '140000', 1, 41, 39),
	   (1081, 4, 1083, 0, 52, '1964-10-11', '140000', 2, 41, 39),
	   (1083, 1, 845, 1, 52, '1964-10-13', '140000', 7, 41, 39),
	   (1081, 1, 1082, 1, 52, '1964-10-13', '140000', 8, 41, 39),
	   (1081, 2, 845, 0, 52, '1964-10-15', '140000', 13, 41, 39),
	   (1082, 1, 1083, 0, 52, '1964-10-15', '140000', 14, 41, 39),
	   (904, 6, 880, 0, 52, '1964-10-11', '140000', 3, 41, 39),
	   (911, 3, 880, 1, 52, '1964-10-13', '140000', 9, 41, 39),
	   (904, 6, 911, 5, 52, '1964-10-15', '140000', 15, 41, 39),
	   (835, 1, 877, 1, 52, '1964-10-12', '140000', 4, 41, 39),
	   (916, 6, 843, 1, 52, '1964-10-12', '140000', 5, 41, 39),
	   (916, 5, 877, 1, 52, '1964-10-14', '140000', 10, 41, 39),
	   (835, 4, 843, 0, 52, '1964-10-14', '140000', 11, 41, 39),
	   (877, 10, 843, 0, 52, '1964-10-16', '140000', 16, 41, 39),
	   (916, 1, 835, 0, 52, '1964-10-16', '140000', 17, 41, 39),
	   (849, 1, 1084, 1, 52, '1964-10-12', '140000', 6, 41, 39),
	   (841, 3, 849, 2, 52, '1964-10-14', '140000', 12, 41, 39),
	   (841, 2, 1084, 3, 52, '1964-10-16', '140000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(1081, 1, null, null, 911, 0, null, null, 52, '1964-10-18', '140000', 19, 43, 40, 22),
		  (904, 2, null, null, 1082, 0, null, null, 52, '1964-10-18', '140000', 20, 43, 40, 20),
		  (877, 5, null, null, 1084, 1, null, null, 52, '1964-10-18', '140000', 21, 43, 40, 19),
		  (916, 4, null, null, 841, 0, null, null, 52, '1964-10-18', '140000', 22, 43, 40, 21),
		  (904, 6, null, null, 877, 0, null, null, 52, '1964-10-20', '140000', 23, 44, 40, 23),
		  (916, 2, null, null, 1081, 1, null, null, 52, '1964-10-20', '140000', 24, 44, 40, 24),
		  (841, 1, null, null, 911, 6, null, null, 52, '1964-10-20', '140000', 25, 134, 40, 25),
		  (1082, 4, null, null, 1084, 2, null, null, 52, '1964-10-20', '140000', 26, 134, 40, 26),
		  (1082, 3, null, null, 911, 0, null, null, 52, '1964-10-22', '140000', 27, 135, 40, 27),
		  (1081, 3, null, null, 877, 1, null, null, 52, '1964-10-23', '120000', 28, 132, 40, 29),
		  (904, 2, null, null, 916, 1, null, null, 52, '1964-10-23', '163000', 29, 133, 40, 28);

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
