# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Barcelona 1992

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Barcelona 1992', '1992-07-24', '1992-08-08', 9, '1992.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (45, 41, 1, 39, 1),
	   (45, 43, 1, 40, 1),
	   (45, 44, 2, 40, 2),
	   (45, 45, 3, 40, 3),
	   (45, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Poland', 4, 151), ('Qatar', 4, 154);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (905, 45, 1, 1),
	   (889, 45, 1, 2),
	   (886, 45, 1, 3),
	   (899, 45, 1, 4),
	   (881, 45, 2, 1),
	   (906, 45, 2, 2),
	   (877, 45, 2, 3),
	   (840, 45, 2, 4),
	   (842, 45, 3, 1),
	   (893, 45, 3, 2),
	   (843, 45, 3, 3),
	   (880, 45, 3, 4),
	   (894, 45, 4, 1),
	   (883, 45, 4, 2),
	   (845, 45, 4, 3),
	   (836, 45, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (889, 2, 886, 1, 45, '1992-07-24', '180000', 1, 41, 39),
	   (905, 2, 899, 0, 45, '1992-07-24', '200000', 2, 41, 39),
	   (886, 2, 899, 0, 45, '1992-07-27', '190000', 9, 41, 39),
	   (889, 0, 905, 3, 45, '1992-07-27', '210000', 10, 41, 39),
	   (886, 2, 905, 2, 45, '1992-07-29', '190000', 17, 41, 39),
	   (889, 1, 899, 0, 45, '1992-07-29', '210000', 18, 41, 39),
	   (881, 4, 840, 0, 45, '1992-07-24', '210000', 3, 41, 39),
	   (877, 0, 906, 1, 45, '1992-07-24', '200000', 4, 41, 39),
	   (881, 2, 877, 0, 45, '1992-07-27', '210000', 11, 41, 39),
	   (840, 1, 906, 1, 45, '1992-07-27', '190000', 12, 41, 39),
	   (881, 2, 906, 0, 45, '1992-07-29', '210000', 19, 41, 39),
	   (840, 3, 877, 4, 45, '1992-07-29', '190000', 20, 41, 39),
	   (842, 0, 893, 0, 45, '1992-07-26', '210000', 5, 41, 39),
	   (880, 1, 843, 1, 45, '1992-07-26', '210000', 6, 41, 39),
	   (842, 4, 880, 0, 45, '1992-07-28', '190000', 13, 41, 39),
	   (893, 0, 843, 0, 45, '1992-07-28', '210000', 14, 41, 39),
	   (842, 1, 843, 1, 45, '1992-07-30', '210000', 21, 41, 39),
	   (893, 3, 880, 1, 45, '1992-07-30', '210000', 22, 41, 39),
	   (836, 1, 845, 1, 45, '1992-07-26', '190000', 7, 41, 39),
	   (894, 3, 883, 1, 45, '1992-07-26', '190000', 8, 41, 39),
	   (836, 0, 894, 0, 45, '1992-07-28', '190000', 15, 41, 39),
	   (845, 1, 883, 1, 45, '1992-07-28', '210000', 16, 41, 39),
	   (836, 0, 883, 3, 45, '1992-07-30', '190000', 23, 41, 39),
	   (845, 1, 894, 1, 45, '1992-07-30', '190000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(881, 1, null, null, 889, 0, null, null, 45, '1992-08-01', '190000', 25, 43, 40, 25),
		  (905, 2, null, null, 906, 0, null, null, 45, '1992-08-01', '213000', 26, 43, 40, 27),
		  (893, 2, 0, null, 894, 2, 4, null, 45, '1992-08-02', '190000', 27, 43, 40, 26),
		  (842, 1, null, null, 883, 2, null, null, 45, '1992-08-02', '210000', 28, 43, 40, 28),
		  (881, 2, null, null, 894, 0, null, null, 45, '1992-08-05', '190000', 29, 44, 40, 29),
		  (905, 6, null, null, 883, 1, null, null, 45, '1992-08-05', '210000', 30, 44, 40, 30),
		  (883, 0, null, null, 894, 1, null, null, 45, '1992-08-07', '200000', 31, 132, 40, 32),
		  (905, 2, null, null, 881, 3, null, null, 45, '1992-08-08', '200000', 32, 133, 40, 31);

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
