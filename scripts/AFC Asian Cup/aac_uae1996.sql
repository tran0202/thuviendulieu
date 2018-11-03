# Insert new tournament
# Replace all the tournament_id

# 1996 AFC Asian Cup United Arab Emirates

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1996 AFC Asian Cup United Arab Emirates', '1996-12-04', '1996-12-21', 15, 'aac_1996.png', 1, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (190, 41, 1, 39, 1),
	   (190, 43, 1, 40, 1),
	   (190, 44, 2, 40, 2),
	   (190, 45, 3, 40, 3),
	   (190, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Lebanon', 1, 109, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (229, 190, 1, 1),
	   (237, 190, 1, 2),
	   (16, 190, 1, 3),
	   (245, 190, 1, 4),
	   (14, 190, 2, 1),
	   (17, 190, 2, 2),
	   (235, 190, 2, 3),
	   (1022, 190, 2, 4),
	   (15, 190, 3, 1),
	   (219, 190, 3, 2),
	   (1020, 190, 3, 3),
	   (1009, 190, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (229, 1, 16, 1, 190, '1996-12-04', '164500', 1, 41, 39),
	   (245, 2, 237, 2, 190, '1996-12-04', '184500', 2, 41, 39),
	   (17, 6, 1022, 0, 190, '1996-12-05', '164500', 3, 41, 39),
	   (14, 1, 235, 2, 190, '1996-12-05', '190000', 4, 41, 39),
	   (15, 2, 1020, 1, 190, '1996-12-06', '164500', 5, 41, 39),
	   (219, 0, 1009, 2, 190, '1996-12-06', '190000', 6, 41, 39),
	   (229, 3, 237, 2, 190, '1996-12-07', '164500', 7, 41, 39),
	   (16, 4, 245, 2, 190, '1996-12-07', '190000', 8, 41, 39),
	   (17, 1, 235, 0, 190, '1996-12-08', '164500', 9, 41, 39),
	   (1022, 1, 14, 3, 190, '1996-12-08', '190000', 10, 41, 39),
	   (15, 4, 1009, 0, 190, '1996-12-09', '164500', 11, 41, 39),
	   (1020, 0, 219, 3, 190, '1996-12-09', '190000', 12, 41, 39),
	   (229, 2, 245, 0, 190, '1996-12-10', '164500', 13, 41, 39),
	   (237, 2, 16, 0, 190, '1996-12-10', '190000', 14, 41, 39),
	   (17, 0, 14, 3, 190, '1996-12-11', '164500', 15, 41, 39),
	   (235, 4, 1022, 1, 190, '1996-12-11', '190000', 16, 41, 39),
	   (15, 1, 219, 0, 190, '1996-12-12', '164500', 17, 41, 39),
	   (1009, 1, 1020, 2, 190, '1996-12-12', '190000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (229, 0, 1, null, 235, 0, 0, null, 190, '1996-12-15', '164500', 19, 43, 40, 19),
	   (237, 2, null, null, 15, 0, null, null, 190, '1996-12-15', '193000', 20, 43, 40, 20),
	   (16, 2, null, null, 14, 6, null, null, 190, '1996-12-16', '164500', 21, 43, 40, 21),
	   (17, 4, null, null, 219, 3, null, null, 190, '1996-12-16', '193000', 22, 43, 40, 22),
	   (229, 1, null, null, 237, 0, null, null, 190, '1996-12-19', '164500', 23, 44, 40, 23),
	   (14, 0, 0, 3, 17, 0, 0, 4, 190, '1996-12-19', '193000', 24, 44, 40, 24),
	   (14, 1, 0, 3, 237, 1, 0, 2, 190, '1996-12-21', '164500', 25, 45, 40, 26),
	   (229, 0, 0, 2, 17, 0, 0, 4, 190, '1996-12-21', '193000', 26, 46, 40, 25);

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
