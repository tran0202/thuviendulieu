CREATE TABLE IF NOT EXISTS player (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	nation_id INT,
	FOREIGN KEY (nation_id) REFERENCES nation(id)
);

INSERT INTO player (first_name, last_name, nation_id)
VALUES ('Yuichi', 'Sugita', 98), ('Geoffrey', 'Blancaneaux', 71), ('Dominic', 'Thiem', 13),	('Alex', 'De Minaur', 12),
	('Bjorn', 'Fratangelo', 203), ('Ivo', 'Karlovic', 51), ('Richard', 'Gasquet', 71), ('Leonardo', 'Mayer', 9),
	('Adrian', 'Menendez-Maceiras', 175), ('Patrick', 'Kypson', 203),	('Donald', 'Young', 203), ('Maximilian', 'Marterer', 76),
	('Jeremy', 'Chardy', 71), ('Gael', 'Monfils',71), ('Taro', 'Daniel', 203), ('Tommy', 'Paul', 203),
	('Alexandr', 'Dolgopolov', 199), ('Jan-Lennard', 'Struff', 76), ('Tomas', 'Berdych', 55), ('Ryan', 'Harrison', 203),
	('Blaz', 'Kavcic', 170), ('Mikhail', 'Youzhny', 157), ('Ricardas', 'Berankis', 114), ('Adrian', 'Mannarino', 71),
	('Pablo', 'Cuevas', 9), ('Damir', 'Dzumhur', 26), ('Marcos', 'Baghdatis', 54), ('Taylor', 'Fritz', 203),
	('Norbert', 'Gombos', 169), ('Viktor', 'Troicki', 165), ('Henri', 'Laaksonen', 70), ('Juan Martin', 'Del Potro', 9),
	('Fabio', 'Fognini', 96), ('Stefano', 'Travaglia', 96), ('Cedrik-Marcel', 'Stebe', 76), ('Nicolas', 'Kicker', 9),
	('Julien', 'Benneteau', 71), ('David', 'Goffin', 20), ('Nick', 'Kyrgios', 12), ('John', 'Millman', 12),
	('Malek', 'Jaziri', 194), ('Thiago', 'Monteiro', 28), ('Steve', 'Darcis', 20), ('Guido', 'Pella', 9),
	('Aljaz', 'Bedene', 170), ('Andrey', 'Rublev', 157), ('Grigor', 'Dimitrov', 31), ('Vaclav', 'Safranek', 55),
	('Dusan', 'Lajovic', 165), ('Rafael', 'Nadal', 175), ('Andrey', 'Kuznetsov', 157), ('Feliciano', 'Lopez', 175),
	('Vasek', 'Pospisil', 36), ('Fernando', 'Verdasco', 175), ('Santiago', 'Giraldo', 44), ('Vincent', 'Millot', 71),
	('Philipp', 'Kohlschreiber', 76), ('Tim', 'Smyczek', 203), ('Thomaz', 'Bellucci', 28), ('Dustin', 'Brown', 76),
	('Roberto', 'Bautista Agut', 175), ('Andreas', 'Seppi', 96), ('Roger', 'Federer', 184), ('Frances', 'Tiafoe', 203),
	('Hyeon', 'Chung', 103), ('Horacio', 'Zeballos', 9), ('Kyle', 'Edmund', 173), ('Robin', 'Haase', 135),
	('Nicolas', 'Almagro', 175), ('Steve', 'Johnson', 203), ('Pablo', 'Carreno Busta', 175), ('Evan', 'King', 203),
	('Rogerio', 'Dutra Silva', 28), ('Florian', 'Mayer', 76), ('Dmitry', 'Tursunov', 157), ('Cameron', 'Norrie', 173),
	('Kevin', 'Anderson', 173), ('JC', 'Aragone', 203), ('Carlos', 'Berlocq', 9), ('Diego', 'Schwartzman', 9),
	('Marius', 'Copil', 156), ('Jo-Wilfried', 'Tsonga', 71), ('Evgeny', 'Donskoy', 157), ('Andreas', 'Haider-Maurer', 13),
	('Radu', 'Albot', 126), ('Ernesto', 'Escobedo', 203), ('Alessandro', 'Giannessi', 96), ('Ernests', 'Gulbis', 108),
	('Pierre-Hugues', 'Herbert', 71), ('John', 'Isner', 203), ('David', 'Ferrer', 175), ('Mikhail', 'Kukushkin', 100),
	('Karen', 'Khachanov', 157), ('Yen-Hsun', 'Lu', 43), ('Lukas', 'Lacko', 169), ('Benoit', 'Paire', 71),
	('Marin', 'Cilic', 51), ('Tennys', 'Sandgren', 203), ('Denis', 'Istomin', 204), ('Albert', 'Ramos-Vinolas', 175),
	('Mischa', 'Zverev', 76), ('Thai-Son', 'Kwiatkowski', 203), ('Paolo', 'Lorenzi', 96), ('Joao', 'Sousa', 152),
	('Dudi', 'Sela', 95), ('Christopher', 'Eubanks', 203), ('Sam', 'Querrey', 203), ('Gilles', 'Simon', 71),
	('Marton', 'Fucsovics', 89), ('Nicolas', 'Mahut', 71), ('Daniil', 'Medvedev', 157), ('Denis', 'Shapovalov', 95),
	('Nikoloz', 'Basilashvili', 75), ('Jared', 'Donaldson', 203), ('Ruben', 'Bemelmans', 20), ('Lucas', 'Pouille', 71),
	('Thanasi', 'Kokkinakis', 12), ('Janko', 'Tipsarevic', 165), ('Gilles', 'Muller', 115), ('Bernard', 'Tomic', 76),
	('Jack', 'Sock', 203), ('Jordan', 'Thompson', 12), ('Alexander', 'Zverev', 76), ('Darian', 'King', 18),
	('Borna', 'Coric', 51), ('Jiri', 'Vesely', 55), ('Thomas', 'Fabbiano', 96), ('John-Patrick', 'Smith', 12);

INSERT INTO player (first_name, last_name, nation_id)
VALUES ('Qualifier', 'Player', null), ('Guido', 'Andreozzi', 9), ('Mirza', 'Basic', 26), ('Jason', 'Kubler', 12),
	   ('Denis', 'Kudla', 203), ('Matteo', 'Berrettini', 96), ('Andy', 'Murray', 212), ('James', 'Duckworth', 12),
	   ('Roberto', 'Carballes Baena', 175), ('Stefanos', 'Tsitsipas', 79), ('Bradley', 'Klahn', 203), ('Nicolas', 'Jarry', 41),
	   ('Peter', 'Gojowczyk', 76), ('Milos', 'Raonic', 36), ('Stan', 'Wawrinka', 184), ('Marco', 'Cecchinato', 96),
	   ('Mackenzie', 'McDonald', 203), ('Federico', 'Delbonis', 9), ('Guillermo', 'Garcia-Lopez', 175), ('Jaume', 'Munar', 175),
	   ('Kei', 'Nishikori', 98), ('Filip', 'Krajinovic', 165), ('Matthew', 'Ebden', 12), ('Yannick', 'Hanfmann', 76),
	   ('Corentin', 'Moutet', 71), ('Novak', 'Djokovic', 165), ('Laslo', 'Djere', 165), ('Michael', 'Mmoh', 203),
	   ('Jenson', 'Brooksby', 203), ('Noah', 'Rubin', 203), ('Yuki', 'Bhambri', 91), ('Yoshihito', 'Nishioka', 98);
