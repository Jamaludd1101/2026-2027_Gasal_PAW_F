<?php
include 'config.php';

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];


    $cek_pakai = "SELECT * FROM transaksi_detail WHERE barang_id = '$barang_id'";
    $query_cek = mysqli_query($conn, $cek_pakai);

    if (mysqli_num_rows($query_cek) > 0) {

        echo "<script>
                alert('Data gagal dihapus! Barang ini masih digunakan pada transaksi.');
                window.location.href = 'barang.php';
              </script>";
    } else {

        $sql_hapus = "DELETE FROM barang WHERE id = '$barang_id'";
        mysqli_query($conn, $sql_hapus);
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href = 'barang.php';
             </script>";
    }
} else {
    echo "Akses ditolak.";
}
?>