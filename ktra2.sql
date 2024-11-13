-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 09:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktra2`
--

-- --------------------------------------------------------

--
-- Table structure for table `datlaimk`
--

CREATE TABLE `datlaimk` (
  `MaToken` int(10) NOT NULL,
  `MaTK` int(10) NOT NULL,
  `Token` char(6) NOT NULL,
  `TgTao` datetime NOT NULL,
  `TgHethan` datetime NOT NULL,
  `TrangThai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datlaimk`
--

INSERT INTO `datlaimk` (`MaToken`, `MaTK`, `Token`, `TgTao`, `TgHethan`, `TrangThai`) VALUES
(1, 10, '389783', '2024-10-27 12:05:51', '2024-10-28 12:05:51', 0),
(2, 11, '909714', '2024-10-27 12:05:51', '2024-10-28 12:05:51', 0),
(3, 13, '379225', '2024-10-27 12:05:51', '2024-10-28 12:05:51', 1),
(4, 8, '166982', '2024-10-27 12:05:51', '2024-10-28 12:05:51', 1),
(5, 5, '697236', '2024-10-27 12:05:51', '2024-10-28 12:05:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thongtincanhan`
--

CREATE TABLE `thongtincanhan` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `Diachi` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SDT` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thongtincanhan`
--

INSERT INTO `thongtincanhan` (`MaKH`, `TenKH`, `NgaySinh`, `Diachi`, `Email`, `SDT`) VALUES
(1, 'Nguyễn Văn An', '1990-01-01', 'Hà Nội', 'an@gmail.com', '0912345678'),
(2, 'Trần Văn Tùng', '2000-10-10', 'Hà Nội', 'tung@gmail.com', '0912345687'),
(3, 'Lê Thị Tuyết', '1991-11-11', 'Đà Nẵng', 'tuyet1@gmail.com', '0912345688'),
(4, 'Phạm Văn Lộc', '1992-12-12', 'Hồ Chí Minh', 'loc@gmail.com', '0912345689'),
(5, 'Nguyễn Văn Kiên', '1993-01-13', 'Hải Phòng', 'kien@gmail.com', '0912345690'),
(6, 'Trần Thị Nhung', '1994-02-14', 'Cần Thơ', 'nhung@gmail.com', '0912345691'),
(7, 'Lê Văn Sơn', '1995-03-15', 'Nha Trang', 'son@gmail.com', '0912345692'),
(8, 'Phạm Thị Thủy', '1996-04-16', 'Vũng Tàu', 'thuy@gmail.com', '0912345693'),
(9, 'Nguyễn Văn Hải', '1997-05-17', 'Thành phố Hồ Chí Minh', 'hai@gmail.com', '0912345694'),
(10, 'Trần Thị Dung', '1998-06-18', 'Quy Nhơn', 'dung@gmail.com', '0912345695'),
(11, 'Lê Văn Đạt', '1999-07-19', 'Hà Nội', 'dat@gmail.com', '0912345696'),
(12, 'Trần Thị Bích', '1992-02-02', 'Đà Nẵng', 'bich@gmail.com', '0912345679'),
(13, 'Phạm Thị Hằng', '2000-08-20', 'Đà Nẵng', 'hang@gmail.com', '0912345697'),
(14, 'Lê Quang Huy', '1993-03-03', 'Hồ Chí Minh', 'huy@gmail.com', '0912345680'),
(15, 'Phạm Thị Hoa', '1994-04-04', 'Hải Phòng', 'hoa@gmail.com', '0912345681'),
(16, 'Nguyễn Thị Lan', '1995-05-05', 'Cần Thơ', 'lan@gmail.com', '0912345682'),
(17, 'Ngô Văn Khải', '1996-06-06', 'Nha Trang', 'khai@gmail.com', '0912345683'),
(18, 'Đinh Thị Thảo', '1997-07-07', 'Vũng Tàu', 'thao@gmail.com', '0912345684'),
(19, 'Bùi Văn Minh', '1998-08-08', 'Thành phố Hồ Chí Minh', 'minh@gmail.com', '0912345685'),
(20, 'Nguyễn Thị Hương', '1999-09-09', 'Quy Nhơn', 'huong@gmail.com', '0912345686');

-- --------------------------------------------------------

--
-- Table structure for table `thongtincanhan_tam`
--

CREATE TABLE `thongtincanhan_tam` (
  `TokenEmail` varchar(255) NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(300) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SDT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thongtintaikhoan`
--

CREATE TABLE `thongtintaikhoan` (
  `MaTK` int(11) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(60) NOT NULL,
  `NgayTao` datetime NOT NULL,
  `NguoiTao` varchar(50) NOT NULL,
  `NgaySua` datetime NOT NULL,
  `NguoiSua` varchar(50) NOT NULL,
  `PhanQuyen` varchar(10) NOT NULL,
  `TrangThaiHoatDong` tinyint(1) NOT NULL,
  `TrangThaiXacThuc` tinyint(1) NOT NULL,
  `TokenEmail` varchar(64) NOT NULL,
  `ThoiGianTokenEmail` datetime NOT NULL,
  `Solansaidangnhap` int(11) DEFAULT NULL,
  `Tokenluudangnhap` varchar(50) DEFAULT NULL,
  `Ngayhethantoken` datetime DEFAULT NULL,
  `Lanchothulai` datetime DEFAULT NULL,
  `Tokenxacnhan` varchar(100) DEFAULT NULL,
  `Ngayhethanxacnhan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thongtintaikhoan`
--

INSERT INTO `thongtintaikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `NgayTao`, `NguoiTao`, `NgaySua`, `NguoiSua`, `PhanQuyen`, `TrangThaiHoatDong`, `TrangThaiXacThuc`, `TokenEmail`, `ThoiGianTokenEmail`, `Solansaidangnhap`, `Tokenluudangnhap`, `Ngayhethantoken`, `Lanchothulai`, `Tokenxacnhan`, `Ngayhethanxacnhan`) VALUES
(1, 'an_tk1', '$2a$12$Rseh2gmelUDob6dfmUfTz.H08Os6jxyQolHL.78ST8AfH1oGlq9/u', '2024-10-27 11:07:25', 'an_tk', '2024-11-13 14:08:51', 'an_tk1', 'admin', 1, 1, '5a5b93951852c428d44107bb6caaa1d99752200c2c3b276892937b04379ab1ce', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'tung_tk2', '$2a$12$/mFz.ol.rZXLhq8OtA7E1uG4whUrhyx92fPcTjpnXrcfZNBg7/dA2', '2024-10-27 11:07:25', 'tung_tk', '2024-11-12 10:19:27', '', 'user', 1, 1, 'a13141107992db605226f6f523d417804c97743493517801d79e21c79422a9f6', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'tuyet_tk1', '$2a$12$BwnIoc9WH/goE8VniONbvu1ypR8kCbKGdyHvGdLRHZ3JzqfX5R3Hu', '2024-10-27 11:07:25', 'tuyet_tk', '2024-11-12 10:18:17', '', 'user', 1, 1, '8077dd88c202725577bfe92c56cea42d3b97ae94845cc5335642d042e91a513c', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'loc_tk', '$2a$12$IsDwtUaj5rvelJLmEMTcT.0uRvVFJ57PGV6n7NH9bg51go5fC4KQ.', '2024-10-27 11:07:25', 'loc_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, '4c50872195b92f651fe601543fc2b0e99b2bcb33b415bfc626e7433a94c8afca', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'kien_tk', '$2a$12$iih5Ufzvai.UhhCj9knSauoUZqi2L/f226JsPC3uK8LNGp8TXGQce', '2024-10-27 11:07:25', 'kien_tk', '2024-10-27 12:07:15', 'kien_tk', 'user', 1, 1, '953d5e7d71b8973ea27e92b72f9151fa47bd3d5be9d49c683056a820fa8baa82', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'nhung_tk', '$2a$12$vavmhZC0YPNzDwc3sEB35.FTKm/jMSWbQSe7FhDwZMJz6nFHiL4fe', '2024-10-27 11:07:25', 'nhung_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, 'b589cbe660e6f981d1cccd95e3e0cde62e3d82a8a3aafa63d071705db16ed0cd', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'son_tk', '$2a$12$.5Bz4cM2qjhFmwZ4zjAStOjLjFsf0TLlm6KhNu2jx3M6WFcltkHTK', '2024-10-27 11:07:25', 'son_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, '8b8fea6e5af8715f09bfbdf18b5d771a86caab2a98e03111da42623d2e8b1fe1', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'thuy_tk', '$2a$12$RGxHeumzqPs.dOz7nOgV../7NXEzxAyDKQiWUPqp.BT2lwHAFyx2m', '2024-10-27 11:07:25', 'thuy_tk', '2024-10-27 12:07:15', 'thuy_tk', 'user', 1, 1, '4cadffbbd6fcae05ee3f5254a297c3fae6174c50744b10031e4d6224495d468a', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'hai_tk', '$2a$12$BO.Yb.sjp5WSiCYX7S2Z6eURguIA.Y8ZiJU8fCkFs8KNJ3.zKINUK', '2024-10-27 11:07:25', 'hai_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, '5308264e5f24fa5a568f5b7db986bdb4a76d47723be7c607faeb7765b4ba5ff7', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'dung_tk', '$2a$12$8al4lZvcPIMJ0qbG8P6kcOK5nrVnVLtk3keSHGx1QpTkFWLL7Biee', '2024-10-27 11:07:25', 'dung_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, '95e22ed3f976b470e952493b2fa3f2054c4b3a47ef4bf3816ba312f75f3b621f', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'dat_tk', '$2a$12$Vc5h1wJF4CUdvAO/e65eZ.6GuBN8fUvR8TlFHqtdvF9.KdPW23zoq', '2024-10-27 11:07:25', 'dat_tk', '0000-00-00 00:00:00', '', 'user', 1, 1, 'a57e88be72a81cfc9c3d0f7e81a94f1ef6102081b64a677afc843406fb950242', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'bich_tk', '$2a$12$vx8oeZyj5MiOdRbDFy0MTOoFjjVSGmWyByOF3wOzLz.HQsGa8jI7K', '2024-10-27 11:07:25', 'bich_tk', '0000-00-00 00:00:00', '', 'admin', 1, 1, '838ffa7a80ac13996ad19cc3fd65a7d292474ab5d0844f00aec8d01afa83cf8a', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'hang_tk', '$2a$12$xaI45/.GwxfTyaU9I2mXjumXwGbtrdpFUesAvn14S9/HisMNzhRKC', '2024-10-27 11:07:25', 'hang_tk', '2024-10-27 12:07:15', 'hang_tk', 'user', 1, 1, '848d60e5b26ca723d4dc899b46de2f718f196fe55e65aaf779dfeef129c1efff', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'huy_tk', '$2a$12$q9X3xW5yk9a5GDtHneP/yuYJwhry4iGr71Y3sags30uhajR7npu/.', '2024-10-27 11:07:25', 'huy_tk', '0000-00-00 00:00:00', '', 'admin', 1, 1, '2e02d06d8aaf1b30744484f515b8ea01d1e0dc4a6927b057d226a843119fe98c', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'hoa_tk', '$2a$12$q3Ws5/wPdruDNJXlHLh.d.gCrNwhptVjmzxT9tKnlkmEu9flIZvqe', '2024-10-27 11:07:25', 'hoa_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, '74599ba3b00297fc82d87e6a1c39d4547b818d2b9fd576850668651463f8a40c', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'lan_tk', '$2a$12$sdFcrZC6of6.6ELwcl9t0ea0EZooZXC0NQAUe8RFflMo1Fekm40Fa', '2024-10-27 11:07:25', 'lan_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, '90ebc32ac722b7f14c692c1b93203bec893b75fee5e4aa014025a10be834f184', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'khai_tk', '$2a$12$v/iq9cD5S9uRMHVyGEz3g.Qdf1UvOV1jzo8sAHeQWUNRKRIJbY4Rm', '2024-10-27 11:07:25', 'khai_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, 'c87af0a315f8c91b3801cbc5e5ed7481c19720049018e9e3edc13c921390ae2b', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'thao_tk', '$2a$12$pTdYsc2pp.N5QcEIbhm1RegfhnJO6Os5f28VFbo3s5cMQwb5XbVnG', '2024-10-27 11:07:25', 'thao_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, '17609752e553e3875409c4f38e7b30ae6d62ab0217a7a7e0027f1c5df0fd1698', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'minh_tk', '$2a$12$bjAvzoiK3uZHYO7J4TjTMuAkw/qz2VlbLDbXUeqc95J3IOPGBy4em', '2024-10-27 11:07:25', 'minh_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, 'a54eb168443b46e741a7b520d92c10306568133345540acce6fd0888d3cb6dad', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'huong_tk', '$2a$12$LXke9cDojwEhTM7laNUnUurpCjtcDi0DSP2vGLvTOJ6Qke0Uc0iCW', '2024-10-27 11:07:25', 'huong_tk', '0000-00-00 00:00:00', '', 'user', 0, 0, 'dcdd125559d4eba8ca79368971c636ddff9c01e216fb165a2ee0a114c8e014c9', '2024-10-27 11:07:25', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thongtintaikhoan_tam`
--

CREATE TABLE `thongtintaikhoan_tam` (
  `TenDangNhap` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `TokenEmail` varchar(255) NOT NULL,
  `ThoiGianTokenEmail` datetime NOT NULL,
  `ThoiGianHieuLuc` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datlaimk`
--
ALTER TABLE `datlaimk`
  ADD PRIMARY KEY (`MaToken`),
  ADD KEY `FK_MaTK` (`MaTK`);

--
-- Indexes for table `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `thongtintaikhoan`
--
ALTER TABLE `thongtintaikhoan`
  ADD PRIMARY KEY (`MaTK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datlaimk`
--
ALTER TABLE `datlaimk`
  MODIFY `MaToken` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `thongtintaikhoan`
--
ALTER TABLE `thongtintaikhoan`
  MODIFY `MaTK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datlaimk`
--
ALTER TABLE `datlaimk`
  ADD CONSTRAINT `FK_MaTK` FOREIGN KEY (`MaTK`) REFERENCES `thongtintaikhoan` (`MaTK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
