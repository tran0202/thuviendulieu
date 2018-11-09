# Insert new tournament
# Replace all the tournament_id

# Euro 1996 England

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule)
VALUES ('UEFA Euro 1996 England', '1996-06-08', '1996-06-30', 11, 'Euro_1996.png', 1);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (73, 41, 1, 39, 1),
	   (73, 43, 1, 40, 2),
	   (73, 44, 2, 40, 2),
	   (73, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
# VALUES ('FR Yugoslavia', 1, 227, 24);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (20, 73, 1, 1),
	   (204, 73, 1, 2),
	   (220, 73, 1, 3),
	   (26, 73, 1, 4),
	   (21, 73, 2, 1),
	   (6, 73, 2, 2),
	   (223, 73, 2, 3),
	   (226, 73, 2, 4),
	   (2, 73, 3, 1),
	   (213, 73, 3, 2),
	   (203, 73, 3, 3),
	   (23, 73, 3, 4),
	   (4, 73, 4, 1),
	   (18, 73, 4, 2),
	   (19, 73, 4, 3),
	   (218, 73, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (20, 1, 26, 1, 73, '1996-06-08', '150000', 1, 41, 39),
	   (204, 0, 220, 0, 73, '1996-06-10', '163000', 2, 41, 39),
	   (6, 1, 223, 1, 73, '1996-06-09', '143000', 3, 41, 39),
	   (226, 0, 21, 1, 73, '1996-06-10', '193000', 4, 41, 39),
	   (2, 2, 213, 0, 73, '1996-06-09', '170000', 5, 41, 39),
	   (203, 2, 23, 1, 73, '1996-06-11', '163000', 6, 41, 39),
	   (19, 1, 4, 1, 73, '1996-06-09', '193000', 7, 41, 39),
	   (218, 0, 18, 1, 73, '1996-06-11', '193000', 8, 41, 39),
	   (26, 0, 204, 2, 73, '1996-06-13', '193000', 9, 41, 39),
	   (220, 0, 20, 2, 73, '1996-06-15', '150000', 10, 41, 39),
	   (223, 1, 226, 0, 73, '1996-06-13', '163000', 11, 41, 39),
	   (21, 1, 6, 1, 73, '1996-06-15', '180000', 12, 41, 39),
	   (213, 2, 203, 1, 73, '1996-06-14', '193000', 13, 41, 39),
	   (23, 0, 2, 3, 73, '1996-06-16', '150000', 14, 41, 39),
	   (4, 1, 218, 0, 73, '1996-06-14', '163000', 15, 41, 39),
	   (18, 3, 19, 0, 73, '1996-06-16', '180000', 16, 41, 39),
	   (220, 1, 26, 0, 73, '1996-06-18', '193000', 17, 41, 39),
	   (204, 1, 20, 4, 73, '1996-06-18', '193000', 18, 41, 39),
	   (21, 3, 223, 1, 73, '1996-06-18', '163000', 19, 41, 39),
	   (226, 1, 6, 2, 73, '1996-06-18', '163000', 20, 41, 39),
	   (23, 3, 213, 3, 73, '1996-06-19', '193000', 21, 41, 39),
	   (203, 0, 2, 0, 73, '1996-06-19', '193000', 22, 41, 39),
	   (18, 0, 4, 3, 73, '1996-06-19', '163000', 23, 41, 39),
	   (218, 0, 19, 3, 73, '1996-06-19', '163000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (6, 0, 0, 2, 20, 0, 0, 4, 73, '1996-06-22', '150000', 25, 43, 40, 28),
	   (21, 0, 0, 5, 204, 0, 0, 4, 73, '1996-06-22', '183000', 26, 43, 40, 25),
	   (2, 2, null, null, 18, 1, null, null, 73, '1996-06-23', '150000', 27, 43, 40, 27),
	   (213, 1, null, null, 4, 0, null, null, 73, '1996-06-23', '183000', 28, 43, 40, 26),
	   (21, 0, 0, 5, 213, 0, 0, 6, 73, '1996-06-26', '160000', 29, 44, 40, 29),
	   (2, 1, 0, 6, 20, 1, 0, 5, 73, '1996-06-26', '193000', 30, 44, 40, 30),
	   (213, 1, 0, null, 2, 1, 1, null, 73, '1996-06-30', '190000', 31, 46, 40, 31);

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
	parent_team_id INT,
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
