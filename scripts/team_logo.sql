CREATE TABLE IF NOT EXISTS team_logo (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT,
	logo_filename VARCHAR(255),
	start_date DATE,
	end_date DATE,
	FOREIGN KEY (team_id) REFERENCES team(id)
);

INSERT INTO team_logo (logo_filename, team_id)
VALUES ('ARI.svg', 33), ('ATL.svg', 34), ('BAL.svg', 35), ('BUF.svg', 36),
		('CAR.svg', 37), ('CHI.svg', 38), ('CIN.svg', 39), ('CLE.svg', 40),
		('DAL.svg', 41), ('DEN.svg', 42), ('DET.svg', 43),	('GB.svg', 44),
		('HOU.svg', 45), ('IND.svg', 46), ('JAX.svg', 47), ('KC.svg', 48),
		('LAC.svg', 49), ('LA.svg', 50), ('MIA.svg', 51), ('MIN.svg', 52),
		('NE.svg', 53), ('NO.svg', 54), ('NYG.svg', 55),	('NYJ.svg', 56),
		('OAK.svg', 57), ('PHI.svg', 58), ('PIT.svg', 59), ('SF.svg', 60),
		('SEA.svg', 61), ('TB.svg', 62), ('TEN.svg', 63), ('WAS.svg', 64);
