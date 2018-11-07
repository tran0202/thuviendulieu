# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Stockholm 1912

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Stockholm 1912', '1912-06-29', '1912-07-04', 9, '1912.gif', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (61, 47, 1, 40, 1),
	   (61, 43, 2, 40, 2),
	   (61, 44, 3, 40, 3),
	   (61, 132, 4, 40, 4),
	   (61, 133, 5, 40, 5),
	   (61, 134, 6, 138, 6),
	   (61, 139, 7, 138, 7),
	   (61, 140, 8, 138, 8);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Russia', 4, 157);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (1070, 61), (1067, 61), (1068, 61), (1069, 61),
	   (885, 61), (842, 61), (944, 61), (871, 61),
	   (1066, 61), (836, 61), (912, 61);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (1070, 2, 1, null, 1067, 2, 0, null, 61, '1912-06-29', '120000', 1, 47, 40, 1),
	   (1068, 5, null, null, 1069, 1, null, null, 61, '1912-06-29', '120000', 2, 47, 40, 2),
	   (885, 3, 1, null, 842, 3, 0, null, 61, '1912-06-29', '120000', 3, 47, 40, 3),
	   (1067, 2, null, null, 944, 1, null, null, 61, '1912-06-30', '120000', 4, 43, 40, 5),
	   (871, 7, null, null, 1066, 0, null, null, 61, '1912-06-30', '120000', 5, 43, 40, 4),
	   (836, 7, null, null, 912, 0, null, null, 61, '1912-06-30', '120000', 6, 43, 40, 6),
	   (885, 3, null, null, 1068, 1, null, null, 61, '1912-06-30', '120000', 7, 43, 40, 7),
	   (871, 4, null, null, 1067, 0, null, null, 61, '1912-07-02', '120000', 8, 44, 40, 8),
	   (836, 4, null, null, 885, 1, null, null, 61, '1912-07-02', '120000', 9, 44, 40, 9),
	   (885, 9, null, null, 1067, 0, null, null, 61, '1912-07-04', '120000', 10, 132, 40, 11),
	   (871, 4, null, null, 836, 2, null, null, 61, '1912-07-04', '120000', 11, 133, 40, 10),
	   (1068, 1, null, null, 912, 0, null, null, 61, '1912-07-01', '120000', 12, 134, 40, null),
	   (1069, 16, null, null, 944, 0, null, null, 61, '1912-07-01', '120000', 13, 134, 40, null),
	   (1070, 1, null, null, 842, 0, null, null, 61, '1912-07-01', '120000', 14, 134, 138, null),
	   (1066, 3, null, null, 1069, 1, null, null, 61, '1912-07-03', '120000', 15, 139, 138, null),
	   (1068, 5, null, null, 1070, 1, null, null, 61, '1912-07-03', '120000', 16, 139, 138, null),
	   (1066, 3, null, null, 1068, 0, null, null, 61, '1912-07-05', '120000', 17, 140, 138, null);

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
