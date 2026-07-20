<?php $title = 'Admin'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row g-4 justify-content-center">
    <div class="col-12 text-center">
        <h4>Panneau d'administration</h4>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('admin/frais') ?>" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/grille.png') ?>" style="max-height:48px;" alt="">
                    <h6 class="mt-2">Grille tarifaire</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('admin/commission') ?>" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/commission.png') ?>" style="max-height:48px;" alt="">
                    <h6 class="mt-2">Commission</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('admin/prefixe') ?>" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/prefixe.png') ?>" style="max-height:48px;" alt="">
                    <h6 class="mt-2">Prefixe</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('admin/gains') ?>" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/gain.png') ?>" style="max-height:48px;" alt="">
                    <h6 class="mt-2">Gains</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('admin/clients') ?>" class="text-decoration-none">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/money-transactions-icon.png') ?>" style="max-height:48px;" alt="">
                    <h6 class="mt-2">Clients</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
