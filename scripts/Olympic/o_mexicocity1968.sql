# Insert new tournament
# Replace all the tournament_id

# Olympic Football Tournament Mexico City 1968

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('Olympic Football Tournament Mexico City 1968', '1968-10-13', '1968-10-26', 9, '1968.png', 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (51, 41, 1, 39, 1),
	   (51, 43, 1, 40, 2),
	   (51, 44, 2, 40, 2),
	   (51, 132, 3, 40, 2),
	   (51, 133, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 4 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Guinea', 4, 83), ('El Salvador', 4, 62), ('Bulgaria', 4, 31), ('Thailand', 4, 189);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (902, 51, 1, 1),
	   (845, 51, 1, 2),
	   (840, 51, 1, 3),
	   (926, 51, 1, 4),
	   (1085, 51, 2, 1),
	   (841, 51, 2, 2),
	   (835, 51, 2, 3),
	   (839, 51, 2, 4),
	   (904, 51, 3, 1),
	   (920, 51, 3, 2),
	   (894, 51, 3, 3),
	   (927, 51, 3, 4),
	   (1086, 51, 4, 1),
	   (909, 51, 4, 2),
	   (916, 51, 4, 3),
	   (929, 51, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (845, 1, 840, 0, 51, '1968-10-13', '120000', 1, 41, 39),
	   (902, 3, 926, 1, 51, '1968-10-13', '120000', 2, 41, 39),
	   (926, 3, 840, 2, 51, '1968-10-15', '120000', 9, 41, 39),
	   (902, 4, 845, 1, 51, '1968-10-15', '120000', 10, 41, 39),
	   (845, 4, 926, 0, 51, '1968-10-17', '120000', 17, 41, 39),
	   (840, 2, 902, 1, 51, '1968-10-17', '120000', 18, 41, 39),
	   (1085, 1, 835, 0, 51, '1968-10-14', '120000', 3, 41, 39),
	   (841, 3, 839, 1, 51, '1968-10-14', '120000', 4, 41, 39),
	   (1085, 3, 839, 0, 51, '1968-10-16', '120000', 11, 41, 39),
	   (835, 1, 841, 1, 51, '1968-10-16', '120000', 12, 41, 39),
	   (835, 3, 839, 3, 51, '1968-10-18', '120000', 19, 41, 39),
	   (1085, 0, 841, 0, 51, '1968-10-18', '120000', 20, 41, 39),
	   (920, 5, 894, 3, 51, '1968-10-13', '120000', 5, 41, 39),
	   (904, 4, 927, 0, 51, '1968-10-13', '120000', 6, 41, 39),
	   (904, 2, 894, 2, 51, '1968-10-15', '120000', 13, 41, 39),
	   (920, 3, 927, 1, 51, '1968-10-15', '120000', 14, 41, 39),
	   (927, 1, 894, 1, 51, '1968-10-17', '120000', 21, 41, 39),
	   (904, 2, 920, 0, 51, '1968-10-17', '120000', 22, 41, 39),
	   (909, 1, 916, 0, 51, '1968-10-14', '120000', 7, 41, 39),
	   (1086, 7, 929, 0, 51, '1968-10-14', '120000', 8, 41, 39),
	   (1086, 2, 916, 2, 51, '1968-10-16', '120000', 15, 41, 39),
	   (909, 4, 929, 1, 51, '1968-10-16', '120000', 16, 41, 39),
	   (1086, 2, 909, 1, 51, '1968-10-18', '120000', 23, 41, 39),
	   (916, 8, 929, 0, 51, '1968-10-18', '120000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES 	(845, 2, null, null, 1085, 0, null, null, 51, '1968-10-20', '120000', 25, 43, 40, 28),
		  (904, 1, null, null, 909, 0, null, null, 51, '1968-10-20', '120000', 26, 43, 40, 25),
		  (841, 3, null, null, 902, 1, null, null, 51, '1968-10-20', '120000', 27, 43, 40, 26),
		  (1086, 1, null, null, 920, 1, null, null, 51, '1968-10-20', '120000', 28, 43, 40, 27),
		  (845, 2, null, null, 1086, 3, null, null, 51, '1968-10-22', '120000', 29, 44, 40, 30),
		  (904, 5, null, null, 841, 0, null, null, 51, '1968-10-22', '120000', 30, 44, 40, 29),
		  (841, 2, null, null, 845, 0, null, null, 51, '1968-10-24', '120000', 31, 132, 40, 32),
		  (904, 4, null, null, 1086, 1, null, null, 51, '1968-10-26', '120000', 32, 133, 40, 31);

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
