# Insert new tournament
# Replace all the tournament_id

# Women's World Cup USA 2003

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2003 FIFA Women''s World Cup USA', '2003-09-30', '2003-10-12', 8, '2003.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (36, 41, 1, 39, 1),
	   (36, 43, 1, 40, 2),
	   (36, 44, 2, 40, 2),
	   (36, 45, 3, 40, 2),
	   (36, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 3 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Russia', 3, 157);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (823, 36, 1, 1),
	   (825, 36, 1, 2),
	   (863, 36, 1, 3),
	   (826, 36, 1, 4),
	   (827, 36, 2, 1),
	   (816, 36, 2, 2),
	   (831, 36, 2, 3),
	   (828, 36, 2, 4),
	   (815, 36, 3, 1),
	   (811, 36, 3, 2),
	   (819, 36, 3, 3),
	   (865, 36, 3, 4),
	   (812, 36, 4, 1),
	   (868, 36, 4, 2),
	   (866, 36, 4, 3),
	   (824, 36, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (816, 2, 831, 0, 36, '2003-09-20', '120000', 1, 41, 39),
	   (826, 0, 863, 3, 36, '2003-09-20', '144500', 2, 41, 39),
	   (815, 4, 811, 1, 36, '2003-09-20', '174500', 3, 41, 39),
	   (819, 6, 865, 0, 36, '2003-09-20', '203000', 4, 41, 39),
	   (823, 3, 825, 1, 36, '2003-09-21', '123000', 5, 41, 39),
	   (824, 1, 868, 2, 36, '2003-09-21', '173000', 6, 41, 39),
	   (827, 3, 828, 0, 36, '2003-09-21', '151500', 7, 41, 39),
	   (812, 1, 866, 0, 36, '2003-09-21', '201500', 8, 41, 39),
	   (816, 1, 827, 4, 36, '2003-09-24', '170000', 9, 41, 39),
	   (815, 3, 819, 0, 36, '2003-09-24', '174500', 10, 41, 39),
	   (831, 1, 828, 0, 36, '2003-09-24', '194500', 11, 41, 39),
	   (811, 3, 865, 0, 36, '2003-09-24', '203000', 12, 41, 39),
	   (866, 0, 868, 3, 36, '2003-09-25', '161500', 13, 41, 39),
	   (825, 1, 863, 0, 36, '2003-09-25', '164500', 14, 41, 39),
	   (823, 5, 826, 0, 36, '2003-09-25', '193000', 15, 41, 39),
	   (812, 1, 824, 1, 36, '2003-09-25', '190000', 16, 41, 39),
	   (828, 1, 816, 7, 36, '2003-09-27', '124500', 17, 41, 39),
	   (811, 3, 819, 1, 36, '2003-09-27', '153000', 18, 41, 39),
	   (831, 1, 827, 1, 36, '2003-09-27', '124500', 19, 41, 39),
	   (865, 1, 815, 6, 36, '2003-09-27', '153000', 20, 41, 39),
	   (825, 3, 826, 0, 36, '2003-09-28', '130000', 21, 41, 39),
	   (866, 2, 824, 1, 36, '2003-09-28', '171500', 22, 41, 39),
	   (863, 0, 823, 3, 36, '2003-09-28', '154500', 23, 41, 39),
	   (812, 1, 868, 0, 36, '2003-09-28', '200000', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES	(823, 1, null, null, 826, 0, null, null, 36, '2003-10-01', '193000', 25, 43, 40, 25),
		  (827, 1, null, null, 825, 2, null, null, 36, '2003-10-01', '163000', 26, 43, 40, 27),
		  (815, 7, null, null, 868, 1, null, null, 36, '2003-10-02', '163000', 27, 43, 40, 26),
		  (812, 0, null, null, 811, 1, null, null, 36, '2003-10-02', '193000', 28, 43, 40, 28),
		  (823, 0, null, null, 815, 3, null, null, 36, '2003-10-05', '163000', 29, 44, 40, 29),
		  (825, 2, null, null, 811, 1, null, null, 36, '2003-10-05', '193000', 30, 44, 40, 30),
		  (823, 3, null, null, 811, 1, null, null, 36, '2003-10-11', '123000', 31, 45, 40, 32),
		  (815, 1, 1, null, 825, 1, 0, null, 36, '2003-10-12', '100000', 32, 46, 40, 31);

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
