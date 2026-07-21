<?php $title = 'Retrait'; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm mb-2">
            <div class="card-body p-3">
                <h5 class="mb-0">Effectuer un retrait</h5>
                <small class="text-muted">Solde actuel : <?= number_format($solde, 0, ',', ' ') ?> Ar</small>
                <form action="/retrait" method="post" class="mt-2">
                    <?= csrf_field() ?>
                    <div class="mb-2">
                        <input type="number" class="form-control" name="montant" step="0.01" min="1" placeholder="Montant" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Retirer</button>
                </form>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-2">
                <small class="fw-bold">Grille des frais</small>
                <table class="table table-sm table-borderless mb-0 mt-1">
                    <thead>
                        <tr><th class="small">Min</th><th class="small">Max</th><th class="small text-end">Frais</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($frais as $f): ?>
                        <tr>
                            <td class="small"><?= number_format($f['montantmin'], 0, ',', ' ') ?></td>
                            <td class="small"><?= number_format($f['montantmax'], 0, ',', ' ') ?></td>
                            <td class="small text-end"><?= number_format($f['frais'], 0, ',', ' ') ?> Ar</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
