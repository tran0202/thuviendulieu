# Insert new tournament
# Replace all the tournament_id

# Euro 2016 France

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('UEFA Euro 2016 France', '2016-06-10', '2016-07-10', 11, 'Euro_2016.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (68, 41, 1, 39, 1),
	   (68, 42, 1, 40, 1),
	   (68, 43, 2, 40, 2),
	   (68, 44, 3, 40, 3),
	   (68, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Great Britain', 4, 212), ('Senegal', 4, 164), ('Uruguay', 4, 201), ('United Arab Emirates', 4, 200),
# 	   ('Gabon', 4, 73), ('Switzerland', 4, 184), ('Egypt', 4, 61), ('Belarus', 4, 19),
# 	   ('New Zealand', 4, 137), ('Morocco', 4, 130), ('Spain', 4, 175);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (21, 68, 1, 1),
	   (26, 68, 1, 2),
	   (247, 68, 1, 3),
	   (226, 68, 1, 4),
	   (243, 68, 2, 1),
	   (20, 68, 2, 2),
	   (209, 68, 2, 3),
	   (23, 68, 2, 4),
	   (2, 68, 3, 1),
	   (7, 68, 3, 2),
	   (234, 68, 3, 3),
	   (215, 68, 3, 4),
	   (18, 68, 4, 1),
	   (6, 68, 4, 2),
	   (218, 68, 4, 3),
	   (213, 68, 4, 4),
	   (203, 68, 5, 1),
	   (5, 68, 5, 2),
	   (217, 68, 5, 3),
	   (25, 68, 5, 4),
	   (233, 68, 6, 1),
	   (22, 68, 6, 2),
	   (4, 68, 6, 3),
	   (222, 68, 6, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (21, 2, 226, 1, 68, '2016-06-10', '210000', 1, 41, 39),
	   (247, 0, 26, 1, 68, '2016-06-11', '150000', 2, 41, 39),
	   (243, 2, 209, 1, 68, '2016-06-11', '180000', 3, 41, 39),
	   (20, 1, 23, 1, 68, '2016-06-11', '210000', 4, 41, 39),
	   (7, 1, 234, 0, 68, '2016-06-12', '180000', 5, 41, 39),
	   (2, 2, 215, 0, 68, '2016-06-12', '210000', 6, 41, 39),
	   (218, 0, 18, 1, 68, '2016-06-12', '150000', 7, 41, 39),
	   (6, 1, 213, 0, 68, '2016-06-13', '150000', 8, 41, 39),
	   (217, 1, 25, 1, 68, '2016-06-13', '180000', 9, 41, 39),
	   (5, 0, 203, 2, 68, '2016-06-13', '210000', 10, 41, 39),
	   (222, 0, 233, 2, 68, '2016-06-14', '180000', 11, 41, 39),
	   (4, 1, 22, 1, 68, '2016-06-14', '210000', 12, 41, 39),
	   (226, 1, 26, 1, 68, '2016-06-15', '180000', 13, 41, 39),
	   (21, 2, 247, 0, 68, '2016-06-15', '210000', 14, 41, 39),
	   (23, 1, 209, 2, 68, '2016-06-15', '150000', 15, 41, 39),
	   (20, 2, 243, 1, 68, '2016-06-16', '150000', 16, 41, 39),
	   (215, 0, 234, 2, 68, '2016-06-16', '180000', 17, 41, 39),
	   (2, 0, 7, 0, 68, '2016-06-16', '210000', 18, 41, 39),
	   (213, 2, 18, 2, 68, '2016-06-17', '180000', 19, 41, 39),
	   (6, 3, 218, 0, 68, '2016-06-17', '210000', 20, 41, 39),
	   (203, 1, 25, 0, 68, '2016-06-17', '150000', 21, 41, 39),
	   (5, 3, 217, 0, 68, '2016-06-18', '150000', 22, 41, 39),
	   (22, 1, 233, 1, 68, '2016-06-18', '180000', 23, 41, 39),
	   (4, 0, 222, 0, 68, '2016-06-18', '210000', 24, 41, 39),
	   (226, 0, 247, 1, 68, '2016-06-19', '210000', 25, 41, 39),
	   (26, 0, 20, 0, 68, '2016-06-19', '210000', 26, 41, 39),
	   (23, 0, 243, 3, 68, '2016-06-20', '210000', 27, 41, 39),
	   (209, 0, 20, 0, 68, '2016-06-20', '210000', 28, 41, 39),
	   (215, 0, 7, 1, 68, '2016-06-21', '180000', 29, 41, 39),
	   (234, 0, 2, 1, 68, '2016-06-21', '180000', 30, 41, 39),
	   (213, 0, 218, 2, 68, '2016-06-21', '210000', 31, 41, 39),
	   (18, 2, 6, 1, 68, '2016-06-21', '210000', 32, 41, 39),
	   (203, 0, 217, 1, 68, '2016-06-22', '210000', 33, 41, 39),
	   (25, 0, 5, 1, 68, '2016-06-22', '210000', 34, 41, 39),
	   (22, 2, 222, 1, 68, '2016-06-22', '180000', 35, 41, 39),
	   (233, 3, 4, 3, 68, '2016-06-22', '180000', 36, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(26, 1, 0, 4, 7, 1, 0, 5, 68, '2016-06-25', '150000', 37, 42, 40, 37),
		  (243, 1, null, null, 234, 0, null, null, 68, '2016-06-25', '180000', 38, 42, 40, 39),
		  (18, 0, 0, null, 4, 0, 1, null, 68, '2016-06-25', '210000', 39, 42, 40, 38),
		  (21, 2, null, null, 217, 1, null, null, 68, '2016-06-26', '150000', 40, 42, 40, 43),
		  (2, 3, null, null, 209, 0, null, null, 68, '2016-06-26', '180000', 41, 42, 40, 41),
		  (233, 0, null, null, 5, 4, null, null, 68, '2016-06-26', '210000', 42, 42, 40, 40),
		  (203, 2, null, null, 6, 0, null, null, 68, '2016-06-27', '180000', 43, 42, 40, 42),
		  (20, 1, null, null, 22, 2, null, null, 68, '2016-06-27', '210000', 44, 42, 40, 44),
		  (7, 1, 0, 3, 4, 1, 0, 5, 68, '2016-06-30', '210000', 45, 43, 40, 45),
	   	(243, 3, null, null, 5, 1, null, null, 68, '2016-07-01', '210000', 46, 43, 40, 46),
		(2, 1, 0, 6, 203, 1, 0, 5, 68, '2016-07-02', '210000', 47, 43, 40, 47),
		(21, 5, null, null, 22, 2, null, null, 68, '2016-07-03', '210000', 48, 43, 40, 48),
		(4, 2, null, null, 243, 0, null, null, 68, '2016-07-06', '210000', 49, 44, 40, 49),
		(2, 0, null, null, 21, 2, null, null, 68, '2016-07-07', '210000', 50, 44, 40, 50),
		(4, 0, 1, null, 21, 0, 0, null, 68, '2016-07-10', '210000', 51, 46, 40, 51);

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
