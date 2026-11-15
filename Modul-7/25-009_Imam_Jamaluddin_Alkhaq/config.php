<?php
 $conn = mysqli_connect("localhost","root","","toko_abdi");

 if (!$conn) {
        die("gagal");
 }

$tanggalm= $_GET['tanggalm']?? "";
$tanggala= $_GET['tanggala']?? "";

if ($tanggalm !="" && $tanggala !="") {
        $sql = "SELECT waktu_transaksi,SUM(total) total_transaksi FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalm' AND '$tanggala' GROUP BY waktu_transaksi";
        $sql_card = "SELECT COUNT(DISTINCT pelanggan_id) pelanggan_unik, SUM(total) total_keseluruhan
                 FROM transaksi
                 WHERE DATE(waktu_transaksi) BETWEEN '$tanggalm' AND '$tanggala'";
}else{
            $sql = "SELECT waktu_transaksi, SUM(total) total_transaksi FROM transaksi GROUP BY waktu_transaksi";
            $sql_card = "SELECT COUNT(DISTINCT pelanggan_id) pelanggan_unik, SUM(total) total_keseluruhan FROM transaksi";
}
$query= mysqli_query($conn, $sql);

$query_card = mysqli_query($conn, $sql_card);
$card = mysqli_fetch_assoc($query_card);

 ?>