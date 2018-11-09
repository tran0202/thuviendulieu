# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Seoul 1988

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Seoul 1988', '1988-09-17', '1988-10-01', 9, '1988.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (46, 41, 1, 39, 1),
	   (46, 43, 1, 40, 2),
	   (46, 44, 2, 40, 2),
	   (46, 132, 3, 40, 2),
	   (46, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Germany FR', 4, 215), ('Zambia', 4, 210), ('Guatemala', 4, 82), ('Soviet Union', 4, 216),
	   ('Yugoslavia', 4, 214);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (842, 46, 1, 1),
	   (907, 46, 1, 2),
	   (895, 46, 1, 3),
	   (888, 46, 1, 4),
	   (908, 46, 2, 1),
	   (889, 46, 2, 2),
	   (1088, 46, 2, 3),
	   (909, 46, 2, 4),
	   (910, 46, 3, 1),
	   (849, 46, 3, 2),
	   (843, 46, 3, 3),
	   (886, 46, 3, 4),
	   (835, 46, 4, 1),
	   (883, 46, 4, 2),
	   (911, 46, 4, 3),
	   (839, 46, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (888, 0, 907, 3, 46, '1988-09-17', '190000', 1, 41, 39),
	   (842, 2, 895, 2, 46, '1988-09-17', '190000', 2, 41, 39),
	   (895, 1, 907, 4, 46, '1988-09-19', '190000', 9, 41, 39),
	   (888, 0, 842, 2, 46, '1988-09-19', '190000', 10, 41, 39),
	   (888, 0, 895, 0, 46, '1988-09-21', '190000', 17, 41, 39),
	   (842, 2, 907, 1, 46, '1988-09-21', '190000', 18, 41, 39),
	   (889, 5, 909, 2, 46, '1988-09-17', '190000', 3, 41, 39),
	   (908, 2, 1088, 2, 46, '1988-09-17', '190000', 4, 41, 39),
	   (908, 4, 889, 0, 46, '1988-09-19', '190000', 11, 41, 39),
	   (1088, 3, 909, 0, 46, '1988-09-19', '190000', 12, 41, 39),
	   (908, 4, 909, 0, 46, '1988-09-21', '190000', 19, 41, 39),
	   (1088, 0, 889, 2, 46, '1988-09-21', '190000', 20, 41, 39),
	   (843, 0, 910, 0, 46, '1988-09-18', '190000', 5, 41, 39),
	   (886, 1, 849, 1, 46, '1988-09-18', '190000', 6, 41, 39),
	   (843, 0, 886, 0, 46, '1988-09-20', '190000', 13, 41, 39),
	   (849, 1, 910, 2, 46, '1988-09-20', '190000', 14, 41, 39),
	   (843, 1, 849, 2, 46, '1988-09-22', '190000', 21, 41, 39),
	   (886, 2, 910, 4, 46, '1988-09-22', '190000', 22, 41, 39),
	   (883, 1, 911, 0, 46, '1988-09-18', '190000', 7, 41, 39),
	   (835, 4, 839, 0, 46, '1988-09-18', '190000', 8, 41, 39),
	   (839, 1, 911, 3, 46, '1988-09-20', '190000', 15, 41, 39),
	   (883, 0, 835, 3, 46, '1988-09-20', '190000', 16, 41, 39),
	   (835, 2, 911, 1, 46, '1988-09-22', '190000', 23, 41, 39),
	   (883, 1, 839, 0, 46, '1988-09-22', '190000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(842, 1, 0, null, 889, 1, 1, null, 46, '1988-09-25', '190000', 25, 43, 40, 25),
		  (908, 0, null, null, 907, 4, null, null, 46, '1988-09-25', '190000', 26, 43, 40, 27),
		  (910, 3, null, null, 883, 0, null, null, 46, '1988-09-25', '190000', 27, 43, 40, 26),
		  (835, 1, null, null, 849, 0, null, null, 46, '1988-09-25', '190000', 28, 43, 40, 28),
		  (889, 1, 1, null, 910, 1, 2, null, 46, '1988-09-27', '190000', 29, 44, 40, 29),
		  (907, 1, 0, 2, 835, 1, 0, 3, 46, '1988-09-27', '190000', 30, 44, 40, 30),
		  (889, 0, null, null, 907, 3, null, null, 46, '1988-09-30', '190000', 31, 132, 40, 32),
		  (910, 1, 1, null, 835, 1, 0, null, 46, '1988-10-01', '190000', 32, 133, 40, 31);

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
