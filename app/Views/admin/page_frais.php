<?php
$title = 'Paramétrage des frais';
include __DIR__ . '/../partials/header.php';
$operations = [
    1 => 'Dépôt',
    2 => 'Retrait',
    3 => 'Transfert',
];
$opIds = [1 => 'depot', 2 => 'retrait', 3 => 'transfert'];
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Paramétrage des frais</h4>
    <div>
        <a href="<?= site_url('admin') ?>" class="btn btn-outline-secondary btn-sm">Retour</a>
    </div>
</div>

<?php foreach ([1, 2, 3] as $opId): $rows = ${$opIds[$opId]}; ?>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header fw-bold"><?= $operations[$opId] ?></div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Montant Min</th>
                    <th>Montant Max</th>
                    <th>Frais</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $f): ?>
                <tr>
                    <td><?= number_format($f['montantmin'], 0, ',', ' ') ?></td>
                    <td><?= number_format($f['montantmax'], 0, ',', ' ') ?></td>
                    <td><?= number_format($f['frais'], 0, ',', ' ') ?> Ar</td>
                    <td class="text-end">
                        <a href="<?= site_url('admin/frais/edit/' . $f['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form method="post" action="<?= site_url('admin/frais/delete/' . $f['id']) ?>" style="display:inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">Del</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <form method="post" action="<?= site_url('/admin/frais/add') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="idoperation" value="<?= $opId ?>">
                        <td><input type="number" class="form-control form-control-sm" name="montantmin" step="0.01" required></td>
                        <td><input type="number" class="form-control form-control-sm" name="montantmax" step="0.01" required></td>
                        <td><input type="number" class="form-control form-control-sm" name="frais" step="0.01" required></td>
                        <td class="text-end"><button type="submit" class="btn btn-sm btn-success">+</button></td>
                    </form>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php endforeach; ?>
<?php include __DIR__ . '/../partials/footer.php'; ?>
