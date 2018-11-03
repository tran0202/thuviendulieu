# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Munich 1972

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Munich 1972', '1972-08-27', '1972-09-10', 9, '1972.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (50, 41, 1, 39, 1),
	   (50, 48, 1, 39, 1),
	   (50, 132, 3, 40, 3),
	   (50, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Malaysia', 4, 119), ('Myanmar', 4, 132), ('Sudan', 4, 180);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (907, 50, 1, 1),
	   (880, 50, 1, 2),
	   (923, 50, 1, 3),
	   (886, 50, 1, 4),
	   (910, 50, 2, 1),
	   (845, 50, 2, 2),
	   (924, 50, 2, 3),
	   (925, 50, 2, 4),
	   (904, 50, 3, 1),
	   (836, 50, 3, 2),
	   (1083, 50, 3, 3),
	   (835, 50, 3, 4),
	   (905, 50, 4, 1),
	   (917, 50, 4, 2),
	   (840, 50, 4, 3),
	   (894, 50, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (880, 0, 886, 0, 50, '1972-08-27', '120000', 1, 41, 39),
	   (907, 3, 923, 0, 50, '1972-08-27', '120000', 2, 41, 39),
	   (923, 3, 886, 0, 50, '1972-08-29', '120000', 9, 41, 39),
	   (907, 3, 880, 0, 50, '1972-08-29', '120000', 10, 41, 39),
	   (907, 7, 886, 0, 50, '1972-08-31', '120000', 17, 41, 39),
	   (880, 6, 923, 0, 50, '1972-08-31', '120000', 18, 41, 39),
	   (910, 1, 924, 0, 50, '1972-08-28', '120000', 3, 41, 39),
	   (845, 1, 925, 0, 50, '1972-08-28', '120000', 4, 41, 39),
	   (845, 1, 924, 0, 50, '1972-08-30', '120000', 11, 41, 39),
	   (910, 2, 925, 1, 50, '1972-08-30', '120000', 12, 41, 39),
	   (924, 2, 925, 0, 50, '1972-09-01', '120000', 19, 41, 39),
	   (910, 4, 845, 1, 50, '1972-09-01', '120000', 20, 41, 39),
	   (904, 5, 1083, 0, 50, '1972-08-27', '120000', 5, 41, 39),
	   (836, 3, 835, 2, 50, '1972-08-27', '120000', 6, 41, 39),
	   (836, 4, 1083, 0, 50, '1972-08-29', '120000', 13, 41, 39),
	   (904, 2, 835, 2, 50, '1972-08-29', '120000', 14, 41, 39),
	   (1083, 1, 835, 0, 50, '1972-08-31', '120000', 21, 41, 39),
	   (836, 0, 904, 2, 50, '1972-08-31', '120000', 22, 41, 39),
	   (917, 4, 894, 0, 50, '1972-08-28', '120000', 7, 41, 39),
	   (905, 5, 840, 1, 50, '1972-08-28', '120000', 8, 41, 39),
	   (917, 6, 840, 1, 50, '1972-08-30', '120000', 15, 41, 39),
	   (905, 4, 894, 0, 50, '1972-08-30', '120000', 16, 41, 39),
	   (840, 3, 894, 1, 50, '1972-09-01', '120000', 23, 41, 39),
	   (904, 2, 917, 1, 50, '1972-09-01', '120000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id, group_id)
VALUES (904, 2, 917, 0, 50, '1972-09-03', '120000', 25, 48, 39, 1),
	   (907, 1, 845, 1, 50, '1972-09-03', '120000', 26, 48, 39, 1),
	   (910, 3, 880, 0, 50, '1972-09-03', '120000', 27, 48, 39, 2),
	   (836, 1, 905, 1, 50, '1972-09-03', '120000', 28, 48, 39, 2),
	   (917, 7, 845, 0, 50, '1972-09-05', '120000', 29, 48, 39, 2),
	   (910, 3, 905, 0, 50, '1972-09-05', '120000', 30, 48, 39, 1),
	   (836, 3, 880, 1, 50, '1972-09-05', '120000', 31, 48, 39, 1),
	   (904, 4, 907, 1, 50, '1972-09-06', '120000', 32, 48, 39, 2),
	   (904, 2, 845, 0, 50, '1972-09-08', '120000', 33, 48, 39, 1),
	   (917, 3, 907, 2, 50, '1972-09-08', '120000', 34, 48, 39, 1),
	   (910, 4, 836, 0, 50, '1972-09-08', '120000', 35, 48, 39, 2),
	   (905, 5, 880, 0, 50, '1972-09-08', '120000', 36, 48, 39, 2);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES	(910, 2, null, null, 917, 2, null, null, 50, '1972-09-10', '120000', 37, 132, 40, 38),
		  (905, 2, null, null, 904, 1, null, null, 50, '1972-09-10', '120000', 38, 133, 40, 37);

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
