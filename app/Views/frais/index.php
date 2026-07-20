<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de parametrage frais</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID Operation</th>
                <th>ID Operateur</th>
                <th>Montant Min</th>
                <th>Montant Max</th>
                <th>Frais</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($frais as $fraisItem): ?>
            <tr>
                <td><?php echo $fraisItem->idoperation ?></td>
                <td><?php echo $fraisItem->idoperateur ?></td>
                <td><?php echo $fraisItem->montantmin ?></td>
                <td><?php echo $fraisItem->montantmax ?></td>
                <td><?php echo $fraisItem->frais ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>