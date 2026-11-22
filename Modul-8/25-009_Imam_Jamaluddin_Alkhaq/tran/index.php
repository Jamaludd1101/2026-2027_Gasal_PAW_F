<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: ../reg/login.php");
    exit;
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        .barang {
        border: none;
        background: none;
        text-align: right;
    }

    .barang td {
        border: none;
        background: none;
    }
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container">
        <h1>Data transaksi</h1>
        <table class="table table-bordered text-center">
            <thead>
                <?php if ($_SESSION['level'] == 1): ?>
                <tr class="barang">
                    <td colspan="6">
                        <a href="barang.php"><button class="btn btn-warning" type="button" id='b1'>Kelola barang</button></a>
                    </td>
                </tr>
                <?php endif; ?>
                <tr class="table-primary">
                    <th>no</th>
                    <th>waktu transaksi</th>
                    <th>pelanggan</th>
                    <th>keterangan</th>
                    <th>total</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $sql = "SELECT t.id, waktu_transaksi, nama, keterangan, total FROM pelanggan p, transaksi t WHERE p.id = t.pelanggan_id";
            $query= mysqli_query($conn, $sql);
            $no=1;
            while ($tran = mysqli_fetch_array($query) ) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $tran['waktu_transaksi'] . '</td>';
            echo '<td>' . $tran['nama'] . '</td>';
            echo '<td>' . $tran['keterangan'] . '</td>';
            echo '<td>' . $tran['total'] . '</td>';


           echo '<td>';
                    echo "<a href='detail.php?id=" . $tran['id'] . "'><button class='btn btn-info' type='button' id='b2'>Detail</button></a> ";
                    echo '</td>';

           echo '</tr>';

            }
             ?>
            </tbody>
        </table>
    </div>
</body>

</html>