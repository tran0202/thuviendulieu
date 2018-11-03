# Insert new tournament
# Replace all the tournament_id

# Women's Olympic Football Tournament Sydney 2000

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Women''s Olympic Football Tournament Sydney 2000', '2000-09-13', '2000-09-28', 10, '2000.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (66, 41, 1, 39, 1),
	   (66, 44, 2, 40, 2),
	   (66, 132, 3, 40, 3),
	   (66, 133, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 5 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Mexico', 5, 125), ('Greece', 5, 79);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (856, 66, 5, 1),
	   (851, 66, 5, 2),
	   (853, 66, 5, 3),
	   (857, 66, 5, 4),
	   (859, 66, 6, 1),
	   (952, 66, 6, 2),
	   (852, 66, 6, 3),
	   (951, 66, 6, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (857, 0, 856, 3, 66, '2000-09-13', '170000', 1, 41, 39),
	   (853, 0, 851, 2, 66, '2000-09-13', '170000', 2, 41, 39),
	   (857, 1, 853, 1, 66, '2000-09-16', '170000', 5, 41, 39),
	   (856, 2, 851, 1, 66, '2000-09-16', '173000', 6, 41, 39),
	   (857, 1, 851, 1, 66, '2000-09-19', '173000', 9, 41, 39),
	   (856, 1, 853, 0, 66, '2000-09-19', '173000', 10, 41, 39),
	   (859, 2, 952, 0, 66, '2000-09-14', '173000', 3, 41, 39),
	   (852, 3, 951, 1, 66, '2000-09-14', '173000', 4, 41, 39),
	   (859, 1, 852, 1, 66, '2000-09-17', '173000', 7, 41, 39),
	   (952, 3, 951, 1, 66, '2000-09-17', '173000', 8, 41, 39),
	   (859, 3, 951, 1, 66, '2000-09-20', '173000', 11, 41, 39),
	   (952, 2, 852, 1, 66, '2000-09-20', '173000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (856, 0, null, null, 952, 1, null, null, 66, '2000-09-24', '173000', 13, 44, 40, 13),
	   (859, 1, null, null, 851, 0, null, null, 66, '2000-09-24', '173000', 14, 44, 40, 14),
	   (856, 2, null, null, 851, 0, null, null, 66, '2000-09-28', '170000', 15, 132, 40, 16),
	   (952, 2, 1, null, 859, 2, 0, null, 66, '2000-09-28', '200000', 16, 133, 40, 15);

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
