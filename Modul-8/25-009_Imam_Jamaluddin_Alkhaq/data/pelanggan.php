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
    $id            = $_POST['id'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp          = $_POST['telp'];
    $alamat        = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat)
                         VALUES ('$id', '$nama', '$jenis_kelamin', '$telp', '$alamat')");
    header("Location: pelanggan.php");
    exit;
}

if (isset($_POST['update'])) {
    $id            = $_POST['id'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp          = $_POST['telp'];
    $alamat        = $_POST['alamat'];

    mysqli_query($conn, "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jenis_kelamin', telp='$telp', alamat='$alamat' WHERE id='$id'");
    header("Location: pelanggan.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$id'");
    header("Location: pelanggan.php");
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id_edit'"));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container">
        <h3 class="mb-3 fw-bold">Data Pelanggan</h3>
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM pelanggan");
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['jenis_kelamin']}</td>
                        <td>{$row['telp']}</td>
                        <td>{$row['alamat']}</td>
                        <td>
                            <a href='pelanggan.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='pelanggan.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus pelanggan ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <form method="POST" class="row g-2 mb-4 border p-3 bg-light rounded">
            <div class="col-md-2">
                <input type="text" name="id" class="form-control" placeholder="ID (P009)" required value="<?= $edit['id'] ?? ''; ?>" <?=$edit ? 'readonly' : '' ; ?>>
            </div>
            <div class="col-md-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan" required value="<?= $edit['nama'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L" <?=($edit && $edit['jenis_kelamin']=='L' ) ? 'selected' : '' ; ?>>Laki-laki (L)</option>
                    <option value="P" <?=($edit && $edit['jenis_kelamin']=='P' ) ? 'selected' : '' ; ?>>Perempuan (P)</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="telp" class="form-control" placeholder="Telepon" required value="<?= $edit['telp'] ?? ''; ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $edit['alamat'] ?? ''; ?>">
            </div>
            <div class="col-12 mt-2">
                <?php if ($edit): ?>
                <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                <a href="pelanggan.php" class="btn btn-secondary btn-sm">Batal</a>
                <?php else: ?>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm">Tambah Pelanggan</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

</html>