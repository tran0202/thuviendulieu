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

ALTER TABLE team_tournament
ADD COLUMN parent_group_id INT;

ALTER TABLE team_tournament
ADD CONSTRAINT `team_tournament_ibfk_4`
FOREIGN KEY (parent_group_id) REFERENCES `group`(id);

ALTER TABLE team_tournament
ADD COLUMN seed TINYINT UNSIGNED;

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
	(223, 12, 1, 2),
	(3, 12, 1, 3),
	(16, 12, 1, 4),
	(28, 12, 2, 1),
	(5, 12, 2, 2),
	(207, 12, 2, 3),
	(235, 12, 2, 4),
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
	(6, 14, 53, 4),
	(204, 14, 54, 1),
	(14, 14, 54, 2),
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
	(223, 15, 53, 4),
	(203, 15, 54, 1),
	(240, 15, 54, 2),
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
	(226, 16, 53, 2),
	(1, 16, 53, 3),
	(230, 16, 53, 4),
	(31, 16, 54, 1),
	(223, 16, 54, 2),
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
	(6, 17, 52, 4),
	(1, 17, 53, 1),
	(223, 17, 53, 2),
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
	(6, 18, 53, 4),
	(20, 18, 54, 1),
	(233, 18, 54, 2),
	(3, 18, 54, 3),
	(223, 18, 54, 4);

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
	(243, 19, 53, 4),
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
	(233, 20, 52, 3),
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
	(6, 21, 52, 1),
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
VALUES (26, 22), (2, 22), (233, 22), (244, 22),
	(21, 22), (5, 22), (246, 22), (226, 22),
	(203, 22), (221, 22), (1, 22), (7, 22),
	(230, 22), (204, 22), (25, 22);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (222, 22, 63, 1);

#Italy 1934
INSERT INTO team_tournament (team_id, tournament_id)
VALUES (222, 23), (21, 23), (233, 23), (8, 23),
	(26, 23), (204, 23), (25, 23), (3, 23),
	(2, 23), (5, 23), (6, 23), (1, 23),
	(203, 23), (198, 23), (230, 23), (226, 23);

#Uruguay 1930
INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (21, 24, 51, 1), (28, 24, 51, 2), (198, 24, 54, 1), (5, 24, 54, 2),
	(224, 24, 52, 1), (1, 24, 52, 2), (226, 24, 53, 2), (31, 24, 53, 3),
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
