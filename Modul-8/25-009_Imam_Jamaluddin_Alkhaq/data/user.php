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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    mysqli_query($conn, "INSERT INTO user (username, password, nama, alamat, hp, level)
                         VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')");
    header("Location: user.php");
    exit;
}

if (isset($_POST['update'])) {
    $id_user  = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    mysqli_query($conn, "UPDATE user SET username='$username', password='$password', nama='$nama',
                         alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id_user'");
    header("Location: user.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");
    header("Location: user.php");
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_edit'"));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data User</title>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container">
        <h3 class="mb-3 fw-bold">Data User</h3>
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>HP</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM user");
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    $ket_level = ($row['level'] == 1) ? '1 (Owner)' : (($row['level'] == 2) ? '2 (Kasir)' : $row['level']);
                    echo "<tr>
                        <td>" . $no++ . "</td>
                        <td>{$row['username']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['hp']}</td>
                        <td>$ket_level</td>
                        <td>
                            <a href='user.php?edit={$row['id_user']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='user.php?hapus={$row['id_user']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus user ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <form method="POST" class="row g-2 mb-4 border p-3 bg-light rounded">
            <?php if ($edit): ?>
            <input type="hidden" name="id_user" value="<?= $edit['id_user']; ?>">
            <?php endif; ?>
            <div class="col-md-2">
                <input type="text" name="username" class="form-control" placeholder="Username" required value="<?= $edit['username'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="password" class="form-control" placeholder="Password" required value="<?= $edit['password'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required value="<?= $edit['nama'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="hp" class="form-control" placeholder="No. HP" required value="<?= $edit['hp'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $edit['alamat'] ?? ''; ?>">
            </div>
            <div class="col-md-2">
                <select name="level" class="form-select" required>
                    <option value="1" <?=($edit && $edit['level']==1) ? 'selected' : '' ; ?>>1 - Owner</option>
                    <option value="2" <?=($edit && $edit['level']==2) ? 'selected' : '' ; ?>>2 - Kasir</option>
                </select>
            </div>
            <div class="col-12 mt-2">
                <?php if ($edit): ?>
                <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                <a href="user.php" class="btn btn-secondary btn-sm">Batal</a>
                <?php else: ?>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm">Tambah User</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

</html>