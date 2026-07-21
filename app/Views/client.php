<?php $title = 'Accueil'; include __DIR__ . '/partials/header.php'; ?>
<div class="row g-2">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="mb-1"><?= esc($client['nom']) ?> <?= esc($client['prenom']) ?></h5>
                <div class="display-6 fw-bold text-dark my-2"><?= number_format($client['solde'], 0, ',', ' ') ?> <small class="fs-6">Ar</small></div>
                <p class="text-muted small mb-0"><?= esc($client['telephone']) ?></p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <a href="/depot" class="text-decoration-none">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body py-3">
                    <img src="<?= base_url('assets/images/plus.jpeg') ?>" alt="" class="img-fluid" style="max-height:40px">
                    <div class="small mt-1">Depot</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="/retrait" class="text-decoration-none">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body py-3">
                    <img src="<?= base_url('assets/images/moins.jpeg') ?>" alt="" class="img-fluid" style="max-height:40px">
                    <div class="small mt-1">Retrait</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="/transfert" class="text-decoration-none">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body py-3">
                    <img src="<?= base_url('assets/images/money-transactions-icon.png') ?>" alt="" class="img-fluid" style="max-height:40px">
                    <div class="small mt-1">Transfert</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="/historique" class="text-decoration-none">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body py-3">
                    <img src="<?= base_url('assets/images/histo.jpeg') ?>" alt="" class="img-fluid" style="max-height:40px">
                    <div class="small mt-1">Histo.</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Dernières transactions</h6>
            <a href="/historique" class="btn btn-outline-light btn-sm">Voir tout</a>
        </div>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <?php if (empty($recent)): ?>
                        <tr><td class="text-center text-muted small py-2">Aucune transaction</td></tr>
                        <?php else: ?>
                        <?php foreach ($recent as $h): ?>
                        <tr>
                            <td class="small"><?= esc($h['operation_nom']) ?></td>
                            <td class="small text-end"><?= number_format($h['montant'], 0, ',', ' ') ?> Ar</td>
                            <td class="small text-end text-muted"><?= esc(substr($h['date'], 0, 10)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
