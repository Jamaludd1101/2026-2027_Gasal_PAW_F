<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: reg/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Penjualan</title>
</head>

<body class="bg-light">
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="p-4 bg-white border rounded">
            <h2>Selamat Datang,
                <?= htmlspecialchars($_SESSION['nama']); ?>!</h2>
            <p class="mb-3">Anda login sebagai <strong>
                    <?= ($_SESSION['level'] == 1) ? 'Owner (Level 1)' : 'Kasir (Level 2)'; ?></strong>.</p>
            <?php if ($_SESSION['level'] == 1): ?>
            <div class="dropdown d-inline-block">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Data Master
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="data/barang.php">Data Barang</a></li>
                    <li><a class="dropdown-item" href="data/supplier.php">Data Supplier</a></li>
                    <li><a class="dropdown-item" href="data/pelanggan.php">Data Pelanggan</a></li>
                    <li><a class="dropdown-item" href="data/user.php">Data User</a></li>
                </ul>
            </div>
            <?php endif; ?>
            <a href="tran/index.php" class="btn btn-primary btn-sm">Transaksi</a>
            <a href="lap/index.php" class="btn btn-success btn-sm">Laporan</a>
        </div>
    </div>
</body>

</html>