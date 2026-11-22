<?php
$folder_sekarang = basename(dirname($_SERVER['SCRIPT_NAME']));
$prefix = in_array($folder_sekarang, ['data', 'tran', 'lap']) ? '../' : '';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 no-print">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $prefix ?>index.php">Sistem Penjualan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $prefix ?>index.php">Home</a>
                </li>
                <?php if ($_SESSION['level'] == 1): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Data Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= $prefix ?>data/barang.php">Data Barang</a></li>
                        <li><a class="dropdown-item" href="<?= $prefix ?>data/supplier.php">Data Supplier</a></li>
                        <li><a class="dropdown-item" href="<?= $prefix ?>data/pelanggan.php">Data Pelanggan</a></li>
                        <li><a class="dropdown-item" href="<?= $prefix ?>data/user.php">Data User</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $prefix ?>tran/index.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $prefix ?>lap/index.php">Laporan</a>
                </li>
            </ul>
            <span class="navbar-text text-white me-3">
                <?= htmlspecialchars($_SESSION['nama']); ?> (
                <?= ($_SESSION['level'] == 1) ? 'Owner' : 'Kasir'; ?>)
            </span>
            <a href="<?= $prefix ?>reg/logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">Log out</a>
        </div>
    </div>
</nav>