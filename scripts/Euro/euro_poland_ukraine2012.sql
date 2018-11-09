# Insert new tournament
# Replace all the tournament_id

# Euro 2012 Poland-Ukraine

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('UEFA Euro 2012 Poland-Ukraine', '2012-06-08', '2012-07-01', 11, 'Euro_2012.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (69, 41, 1, 39, 1),
	   (69, 43, 1, 40, 2),
	   (69, 44, 2, 40, 2),
	   (69, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Great Britain', 4, 212), ('Senegal', 4, 164), ('Uruguay', 4, 201), ('United Arab Emirates', 4, 200),
# 	   ('Gabon', 4, 73), ('Switzerland', 4, 184), ('Egypt', 4, 61), ('Belarus', 4, 19),
# 	   ('New Zealand', 4, 137), ('Morocco', 4, 130), ('Spain', 4, 175);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (213, 69, 1, 1),
	   (202, 69, 1, 2),
	   (23, 69, 1, 3),
	   (7, 69, 1, 4),
	   (2, 69, 2, 1),
	   (4, 69, 2, 2),
	   (19, 69, 2, 3),
	   (204, 69, 2, 4),
	   (6, 69, 3, 1),
	   (203, 69, 3, 2),
	   (18, 69, 3, 3),
	   (217, 69, 3, 4),
	   (20, 69, 4, 1),
	   (21, 69, 4, 2),
	   (215, 69, 4, 3),
	   (25, 69, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (7, 1, 202, 1, 69, '2012-06-08', '180000', 1, 41, 39),
	   (23, 4, 213, 1, 69, '2012-06-08', '204500', 2, 41, 39),
	   (204, 0, 19, 1, 69, '2012-06-09', '190000', 3, 41, 39),
	   (2, 1, 4, 0, 69, '2012-06-09', '214500', 4, 41, 39),
	   (6, 1, 203, 1, 69, '2012-06-10', '180000', 5, 41, 39),
	   (217, 1, 18, 3, 69, '2012-06-10', '204500', 6, 41, 39),
	   (21, 1, 20, 1, 69, '2012-06-11', '190000', 7, 41, 39),
	   (215, 2, 25, 1, 69, '2012-06-11', '214500', 8, 41, 39),
	   (202, 1, 213, 2, 69, '2012-06-12', '180000', 9, 41, 39),
	   (7, 1, 23, 1, 69, '2012-06-12', '204500', 10, 41, 39),
	   (19, 2, 4, 3, 69, '2012-06-13', '190000', 11, 41, 39),
	   (204, 1, 2, 2, 69, '2012-06-13', '214500', 12, 41, 39),
	   (203, 1, 18, 1, 69, '2012-06-14', '180000', 13, 41, 39),
	   (6, 4, 217, 0, 69, '2012-06-14', '204500', 14, 41, 39),
	   (215, 0, 21, 2, 69, '2012-06-15', '190000', 15, 41, 39),
	   (25, 2, 20, 3, 69, '2012-06-15', '220000', 16, 41, 39),
	   (213, 1, 7, 0, 69, '2012-06-16', '204500', 17, 41, 39),
	   (202, 1, 23, 0, 69, '2012-06-16', '204500', 18, 41, 39),
	   (4, 2, 204, 1, 69, '2012-06-17', '214500', 19, 41, 39),
	   (19, 1, 2, 2, 69, '2012-06-17', '214500', 20, 41, 39),
	   (18, 0, 6, 1, 69, '2012-06-18', '204500', 21, 41, 39),
	   (203, 2, 217, 0, 69, '2012-06-18', '204500', 22, 41, 39),
	   (20, 1, 215, 0, 69, '2012-06-19', '214500', 23, 41, 39),
	   (25, 2, 21, 0, 69, '2012-06-19', '214500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (213, 0, null, null, 4, 1, null, null, 69, '2012-06-21', '204500', 25, 43, 40, 25),
	   (2, 4, null, null, 202, 2, null, null, 69, '2012-06-22', '204500', 26, 43, 40, 27),
	   (6, 2, null, null, 21, 0, null, null, 69, '2012-06-23', '214500', 27, 43, 40, 26),
	   (20, 0, 0, 2, 203, 0, 0, 4, 69, '2012-06-24', '214500', 28, 43, 40, 28),
	   (4, 0, 0, 2, 6, 0, 0, 4, 69, '2012-06-27', '214500', 29, 44, 40, 29),
	   (2, 1, null, null, 203, 2, null, null, 69, '2012-06-28', '204500', 30, 44, 40, 30),
	   (6, 4, null, null, 203, 0, null, null, 69, '2012-07-01', '214500', 31, 46, 40, 31);

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
