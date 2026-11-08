<?php
include 'config.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];



if (isset($_POST['tambah'])) {
        $transaksi_id = $_POST['transaksi_id'];
        $barang_id = $_POST['barang_id'];
        $qty = $_POST['qty'];


        $sql_harga = "SELECT harga FROM  barang WHERE id = '$barang_id'";
        $query_harga = mysqli_query($conn,$sql_harga);
        $barang = mysqli_fetch_array($query_harga);

        $harga = $barang['harga'];

        $tambah_barang = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga,qty) VALUES ('$transaksi_id','$barang_id','$harga','$qty')";

        $simpan = mysqli_query($conn,$tambah_barang);

        if ($simpan) {
            $sql_update_total = "UPDATE transaksi SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id') WHERE id = '$transaksi_id'";
            mysqli_query($conn, $sql_update_total);
            header('Location: detail.php?id=' . $transaksi_id);
        } else {
            echo "<script>alert('Gagal menambahkan barang');</script>";
        }
    }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL</title>
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
<h1></h1>

<body>
    <h1>id transaksi
        <?php echo $id; ?>
    </h1>
    <br>
    <h3>Tabel master</h3>
    <table>
        <thead>
            <tr class="judul">
                <th>waktu transaksi</th>
                <th>pelanggan</th>
                <th>keterangan</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT t.id,waktu_transaksi,nama,keterangan,total FROM pelanggan p, transaksi t WHERE p.id = t.pelanggan_id AND t.id=$id;";
            $query= mysqli_query($conn, $sql);
           $tran = mysqli_fetch_array($query);
            echo '<tr>';
            echo '<td>' . $tran['waktu_transaksi'] . '</td>';
            echo '<td>' . $tran['nama'] . '</td>';
            echo '<td>' . $tran['keterangan'] . '</td>';
            echo '<td>' . $tran['total'] . '</td>';
           echo '</tr>';
           ?>
        </tbody>
    </table>
    <br>
    <h3>Tabel detail</h3>
    <table>
        <thead>
            <tr class="judul">
                <th>barang</th>
                <th>harga</th>
                <th>qty</th>
                <th>subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $barang_ada = array();

            $sql2 = "SELECT barang_id, transaksi_id,nama_barang,d.harga,qty, SUM(d.harga*qty) subtotal FROM barang b,transaksi_detail d WHERE b.id = d.barang_id AND transaksi_id=$id GROUP BY transaksi_id,d.harga,qty,nama_barang,barang_id;";
            $query2= mysqli_query($conn, $sql2);
           while($detail = mysqli_fetch_array($query2)){

            $barang_ada[] = $detail['barang_id'];

            echo '<tr>';
            echo '<td>' . $detail['nama_barang'] . '</td>';
            echo '<td>' . $detail['harga'] . '</td>';
            echo '<td>' . $detail['qty'] . '</td>';
            echo '<td>' . $detail['subtotal'] . '</td>';
           echo '</tr>';
       }

           ?>
        </tbody>
    </table>
    <br>
    <h1>Tambah Barang</h1>
    <form method="POST">
        <input type="hidden" name="transaksi_id" value="<?php echo $id; ?>">
        <table>
            <tr class="judul">
                <th>
                    list barang
                </th>
                <th>
                    qty
                </th>
                <th>
                    aksi
                </th>
            </tr>
            <tr>
                <td>
                    <select name="barang_id" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php
            $sql_select = "SELECT * FROM barang";
            $query_select = mysqli_query($conn,$sql_select);
            while($list = mysqli_fetch_array($query_select)){

            if (in_array($list['id'], $barang_ada)) {
                echo '<option value="' . $list['id'] . '" disabled>' . $list['nama_barang'] . ' (Sudah Dipilih)</option>';
            }else{
                echo '<option value="' . $list['id'] . '">' . $list['nama_barang'] . " (".$list['harga']. ') </option>';
                }
            }
             ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="qty" min="1" required>
                </td>
                <td>
                    <button type="submit" id="b1" name="tambah">tambah</button>
                </td>
            </tr>
        </table>
        <br>
    </form>
    <a href="index.php"><button id="b2">Kembali</button></a>
</body>

</html>