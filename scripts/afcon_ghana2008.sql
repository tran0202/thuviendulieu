# Insert new tournament
# Replace all the tournament_id

# 2008 Africa Cup of Nations Ghana

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2008 Africa Cup of Nations Ghana', '2008-01-20', '2008-02-10', 14, 'afcon_2008.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (157, 41, 1, 39, 1),
	   (157, 43, 1, 40, 1),
	   (157, 44, 2, 40, 2),
	   (157, 45, 3, 40, 3),
	   (157, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Namibia', 1, 133);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (195, 157, 1, 1),
	   (985, 157, 1, 2),
	   (9, 157, 1, 3),
	   (994, 157, 1, 4),
	   (196, 157, 2, 1),
	   (10, 157, 2, 2),
	   (979, 157, 2, 3),
	   (992, 157, 2, 4),
	   (8, 157, 3, 1),
	   (194, 157, 3, 2),
	   (984, 157, 3, 3),
	   (989, 157, 3, 4),
	   (12, 157, 4, 1),
	   (212, 157, 4, 2),
	   (11, 157, 4, 3),
	   (205, 157, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (195, 2, 985, 1, 157, '2008-01-20', '170000', 1, 41, 39),
	   (994, 1, 9, 5, 157, '2008-01-21', '150000', 2, 41, 39),
	   (10, 0, 196, 1, 157, '2008-01-21', '170000', 3, 41, 39),
	   (979, 1, 992, 0, 157, '2008-01-21', '194500', 4, 41, 39),
	   (8, 4, 194, 2, 157, '2008-01-22', '170000', 5, 41, 39),
	   (989, 0, 984, 3, 157, '2008-01-22', '193000', 6, 41, 39),
	   (12, 2, 11, 2, 157, '2008-01-23', '170000', 7, 41, 39),
	   (205, 1, 212, 1, 157, '2008-01-23', '193000', 8, 41, 39),
	   (985, 3, 9, 2, 157, '2008-01-24', '170000', 9, 41, 39),
	   (195, 1, 994, 0, 157, '2008-01-24', '193000', 10, 41, 39),
	   (196, 4, 992, 1, 157, '2008-01-25', '170000', 11, 41, 39),
	   (10, 0, 979, 0, 157, '2008-01-25', '193000', 12, 41, 39),
	   (194, 5, 984, 1, 157, '2008-01-26', '170000', 13, 41, 39),
	   (8, 3, 989, 0, 157, '2008-01-26', '193000', 14, 41, 39),
	   (11, 1, 212, 3, 157, '2008-01-27', '170000', 15, 41, 39),
	   (12, 3, 205, 1, 157, '2008-01-27', '193000', 16, 41, 39),
	   (195, 2, 9, 0, 157, '2008-01-28', '170000', 17, 41, 39),
	   (985, 1, 994, 1, 157, '2008-01-28', '170000', 18, 41, 39),
	   (10, 2, 992, 0, 157, '2008-01-29', '170000', 19, 41, 39),
	   (196, 3, 979, 0, 157, '2008-01-29', '170000', 20, 41, 39),
	   (194, 3, 989, 0, 157, '2008-01-30', '170000', 21, 41, 39),
	   (8, 1, 984, 1, 157, '2008-01-30', '170000', 22, 41, 39),
	   (11, 1, 205, 1, 157, '2008-01-31', '170000', 23, 41, 39),
	   (12, 0, 212, 0, 157, '2008-01-31', '170000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (195, 2, null, null, 10, 1, null, null, 157, '2008-02-03', '170000', 25, 43, 40, 25),
	   (196, 5, null, null, 985, 0, null, null, 157, '2008-02-03', '203000', 26, 43, 40, 27),
	   (8, 2, null, null, 212, 1, null, null, 157, '2008-02-04', '170000', 27, 43, 40, 28),
	   (12, 2, 0, null, 194, 2, 1, null, 157, '2008-02-04', '203000', 28, 43, 40, 26),
	   (195, 0, null, null, 194, 1, null, null, 157, '2008-02-07', '170000', 29, 44, 40, 29),
	   (196, 1, null, null, 8, 4, null, null, 157, '2008-02-07', '203000', 30, 44, 40, 30),
	   (195, 4, null, null, 196, 2, null, null, 157, '2008-02-09', '170000', 31, 45, 40, 32),
	   (194, 0, null, null, 8, 1, null, null, 157, '2008-02-10', '170000', 32, 46, 40, 31);

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
