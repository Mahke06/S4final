<?php $title = 'Connexion'; $hideNavbar = true; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center" style="margin-top:80px">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h4>Connexion</h4>
                </div>
                <form action="/login" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" name="telephone" pattern="03[2-4][0-9]{7}" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
                <div class="text-center mt-3">
                    <a href="/frais" class="text-decoration-none small">Paramétrage des frais</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
