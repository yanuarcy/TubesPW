-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2023 pada 07.32
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `KategoriID` int(15) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`KategoriID`, `Nama`) VALUES
(1, 'PC Packages'),
(2, 'Monitor'),
(3, 'Accessories'),
(7, 'Spare Part');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `MemberID` int(15) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Gender` varchar(2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Telp` varchar(50) NOT NULL,
  `Alamat` varchar(200) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`MemberID`, `Nama`, `Gender`, `Email`, `Password`, `Telp`, `Alamat`, `Role`) VALUES
(1, 'Yanuar', 'L', 'yanuarcahyo567@gmail.com', '8e36aec125377b008352fc32b27daf06', '082257508081', 'Jl. Medokan Sawah Timur VI / 7E', 'User'),
(5, 'maria', 'P', 'maria@gmail.com', '193216852c2e88980c65ac5442901542', '12356122445', 'surabaya', 'User'),
(7, 'neti', 'P', 'neti@gmail.com', 'a220371f766605b758d677d7f6db1ef8', '0987267172765', 'Malang', 'User'),
(16, 'baba', 'L', 'baba@gmail.com', 'c7da6c175383d340bc51adc12ed93d9c', '082146631', 'surabaya', 'User'),
(17, 'Etaa', 'P', 'Etacu123@gmail.com', 'ced4ddb898d8568c39d1c1c351a0e7c5', '09876543212', 'IT Telkom Surabaya', 'User'),
(19, 'Admin', 'L', 'admin2@gmail.com', '83cfb3782f6205ef949913d89351016b', '082257508081', 'Surabaya', 'Admin'),
(22, 'bubu', 'P', 'arneysa25@gmail.com', 'bf32c73e8a36f73b5600844d9e7da60f', '0813-3637-7045', 'suko', 'Admin'),
(23, 'mbemcu', 'P', 'julieta29@gmail.com', '617e0a0b1d313f50fe6ef462cce599cf', '0813-3637-7045', 'sidoarjo', 'User'),
(24, 'kiribili', 'L', 'kiribili4@gmail.com', '4613b6fa27b0ff375deda15c66e4b67f', '0812-3456-7890', 'juanda', 'User'),
(25, 'ian', 'L', 'ian05@gmail.com', '1e49e4e9ae63e553485146330d933ffe', '0822-5750-8081', 'Medokan', 'Admin'),
(27, 'User', 'L', 'User1@gmail.com', '427e2ebe082e4e3157e2d00ba0fe71a6', '0123-4567-8901', 'My Address is private', 'User'),
(29, 'shakira', 'P', 'shakira25@gmail.com', '1bab511673778bb75cf86c0b70412a64', '0813-3637-7045', 'Sidoarjo', 'User'),
(30, 'etacuu', 'L', 'shakira250@gmail.com', '4ef234fc95d3c30c6c7ee54626fdb9f0', '1242-4251-2561', 'asfasg', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` int(15) DEFAULT NULL,
  `ItemID` int(15) DEFAULT NULL,
  `Tgl_Order` date NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Nm_Barang` varchar(50) NOT NULL,
  `Jml_Barang` int(15) NOT NULL,
  `Total_Harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `ItemID`, `Tgl_Order`, `Nama`, `Nm_Barang`, `Jml_Barang`, `Total_Harga`) VALUES
(18, 63, '2023-01-27', 'kiribili', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 1, 6600000),
(18, 54, '2023-01-27', 'kiribili', 'COLORFUL SL300 128GB', 1, 300000),
(18, 53, '2023-01-27', 'kiribili', ' MSI LED 27″ MD271P', 1, 1800000),
(19, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(19, 63, '2023-01-27', 'maria', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 1, 6600000),
(19, 54, '2023-01-27', 'maria', 'COLORFUL SL300 128GB', 2, 600000),
(20, 52, '2023-01-27', 'maria', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 2, 39300000),
(20, 63, '2023-01-27', 'maria', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 2, 13200000),
(20, 55, '2023-01-27', 'maria', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 1, 600000),
(20, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 4, 7200000),
(20, 51, '2023-01-27', 'maria', ' MSI RTX3070 VENTUS 3X 8GB GDDR6', 2, 18600000),
(20, 54, '2023-01-27', 'maria', 'COLORFUL SL300 128GB', 1, 300000),
(21, 54, '2023-01-27', 'neti', 'COLORFUL SL300 128GB', 1, 300000),
(22, 54, '2023-01-27', 'neti', 'COLORFUL SL300 128GB', 1, 300000),
(23, 54, '2023-01-27', 'neti', 'COLORFUL SL300 128GB', 1, 300000),
(24, 52, '2023-01-27', 'neti', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(25, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(26, 51, '2023-01-27', 'Yanuar', ' MSI RTX3070 VENTUS 3X 8GB GDDR6', 1, 9300000),
(27, 55, '2023-01-27', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 2, 1200000),
(28, 52, '2023-01-27', 'maria', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(29, 54, '2023-01-27', 'neti', 'COLORFUL SL300 128GB', 1, 300000),
(30, 53, '2023-01-27', 'neti', ' MSI LED 27″ MD271P', 1, 1800000),
(31, 53, '2023-01-27', 'neti', ' MSI LED 27″ MD271P', 1, 1800000),
(32, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(33, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(34, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(35, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(36, 53, '2023-01-27', 'maria', ' MSI LED 27″ MD271P', 1, 1800000),
(37, 54, '2023-01-27', 'Yanuar', 'COLORFUL SL300 128GB', 1, 300000),
(38, 55, '2023-01-27', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 1, 600000),
(39, 55, '2023-01-27', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 1, 600000),
(39, 54, '2023-01-27', 'Etaa', 'COLORFUL SL300 128GB', 1, 300000),
(40, 54, '2023-01-27', 'Yanuar', 'COLORFUL SL300 128GB', 2, 600000),
(40, 55, '2023-01-27', 'Yanuar', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 4, 2400000),
(40, 63, '2023-01-27', 'Yanuar', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 2, 13200000),
(41, 63, '2023-01-27', 'maria', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 1, 6600000),
(42, 51, '2023-01-28', 'Etaa', ' MSI RTX3070 VENTUS 3X 8GB GDDR6', 1, 9300000),
(43, 52, '2023-01-28', 'Etaa', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(44, 52, '2023-01-28', 'Etaa', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(45, 52, '2023-01-28', 'Etaa', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(46, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 2, 600000),
(46, 55, '2023-01-29', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 2, 1200000),
(47, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 1, 300000),
(49, 55, '2023-01-29', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 1, 600000),
(50, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 2, 600000),
(51, 53, '2023-01-29', 'Etaa', ' MSI LED 27″ MD271P', 1, 1800000),
(52, 51, '2023-01-29', 'Etaa', ' MSI RTX3070 VENTUS 3X 8GB GDDR6', 1, 9300000),
(53, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 1, 300000),
(54, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 1, 300000),
(55, 54, '2023-01-29', 'Etaa', 'COLORFUL SL300 128GB', 1, 300000),
(56, 55, '2023-01-29', 'Etaa', 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 1, 600000),
(57, 80, '2023-02-01', 'User', 'HYPERX SOLOCAST', 1, 950000),
(57, 73, '2023-02-01', 'User', 'RAZER NAGA HEX', 1, 1250000),
(57, 83, '2023-02-01', 'User', 'DUCKY 69 FIRE EDITION', 1, 2000000),
(57, 63, '2023-02-01', 'User', 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 1, 6600000),
(57, 52, '2023-02-01', 'User', 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 1, 19650000),
(57, 77, '2023-02-01', 'User', 'NZXT NOCTIS 450', 1, 2375000),
(57, 84, '2023-02-01', 'User', 'STEELSERIES ARCTIS NOVA PRO WIRELESS', 1, 5650000),
(57, 69, '2023-02-01', 'User', 'ADATA XPG SX6000 512GB NVME M.2', 1, 630000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(15) NOT NULL,
  `MemberID` int(15) NOT NULL,
  `Total_Harga` int(15) NOT NULL,
  `Tgl_Order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`OrderID`, `MemberID`, `Total_Harga`, `Tgl_Order`) VALUES
(18, 24, 8700000, '2023-01-27'),
(19, 5, 9000000, '2023-01-27'),
(20, 5, 79200000, '2023-01-27'),
(21, 7, 300000, '2023-01-27'),
(22, 7, 300000, '2023-01-27'),
(23, 7, 19950000, '2023-01-27'),
(24, 7, 19650000, '2023-01-27'),
(25, 5, 1800000, '2023-01-27'),
(26, 1, 9300000, '2023-01-27'),
(27, 17, 21150000, '2023-01-27'),
(28, 5, 22650000, '2023-01-27'),
(29, 7, 3300000, '2023-01-27'),
(30, 7, 3300000, '2023-01-27'),
(31, 7, 2400000, '2023-01-27'),
(32, 5, 2700000, '2023-01-27'),
(33, 5, 2700000, '2023-01-27'),
(34, 5, 2700000, '2023-01-27'),
(35, 5, 2700000, '2023-01-27'),
(36, 5, 2700000, '2023-01-27'),
(37, 1, 900000, '2023-01-27'),
(38, 17, 900000, '2023-01-27'),
(39, 17, 900000, '2023-01-27'),
(40, 1, 16200000, '2023-01-27'),
(41, 5, 6600000, '2023-01-27'),
(42, 17, 9300000, '2023-01-28'),
(43, 17, 19650000, '2023-01-28'),
(44, 17, 19650000, '2023-01-28'),
(45, 17, 19650000, '2023-01-28'),
(46, 17, 1800000, '2023-01-29'),
(47, 17, 300000, '2023-01-29'),
(48, 17, 0, '2023-01-29'),
(49, 17, 600000, '2023-01-29'),
(50, 17, 600000, '2023-01-29'),
(51, 17, 1800000, '2023-01-29'),
(52, 17, 9300000, '2023-01-29'),
(53, 17, 300000, '2023-01-29'),
(54, 17, 300000, '2023-01-29'),
(55, 17, 300000, '2023-01-29'),
(56, 17, 600000, '2023-01-29'),
(57, 27, 39105000, '2023-02-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `ItemID` int(15) NOT NULL,
  `KategoriID` int(15) NOT NULL,
  `MemberID` int(15) NOT NULL,
  `Nm_Barang` varchar(50) NOT NULL,
  `Harga` int(50) NOT NULL,
  `Stok` int(15) NOT NULL,
  `Deskripsi` varchar(1000) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`ItemID`, `KategoriID`, `MemberID`, `Nm_Barang`, `Harga`, `Stok`, `Deskripsi`, `photo`) VALUES
(51, 7, 25, 'MSI RTX3070 VENTUS 3X 8GB GDDR6', 9300000, 30, 'The GeForce RTX™ 3070 is powered by Ampere—NVIDIA’s 2nd gen RTX architecture. Built with enhanced RT Cores and Tensor Cores, new streaming multiprocessors, and high-speed G6 memory, it gives you the power you need to rip through the most demanding games.\r\n', 'VGA3.jpg'),
(52, 7, 25, 'ASUS ROG STRIX RTX4070Ti OC 12GB GDDR6X', 19650000, 29, 'Powered by NVIDIA DLSS3, ultra-efficient Ada\r\nLovelace arch, and full ray tracing. 4th\r\nGeneration Tensor Cores: Up to 4x performance with\r\nDLSS 3 vs. brute-force rendering 3rd Generation\r\nRT Cores: Up to 2X ray tracing\r\nperformance Axial-tech fans scaled up for 31%\r\nmore airflow 3.15-slot design: massive fin array\r\noptimized for airflow from the three Axial-tech\r\nfans Diecast shroud, frame, and backplate add\r\nrigidity and are vented to further maximize\r\nairflow and heat dissipation Digital power\r\ncontrol with high-current power stages and 15K\r\ncapacitors to fuel maximum\r\nperformance Auto-Extreme precision automated\r\nmanufacturing for higher reliability GPU Tweak\r\nIII software provides intuitive performance\r\ntweaking, thermal controls, and system monitoring', 'VGA1.jpg'),
(53, 2, 25, 'MSI LED 27″ MD271P', 3080000, 30, ' MSI Modern MD271P Series Monitor – 27-inch, FHD, Anti-Flicker, Less Blue Light, Anti-Glare, Display Kit, VESA Mount Support & Built-in Speakers, Designed for pursuing a glorious lifestyle', 'Monitor-1.jpg'),
(54, 7, 25, 'COLORFUL SL300 128GB', 300000, 30, 'Read : 480MB/s | Write : 440MB/s | Chip Flash: MLC', 'Storage_2.jpg'),
(55, 7, 25, 'ADDLINK S68 512GB PCIe GEN 3×4 M.2 NVMe SSD', 600000, 30, '【Capacity】512GB NVMe SSD- Perfect upgrade for your new gaming build *Performance may vary based on system hardware & configuration\r\n【Speed Technology】3D NAND technology Sequential Read Speeds up to 2100 MB/s; Write Speeds up to 1700 MB/s : low latency, reliability and power efficiency', 'Storage_3.jpg'),
(63, 2, 25, 'ASUS ROG STRIX XG258Q 25″ 240Hz GAMING MONITOR', 6600000, 29, 'ROG Strix XG258Q Gaming Monitor – 25 inch (24.5 inch viewable) FHD (1920×1080), Native 240Hz, 1ms, Adaptive-Sync(FreeSync™), Asus Aura RGB', 'Monitor-3.jpg'),
(64, 7, 25, 'ASUS TUF RTX4070Ti OC 12GB GDDR6X', 17650000, 30, 'ASUS TUF Gaming GeForce RTX™ 4070 Ti 12GB GDDR6X OC Edition with DLSS 3, lower temps, and enhanced durability Powered by NVIDIA DLSS3, ultra-e\r\nficient Ada Lovelace arch, and full ray tracing. 4th Generation Tensor Cores: Up \r\no 4x performance with DLSS 3 vs. brute-force rendering 3rd Generation RT Cores: Up to 2\r\n ray tracing performance OC mode: 2760 MHz (OC mode)/ 273\r\n MHz (Default mode)', 'VGA2.jpg'),
(65, 7, 25, 'MSI RTX3060 GAMING X 12GB GDDR6', 6900000, 30, 'The GeForce RTX™ 3060 is powered by Ampere—NVIDIA’s 2nd gen RTX architecture. Built with enhanced RT Cores and Tensor Cores, new streaming multiprocessors, and high-speed G6 memory, it gives you the power you need to rip through the most demanding games.', 'VGA4.jpg'),
(66, 2, 25, ' LG LED 22″ 22MK600', 1800000, 30, 'LG MK 600 Series Monitor – 22-inch, FHD, Anti-Flicker, Less Blue Light, Surface Treatment: Anti glare ,3H, Display Kit, VESA Mount Support & Built-in Speakers, Designed for pursuing a glorious lifestyle', 'Monitor2.jpg'),
(67, 2, 25, 'LG LED 20″ 20MK400H', 1325000, 30, 'LG MK400 Series Monitor – 22-inch, FHD, Anti-Flicker, Less Blue Light, Surface Treatment: Anti glare ,3H, Display Kit, VESA Mount Support & Built-in Speakers, Designed for pursuing a glorious lifestyle\r\n', 'Monitor-4.jpg'),
(68, 7, 25, 'SAMSUNG 970 EVO PLUS 500GB NVMe M.2', 1150000, 30, 'Built with Samsung’s industry leading V-NAND technology for reliable and superior performance Read speeds up to 3,500MB/s* with a 5-year limited warranty and exceptional endurance up to 1,200 TBW* (* May vary by capacity)', 'Storage_1.jpg'),
(69, 7, 25, 'ADATA XPG SX6000 512GB NVME M.2', 630000, 29, 'PCIe Gen3x2 M.2 2280 NVMe 1.2 | R/W speed up to 1000/800 MB/s | Form Factor: M.2 2280 | Heatsink kit Included', 'Storage_4.jpg'),
(71, 3, 25, 'COUGAR MINOS XC', 290000, 30, 'Product Name COUGAR MINOS XC GAMING GEAR COMBO\r\nSensor ADNS-3050 Optical gaming sensor\r\nResolution 4000 DPI\r\nGame type FPS / MMORPG / MOBA / RTS\r\nPolling Rate 1000Hz\r\nOn-board Memory 128KB\r\nSoftware COUGAR UIX™ System\r\nProgrammable Buttons 6\r\nSwitching 20M gaming switches\r\nProfile LED Backlight Yes\r\nInterface USB plug\r\nCable Length 1.8m\r\nDimension 125(L) x 68(W) x 38(H) mm\r\n4.92(L) X 2.67(W) X 1.49(H) in\r\nSPEED XC\r\nDimension 260(W) X 210(L) mm\r\n10.24(W) x 8.27(L) in\r\nThinkness 3 (mm) / 0.12 (in)\r\nMaterial Cloth / Nature Rubber', 'Mouse-1.png'),
(72, 3, 25, 'Product Name COUGAR MINOS XC GAMING GEAR COMBO Sen', 1150000, 30, 'The combination of high-end components and the award winning ergonomic Mionix NAOS shape makes the Mionix NAOS 8200 the new standard for high-end gaming mice.\r\nStunning LED colour customisation and lighting effects allow for a personal tailor made appearance.\r\n\r\nThe 32bit ARM Processor is the engine behind the 8200DPI laser sensor that provides the most accurate and fast gaming experience making the NAOS 8200 the only option for even the most demanding gamer.', 'Mouse-2.png'),
(73, 3, 25, 'RAZER NAGA HEX', 1250000, 29, '-6 MOBA/action-RPG optimized mechanical thumb buttons\r\n-11 total programmable Hyperesponse buttons\r\n-Special switches in buttons for 250 clicks per minute\r\n-10 million click life cycle\r\n-Razer Synapse 2.0\r\n-5600dpi Razer Precision 3.5G Laser Sensor\r\n-1000Hz Ultrapolling/1ms response time\r\n-Approximate Size : 116 mm / 4.57” (Length) x 70 mm / 2.76” (Width) x 46 mm / 1.81” (Height)\r\n-Approximate Weight: 134 g / 0.30 lbs', 'Mouse-3.jpg'),
(74, 3, 25, 'OZONE SMOG', 625000, 30, 'Ozone SMOG gaming mouse is ready to give you the best gaming experience ever. Ergonomically designed, the right side hand grip can be changed to best suit your way of holding it. There’s absolutely no way of explaining the experience of grabbing this mouse', 'Mouse-4.jpg'),
(75, 1, 25, 'Ozone SMOG gaming mouse is ready to give you the b', 2400000, 30, 'Dual-Chamber Design: GT502 internals are divided into two chambers- the main chamber and rear chamber, allowing you to build clean and configure independent cooling zones for the CPU and GPU\r\nVersatile Graphic Card Mounting Options: Stand your graphics card up proud with an included vertical mount or slot it directly into the motherboard and banish sag with a bundled support bracket\r\nTool-free Side Panels: Side panels can be removed simply by pressing a button hidden on the rear of the chassis\r\nPanoramic View with Tempered Glass: Tempered glass panels at the front and side provide a tactfully tinted view of the main chamber.\r\nFront Panel High-speed connectivity: USB 3.2 Gen 2 Type-C, 2X USB 3.0, and RGB button', 'PC-1.png'),
(76, 1, 25, 'CORSAIR SPEC OMEGA TEMPERED GLASS', 1600000, 30, 'Unmistakable Style: Ensure your system will always stand out – asymmetrical, angular design gives SPEC-OMEGA a bold, unique and dynamic look\r\nTempered Glass to Show off your Hardware: Why hide your system? Tempered glass side and front panels put your system on display unlike any other case\r\nBuilt-in LED Lighting: Integrated front-panel white LED light strip and white LED-lit 120mm cooling fan add bright illumination and a dramatic styling\r\nTwo Included 120mm Fans and Direct Airflow Path: Keep your system cool inside and out with two CORSAIR\r\nCable Routing Cutouts and Tie Downs: With your system on display, SPEC OMEGA makes it easy to keep your cable routing neat, tidy, and out of the airflow path for better cooling', 'PC-2.jpg'),
(77, 1, 25, 'NZXT NOCTIS 450', 2375000, 29, 'The Noctis shares the interior layout of the tried and true H440 – featuring effortless cable management, fully modular hard drive trays, integrated PSU shroud — and adds on many features to make it a bold choice for any battle-hardened gamer.', 'PC-3.png'),
(79, 3, 25, 'INFINITY SPACEGATE', 500000, 30, 'Heart Pattern (Uni-Directional)\r\nRGB Illumination\r\nUSB Microphone\r\nAudio Monitoring\r\nPlug and Play\r\nNoise Cancelling', 'Mic-1.png'),
(80, 3, 25, 'HYPERX SOLOCAST', 950000, 29, 'Plug N Play audio recording: Get quality audio recordings with this easy-to-use USB condenser microphone. The cardioid polar pattern prioritizes sound sources directly in front of the microphone.\r\nTap-to-Mute sensor with LED status indicator: Simply tap the top of the mic to mute, and the signature LED indicator lets you immediately see whether or not you’re broadcasting.\r\nFlexible, adjustable stand: The easy-to-position stand swivels to support a variety of setups. You can even fit under a monitor if your setup is tight on space.\r\nBoom arm and mic stand threading: Versatile microphone fits 3/8-inch and 5/8-inch threaded setups, making it compatible with most mic stands or boom arms.\r\nMulti-device and program compatibility: Get great sound whether you’re connecting to a PC, PS4, or Mac. SoloCast is certified by Discord and TeamSpeak, and works on major streaming platforms like Streamlabs OBS, OBS Studio, and XSplit.', 'Mic-2.jpg'),
(81, 3, 25, 'GAMEN TITAN III', 350000, 30, 'Spesifikasi :\r\n\r\n1. Outemu Blue Switch, tombol yang kuatdengan ketahanan 50 juta kali\r\n\r\n2. Swappable 3 pin switch\r\n\r\n3. Kualitas Switch A+\r\n\r\n4. 16 mode warna RGB backlight, suasana bermain game jadi lebih menyenangkan\r\n\r\n5. Poros mekanis yang dapat dipasang\r\n\r\n6. 66 tombol dengan letak yang ringkas\r\n\r\n7. Ergonomic design sehingga bermain lebih nyaman\r\n\r\n8. Keycaps bahan PBT, kuat dan tahan lama daripada bahan ABS\r\n\r\n9. Dilengkapi 2 kaki anti slip', 'Keyboard-1.jpg'),
(82, 3, 25, 'RAZER ORBWEAVER', 1760000, 30, 'TECH SPECS\r\nFull mechanical keys with 50g actuation force\r\n30 fully programmable keys\r\nProgrammable 8-way directional thumb-pad\r\nAdjustable hand , thumb, and palm-rests modules for maximum comfort\r\nInstantaneous switching between 8 key maps\r\nUnlimited macro lengths\r\nRazer™ Synapse Enabled\r\nBraided fiber cable\r\nBacklit keypad for total control even in dark conditions\r\nUnlimited customizable profiles via Razer Synapse\r\nApproximate size: 55 mm / 2.17” (Depth) x 154 mm / 6.06” (Width) x 202 mm / 7.95” (Height)\r\nApproximate Weight: 395 g / 0.87 lbs', 'Keyboard-2.png'),
(83, 3, 25, 'DUCKY 69 FIRE EDITION', 2000000, 29, 'Introducing Ducky’s newest mechanical keyboard for 2014. This is an update  to the venerable Shine series with a modern look. It incorporates all the usual Ducky functionality, such as USB Repeat Acceleration, N-Key Rollover, 1000hz polling, as well as all the great backlighting effects you’ve come to expect from Ducky. With the introduction of dual color LEDs, our backlighting effects are even more colorful than before. Ducky Shine 4 continue to use the familiar Cherry MX mechanical key switches for unrivaled reliability and consistency between key presses.', 'Keyboard-3.jpg'),
(84, 3, 25, 'STEELSERIES ARCTIS NOVA PRO WIRELESS', 5650000, 29, 'Reach almighty audio levels with the Nova Pro Acoustic System and Premium High Fidelity Drivers with immersive 360° Spatial Audio*, enhanced with Sonar Software *Fully compatible with Tempest 3D audio for PS5 / Microsoft Spatial Sound\r\nActive noise cancellation fully immerses you in the gaming world by removing outside distractions with Transparency Mode as an optional toggle\r\nHot-swap between two batteries to keep playing as long as desired, never running out of power\r\nSimultaneous 2.4GHz and Bluetooth allow mixing game and mobile audio for phone calls and multimedia playback at the same time\r\nAI-powered ClearCast Gen 2 noise cancelling microphone silences background noise and keyboard sounds for pristine audio communication and a fully retractable design\r\nMulti-System Connect with dual USB ports works with PC, Mac, PlayStation, Switch and more\r\nPinpoint your enemy’s location long before you see them with Sonar a breakthrough in gaming sound', 'Headset-1.jpg'),
(85, 3, 25, 'RAZER LEVIATHAN V2', 4349000, 30, 'Multi-driver PC Soundbar and Subwoofer\r\nTHX Spatial Audio\r\nCompact Desktop Form Factor\r\n\r\nTECH SPECS:\r\n\r\nFREQUENCY RESPONSE: 45 Hz – 20 kHz\r\nINPUT POWER: External Power Adapter\r\nDRIVER SIZE – DIAMETERS (MM):\r\n• Full Range Drivers: 2 x 2.0 x 4.0″ / 48 x 95 mm\r\n• Tweeter Drivers: 2 x 0.75″ / 20 mm\r\n• Passive Radiator Drivers: 2 x 1.7 x 5.3″ / 43 x 135 mm\r\n• Down-Firing Subwoofer: 1 x 5.5″ / 140 mm\r\nDRIVER TYPE: Full range drivers, tweeters drivers, passive radiator, and subwoofer driver\r\nWEIGHT: Soundbar: 1.4 kg / 3.08 lbs – Subwoofer: 3.0 kg / 6.61 lbs\r\nTYPES: Bluetooth 5.2 (60ms low latency)\r\nUSB Audio Input to PC: COMPATIBILITY\r\nBluetooth 5.2 (60ms low latency) – USB Audio Input to PC\r\nOTHERS:\r\n• Razer Chroma™ RGB (18 zones)\r\n• THX Spatial Audio (PC based via Synapse 3)\r\n• Bluetooth 5.2 (60ms low latency)\r\n• USB audio input\r\n• Razer Audio app\r\n• Razer Chroma RGB app\r\n• Custom 10-band EQ\r\n• Raised feet on soundbar\r\n• Headphone quick toggle\r\n• Dimensions:\r\n• Soundbar: 19.7 x 3.6 x 3.3″ ', 'Speaker-1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indeks untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `OrderID` (`OrderID`,`ItemID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KategoriID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `ItemID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `produk` (`ItemID`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `kategori` (`KategoriID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
