<?php $title = 'Gains'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Gains</h4>
            <a href="<?= site_url('frais') ?>" class="btn btn-outline-secondary btn-sm">Retour</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Opération</th>
                            <th class="text-end">Total gains</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gains as $g): ?>
                        <tr>
                            <td><?= esc($g['nom']) ?></td>
                            <td class="text-end"><?= number_format($g['total'], 0, ',', ' ') ?> Ar</td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($gains)): ?>
                        <tr><td colspan="2" class="text-center text-muted">Aucun gain pour le moment</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <th>Total global</th>
                            <th class="text-end"><?= number_format($totalGlobal, 0, ',', ' ') ?> Ar</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
