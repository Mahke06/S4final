<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gains</title>
</head>
<body>
    <h1>Gains</h1>

    <table>
        <thead>
            <tr>
                <th>Operation</th>
                <th>Total gains</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gains as $g): ?>
            <tr>
                <td><?= esc($g['nom']) ?></td>
                <td><?= number_format($g['total'], 2) ?> Ar</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Total global</th>
                <th><?= number_format($totalGlobal, 2) ?> Ar</th>
            </tr>
        </tfoot>
    </table>

    <a href="<?= site_url('frais') ?>">Retour</a>
</body>
</html>
