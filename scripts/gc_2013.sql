# Insert new tournament
# Replace all the tournament_id

# 2013 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2013 Gold Cup United States', '2013-07-07', '2013-07-28', 13, 'gc_2013.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (130, 41, 1, 39, 1),
	   (130, 43, 1, 40, 1),
	   (130, 44, 2, 40, 2),
	   (130, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Belize', 1, 21);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (29, 130, 1, 1),
	   (28, 130, 1, 2),
	   (965, 130, 1, 3),
	   (232, 130, 1, 4),
	   (197, 130, 2, 1),
	   (211, 130, 2, 2),
	   (236, 130, 2, 3),
	   (240, 130, 2, 4),
	   (198, 130, 3, 1),
	   (27, 130, 3, 2),
	   (246, 130, 3, 3),
	   (969, 130, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (232, 0, 965, 1, 130, '2013-07-07', '173000', 1, 41, 39),
	   (28, 1, 29, 2, 130, '2013-07-07', '200000', 2, 41, 39),
	   (236, 2, 211, 2, 130, '2013-07-08', '170000', 3, 41, 39),
	   (240, 0, 197, 2, 130, '2013-07-08', '2130000', 4, 41, 39),
	   (27, 3, 246, 0, 130, '2013-07-09', '203000', 5, 41, 39),
	   (969, 1, 198, 6, 130, '2013-07-09', '230000', 6, 41, 39),
	   (29, 1, 965, 0, 130, '2013-07-11', '203000', 7, 41, 39),
	   (28, 2, 232, 0, 130, '2013-07-11', '230000', 8, 41, 39),
	   (211, 0, 240, 2, 130, '2013-07-12', '190000', 9, 41, 39),
	   (197, 1, 236, 0, 130, '2013-07-12', '213000', 10, 41, 39),
	   (198, 4, 246, 1, 130, '2013-07-13', '153000', 11, 41, 39),
	   (27, 1, 969, 0, 130, '2013-07-13', '180000', 12, 41, 39),
	   (29, 0, 232, 0, 130, '2013-07-14', '153000', 13, 41, 39),
	   (965, 1, 28, 3, 130, '2013-07-14', '180000', 14, 41, 39),
	   (236, 1, 240, 0, 130, '2013-07-15', '190000', 15, 41, 39),
	   (197, 0, 211, 2, 130, '2013-07-15', '213000', 16, 41, 39),
	   (246, 4, 969, 0, 130, '2013-07-16', '173000', 17, 41, 39),
	   (198, 1, 27, 0, 130, '2013-07-16', '200000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (29, 6, null, null, 246, 1, null, null, 130, '2013-07-20', '153000', 19, 43, 40, 19),
	   (28, 1, null, null, 211, 0, null, null, 130, '2013-07-20', '183000', 20, 43, 40, 20),
	   (198, 5, null, null, 236, 1, null, null, 130, '2013-07-21', '160000', 21, 43, 40, 21),
	   (197, 1, null, null, 27, 0, null, null, 130, '2013-07-21', '190000', 22, 43, 40, 22),
	   (198, 3, null, null, 197, 1, null, null, 130, '2013-07-24', '190000', 23, 44, 40, 23),
	   (29, 2, null, null, 28, 1, null, null, 130, '2013-07-24', '220000', 24, 44, 40, 24),
	   (198, 1, null, null, 29, 0, null, null, 130, '2013-07-28', '160000', 25, 46, 40, 25);

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
