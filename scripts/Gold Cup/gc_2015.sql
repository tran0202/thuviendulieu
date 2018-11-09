# Insert new tournament
# Replace all the tournament_id

# 2015 Gold Cup United States-Canada

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2015 Gold Cup United States-Canada', '2015-07-07', '2015-07-26', 13, 'gc_2015.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (129, 41, 1, 39, 1),
	   (129, 43, 1, 40, 2),
	   (129, 44, 2, 40, 2),
	   (129, 45, 3, 40, 2),
	   (129, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Guatemala', 1, 82);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (198, 129, 1, 1),
	   (240, 129, 1, 2),
	   (29, 129, 1, 3),
	   (197, 129, 1, 4),
	   (225, 129, 2, 1),
	   (27, 129, 2, 2),
	   (236, 129, 2, 3),
	   (232, 129, 2, 4),
	   (211, 129, 3, 1),
	   (28, 129, 3, 2),
	   (246, 129, 3, 3),
	   (968, 129, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (29, 1, 240, 1, 129, '2015-07-07', '180000', 1, 41, 39),
	   (198, 2, 197, 1, 129, '2015-07-07', '203000', 2, 41, 39),
	   (27, 2, 225, 2, 129, '2015-07-08', '170000', 3, 41, 39),
	   (236, 0, 232, 0, 129, '2015-07-08', '1930000', 4, 41, 39),
	   (211, 3, 968, 1, 129, '2015-07-09', '180000', 5, 41, 39),
	   (28, 6, 246, 0, 129, '2015-07-09', '203000', 6, 41, 39),
	   (197, 1, 29, 1, 129, '2015-07-10', '180000', 7, 41, 39),
	   (198, 1, 240, 0, 129, '2015-07-10', '203000', 8, 41, 39),
	   (225, 1, 232, 0, 129, '2015-07-11', '173000', 9, 41, 39),
	   (27, 1, 236, 1, 129, '2015-07-11', '200000', 10, 41, 39),
	   (211, 2, 246, 0, 129, '2015-07-12', '163000', 11, 41, 39),
	   (968, 0, 28, 0, 129, '2015-07-12', '190000', 12, 41, 39),
	   (240, 1, 197, 0, 129, '2015-07-13', '180000', 13, 41, 39),
	   (29, 1, 198, 1, 129, '2015-07-13', '203000', 14, 41, 39),
	   (225, 1, 236, 0, 129, '2015-07-14', '180000', 15, 41, 39),
	   (232, 0, 27, 0, 129, '2015-07-14', '203000', 16, 41, 39),
	   (246, 1, 968, 0, 129, '2015-07-15', '180000', 17, 41, 39),
	   (28, 4, 211, 4, 129, '2015-07-15', '203000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (198, 6, null, null, 246, 0, null, null, 129, '2015-07-18', '170000', 19, 43, 40, 19),
	   (240, 0, null, null, 225, 1, null, null, 129, '2015-07-18', '200000', 20, 43, 40, 20),
	   (211, 1, 0, 5, 29, 1, 0, 6, 129, '2015-07-19', '163000', 21, 43, 40, 21),
	   (28, 0, 1, null, 27, 0, 0, null, 129, '2015-07-19', '193000', 22, 43, 40, 22),
	   (198, 1, null, null, 225, 2, null, null, 129, '2015-07-22', '180000', 23, 44, 40, 23),
	   (29, 1, 0, null, 28, 1, 1, null, 129, '2015-07-22', '210000', 24, 44, 40, 24),
	   (198, 1, 0, 2, 29, 1, 0, 3, 129, '2015-07-25', '160000', 25, 45, 40, 26),
	   (225, 1, null, null, 28, 3, null, null, 129, '2015-07-26', '200000', 26, 46, 40, 25);

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
