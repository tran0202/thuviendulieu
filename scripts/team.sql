DROP TABLE IF EXISTS team;

CREATE TABLE IF NOT EXISTS team (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	nation_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id),
	FOREIGN KEY (nation_id) REFERENCES nation(id),
	FOREIGN KEY (parent_team_id) REFERENCES team(id)
);

ALTER TABLE team
	ADD COLUMN parent_team_id INT;

ALTER TABLE team
	ADD CONSTRAINT team_ibfk_3
	FOREIGN KEY (parent_team_id) REFERENCES team(id);

INSERT INTO team (name, team_type_id)
VALUES ('Brazil', 1), ('Germany', 1), ('Argentina', 1),	('Portugal', 1),
		('Belgium', 1),	('Spain', 1), ('Poland', 1), ('Egypt', 1),
		('Morocco', 1),	('Nigeria', 1),	('Senegal', 1),	('Tunisia', 1),
		('Australia', 1), ('IR Iran', 1), ('Japan', 1),	('Korea Republic', 1),
		('Saudi Arabia', 1), ('Croatia', 1), ('Denmark', 1), ('England', 1),
		('France', 1), ('Iceland', 1), ('Russia', 1), ('Serbia', 1),
		('Sweden', 1), ('Switzerland', 1), ('Costa Rica', 1), ('Mexico', 1),
		('Panama', 1), ('Colombia', 1),	('Peru', 1), ('Uruguay', 1),
		('Arizona Cardinals', 6), ('Atlanta Falcons', 6), ('Baltimore Ravens', 6), ('Buffalo Bills', 6),
		('Carolina Panthers', 6), ('Chicago Bears', 6),	('Cincinnati Bengals', 6), ('Cleveland Browns', 6),
		('Dallas Cowboys', 6), ('Denver Broncos', 6), ('Detroit Lions', 6),	('Green Bay Packers', 6),
		('Houston Texans', 6), ('Indianapolis Colts', 6), ('Jacksonville Jaguars', 6), ('Kansas City Chiefs', 6),
		('Los Angeles Chargers', 6), ('Los Angeles Rams', 6), ('Miami Dolphins', 6), ('Minnesota Vikings', 6),
		('New England Patriots', 6), ('New Orleans Saints', 6),	('New York Giants', 6),	('New York Jets', 6),
		('Oakland Raiders', 6),	('Philadelphia Eagles', 6),	('Pittsburgh Steelers', 6),	('San Francisco 49ers', 6),
		('Seattle Seahawks', 6), ('Tampa Bay Buccaneers', 6), ('Tennessee Titans', 6), ('Washington Redskins', 6);

INSERT INTO team (name, team_type_id)
VALUES ('Yuichi Sugita', 7), ('Geoffrey Blancaneaux', 7), ('Dominic Thiem', 7),	('Alex De Minaur', 7),
		('Bjorn Fratangelo', 7), ('Ivo Karlovic', 7), ('Richard Gasquet', 7), ('Leonardo Mayer', 7),
		('Adrian Menendez-Maceiras', 7), ('Patrick Kypson', 7),	('Donald Young', 7), ('Maximilian Marterer', 7),
		('Jeremy Chardy', 7), ('Gael Monfils',7), ('Taro Daniel', 7), ('Tommy Paul', 7),
		('Alexandr Dolgopolov', 7), ('Jan-Lennard Struff', 7), ('Tomas Berdych', 7), ('Ryan Harrison', 7),
		('Blaz Kavcic', 7), ('Mikhail Youzhny', 7), ('Ricardas Berankis', 7), ('Adrian Mannarino', 7),
		('Pablo Cuevas', 7), ('Damir Dzumhur', 7), ('Marcos Baghdatis', 7), ('Taylor Fritz', 7),
		('Norbert Gombos', 7), ('Viktor Troicki', 7), ('Henri Laaksonen', 7), ('Juan Martin Del Potro', 7),
		('Fabio Fognini', 7), ('Stefano Travaglia', 7), ('Cedrik-Marcel Stebe', 7), ('Nicolas Kicker', 7),
		('Julien Benneteau', 7), ('David Goffin', 7), ('Nick Kyrgios', 7), ('John Millman', 7),
		('Malek Jaziri', 7), ('Thiago Monteiro', 7), ('Steve Darcis', 7), ('Guido Pella', 7),
		('Aljaz Bedene', 7), ('Andrey Rublev', 7), ('Grigor Dimitrov', 7), ('Vaclav Safranek', 7),
		('Dusan Lajovic', 7), ('Rafael Nadal', 7), ('Andrey Kuznetsov', 7), ('Feliciano Lopez', 7),
		('Vasek Pospisil', 7), ('Fernando Verdasco', 7), ('Santiago Giraldo', 7), ('Vincent Millot', 7),
		('Philipp Kohlschreiber', 7), ('Tim Smyczek', 7), ('Thomaz Bellucci', 7), ('Dustin Brown', 7),
		('Roberto Bautista Agut', 7), ('Andreas Seppi', 7), ('Roger Federer', 7), ('Frances Tiafoe', 7),
		('Hyeon Chung', 7), ('Horacio Zeballos', 7), ('Kyle Edmund', 7), ('Robin Haase', 7),
		('Nicolas Almagro', 7), ('Steve Johnson', 7), ('Pablo Carreno Busta', 7), ('Evan King', 7),
		('Rogerio Dutra Silva', 7), ('Florian Mayer', 7), ('Dmitry Tursunov', 7), ('Cameron Norrie', 7),
		('Kevin Anderson', 7), ('JC Aragone',7), ('Carlos Berlocq', 7), ('Diego Schwartzman', 7),
		('Marius Copil', 7), ('Jo-Wilfried Tsonga', 7), ('Evgeny Donskoy', 7), ('Andreas Haider-Maurer', 7),
		('Radu Albot', 7), ('Ernesto Escobedo', 7), ('Alessandro Giannessi', 7), ('Ernests Gulbis', 7),
		('Pierre-Hugues Herbert', 7), ('John Isner', 7), ('David Ferrer', 7), ('Mikhail Kukushkin', 7),
		('Karen Khachanov', 7), ('Yen-Hsun Lu', 7), ('Lukas Lacko', 7), ('Benoit Paire', 7),
		('Marin Cilic', 7), ('Tennys Sandgren', 7), ('Denis Istomin', 7), ('Albert Ramos-Vinolas', 7),
		('Mischa Zverev', 7), ('Thai-Son Kwiatkowski', 7), ('Paolo Lorenzi', 7), ('Joao Sousa', 7),
		('Dudi Sela', 7), ('Christopher Eubanks', 7), ('Sam Querrey', 7), ('Gilles Simon', 7),
		('Marton Fucsovics', 7), ('Nicolas Mahut', 7), ('Daniil Medvedev', 7), ('Denis Shapovalov', 7),
		('Nikoloz Basilashvili', 7), ('Jared Donaldson', 7), ('Ruben Bemelmans', 7), ('Lucas Pouille', 7),
		('Thanasi Kokkinakis', 7), ('Janko Tipsarevic', 7), ('Gilles Muller', 7), ('Bernard Tomic', 7),
		('Jack Sock', 7), ('Jordan Thompson', 7), ('Alexander Zverev', 7), ('Darian King', 7),
		('Borna Coric', 7), ('Jiri Vesely', 7), ('Thomas Fabbiano', 7), ('John-Patrick Smith', 7);

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Algeria', 1, 3), ('Cameroon', 1, 35), ('Ghana', 1, 77), ('Côte d''Ivoire', 1, 50),
		('Honduras', 1, 87), ('United States', 1, 203), ('Chile', 1, 41), ('Ecuador', 1, 60),
		('Bosnia and Herzegovina', 1, 26), ('Greece', 1, 79), ('Italy', 1, 96), ('Netherlands', 1, 135),
		('South Africa', 1, 173), ('Slovenia', 1, 170), ('Paraguay', 1, 148), ('New Zealand', 1, 137),
		('Slovakia', 1, 169), ('Korea DPR', 1, 102),
	('Trinidad and Tobago', 1, 193), ('Angola', 1, 6), ('Czech Republic', 1, 55), ('Togo', 1, 191),
	('Ukraine', 1, 199);

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Serbia and Montenegro', 1, 213);

DROP TRIGGER before_insert_team;
