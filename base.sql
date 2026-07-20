CREATE TABLE
    Operateurs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL
    );

CREATE TABLE
    Prefixes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        idoperateur INTEGER NOT NULL,
        prefixe TEXT NOT NULL,
        FOREIGN KEY (idoperateur) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
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
        idoperateur INTEGER NOT NULL,
        montantmin REAL NOT NULL,
        montantmax REAL NOT NULL,
        frais REAL NOT NULL,
        FOREIGN KEY (idoperation) REFERENCES Operations (id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (idoperateur) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        prenom TEXT NOT NULL,
        telephone TEXT NOT NULL,
        solde REAL NOT NULL
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
    Operateurs (nom)
VALUES
    ('Orange'),
    ('Airtel'),
    ('Yas');

INSERT INTO
    Prefixes (idoperateur, prefixe)
VALUES
    (1, '032'),
    (2, '033'),
    (3, '034');

INSERT INTO
    Operations (nom)
VALUES
    ('Depot'),
    ('Retrait'),
    ('Transfert');

INSERT INTO
    Frais (
        idoperation,
        idoperateur,
        montantmin,
        montantmax,
        frais
    )
VALUES
    (1, 1, 0, 9999999999999, 0),
    (1, 2, 0, 9999999999999, 0),
    (1, 3, 0, 9999999999999, 0),

    (2, 1, 0, 100000, 2000),
    (2, 2, 0, 100000, 2500),
    (2, 3, 0, 100000, 3000),
    (2, 1, 100001, 300000, 2000),
    (2, 2, 100001, 300000, 2500),
    (2, 3, 100001, 300000, 3000),
    (2, 1, 300001, 500000, 2000),
    (2, 2, 300001, 500000, 2500),
    (2, 3, 300001, 500000, 3000),
    (2, 1, 500001, 9999999999999, 2000),
    (2, 2, 500001, 9999999999999, 2500),
    (2, 3, 500001, 9999999999999, 3000),

    
    (3, 1, 0, 100000, 100),
    (3, 2, 0, 100000, 120),
    (3, 3, 0, 100000, 150),
    (3, 1, 100001, 300000, 500),
    (3, 2, 100001, 300000, 500),
    (3, 3, 100001, 300000, 500),
    (3, 1, 300001, 500000, 1200),
    (3, 2, 300001, 500000, 1100),
    (3, 3, 300001, 500000, 1300),
    (3, 1, 500001, 9999999999999, 1000),
    (3, 2, 500001, 9999999999999, 1500),
    (3, 3, 500001, 9999999999999, 1000);

INSERT INTO
    Client (nom, prenom, telephone, solde)
VALUES
    ('ANDRIANTSEHENO', 'Kenny', '0321234567', 0),
    ('RABEMANANJARA', 'Jonathan', '0339876543', 0),
    ('RABENANAHARY', 'Rojo', '0345678901', 0);