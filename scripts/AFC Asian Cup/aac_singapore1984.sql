# Insert new tournament
# Replace all the tournament_id

# 1984 AFC Asian Cup Singapore

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1984 AFC Asian Cup Singapore', '1984-12-01', '1984-12-16', 15, 'AFC.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (193, 41, 1, 39, 1),
	   (193, 44, 1, 40, 2),
	   (193, 45, 2, 40, 2),
	   (193, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Singapore', 1, 168, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (17, 193, 1, 1),
	   (237, 193, 1, 2),
	   (1011, 193, 1, 3),
	   (1020, 193, 1, 4),
	   (16, 193, 1, 5),
	   (219, 193, 2, 1),
	   (14, 193, 2, 2),
	   (229, 193, 2, 3),
	   (1026, 193, 2, 4),
	   (1021, 193, 2, 5);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1011, 1, 1020, 1, 193, '1984-12-01', '190000', 1, 41, 39),
	   (14, 3, 229, 0, 193, '1984-12-01', '210000', 2, 41, 39),
	   (17, 1, 16, 1, 193, '1984-12-02', '190000', 3, 41, 39),
	   (1026, 2, 1021, 0, 193, '1984-12-02', '210000', 4, 41, 39),
	   (237, 1, 1011, 0, 193, '1984-12-03', '210000', 5, 41, 39),
	   (14, 2, 219, 0, 193, '1984-12-03', '190000', 6, 41, 39),
	   (1020, 0, 17, 1, 193, '1984-12-04', '210000', 7, 41, 39),
	   (229, 2, 1021, 0, 193, '1984-12-04', '190000', 8, 41, 39),
	   (16, 0, 237, 0, 193, '1984-12-05', '190000', 9, 41, 39),
	   (1026, 0, 219, 2, 193, '1984-12-05', '210000', 10, 41, 39),
	   (1020, 1, 16, 0, 193, '1984-12-07', '210000', 11, 41, 39),
	   (14, 0, 1021, 0, 193, '1984-12-07', '190000', 12, 41, 39),
	   (1011, 1, 17, 1, 193, '1984-12-08', '190000', 13, 41, 39),
	   (1026, 0, 229, 1, 193, '1984-12-08', '210000', 14, 41, 39),
	   (237, 3, 1020, 1, 193, '1984-12-09', '190000', 15, 41, 39),
	   (219, 3, 1021, 0, 193, '1984-12-09', '210000', 16, 41, 39),
	   (16, 0, 1011, 1, 193, '1984-12-10', '210000', 17, 41, 39),
	   (1026, 1, 14, 1, 193, '1984-12-10', '190000', 18, 41, 39),
	   (237, 0, 17, 1, 193, '1984-12-11', '210000', 19, 41, 39),
	   (219, 5, 229, 0, 193, '1984-12-11', '190000', 20, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (17, 1, 0, 5, 14, 1, 0, 4, 193, '1984-12-13', '200000', 21, 44, 40, 21),
	   (219, 0, 1, null, 237, 0, 0, null, 193, '1984-12-14', '200000', 22, 44, 40, 22),
	   (14, 1, 0, 3, 237, 1, 0, 5, 193, '1984-12-16', '180000', 23, 45, 40, 24),
	   (17, 2, null, null, 219, 0, null, null, 193, '1984-12-16', '200000', 24, 46, 40, 23);

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
