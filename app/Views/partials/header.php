<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'OMG') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body class="bg-light">
<?php if (!isset($hideNavbar) || !$hideNavbar): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">OMG</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('client_id')): ?>
                    <li class="nav-item"><a class="nav-link" href="/client">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/depot">Dépôt</a></li>
                    <li class="nav-item"><a class="nav-link" href="/retrait">Retrait</a></li>
                    <li class="nav-item"><a class="nav-link" href="/transfert">Transfert</a></li>
                    <li class="nav-item"><a class="nav-link" href="/historique">Historique</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/frais">Paramètres</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
<div class="container">
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= esc(session()->getFlashdata('success')) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= esc(session()->getFlashdata('error')) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
