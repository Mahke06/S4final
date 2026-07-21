CREATE TABLE
    NotreOperateur (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL
    );

CREATE TABLE
    AutreOperateur (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL
    );

CREATE TABLE
    NosPrefixes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        idnotreoperateur INTEGER NOT NULL,
        prefixe TEXT NOT NULL,
        FOREIGN KEY (idnotreoperateur) REFERENCES NotreOperateur (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    AutrePrefixe (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        idautreoperateur INTEGER NOT NULL,
        prefixe TEXT NOT NULL,
        FOREIGN KEY (idautreoperateur) REFERENCES AutreOperateur (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Operations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL
    );

CREATE TABLE
    Frais (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        idoperation INTEGER NOT NULL,
        idnotreoperateur INTEGER NOT NULL DEFAULT 1,
        montantmin REAL NOT NULL,
        montantmax REAL NOT NULL,
        frais REAL NOT NULL,
        FOREIGN KEY (idoperation) REFERENCES Operations (id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (idnotreoperateur) REFERENCES NotreOperateur (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        prenom TEXT NOT NULL,
        telephone TEXT NOT NULL,
        solde REAL NOT NULL
    );

CREATE TABlE
    Admin (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        login TEXT NOT NULL,
        password TEXT NOT NULL
    );

CREATE TABLE
    Commission (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        idautreoperateur INTEGER NOT NULL,
        pourcentage REAL NOT NULL,
        FOREIGN KEY (idautreoperateur) REFERENCES AutreOperateur (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Historique (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        opdate TIMESTAMP,
        idclient INTEGER NOT NULL,
        idoperation INTEGER NOT NULL,
        montant REAL NOT NULL,
        frais REAL NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (idclient) REFERENCES Client (id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (idoperation) REFERENCES Operations (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE 
    Promotion (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        promotion REAL
    );

------------------ INSERTS ------------------



INSERT INTO
    NotreOperateur (nom)
VALUES
    ('Orange');

INSERT INTO
    AutreOperateur (nom)
VALUES
    ('Airtel'),
    ('Yas');

INSERT INTO
    NosPrefixes (idnotreoperateur, prefixe)
VALUES
    (1, '032');

INSERT INTO
    AutrePrefixe (idautreoperateur, prefixe)
VALUES
    (1, '033'),
    (2, '034');

INSERT INTO
    Operations (nom)
VALUES
    ('Depot'),
    ('Retrait'),
    ('Transfert'),
    ('Commission');

INSERT INTO
    Frais (
        idoperation,
        idnotreoperateur,
        montantmin,
        montantmax,
        frais
    )
VALUES
    (1, 1, 0, 999999999, 0),

    (2, 1, 0, 5000, 100),
    (2, 1, 5001, 10000, 200),
    (2, 1, 10001, 20000, 300),
    (2, 1, 20001, 50000, 500),
    (2, 1, 50001, 100000, 800),
    (2, 1, 100001, 200000, 1200),
    (2, 1, 200001, 500000, 1800),
    (2, 1, 500001, 1000000, 2500),
    (2, 1, 1000001, 999999999, 3500),

    (3, 1, 0, 5000, 50),
    (3, 1, 5001, 10000, 100),
    (3, 1, 10001, 20000, 150),
    (3, 1, 20001, 50000, 250),
    (3, 1, 50001, 100000, 400),
    (3, 1, 100001, 200000, 700),
    (3, 1, 200001, 500000, 1200),
    (3, 1, 500001, 1000000, 1800),
    (3, 1, 1000001, 999999999, 2500);

INSERT INTO
    Commission (idautreoperateur, pourcentage)
VALUES
    (1, 1.5),
    (2, 2.0);

INSERT INTO
    Admin (login, password)
VALUES
    (
        'admin',
        '$2y$10$dcJTfW80JyELwkWSKoWZVuN7jFjUrPW9GEQgCeOc7aYUG.OxtkIti'
    );

INSERT INTO
    Client (nom, prenom, telephone, solde)
VALUES
    ('Andriams', 'Fifa', '0322514789', 250),
    ('THIERRY', 'Arsenoh', '0324178632', 500),
    ('ANDRIANTSEHENO', 'Kenny', '0326385214', 0),
    ('FAVRE', 'Vinod', '0327412598', 750),
    ('RAKOTOARISON', 'Harena', '0325821947', 1200),
    ('MANANTSOA', 'Joh', '0323267845', 300),
    ('PINTO', 'Lova', '0328642519', 0),
    ('BESTFRIEND', 'iAina', '0321937486', 150),
    ('RASOLOFO', 'Tahina', '0324571823', 950),
    ('RANDRIANASOLO', 'Hasina', '0327159364', 100),
    ('RAZAFINDRAKOTO', 'Ony', '0322486795', 400),
    ('RABESON', 'Nantenaina', '0329813572', 650),
    ('RAKOTONDRAVAO', 'Lova', '0325348716', 50),
    ('RANDRIAMIHARISOA', 'Toky', '0326729458', 1800),
    ('RAFANOMEZANTSOA', 'Mirana', '0328164735', 0),
    ('RAZAFIMAHATRATRA', 'Fenosoa', '0323591842', 220),
    ('RATSIMBAZAFY', 'Aina', '0329246178', 1300),
    ('RABENANDRASANA', 'Ando', '0324867315', 700),
    ('RAKOTOARISON', 'Sitraka', '0341578946', 900),
    ('RANDRIANANTOANDRO', 'Kanto', '0337635219', 1100);


INSERT INTO 
    Promotion (promotion)
VALUES
    (10);