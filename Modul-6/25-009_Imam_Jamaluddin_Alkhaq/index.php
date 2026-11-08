<?php include 'config.php';


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        h1 {
        margin: 20px;
    }

    table {
        margin: 20px;
        border-collapse: collapse;
    }

    .judul {
        background: blueviolet;
    }

    tr,
    td,
    th {
        border: 1px solid black;

    }

    td,
    th {
        padding: 15px;
    }

    button {
        padding: 10px;
        margin: 3px;
    }

    .barang {
        border: none;
        background: none;
        text-align: right;
    }

    .barang td {
        border: none;
        background: none;
    }

    button {
        border-radius: 4px;
    }

    #b1 {
        background-color: green;
        color: white;
    }

    #b2 {
        background-color: orange;
        color: white;
    }

    #b3 {
        background-color: red;
        color: white;
    }
    </style>
</head>

<body>
    <h1>Data transaksi</h1>
    <table>
        <thead>
            <tr class="barang">
                <td colspan="5">
                    <a href="barang.php"><button type="button" id='b1'>Kelola barang</button></a>
                </td>
            </tr>
            <tr class="judul">
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
                    echo "<a href='detail.php?id=" . $tran['id'] . "'><button type='button' id='b2'>Detail</button></a> ";
                    echo '</td>';

           echo '</tr>';

            }
             ?>
        </tbody>
    </table>
</body>

</html>