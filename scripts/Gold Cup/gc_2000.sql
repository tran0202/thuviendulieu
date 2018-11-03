# Insert new tournament
# Replace all the tournament_id

# 2000 Gold Cup United States

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2000 Gold Cup United States', '2000-02-12', '2000-02-27', 13, 'gc_2000.png', 1, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (137, 41, 1, 39, 1),
	   (137, 43, 1, 40, 1),
	   (137, 44, 2, 40, 2),
	   (137, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Grenada', 1, 80),
# 	   ('Guadeloupe', 1, 231);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (197, 137, 1, 1),
	   (30, 137, 1, 2),
	   (225, 137, 1, 3),
	   (198, 137, 2, 1),
	   (31, 137, 2, 2),
	   (240, 137, 2, 3),
	   (28, 137, 3, 1),
	   (211, 137, 3, 2),
	   (968, 137, 3, 3),
	   (27, 137, 4, 1),
	   (232, 137, 4, 2),
	   (16, 137, 4, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (30, 1, 225, 0, 137, '2000-02-12', '210000', 1, 41, 39),
	   (198, 3, 240, 0, 137, '2000-02-12', '190000', 2, 41, 39),
	   (28, 4, 211, 0, 137, '2000-02-13', '140000', 3, 41, 39),
	   (27, 2, 232, 2, 137, '2000-02-13', '120000', 4, 41, 39),
	   (225, 0, 197, 2, 137, '2000-02-14', '190000', 5, 41, 39),
	   (240, 1, 31, 1, 137, '2000-02-14', '210000', 6, 41, 39),
	   (211, 4, 968, 2, 137, '2000-02-15', '210000', 7, 41, 39),
	   (232, 0, 16, 0, 137, '2000-02-15', '190000', 8, 41, 39),
	   (197, 2, 30, 0, 137, '2000-02-16', '190000', 9, 41, 39),
	   (31, 0, 198, 1, 137, '2000-02-16', '210000', 10, 41, 39),
	   (968, 1, 28, 1, 137, '2000-02-17', '190000', 11, 41, 39),
	   (16, 2, 27, 2, 137, '2000-02-17', '210000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (198, 2, 0, 1, 30, 2, 0, 2, 137, '2000-02-19', '150000', 13, 43, 40, 13),
	   (197, 3, null, null, 31, 5, null, null, 137, '2000-02-19', '173000', 15, 43, 40, 14),
	   (27, 1, 0, null, 211, 1, 1, null, 137, '2000-02-20', '120000', 14, 43, 40, 15),
	   (28, 1, 0, null, 232, 1, 1, null, 137, '2000-02-20', '143000', 16, 43, 40, 16),
	   (30, 2, null, null, 31, 1, null, null, 137, '2000-02-23', '200000', 17, 44, 40, 17),
	   (211, 0, null, null, 232, 1, null, null, 137, '2000-02-24', '200000', 18, 44, 40, 18),
	   (232, 2, null, null, 30, 0, null, null, 137, '2000-02-27', '120000', 19, 46, 40, 19);

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
