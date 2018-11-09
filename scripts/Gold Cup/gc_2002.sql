# Insert new tournament
# Replace all the tournament_id

# 2002 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2002 Gold Cup United States', '2002-01-18', '2002-02-02', 13, 'gc_2002.png', 1, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (136, 41, 1, 39, 1),
	   (136, 43, 1, 40, 2),
	   (136, 44, 2, 40, 2),
	   (136, 45, 3, 40, 2),
	   (136, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Grenada', 1, 80),
# 	   ('Guadeloupe', 1, 231);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (28, 136, 1, 1),
	   (236, 136, 1, 2),
	   (968, 136, 1, 3),
	   (198, 136, 2, 1),
	   (16, 136, 2, 2),
	   (246, 136, 2, 3),
	   (27, 136, 3, 1),
	   (965, 136, 3, 2),
	   (211, 136, 3, 3),
	   (232, 136, 4, 1),
	   (240, 136, 4, 2),
	   (200, 136, 4, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (965, 0, 27, 2, 136, '2002-01-17', '190000', 1, 41, 39),
	   (240, 0, 232, 2, 136, '2002-01-17', '190000', 2, 41, 39),
	   (236, 0, 28, 1, 136, '2002-01-18', '190000', 3, 41, 39),
	   (198, 2, 16, 1, 136, '2002-01-18', '190000', 4, 41, 39),
	   (27, 1, 211, 1, 136, '2002-01-19', '190000', 5, 41, 39),
	   (200, 0, 240, 2, 136, '2002-01-19', '190000', 6, 41, 39),
	   (28, 3, 968, 1, 136, '2002-01-20', '190000', 7, 41, 39),
	   (246, 0, 198, 1, 136, '2002-01-20', '190000', 8, 41, 39),
	   (211, 0, 965, 1, 136, '2002-01-21', '190000', 9, 41, 39),
	   (232, 0, 200, 2, 136, '2002-01-21', '190000', 10, 41, 39),
	   (968, 0, 236, 1, 136, '2002-01-22', '190000', 11, 41, 39),
	   (16, 0, 246, 0, 136, '2002-01-22', '190000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (27, 1, 1, null, 240, 1, 0, null, 136, '2002-01-26', '190000', 13, 43, 40, 13),
	   (232, 1, 0, 6, 965, 1, 0, 5, 136, '2002-01-26', '190000', 15, 43, 40, 14),
	   (28, 0, 0, 2, 16, 0, 0, 4, 136, '2002-01-27', '190000', 14, 43, 40, 15),
	   (198, 4, null, null, 236, 0, null, null, 136, '2002-01-27', '190000', 16, 43, 40, 16),
	   (27, 3, null, null, 16, 1, null, null, 136, '2002-01-30', '190000', 17, 44, 40, 17),
	   (232, 0, 0, 2, 198, 0, 0, 4, 136, '2002-01-30', '190000', 18, 44, 40, 18),
	   (232, 2, null, null, 16, 1, null, null, 136, '2002-02-02', '190000', 19, 45, 40, 20),
	   (198, 2, null, null, 27, 0, null, null, 136, '2002-02-02', '190000', 20, 46, 40, 19);

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

CREATE TABLE IF NOT EXISTS nation (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	alternative_name VARCHAR(255),
	code VARCHAR(255),
	flag_filename VARCHAR(255),
	alternative_flag_filename VARCHAR(255),
	parent_nation_id INT,
	nation_type_id INT,
	FOREIGN KEY (parent_nation_id) REFERENCES nation(id),
	FOREIGN KEY (nation_type_id) REFERENCES group_type(id)
);
