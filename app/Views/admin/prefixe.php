<?php $title = 'Prefixes'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Prefixe actuel</h4>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-light btn-sm mt-3">Retour</a>
        </div>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="post" action="<?= site_url('/admin/prefixe/update') ?>">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" name="prefixe"
                            value="<?= esc($actuel['prefixe'] ?? '') ?>" required pattern="03[0-9]" maxlength="3">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    <?php if ($actuel): ?><small class="text-muted"><?= esc($actuel['operateur']) ?></small><?php endif; ?>
                </form>
            </div>
        </div>
        <?php if ($anciens): ?>
        <h4>Historique</h4>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr><th>Operateur</th><th>Prefixe</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anciens as $p): ?>
                        <tr>
                            <td><?= esc($p['operateur']) ?></td>
                            <td><?= esc($p['prefixe']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
