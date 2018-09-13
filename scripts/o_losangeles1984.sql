# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Los Angeles 1984

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Los Angeles 1984', '1984-07-29', '1984-08-11', 9, '1984.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (47, 41, 1, 39, 1),
	   (47, 43, 1, 40, 1),
	   (47, 44, 2, 40, 2),
	   (47, 132, 3, 40, 3),
	   (47, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Norway', 4, 142), ('Canada', 4, 36);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (902, 47, 1, 1),
	   (898, 47, 1, 2),
	   (912, 47, 1, 3),
	   (906, 47, 1, 4),
	   (911, 47, 2, 1),
	   (913, 47, 2, 2),
	   (890, 47, 2, 3),
	   (837, 47, 2, 4),
	   (835, 47, 3, 1),
	   (907, 47, 3, 2),
	   (880, 47, 3, 3),
	   (903, 47, 3, 4),
	   (889, 47, 4, 1),
	   (877, 47, 4, 2),
	   (886, 47, 4, 3),
	   (897, 47, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (912, 0, 898, 0, 47, '1984-07-29', '193000', 1, 41, 39),
	   (902, 2, 906, 2, 47, '1984-07-29', '193000', 2, 41, 39),
	   (912, 1, 902, 2, 47, '1984-07-31', '190000', 9, 41, 39),
	   (898, 1, 906, 0, 47, '1984-07-31', '190000', 10, 41, 39),
	   (906, 0, 912, 2, 47, '1984-08-02', '190000', 17, 41, 39),
	   (898, 1, 902, 1, 47, '1984-08-02', '190000', 18, 41, 39),
	   (913, 1, 837, 1, 47, '1984-07-30', '193000', 3, 41, 39),
	   (911, 2, 890, 1, 47, '1984-07-30', '190000', 4, 41, 39),
	   (890, 1, 837, 0, 47, '1984-08-01', '190000', 11, 41, 39),
	   (911, 1, 913, 0, 47, '1984-08-01', '190000', 12, 41, 39),
	   (890, 1, 913, 3, 47, '1984-08-03', '190000', 19, 41, 39),
	   (837, 2, 911, 4, 47, '1984-08-03', '190000', 20, 41, 39),
	   (907, 2, 880, 0, 47, '1984-07-30', '193000', 5, 41, 39),
	   (835, 3, 903, 1, 47, '1984-07-30', '190000', 6, 41, 39),
	   (835, 1, 907, 0, 47, '1984-08-01', '190000', 13, 41, 39),
	   (880, 1, 903, 0, 47, '1984-08-01', '190000', 14, 41, 39),
	   (903, 0, 907, 6, 47, '1984-08-03', '190000', 21, 41, 39),
	   (880, 0, 835, 2, 47, '1984-08-03', '190000', 22, 41, 39),
	   (886, 3, 897, 0, 47, '1984-07-29', '193000', 7, 41, 39),
	   (889, 1, 877, 0, 47, '1984-07-29', '193000', 8, 41, 39),
	   (877, 4, 897, 1, 47, '1984-07-31', '190000', 15, 41, 39),
	   (889, 1, 886, 0, 47, '1984-07-31', '190000', 16, 41, 39),
	   (877, 1, 886, 1, 47, '1984-08-02', '190000', 23, 41, 39),
	   (897, 1, 889, 0, 47, '1984-08-02', '190000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(889, 0, 1, null, 898, 0, 0, null, 47, '1984-08-05', '150000', 25, 43, 40, 27),
		  (902, 2, null, null, 877, 0, null, null, 47, '1984-08-05', '190000', 26, 43, 40, 25),
		  (835, 1, 0, 4, 913, 1, 0, 2, 47, '1984-08-06', '170000', 27, 43, 40, 28),
		  (911, 5, null, null, 907, 2, null, null, 47, '1984-08-06', '190000', 28, 43, 40, 26),
		  (902, 2, 2, null, 911, 2, 0, null, 47, '1984-08-08', '181500', 29, 44, 40, 29),
		  (889, 1, 0, null, 835, 1, 1, null, 47, '1984-08-08', '203000', 30, 44, 40, 30),
		  (911, 2, null, null, 889, 1, null, null, 47, '1984-08-10', '190000', 31, 132, 40, 32),
		  (902, 2, null, null, 835, 0, null, null, 47, '1988-08-11', '190000', 32, 133, 40, 31);

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
