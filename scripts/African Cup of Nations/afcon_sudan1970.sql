# Insert new tournament
# Replace all the tournament_id

# 1970 African Cup of Nations Sudan

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1970 African Cup of Nations Sudan', '1970-02-06', '1970-02-16', 14, 'Africa_Cup_of_Nations.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (178, 41, 1, 39, 1),
	   (178, 44, 1, 40, 2),
	   (178, 45, 2, 40, 2),
	   (178, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('United Arab Republic', 1, 224, 8),
	   ('Congo-Kinshasa', 1, 47, 241);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (196, 178, 1, 1),
	   (1098, 178, 1, 2),
	   (1101, 178, 1, 3),
	   (1097, 178, 1, 4),
	   (1004, 178, 2, 1),
	   (195, 178, 2, 2),
	   (985, 178, 2, 3),
	   (1005, 178, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1101, 3, 196, 2, 178, '1970-02-06', '190000', 1, 41, 39),
	   (1098, 3, 1097, 0, 178, '1970-02-06', '190000', 2, 41, 39),
	   (195, 2, 1005, 0, 178, '1970-02-07', '190000', 3, 41, 39),
	   (1004, 4, 985, 1, 178, '1970-02-07', '190000', 4, 41, 39),
	   (1101, 3, 1097, 2, 178, '1970-02-08', '190000', 5, 41, 39),
	   (196, 1, 1098, 0, 178, '1970-02-08', '190000', 6, 41, 39),
	   (1005, 2, 985, 2, 178, '1970-02-09', '190000', 7, 41, 39),
	   (1004, 1, 195, 1, 178, '1970-02-09', '190000', 8, 41, 39),
	   (196, 6, 1097, 1, 178, '1970-02-10', '190000', 9, 41, 39),
	   (1098, 2, 1101, 1, 178, '1970-02-10', '190000', 10, 41, 39),
	   (985, 1, 195, 1, 178, '1970-02-11', '190000', 11, 41, 39),
	   (1004, 1, 1005, 0, 178, '1970-02-11', '190000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (196, 1, 0, null, 195, 1, 1, null, 178, '1970-02-14', '190000', 13, 44, 40, 13),
	   (1004, 1, 0, null, 1098, 1, 1, null, 178, '1970-02-14', '190000', 14, 44, 40, 14),
	   (1004, 3, null, null, 196, 1, null, null, 178, '1970-02-16', '190000', 15, 45, 40, 16),
	   (1098, 1, null, null, 195, 0, null, null, 178, '1970-02-16', '190000', 16, 46, 40, 15);

# INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id, group_id)
# VALUES (985, 1, 10, 1, 178, '1970-02-09', '190000', 13, 58, 39, 58),
# 	   (9, 2, 8, 1, 178, '1970-02-09', '190000', 14, 58, 39, 58),
# 	   (9, 2, 10, 1, 178, '1970-02-11', '190000', 15, 58, 39, 58),
# 	   (985, 4, 8, 2, 178, '1970-02-11', '190000', 16, 58, 39, 58),
# 	   (10, 3, 8, 2, 178, '1970-02-14', '190000', 17, 58, 39, 58),
# 	   (985, 1, 9, 1, 178, '1970-02-14', '190000', 18, 58, 39, 58);

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
	parent_team_id INT,
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
