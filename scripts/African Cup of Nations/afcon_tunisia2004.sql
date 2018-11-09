# Insert new tournament
# Replace all the tournament_id

# 2004 African Cup of Nations Tunisia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2004 African Cup of Nations Tunisia', '2004-01-24', '2004-02-14', 14, 'afcon_2004.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (159, 41, 1, 39, 1),
	   (159, 43, 1, 40, 2),
	   (159, 44, 2, 40, 2),
	   (159, 45, 3, 40, 2),
	   (159, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Rwanda', 1, 158),
	   ('Kenya', 1, 101);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (12, 159, 1, 1),
	   (985, 159, 1, 2),
	   (995, 159, 1, 3),
	   (1107, 159, 1, 4),
	   (979, 159, 2, 1),
	   (11, 159, 2, 2),
	   (996, 159, 2, 3),
	   (975, 159, 2, 4),
	   (194, 159, 3, 1),
	   (193, 159, 3, 2),
	   (8, 159, 3, 3),
	   (978, 159, 3, 4),
	   (9, 159, 4, 1),
	   (10, 159, 4, 2),
	   (205, 159, 4, 3),
	   (992, 159, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (12, 2, 995, 1, 159, '2004-01-24', '193000', 1, 41, 39),
	   (1107, 1, 985, 2, 159, '2004-01-25', '140000', 2, 41, 39),
	   (978, 1, 8, 2, 159, '2004-01-25', '163000', 3, 41, 39),
	   (194, 1, 193, 1, 159, '2004-01-25', '190000', 4, 41, 39),
	   (996, 1, 979, 3, 159, '2004-01-26', '140000', 5, 41, 39),
	   (11, 0, 975, 0, 159, '2004-01-26', '190000', 6, 41, 39),
	   (10, 0, 9, 1, 159, '2004-01-27', '140000', 7, 41, 39),
	   (205, 2, 992, 0, 159, '2004-01-27', '180000', 8, 41, 39),
	   (995, 1, 985, 1, 159, '2004-01-28', '140000', 9, 41, 39),
	   (12, 3, 1107, 0, 159, '2004-01-28', '161500', 10, 41, 39),
	   (194, 5, 978, 3, 159, '2004-01-29', '163000', 11, 41, 39),
	   (193, 2, 8, 1, 159, '2004-01-29', '190000', 12, 41, 39),
	   (11, 3, 996, 0, 159, '2004-01-30', '140000', 13, 41, 39),
	   (975, 1, 979, 3, 159, '2004-01-30', '190000', 14, 41, 39),
	   (10, 4, 205, 0, 159, '2004-01-31', '140000', 15, 41, 39),
	   (9, 4, 992, 0, 159, '2004-01-31', '180000', 16, 41, 39),
	   (12, 1, 985, 1, 159, '2004-02-01', '140000', 17, 41, 39),
	   (995, 1, 1107, 0, 159, '2004-02-01', '140000', 18, 41, 39),
	   (11, 1, 979, 1, 159, '2004-02-02', '140000', 19, 41, 39),
	   (975, 0, 996, 3, 159, '2004-02-02', '140000', 20, 41, 39),
	   (194, 0, 8, 0, 159, '2004-02-03', '140000', 21, 41, 39),
	   (193, 1, 978, 2, 159, '2004-02-03', '140000', 22, 41, 39),
	   (9, 1, 205, 1, 159, '2004-02-04', '180000', 23, 41, 39),
	   (10, 2, 992, 1, 159, '2004-02-04', '180000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (979, 2, null, null, 985, 1, null, null, 159, '2004-02-07', '140000', 25, 43, 40, 28),
	   (12, 1, null, null, 11, 0, null, null, 159, '2004-02-07', '170000', 26, 43, 40, 25),
	   (194, 1, null, null, 10, 2, null, null, 159, '2004-02-08', '140000', 27, 43, 40, 26),
	   (9, 1, 2, null, 193, 1, 0, null, 159, '2004-02-08', '170000', 28, 43, 40, 27),
	   (12, 1, 0, 5, 10, 1, 0, 3, 159, '2004-02-11', '160000', 29, 44, 40, 29),
	   (9, 4, null, null, 979, 0, null, null, 159, '2004-02-11', '190000', 30, 44, 40, 30),
	   (10, 2, null, null, 979, 1, null, null, 159, '2004-02-13', '200000', 31, 45, 40, 32),
	   (12, 2, null, null, 9, 1, null, null, 159, '2004-02-14', '143000', 32, 46, 40, 31);

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
