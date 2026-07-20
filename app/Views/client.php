<?php $title = 'Accueil'; include __DIR__ . '/partials/header.php'; ?>
<div class="row g-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-1">Bienvenue, <?= esc($client['nom']) ?> <?= esc($client['prenom']) ?></h5>
                <p class="text-muted mb-0"><strong>Solde :</strong> <?= number_format($client['solde'], 0, ',', ' ') ?> Ar</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <a href="/depot" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/plus.jpeg') ?>" alt="Depot" class="img-fluid" style="max-height:48px">
                    <h6 class="mt-2">Depot</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="/retrait" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/moins.jpeg') ?>" alt="Retrait" class="img-fluid" style="max-height:48px">
                    <h6 class="mt-2">Retrait</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="/transfert" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/money-transactions-icon.png') ?>" alt="Transfert" class="img-fluid" style="max-height:48px">
                    <h6 class="mt-2">Transfert</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="/historique" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/histo.jpeg') ?>" alt="Historique" class="img-fluid" style="max-height:48px">
                    <h6 class="mt-2">Historique</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
