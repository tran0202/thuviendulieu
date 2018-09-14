# Insert new tournament
# Replace all the tournament_id

# Women's Olympic Football Tournament Beijing 2008

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Women''s Olympic Football Tournament Beijing 2008', '2008-08-06', '2008-08-21', 10, '2008.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (64, 41, 1, 39, 1),
	   (64, 43, 1, 40, 1),
	   (64, 44, 2, 40, 2),
	   (64, 132, 3, 40, 3),
	   (64, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 5 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Argentina', 5, 9), ('Nigeria', 5, 140), ('Norway', 5, 142);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (852, 64, 5, 1),
	   (853, 64, 5, 2),
	   (855, 64, 5, 3),
	   (950, 64, 5, 4),
	   (851, 64, 6, 1),
	   (856, 64, 6, 2),
	   (949, 64, 6, 3),
	   (951, 64, 6, 4),
	   (859, 64, 7, 1),
	   (952, 64, 7, 2),
	   (948, 64, 7, 3),
	   (861, 64, 7, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (950, 1, 855, 2, 64, '2008-08-06', '170000', 1, 41, 39),
	   (852, 2, 853, 1, 64, '2008-08-06', '194500', 2, 41, 39),
	   (853, 1, 950, 0, 64, '2008-08-09', '170000', 7, 41, 39),
	   (855, 1, 852, 1, 64, '2008-08-09', '194500', 8, 41, 39),
	   (852, 2, 950, 0, 64, '2008-08-12', '194500', 13, 41, 39),
	   (853, 2, 855, 1, 64, '2008-08-12', '194500', 14, 41, 39),
	   (856, 0, 851, 0, 64, '2008-08-06', '170000', 3, 41, 39),
	   (949, 1, 951, 0, 64, '2008-08-06', '194500', 4, 41, 39),
	   (951, 0, 856, 1, 64, '2008-08-09', '170000', 9, 41, 39),
	   (851, 2, 949, 1, 64, '2008-08-09', '194500', 10, 41, 39),
	   (949, 0, 856, 1, 64, '2008-08-12', '170000', 15, 41, 39),
	   (951, 1, 851, 3, 64, '2008-08-12', '170000', 16, 41, 39),
	   (948, 2, 861, 2, 64, '2008-08-06', '170000', 5, 41, 39),
	   (952, 2, 859, 0, 64, '2008-08-06', '195000', 6, 41, 39),
	   (859, 1, 948, 0, 64, '2008-08-09', '170000', 11, 41, 39),
	   (861, 0, 952, 1, 64, '2008-08-09', '194500', 12, 41, 39),
	   (952, 1, 948, 5, 64, '2008-08-12', '194500', 17, 41, 39),
	   (859, 4, 861, 0, 64, '2008-08-12', '194500', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (859, 1, 1, null, 855, 1, 0, null, 64, '2008-08-15', '180000', 19, 43, 40, 22),
	   (851, 2, null, null, 952, 1, null, null, 64, '2008-08-15', '180000', 20, 43, 40, 19),
	   (853, 0, 0, null, 856, 0, 2, null, 64, '2008-08-15', '210000', 21, 43, 40, 20),
	   (852, 0, null, null, 948, 2, null, null, 64, '2008-08-15', '210000', 22, 43, 40, 21),
	   (851, 4, null, null, 856, 1, null, null, 64, '2008-08-18', '180000', 23, 44, 40, 23),
	   (859, 4, null, null, 948, 2, null, null, 64, '2008-08-18', '210000', 24, 44, 40, 24),
	   (856, 2, null, null, 948, 0, null, null, 64, '2008-08-21', '210000', 25, 132, 40, 26),
	   (851, 0, 0, null, 859, 0, 1, null, 64, '2008-08-21', '210000', 26, 133, 40, 25);

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
