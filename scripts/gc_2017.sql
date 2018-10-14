# Insert new tournament
# Replace all the tournament_id

# 2017 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2017 Gold Cup United States', '2017-07-07', '2017-07-26', 12, 'gc_2017.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (128, 41, 1, 39, 1),
	   (128, 43, 1, 40, 1),
	   (128, 44, 2, 40, 2),
	   (128, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('French Guiana', 1, 229),
	   ('Martinique', 1, 230),
	   ('Nicaragua', 1, 138),
	   ('Curaçao', 1, 53);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (27, 128, 1, 1),
	   (232, 128, 1, 2),
	   (197, 128, 1, 3),
	   (964, 128, 1, 4),
	   (198, 128, 2, 1),
	   (29, 128, 2, 2),
	   (965, 128, 2, 3),
	   (966, 128, 2, 4),
	   (28, 128, 3, 1),
	   (225, 128, 3, 2),
	   (236, 128, 3, 3),
	   (967, 128, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (964, 2, 232, 4, 128, '2017-07-07', '190000', 1, 41, 39),
	   (197, 0, 27, 1, 128, '2017-07-07', '210000', 2, 41, 39),
	   (198, 1, 29, 1, 128, '2017-07-08', '163000', 3, 41, 39),
	   (965, 2, 966, 0, 128, '2017-07-08', '190000', 4, 41, 39),
	   (967, 0, 225, 2, 128, '2017-07-09', '190000', 5, 41, 39),
	   (28, 3, 236, 1, 128, '2017-07-09', '210000', 6, 41, 39),
	   (27, 1, 232, 1, 128, '2017-07-11', '193000', 7, 41, 39),
	   (197, 3, 964, 3, 128, '2017-07-11', '220000', 8, 41, 39),
	   (29, 2, 966, 1, 128, '2017-07-12', '183000', 9, 41, 39),
	   (198, 3, 965, 2, 128, '2017-07-12', '203000', 10, 41, 39),
	   (236, 2, 967, 0, 128, '2017-07-13', '200000', 11, 41, 39),
	   (28, 0, 225, 0, 128, '2017-07-13', '220000', 12, 41, 39),
	   (27, 3, 964, 0, 128, '2017-07-14', '193000', 13, 41, 39),
	   (232, 0, 197, 0, 128, '2017-07-14', '220000', 14, 41, 39),
	   (29, 3, 965, 0, 128, '2017-07-15', '163000', 15, 41, 39),
	   (966, 0, 198, 3, 128, '2017-07-15', '190000', 16, 41, 39),
	   (225, 1, 236, 1, 128, '2017-07-16', '180000', 17, 41, 39),
	   (967, 0, 28, 2, 128, '2017-07-16', '200000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(27, 1, null, null, 29, 0, null, null, 128, '2017-07-19', '180000', 19, 43, 40, 19),
		(198, 2, null, null, 236, 0, null, null, 128, '2017-07-19', '210000', 20, 43, 40, 20),
		(225, 2, null, null, 232, 1, null, null, 128, '2017-07-20', '193000', 21, 43, 40, 21),
		(28, 1, null, null, 197, 0, null, null, 128, '2017-07-20', '223000', 22, 43, 40, 22),
		(27, 0, null, null, 198, 2, null, null, 128, '2017-07-22', '220000', 23, 44, 40, 23),
		(28, 0, null, null, 225, 1, null, null, 128, '2017-07-23', '210000', 24, 44, 40, 24),
		(198, 2, null, null, 225, 1, null, null, 128, '2017-07-26', '213000', 25, 46, 40, 25);

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
