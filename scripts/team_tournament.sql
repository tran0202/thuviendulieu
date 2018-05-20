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
