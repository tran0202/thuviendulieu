# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Beijing 2008

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Beijing 2008', '2008-08-07', '2008-08-23', 9, '2008.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (41, 41, 1, 39, 1),
	   (41, 43, 1, 40, 2),
	   (41, 44, 2, 40, 2),
	   (41, 132, 3, 40, 2),
	   (41, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Côte d''Ivoire', 4, 50), ('Australia', 4, 12), ('Serbia', 4, 165), ('Netherlands', 4, 135),
	   ('USA', 4, 203), ('Belgium', 4, 20), ('China PR', 4, 42), ('Italy', 4, 96),
	   ('Cameroon', 4, 35);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (849, 41, 1, 1),
	   (882, 41, 1, 2),
	   (883, 41, 1, 3),
	   (884, 41, 1, 4),
	   (839, 41, 2, 1),
	   (885, 41, 2, 2),
	   (886, 41, 2, 3),
	   (841, 41, 2, 4),
	   (835, 41, 3, 1),
	   (887, 41, 3, 2),
	   (888, 41, 3, 3),
	   (879, 41, 3, 4),
	   (889, 41, 4, 1),
	   (890, 41, 4, 2),
	   (843, 41, 4, 3),
	   (848, 41, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (883, 1, 884, 1, 41, '2008-08-07', '170000', 1, 41, 39),
	   (882, 1, 849, 2, 41, '2008-08-07', '194500', 2, 41, 39),
	   (849, 1, 883, 0, 41, '2008-08-10', '170000', 9, 41, 39),
	   (884, 2, 882, 4, 41, '2008-08-10', '194500', 10, 41, 39),
	   (882, 1, 883, 0, 41, '2008-08-13', '194500', 17, 41, 39),
	   (849, 2, 884, 0, 41, '2008-08-13', '194500', 18, 41, 39),
	   (841, 0, 886, 1, 41, '2008-08-07', '170000', 3, 41, 39),
	   (885, 0, 839, 0, 41, '2008-08-07', '194500', 4, 41, 39),
	   (839, 2, 841, 1, 41, '2008-08-10', '170000', 11, 41, 39),
	   (886, 2, 885, 2, 41, '2008-08-10', '194500', 12, 41, 39),
	   (885, 1, 841, 0, 41, '2008-08-13', '170000', 19, 41, 39),
	   (839, 2, 886, 1, 41, '2008-08-13', '170000', 20, 41, 39),
	   (835, 1, 887, 0, 41, '2008-08-07', '170000', 5, 41, 39),
	   (888, 1, 879, 1, 41, '2008-08-07', '194500', 6, 41, 39),
	   (879, 0, 835, 5, 41, '2008-08-10', '170000', 13, 41, 39),
	   (887, 2, 888, 0, 41, '2008-08-10', '194500', 14, 41, 39),
	   (888, 0, 835, 3, 41, '2008-08-13', '194500', 21, 41, 39),
	   (879, 0, 887, 1, 41, '2008-08-13', '194500', 22, 41, 39),
	   (848, 0, 889, 3, 41, '2008-08-07', '170000', 7, 41, 39),
	   (843, 1, 890, 1, 41, '2008-08-07', '194500', 8, 41, 39),
	   (890, 1, 848, 0, 41, '2008-08-10', '170000', 15, 41, 39),
	   (889, 3, 843, 0, 41, '2008-08-10', '194500', 16, 41, 39),
	   (843, 1, 848, 0, 41, '2008-08-13', '170000', 23, 41, 39),
	   (890, 0, 889, 0, 41, '2008-08-13', '170000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(835, 0, 2, null, 890, 0, 0, null, 41, '2008-08-16', '180000', 25, 43, 40, 28),
		  (889, 2, null, null, 887, 3, null, null, 41, '2008-08-16', '180000', 26, 43, 40, 26),
		  (849, 1, 1, null, 885, 1, 0, null, 41, '2008-08-16', '210000', 27, 43, 40, 27),
		  (839, 2, null, null, 882, 0, null, null, 41, '2008-08-16', '210000', 28, 43, 40, 25),
		  (839, 4, null, null, 887, 1, null, null, 41, '2008-08-19', '180000', 29, 44, 40, 29),
		  (849, 3, null, null, 835, 0, null, null, 41, '2008-08-19', '210000', 30, 44, 40, 30),
		  (887, 0, null, null, 835, 3, null, null, 41, '2008-08-22', '190000', 31, 132, 40, 32),
		  (839, 0, null, null, 849, 1, null, null, 41, '2008-08-23', '120000', 32, 133, 40, 31);

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
