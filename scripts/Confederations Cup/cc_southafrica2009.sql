# Insert new tournament
# Replace all the tournament_id

# 2009 FIFA Confederations Cup South Africa

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2009 FIFA Confederations Cup South Africa', '2009-06-14', '2009-06-28', 17, 'cc_2009.png', null, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (213, 41, 1, 39, 1),
	   (213, 44, 1, 40, 2),
	   (213, 45, 2, 40, 2),
	   (213, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
# INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
# VALUES ('Papua New Guinea', 1, 147, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (6, 213, 1, 1),
	   (205, 213, 1, 2),
	   (1064, 213, 1, 3),
	   (208, 213, 1, 4),
	   (1, 213, 2, 1),
	   (198, 213, 2, 2),
	   (203, 213, 2, 3),
	   (8, 213, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (205, 0, 1064, 0, 213, '2009-06-14', '180000', 1, 41, 39),
	   (208, 0, 6, 5, 213, '2009-06-14', '180000', 2, 41, 39),
	   (1, 4, 8, 3, 213, '2009-06-15', '210000', 3, 41, 39),
	   (198, 1, 203, 3, 213, '2009-06-15', '180000', 4, 41, 39),
	   (6, 1, 1064, 0, 213, '2009-06-17', '180000', 5, 41, 39),
	   (205, 2, 208, 0, 213, '2009-06-17', '210000', 6, 41, 39),
	   (198, 0, 1, 3, 213, '2009-06-18', '180000', 7, 41, 39),
	   (8, 1, 203, 0, 213, '2009-06-18', '210000', 8, 41, 39),
	   (1064, 0, 208, 0, 213, '2009-06-20', '180000', 9, 41, 39),
	   (6, 2, 205, 0, 213, '2009-06-20', '180000', 10, 41, 39),
	   (203, 0, 1, 3, 213, '2009-06-21', '180000', 11, 41, 39),
	   (8, 0, 198, 3, 213, '2009-06-21', '180000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (6, 0, null, null, 198, 2, null, null, 213, '2009-06-24', '203000', 13, 44, 40, 13),
	   (1, 1, null, null, 205, 0, null, null, 213, '2009-06-25', '203000', 14, 44, 40, 14),
	   (6, 2, 1, null, 205, 2, 0, null, 213, '2009-06-28', '150000', 15, 45, 40, 16),
	   (198, 2, null, null, 1, 3, null, null, 213, '2009-06-28', '203000', 16, 46, 40, 15);

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
