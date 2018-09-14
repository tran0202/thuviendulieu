# Insert new tournament
# Replace all the tournament_id

# Women's Olympic Football Tournament Atlanta 1996

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Women''s Olympic Football Tournament Atlanta 1996', '1996-07-21', '1996-08-01', 10, '1996.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (67, 41, 1, 39, 1),
	   (67, 44, 2, 40, 2),
	   (67, 132, 3, 40, 3),
	   (67, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 5 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Denmark', 5, 56);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (852, 67, 5, 1),
	   (859, 67, 5, 2),
	   (853, 67, 5, 3),
	   (955, 67, 5, 4),
	   (952, 67, 6, 1),
	   (851, 67, 6, 2),
	   (856, 67, 6, 3),
	   (948, 67, 6, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (859, 3, 955, 0, 67, '1996-07-21', '160000', 1, 41, 39),
	   (853, 0, 852, 2, 67, '1996-07-21', '160000', 2, 41, 39),
	   (859, 2, 853, 1, 67, '1996-07-23', '180000', 5, 41, 39),
	   (955, 1, 852, 5, 67, '1996-07-23', '160000', 6, 41, 39),
	   (859, 0, 852, 0, 67, '1996-07-25', '183000', 9, 41, 39),
	   (955, 1, 853, 3, 67, '1996-07-25', '183000', 10, 41, 39),
	   (952, 2, 851, 2, 67, '1996-07-21', '183000', 3, 41, 39),
	   (856, 3, 948, 2, 67, '1996-07-21', '183000', 4, 41, 39),
	   (952, 3, 856, 2, 67, '1996-07-23', '183000', 7, 41, 39),
	   (851, 2, 948, 0, 67, '1996-07-23', '183000', 8, 41, 39),
	   (952, 4, 948, 0, 67, '1996-07-25', '183000', 11, 41, 39),
	   (851, 1, 856, 1, 67, '1996-07-25', '183000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (852, 3, null, null, 851, 2, null, null, 67, '1996-07-28', '173000', 13, 44, 40, 13),
	   (952, 1, 0, null, 859, 1, 1, null, 67, '1996-07-28', '173000', 14, 44, 40, 14),
	   (851, 0, null, null, 952, 2, null, null, 67, '1996-08-01', '170000', 15, 132, 40, 16),
	   (952, 1, null, null, 859, 2, null, null, 67, '1996-08-01', '200000', 16, 133, 40, 15);

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
