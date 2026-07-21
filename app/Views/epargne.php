<?php $title = 'Promo'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">AJOUTER UNE EPARGNE</h4>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-light btn-sm mt-3">Retour</a>
        </div>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="post" action="<?= site_url('/transfert/epargne') ?>">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" name="prefixe"
                            value="<?= esc($actuel['epargne'] ?? '') ?>"  maxlength="2">
                        <button type="submit" class="btn btn-primary">Ajouter epargne</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
