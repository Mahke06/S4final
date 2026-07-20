<?php $title = 'Transfert'; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4>Effectuer un transfert</h4>
                <form action="/transfert" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Montant</label>
                        <input type="number" class="form-control" name="montant" step="0.01" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Numéro du destinataire</label>
                        <input type="tel" class="form-control" name="telephone_destinataire" pattern="03[2-4][0-9]{7}" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-info w-100 text-white">Transférer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
