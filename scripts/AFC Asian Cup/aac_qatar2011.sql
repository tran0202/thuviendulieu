# Insert new tournament
# Replace all the tournament_id

# 2011 AFC Asian Cup Qatar

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2011 AFC Asian Cup Qatar', '2011-01-07', '2011-01-29', 15, 'aac_2011.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (186, 41, 1, 39, 1),
	   (186, 43, 1, 40, 2),
	   (186, 44, 2, 40, 2),
	   (186, 45, 3, 40, 2),
	   (186, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Syria', 1, 185, null),
	   ('India', 1, 91, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1009, 186, 1, 1),
	   (1011, 186, 1, 2),
	   (219, 186, 1, 3),
	   (237, 186, 1, 4),
	   (15, 186, 2, 1),
	   (1012, 186, 2, 2),
	   (1020, 186, 2, 3),
	   (17, 186, 2, 4),
	   (13, 186, 3, 1),
	   (16, 186, 3, 2),
	   (1010, 186, 3, 3),
	   (1021, 186, 3, 4),
	   (14, 186, 4, 1),
	   (1064, 186, 4, 2),
	   (210, 186, 4, 3),
	   (229, 186, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1011, 0, 1009, 2, 186, '2011-01-07', '200000', 1, 41, 39),
	   (237, 0, 219, 2, 186, '2011-01-08', '200000', 2, 41, 39),
	   (15, 1, 1012, 1, 186, '2011-01-09', '200000', 3, 41, 39),
	   (17, 1, 1020, 2, 186, '2011-01-09', '200000', 4, 41, 39),
	   (1021, 0, 13, 4, 186, '2011-01-10', '200000', 5, 41, 39),
	   (16, 2, 1010, 1, 186, '2011-01-10', '200000', 6, 41, 39),
	   (210, 0, 229, 0, 186, '2011-01-11', '200000', 7, 41, 39),
	   (1064, 1, 14, 2, 186, '2011-01-11', '200000', 8, 41, 39),
	   (1009, 2, 237, 1, 186, '2011-01-12', '200000', 9, 41, 39),
	   (219, 0, 1011, 2, 186, '2011-01-12', '200000', 10, 41, 39),
	   (1012, 1, 17, 0, 186, '2011-01-13', '200000', 11, 41, 39),
	   (1020, 1, 15, 2, 186, '2011-01-13', '200000', 12, 41, 39),
	   (13, 1, 16, 1, 186, '2011-01-14', '200000', 13, 41, 39),
	   (1010, 5, 1021, 2, 186, '2011-01-14', '200000', 14, 41, 39),
	   (14, 1, 210, 0, 186, '2011-01-15', '200000', 15, 41, 39),
	   (229, 0, 1064, 3, 186, '2011-01-15', '200000', 16, 41, 39),
	   (1011, 3, 237, 0, 186, '2011-01-16', '200000', 17, 41, 39),
	   (219, 2, 1009, 2, 186, '2011-01-16', '200000', 18, 41, 39),
	   (17, 0, 15, 5, 186, '2011-01-17', '200000', 19, 41, 39),
	   (1012, 2, 1020, 1, 186, '2011-01-17', '200000', 20, 41, 39),
	   (16, 4, 1021, 1, 186, '2011-01-18', '200000', 21, 41, 39),
	   (13, 1, 1010, 0, 186, '2011-01-18', '200000', 22, 41, 39),
	   (1064, 1, 210, 0, 186, '2011-01-19', '200000', 23, 41, 39),
	   (229, 0, 14, 3, 186, '2011-01-19', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (15, 3, null, null, 1011, 2, null, null, 186, '2011-01-21', '163000', 25, 43, 40, 27),
	   (1009, 2, null, null, 1012, 1, null, null, 186, '2011-01-21', '193000', 26, 43, 40, 25),
	   (13, 0, 1, null, 1064, 0, 0, null, 186, '2011-01-22', '163000', 27, 43, 40, 26),
	   (14, 0, 0, null, 16, 0, 1, null, 186, '2011-01-22', '193000', 28, 43, 40, 28),
	   (15, 1, 1, 3, 16, 1, 1, 0, 186, '2011-01-25', '163000', 29, 44, 40, 30),
	   (1009, 0, null, null, 13, 6, null, null, 186, '2011-01-25', '193000', 30, 44, 40, 29),
	   (1009, 2, null, null, 16, 3, null, null, 186, '2011-01-28', '180000', 31, 45, 40, 32),
	   (13, 0, 0, null, 15, 0, 1, null, 186, '2011-01-29', '180000', 32, 46, 40, 31);

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
