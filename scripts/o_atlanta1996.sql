# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Atlanta 1996

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Atlanta 1996', '1996-07-20', '1996-08-03', 9, '1996.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (44, 41, 1, 39, 1),
	   (44, 43, 1, 40, 1),
	   (44, 44, 2, 40, 2),
	   (44, 45, 3, 40, 3),
	   (44, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('France', 4, 71), ('Saudi Arabia', 4, 162), ('Hungary', 4, 89);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (849, 44, 1, 1),
	   (847, 44, 1, 2),
	   (886, 44, 1, 3),
	   (895, 44, 1, 4),
	   (902, 44, 2, 1),
	   (881, 44, 2, 2),
	   (883, 44, 2, 3),
	   (903, 44, 2, 4),
	   (845, 44, 3, 1),
	   (894, 44, 3, 2),
	   (843, 44, 3, 3),
	   (889, 44, 3, 4),
	   (835, 44, 4, 1),
	   (839, 44, 4, 2),
	   (841, 44, 4, 3),
	   (904, 44, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (847, 2, 895, 0, 44, '1996-07-20', '150000', 1, 41, 39),
	   (886, 1, 849, 3, 44, '1996-07-20', '193000', 2, 41, 39),
	   (849, 1, 847, 1, 44, '1996-07-22', '193000', 9, 41, 39),
	   (886, 2, 895, 0, 44, '1996-07-22', '193000', 10, 41, 39),
	   (849, 1, 895, 1, 44, '1996-07-24', '193000', 17, 41, 39),
	   (886, 1, 847, 1, 44, '1996-07-24', '193000', 18, 41, 39),
	   (881, 1, 903, 0, 44, '1996-07-20', '183000', 3, 41, 39),
	   (902, 2, 883, 0, 44, '1996-07-20', '183000', 4, 41, 39),
	   (902, 1, 881, 1, 44, '1996-07-22', '190000', 11, 41, 39),
	   (883, 2, 903, 1, 44, '1996-07-22', '190000', 12, 41, 39),
	   (881, 3, 883, 2, 44, '1996-07-24', '190000', 19, 41, 39),
	   (902, 2, 903, 1, 44, '1996-07-24', '190000', 20, 41, 39),
	   (843, 1, 894, 0, 44, '1996-07-21', '120000', 5, 41, 39),
	   (845, 1, 889, 0, 44, '1996-07-21', '170000', 6, 41, 39),
	   (845, 0, 843, 0, 44, '1996-07-23', '200000', 13, 41, 39),
	   (894, 3, 889, 2, 44, '1996-07-23', '210000', 14, 41, 39),
	   (845, 1, 894, 1, 44, '1996-07-25', '210000', 21, 41, 39),
	   (889, 2, 843, 1, 44, '1996-07-25', '210000', 22, 41, 39),
	   (841, 1, 835, 0, 44, '1996-07-21', '183000', 7, 41, 39),
	   (839, 1, 904, 0, 44, '1996-07-21', '183000', 8, 41, 39),
	   (835, 3, 904, 1, 44, '1996-07-23', '203000', 15, 41, 39),
	   (839, 2, 841, 0, 44, '1996-07-23', '203000', 16, 41, 39),
	   (835, 1, 839, 0, 44, '1996-07-25', '210000', 23, 41, 39),
	   (841, 3, 904, 2, 44, '1996-07-25', '210000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(847, 1, 1, null, 902, 1, 0, null, 44, '1996-07-27', '180000', 25, 43, 40, 25),
		  (849, 4, null, null, 881, 0, null, null, 44, '1996-07-27', '193000', 26, 43, 40, 26),
		  (845, 0, null, null, 839, 2, null, null, 44, '1996-07-28', '160000', 27, 43, 40, 27),
		  (835, 4, null, null, 894, 2, null, null, 44, '1996-07-28', '180000', 28, 43, 40, 28),
		  (847, 0, null, null, 849, 2, null, null, 44, '1996-07-30', '180000', 29, 44, 40, 29),
		  (839, 3, 1, null, 835, 3, 0, null, 44, '1996-07-31', '180000', 30, 44, 40, 30),
		  (835, 5, null, null, 847, 0, null, null, 44, '1996-08-02', '180000', 31, 132, 40, 32),
		  (839, 3, null, null, 849, 2, null, null, 44, '1996-08-03', '154500', 32, 133, 40, 31);

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
