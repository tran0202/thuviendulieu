# Insert new tournament
# Replace all the tournament_id

# Women's World Cup Germany 2011

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2011 FIFA Women''s World Cup Germany', '2011-06-26', '2010-07-17', 8, '2011.png');

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (34, 41, 1, 39, 1),
	   (34, 43, 1, 40, 1),
	   (34, 44, 2, 40, 2),
	   (34, 45, 3, 40, 3),
	   (34, 46, 4, 40, 4);

SELECT * FROM `team` WHERE team_type_id = 3 ORDER BY name;

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Korea DPR', 3, 102), ('Equatorial Guinea', 3, 64);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (815, 34, 1, 1),
	   (831, 34, 1, 2),
	   (826, 34, 1, 3),
	   (811, 34, 1, 4),
	   (832, 34, 2, 1),
	   (819, 34, 2, 2),
	   (834, 34, 2, 3),
	   (814, 34, 2, 4),
	   (825, 34, 3, 1),
	   (823, 34, 3, 2),
	   (863, 34, 3, 3),
	   (833, 34, 3, 4),
	   (827, 34, 4, 1),
	   (824, 34, 4, 2),
	   (816, 34, 4, 3),
	   (864, 34, 4, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (826, 0, 831, 1, 34, '2011-06-26', '150000', 1, 41, 39),
	   (815, 2, 811, 1, 34, '2011-06-26', '180000', 2, 41, 39),
	   (819, 2, 814, 1, 34, '2011-06-27', '150000', 3, 41, 39),
	   (834, 1, 832, 1, 34, '2011-06-27', '180000', 4, 41, 39),
	   (833, 0, 825, 1, 34, '2011-06-28', '150000', 5, 41, 39),
	   (823, 2, 863, 0, 34, '2011-06-28', '181500', 6, 41, 39),
	   (816, 1, 864, 0, 34, '2011-06-29', '150000', 7, 41, 39),
	   (827, 1, 824, 0, 34, '2011-06-29', '181500', 8, 41, 39),
	   (811, 0, 831, 4, 34, '2011-06-30', '180000', 9, 41, 39),
	   (815, 1, 826, 0, 34, '2011-06-30', '204500', 10, 41, 39),
	   (819, 4, 834, 0, 34, '2011-07-01', '150000', 11, 41, 39),
	   (814, 1, 832, 2, 34, '2011-07-01', '181500', 12, 41, 39),
	   (863, 0, 825, 1, 34, '2011-07-02', '140000', 13, 41, 39),
	   (823, 3, 833, 0, 34, '2011-07-02', '180000', 14, 41, 39),
	   (824, 3, 864, 2, 34, '2011-07-03', '140000', 15, 41, 39),
	   (827, 3, 816, 0, 34, '2011-07-03', '181500', 16, 41, 39),
	   (832, 2, 819, 0, 34, '2011-07-05', '181500', 17, 41, 39),
	   (814, 2, 834, 2, 34, '2011-07-05', '181500', 18, 41, 39),
	   (831, 2, 815, 4, 34, '2011-07-05', '204500', 19, 41, 39),
	   (811, 0, 826, 1, 34, '2011-07-05', '204500', 20, 41, 39),
	   (864, 0, 827, 3, 34, '2011-07-06', '180000', 21, 41, 39),
	   (824, 2, 816, 1, 34, '2011-07-06', '180000', 22, 41, 39),
	   (825, 2, 823, 1, 34, '2011-07-06', '204500', 23, 41, 39),
	   (863, 0, 833, 0, 34, '2011-07-06', '204500', 24, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES	(832, 1, 0, 3, 831, 1, 0, 4, 34, '2011-07-09', '180000', 25, 43, 40, 27),
		  (815, 0, 0, null, 819, 0, 1, null, 34, '2011-07-09', '204500', 26, 43, 40, 25),
		  (825, 3, null, null, 824, 1, null, null, 34, '2011-07-10', '130000', 27, 43, 40, 26),
		  (827, 1, 1, 3, 823, 1, 1, 5, 34, '2011-07-10', '173000', 28, 43, 40, 28),
		  (831, 1, null, null, 823, 3, null, null, 34, '2011-07-13', '180000', 29, 44, 40, 30),
		  (819, 3, null, null, 825, 1, null, null, 34, '2011-07-13', '204500', 30, 44, 40, 29),
		  (825, 2, null, null, 831, 1, null, null, 34, '2011-07-16', '173000', 31, 45, 40, 32),
		  (823, 1, 1, 3, 819, 1, 1, 1, 34, '2011-07-17', '204500', 32, 46, 40, 31);

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
