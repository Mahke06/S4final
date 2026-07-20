<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier frais</title>
</head>
<body>
    <h1>Modifier un frais</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <li><?= esc($e) ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="<?= site_url('frais/update/' . $frais['id']) ?>">
        <?= csrf_field() ?>
        <label>Opération :
            <select name="idoperation">
                <?php foreach ($operations as $op): ?>
                    <option value="<?= esc($op['id']) ?>" <?= $op['id'] == $frais['idoperation'] ? 'selected' : '' ?>>
                        <?= esc($op['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Opérateur :
            <select name="idoperateur">
                <?php foreach ($operateurs as $op): ?>
                    <option value="<?= esc($op['id']) ?>" <?= $op['id'] == $frais['idoperateur'] ? 'selected' : '' ?>>
                        <?= esc($op['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Montant min : <input type="number" step="0.01" name="montantmin" value="<?= esc($frais['montantmin']) ?>" required></label>
        <label>Montant max : <input type="number" step="0.01" name="montantmax" value="<?= esc($frais['montantmax']) ?>" required></label>
        <label>Frais : <input type="number" step="0.01" name="frais" value="<?= esc($frais['frais']) ?>" required></label>
        <button type="submit">Modifier</button>
        <a href="<?= site_url('frais') ?>">Annuler</a>
    </form>
</body>
</html>
