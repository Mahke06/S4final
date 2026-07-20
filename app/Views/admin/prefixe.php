<?php $title = 'Prefixes'; include __DIR__ . '/../partials/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-12">
        <?php
        $db      = \Config\Database::connect();
        $tous    = $db->table('NosPrefixes')
            ->select('NosPrefixes.*, NotreOperateur.nom AS operateur')
            ->join('NotreOperateur', 'NotreOperateur.id = NosPrefixes.idnotreoperateur')
            ->orderBy('NosPrefixes.id', 'DESC')
            ->get()->getResultArray();
        $actuel  = $tous[0] ?? null;
        $anciens = array_slice($tous, 1);
        ?>
        <h4>Prefixe actuel</h4>
        <div class="card shadow-sm border-0 mb-4">
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
        <div class="card shadow-sm border-0">
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
        <a href="<?= site_url('admin') ?>" class="btn btn-outline-secondary btn-sm mt-3">Retour</a>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
