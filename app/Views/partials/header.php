<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'OMG') ?></title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>

<div class="position-fixed top-0 end-0 p-3" style="z-index:9999;">
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-0 py-2" role="alert">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-0 py-2" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-0 py-2" role="alert">
        <ul class="mb-0 small"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
</div>

<?php if (!isset($hideNavbar) || !$hideNavbar): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">OMG</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('client_id')): ?>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/client">Accueil</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/depot">Dépôt</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/retrait">Retrait</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/transfert">Transfert</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/historique">Historique</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/logout">Déconnexion</a></li>
                <?php elseif (session()->get('admin_id')): ?>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm mx-2 my-1" href="/admin-logout">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
<div class="container">
