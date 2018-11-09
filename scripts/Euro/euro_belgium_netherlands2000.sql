# Insert new tournament
# Replace all the tournament_id

# Euro 2000 Belgium-Netherlands

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule)
VALUES ('UEFA Euro 2000 Belgium-Netherlands', '2000-06-10', '2000-07-02', 11, 'Euro_2000.png', 1);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (72, 41, 1, 39, 1),
	   (72, 43, 1, 40, 2),
	   (72, 44, 2, 40, 2),
	   (72, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('FR Yugoslavia', 1, 227, 24);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (4, 72, 1, 1),
	   (226, 72, 1, 2),
	   (20, 72, 1, 3),
	   (2, 72, 1, 4),
	   (203, 72, 2, 1),
	   (218, 72, 2, 2),
	   (5, 72, 2, 3),
	   (25, 72, 2, 4),
	   (6, 72, 3, 1),
	   (961, 72, 3, 2),
	   (221, 72, 3, 3),
	   (206, 72, 3, 4),
	   (204, 72, 4, 1),
	   (21, 72, 4, 2),
	   (213, 72, 4, 3),
	   (19, 72, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (2, 1, 226, 1, 72, '2000-06-12', '180000', 1, 41, 39),
	   (4, 3, 20, 2, 72, '2000-06-12', '204500', 2, 41, 39),
	   (5, 2, 25, 1, 72, '2000-06-10', '204500', 3, 41, 39),
	   (218, 1, 203, 2, 72, '2000-06-11', '143000', 4, 41, 39),
	   (6, 0, 221, 1, 72, '2000-06-13', '180000', 5, 41, 39),
	   (961, 3, 206, 3, 72, '2000-06-13', '204500', 6, 41, 39),
	   (21, 3, 19, 0, 72, '2000-06-11', '180000', 7, 41, 39),
	   (204, 1, 213, 0, 72, '2000-06-11', '204500', 8, 41, 39),
	   (226, 0, 4, 1, 72, '2000-06-17', '180000', 9, 41, 39),
	   (20, 1, 2, 0, 72, '2000-06-17', '204500', 10, 41, 39),
	   (203, 2, 5, 0, 72, '2000-06-14', '204500', 11, 41, 39),
	   (25, 0, 218, 0, 72, '2000-06-15', '204500', 12, 41, 39),
	   (206, 1, 6, 2, 72, '2000-06-18', '180000', 13, 41, 39),
	   (221, 0, 961, 1, 72, '2000-06-18', '204500', 14, 41, 39),
	   (213, 1, 21, 2, 72, '2000-06-16', '180000', 15, 41, 39),
	   (19, 0, 204, 3, 72, '2000-06-16', '204500', 16, 41, 39),
	   (20, 2, 226, 3, 72, '2000-06-20', '204500', 17, 41, 39),
	   (4, 3, 2, 0, 72, '2000-06-20', '204500', 18, 41, 39),
	   (218, 2, 5, 0, 72, '2000-06-19', '204500', 19, 41, 39),
	   (203, 2, 25, 1, 72, '2000-06-19', '204500', 20, 41, 39),
	   (961, 3, 6, 4, 72, '2000-06-21', '180000', 21, 41, 39),
	   (206, 0, 221, 0, 72, '2000-06-21', '180000', 22, 41, 39),
	   (19, 0, 213, 2, 72, '2000-06-21', '204500', 23, 41, 39),
	   (21, 2, 204, 3, 72, '2000-06-21', '204500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (218, 0, null, null, 4, 2, null, null, 72, '2000-06-24', '180000', 25, 43, 40, 26),
	   (203, 2, null, null, 226, 0, null, null, 72, '2000-06-24', '204500', 26, 43, 40, 27),
	   (204, 6, null, null, 961, 1, null, null, 72, '2000-06-25', '180000', 27, 43, 40, 28),
	   (6, 1, null, null, 21, 2, null, null, 72, '2000-06-25', '204500', 28, 43, 40, 25),
	   (21, 1, 1, null, 4, 1, 0, null, 72, '2000-06-28', '204500', 29, 44, 40, 29),
	   (203, 0, 0, 3, 204, 0, 0, 1, 72, '2000-06-29', '180000', 30, 44, 40, 30),
	   (21, 1, 1, null, 203, 1, 0, null, 72, '2000-07-02', '200000', 31, 46, 40, 31);

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
