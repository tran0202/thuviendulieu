# Insert new tournament
# Replace all the tournament_id

# 1988 AFC Asian Cup Qatar

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1988 AFC Asian Cup Qatar', '1988-12-02', '1988-12-18', 15, 'AFC.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (192, 41, 1, 39, 1),
	   (192, 44, 1, 40, 2),
	   (192, 45, 2, 40, 2),
	   (192, 46, 3, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
# VALUES ('Upper Volta', 'Upper_Volta.png', 32, 6, 'UPV');
#
# INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
# VALUES ('Lebanon', 1, 109, null);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (16, 192, 1, 1),
	   (14, 192, 1, 2),
	   (1011, 192, 1, 3),
	   (229, 192, 1, 4),
	   (15, 192, 1, 5),
	   (17, 192, 2, 1),
	   (219, 192, 2, 2),
	   (1020, 192, 2, 3),
	   (237, 192, 2, 4),
	   (1010, 192, 2, 5);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (14, 2, 1011, 0, 192, '1988-12-02', '160000', 1, 41, 39),
	   (1020, 0, 17, 2, 192, '1988-12-02', '180000', 2, 41, 39),
	   (229, 0, 16, 1, 192, '1988-12-03', '150000', 3, 41, 39),
	   (237, 0, 1010, 0, 192, '1988-12-03', '170000', 4, 41, 39),
	   (15, 0, 14, 0, 192, '1988-12-04', '150000', 5, 41, 39),
	   (219, 3, 1020, 0, 192, '1988-12-04', '170000', 6, 41, 39),
	   (1011, 2, 229, 1, 192, '1988-12-05', '170000', 7, 41, 39),
	   (17, 0, 237, 0, 192, '1988-12-05', '150000', 8, 41, 39),
	   (16, 2, 15, 0, 192, '1988-12-06', '150000', 9, 41, 39),
	   (1010, 0, 219, 1, 192, '1988-12-06', '170000', 10, 41, 39),
	   (14, 1, 229, 0, 192, '1988-12-08', '150000', 11, 41, 39),
	   (1020, 1, 237, 0, 192, '1988-12-08', '170000', 12, 41, 39),
	   (1011, 2, 16, 3, 192, '1988-12-09', '170000', 13, 41, 39),
	   (17, 1, 1010, 1, 192, '1988-12-09', '150000', 14, 41, 39),
	   (229, 1, 15, 0, 192, '1988-12-10', '150000', 15, 41, 39),
	   (237, 2, 219, 2, 192, '1988-12-10', '170000', 16, 41, 39),
	   (16, 3, 14, 0, 192, '1988-12-11', '170000', 17, 41, 39),
	   (1010, 0, 1020, 1, 192, '1988-12-11', '150000', 18, 41, 39),
	   (15, 0, 1011, 3, 192, '1988-12-12', '170000', 19, 41, 39),
	   (219, 0, 17, 1, 192, '1988-12-12', '150000', 20, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (16, 0, 2, null, 219, 0, 1, null, 192, '1988-12-14', '160000', 21, 44, 40, 21),
	   (17, 1, null, null, 14, 0, null, null, 192, '1988-12-15', '160000', 22, 44, 40, 22),
	   (219, 0, 0, 0, 14, 0, 0, 3, 192, '1988-12-17', '160000', 23, 45, 40, 24),
	   (16, 0, 0, 3, 17, 0, 0, 4, 192, '1988-12-18', '160000', 24, 46, 40, 23);

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
