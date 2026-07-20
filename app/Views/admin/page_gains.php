<?php $title = 'Gains'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Situation gain via les différents frais</h4>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-secondary btn-sm">Retour</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header fw-bold">Gain sur notre operateur</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark">
                                <tr><th>Opération</th><th class="text-end">Total</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($nos as $g): ?>
                                <tr>
                                    <td><?= esc($g['operation']) ?></td>
                                    <td class="text-end"><?= number_format($g['total'], 0, ',', ' ') ?> Ar</td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($nos)): ?>
                                <tr><td colspan="2" class="text-center text-muted">Aucun gain</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header fw-bold">Gain sur autre operateur</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark">
                                <tr><th>Opération</th><th class="text-end">Total</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($autres as $g): ?>
                                <tr>
                                    <td><?= esc($g['operation']) ?></td>
                                    <td class="text-end"><?= number_format($g['total'], 0, ',', ' ') ?> Ar</td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($autres)): ?>
                                <tr><td colspan="2" class="text-center text-muted">Aucun gain</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body text-end">
                <h5 class="mb-0">Total global : <?= number_format($totalGlobal, 0, ',', ' ') ?> Ar</h5>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
