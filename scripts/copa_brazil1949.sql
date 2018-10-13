# Insert new tournament
# Replace all the tournament_id

# 1949 South American Championship Brazil

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1949 South American Championship Brazil', '1949-04-03', '1949-05-11', 12, 'CONMEBOL.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (107, 58, 1, 39, 1),
	   (107, 57, 1, 39, 1);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Venezuela', 1, 206);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1, 107, 1, 1),
	   (207, 107, 1, 2),
	   (31, 107, 1, 3),
	   (227, 107, 1, 4),
	   (199, 107, 1, 5),
	   (32, 107, 1, 6),
	   (200, 107, 1, 7),
	   (30, 107, 1, 8);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1, 9, 200, 1, 107, '1949-04-03', '190000', 1, 58, 39),
	   (227, 3, 199, 2, 107, '1949-04-06', '190000', 2, 58, 39),
	   (207, 3, 30, 0, 107, '1949-04-06', '190000', 3, 58, 39),
	   (31, 4, 30, 0, 107, '1949-04-10', '190000', 4, 58, 39),
	   (207, 1, 200, 0, 107, '1949-04-10', '190000', 5, 58, 39),
	   (1, 10, 227, 1, 107, '1949-04-10', '190000', 6, 58, 39),
	   (1, 2, 199, 1, 107, '1949-04-13', '190000', 7, 58, 39),
	   (32, 3, 200, 2, 107, '1949-04-13', '190000', 8, 58, 39),
	   (207, 3, 31, 1, 107, '1949-04-13', '190000', 9, 58, 39),
	   (1, 5, 30, 0, 107, '1949-04-17', '190000', 10, 58, 39),
	   (199, 1, 200, 0, 107, '1949-04-17', '190000', 11, 58, 39),
	   (227, 3, 32, 2, 107, '1949-04-17', '190000', 12, 58, 39),
	   (31, 4, 200, 0, 107, '1949-04-20', '190000', 13, 58, 39),
	   (199, 1, 30, 1, 107, '1949-04-20', '190000', 14, 58, 39),
	   (32, 2, 207, 1, 107, '1949-04-20', '190000', 15, 58, 39),
	   (1, 7, 31, 1, 107, '1949-04-24', '190000', 16, 58, 39),
	   (227, 2, 200, 0, 107, '1949-04-25', '190000', 17, 58, 39),
	   (32, 2, 30, 2, 107, '1949-04-25', '190000', 18, 58, 39),
	   (31, 3, 227, 0, 107, '1949-04-27', '190000', 19, 58, 39),
	   (207, 4, 199, 2, 107, '1949-04-27', '190000', 20, 58, 39),
	   (207, 7, 227, 0, 107, '1949-04-30', '190000', 21, 58, 39),
	   (1, 5, 32, 1, 107, '1949-04-30', '190000', 22, 58, 39),
	   (31, 3, 199, 0, 107, '1949-04-30', '190000', 23, 58, 39),
	   (200, 4, 30, 1, 107, '1949-05-03', '190000', 24, 58, 39),
	   (31, 4, 32, 3, 107, '1949-05-04', '190000', 25, 58, 39),
	   (227, 4, 30, 0, 107, '1949-05-06', '190000', 26, 58, 39),
	   (199, 3, 32, 1, 107, '1949-05-08', '190000', 27, 58, 39),
	   (207, 2, 1, 1, 107, '1949-05-08', '190000', 28, 58, 39),
	   (1, 7, 207, 0, 107, '1949-05-11', '190000', 29, 57, 39);

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
