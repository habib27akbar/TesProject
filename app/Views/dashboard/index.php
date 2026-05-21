<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h1>Dashboard</h1>

<div class="card">
    <div class="card-body">
        Selamat datang di dashboard, <?= session()->get('nama'); ?>!
    </div>
</div>

<?= $this->endSection(); ?>