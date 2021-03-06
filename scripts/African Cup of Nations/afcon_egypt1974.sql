# Insert new tournament
# Replace all the tournament_id

# 1974 African Cup of Nations Egypt

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1974 African Cup of Nations Egypt', '1974-03-01', '1974-03-14', 14, 'Africa_Cup_of_Nations.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (176, 41, 1, 39, 1),
	   (176, 44, 1, 40, 2),
	   (176, 45, 2, 40, 2),
	   (176, 46, 3, 40, 2),
	   (176, 153, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Mauritius', 1, 124, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1103, 176, 1, 1),
	   (984, 176, 1, 2),
	   (980, 176, 1, 3),
	   (196, 176, 1, 4),
	   (1102, 176, 2, 1),
	   (239, 176, 2, 2),
	   (985, 176, 2, 3),
	   (1003, 176, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1103, 2, 980, 1, 176, '1974-03-01', '190000', 1, 41, 39),
	   (984, 1, 196, 0, 176, '1974-03-02', '190000', 2, 41, 39),
	   (239, 2, 985, 1, 176, '1974-03-03', '190000', 3, 41, 39),
	   (1102, 2, 1003, 0, 176, '1974-03-03', '190000', 4, 41, 39),
	   (1103, 3, 984, 1, 176, '1974-03-04', '190000', 5, 41, 39),
	   (196, 2, 980, 2, 176, '1974-03-04', '190000', 6, 41, 39),
	   (985, 2, 1003, 1, 176, '1974-03-05', '190000', 7, 41, 39),
	   (1102, 2, 239, 1, 176, '1974-03-05', '190000', 8, 41, 39),
	   (1103, 2, 196, 0, 176, '1974-03-06', '190000', 9, 41, 39),
	   (984, 1, 980, 0, 176, '1974-03-06', '190000', 10, 41, 39),
	   (1102, 1, 985, 1, 176, '1974-03-07', '190000', 11, 41, 39),
	   (239, 4, 1003, 1, 176, '1974-03-07', '190000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1103, 2, null, null, 239, 3, null, null, 176, '1974-03-09', '190000', 13, 44, 40, 13),
	   (1102, 2, 0, null, 984, 2, 2, null, 176, '1974-03-09', '190000', 14, 44, 40, 14),
	   (1102, 0, null, null, 1103, 4, null, null, 176, '1974-03-11', '190000', 15, 45, 40, 16),
	   (239, 1, 1, null, 984, 1, 1, null, 176, '1974-03-12', '190000', 16, 46, 40, 15),
	   (239, 2, null, null, 984, 0, null, null, 176, '1974-03-14', '190000', 17, 153, 40, 17);

# INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id, group_id)
# VALUES (985, 1, 10, 1, 176, '1974-03-09', '190000', 13, 58, 39, 58),
# 	   (9, 2, 8, 1, 176, '1974-03-09', '190000', 14, 58, 39, 58),
# 	   (9, 2, 10, 1, 176, '1974-03-11', '190000', 15, 58, 39, 58),
# 	   (985, 4, 8, 2, 176, '1974-03-11', '190000', 16, 58, 39, 58),
# 	   (10, 3, 8, 2, 176, '1974-03-14', '190000', 17, 58, 39, 58),
# 	   (985, 1, 9, 1, 176, '1974-03-14', '190000', 18, 58, 39, 58);

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
