<?php $title = 'Modifier un frais'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="mb-4">Modifier un frais</h4>
                <form method="post" action="<?= site_url('admin/frais/update/' . $frais['id']) ?>">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Opération</label>
                        <select class="form-select" name="idoperation">
                            <?php foreach ($operations as $op): ?>
                                <option value="<?= $op['id'] ?>" <?= $op['id'] == $frais['idoperation'] ? 'selected' : '' ?>><?= esc($op['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Montant min</label>
                        <input type="number" class="form-control" name="montantmin" step="0.01" value="<?= esc($frais['montantmin']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Montant max</label>
                        <input type="number" class="form-control" name="montantmax" step="0.01" value="<?= esc($frais['montantmax']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Frais</label>
                        <input type="number" class="form-control" name="frais" step="0.01" value="<?= esc($frais['frais']) ?>" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="<?= site_url('admin/frais') ?>" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
