# Insert new tournament
# Replace all the tournament_id

# 1989 Copa America Brazil

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1989 Copa America Brazil', '1989-07-01', '1989-07-16', 12, 'copa-1989.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (94, 41, 1, 39, 1),
	   (94, 58, 1, 39, 1);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Venezuela', 1, 206);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (207, 94, 1, 1),
	   (1, 94, 1, 2),
	   (30, 94, 1, 3),
	   (31, 94, 1, 4),
	   (1091, 94, 1, 5),
	   (3, 94, 2, 1),
	   (32, 94, 2, 2),
	   (199, 94, 2, 3),
	   (200, 94, 2, 4),
	   (227, 94, 2, 5);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (207, 5, 31, 2, 94, '1989-07-01', '190000', 1, 41, 39),
	   (1, 3, 1091, 1, 94, '1989-07-01', '190000', 2, 41, 39),
	   (200, 1, 32, 0, 94, '1989-07-02', '190000', 3, 41, 39),
	   (3, 1, 199, 0, 94, '1989-07-02', '190000', 4, 41, 39),
	   (30, 4, 1091, 2, 94, '1989-07-03', '190000', 5, 41, 39),
	   (1, 0, 31, 0, 94, '1989-07-03', '190000', 6, 41, 39),
	   (32, 3, 227, 0, 94, '1989-07-04', '190000', 7, 41, 39),
	   (3, 0, 200, 0, 94, '1989-07-04', '190000', 8, 41, 39),
	   (31, 1, 1091, 1, 94, '1989-07-05', '190000', 9, 41, 39),
	   (207, 1, 30, 0, 94, '1989-07-05', '190000', 10, 41, 39),
	   (200, 0, 227, 0, 94, '1989-07-06', '190000', 11, 41, 39),
	   (32, 3, 199, 0, 94, '1989-07-06', '190000', 12, 41, 39),
	   (207, 3, 1091, 0, 94, '1989-07-07', '190000', 13, 41, 39),
	   (1, 0, 30, 0, 94, '1989-07-07', '190000', 14, 41, 39),
	   (199, 5, 227, 0, 94, '1989-07-08', '190000', 15, 41, 39),
	   (3, 1, 32, 0, 94, '1989-07-08', '190000', 16, 41, 39),
	   (30, 1, 31, 1, 94, '1989-07-09', '190000', 17, 41, 39),
	   (1, 2, 207, 0, 94, '1989-07-09', '190000', 18, 41, 39),
	   (199, 2, 200, 1, 94, '1989-07-10', '190000', 19, 41, 39),
	   (3, 0, 227, 0, 94, '1989-07-10', '190000', 20, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id, group_id)
VALUES (32, 3, 207, 0, 94, '1989-07-12', '190000', 21, 58, 39, 58),
	   (1, 2, 3, 0, 94, '1989-07-12', '190000', 22, 58, 39, 58),
	   (32, 2, 3, 0, 94, '1989-07-14', '190000', 23, 58, 39, 58),
	   (1, 3, 207, 0, 94, '1989-07-14', '190000', 24, 58, 39, 58),
	   (3, 0, 207, 0, 94, '1989-07-16', '190000', 25, 58, 39, 58),
	   (1, 1, 32, 0, 94, '1989-07-16', '190000', 26, 58, 39, 58);

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
