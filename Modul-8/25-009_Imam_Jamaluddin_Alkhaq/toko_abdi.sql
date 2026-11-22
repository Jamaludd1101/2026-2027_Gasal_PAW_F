-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2026 at 06:26 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_abdi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Beras 5kg', 60000, 50, 1),
(2, 'B002', 'Minyak Goreng 2L', 35000, 40, 2),
(3, 'B003', 'Gula Pasir 1kg', 15000, 100, 3),
(4, 'B004', 'Tepung Terigu 1kg', 12000, 80, 4),
(5, 'B005', 'Susu Kental Manis', 11000, 120, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Budi Santoso', 'L', '08111222333', 'Jl. Anggrek 1'),
('P002', 'Siti Aminah', 'P', '08111222334', 'Jl. Melati 2'),
('P003', 'Andi Darmawan', 'L', '08111222335', 'Jl. Mawar 3'),
('P004', 'Rina Kartika', 'P', '08111222336', 'Jl. Kenanga 4'),
('P005', 'Joko Susilo', 'L', '08111222337', 'Jl. Kamboja 5'),
('P006', 'Dewi Lestari', 'P', '08111222338', 'Jl. Dahlia 6'),
('P007', 'Hendra Wijaya', 'L', '08111222339', 'Jl. Tulip 7'),
('P008', 'Nadia Putri', 'P', '08111222340', 'Jl. Teratai 8');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Maju Jaya', '081234567890', 'Jl. Merdeka No 1'),
(2, 'CV Sumber Rejeki', '081234567891', 'Jl. Sudirman No 2'),
(3, 'Toko Grosir Berkah', '081234567892', 'Jl. Thamrin No 3'),
(4, 'Agen Sentosa', '081234567893', 'Jl. Gatot Subroto No 4'),
(5, 'Distributor Makmur', '081234567894', 'Jl. Haryono No 5');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian Rutin', 160000, 'P001'),
(2, '2026-11-02', 'Belanja Bulanan', 70000, 'P002'),
(3, '2026-11-03', 'Titipan Tetangga', 30000, 'P003'),
(4, '2026-11-04', 'Kebutuhan Dapur', 24000, 'P004'),
(5, '2026-11-05', 'Persediaan', 55000, 'P005'),
(6, '2026-11-06', 'Tambahan', 60000, 'P001'),
(7, '2026-11-07', 'Belanja Pagi', 51000, 'P002'),
(8, '2026-11-08', 'Belanja Sore', 22000, 'P003'),
(9, '2026-11-09', 'Stok Warung', 120000, 'P004'),
(10, '2026-11-10', 'Dadakan', 155000, 'P005'),
(11, '2026-11-02', 'Belanja Tambahan', 41000, 'P003'),
(12, '2026-11-05', 'Kebutuhan Rumah', 95000, 'P001'),
(13, '2026-11-11', 'Belanja Mingguan', 180000, 'P006'),
(14, '2026-11-11', 'Beli Minyak & Gula', 100000, 'P002'),
(15, '2026-11-12', 'Katering Kecil', 81000, 'P007'),
(16, '2026-11-13', 'Restok Warung', 225000, 'P004'),
(17, '2026-11-14', 'Belanja Harian', 39000, 'P001'),
(18, '2026-11-15', 'Pesanan Hajatan', 360000, 'P008'),
(19, '2026-11-15', 'Belanja Sore', 57000, 'P006'),
(20, '2026-11-16', 'Kebutuhan Toko', 130000, 'P005'),
(21, '2026-11-17', 'Belanja Pagi', 71000, 'P003'),
(22, '2026-11-18', 'Tambahan Stok', 89000, 'P007'),
(23, '2026-11-18', 'Belanja Rutin', 155000, 'P002'),
(24, '2026-11-19', 'Kebutuhan Dapur', 39000, 'P008'),
(25, '2026-11-20', 'Belanja Akhir Pekan', 280000, 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(2, 2, 35000, 2),
(3, 3, 15000, 2),
(4, 4, 12000, 2),
(5, 5, 11000, 5),
(6, 1, 60000, 1),
(7, 3, 15000, 1),
(8, 5, 11000, 2),
(9, 1, 60000, 2),
(10, 2, 35000, 1),
(2, 1, 60000, 2),
(10, 1, 60000, 2),
(7, 4, 12000, 3),
(1, 1, 60000, 1),
(1, 2, 35000, 2),
(1, 3, 15000, 2),
(11, 3, 15000, 2),
(11, 5, 11000, 1),
(12, 1, 60000, 1),
(12, 2, 35000, 1),
(13, 1, 60000, 3),
(14, 2, 35000, 2),
(14, 3, 15000, 2),
(15, 4, 12000, 4),
(15, 5, 11000, 3),
(16, 1, 60000, 2),
(16, 2, 35000, 3),
(17, 3, 15000, 1),
(17, 4, 12000, 2),
(18, 1, 60000, 5),
(18, 3, 15000, 4),
(19, 2, 35000, 1),
(19, 5, 11000, 2),
(20, 2, 35000, 2),
(20, 4, 12000, 5),
(21, 1, 60000, 1),
(21, 5, 11000, 1),
(22, 3, 15000, 3),
(22, 5, 11000, 4),
(23, 1, 60000, 2),
(23, 2, 35000, 1),
(24, 4, 12000, 2),
(24, 3, 15000, 1),
(25, 1, 60000, 3),
(25, 2, 35000, 2),
(25, 3, 15000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Jl. Admin', '0899999', 1),
(2, 'kasir1', 'kasir123', 'Kasir Satu', 'Jl. Kasir 1', '0888881', 2),
(3, 'kasir2', 'kasir123', 'Kasir Dua', 'Jl. Kasir 2', '0888882', 2),
(4, 'gudang1', 'kasir123', 'kasir Tiga', 'Jl. Gudang', '0877777', 2),
(5, 'manager', 'manager123', 'Manager Toko', 'Jl. Manager', '0866666', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `transaksi_detail_ibfk_2` (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
