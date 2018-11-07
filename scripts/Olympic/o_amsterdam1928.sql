# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Amsterdam 1928

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Amsterdam 1928', '1928-05-27', '1928-06-13', 9, '1928.jpg', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (58, 60, 1, 40, 1),
	   (58, 47, 2, 40, 2),
	   (58, 43, 3, 40, 3),
	   (58, 62, 4, 40, 4),
	   (58, 44, 5, 40, 5),
	   (58, 132, 6, 40, 6),
	   (58, 133, 7, 40, 7),
	   (58, 136, 8, 40, 8);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Afghanistan', 4, 1), ('Republic of Ireland', 4, 155);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (847, 58), (898, 58), (887, 58), (936, 58),
	   (844, 58), (876, 58), (1075, 58), (931, 58),
	   (1070, 58), (902, 58), (1071, 58), (849, 58),
	   (886, 58), (1072, 58), (845, 58), (885, 58),
	   (873, 58);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (847, 4, null, null, 898, 2, null, null, 58, '1928-05-27', '150000', 1, 60, 40, null),
	   (887, 5, null, null, 936, 3, null, null, 58, '1928-05-27', '190000', 2, 47, 40, 8),
	   (844, 4, null, null, 876, 0, null, null, 58, '1928-05-28', '140000', 3, 47, 40, 3),
	   (1075, 7, null, null, 931, 1, null, null, 58, '1928-05-28', '190000', 4, 47, 40, 6),
	   (1070, 4, null, null, 902, 3, null, null, 58, '1928-05-29', '140000', 5, 47, 40, 4),
	   (847, 2, null, null, 1071, 1, null, null, 58, '1928-05-29', '160000', 6, 47, 40, 7),
	   (849, 11, null, null, 886, 2, null, null, 58, '1928-05-29', '190000', 7, 47, 40, 9),
	   (1072, 7, null, null, 845, 1, null, null, 58, '1928-05-30', '140000', 8, 47, 40, 5),
	   (885, 0, null, null, 873, 2, null, null, 58, '1928-05-30', '190000', 9, 47, 40, 2),
	   (1070, 1, null, null, 1072, 1, null, null, 58, '1928-06-01', '190000', 10, 43, 40, 11),
	   (849, 6, null, null, 887, 3, null, null, 58, '1928-06-02', '160000', 11, 43, 40, 13),
	   (873, 4, null, null, 844, 1, null, null, 58, '1928-06-03', '160000', 12, 43, 40, 10),
	   (1075, 2, null, null, 847, 1, null, null, 58, '1928-06-04', '190000', 13, 43, 40, 12),
	   (1070, 7, null, null, 1072, 1, null, null, 58, '1928-06-04', '140000', 14, 62, 40, null),
	   (849, 6, null, null, 1075, 0, null, null, 58, '1928-06-07', '190000', 15, 44, 40, 16),
	   (873, 3, null, null, 1070, 2, null, null, 58, '1928-06-07', '190000', 16, 44, 40, 15),
	   (1070, 11, null, null, 1075, 3, null, null, 58, '1928-06-09', '160000', 17, 132, 40, 18),
	   (873, 1, 0, null, 849, 1, 0, null, 58, '1928-06-10', '160000', 18, 133, 40, 17),
	   (873, 2, null, null, 937, 1, null, null, 58, '1928-06-13', '190000', 19, 136, 40, 15);

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
