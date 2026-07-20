CREATE TABLE
    Operateurs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL
    );

CREATE TABLE
    Prefixes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        operateur_id INTEGER NOT NULL,
        prefixe TEXT NOT NULL,
        FOREIGN KEY (operateur_id) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Operations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        operateur_id INTEGER NOT NULL,
        nom TEXT NOT NULL,
        FOREIGN KEY (operateur_id) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Frais (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        operation_id INTEGER NOT NULL,
        montantmin REAL NOT NULL,
        montantmax REAL NOT NULL,
        frais REAL NOT NULL,
        FOREIGN KEY (operation_id) REFERENCES Operations (id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    Client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        prenom TEXT NOT NULL,
        telephone TEXT NOT NULL,
        solde REAL NOT NULL,
        operateur_id INTEGER NOT NULL,
        FOREIGN KEY (operateur_id) REFERENCES Operateurs (id) ON DELETE CASCADE ON UPDATE CASCADE
    );  