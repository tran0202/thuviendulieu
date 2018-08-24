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
VALUES (114, 27, 1), (155, 27, null), (117, 27, null), (159, 27, null),
	   (183, 27, null), (269, 27, null), (164, 27, null), (157, 27, 27),
	   (185, 27, 18), (270, 27, null), (109, 27, null), (177, 27, null),
	   (269, 27, null), (108, 27, null), (167, 27, null), (131, 27, 16),
	   (67, 27, 9), (271, 27, null), (163, 27, null), (134, 27, null),
	   (165, 27, null), (92, 27, null), (272, 27, null), (125, 27, 19),
	   (176, 27, 28), (269, 27, null), (171, 27, null), (126, 27, null),
	   (77, 27, null), (110, 27, null), (84, 27, null), (141, 27, 5),
	   (96, 27, 3), (269, 27, null), (273, 27, null), (274, 27, null),
	   (275, 27, null), (276, 27, null), (116, 27, null), (118, 27, 31),
	   (189, 27, 20), (138, 27, null), (277, 27, null), (269, 27, null),
	   (175, 27, null), (147, 27, null), (269, 27, null), (278, 27, 15),
	   (154, 27, 11), (279, 27, null), (280, 27, null), (281, 27, null),
	   (140, 27, null), (186, 27, null), (113, 27, null), (90, 27, 24),
	   (282, 27, 25), (178, 27, null), (269, 27, null), (172, 27, null),
	   (269, 27, null), (269, 27, null), (283, 27, null), (111, 27, 8),
	   (161, 27, 7), (145, 27, null), (89, 27, null), (269, 27, null),
	   (68, 27, null), (79, 27, null), (128, 27, null), (88, 27, 29),
	   (284, 27, 22), (101, 27, null), (122, 27, null), (82, 27, null),
	   (285, 27, null), (132, 27, null), (269, 27, null), (102, 27, 10),
	   (144, 27, 13), (286, 27, null), (287, 27, null), (288, 27, null),
	   (269, 27, null), (78, 27, null), (76, 27, null), (289, 27, 21),
	   (290, 27, 32), (291, 27, null), (292, 27, null), (121, 27, null),
	   (190, 27, null), (293, 27, null), (269, 27, null), (187, 27, 4),
	   (294, 27, 6), (173, 27, null), (94, 27, null), (162, 27, null),
	   (295, 27, null), (72, 27, null), (65, 27, null), (71, 27, 26),
	   (180, 27, 17), (269, 27, null), (91, 27, null), (86, 27, null),
	   (168, 27, null), (269, 27, null), (105, 27, null), (135, 27, 12),
	   (97, 27, 14), (296, 27, null), (297, 27, null), (104, 27, null),
	   (156, 27, null), (298, 27, null), (87, 27, null), (129, 27, 23),
	   (103, 27, 30), (149, 27, null), (299, 27, null), (153, 27, null),
	   (160, 27, null), (269, 27, null), (300, 27, null), (127, 27, 2);
