<?php $title = 'Admin'; $hideNavbar = true; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center align-items-center" style="min-height:100vh;">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-3">
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
                    <button type="submit" class="btn btn-success w-100">Connexion</button>
                </form>
                <div class="text-center mt-3">
                    <a href="/login" class="btn btn-outline-secondary btn-sm">Utilisateur ?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
