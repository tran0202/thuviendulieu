# Insert new tournament
# Replace all the tournament_id

# 1980 AFC Asian Cup Kuwait

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1980 AFC Asian Cup Kuwait', '1980-09-15', '1980-09-30', 15, 'AFC.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (194, 41, 1, 39, 1),
	   (194, 44, 1, 40, 1),
	   (194, 45, 2, 40, 2),
	   (194, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Bangladesh', 1, 17, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (14, 194, 1, 1),
	   (210, 194, 1, 2),
	   (1020, 194, 1, 3),
	   (219, 194, 1, 4),
	   (1027, 194, 1, 5),
	   (16, 194, 2, 1),
	   (237, 194, 2, 2),
	   (1023, 194, 2, 3),
	   (1011, 194, 2, 4),
	   (229, 194, 2, 5);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (229, 1, 237, 1, 194, '1980-09-15', '190000', 1, 41, 39),
	   (210, 3, 1027, 2, 194, '1980-09-16', '210000', 2, 41, 39),
	   (16, 1, 1023, 1, 194, '1980-09-16', '183000', 3, 41, 39),
	   (14, 0, 1020, 0, 194, '1980-09-17', '210000', 4, 41, 39),
	   (1011, 2, 229, 1, 194, '1980-09-17', '210000', 5, 41, 39),
	   (210, 2, 219, 1, 194, '1980-09-18', '190000', 6, 41, 39),
	   (237, 3, 1023, 1, 194, '1980-09-18', '210000', 7, 41, 39),
	   (1027, 0, 1020, 1, 194, '1980-09-19', '190000', 8, 41, 39),
	   (1011, 0, 16, 2, 194, '1980-09-19', '183000', 9, 41, 39),
	   (219, 2, 14, 2, 194, '1980-09-20', '210000', 10, 41, 39),
	   (1023, 2, 229, 0, 194, '1980-09-20', '210000', 11, 41, 39),
	   (237, 0, 16, 3, 194, '1980-09-21', '163000', 12, 41, 39),
	   (1027, 0, 14, 7, 194, '1980-09-22', '190000', 13, 41, 39),
	   (1020, 1, 219, 0, 194, '1980-09-23', '210000', 14, 41, 39),
	   (1023, 1, 1011, 1, 194, '1980-09-23', '190000', 15, 41, 39),
	   (14, 3, 210, 2, 194, '1980-09-24', '210000', 16, 41, 39),
	   (16, 4, 229, 1, 194, '1980-09-24', '183000', 17, 41, 39),
	   (219, 6, 1027, 0, 194, '1980-09-25', '190000', 18, 41, 39),
	   (237, 4, 1011, 0, 194, '1980-09-25', '210000', 19, 41, 39),
	   (210, 2, 1020, 1, 194, '1980-09-26', '190000', 20, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (14, 1, null, null, 237, 2, null, null, 194, '1980-09-28', '200000', 21, 44, 40, 21),
	   (16, 2, null, null, 210, 1, null, null, 194, '1980-09-28', '193000', 22, 44, 40, 22),
	   (14, 3, null, null, 210, 0, null, null, 194, '1980-09-29', '180000', 23, 45, 40, 24),
	   (237, 3, null, null, 16, 0, null, null, 194, '1980-09-30', '183000', 24, 46, 40, 23);

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
