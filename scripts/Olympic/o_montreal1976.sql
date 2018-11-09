# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Montreal 1976

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Montreal 1976', '1976-07-18', '1976-07-31', 9, '1976.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (49, 41, 1, 39, 1),
	   (49, 43, 1, 40, 2),
	   (49, 44, 2, 40, 2),
	   (49, 132, 3, 40, 2),
	   (49, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Israel', 4, 95), ('Iran', 4, 93), ('Korea DPR', 4, 102);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (835, 49, 1, 1),
	   (917, 49, 1, 2),
	   (1085, 49, 1, 3),
	   (902, 49, 2, 1),
	   (920, 49, 2, 2),
	   (845, 49, 2, 3),
	   (909, 49, 2, 4),
	   (905, 49, 3, 1),
	   (1083, 49, 3, 2),
	   (914, 49, 3, 3),
	   (910, 49, 4, 1),
	   (922, 49, 4, 2),
	   (913, 49, 4, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (835, 0, 917, 0, 49, '1976-07-18', '120000', 1, 41, 39),
	   (835, 2, 1085, 1, 49, '1976-07-20', '120000', 6, 41, 39),
	   (917, 1, 1085, 0, 49, '1976-07-22', '120000', 11, 41, 39),
	   (920, 0, 909, 0, 49, '1976-07-19', '120000', 3, 41, 39),
	   (902, 4, 845, 1, 49, '1976-07-19', '120000', 4, 41, 39),
	   (902, 4, 909, 1, 49, '1976-07-21', '120000', 8, 41, 39),
	   (845, 2, 920, 2, 49, '1976-07-21', '120000', 9, 41, 39),
	   (845, 1, 909, 1, 49, '1976-07-23', '120000', 13, 41, 39),
	   (902, 1, 920, 1, 49, '1976-07-23', '120000', 14, 41, 39),
	   (905, 0, 914, 0, 49, '1976-07-18', '120000', 2, 41, 39),
	   (1083, 1, 914, 0, 49, '1976-07-20', '120000', 7, 41, 39),
	   (905, 3, 1083, 2, 49, '1976-07-22', '120000', 12, 41, 39),
	   (913, 1, 910, 2, 49, '1976-07-19', '120000', 5, 41, 39),
	   (922, 3, 913, 1, 49, '1976-07-21', '120000', 10, 41, 39),
	   (910, 3, 922, 0, 49, '1976-07-23', '120000', 15, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(917, 4, null, null, 912, 0, null, null, 49, '1976-07-25', '120000', 25, 43, 40, 25),
		  (910, 2, null, null, 1083, 1, null, null, 49, '1976-07-25', '120000', 26, 43, 40, 26),
		  (835, 4, null, null, 920, 1, null, null, 49, '1976-07-25', '120000', 27, 43, 40, 27),
		  (905, 5, null, null, 922, 0, null, null, 49, '1976-07-25', '120000', 28, 43, 40, 28),
		  (910, 1, null, null, 917, 2, null, null, 49, '1976-07-27', '120000', 29, 44, 40, 29),
		  (905, 2, null, null, 835, 0, null, null, 49, '1976-07-27', '130000', 30, 44, 40, 30),
		  (910, 2, null, null, 835, 0, null, null, 49, '1976-07-29', '120000', 31, 132, 40, 32),
		  (917, 3, null, null, 905, 1, null, null, 49, '1976-07-31', '120000', 32, 133, 40, 31);

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
