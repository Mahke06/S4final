<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
</head>
<body>
    <h1>Historique des transactions</h1>

    <?php if (empty($historique)): ?>
        <p>Aucune transaction pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Operation</th>
                    <th>Montant</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historique as $h): ?>
                <tr>
                    <td><?= esc($h['operation_nom']) ?></td>
                    <td><?= esc($h['montant']) ?> Ar</td>
                    <td><?= esc($h['date']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="<?= site_url('client') ?>">Retour</a>
</body>
</html>
