<?php include 'config.php';


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARANG</title>
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

    .tambah {
        border: none;
        background: none;
        text-align: right;
    }

    .tambah td {
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
    <h1>Data barang</h1>
    <table>
        <thead>
            <tr class="judul">
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
                    echo "<a href='hapus-barang.php?id=" . $barang['id'] . "'><button type='button' id='b3'>Hapus</button></a> ";
                    echo '</td>';

           echo '</tr>';

            }
             ?>
        </tbody>
    </table>
    <a href="index.php"><button id="b2">Kembali</button></a>
</body>

</html>