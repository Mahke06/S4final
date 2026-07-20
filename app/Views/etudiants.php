<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des Etudiants</h1>
    <ul>
    <?php
        foreach($etudiant as $e){ ?>
            <li><h1><?php echo $e ?></h1></li>
    <?php } ?>
    </ul>      
</body>
</html>
