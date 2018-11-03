# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Roma 1960

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Roma 1960', '1960-08-26', '1960-09-10', 9, '1960.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (53, 41, 1, 39, 1),
	   (53, 44, 2, 40, 2),
	   (53, 132, 5, 40, 5),
	   (53, 133, 6, 40, 6);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Turkey', 4, 195), ('Chinese Taipei', 4, 43), ('Peru', 4, 149), ('India', 4, 91);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (911, 53, 1, 1),
	   (1080, 53, 1, 2),
	   (877, 53, 1, 3),
	   (931, 53, 1, 4),
	   (889, 53, 2, 1),
	   (835, 53, 2, 2),
	   (871, 53, 2, 3),
	   (932, 53, 2, 4),
	   (836, 53, 3, 1),
	   (849, 53, 3, 2),
	   (905, 53, 3, 3),
	   (895, 53, 3, 4),
	   (904, 53, 4, 1),
	   (902, 53, 4, 2),
	   (933, 53, 4, 3),
	   (934, 53, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (1080, 3, 931, 0, 53, '1960-08-26', '120000', 1, 41, 39),
	   (911, 6, 877, 1, 53, '1960-08-26', '120000', 2, 41, 39),
	   (1080, 2, 877, 0, 53, '1960-08-29', '120000', 9, 41, 39),
	   (911, 4, 931, 0, 53, '1960-08-29', '120000', 10, 41, 39),
	   (877, 3, 931, 3, 53, '1960-09-01', '120000', 17, 41, 39),
	   (911, 3, 1080, 3, 53, '1960-09-01', '120000', 18, 41, 39),
	   (835, 4, 871, 3, 53, '1960-08-26', '120000', 3, 41, 39),
	   (889, 4, 932, 1, 53, '1960-08-26', '120000', 4, 41, 39),
	   (835, 5, 932, 0, 53, '1960-08-29', '120000', 11, 41, 39),
	   (889, 2, 871, 2, 53, '1960-08-29', '120000', 12, 41, 39),
	   (889, 3, 835, 1, 53, '1960-09-01', '120000', 19, 41, 39),
	   (871, 3, 932, 2, 53, '1960-09-01', '120000', 20, 41, 39),
	   (836, 3, 849, 2, 53, '1960-08-26', '120000', 5, 41, 39),
	   (905, 6, 895, 1, 53, '1960-08-26', '120000', 6, 41, 39),
	   (836, 2, 905, 1, 53, '1960-08-29', '120000', 13, 41, 39),
	   (849, 2, 895, 1, 53, '1960-08-29', '120000', 14, 41, 39),
	   (849, 2, 905, 0, 53, '1960-09-01', '120000', 21, 41, 39),
	   (836, 3, 895, 1, 53, '1960-09-01', '120000', 22, 41, 39),
	   (902, 2, 933, 1, 53, '1960-08-26', '120000', 7, 41, 39),
	   (904, 2, 934, 1, 53, '1960-08-26', '120000', 8, 41, 39),
	   (902, 1, 934, 1, 53, '1960-08-29', '120000', 15, 41, 39),
	   (904, 6, 933, 2, 53, '1960-08-29', '120000', 16, 41, 39),
	   (933, 3, 934, 1, 53, '1960-09-01', '120000', 23, 41, 39),
	   (904, 7, 902, 0, 53, '1960-09-01', '120000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (889, 0, 1, null, 911, 0, 1, null, 53, '1960-09-05', '120000', 25, 44, 40, 25),
		  (836, 2, null, null, 904, 0, null, null, 53, '1960-09-05', '120000', 26, 44, 40, 26),
		  (904, 2, null, null, 889, 1, null, null, 53, '1960-09-09', '120000', 27, 132, 40, 28),
		  (911, 3, null, null, 836, 1, null, null, 53, '1960-09-10', '120000', 28, 133, 40, 27);

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
