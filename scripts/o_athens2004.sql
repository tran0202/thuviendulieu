# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Athens 2004

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Athens 2004', '2004-08-11', '2004-08-28', 9, '2004.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (42, 41, 1, 39, 1),
	   (42, 43, 1, 40, 1),
	   (42, 44, 2, 40, 2),
	   (42, 132, 3, 40, 3),
	   (42, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Mali', 4, 121), ('Greece', 4, 79), ('Paraguay', 4, 148), ('Ghana', 4, 77),
	   ('Tunisia', 4, 194), ('Serbia and Montenegro', 4, 213), ('Costa Rica', 4, 49);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (891, 42, 1, 1),
	   (843, 42, 1, 2),
	   (845, 42, 1, 3),
	   (892, 42, 1, 4),
	   (893, 42, 2, 1),
	   (889, 42, 2, 2),
	   (894, 42, 2, 3),
	   (841, 42, 2, 4),
	   (849, 42, 3, 1),
	   (883, 42, 3, 2),
	   (895, 42, 3, 3),
	   (896, 42, 3, 4),
	   (837, 42, 4, 1),
	   (897, 42, 4, 2),
	   (880, 42, 4, 3),
	   (847, 42, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (843, 2, 892, 2, 42, '2004-08-11', '203000', 1, 41, 39),
	   (891, 0, 845, 0, 42, '2004-08-11', '203000', 2, 41, 39),
	   (843, 1, 845, 0, 42, '2004-08-14', '203000', 9, 41, 39),
	   (892, 0, 891, 2, 42, '2004-08-14', '203000', 10, 41, 39),
	   (843, 3, 891, 3, 42, '2004-08-17', '203000', 17, 41, 39),
	   (892, 2, 845, 3, 42, '2004-08-17', '203000', 18, 41, 39),
	   (893, 4, 841, 3, 42, '2004-08-12', '203000', 3, 41, 39),
	   (894, 2, 889, 2, 42, '2004-08-12', '203000', 4, 41, 39),
	   (893, 1, 894, 2, 42, '2004-08-15', '203000', 11, 41, 39),
	   (841, 2, 889, 3, 42, '2004-08-15', '203000', 12, 41, 39),
	   (893, 1, 889, 0, 42, '2004-08-18', '203000', 19, 41, 39),
	   (841, 1, 894, 0, 42, '2004-08-18', '203000', 20, 41, 39),
	   (895, 1, 883, 1, 42, '2004-08-11', '203000', 5, 41, 39),
	   (849, 6, 896, 0, 42, '2004-08-11', '203000', 6, 41, 39),
	   (896, 1, 883, 5, 42, '2004-08-14', '203000', 13, 41, 39),
	   (849, 2, 895, 0, 42, '2004-08-14', '203000', 14, 41, 39),
	   (849, 1, 883, 0, 42, '2004-08-17', '203000', 21, 41, 39),
	   (896, 2, 895, 3, 42, '2004-08-17', '203000', 22, 41, 39),
	   (897, 0, 880, 0, 42, '2004-08-12', '203000', 7, 41, 39),
	   (837, 4, 847, 2, 42, '2004-08-12', '203000', 8, 41, 39),
	   (897, 0, 837, 2, 42, '2004-08-15', '203000', 15, 41, 39),
	   (880, 1, 847, 2, 42, '2004-08-15', '203000', 16, 41, 39),
	   (880, 2, 837, 1, 42, '2004-08-18', '203000', 23, 41, 39),
	   (897, 4, 847, 2, 42, '2004-08-18', '203000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(891, 0, 0, null, 889, 0, 1, null, 42, '2004-08-21', '180000', 25, 43, 40, 25),
		  (837, 1, null, null, 883, 0, null, null, 42, '2004-08-21', '180000', 26, 43, 40, 27),
		  (849, 4, null, null, 897, 0, null, null, 42, '2004-08-21', '210000', 27, 43, 40, 26),
		  (893, 3, null, null, 843, 2, null, null, 42, '2004-08-21', '210000', 28, 43, 40, 28),
		  (889, 0, null, null, 849, 3, null, null, 42, '2004-08-24', '180000', 29, 44, 40, 29),
		  (837, 1, null, null, 893, 3, null, null, 42, '2004-08-24', '210000', 30, 44, 40, 30),
		  (889, 1, null, null, 837, 0, null, null, 42, '2004-08-27', '203000', 31, 132, 40, 32),
		  (849, 1, null, null, 893, 0, null, null, 42, '2004-08-28', '100000', 32, 133, 40, 31);

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
