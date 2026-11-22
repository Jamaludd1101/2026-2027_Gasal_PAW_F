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
if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];
    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    header("Location: supplier.php");
    exit;
}

if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];
    mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
    header("Location: supplier.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");
    header("Location: supplier.php");
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id_edit'"));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Supplier</title>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container">
        <h3 class="mb-3 fw-bold">Data Supplier</h3>
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM supplier");
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>
                        <td>" . $no++ . "</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['telp']}</td>
                        <td>{$row['alamat']}</td>
                        <td>
                            <a href='supplier.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='supplier.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus supplier ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <form method="POST" class="row g-2 mb-4 border p-3 bg-light rounded">
            <?php if ($edit): ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>">
            <?php endif; ?>
            <div class="col-md-4">
                <input type="text" name="nama" class="form-control" placeholder="Nama Supplier" required value="<?= $edit['nama'] ?? ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="telp" class="form-control" placeholder="No. Telepon" required value="<?= $edit['telp'] ?? ''; ?>">
            </div>
            <div class="col-md-5">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $edit['alamat'] ?? ''; ?>">
            </div>
            <div class="col-12 mt-2">
                <?php if ($edit): ?>
                <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                <a href="supplier.php" class="btn btn-secondary btn-sm">Batal</a>
                <?php else: ?>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm">Tambah Supplier</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

</html>