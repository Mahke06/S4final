<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert</title>
</head>
<body>
    <?php if (session()->get('errors')): ?>
        <div class="errors">
            <?php foreach (session()->get('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <h1>Effectuer un transfert</h1>
    <form action="/transfert" method="post">
        <label>Montant:</label>
        <input type="number" name="montant" required>
        <label>Numéro de téléphone du destinataire:</label>
        <input type="tel" name="telephone_destinataire" pattern="03[2-4][0-9]{7}" maxlength="10" required>
        <button type="submit">Transférer</button>
    </form>
</body>
</html>