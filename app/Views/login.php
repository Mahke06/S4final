<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
     <?php if (session()->getFlashdata('errors')): ?>
        <div class="errors">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <h1>Connectez vous</h1>
    <form action="/login" method="post">
        <?= csrf_field() ?>
        <label>Telephone:</label>
        <input type="tel" name="telephone" pattern="03[2-4][0-9]{7}" maxlength="10" required>   
        <button type="submit">Se connecter</button>
    </form>


    <button>
        <a href="/frais">Page de parametrage des operateurs</a>
    </button>
</body>
</html>