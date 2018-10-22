# Insert new tournament
# Replace all the tournament_id

# 1995 King Fahd Cup Saudi Arabia

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1995 King Fahd Cup Saudi Arabia', '1995-01-06', '1995-01-13', 17, 'Confederations_Cup.png', 1, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (219, 41, 1, 39, 1),
	   (219, 45, 1, 40, 1),
	   (219, 46, 2, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
# INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
# VALUES ('Papua New Guinea', 1, 147, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (19, 219, 1, 1),
	   (28, 219, 1, 2),
	   (17, 219, 1, 3),
	   (3, 219, 2, 1),
	   (10, 219, 2, 2),
	   (15, 219, 2, 3);

# INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
# VALUES (17, 0, 1, 3, 219, '1995-01-12', '161500', 1, 41, 39),
# 	   (28, 1, 13, 3, 219, '1995-01-12', '190000', 2, 41, 39),
# 	   (229, 0, 32, 2, 219, '1995-01-13', '175000', 3, 41, 39),
# 	   (205, 2, 213, 2, 219, '1995-01-13', '200000', 4, 41, 39),
# 	   (17, 0, 28, 5, 219, '1995-01-14', '175000', 5, 41, 39),
# 	   (13, 0, 1, 0, 219, '1995-01-14', '200000', 6, 41, 39),
# 	   (229, 1, 205, 0, 219, '1995-01-15', '175000', 7, 41, 39),
# 	   (213, 1, 32, 2, 219, '1995-01-15', '200000', 8, 41, 39),
# 	   (17, 1, 13, 0, 219, '1995-01-16', '175000', 9, 41, 39),
# 	   (1, 3, 28, 2, 219, '1995-01-16', '200000', 10, 41, 39),
# 	   (229, 1, 213, 6, 219, '1995-01-17', '175000', 11, 41, 39),
# 	   (32, 4, 205, 3, 219, '1995-01-17', '200000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (17, 0, null, null, 28, 2, null, null, 219, '1995-01-06', '181500', 1, 41, 39, 1),
	   (15, 0, null, null, 10, 3, null, null, 219, '1995-01-06', '200000', 2, 41, 39, 2),
	   (17, 0, null, null, 19, 2, null, null, 219, '1995-01-08', '181500', 3, 41, 39, 3),
	   (15, 1, null, null, 3, 5, null, null, 219, '1995-01-08', '200000', 4, 41, 39, 4),
	   (19, 1, 0, 4, 28, 1, 0, 2, 219, '1995-01-10', '181500', 5, 41, 39, 5),
	   (10, 0, null, null, 3, 0, null, null, 219, '1995-01-10', '200000', 6, 41, 39, 6),
	   (28, 1, 0, 5, 10, 1, 0, 4, 219, '1995-01-13', '180000', 7, 45, 40, 8),
	   (19, 2, null, null, 3, 0, null, null, 219, '1995-01-13', '201500', 8, 46, 40, 7);

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
