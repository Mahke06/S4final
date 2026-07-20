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
        solde REAL NOT NULL,
        idoperateur INTEGER NOT NULL,
        FOREIGN KEY (idoperateur) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Historique (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        opdate TIMESTAMP,
        idclient INTEGER NOT NULL,
        idoperation INTEGER NOT NULL,
        montant REAL NOT NULL,
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
    Frais (idoperation, idoperateur, montantmin, montantmax, frais)
VALUES
    (1, 1, 0, 10000, 500),
    (1, 1, 10001, 50000, 1000),
    (2, 2, 0, 10000, 500),
    (2, 2, 10001, 50000, 1000),
    (3, 3, 0, 10000, 500),
    (3, 3, 10001, 50000, 1000);

INSERT INTO
    Client (nom, prenom, telephone, solde, idoperateur)
VALUES
    ('ANDRIANTSEHENO', 'Kenny', '0321234567', 0, 1),
    ('RABEMANANJARA', 'Jonathan', '0339876543', 0, 2),
    ('RABENANAHARY', 'Rojo', '0345678901', 0, 3);