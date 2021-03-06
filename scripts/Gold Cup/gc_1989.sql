# Insert new tournament
# Replace all the tournament_id

# 1989 CONCACAF Championship

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1989 CONCACAF Championship', '1989-03-19', '1989-11-19', 13, 'CONCACAF.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (142, 58, 1, 39, 1);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Saint Vincent and the Grenadines', 1, 179);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (27, 142, 1, 1),
	   (198, 142, 1, 2),
	   (211, 142, 1, 3),
	   (968, 142, 1, 4),
	   (236, 142, 1, 5);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (968, 1, 27, 0, 142, '1989-03-19', '190000', 1, 58, 39),
	   (27, 2, 968, 1, 142, '1989-04-02', '190000', 2, 58, 39),
	   (27, 1, 198, 0, 142, '1989-04-16', '190000', 3, 58, 39),
	   (198, 1, 27, 0, 142, '1989-04-30', '190000', 4, 58, 39),
	   (198, 1, 211, 1, 142, '1989-05-13', '190000', 5, 58, 39),
	   (211, 1, 27, 1, 142, '1989-05-28', '190000', 6, 58, 39),
	   (27, 1, 211, 0, 142, '1989-06-11', '190000', 7, 58, 39),
	   (198, 2, 968, 1, 142, '1989-06-17', '190000', 8, 58, 39),
	   (236, 2, 27, 4, 142, '1989-06-25', '190000', 9, 58, 39),
	   (27, 1, 236, 0, 142, '1989-07-16', '190000', 10, 58, 39),
	   (211, 2, 236, 0, 142, '1989-07-30', '190000', 11, 58, 39),
	   (236, 0, 211, 0, 142, '1989-08-13', '190000', 12, 58, 39),
	   (968, 0, 211, 1, 142, '1989-08-20', '190000', 13, 58, 39),
	   (211, 2, 968, 1, 142, '1989-09-03', '190000', 14, 58, 39),
	   (236, 0, 198, 1, 142, '1989-09-17', '190000', 15, 58, 39),
	   (968, 0, 198, 0, 142, '1989-10-08', '190000', 16, 58, 39),
	   (198, 0, 236, 0, 142, '1989-11-05', '190000', 17, 58, 39),
	   (211, 0, 198, 1, 142, '1989-11-19', '190000', 18, 58, 39),
	   (236, null, 968, null, 142, '1989-11-19', '190000', 19, 58, 39),
	   (968, null, 236, null, 142, '1989-11-21', '190000', 20, 58, 39);

# INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
# 					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
# 					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
# VALUES (197, 2, null, null, 27, 0, null, null, 142, '1989-06-05', '190000', 13, 44, 40, 13),
# 	   (198, 2, null, null, 28, 0, null, null, 142, '1989-06-05', '190000', 14, 44, 40, 14),
# 	   (28, 2, null, null, 27, 0, null, null, 142, '1989-06-07', '190000', 15, 45, 40, 16),
# 	   (198, 0, 0, 4, 197, 0, 0, 3, 142, '1989-06-07', '190000', 16, 46, 40, 15);

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
