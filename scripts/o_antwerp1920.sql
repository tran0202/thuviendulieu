# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Antwerp 1920

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Antwerp 1920', '1920-08-28', '1920-09-05', 9, '1920.gif', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (60, 47, 1, 40, 1),
	   (60, 43, 2, 40, 2),
	   (60, 44, 3, 40, 3),
	   (60, 133, 4, 40, 4),
	   (60, 134, 1, 138, 1),
	   (60, 139, 2, 138, 2),
	   (60, 140, 3, 138, 3);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Lithuania', 4, 114), ('Estonia', 4, 66), ('Latvia', 4, 108);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (902, 60), (887, 60), (916, 60), (911, 60), (881, 60), (836, 60),
	   (889, 60), (877, 60), (912, 60), (871, 60),
	   (885, 60), (936, 60), (842, 60), (892, 60);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (916, 7, null, null, 911, 0, null, null, 60, '1920-08-28', '100000', 1, 47, 40, 1),
	   (881, 1, null, null, 836, 0, null, null, 60, '1920-08-28', '153000', 2, 47, 40, 4),
	   (889, 2, null, null, 877, 1, null, null, 60, '1920-08-28', '100000', 3, 47, 40, 3),
	   (912, 3, null, null, 871, 1, null, null, 60, '1920-08-28', '153000', 4, 47, 40, 2),
	   (885, 3, null, null, 936, 0, null, null, 60, '1920-08-28', '173000', 5, 47, 40, 5),
	   (842, 9, null, null, 892, 0, null, null, 60, '1920-08-28', '173000', 6, 47, 40, 6),
	   (885, 4, 1, null, 842, 4, 0, null, 60, '1920-08-29', '100000', 7, 43, 40, 10),
	   (916, 4, null, null, 912, 0, null, null, 60, '1920-08-29', '163000', 8, 43, 40, 7),
	   (902, 3, null, null, 889, 1, null, null, 60, '1920-08-29', '150000', 9, 43, 40, 8),
	   (887, 3, null, null, 881, 1, null, null, 60, '1920-08-29', '170000', 10, 43, 40, 9),
	   (916, 4, null, null, 902, 1, null, null, 60, '1920-08-31', '153500', 11, 44, 40, 11),
	   (887, 3, null, null, 885, 0, null, null, 60, '1920-08-31', '172500', 12, 44, 40, 12),
	   (887, 2, null, null, 916, 0, null, null, 60, '1920-09-02', '173000', 13, 133, 40, 13),
	   (889, 1, 1, null, 912, 1, 0, null, 60, '1920-08-31', '100000', 14, 134, 138, null),
	   (881, 2, null, null, 842, 1, null, null, 60, '1920-09-01', '120000', 15, 134, 138, null),
	   (881, 2, null, null, 889, 0, null, null, 60, '1920-09-02', '120000', 16, 139, 138, null),
	   (881, 3, null, null, 885, 1, null, null, 60, '1920-09-05', '150000', 17, 140, 138, null);

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
