# Insert new tournament
# Replace all the tournament_id

# 2000 AFC Asian Cup Lebanon

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('2000 AFC Asian Cup Lebanon', '2000-10-12', '2000-10-29', 15, 'aac_2000.png', 1, null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (189, 41, 1, 39, 1),
	   (189, 43, 1, 40, 2),
	   (189, 44, 2, 40, 2),
	   (189, 45, 3, 40, 2),
	   (189, 46, 4, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Lebanon', 1, 109, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (14, 189, 1, 1),
	   (235, 189, 1, 2),
	   (1022, 189, 1, 3),
	   (1025, 189, 1, 4),
	   (219, 189, 2, 1),
	   (237, 189, 2, 2),
	   (16, 189, 2, 3),
	   (245, 189, 2, 4),
	   (15, 189, 3, 1),
	   (17, 189, 3, 2),
	   (1011, 189, 3, 3),
	   (1009, 189, 3, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (235, 2, 1022, 0, 189, '2000-10-12', '150000', 1, 41, 39),
	   (1025, 0, 14, 4, 189, '2000-10-12', '204500', 2, 41, 39),
	   (16, 2, 219, 2, 189, '2000-10-13', '170000', 3, 41, 39),
	   (237, 0, 245, 0, 189, '2000-10-13', '194500', 4, 41, 39),
	   (17, 1, 15, 4, 189, '2000-10-14', '170000', 5, 41, 39),
	   (1011, 1, 1009, 1, 189, '2000-10-14', '194500', 6, 41, 39),
	   (14, 1, 1022, 1, 189, '2000-10-15', '170000', 7, 41, 39),
	   (1025, 2, 235, 2, 189, '2000-10-15', '194500', 8, 41, 39),
	   (219, 4, 245, 0, 189, '2000-10-16', '170000', 9, 41, 39),
	   (16, 0, 237, 1, 189, '2000-10-16', '194500', 10, 41, 39),
	   (15, 8, 1009, 1, 189, '2000-10-17', '170000', 11, 41, 39),
	   (17, 0, 1011, 0, 189, '2000-10-17', '194500', 12, 41, 39),
	   (14, 1, 235, 0, 189, '2000-10-18', '193000', 13, 41, 39),
	   (1025, 1, 1022, 1, 189, '2000-10-18', '193000', 14, 41, 39),
	   (219, 0, 237, 0, 189, '2000-10-19', '193000', 15, 41, 39),
	   (16, 3, 245, 0, 189, '2000-10-19', '193000', 16, 41, 39),
	   (17, 5, 1009, 0, 189, '2000-10-20', '193000', 17, 41, 39),
	   (15, 1, 1011, 1, 189, '2000-10-20', '193000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (14, 1, 0, null, 16, 1, 1, null, 189, '2000-10-23', '164500', 19, 43, 40, 21),
	   (219, 3, null, null, 1011, 1, null, null, 189, '2000-10-23', '194500', 20, 43, 40, 19),
	   (15, 4, null, null, 235, 1, null, null, 189, '2000-10-24', '164500', 21, 43, 40, 20),
	   (237, 2, 0, null, 17, 2, 1, null, 189, '2000-10-24', '194500', 22, 43, 40, 22),
	   (16, 1, null, null, 17, 2, null, null, 189, '2000-10-26', '164500', 23, 44, 40, 24),
	   (219, 2, null, null, 15, 3, null, null, 189, '2000-10-26', '194500', 24, 44, 40, 23),
	   (16, 1, null, null, 219, 0, null, null, 189, '2000-10-29', '170000', 25, 45, 40, 26),
	   (15, 1, null, null, 17, 0, null, null, 189, '2000-10-29', '194500', 26, 46, 40, 25);

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
