<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot</title>
</head>
<body>
    <h1>Effectuer un depot</h1>
    <form action="/depot" method="post">
        <label>Montant:</label>
        <input type="number" name="montant" required>
        <button type="submit">Déposer</button>
    </form>
</body>
</html>