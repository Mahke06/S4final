# Voici nos taches ETU004013 ETU003894

```
Theme       : Systeme de simulation d'un operateur de mobile money
Technologie : PHP CodeIgniter 4 + SQLite + Bootstrap 5
```

---

# Version 1 — Tag v1 (livree a 13h)

## Preparation
### 1 - Initialisation CI4 et preparation github (10 minutes) ETU004013

### 2 - Creation des tables dans base.sql (15 min) ETU003894
Tables : Operateurs, Prefixes, Operations, Frais, Client, Historique
Ajout des INSERT pour les donnees initiales (operateurs, prefixes, operations, frais, clients)

## Cote Client — ETU004013

### 1 - Creation Model ClientModel
- `$table = 'Client'`, `$allowedFields = ['nom', 'prenom', 'telephone', 'solde']`
- Methode `getOperateur($telephone)` : trouve l'operateur via le prefixe telephone

### 2 - Creation du ClientController
- `index()` → affiche login si pas connecte, sinon redirige vers /client
- `login()` : validation format telephone → recherche DB → session(`client_id`, `operateur`) → redirect /client
- `accueil()` : verifie session → affiche client.php
- `logout()` : detruit session → redirect /login

### 3 - Ajout dans Routes.php
```
GET  /login              → ClientController::index
POST /login              → ClientController::login
GET  /client             → ClientController::accueil
GET  /logout             → ClientController::logout
GET  /depot              → DepotController::index
POST /depot              → DepotController::faireDepot
GET  /retrait            → RetraitController::index
POST /retrait            → RetraitController::faireRetrait
GET  /transfert          → TransfertController::index
POST /transfert          → TransfertController::faireTransfert
```

### 4 - Creation login.php
- Formulaire telephone avec validation cote serveur
- Bootstrap, CSRF, affichage erreurs
- Lien vers page admin frais

### 5 - Creation client.php (page d'accueil)
- Afficher nom, prenom, solde dans carte degrade
- 4 boutons operations : Depot (vert), Retrait (rouge), Transfert (orange), Historique (bleu)
- Message succes/erreur avec alertes Bootstrap
- Navbar gradient violet

### 6 - DepotController
- `faireDepot()` : valide montant → cherche frais (`idoperation=1`, operateur session) → calcule solde → update DB

### 7 - RetraitController
- `faireRetrait()` : valide montant → cherche frais (`idoperation=2`, operateur session) → verifie solde (montant + frais) → update DB

### 8 - TransfertController
- `faireTransfert()` : valide montant + destinataire → cherche frais (`idoperation=3`, operateur session) → verifie destinataire existe AVANT debit → debite expediteur (montant + frais) → credite destinataire (montant seul)

### 9 - HistoriqueController + vue
- Affiche tableau des transactions avec badge couleur par type
- Etat vide si aucune transaction

## Cote Operateur — ETU003894

### 1 - Configuration des prefixes valables
- CRUD operateurs/prefixes

### 2 - Creation des types d'operations avec baremes de frais
- CRUD frais (idoperation, idoperateur, montantmin, montantmax, frais)
- Tableau admin avec ligne d'ajout directe dans le tfoot

### 3 - Situation gain via les frais (retrait et transfert)
- Page `/frais/gains` qui affiche le total des frais collectes par operation

### 4 - Situation des comptes clients
- Liste des clients avec soldes

---

# Version 2 — Tag v2 (a livrer a 17h10)

## Cote Operateur — ETU003894

### 1 - Configuration des prefixes pour TOUS les operateurs
- Ajouter les prefixes pour les autres operateurs (ex: 031, 035, 036, 037, 038...)
- Table `Prefixes` : chaque operateur peut avoir plusieurs prefixes
- Interface de gestion des prefixes (ajout/modification/suppression)

### 2 - Commission supplementaire pour transferts vers d'autres operateurs
- Nouveau champ ou nouvelle table : `commision_inter_operateur`
- Definir un **pourcentage (%)** de commission en plus pour les transferts vers les autres operateurs
- Exemple : transfert Orange → Airtel = frais normaux + X%

### 3 - Page "Situation des gains" : separer operateur et autres operateurs
- Modifier la page `/frais/gains`
- Afficher deux sections distinctes :
  - **Gains internes** : frais collectes sur les operations du meme operateur
  - **Gains inter-operateurs** : commissions sur les transferts vers d'autres operateurs

### 4 - Situation des montants a envoyer a chaque operateur
- Nouvelle page `/admin/montants-operateurs`
- Calculer et afficher le total des montants a reverser a chaque operateur
- Exemple : si un client Orange fait un transfert vers Airtel, le montant du a Airtel augmente

## Cote Client — ETU004013

### 1 - Option "Inclure frais de retrait lors de l'envoi"
- **Transfert** : ajouter une case a cocher "Inclure les frais"
  - Si coche : le montant total debite = montant + frais (comme actuellement)
  - Si NON coche : seul le montant est debite (les frais sont gratuits)
- **Retrait** : idem option inclure/exclure frais
- **Regle** : il n'y a pas de frais de retrait pour les operateurs autres que le sien
  - Si le client retire via un operateur different → frais = 0

### 2 - Envoi multiple vers plusieurs numeros
- Sur la page transfert, permettre d'ajouter plusieurs destinataires
- Le montant saisi est **divise** equitablement entre chaque numero
- **Contrainte** : meme operateur uniquement (tous les destinataires doivent avoir le meme operateur que l'expediteur)
- Interface :
  - Champ principal : montant total
  - Liste de numeros de telephone (ajout dynamique via JS ou champs multiples)
  - Affichage du montant par destinataire calcule automatiquement

## Modifications base.sql pour V2

```sql
-- Table pour les commissions inter-operateurs (si besoin)
CREATE TABLE CommissionsInterOperateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idoperateur_source INTEGER NOT NULL,
    idoperateur_dest INTEGER NOT NULL,
    pourcentage REAL NOT NULL,
    FOREIGN KEY (idoperateur_source) REFERENCES Operateurs(id),
    FOREIGN KEY (idoperateur_dest) REFERENCES Operateurs(id)
);

-- Ajouter colonne frais_inclus dans Historique (optionnel)
-- ALTER TABLE Historique ADD COLUMN frais_inclus INTEGER DEFAULT 1;
```

## Nouvelles routes pour V2

```php
$routes->get('/frais/gains', 'FraisController::gains');
$routes->get('/admin/montants-operateurs', 'AdminController::montantsOperateurs');

$routes->post('/transfert/multiple', 'TransfertController::faireTransfertMultiple');
```

## Livraison
- Tag **v2** avant 17h10
- Mettre a jour `Taches.md` et `Taches2.md`
- Tout dans la branche `main`
