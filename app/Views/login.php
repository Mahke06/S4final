<?php $title = 'Connexion'; $hideNavbar = true; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center" style="margin-top:80px">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="text-end pt-2 pe-2">
                <a href="/loginOp"><img src="<?= base_url('assets/images/parametres.png') ?>" style="max-height:20px;" alt="Paramètres"></a>
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h4>Connexion</h4>
                </div>
                <form action="/login" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" name="telephone" pattern="[0-9]{10}" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
