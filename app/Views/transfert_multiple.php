<?php $title = 'Transfert multiple'; include __DIR__ . '/partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Envoi multiple</h4>
                    <a href="/transfert" class="btn btn-outline-success btn-sm">Simple</a>
                </div>

                <form action="/transfert/multiple" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Montant total</label>
                        <input type="number" class="form-control" name="montant_total" step="0.01" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Numéros destinataires</label>
                        <div id="numerosContainer">
                            <div class="input-group mb-2">
                                <input type="tel" class="form-control" name="numeros[]" pattern="03[0-9]{8}" maxlength="10" placeholder="032XXXXXXX" required>
                                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">✕</button>
                            </div>
                            <div class="input-group mb-2">
                                <input type="tel" class="form-control" name="numeros[]" pattern="03[0-9]{8}" maxlength="10" placeholder="032XXXXXXX" required>
                                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">✕</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="ajouterNumero()">+ Ajouter</button>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Transférer à tous</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function ajouterNumero() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = '<input type="tel" class="form-control" name="numeros[]" pattern="03[0-9]{8}" maxlength="10" placeholder="032XXXXXXX" required>' +
                   '<button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">✕</button>';
    document.getElementById('numerosContainer').appendChild(div);
}
</script>
<?php include __DIR__ . '/partials/footer.php'; ?>
