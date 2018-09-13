# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Sydney 2000

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Sydney 2000', '2000-09-15', '2000-09-30', 9, '2000.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (43, 41, 1, 39, 1),
	   (43, 43, 1, 40, 1),
	   (43, 44, 2, 40, 2),
	   (43, 132, 3, 40, 3),
	   (43, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Chile', 4, 41), ('Kuwait', 4, 105), ('Czech Republic', 4, 55), ('Slovakia', 4, 169);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (889, 43, 1, 1),
	   (839, 43, 1, 2),
	   (848, 43, 1, 3),
	   (883, 43, 1, 4),
	   (898, 43, 2, 1),
	   (881, 43, 2, 2),
	   (843, 43, 2, 3),
	   (880, 43, 2, 4),
	   (886, 43, 3, 1),
	   (890, 43, 3, 2),
	   (899, 43, 3, 3),
	   (900, 43, 3, 4),
	   (835, 43, 4, 1),
	   (841, 43, 4, 2),
	   (838, 43, 4, 3),
	   (901, 43, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (839, 3, 848, 3, 43, '2000-09-13', '183000', 1, 41, 39),
	   (883, 0, 889, 1, 43, '2000-09-13', '200000', 2, 41, 39),
	   (889, 3, 848, 1, 43, '2000-09-16', '183000', 9, 41, 39),
	   (883, 2, 839, 3, 43, '2000-09-16', '200000', 10, 41, 39),
	   (889, 1, 839, 1, 43, '2000-09-19', '183000', 17, 41, 39),
	   (883, 1, 848, 2, 43, '2000-09-19', '200000', 18, 41, 39),
	   (843, 0, 881, 3, 43, '2000-09-14', '183000', 3, 41, 39),
	   (880, 1, 898, 4, 43, '2000-09-14', '200000', 4, 41, 39),
	   (843, 1, 880, 0, 43, '2000-09-17', '183000', 11, 41, 39),
	   (881, 1, 898, 3, 43, '2000-09-17', '200000', 12, 41, 39),
	   (843, 1, 898, 0, 43, '2000-09-20', '183000', 19, 41, 39),
	   (881, 2, 880, 0, 43, '2000-09-20', '200000', 20, 41, 39),
	   (890, 3, 899, 2, 43, '2000-09-13', '190000', 5, 41, 39),
	   (886, 2, 900, 2, 43, '2000-09-13', '200000', 6, 41, 39),
	   (900, 2, 899, 3, 43, '2000-09-16', '190000', 13, 41, 39),
	   (886, 1, 890, 1, 43, '2000-09-16', '200000', 14, 41, 39),
	   (900, 1, 890, 1, 43, '2000-09-19', '190000', 21, 41, 39),
	   (886, 3, 899, 1, 43, '2000-09-19', '200000', 22, 41, 39),
	   (835, 3, 901, 1, 43, '2000-09-14', '190000', 7, 41, 39),
	   (838, 1, 841, 2, 43, '2000-09-14', '200000', 8, 41, 39),
	   (835, 1, 838, 3, 43, '2000-09-17', '190000', 15, 41, 39),
	   (901, 1, 841, 2, 43, '2000-09-17', '200000', 16, 41, 39),
	   (835, 1, 841, 0, 43, '2000-09-20', '190000', 23, 41, 39),
	   (901, 2, 838, 1, 43, '2000-09-20', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(886, 2, 0, 5, 841, 2, 0, 4, 43, '2000-09-23', '183000', 25, 43, 40, 25),
		  (835, 1, 0, null, 890, 1, 1, null, 43, '2000-09-23', '190000', 26, 43, 40, 27),
		  (889, 0, null, null, 881, 1, null, null, 43, '2000-09-23', '200000', 27, 43, 40, 26),
		  (898, 4, null, null, 839, 1, null, null, 43, '2000-09-23', '200000', 28, 43, 40, 28),
		  (881, 3, null, null, 886, 1, null, null, 43, '2000-09-26', '200000', 29, 44, 40, 29),
		  (898, 1, null, null, 890, 2, null, null, 43, '2000-09-26', '210000', 30, 44, 40, 30),
		  (886, 0, null, null, 898, 2, null, null, 43, '2000-09-29', '200000', 31, 132, 40, 32),
		  (881, 2, 0, 3, 890, 2, 0, 5, 43, '2000-09-30', '120000', 32, 133, 40, 31);

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
