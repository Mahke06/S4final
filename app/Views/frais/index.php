<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de parametrage frais</title>
</head>
<body>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color:red">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <li><?= esc($e) ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>Operation</th>
                <th>Operateur</th>
                <th>Montant Min</th>
                <th>Montant Max</th>
                <th>Frais</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($frais as $fraisItem): ?>
            <tr>
                <td><?php echo $fraisItem['operation_nom'] ?></td>
                <td><?php echo $fraisItem['operateur_nom'] ?></td>
                <td><?php echo $fraisItem['montantmin'] ?></td>
                <td><?php echo $fraisItem['montantmax'] ?></td>
                <td><?php echo $fraisItem['frais'] ?></td>
                <td>
                    <a href="<?php echo site_url('frais/edit/' . $fraisItem['id']); ?>">Edit</a>
                    <form method="post" action="<?php echo site_url('frais/delete/' . $fraisItem['id']); ?>" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" onclick="return confirm('Supprimer ?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <tfoot>
        <tr>
            <form method="post" action="<?php echo site_url('/frais/add') ?>">
                <?php echo csrf_field(); ?>
                <td>
                    <select name="idoperation">
                        <?php foreach ($operations as $op): ?>
                            <option value="<?php echo $op['id'] ?>"><?php echo $op['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="idoperateur">
                        <?php foreach ($operateurs as $op): ?>
                            <option value="<?php echo $op['id'] ?>"><?php echo $op['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" step="0.01" name="montantmin" required></td>
                <td><input type="number" step="0.01" name="montantmax" required></td>
                <td><input type="number" step="0.01" name="frais" required></td>
                <td><button type="submit">Ajouter</button></td>
            </form>
        </tr>
    </tfoot>

    <a href="<?= site_url('frais/gains') ?>">Voir les gains</a>

</body>
</html>
