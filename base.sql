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
        idoperation,idnotreoperateur,montantmin,montantmax,frais
    )
VALUES
    (1, 1, 0, 9999999999999, 0),
    (2, 1, 0, 100000, 2000),
    (2, 1, 100001, 300000, 2000),
    (2, 1, 300001, 500000, 2000),
    (2, 1, 500001, 9999999999999, 2000),    
    (3, 1, 0, 100000, 100),
    (3, 1, 100001, 300000, 500),
    (3, 1, 300001, 500000, 1200),
    (3, 1, 500001, 9999999999999, 1000);

INSERT INTO
    Commission (idautreoperateur, pourcentage)
VALUES
    (1, 1.5),
    (2, 2.0);

INSERT INTO
    Admin (login, password)
VALUES
    ('admin', '$2y$10$dcJTfW80JyELwkWSKoWZVuN7jFjUrPW9GEQgCeOc7aYUG.OxtkIti');

INSERT INTO
    Client (nom, prenom, telephone, solde)
VALUES
    ('ANDRIANTSEHENO', 'Kenny', '0321111111', 0),
    ('RABEMANANJARA', 'Jonathan', '0322222222', 0),
    ('RAKOTO', 'Nava', '0323333333', 0),
    ('RASOA', 'Landy', '0324444444', 0),
    ('RABENANAHARY', 'Rojo', '0331111111', 500),
    ('RANDRIAMANGA', 'Faly', '0341111111', 1000);