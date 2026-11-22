<?php
session_start();
include '../config.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: ../reg/login.php");
    exit;
}
if ($_SESSION['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
                         VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok', '$supplier_id')");
    header("Location: barang.php");
    exit;
}


if (isset($_POST['update'])) {
    $id          = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    mysqli_query($conn, "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang',
                         harga='$harga', stok='$stok', supplier_id='$supplier_id' WHERE id='$id'");
    header("Location: barang.php");
    exit;
}


if (isset($_GET['hapus'])) {
    $barang_id = $_GET['hapus'];
    $cek_pakai = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id = '$barang_id'");

    if (mysqli_num_rows($cek_pakai) > 0) {
        echo "<script>alert('Data gagal dihapus! Barang ini masih digunakan pada transaksi.'); window.location.href = 'barang.php';</script>";
        exit;
    } else {
        mysqli_query($conn, "DELETE FROM barang WHERE id = '$barang_id'");
        echo "<script>alert('Barang berhasil dihapus.'); window.location.href = 'barang.php';</script>";
        exit;
    }
}

$edit = null;

if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_edit'"));
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container">
        <h1 class="mb-3 fw-bold">Data Barang</h1>
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *, nama FROM barang b, supplier s WHERE b.supplier_id = s.id;";
                $query = mysqli_query($conn, $sql);
                $no = 1;
                while ($barang = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $barang['kode_barang'] . '</td>';
                    echo '<td>' . $barang['nama_barang'] . '</td>';
                    echo '<td>' . $barang['harga'] . '</td>';
                    echo '<td>' . $barang['stok'] . '</td>';
                    echo '<td>' . $barang['nama'] . '</td>';
                    echo '<td>';
                    echo "<a href='barang.php?edit=" . $barang['id'] . "' class='btn btn-warning btn-sm me-1'>Edit</a>";
                    echo "<a href='barang.php?hapus=" . $barang['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus barang ini?')\">Hapus</a>";
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <form method="POST" class="row g-2 mb-4 border p-3 bg-light rounded">
            <?php if ($edit): ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>">
            <?php endif; ?>
            <div class="col-md-2">
                <input type="text" name="kode_barang" class="form-control" placeholder="Kode (B006)" required value="<?= $edit['kode_barang'] ?? ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required value="<?= $edit['nama_barang'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="number" name="harga" class="form-control" placeholder="Harga" required value="<?= $edit['harga'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="number" name="stok" class="form-control" placeholder="Stok" required value="<?= $edit['stok'] ?? ''; ?>">
            </div>
            <div class="col-md-3">
                <select name="supplier_id" class="form-select" required>
                    <option value="">-- Pilih Supplier --</option>
                    <?php
                    $q_sup = mysqli_query($conn, "SELECT * FROM supplier");
                    while ($sup = mysqli_fetch_array($q_sup)) {
                        $sel = ($edit && $edit['supplier_id'] == $sup['id']) ? 'selected' : '';
                        echo "<option value='{$sup['id']}' $sel>{$sup['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 mt-2">
                <?php if ($edit): ?>
                <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                <a href="barang.php" class="btn btn-secondary btn-sm">Batal</a>
                <?php else: ?>
                <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah Barang</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

</html>