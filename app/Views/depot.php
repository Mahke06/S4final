<?php $title = 'Dépôt'; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4>Effectuer un dépôt</h4>
                <form action="/depot" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Montant</label>
                        <input type="number" class="form-control" name="montant" step="0.01" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Déposer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
