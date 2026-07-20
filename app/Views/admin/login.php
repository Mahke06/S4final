<?php $title = 'Admin'; $hideNavbar = true; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center" style="margin-top:80px">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h4>Administrateur</h4>
                </div>
                <form action="/loginOp" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Identifiant</label>
                        <input type="text" class="form-control" name="login" value="admin" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" value="admin" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Connexion</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
