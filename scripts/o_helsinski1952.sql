# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Helsinki 1952

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Helsinki 1952', '1952-07-15', '1952-08-02', 9, '1952.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (55, 60, 1, 40, 1),
	   (55, 47, 2, 40, 2),
	   (55, 43, 1, 40, 1),
	   (55, 44, 2, 40, 2),
	   (55, 132, 3, 40, 3),
	   (55, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Luxembourg', 4, 115), ('Austria', 4, 13), ('Curaçao', 4, 53);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (905, 55), (902, 55), (904, 55), (930, 55),
	   (911, 55), (934, 55), (836, 55), (892, 55),
	   (910, 55), (928, 55), (889, 55), (886, 55),
	   (835, 55), (885, 55), (936, 55), (871, 55),
	   (877, 55), (898, 55), (919, 55), (937, 55),
	   (844, 55), (842, 55), (912, 55), (931, 55),
	   (938, 55);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (905, 2, null, null, 902, 1, null, null, 55, '1952-07-15', '190000', 1, 60, 40, null),
	   (904, 2, null, null, 930, 1, null, null, 55, '1952-07-15', '190000', 2, 60, 40, null),
	   (911, 10, null, null, 934, 1, null, null, 55, '1952-07-15', '190000', 3, 60, 40, null),
	   (836, 2, null, null, 892, 1, null, null, 55, '1952-07-15', '190000', 4, 60, 40, null),
	   (910, 0, 2, null, 928, 0, 1, null, 55, '1952-07-15', '190000', 5, 60, 40, null),
	   (889, 8, null, null, 886, 0, null, null, 55, '1952-07-16', '190000', 6, 60, 40, null),
	   (835, 5, null, null, 885, 1, null, null, 55, '1952-07-16', '190000', 7, 60, 40, null),
	   (936, 1, 4, null, 871, 1, 2, null, 55, '1952-07-16', '120000', 8, 60, 40, null),
	   (877, 5, null, null, 898, 4, null, null, 55, '1952-07-16', '190000', 9, 60, 40, null),
	   (919, 3, null, null, 937, 4, null, null, 55, '1952-07-19', '190000', 10, 47, 40, 13),
	   (835, 2, null, null, 936, 1, null, null, 55, '1952-07-20', '190000', 11, 47, 40, 16),
	   (911, 5, 0, null, 910, 5, 0, null, 55, '1952-07-20', '190000', 12, 47, 40, 15),
	   (844, 3, null, null, 877, 1, null, null, 55, '1952-07-20', '120000', 13, 47, 40, 17),
	   (836, 2, null, null, 905, 0, null, null, 55, '1952-07-21', '190000', 14, 47, 40, 14),
	   (842, 4, null, null, 912, 1, null, null, 55, '1952-07-21', '190000', 15, 47, 40, 12),
	   (904, 3, null, null, 889, 0, null, null, 55, '1952-07-21', '190000', 16, 47, 40, 10),
	   (931, 2, null, null, 938, 1, null, null, 55, '1952-07-21', '190000', 17, 47, 40, 11),
	   (911, 3, null, null, 910, 1, null, null, 55, '1952-07-22', '190000', 18, 59, 40, null),
	   (842, 3, null, null, 937, 1, null, null, 55, '1952-07-23', '190000', 19, 43, 40, 20),
	   (844, 2, 2, null, 835, 2, 0, null, 55, '1952-07-24', '120000', 20, 43, 40, 22),
	   (904, 7, null, null, 931, 1, null, null, 55, '1952-07-24', '190000', 21, 43, 40, 19),
	   (911, 5, null, null, 836, 3, null, null, 55, '1952-07-25', '190000', 22, 43, 40, 21),
	   (904, 6, null, null, 842, 0, null, null, 55, '1952-07-28', '190000', 23, 44, 40, 23),
	   (911, 3, null, null, 844, 1, null, null, 55, '1952-07-29', '190000', 24, 44, 40, 24),
	   (842, 2, null, null, 844, 0, null, null, 55, '1952-08-01', '190000', 25, 132, 40, 26),
	   (904, 2, null, null, 911, 0, null, null, 55, '1952-08-02', '190000', 26, 133, 40, 25);

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
