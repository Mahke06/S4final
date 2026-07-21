<?php $title = 'Connexion'; $hideNavbar = true; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center align-items-center" style="min-height:100vh;">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-3">
                <div class="text-center mb-4">
                    <h4>Connexion</h4>
                </div>
                <form action="/login" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" name="telephone" pattern="[0-9]{10}" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Se connecter</button>
                </form>
                <div class="text-center mt-3">
                    <a href="/loginOp" class="btn btn-outline-secondary btn-sm">Administrateur ?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
