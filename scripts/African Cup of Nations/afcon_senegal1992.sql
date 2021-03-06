# Insert new tournament
# Replace all the tournament_id

# 1992 African Cup of Nations Senegal

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1992 African Cup of Nations Senegal', '1992-01-12', '1992-01-26', 14, 'Africa_Cup_of_Nations.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (167, 41, 1, 39, 1),
	   (167, 43, 1, 40, 2),
	   (167, 44, 2, 40, 2),
	   (167, 45, 3, 40, 2),
	   (167, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Sierra Leone', 1, 167);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (10, 167, 1, 1),
	   (11, 167, 1, 2),
	   (996, 167, 1, 3),
	   (194, 167, 2, 1),
	   (239, 167, 2, 2),
	   (9, 167, 2, 3),
	   (196, 167, 3, 1),
	   (981, 167, 3, 2),
	   (193, 167, 3, 3),
	   (195, 167, 4, 1),
	   (984, 167, 4, 2),
	   (8, 167, 4, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (10, 2, 11, 1, 167, '1992-01-12', '190000', 1, 41, 39),
	   (194, 1, 9, 0, 167, '1992-01-12', '190000', 2, 41, 39),
	   (196, 3, 193, 0, 167, '1992-01-13', '190000', 3, 41, 39),
	   (984, 1, 8, 0, 167, '1992-01-13', '190000', 4, 41, 39),
	   (10, 2, 996, 1, 167, '1992-01-14', '190000', 5, 41, 39),
	   (9, 1, 239, 1, 167, '1992-01-14', '190000', 6, 41, 39),
	   (196, 0, 981, 0, 167, '1992-01-15', '190000', 7, 41, 39),
	   (195, 1, 984, 0, 167, '1992-01-15', '190000', 8, 41, 39),
	   (11, 3, 996, 0, 167, '1992-01-16', '190000', 9, 41, 39),
	   (194, 1, 239, 1, 167, '1992-01-16', '190000', 10, 41, 39),
	   (193, 1, 981, 1, 167, '1992-01-17', '190000', 11, 41, 39),
	   (195, 1, 8, 0, 167, '1992-01-17', '190000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (10, 1, null, null, 239, 0, null, null, 167, '1992-01-19', '190000', 13, 43, 40, 13),
	   (194, 1, null, null, 11, 0, null, null, 167, '1992-01-19', '190000', 14, 43, 40, 15),
	   (196, 0, 1, null, 984, 0, 0, null, 167, '1992-01-20', '190000', 15, 43, 40, 16),
	   (195, 2, null, null, 981, 1, null, null, 167, '1992-01-20', '190000', 16, 43, 40, 14),
	   (195, 2, null, null, 10, 1, null, null, 167, '1992-01-23', '190000', 17, 44, 40, 17),
	   (194, 0, 0, 1, 196, 0, 0, 3, 167, '1992-01-23', '190000', 18, 44, 40, 18),
	   (10, 2, null, null, 194, 1, null, null, 167, '1992-01-25', '190000', 19, 45, 40, 20),
	   (196, 0, 0, 11, 195, 0, 0, 10, 167, '1992-01-26', '190000', 20, 46, 40, 19);

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
