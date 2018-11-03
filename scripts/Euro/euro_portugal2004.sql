# Insert new tournament
# Replace all the tournament_id

# Euro 2004 Portugal

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule)
VALUES ('UEFA Euro 2004 Portugal', '2004-06-12', '2004-07-04', 11, 'Euro_2004.png', 1);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (71, 41, 1, 39, 1),
	   (71, 43, 1, 40, 1),
	   (71, 44, 2, 40, 2),
	   (71, 46, 3, 40, 3);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Great Britain', 4, 212), ('Senegal', 4, 164), ('Uruguay', 4, 201), ('United Arab Emirates', 4, 200),
# 	   ('Gabon', 4, 73), ('Switzerland', 4, 184), ('Egypt', 4, 61), ('Belarus', 4, 19),
# 	   ('New Zealand', 4, 137), ('Morocco', 4, 130), ('Spain', 4, 175);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (4, 71, 1, 1),
	   (202, 71, 1, 2),
	   (6, 71, 1, 3),
	   (23, 71, 1, 4),
	   (21, 71, 2, 1),
	   (20, 71, 2, 2),
	   (18, 71, 2, 3),
	   (26, 71, 2, 4),
	   (25, 71, 3, 1),
	   (19, 71, 3, 2),
	   (203, 71, 3, 3),
	   (223, 71, 3, 4),
	   (213, 71, 4, 1),
	   (204, 71, 4, 2),
	   (2, 71, 4, 3),
	   (256, 71, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (4, 1, 202, 2, 71, '2004-06-12', '170000', 1, 41, 39),
	   (6, 1, 23, 0, 71, '2004-06-12', '194500', 2, 41, 39),
	   (26, 0, 18, 0, 71, '2004-06-13', '170000', 3, 41, 39),
	   (21, 2, 20, 1, 71, '2004-06-13', '194500', 4, 41, 39),
	   (19, 0, 203, 0, 71, '2004-06-14', '170000', 5, 41, 39),
	   (25, 5, 223, 0, 71, '2004-06-14', '194500', 6, 41, 39),
	   (213, 2, 256, 1, 71, '2004-06-15', '170000', 7, 41, 39),
	   (2, 1, 204, 1, 71, '2004-06-15', '194500', 8, 41, 39),
	   (202, 1, 6, 1, 71, '2004-06-16', '170000', 9, 41, 39),
	   (23, 0, 4, 2, 71, '2004-06-16', '194500', 10, 41, 39),
	   (20, 3, 26, 0, 71, '2004-06-17', '170000', 11, 41, 39),
	   (18, 2, 21, 2, 71, '2004-06-17', '194500', 12, 41, 39),
	   (223, 0, 19, 2, 71, '2004-06-18', '170000', 13, 41, 39),
	   (203, 1, 25, 1, 71, '2004-06-18', '194500', 14, 41, 39),
	   (256, 0, 2, 0, 71, '2004-06-19', '170000', 15, 41, 39),
	   (204, 2, 213, 3, 71, '2004-06-19', '194500', 16, 41, 39),
	   (6, 0, 4, 1, 71, '2004-06-20', '194500', 17, 41, 39),
	   (23, 2, 202, 1, 71, '2004-06-20', '194500', 18, 41, 39),
	   (18, 2, 20, 4, 71, '2004-06-21', '194500', 19, 41, 39),
	   (26, 1, 21, 3, 71, '2004-06-21', '194500', 20, 41, 39),
	   (203, 2, 223, 1, 71, '2004-06-22', '194500', 21, 41, 39),
	   (19, 2, 25, 2, 71, '2004-06-22', '194500', 22, 41, 39),
	   (204, 3, 256, 0, 71, '2004-06-23', '194500', 23, 41, 39),
	   (2, 1, 213, 2, 71, '2004-06-23', '194500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (4, 1, 1, 6, 20, 1, 1, 5, 71, '2004-06-24', '194500', 25, 43, 40, 25),
	   (21, 0, null, null, 202, 1, null, null, 71, '2004-06-25', '194500', 26, 43, 40, 27),
	   (25, 0, 0, 4, 204, 0, 0, 5, 71, '2004-06-26', '194500', 27, 43, 40, 26),
	   (213, 3, null, null, 19, 0, null, null, 71, '2004-06-27', '194500', 28, 43, 40, 28),
	   (4, 2, null, null, 204, 1, null, null, 71, '2004-06-30', '194500', 29, 44, 40, 29),
	   (202, 0, 1, null, 213, 0, 0, null, 71, '2004-07-01', '194500', 30, 44, 40, 30),
	   (4, 0, null, null, 202, 1, null, null, 71, '2004-07-04', '194500', 31, 46, 40, 31);

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
