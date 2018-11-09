# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament London 2012

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament London 2012', '2012-07-26', '2012-08-11', 9, '2012.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (40, 41, 1, 39, 1),
	   (40, 43, 1, 40, 2),
	   (40, 44, 2, 40, 2),
	   (40, 132, 3, 40, 2),
	   (40, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Great Britain', 4, 212), ('Senegal', 4, 164), ('Uruguay', 4, 201), ('United Arab Emirates', 4, 200),
	   ('Gabon', 4, 73), ('Switzerland', 4, 184), ('Egypt', 4, 61), ('Belarus', 4, 19),
	   ('New Zealand', 4, 137), ('Morocco', 4, 130), ('Spain', 4, 175);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (871, 40, 1, 1),
	   (872, 40, 1, 2),
	   (873, 40, 1, 3),
	   (874, 40, 1, 4),
	   (845, 40, 2, 1),
	   (843, 40, 2, 2),
	   (875, 40, 2, 3),
	   (876, 40, 2, 4),
	   (835, 40, 3, 1),
	   (877, 40, 3, 2),
	   (878, 40, 3, 3),
	   (879, 40, 3, 4),
	   (841, 40, 4, 1),
	   (848, 40, 4, 2),
	   (880, 40, 4, 3),
	   (881, 40, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (874, 1, 873, 2, 40, '2012-07-26', '170000', 1, 41, 39),
	   (871, 1, 872, 1, 40, '2012-07-26', '200000', 2, 41, 39),
	   (845, 0, 843, 0, 40, '2012-07-26', '143000', 3, 41, 39),
	   (875, 1, 876, 1, 40, '2012-07-26', '171500', 4, 41, 39),
	   (878, 1, 879, 0, 40, '2012-07-26', '120000', 5, 41, 39),
	   (835, 3, 877, 2, 40, '2012-07-26', '150000', 6, 41, 39),
	   (848, 2, 880, 2, 40, '2012-07-26', '120000', 7, 41, 39),
	   (881, 0, 841, 1, 40, '2012-07-26', '170000', 8, 41, 39),
	   (872, 2, 873, 0, 40, '2012-07-29', '194500', 9, 41, 39),
	   (871, 3, 874, 1, 40, '2012-07-29', '143000', 10, 41, 39),
	   (845, 2, 875, 0, 40, '2012-07-29', '171500', 11, 41, 39),
	   (843, 2, 876, 1, 40, '2012-07-29', '120000', 12, 41, 39),
	   (877, 1, 879, 1, 40, '2012-07-29', '150000', 13, 41, 39),
	   (835, 3, 878, 1, 40, '2012-07-29', '170000', 14, 41, 39),
	   (841, 1, 880, 0, 40, '2012-07-29', '194500', 15, 41, 39),
	   (881, 3, 848, 0, 40, '2012-07-29', '194500', 16, 41, 39),
	   (872, 1, 874, 1, 40, '2012-08-01', '194500', 17, 41, 39),
	   (871, 1, 873, 0, 40, '2012-08-01', '194500', 18, 41, 39),
	   (845, 1, 876, 0, 40, '2012-08-01', '170000', 19, 41, 39),
	   (843, 0, 875, 0, 40, '2012-08-01', '170000', 20, 41, 39),
	   (835, 3, 879, 0, 40, '2012-08-01', '143000', 21, 41, 39),
	   (877, 3, 878, 1, 40, '2012-08-01', '143000', 22, 41, 39),
	   (841, 0, 848, 0, 40, '2012-08-01', '170000', 23, 41, 39),
	   (881, 0, 880, 0, 40, '2012-08-01', '170000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(841, 3, null, null, 877, 0, null, null, 40, '2012-08-04', '120000', 25, 43, 40, 28),
	   	(845, 2, 2, null, 872, 2, 0, null, 40, '2012-08-04', '143000', 26, 43, 40, 27),
		(835, 3, null, null, 848, 2, null, null, 40, '2012-08-04', '170000', 27, 43, 40, 26),
		(871, 1, 0, 4, 843, 1, 0, 5, 40, '2012-08-04', '193000', 28, 43, 40, 25),
		(845, 3, null, null, 841, 1, null, null, 40, '2012-08-07', '170000', 29, 44, 40, 30),
		(843, 0, null, null, 835, 3, null, null, 40, '2012-08-07', '194500', 30, 44, 40, 29),
		(843, 2, null, null, 841, 0, null, null, 40, '2012-08-10', '194500', 31, 132, 40, 32),
		(835, 1, null, null, 845, 2, null, null, 40, '2012-08-11', '150000', 32, 133, 40, 31);

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
