# Insert new tournament
# Replace all the tournament_id

# Women's Olympic Football Tournament London 2012

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Women''s Olympic Football Tournament London 2012', '2012-07-25', '2007-08-09', 10, '2012.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (63, 41, 1, 39, 1),
	   (63, 43, 1, 40, 2),
	   (63, 44, 2, 40, 2),
	   (63, 132, 3, 40, 2),
	   (63, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 5 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Great Britain', 5, 212), ('Cameroon', 5, 35), ('Japan', 5, 98), ('Korea DPR', 5, 102);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (946, 63, 5, 1),
	   (851, 63, 5, 2),
	   (861, 63, 5, 3),
	   (947, 63, 5, 4),
	   (853, 63, 6, 1),
	   (948, 63, 6, 2),
	   (855, 63, 6, 3),
	   (854, 63, 6, 4),
	   (859, 63, 7, 1),
	   (860, 63, 7, 2),
	   (949, 63, 7, 3),
	   (862, 63, 7, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (946, 1, 861, 0, 63, '2012-07-25', '160000', 1, 41, 39),
	   (947, 0, 851, 5, 63, '2012-07-25', '184500', 2, 41, 39),
	   (861, 0, 851, 1, 63, '2012-07-28', '143000', 7, 41, 39),
	   (946, 3, 947, 0, 63, '2012-07-28', '171500', 8, 41, 39),
	   (861, 3, 947, 1, 63, '2012-07-31', '194500', 13, 41, 39),
	   (946, 1, 851, 0, 63, '2012-07-31', '194500', 14, 41, 39),
	   (948, 2, 855, 1, 63, '2012-07-25', '170000', 3, 41, 39),
	   (853, 4, 854, 1, 63, '2012-07-25', '194500', 4, 41, 39),
	   (948, 0, 853, 0, 63, '2012-07-28', '120000', 9, 41, 39),
	   (855, 3, 854, 0, 63, '2012-07-28', '144500', 10, 41, 39),
	   (948, 0, 854, 0, 63, '2012-07-31', '143000', 15, 41, 39),
	   (855, 2, 853, 2, 63, '2012-07-31', '143000', 16, 41, 39),
	   (859, 4, 860, 2, 63, '2012-07-25', '170000', 5, 41, 39),
	   (862, 0, 949, 2, 63, '2012-07-25', '205000', 6, 41, 39),
	   (859, 3, 862, 0, 63, '2012-07-28', '170000', 11, 41, 39),
	   (860, 5, 949, 0, 63, '2012-07-28', '194500', 12, 41, 39),
	   (859, 1, 949, 0, 63, '2012-07-31', '171500', 17, 41, 39),
	   (860, 1, 862, 0, 63, '2012-07-31', '171500', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (853, 1, null, null, 860, 2, null, null, 63, '2012-08-03', '120000', 19, 43, 40, 21),
	   (859, 2, null, null, 861, 0, null, null, 63, '2012-08-03', '143000', 20, 43, 40, 20),
	   (851, 0, null, null, 948, 2, null, null, 63, '2012-08-03', '170000', 21, 43, 40, 22),
	   (946, 0, null, null, 855, 2, null, null, 63, '2012-08-03', '193000', 22, 43, 40, 19),
	   (860, 1, null, null, 948, 2, null, null, 63, '2012-08-06', '170000', 23, 44, 40, 24),
	   (855, 3, 0, null, 859, 3, 1, null, 63, '2012-08-06', '194500', 24, 44, 40, 23),
	   (855, 1, null, null, 860, 0, null, null, 63, '2012-08-09', '130000', 25, 132, 40, 26),
	   (859, 2, null, null, 948, 1, null, null, 63, '2012-08-09', '194500', 26, 133, 40, 25);

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
