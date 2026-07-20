<?php $title = 'Paramétrage des frais'; include __DIR__ . '/../partials/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Paramétrage des frais</h4>
    <a href="<?= site_url('frais/gains') ?>" class="btn btn-outline-primary btn-sm">Gains</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Opération</th>
                    <th>Opérateur</th>
                    <th>Montant Min</th>
                    <th>Montant Max</th>
                    <th>Frais</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($frais as $f): ?>
                <tr>
                    <td><?= esc($f['operation_nom']) ?></td>
                    <td><?= esc($f['operateur_nom']) ?></td>
                    <td><?= number_format($f['montantmin'], 0, ',', ' ') ?></td>
                    <td><?= number_format($f['montantmax'], 0, ',', ' ') ?></td>
                    <td><?= number_format($f['frais'], 0, ',', ' ') ?> Ar</td>
                    <td class="text-end">
                        <a href="<?= site_url('frais/edit/' . $f['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form method="post" action="<?= site_url('frais/delete/' . $f['id']) ?>" style="display:inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">Del</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <form method="post" action="<?= site_url('/frais/add') ?>">
                        <?= csrf_field() ?>
                        <td>
                            <select class="form-select form-select-sm" name="idoperation">
                                <?php foreach ($operations as $op): ?>
                                    <option value="<?= $op['id'] ?>"><?= esc($op['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm" name="idoperateur">
                                <?php foreach ($operateurs as $op): ?>
                                    <option value="<?= $op['id'] ?>"><?= esc($op['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
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
<?php include __DIR__ . '/../partials/footer.php'; ?>
