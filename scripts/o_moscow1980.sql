# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Moscow 1980

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Moscow 1980', '1980-07-20', '1980-08-02', 9, '1980.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (48, 41, 1, 39, 1),
	   (48, 43, 1, 40, 1),
	   (48, 44, 2, 40, 2),
	   (48, 132, 3, 40, 3),
	   (48, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Cuba', 4, 52), ('Venezuela', 4, 206), ('Czechoslovakia', 4, 217), ('Germany DR', 4, 218),
	   ('Syria', 4, 185), ('Finland', 4, 70);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (910, 48, 1, 1),
	   (914, 48, 1, 2),
	   (1087, 48, 1, 3),
	   (908, 48, 1, 4),
	   (916, 48, 2, 1),
	   (899, 48, 2, 2),
	   (840, 48, 2, 3),
	   (839, 48, 2, 4),
	   (917, 48, 3, 1),
	   (850, 48, 3, 2),
	   (881, 48, 3, 3),
	   (918, 48, 3, 4),
	   (911, 48, 4, 1),
	   (1088, 48, 4, 2),
	   (919, 48, 4, 3),
	   (897, 48, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (914, 1, 908, 0, 48, '1980-07-20', '120000', 1, 41, 39),
	   (910, 4, 915, 0, 48, '1980-07-20', '120000', 2, 41, 39),
	   (914, 2, 915, 1, 48, '1980-07-22', '120000', 9, 41, 39),
	   (910, 3, 908, 1, 48, '1980-07-22', '120000', 10, 41, 39),
	   (910, 8, 914, 0, 48, '1980-07-24', '120000', 17, 41, 39),
	   (915, 2, 908, 1, 48, '1980-07-24', '120000', 18, 41, 39),
	   (916, 3, 840, 0, 48, '1980-07-21', '120000', 3, 41, 39),
	   (899, 3, 839, 1, 48, '1980-07-21', '120000', 4, 41, 39),
	   (840, 1, 899, 1, 48, '1980-07-23', '120000', 11, 41, 39),
	   (916, 1, 839, 1, 48, '1980-07-23', '120000', 12, 41, 39),
	   (840, 1, 839, 0, 48, '1980-07-25', '120000', 19, 41, 39),
	   (916, 0, 899, 0, 48, '1980-07-25', '120000', 20, 41, 39),
	   (917, 1, 881, 1, 48, '1980-07-20', '120000', 5, 41, 39),
	   (850, 3, 918, 0, 48, '1980-07-20', '120000', 6, 41, 39),
	   (917, 1, 850, 0, 48, '1980-07-22', '120000', 13, 41, 39),
	   (881, 0, 918, 0, 48, '1980-07-22', '120000', 14, 41, 39),
	   (881, 1, 850, 1, 48, '1980-07-24', '120000', 21, 41, 39),
	   (917, 5, 918, 0, 48, '1980-07-24', '120000', 22, 41, 39),
	   (911, 2, 919, 0, 48, '1980-07-21', '120000', 7, 41, 39),
	   (1088, 3, 897, 0, 48, '1980-07-21', '120000', 8, 41, 39),
	   (911, 3, 897, 2, 48, '1980-07-23', '120000', 15, 41, 39),
	   (919, 0, 1088, 0, 48, '1980-07-23', '120000', 16, 41, 39),
	   (919, 3, 897, 0, 48, '1980-07-25', '120000', 23, 41, 39),
	   (911, 1, 1088, 1, 48, '1980-07-25', '120000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(911, 3, null, null, 850, 0, null, null, 48, '1980-07-27', '120000', 25, 43, 40, 28),
		  (910, 2, null, null, 899, 1, null, null, 48, '1980-07-27', '120000', 26, 43, 40, 25),
		  (916, 3, null, null, 914, 0, null, null, 48, '1980-07-27', '120000', 27, 43, 40, 27),
		  (917, 4, null, null, 1088, 0, null, null, 48, '1980-07-27', '120000', 28, 43, 40, 26),
		  (910, 0, null, null, 917, 1, null, null, 48, '1980-07-29', '120000', 29, 44, 40, 29),
		  (916, 2, null, null, 911, 0, null, null, 48, '1980-07-29', '130000', 30, 44, 40, 30),
		  (910, 2, null, null, 911, 0, null, null, 48, '1980-08-01', '120000', 31, 132, 40, 32),
		  (916, 1, null, null, 917, 0, null, null, 48, '1980-08-02', '120000', 32, 133, 40, 31);

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
