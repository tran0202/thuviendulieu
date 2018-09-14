# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament London 1948

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament London 1948', '1948-07-26', '1948-08-13', 9, '1948.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (56, 60, 1, 40, 1),
	   (56, 47, 2, 40, 2),
	   (56, 43, 3, 40, 3),
	   (56, 44, 4, 40, 4),
	   (56, 132, 5, 40, 5),
	   (56, 133, 6, 40, 6);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Afghanistan', 4, 1), ('Republic of Ireland', 4, 155);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (936, 56), (939, 56), (885, 56), (940, 56),
	   (911, 56), (836, 56), (877, 56), (871, 56),
	   (902, 56), (934, 56), (931, 56), (888, 56),
	   (842, 56), (937, 56), (843, 56), (845, 56),
	   (889, 56), (886, 56);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (936, 6, null, null, 939, 0, null, null, 56, '1948-07-26', '180000', 1, 60, 40, null),
	   (885, 3, null, null, 940, 1, null, null, 56, '1948-07-26', '180000', 2, 60, 40, null),
	   (911, 6, null, null, 936, 1, null, null, 56, '1948-07-31', '183000', 3, 47, 40, 3),
	   (836, 1, 2, null, 877, 1, 0, null, 56, '1948-07-31', '183000', 4, 47, 40, 9),
	   (871, 3, 1, null, 885, 3, 0, null, 56, '1948-07-31', '183000', 5, 47, 40, 5),
	   (902, 2, null, null, 934, 1, null, null, 56, '1948-07-31', '183000', 6, 47, 40, 6),
	   (931, 4, null, null, 888, 0, null, null, 56, '1948-08-02', '183000', 7, 47, 40, 4),
	   (842, 3, null, null, 937, 0, null, null, 56, '1948-08-02', '183000', 8, 47, 40, 7),
	   (843, 5, null, null, 845, 3, null, null, 56, '1948-08-02', '183000', 9, 47, 40, 8),
	   (889, 9, null, null, 886, 0, null, null, 56, '1948-08-02', '183000', 10, 47, 40, 10),
	   (911, 3, null, null, 937, 1, null, null, 56, '1948-08-05', '183000', 11, 43, 40, 11),
	   (842, 12, null, null, 843, 0, null, null, 56, '1948-08-05', '183000', 12, 43, 40, 13),
	   (871, 1, null, null, 902, 0, null, null, 56, '1948-08-05', '183000', 13, 43, 40, 12),
	   (836, 5, null, null, 889, 3, null, null, 56, '1948-08-05', '183000', 14, 43, 40, 14),
	   (842, 4, null, null, 836, 2, null, null, 56, '1948-08-10', '183000', 15, 44, 40, 16),
	   (871, 1, null, null, 911, 3, null, null, 56, '1948-08-11', '183000', 16, 44, 40, 15),
	   (871, 3, null, null, 836, 5, null, null, 56, '1948-08-13', '140000', 17, 132, 40, 18),
	   (842, 3, null, null, 911, 1, null, null, 56, '1948-08-13', '183000', 18, 133, 40, 17);

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
