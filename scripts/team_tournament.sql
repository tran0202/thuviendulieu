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
