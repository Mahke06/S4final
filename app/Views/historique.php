<?php $title = 'Historique'; include __DIR__ . '/partials/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Historique des transactions</h4>
    <a href="/client" class="btn btn-outline-secondary btn-sm">Retour</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Opération</th>
                    <th>Montant</th>
                    <th>Frais</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historique)): ?>
                <tr><td colspan="4" class="text-center text-muted">Aucune transaction pour le moment</td></tr>
                <?php else: ?>
                <?php foreach ($historique as $h): ?>
                <tr>
                    <td><?= esc($h['operation_nom']) ?></td>
                    <td><?= number_format($h['montant'], 0, ',', ' ') ?> Ar</td>
                    <td><?= number_format($h['frais'], 0, ',', ' ') ?> Ar</td>
                    <td><?= esc($h['date']) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
