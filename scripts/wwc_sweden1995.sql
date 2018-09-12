# Insert new tournament
# Replace all the tournament_id

# Women's World Cup Sweden 1995

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('1995 FIFA Women''s World Cup Sweden', '1995-06-05', '1995-06-18', 8, '1995.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (38, 41, 1, 39, 1),
	   (38, 43, 1, 40, 1),
	   (38, 44, 2, 40, 2),
	   (38, 45, 3, 40, 3),
	   (38, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 3 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Italy', 3, 96);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (815, 38, 1, 1),
	   (825, 38, 1, 2),
	   (819, 38, 1, 3),
	   (827, 38, 1, 4),
	   (816, 38, 2, 1),
	   (832, 38, 2, 2),
	   (811, 38, 2, 3),
	   (826, 38, 2, 4),
	   (823, 38, 3, 1),
	   (812, 38, 3, 2),
	   (867, 38, 3, 3),
	   (824, 38, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (815, 1, 819, 0, 38, '1995-06-05', '140000', 1, 41, 39),
	   (825, 0, 827, 1, 38, '1995-06-05', '180000', 2, 41, 39),
	   (816, 8, 826, 0, 38, '1995-06-06', '190000', 3, 41, 39),
	   (832, 3, 811, 2, 38, '1995-06-06', '190000', 4, 41, 39),
	   (823, 3, 812, 3, 38, '1995-06-06', '190000', 5, 41, 39),
	   (867, 5, 824, 0, 38, '1995-06-06', '190000', 6, 41, 39),
	   (825, 3, 815, 2, 38, '1995-06-07', '190000', 7, 41, 39),
	   (827, 1, 819, 2, 38, '1995-06-07', '190000', 8, 41, 39),
	   (816, 2, 832, 0, 38, '1995-06-08', '190000', 9, 41, 39),
	   (826, 3, 811, 3, 38, '1995-06-08', '190000', 10, 41, 39),
	   (823, 2, 867, 0, 38, '1995-06-08', '190000', 11, 41, 39),
	   (812, 4, 824, 2, 38, '1995-06-08', '190000', 12, 41, 39),
	   (825, 2, 819, 0, 38, '1995-06-09', '190000', 13, 41, 39),
	   (827, 1, 815, 6, 38, '1995-06-09', '190000', 14, 41, 39),
	   (816, 7, 811, 0, 38, '1995-06-10', '160000', 15, 41, 39),
	   (826, 2, 832, 3, 38, '1995-06-10', '160000', 16, 41, 39),
	   (823, 4, 824, 1, 38, '1995-06-10', '160000', 17, 41, 39),
	   (812, 3, 867, 1, 38, '1995-06-10', '160000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES	(819, 0, null, null, 823, 4, null, null, 38, '1995-06-13', '171500', 19, 43, 40, 21),
		  (816, 3, null, null, 867, 1, null, null, 38, '1995-06-13', '171500', 20, 43, 40, 22),
		  (815, 3, null, null, 832, 0, null, null, 38, '1995-06-13', '201500', 21, 43, 40, 19),
		  (826, 1, 0, 3, 812, 1, 0, 4, 38, '1995-06-13', '201500', 22, 43, 40, 20),
		  (823, 0, null, null, 816, 1, null, null, 38, '1995-06-15', '171500', 23, 44, 40, 24),
		  (815, 1, null, null, 812, 0, null, null, 38, '1995-06-15', '201500', 24, 44, 40, 23),
		  (812, 0, null, null, 823, 2, null, null, 38, '1995-06-17', '160000', 25, 45, 40, 36),
		  (815, 0, null, null, 816, 2, null, null, 38, '1995-06-18', '180000', 26, 46, 40, 25);

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
