<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: ../reg/login.php");
    exit;
}
if ($_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARANG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mb-3 fw-bold">Data barang</h1>
        <table class="table table-bordered text-center">
            <thead>
                <tr class="table-primary">
                    <th>no</th>
                    <th>barang</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $sql = "SELECT * FROM barang";
            $query= mysqli_query($conn, $sql);
            $no=1;
            while ($barang = mysqli_fetch_array($query) ) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $barang['nama_barang'] . '</td>';
            echo '<td>' . $barang['harga'] . '</td>';
            echo '<td>' . $barang['stok'] . '</td>';


           echo '<td>';
                    echo "<a href='hapus-barang.php?id=" . $barang['id'] . "'><button class='btn btn-danger'  type='button' id='b3'>Hapus</button></a> ";
                    echo '</td>';

           echo '</tr>';

            }
             ?>
            </tbody>
        </table>
        <a href="index.php"><button class="btn btn-warning" id="b2">Kembali</button></a>
    </div>
</body>

</html>