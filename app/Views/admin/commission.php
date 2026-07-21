<?php $title = 'Commission'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Commission</h4>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-light btn-sm mt-3">Retour</a>
        </div>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr><th>Operateur cible</th><th>Pourcentage</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commissions as $c): ?>
                        <tr>
                            <form method="post" action="<?= site_url('admin/commission/update/' . $c['id']) ?>" style="display:contents">
                                <?= csrf_field() ?>
                                <td><?= esc($c['operateur_nom'] ?? $c['idautreoperateur']) ?></td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control form-control-sm" name="pourcentage"
                                            value="<?= esc($c['pourcentage']) ?>" step="0.1" min="0" style="width:80px" required>
                                        <span class="input-group-text">%</span>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">OK</button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
