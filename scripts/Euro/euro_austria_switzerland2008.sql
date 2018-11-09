# Insert new tournament
# Replace all the tournament_id

# Euro 2008 Austria-Switzerland

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('UEFA Euro 2008 Austria-Switzerland', '2008-06-07', '2008-06-29', 11, 'Euro_2008.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (70, 41, 1, 39, 1),
	   (70, 43, 1, 40, 2),
	   (70, 44, 2, 40, 2),
	   (70, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id)
# VALUES ('Great Britain', 4, 212), ('Senegal', 4, 164), ('Uruguay', 4, 201), ('United Arab Emirates', 4, 200),
# 	   ('Gabon', 4, 73), ('Switzerland', 4, 184), ('Egypt', 4, 61), ('Belarus', 4, 19),
# 	   ('New Zealand', 4, 137), ('Morocco', 4, 130), ('Spain', 4, 175);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (4, 70, 1, 1),
	   (218, 70, 1, 2),
	   (213, 70, 1, 3),
	   (26, 70, 1, 4),
	   (18, 70, 2, 1),
	   (2, 70, 2, 2),
	   (222, 70, 2, 3),
	   (7, 70, 2, 4),
	   (204, 70, 3, 1),
	   (203, 70, 3, 2),
	   (226, 70, 3, 3),
	   (21, 70, 3, 4),
	   (6, 70, 4, 1),
	   (23, 70, 4, 2),
	   (25, 70, 4, 3),
	   (202, 70, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (26, 0, 213, 1, 70, '2008-06-07', '180000', 1, 41, 39),
	   (4, 2, 218, 0, 70, '2008-06-07', '204500', 2, 41, 39),
	   (222, 0, 18, 1, 70, '2008-06-08', '180000', 3, 41, 39),
	   (2, 2, 7, 0, 70, '2008-06-08', '204500', 4, 41, 39),
	   (226, 0, 21, 0, 70, '2008-06-09', '180000', 5, 41, 39),
	   (204, 3, 203, 0, 70, '2008-06-09', '204500', 6, 41, 39),
	   (6, 4, 23, 1, 70, '2008-06-10', '180000', 7, 41, 39),
	   (202, 0, 25, 2, 70, '2008-06-10', '204500', 8, 41, 39),
	   (213, 1, 4, 3, 70, '2008-06-11', '180000', 9, 41, 39),
	   (26, 1, 218, 2, 70, '2008-06-11', '204500', 10, 41, 39),
	   (18, 2, 2, 1, 70, '2008-06-12', '180000', 11, 41, 39),
	   (222, 1, 7, 1, 70, '2008-06-12', '204500', 12, 41, 39),
	   (203, 1, 226, 1, 70, '2008-06-13', '180000', 13, 41, 39),
	   (204, 4, 21, 1, 70, '2008-06-13', '204500', 14, 41, 39),
	   (25, 1, 6, 2, 70, '2008-06-14', '180000', 15, 41, 39),
	   (202, 0, 23, 1, 70, '2008-06-14', '204500', 16, 41, 39),
	   (26, 2, 4, 0, 70, '2008-06-15', '204500', 17, 41, 39),
	   (218, 3, 213, 2, 70, '2008-06-15', '204500', 18, 41, 39),
	   (7, 0, 18, 1, 70, '2008-06-16', '204500', 19, 41, 39),
	   (222, 0, 2, 1, 70, '2008-06-16', '204500', 20, 41, 39),
	   (204, 2, 226, 0, 70, '2008-06-17', '204500', 21, 41, 39),
	   (21, 0, 203, 2, 70, '2008-06-17', '204500', 22, 41, 39),
	   (202, 1, 6, 2, 70, '2008-06-18', '204500', 23, 41, 39),
	   (23, 2, 25, 0, 70, '2008-06-18', '204500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (4, 2, null, null, 2, 3, null, null, 70, '2008-06-19', '204500', 25, 43, 40, 25),
	   (18, 0, 1, 1, 218, 0, 1, 3, 70, '2008-06-20', '204500', 26, 43, 40, 26),
	   (204, 1, 0, null, 23, 1, 2, null, 70, '2008-06-21', '204500', 27, 43, 40, 27),
	   (6, 0, 0, 4, 203, 0, 0, 2, 70, '2008-06-22', '204500', 28, 43, 40, 28),
	   (2, 3, null, null, 218, 2, null, null, 70, '2008-06-25', '204500', 29, 44, 40, 29),
	   (23, 0, null, null, 6, 3, null, null, 70, '2008-06-26', '204500', 30, 44, 40, 30),
	   (2, 0, null, null, 6, 1, null, null, 70, '2008-06-29', '204500', 31, 46, 40, 31);

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
