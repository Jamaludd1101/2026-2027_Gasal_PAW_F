<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: ../reg/login.php");
    exit;
}
include "config.php";

$tanggalm = $_GET['tanggalm'] ?? "";
$tanggala = $_GET['tanggala'] ?? "";
Header("Content-Type: application/vnd.ms-excel");
Header("Content-Disposition: attachment; filename=test.xls");
 ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
    table,
    tr,
    td,
    th {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <div class="container py-y mt-5">
        <h1 class="mb-4 fw-bold">Data transaksi</h1>
        <p>Periode:
            <?= ($tanggalm && $tanggala) ? "$tanggalm s/d $tanggala" : "Semua Periode" ?>
        </p>
        <table class="table text-center">
            <thead class=" table-primary">
                <tr>
                    <th>No</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $no=1;
            while ($tran = mysqli_fetch_array($query) ) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $tran['total_transaksi'] . '</td>';
            echo '<td>' . $tran['waktu_transaksi'] . '</td>';

           echo '</tr>';

            }
             ?>
            </tbody>
        </table>
    </div>
</body>

</html>