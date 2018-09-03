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

# Canada 2015
INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (811, 1, 812, 0, 31, '2015-06-06', '160000', 1, 41, 39),
	(813, 0, 814, 1, 31, '2015-06-06', '190000', 2, 41, 39),
	(816, 4, 817, 0, 31, '2015-06-07', '130000', 3, 41, 39),
	(815, 10, 818, 0, 31, '2015-06-07', '160000', 4, 41, 39),
	(825, 3, 826, 3, 31, '2015-06-08', '150000', 5, 41, 39),
	(820, 6, 822, 0, 31, '2015-06-08', '160000', 6, 41, 39),
	(823, 3, 824, 1, 31, '2015-06-08', '183000', 7, 41, 39),
	(819, 1, 821, 0, 31, '2015-06-08', '190000', 8, 41, 39),
	(831, 1, 832, 0, 31, '2015-06-09', '140000', 9, 41, 39),
	(830, 1, 829, 1, 31, '2015-06-09', '160000', 10, 41, 39),
	(833, 1, 834, 1, 31, '2015-06-09', '170000', 11, 41, 39),
	(827, 2, 828, 0, 31, '2015-06-09', '190000', 12, 41, 39),
	(815, 1, 816, 1, 31, '2015-06-11', '160000', 13, 41, 39),
	(812, 1, 813, 0, 31, '2015-06-11', '160000', 14, 41, 39),
	(818, 2, 817, 3, 31, '2015-06-11', '190000', 15, 41, 39),
	(811, 0, 814, 0, 31, '2015-06-11', '190000', 16, 41, 39),
	(824, 2, 826, 0, 31, '2015-06-12', '160000', 17, 41, 39),
	(821, 10, 822, 1, 31, '2015-06-12', '160000', 18, 41, 39),
	(823, 0, 825, 0, 31, '2015-06-12', '190000', 19, 41, 39),
	(819, 2, 820, 1, 31, '2015-06-12', '190000', 20, 41, 39),
	(831, 0, 833, 2, 31, '2015-06-13', '140000', 21, 41, 39),
	(827, 1, 830, 0, 31, '2015-06-13', '160000', 22, 41, 39),
	(832, 2, 834, 1, 31, '2015-06-13', '170000', 23, 41, 39),
	(828, 2, 829, 2, 31, '2015-06-13', '190000', 24, 41, 39),
	(817, 0, 815, 4, 31, '2015-06-15', '150000', 25, 41, 39),
	(818, 1, 816, 3, 31, '2015-06-15', '170000', 26, 41, 39),
	(813, 1, 811, 1, 31, '2015-06-15', '193000', 27, 41, 39),
	(812, 2, 814, 2, 31, '2015-06-15', '183000', 28, 41, 39),
	(822, 0, 819, 1, 31, '2015-06-16', '160000', 29, 41, 39),
	(821, 1, 820, 2, 31, '2015-06-16', '150000', 30, 41, 39),
	(826, 0, 823, 1, 31, '2015-06-16', '170000', 31, 41, 39),
	(824, 1, 825, 1, 31, '2015-06-16', '180000', 32, 41, 39),
	(834, 0, 831, 5, 31, '2015-06-17', '160000', 33, 41, 39),
	(832, 2, 833, 1, 31, '2015-06-17', '160000', 34, 41, 39),
	(829, 0, 827, 1, 31, '2015-06-17', '200000', 35, 41, 39),
	(828, 2, 830, 1, 31, '2015-06-17', '190000', 36, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES	(815, 4, null, null, 825, 1, null, null, 31, '2015-06-20', '160000', 37, 42, 40),
	(812, 1, null, null, 820, 0, null, null, 31, '2015-06-20', '173000', 38, 42, 40),
	(827, 0, null, null, 824, 1, null, null, 31, '2015-06-21', '140000', 39, 42, 40),
	(831, 3, null, null, 828, 0, null, null, 31, '2015-06-21', '160000', 40, 42, 40),
	(811, 1, null, null, 821, 0, null, null, 31, '2015-06-21', '163000', 41, 42, 40),
	(816, 1, null, null, 832, 2, null, null, 31, '2015-06-22', '170000', 42, 42, 40),
	(823, 2, null, null, 833, 0, null, null, 31, '2015-06-22', '180000', 43, 42, 40),
	(819, 2, null, null, 813, 1, null, null, 31, '2015-06-23', '190000', 44, 42, 40),
	(815, 1, 0, 5, 831, 1, 0, 4, 31, '2015-06-26', '160000', 45, 43, 40),
	(812, 0, null, null, 823, 1, null, null, 31, '2015-06-26', '193000', 46, 43, 40),
	(824, 0, null, null, 819, 1, null, null, 31, '2015-06-27', '140000', 47, 43, 40),
	(832, 2, null, null, 811, 1, null, null, 31, '2015-06-27', '163000', 48, 43, 40),
	(823, 2, null, null, 815, 0, null, null, 31, '2015-06-30', '190000', 49, 44, 40),
	(819, 2, null, null, 832, 1, null, null, 31, '2015-07-01', '170000', 50, 44, 40),
	(815, 0, 0, null, 832, 0, 1, null, 31, '2015-07-04', '140000', 51, 45, 40),
	(823, 5, null, null, 819, 2, null, null, 31, '2015-07-05', '160000', 52, 46, 40);