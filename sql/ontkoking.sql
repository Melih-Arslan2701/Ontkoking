SET NAMES utf8mb4;

DROP TABLE IF EXISTS ingredienten;
DROP TABLE IF EXISTS recepten;
DROP TABLE IF EXISTS categorieen;
DROP TABLE IF EXISTS gebruikers;

CREATE TABLE gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    wachtwoord VARCHAR(255) NOT NULL,
    rol ENUM('gebruiker', 'admin') NOT NULL DEFAULT 'gebruiker',
    aangemaakt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categorieen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE recepten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruiker_id INT NOT NULL,
    categorie_id INT NOT NULL,
    titel VARCHAR(150) NOT NULL,
    beschrijving TEXT,
    bereidingswijze TEXT NOT NULL,
    bereidingstijd INT NOT NULL,
    afbeelding VARCHAR(255) DEFAULT NULL,
    aangemaakt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gebruiker_id) REFERENCES gebruikers(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES categorieen(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE ingredienten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recept_id INT NOT NULL,
    naam VARCHAR(100) NOT NULL,
    hoeveelheid VARCHAR(50) DEFAULT NULL,
    FOREIGN KEY (recept_id) REFERENCES recepten(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categorieen (naam) VALUES
('Ontbijt'),
('Lunch'),
('Diner'),
('Voorgerecht'),
('Hoofdgerecht'),
('Nagerecht');

INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord, rol) VALUES
('admin', 'admin@ontkoking.nl', '$2y$10$X4nDfYfo7GdsQ0/vcTbkvedz3tOW2c/spTB4SgB2a4HT7bDKOBRzG', 'admin');

INSERT INTO recepten (gebruiker_id, categorie_id, titel, beschrijving, bereidingswijze, bereidingstijd) VALUES
(1, 1, 'Overnight oats met banaan', 'Gewoon de avond ervoor in een potje gooien en klaar.', 'Doe de havermout, melk en yoghurt in een pot en roer door elkaar.\nZet de pot een nacht in de koelkast.\nSnijd de banaan in plakjes en leg die er in de ochtend bovenop.', 5),
(1, 2, 'Tosti met kaas en ham', 'De klassieker, in 10 minuten klaar.', 'Beleg twee boterhammen met kaas en ham.\nSmeer de buitenkant in met een beetje boter.\nBak de tosti in een koekenpan 3 minuten per kant tot hij goudbruin is.', 10),
(1, 3, 'Pasta pesto met kip', 'Snel en lekker voor na school.', 'Kook de pasta volgens de verpakking.\nBak de kip in stukjes gaar in een koekenpan.\nMeng de pasta met de pesto en de kip.', 20),
(1, 4, 'Tomatensoep uit de oven', 'Simpele soep zonder gedoe.', 'Snij de tomaten en ui in stukken en leg ze op een bakplaat met olie.\nBak 25 minuten op 200 graden.\nDoe alles in een pan met bouillon en pureer met een staafmixer.', 40),
(1, 5, 'Wraps met gehakt', 'Perfect voor als je met vrienden eet.', 'Bak het gehakt rul met de kruiden.\nSnijd de paprika en sla in reepjes.\nVul de wraps met gehakt en groente en vouw ze dicht.', 25),
(1, 6, 'Chocolade mugcake', 'Dessert in de magnetron in 2 minuten.', 'Meng alle ingredienten in een grote mok.\nZet de mok 90 seconden in de magnetron.\nLaat even afkoelen voor je hem opeet.', 5);

INSERT INTO ingredienten (recept_id, naam, hoeveelheid) VALUES
(1, 'havermout', '50 g'),
(1, 'melk', '100 ml'),
(1, 'yoghurt', '50 g'),
(1, 'banaan', '1'),
(2, 'boterhammen', '2'),
(2, 'kaas', '2 plakken'),
(2, 'ham', '2 plakken'),
(2, 'boter', '1 tl'),
(3, 'pasta', '150 g'),
(3, 'kipfilet', '1'),
(3, 'pesto', '2 el'),
(4, 'tomaten', '800 g'),
(4, 'ui', '1'),
(4, 'olijfolie', '2 el'),
(4, 'bouillon', '500 ml'),
(5, 'gehakt', '250 g'),
(5, 'wraps', '4'),
(5, 'paprika', '1'),
(5, 'sla', '1 handje'),
(6, 'bloem', '4 el'),
(6, 'cacaopoeder', '2 el'),
(6, 'suiker', '2 el'),
(6, 'melk', '3 el'),
(6, 'ei', '1');
