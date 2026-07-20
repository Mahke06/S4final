<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
</head>
<body>
    <?php if (session()->get('errors')): ?>
        <div class="errors">
            <?php foreach (session()->get('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <h1>Bienvenue, <?= esc($client['nom']) ?> <?= esc($client['prenom']) ?></h1>
    <p>Solde: <?= esc($client['solde']) ?> Ar</p>
    <a href="/logout">Se déconnecter</a>

    <h2>Opérations</h2>
    <a href="/depot">Effectuer un depot</a>
    <a href="/retrait">Effectuer un retrait</a>
    <a href="/transfert">Effectuer un transfert</a>
    <a href="/historique">Voir l'historique des transactions</a>
</body>
</html>