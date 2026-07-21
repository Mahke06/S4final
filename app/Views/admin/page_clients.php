<?php $title = 'Clients'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Situation des comptes clients</h4>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-light btn-sm">Retour</a>
        </div>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr><th>Nom</th><th>Prenom</th><th>Numero</th><th class="text-end">Solde</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $c): ?>
                        <tr>
                            <td><?= esc($c['nom']) ?></td>
                            <td><?= esc($c['prenom']) ?></td>
                            <td><?= esc($c['telephone']) ?></td>
                            <td class="text-end"><?= number_format($c['solde'], 0, ',', ' ') ?> Ar</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
