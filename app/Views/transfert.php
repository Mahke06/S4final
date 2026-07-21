<?php $title = 'Transfert'; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Effectuer un transfert</h4>
                    <a href="/transfert/multiple" class="btn btn-outline-success btn-sm">Multiple</a>
                </div>

                <form action="/transfert" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Montant</label>
                        <input type="number" class="form-control" name="montant" step="0.01" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Numéro du destinataire</label>
                        <input type="tel" class="form-control" name="telephone_destinataire" pattern="[0-9]{10}" maxlength="10" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="inclure_frais" value="1">
                        <label class="form-check-label">Inclure frais de retrait</label>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Transférer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
