# Insert new tournament
# Replace all the tournament_id

# Women's World Cup USA 1999

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('1999 FIFA Women''s World Cup USA', '1999-06-19', '1999-07-10', 8, '1999.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (37, 41, 1, 39, 1),
	   (37, 43, 1, 40, 2),
	   (37, 44, 2, 40, 2),
	   (37, 45, 3, 40, 2),
	   (37, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 3 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Italy', 3, 96);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (823, 37, 1, 1),
	   (826, 37, 1, 2),
	   (863, 37, 1, 3),
	   (867, 37, 1, 4),
	   (827, 37, 2, 1),
	   (815, 37, 2, 2),
	   (869, 37, 2, 3),
	   (834, 37, 2, 4),
	   (816, 37, 3, 1),
	   (868, 37, 3, 2),
	   (811, 37, 3, 3),
	   (819, 37, 3, 4),
	   (812, 37, 4, 1),
	   (825, 37, 4, 2),
	   (824, 37, 4, 3),
	   (866, 37, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (823, 3, 867, 0, 37, '1999-06-19', '150000', 1, 41, 39),
	   (812, 2, 825, 1, 37, '1999-06-19', '170000', 2, 41, 39),
	   (827, 7, 834, 1, 37, '1999-06-19', '173000', 3, 41, 39),
	   (819, 1, 811, 1, 37, '1999-06-19', '190000', 4, 41, 39),
	   (816, 2, 868, 1, 37, '1999-06-20', '160000', 5, 41, 39),
	   (824, 1, 866, 1, 37, '1999-06-20', '193000', 6, 41, 39),
	   (815, 1, 869, 1, 37, '1999-06-20', '160000', 7, 41, 39),
	   (863, 1, 826, 2, 37, '1999-06-20', '183000', 8, 41, 39),
	   (819, 0, 868, 5, 37, '1999-06-23', '180000', 9, 41, 39),
	   (812, 7, 866, 0, 37, '1999-06-23', '203000', 10, 41, 39),
	   (816, 7, 811, 1, 37, '1999-06-23', '180000', 11, 41, 39),
	   (824, 1, 825, 3, 37, '1999-06-23', '203000', 12, 41, 39),
	   (863, 3, 867, 1, 37, '1999-06-24', '180000', 13, 41, 39),
	   (815, 6, 834, 0, 37, '1999-06-24', '203000', 14, 41, 39),
	   (827, 2, 869, 0, 37, '1999-06-24', '170000', 15, 41, 39),
	   (823, 7, 826, 1, 37, '1999-06-24', '190000', 16, 41, 39),
	   (811, 1, 868, 4, 37, '1999-06-26', '120000', 17, 41, 39),
	   (812, 3, 824, 1, 37, '1999-06-26', '143000', 18, 41, 39),
	   (866, 0, 826, 2, 37, '1999-06-26', '160000', 19, 41, 39),
	   (816, 4, 819, 0, 37, '1999-06-26', '183000', 20, 41, 39),
	   (834, 0, 869, 2, 37, '1999-06-27', '163000', 21, 41, 39),
	   (815, 3, 827, 3, 37, '1999-06-27', '133000', 22, 41, 39),
	   (823, 3, 863, 0, 37, '1999-06-27', '190000', 23, 41, 39),
	   (826, 2, 867, 0, 37, '1999-06-27', '160000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES	(812, 2, null, null, 868, 0, null, null, 37, '1999-06-30', '170000', 25, 43, 40, 28),
		  (816, 3, null, null, 825, 1, null, null, 37, '1999-06-30', '193000', 26, 43, 40, 27),
		  (823, 3, null, null, 815, 2, null, null, 37, '1999-07-01', '190000', 27, 43, 40, 25),
		  (827, 3, 1, null, 826, 3, null, null, 37, '1999-07-01', '213000', 28, 43, 40, 26),
		  (816, 0, null, null, 812, 5, null, null, 37, '1999-07-04', '193000', 29, 44, 40, 30),
		  (823, 2, null, null, 827, 0, null, null, 37, '1999-07-04', '133000', 30, 44, 40, 29),
		  (827, 0, 0, 5, 816, 0, 0, 4, 37, '1999-07-10', '101500', 31, 45, 40, 32),
		  (823, 0, 0, 5, 812, 0, 0, 4, 37, '1999-07-10', '125000', 32, 46, 40, 31);

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
