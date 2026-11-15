<?php
include "config.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @media print {
            .no-print{
                display: none !important;
            }
        }

    </style>
</head>

<body>
    <div class="no-print mb-5">
        <button type="button" onclick="window.print()" class="btn btn-secondary me-2">
            Cetak
        </button>
        <a href="excel.php?tanggalm=<?= urlencode($tanggalm) ?>&tanggala=<?= urlencode($tanggala) ?>" class="btn btn-success">
            Export Excel
        </a>
    </div>
    <div class="container py-y mt-5">
        <h1 class="mb-4 fw-bold">Data transaksi</h1>
        <div class="chart mb-5">
            <canvas id="myChart"></canvas>
        </div>
        <form method="GET" action="" class="no-print row g-3 align-items-end mb-4">
            <div class="col-md-4">
                <label class="form-label" for="tanggalm">Tanggal Mulai :</label>
                <input class="form-control" type="date" name="tanggalm" value="<?= $tanggalm ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="tanggala ">Tanggal Akhir :</label>
                <input class="form-control" type="date" name="tanggala" value="<?= $tanggala ?>">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary px-4" type="submit" name="cari">CARI</button>
            </div>
        </form>
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
            $labels = [];
            $data = [];
            while ($tran = mysqli_fetch_array($query) ) {
            $labels[] = $tran['waktu_transaksi'];
            $data[] = $tran['total_transaksi'];
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $tran['total_transaksi'] . '</td>';
            echo '<td>' . $tran['waktu_transaksi'] . '</td>';

           echo '</tr>';

            }
             ?>
            </tbody>
        </table>
        <div class="card mb-4 mt-4" style="max-width: 320px;">
            <div class="card-header header-ungu fw-bold">
                Ringkasan informasi total kumulatif
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <p class="card-title d-block">Jumlah Pelanggan Unik</p>
                    <h3 class="fw-bold text-primary">
                        <?= $card['pelanggan_unik'] ?? 0 ?> Orang
                    </h3>
                </div>
                <div class="mb-4">
                    <p class="card-title d-block">Total Pendapatan Keseluruhan</p>
                    <h3 class="fw-bold text-primary">
                        Rp
                        <?= number_format($card['total_keseluruhan'] ?? 0, 0, ',', '.') ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels) ?>,
        datasets: [{
            label: 'Penjualan perhari',
            data: <?php echo json_encode($data) ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>