CREATE TABLE IF NOT EXISTS team_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT NOT NULL,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	qualification TINYINT UNSIGNED,
	qualification_date DATE,
	confederation_id INT,
	seed TINYINT UNSIGNED,
	FOREIGN KEY (team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id),
	FOREIGN KEY (confederation_id) REFERENCES `group`(id)
);

ALTER TABLE team_tournament
ADD COLUMN qualification_date DATE
AFTER qualification;

ALTER TABLE team_tournament
ADD CONSTRAINT `team_tournament_ibfk_5`
FOREIGN KEY (confederation_id) REFERENCES `group`(id);

SELECT *, team_id FROM `team_tournament` WHERE tournament_id = 6;

UPDATE `team_tournament`
SET qualification = 1;

# Russia 2018
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (3, 1, 4, 1),
		(23, 1, 1, 1),
		(17, 1, 1, 2),
		(8, 1, 1, 3),
		(32, 1, 1, 4),
		(4, 1, 2, 1),
		(6, 1, 2, 2),
		(9, 1, 2, 3),
		(14, 1, 2, 4),
		(21, 1, 3, 1),
		(13, 1, 3, 2),
		(31, 1, 3, 3),
		(19, 1, 3, 4),
		(22, 1, 4, 2),
		(18, 1, 4, 3),
		(10, 1, 4, 4),
		(1, 1, 5, 1),
		(26, 1, 5, 2),
		(27, 1, 5, 3),
		(24, 1, 5, 4),
		(2, 1, 6, 1),
		(28, 1, 6, 2),
		(25, 1, 6, 3),
		(16, 1, 6, 4),
		(5, 1, 7, 1),
		(29, 1, 7, 2),
		(12, 1, 7, 3),
		(20, 1, 7, 4),
		(7, 1, 8, 1),
		(11, 1, 8, 2),
		(30, 1, 8, 3),
		(15, 1, 8, 4);

# Brazil 2014
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1, 5, 1, 1),
	(194, 5, 1, 2),
	(28, 5, 1, 3),
	(18, 5, 1, 4),
	(6, 5, 2, 1),
	(199, 5, 2, 2),
	(13, 5, 2, 3),
	(204, 5, 2, 4),
	(30, 5, 3, 1),
	(196, 5, 3, 2),
	(15, 5, 3, 3),
	(202, 5, 3, 4),
	(32, 5, 4, 1),
	(203, 5, 4, 2),
	(27, 5, 4, 3),
	(20, 5, 4, 4),
	(26, 5, 5, 1),
	(200, 5, 5, 2),
	(197, 5, 5, 3),
	(21, 5, 5, 4),
	(3, 5, 6, 1),
	(10, 5, 6, 2),
	(14, 5, 6, 3),
	(201, 5, 6, 4),
	(2, 5, 7, 1),
	(195, 5, 7, 2),
	(198, 5, 7, 3),
	(4, 5, 7, 4),
	(5, 5, 8, 1),
	(193, 5, 8, 2),
	(16, 5, 8, 3),
	(23, 5, 8, 4);

# South Africa 2010
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (205, 6, 1, 1),
	(28, 6, 1, 2),
	(32, 6, 1, 3),
	(21, 6, 1, 4),
	(3, 6, 2, 1),
	(10, 6, 2, 2),
	(16, 6, 2, 3),
	(202, 6, 2, 4),
	(20, 6, 3, 1),
	(198, 6, 3, 2),
	(193, 6, 3, 3),
	(206, 6, 3, 4),
	(2, 6, 4, 1),
	(13, 6, 4, 2),
	(24, 6, 4, 3),
	(195, 6, 4, 4),
	(204, 6, 5, 1),
	(19, 6, 5, 2),
	(15, 6, 5, 3),
	(194, 6, 5, 4),
	(203, 6, 6, 1),
	(207, 6, 6, 2),
	(208, 6, 6, 3),
	(209, 6, 6, 4),
	(1, 6, 7, 1),
	(210, 6, 7, 2),
	(196, 6, 7, 3),
	(4, 6, 7, 4),
	(6, 6, 8, 1),
	(26, 6, 8, 2),
	(197, 6, 8, 3),
	(199, 6, 8, 4);

# Germany 2006
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (2, 7, 1, 1),
	(27, 7, 1, 2),
	(7, 7, 1, 3),
	(200, 7, 1, 4),
	(20, 7, 2, 1),
	(207, 7, 2, 2),
	(211, 7, 2, 3),
	(25, 7, 2, 4),
	(3, 7, 3, 1),
	(196, 7, 3, 2),
	(216, 7, 3, 3),
	(204, 7, 3, 4),
	(28, 7, 4, 1),
	(14, 7, 4, 2),
	(212, 7, 4, 3),
	(4, 7, 4, 4),
	(203, 7, 5, 1),
	(195, 7, 5, 2),
	(198, 7, 5, 3),
	(213, 7, 5, 4),
	(1, 7, 6, 1),
	(18, 7, 6, 2),
	(13, 7, 6, 3),
	(15, 7, 6, 4),
	(21, 7, 7, 1),
	(26, 7, 7, 2),
	(16, 7, 7, 3),
	(214, 7, 7, 4),
	(6, 7, 8, 1),
	(215, 7, 8, 2),
	(12, 7, 8, 3),
	(17, 7, 8, 4);

# Korea/Japan 2002
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (21, 8, 1, 1),
	(11, 8, 1, 2),
	(32, 8, 1, 3),
	(19, 8, 1, 4),
	(6, 8, 2, 1),
	(206, 8, 2, 2),
	(207, 8, 2, 3),
	(205, 8, 2, 4),
	(1, 8, 3, 1),
	(218, 8, 3, 2),
	(219, 8, 3, 3),
	(27, 8, 3, 4),
	(16, 8, 4, 1),
	(7, 8, 4, 2),
	(198, 8, 4, 3),
	(4, 8, 4, 4),
	(2, 8, 5, 1),
	(17, 8, 5, 2),
	(217, 8, 5, 3),
	(194, 8, 5, 4),
	(3, 8, 6, 1),
	(10, 8, 6, 2),
	(20, 8, 6, 3),
	(25, 8, 6, 4),
	(203, 8, 7, 1),
	(200, 8, 7, 2),
	(18, 8, 7, 3),
	(28, 8, 7, 4),
	(15, 8, 8, 1),
	(5, 8, 8, 2),
	(23, 8, 8, 3),
	(12, 8, 8, 4);

# France 1998
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1, 9, 1, 1),
	(220, 9, 1, 2),
	(9, 9, 1, 3),
	(221, 9, 1, 4),
	(203, 9, 2, 1),
	(199, 9, 2, 2),
	(194, 9, 2, 3),
	(222, 9, 2, 4),
	(21, 9, 3, 1),
	(205, 9, 3, 2),
	(17, 9, 3, 3),
	(19, 9, 3, 4),
	(6, 9, 4, 1),
	(10, 9, 4, 2),
	(207, 9, 4, 3),
	(223, 9, 4, 4),
	(204, 9, 5, 1),
	(5, 9, 5, 2),
	(16, 9, 5, 3),
	(28, 9, 5, 4),
	(2, 9, 6, 1),
	(198, 9, 6, 2),
	(224, 9, 6, 3),
	(14, 9, 6, 4),
	(226, 9, 7, 1),
	(30, 9, 7, 2),
	(20, 9, 7, 3),
	(12, 9, 7, 4),
	(3, 9, 8, 1),
	(15, 9, 8, 2),
	(225, 9, 8, 3),
	(18, 9, 8, 4);

# USA 1994
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (198, 10, 1, 1),
	(26, 10, 1, 2),
	(30, 10, 1, 3),
	(226, 10, 1, 4),
	(1, 10, 2, 1),
	(23, 10, 2, 2),
	(194, 10, 2, 3),
	(25, 10, 2, 4),
	(2, 10, 3, 1),
	(227, 10, 3, 2),
	(6, 10, 3, 3),
	(16, 10, 3, 4),
	(3, 10, 4, 1),
	(202, 10, 4, 2),
	(10, 10, 4, 3),
	(223, 10, 4, 4),
	(203, 10, 5, 1),
	(217, 10, 5, 2),
	(221, 10, 5, 3),
	(28, 10, 5, 4),
	(5, 10, 6, 1),
	(9, 10, 6, 2),
	(204, 10, 6, 3),
	(17, 10, 6, 4);

# Italy 1990
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (203, 11, 1, 1),
	(222, 11, 1, 2),
	(198, 11, 1, 3),
	(230, 11, 1, 4),
	(3, 11, 2, 1),
	(194, 11, 2, 2),
	(228, 11, 2, 3),
	(226, 11, 2, 4),
	(1, 11, 3, 1),
	(25, 11, 3, 2),
	(27, 11, 3, 3),
	(220, 11, 3, 4),
	(231, 11, 4, 1),
	(224, 11, 4, 2),
	(229, 11, 4, 3),
	(30, 11, 4, 4),
	(5, 11, 5, 1),
	(16, 11, 5, 2),
	(32, 11, 5, 3),
	(6, 11, 5, 4),
	(20, 11, 6, 1),
	(217, 11, 6, 2),
	(204, 11, 6, 3),
	(8, 11, 6, 4);

# Mexico 1986
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (203, 12, 1, 1),
	(1061, 12, 1, 2),
	(3, 12, 1, 3),
	(16, 12, 1, 4),
	(28, 12, 2, 1),
	(5, 12, 2, 2),
	(207, 12, 2, 3),
	(1065, 12, 2, 4),
	(21, 12, 3, 1),
	(232, 12, 3, 2),
	(228, 12, 3, 3),
	(233, 12, 3, 4),
	(1, 12, 4, 1),
	(6, 12, 4, 2),
	(193, 12, 4, 3),
	(234, 12, 4, 4),
	(231, 12, 5, 1),
	(32, 12, 5, 2),
	(220, 12, 5, 3),
	(19, 12, 5, 4),
	(7, 12, 6, 1),
	(9, 12, 6, 2),
	(4, 12, 6, 3),
	(20, 12, 6, 4);

# Spain 1982
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (203, 13, 51, 1),
	(7, 13, 51, 2),
	(31, 13, 51, 3),
	(194, 13, 51, 4),
	(231, 13, 52, 1),
	(193, 13, 52, 2),
	(199, 13, 52, 3),
	(222, 13, 52, 4),
	(3, 13, 53, 1),
	(5, 13, 53, 2),
	(233, 13, 53, 3),
	(236, 13, 53, 4),
	(20, 13, 54, 1),
	(21, 13, 54, 2),
	(230, 13, 54, 3),
	(237, 13, 54, 4),
	(6, 13, 55, 1),
	(197, 13, 55, 2),
	(224, 13, 55, 3),
	(234, 13, 55, 4),
	(1, 13, 56, 1),
	(228, 13, 56, 2),
	(220, 13, 56, 3),
	(208, 13, 56, 4);

# Argentina 1978
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (3, 14, 51, 1),
	(233, 14, 51, 2),
	(203, 14, 51, 3),
	(21, 14, 51, 4),
	(231, 14, 52, 1),
	(7, 14, 52, 2),
	(12, 14, 52, 3),
	(28, 14, 52, 4),
	(1, 14, 53, 1),
	(25, 14, 53, 2),
	(222, 14, 53, 3),
	(1063, 14, 53, 4),
	(204, 14, 54, 1),
	(1062, 14, 54, 2),
	(31, 14, 54, 3),
	(220, 14, 54, 4);

# Germany 1974
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (231, 15, 51, 1),
	(199, 15, 51, 2),
	(238, 15, 51, 3),
	(13, 15, 51, 4),
	(1, 15, 52, 1),
	(224, 15, 52, 2),
	(239, 15, 52, 3),
	(220, 15, 52, 4),
	(32, 15, 53, 1),
	(204, 15, 53, 2),
	(25, 15, 53, 3),
	(1061, 15, 53, 4),
	(203, 15, 54, 1),
	(1060, 15, 54, 2),
	(7, 15, 54, 3),
	(3, 15, 54, 4);

# Mexico 1970
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (28, 16, 51, 1),
	(228, 16, 51, 2),
	(5, 16, 51, 3),
	(236, 16, 51, 4),
	(32, 16, 52, 1),
	(242, 16, 52, 2),
	(203, 16, 52, 3),
	(25, 16, 52, 4),
	(20, 16, 53, 1),
	(1059, 16, 53, 2),
	(1, 16, 53, 3),
	(230, 16, 53, 4),
	(31, 16, 54, 1),
	(1058, 16, 54, 2),
	(231, 16, 54, 3),
	(9, 16, 54, 4);

# England 1966
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (20, 17, 51, 1),
	(32, 17, 51, 2),
	(21, 17, 51, 3),
	(28, 17, 51, 4),
	(231, 17, 52, 1),
	(26, 17, 52, 2),
	(3, 17, 52, 3),
	(1054, 17, 52, 4),
	(1, 17, 53, 1),
	(1057, 17, 53, 2),
	(4, 17, 53, 3),
	(233, 17, 53, 4),
	(228, 17, 54, 1),
	(210, 17, 54, 2),
	(203, 17, 54, 3),
	(199, 17, 54, 4);

# Chile 1962
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (32, 18, 51, 1),
	(30, 18, 51, 2),
	(228, 18, 51, 3),
	(224, 18, 51, 4),
	(203, 18, 52, 1),
	(231, 18, 52, 2),
	(199, 18, 52, 3),
	(26, 18, 52, 4),
	(1, 18, 53, 1),
	(28, 18, 53, 2),
	(230, 18, 53, 3),
	(1054, 18, 53, 4),
	(20, 18, 54, 1),
	(233, 18, 54, 2),
	(3, 18, 54, 3),
	(1057, 18, 54, 4);

# Sweden 1958
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (3, 19, 51, 1),
	(231, 19, 51, 2),
	(234, 19, 51, 3),
	(230, 19, 51, 4),
	(21, 19, 52, 1),
	(207, 19, 52, 2),
	(224, 19, 52, 3),
	(220, 19, 52, 4),
	(25, 19, 53, 1),
	(28, 19, 53, 2),
	(233, 19, 53, 3),
	(1056, 19, 53, 4),
	(228, 19, 54, 1),
	(20, 19, 54, 2),
	(1, 19, 54, 3),
	(222, 19, 54, 4);

# Switzerland 1954
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1, 20, 51, 1),
	(28, 20, 51, 2),
	(224, 20, 51, 3),
	(21, 20, 51, 4),
	(231, 20, 52, 1),
	(218, 20, 52, 2),
	(1055, 20, 52, 3),
	(16, 20, 52, 4),
	(32, 20, 53, 1),
	(230, 20, 53, 2),
	(222, 20, 53, 3),
	(220, 20, 53, 4),
	(20, 20, 54, 1),
	(5, 20, 54, 2),
	(26, 20, 54, 3),
	(203, 20, 54, 4);

# Brazil 1950
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (1, 21, 51, 1),
	(224, 21, 51, 2),
	(26, 21, 51, 3),
	(28, 21, 51, 4),
	(1054, 21, 52, 1),
	(199, 21, 52, 2),
	(20, 21, 52, 3),
	(198, 21, 52, 4),
	(25, 21, 53, 1),
	(203, 21, 53, 2),
	(207, 21, 53, 3),
	(32, 21, 54, 1),
	(227, 21, 54, 2);

#France 1938
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (26, 22), (1053, 22), (1051, 22), (244, 22),
	(21, 22), (5, 22), (246, 22), (226, 22),
	(1048, 22), (221, 22), (1, 22), (7, 22),
	(230, 22), (204, 22), (25, 22);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (222, 22, 63, 1);

#Italy 1934
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (222, 23), (21, 23), (1051, 23), (1052, 23),
	(26, 23), (204, 23), (25, 23), (3, 23),
	(1049, 23), (5, 23), (1050, 23), (1, 23),
	(1048, 23), (198, 23), (230, 23), (226, 23);

#Uruguay 1930
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (21, 24, 51, 1), (28, 24, 51, 2), (198, 24, 54, 1), (5, 24, 54, 2),
	(1047, 24, 52, 1), (1, 24, 52, 2), (226, 24, 53, 2), (31, 24, 53, 3),
	(3, 24, 51, 3), (199, 24, 51, 4), (227, 24, 52, 3), (207, 24, 54, 3),
	(32, 24, 53, 1);

#UEFA Nations League
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(21, 25, 51, 1, 69, 1),
	(2, 25, 51, 2, 69, 2),
	(204, 25, 51, 3, 69, 3),
	(5, 25, 52, 1, 69, 4),
	(22, 25, 52, 2, 69, 5),
	(26, 25, 52, 3, 69, 6),
	(203, 25, 53, 1, 69, 7),
	(7, 25, 53, 2, 69, 8),
	(4, 25, 53, 3, 69, 9),
	(18, 25, 54, 1, 69, 10),
	(20, 25, 54, 2, 69, 11),
	(6, 25, 54, 3, 69, 12),
	(213, 25, 51, 1, 70, 1),
	(209, 25, 51, 2, 70, 2),
	(215, 25, 51, 3, 70, 3),
	(23, 25, 52, 1, 70, 4),
	(25, 25, 52, 2, 70, 5),
	(218, 25, 52, 3, 70, 6),
	(222, 25, 53, 1, 70, 7),
	(201, 25, 53, 2, 70, 8),
	(234, 25, 53, 3, 70, 9),
	(19, 25, 54, 1, 70, 10),
	(217, 25, 54, 2, 70, 11),
	(243, 25, 54, 3, 70, 12),
	(247, 25, 51, 1, 71, 1),
	(242, 25, 51, 2, 71, 2),
	(220, 25, 51, 3, 71, 3),
	(248, 25, 52, 1, 71, 4),
	(249, 25, 52, 2, 71, 5),
	(202, 25, 52, 3, 71, 6),
	(233, 25, 52, 4, 71, 7),
	(223, 25, 53, 1, 71, 8),
	(250, 25, 53, 2, 71, 9),
	(221, 25, 53, 3, 71, 10),
	(206, 25, 53, 4, 71, 11),
	(251, 25, 54, 1, 71, 12),
	(252, 25, 54, 2, 71, 13),
	(226, 25, 54, 3, 71, 14),
	(24, 25, 54, 4, 71, 15),
	(253, 25, 51, 1, 72, 1),
	(254, 25, 51, 2, 72, 2),
	(255, 25, 51, 3, 72, 3),
	(256, 25, 51, 4, 72, 4),
	(257, 25, 52, 1, 72, 5),
	(258, 25, 52, 2, 72, 6),
	(259, 25, 52, 3, 72, 7),
	(260, 25, 52, 4, 72, 8),
	(261, 25, 53, 1, 72, 9),
	(262, 25, 53, 2, 72, 10),
	(263, 25, 53, 3, 72, 11),
	(264, 25, 53, 4, 72, 12),
	(265, 25, 54, 1, 72, 13),
	(266, 25, 54, 2, 72, 14),
	(267, 25, 54, 3, 72, 15),
	(268, 25, 54, 4, 72, 16);

#UCL 2018
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (573, 29), (571, 29), (579, 29), (581, 29),
	   (575, 29), (576, 29), (599, 29), (588, 29),
	   (563, 29), (567, 29), (572, 29), (561, 29),
	   (602, 29), (577, 29), (589, 29), (598, 29),
	   (569, 29), (580, 29), (583, 29), (565, 29),
	   (597, 29), (592, 29), (603, 29), (593, 29),
	   (555, 29), (596, 29), (564, 29), (578, 29),
	   (600, 29), (582, 29), (570, 29), (585, 29),
	   (586, 29), (601, 29), (587, 29), (584, 29),
	   (568, 29), (558, 29), (566, 29), (556, 29),
	   (553, 29), (552, 29), (595, 29),
	   (551, 29), (560, 29), (591, 29), (594, 29),
	   (554, 29), (574, 29), (557, 29), (590, 29),
	   (562, 29), (559, 29);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (562, 29), (559, 29);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (540, 29, 1, 1),
	   (530, 29, 1, 2),
	   (525, 29, 1, 3),
	   (528, 29, 1, 4),
	   (526, 29, 2, 1),
	   (533, 29, 2, 2),
	   (549, 29, 2, 4),
	   (535, 29, 3, 2),
	   (542, 29, 3, 3),
	   (541, 29, 3, 4),
	   (536, 29, 4, 1),
	   (544, 29, 4, 2),
	   (547, 29, 4, 3),
	   (531, 29, 4, 4),
	   (527, 29, 5, 3),
	   (548, 29, 6, 1),
	   (538, 29, 6, 2),
	   (537, 29, 6, 3),
	   (532, 29, 6, 4),
	   (546, 29, 7, 1),
	   (543, 29, 7, 2),
	   (529, 29, 7, 3),
	   (545, 29, 7, 4),
	   (534, 29, 8, 2),
	   (539, 29, 8, 3),
	   (550, 29, 8, 4);

# UEL 2018
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (733, 30), (686, 30), (676, 30), (721, 30),
	   (658, 30), (700, 30), (661, 30), (749, 30),
	   (653, 30), (744, 30), (675, 30), (681, 30),
	   (751, 30), (654, 30),
	   (732, 30), (748, 30), (656, 30), (734, 30),
	   (724, 30), (691, 30), (754, 30), (707, 30),
	   (680, 30), (759, 30),
	   (684, 30), (634, 30), (723, 30), (755, 30),
	   (756, 30), (710, 30), (662, 30), (657, 30),
	   (731, 30), (719, 30), (712, 30),
	   (701, 30), (631, 30), (706, 30), (674, 30),
	   (694, 30), (750, 30), (761, 30),
	   (655, 30), (699, 30), (703, 30), (679, 30),
	   (682, 30), (722, 30), (693, 30), (739, 30),
	   (708, 30), (688, 30), (714, 30), (740, 30),
	   (677, 30), (633, 30), (649, 30), (702, 30),
	   (720, 30), (718, 30), (665, 30), (735, 30),
	   (667, 30), (669, 30), (715, 30), (752, 30),
	   (746, 30), (622, 30), (666, 30), (727, 30),
	   (692, 30), (639, 30), (697, 30),
	   (685, 30), (760, 30), (747, 30),
	   (725, 30), (757, 30), (738, 30), (672, 30),
	   (736, 30), (648, 30), (730, 30), (636, 30),
	   (660, 30), (642, 30), (690, 30), (717, 30),
	   (705, 30), (683, 30), (663, 30), (716, 30),
	   (742, 30), (664, 30), (726, 30),
	   (673, 30), (670, 30), (745, 30), (698, 30),
	   (643, 30), (625, 30), (593, 30), (579, 30),
	   (758, 30), (652, 30), (628, 30), (599, 30),
	   (602, 30), (687, 30), (572, 30), (571, 30),
	   (564, 30), (575, 30), (632, 30), (603, 30),
	   (600, 30), (671, 30), (713, 30), (647, 30),
	   (696, 30), (729, 30), (668, 30), (651, 30),
	   (704, 30), (709, 30), (585, 30), (570, 30),
	   (597, 30), (563, 30), (573, 30), (601, 30),
	   (598, 30), (581, 30), (689, 30), (629, 30),
	   (624, 30), (743, 30), (623, 30), (650, 30),
	   (637, 30), (741, 30), (621, 30), (646, 30),
	   (627, 30), (640, 30),
	   (568, 30), (584, 30), (580, 30), (576, 30),
	   (587, 30), (582, 30), (588, 30), (577, 30),
	   (578, 30), (596, 30), (644, 30), (659, 30),
	   (645, 30), (630, 30), (695, 30), (641, 30),
	   (711, 30), (678, 30), (635, 30), (638, 30),
	   (728, 30), (753, 30), (626, 30), (566, 30),
	   (595, 30);

INSERT INTO team_tournament (team_id, tournament_id)
VALUES (583, 30), (567, 30), (586, 30), (565, 30),
	   (592, 30), (589, 30);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (613, 30, 1, 1),
	   (620, 30, 1, 3),
	   (560, 30, 2, 3),
	   (590, 30, 3, 4),
	   (574, 30, 4, 1),
	   (605, 30, 4, 3),
	   (556, 30, 4, 4),
	   (619, 30, 5, 1),
	   (617, 30, 5, 2),
	   (606, 30, 5, 4),
	   (607, 30, 6, 1),
	   (615, 30, 6, 3),
	   (591, 30, 7, 1),
	   (618, 30, 7, 2),
	   (614, 30, 8, 2),
	   (609, 30, 8, 3),
	   (612, 30, 8, 4),
	   (611, 30, 129, 1),
	   (594, 30, 129, 3),
	   (604, 30, 129, 4),
	   (616, 30, 130, 2),
	   (610, 30, 130, 3),
	   (557, 30, 130, 4),
	   (553, 30, 131, 1),
	   (558, 30, 131, 2),
	   (608, 30, 131, 3),
	   (561, 30, 131, 4);

# Canada 2015
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (811, 31, 1, 1),
	   (812, 31, 1, 2),
	   (813, 31, 1, 3),
	   (814, 31, 1, 4),
	   (815, 31, 2, 1),
	   (816, 31, 2, 2),
	   (817, 31, 2, 3),
	   (818, 31, 2, 4),
	   (819, 31, 3, 1),
	   (820, 31, 3, 2),
	   (821, 31, 3, 3),
	   (822, 31, 3, 4),
	   (823, 31, 4, 1),
	   (824, 31, 4, 2),
	   (825, 31, 4, 3),
	   (826, 31, 4, 4),
	   (827, 31, 5, 1),
	   (828, 31, 5, 2),
	   (829, 31, 5, 3),
	   (830, 31, 5, 4),
	   (831, 31, 6, 1),
	   (832, 31, 6, 2),
	   (833, 31, 6, 3),
	   (834, 31, 6, 4);

# Men's Rio 2016
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (835, 32, 1, 1),
	   (836, 32, 1, 2),
	   (1090, 32, 1, 3),
	   (838, 32, 1, 4),
	   (839, 32, 2, 1),
	   (840, 32, 2, 2),
	   (841, 32, 2, 3),
	   (842, 32, 2, 4),
	   (843, 32, 3, 1),
	   (844, 32, 3, 2),
	   (845, 32, 3, 3),
	   (846, 32, 3, 4),
	   (847, 32, 4, 1),
	   (848, 32, 4, 2),
	   (849, 32, 4, 3),
	   (850, 32, 4, 4);

# Women's Rio 2016
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (851, 33, 5, 1),
	   (852, 33, 5, 2),
	   (853, 33, 5, 3),
	   (854, 33, 5, 4),
	   (855, 33, 6, 1),
	   (856, 33, 6, 2),
	   (857, 33, 6, 3),
	   (858, 33, 6, 4),
	   (859, 33, 7, 1),
	   (860, 33, 7, 2),
	   (861, 33, 7, 3),
	   (862, 33, 7, 4);

#NFL
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(53, 2, 31, 1, 29, 1),
		(36, 2, 31, 2, 29, 2),
		(51, 2, 31, 3, 29, 3),
		(56, 2, 31, 4, 29, 4),
		(59, 2, 32, 1, 29, 5),
		(35, 2, 32, 2, 29, 6),
		(39, 2, 32, 3, 29, 7),
		(40, 2, 32, 4, 29, 8),
		(47, 2, 33, 1, 29, 9),
		(63, 2, 33, 2, 29, 10),
		(46, 2, 33, 3, 29, 11),
		(45, 2, 33, 4, 29, 12),
		(48, 2, 34, 1, 29, 13),
		(49, 2, 34, 2, 29, 14),
		(57, 2, 34, 3, 29, 15),
		(42, 2, 34, 4, 29, 16),
		(58, 2, 31, 1, 30, 1),
		(41, 2, 31, 2, 30, 2),
		(64, 2, 31, 3, 30, 3),
		(55, 2, 31, 4, 30, 4),
		(52, 2, 32, 1, 30, 5),
		(43, 2, 32, 2, 30, 6),
		(44, 2, 32, 3, 30, 7),
		(38, 2, 32, 4, 30, 8),
		(54, 2, 33, 1, 30, 9),
		(37, 2, 33, 2, 30, 10),
		(34, 2, 33, 3, 30, 11),
		(62, 2, 33, 4, 30, 12),
		(50, 2, 34, 1, 30, 13),
		(61, 2, 34, 2, 30, 14),
		(33, 2, 34, 3, 30, 15),
		(60, 2, 34, 4, 30, 16);

#Tennis
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (65, 4), (66, 4), (67, 4), (68, 4),
	   (69, 4), (70, 4), (71, 4), (72, 4),
	   (73, 4), (74, 4), (75, 4), (76, 4),
	   (77, 4), (78, 4), (79, 4), (80, 4),
	   (81, 4), (82, 4), (83, 4), (84, 4),
	   (85, 4), (86, 4), (87, 4), (88, 4),
	   (89, 4), (90, 4), (91, 4), (92, 4),
	   (93, 4), (94, 4), (95, 4), (96, 4),
	   (97, 4), (98, 4), (99, 4), (100, 4),
	   (101, 4), (102, 4), (103, 4), (104, 4),
	   (105, 4), (106, 4), (107, 4), (108, 4),
	   (109, 4), (110, 4), (111, 4), (112, 4),
	   (113, 4), (114, 4), (115, 4), (116, 4),
	   (117, 4), (118, 4), (119, 4), (120, 4),
	   (121, 4), (122, 4), (123, 4), (124, 4),
	   (125, 4), (126, 4), (127, 4), (128, 4),
	   (129, 4), (130, 4), (131, 4), (132, 4),
	   (133, 4), (134, 4), (135, 4), (136, 4),
	   (137, 4), (138, 4), (139, 4), (140, 4),
	   (141, 4), (142, 4), (143, 4), (144, 4),
	   (145, 4), (146, 4), (147, 4), (148, 4),
	   (149, 4), (150, 4), (151, 4), (152, 4),
	   (153, 4), (154, 4), (155, 4), (156, 4),
	   (157, 4), (158, 4), (159, 4), (160, 4),
	   (161, 4), (162, 4), (163, 4), (164, 4),
	   (165, 4), (166, 4), (167, 4), (168, 4),
	   (169, 4), (170, 4), (171, 4), (172, 4),
	   (173, 4), (174, 4), (175, 4), (176, 4),
	   (177, 4), (178, 4), (179, 4), (180, 4),
	   (181, 4), (182, 4), (183, 4), (184, 4),
	   (185, 4), (186, 4), (187, 4), (188, 4),
	   (189, 4), (190, 4), (191, 4), (192, 4);

INSERT INTO team_tournament (team_id, tournament_id, seed)
VALUES (114, 27, 1), (155, 27, NULL), (117, 27, NULL), (159, 27, NULL),
	   (183, 27, NULL), (269, 27, NULL), (164, 27, NULL), (157, 27, 27),
	   (185, 27, 18), (270, 27, NULL), (109, 27, NULL), (177, 27, NULL),
	   (269, 27, NULL), (108, 27, NULL), (167, 27, NULL), (131, 27, 16),
	   (67, 27, 9), (271, 27, NULL), (163, 27, NULL), (134, 27, NULL),
	   (165, 27, NULL), (92, 27, NULL), (272, 27, NULL), (125, 27, 19),
	   (176, 27, 28), (269, 27, NULL), (171, 27, NULL), (126, 27, NULL),
	   (77, 27, NULL), (110, 27, NULL), (84, 27, NULL), (141, 27, 5),
	   (96, 27, 3), (269, 27, NULL), (273, 27, NULL), (274, 27, NULL),
	   (275, 27, NULL), (276, 27, NULL), (116, 27, NULL), (118, 27, 31),
	   (189, 27, 20), (138, 27, NULL), (277, 27, NULL), (269, 27, NULL),
	   (175, 27, NULL), (147, 27, NULL), (269, 27, NULL), (278, 27, 15),
	   (154, 27, 11), (279, 27, NULL), (280, 27, NULL), (281, 27, NULL),
	   (140, 27, NULL), (186, 27, NULL), (113, 27, NULL), (90, 27, 24),
	   (282, 27, 25), (178, 27, NULL), (269, 27, NULL), (172, 27, NULL),
	   (269, 27, NULL), (269, 27, NULL), (283, 27, NULL), (111, 27, 8),
	   (161, 27, 7), (145, 27, NULL), (89, 27, NULL), (269, 27, NULL),
	   (68, 27, NULL), (79, 27, NULL), (128, 27, NULL), (88, 27, 29),
	   (284, 27, 22), (101, 27, NULL), (122, 27, NULL), (82, 27, NULL),
	   (285, 27, NULL), (132, 27, NULL), (269, 27, NULL), (102, 27, 10),
	   (144, 27, 13), (286, 27, NULL), (287, 27, NULL), (288, 27, NULL),
	   (269, 27, NULL), (78, 27, NULL), (76, 27, NULL), (289, 27, 21),
	   (290, 27, 32), (291, 27, NULL), (292, 27, NULL), (121, 27, NULL),
	   (190, 27, NULL), (293, 27, NULL), (269, 27, NULL), (187, 27, 4),
	   (294, 27, 6), (173, 27, NULL), (94, 27, NULL), (162, 27, NULL),
	   (295, 27, NULL), (72, 27, NULL), (65, 27, NULL), (71, 27, 26),
	   (180, 27, 17), (269, 27, NULL), (91, 27, NULL), (86, 27, NULL),
	   (168, 27, NULL), (269, 27, NULL), (105, 27, NULL), (135, 27, 12),
	   (97, 27, 14), (296, 27, NULL), (297, 27, NULL), (104, 27, NULL),
	   (156, 27, NULL), (298, 27, NULL), (87, 27, NULL), (129, 27, 23),
	   (103, 27, 30), (149, 27, NULL), (299, 27, NULL), (153, 27, NULL),
	   (160, 27, NULL), (269, 27, NULL), (300, 27, NULL), (127, 27, 2);

INSERT INTO team_tournament (team_id, tournament_id, seed)
VALUES (413, 28, 1), (414, 28, NULL), (269, 28, NULL), (415, 28, NULL),
	   (416, 28, NULL), (417, 28, NULL), (418, 28, NULL), (419, 28, 27),
	   (420, 28, 17), (421, 28, NULL), (422, 28, NULL), (423, 28, NULL),
	   (424, 28, NULL), (425, 28, NULL), (426, 28, NULL), (427, 28, 16),
	   (428, 28, 12), (429, 28, NULL), (269, 28, NULL), (430, 28, NULL),
	   (431, 28, NULL), (432, 28, NULL), (269, 28, NULL), (433, 28, 18),
	   (434, 28, 32), (435, 28, NULL), (436, 28, NULL), (437, 28, NULL),
	   (269, 28, NULL), (438, 28, NULL), (439, 28, NULL), (440, 28, 8),
	   (441, 28, 3), (442, 28, NULL), (269, 28, NULL), (269, 28, NULL),
	   (443, 28, NULL), (444, 28, NULL), (445, 28, NULL), (446, 28, 25),
	   (447, 28, 23), (269, 28, NULL), (448, 28, NULL), (449, 28, NULL),
	   (450, 28, NULL), (451, 28, NULL), (452, 28, NULL), (453, 28, 15),
	   (454, 28, 9), (269, 28, NULL), (269, 28, NULL), (455, 28, NULL),
	   (456, 28, NULL), (457, 28, NULL), (458, 28, NULL), (459, 28, 19),
	   (460, 28, 31), (461, 28, NULL), (462, 28, NULL), (463, 28, NULL),
	   (464, 28, NULL), (465, 28, NULL), (466, 28, NULL), (467, 28, 7),
	   (468, 28, 6), (469, 28, NULL), (470, 28, NULL), (471, 28, NULL),
	   (472, 28, NULL), (473, 28, NULL), (269, 28, NULL), (474, 28, 30),
	   (475, 28, 22), (269, 28, NULL), (476, 28, NULL), (477, 28, NULL),
	   (478, 28, NULL), (479, 28, NULL), (480, 28, NULL), (481, 28, 10),
	   (482, 28, 14), (483, 28, NULL), (484, 28, NULL), (485, 28, NULL),
	   (486, 28, NULL), (487, 28, NULL), (488, 28, NULL), (489, 28, 24),
	   (490, 28, 29), (269, 28, NULL), (491, 28, NULL), (492, 28, NULL),
	   (493, 28, NULL), (494, 28, NULL), (495, 28, NULL), (496, 28, 4),
	   (497, 28, 5), (498, 28, NULL), (499, 28, NULL), (500, 28, NULL),
	   (269, 28, NULL), (501, 28, NULL), (502, 28, NULL), (503, 28, 26),
	   (504, 28, 20), (505, 28, NULL), (506, 28, NULL), (269, 28, NULL),
	   (507, 28, NULL), (508, 28, NULL), (509, 28, NULL), (510, 28, 11),
	   (511, 28, 13), (512, 28, NULL), (269, 28, NULL), (513, 28, NULL),
	   (514, 28, NULL), (269, 28, NULL), (515, 28, NULL), (516, 28, 21),
	   (517, 28, 28), (518, 28, NULL), (519, 28, NULL), (520, 28, NULL),
	   (521, 28, NULL), (522, 28, NULL), (523, 28, NULL), (524, 28, 2);

SELECT t.name AS name, team_id,
 	group_id, g.name AS group_name,	group_order, 
 	parent_group_id, pg.name AS parent_group_name, parent_group_order,
 	tt.tournament_id
FROM team_tournament tt 
LEFT JOIN team t ON t.id = tt.team_id
LEFT JOIN `group` g ON g.id = tt.group_id
LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
WHERE tt.tournament_id = 4
ORDER BY parent_group_name, group_id, group_order;

SELECT
 	group_id, g.name AS group_name
FROM team_tournament tt
LEFT JOIN `group` g ON g.id = tt.group_id
WHERE tt.tournament_id = 1
GROUP BY group_id;

SELECT t.name AS name, team_id,
 	group_id, g.name AS group_name,	group_order,
 	tt.tournament_id
FROM team_tournament tt
LEFT JOIN team t ON t.id = tt.team_id
LEFT JOIN `group` g ON g.id = tt.group_id
WHERE tt.tournament_id = 1
    AND group_id = 1
ORDER BY group_id, group_order;
