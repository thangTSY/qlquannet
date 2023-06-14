-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 14, 2023 lúc 08:35 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlquannet`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `iddv` int(11) NOT NULL,
  `tendv` varchar(50) NOT NULL,
  `loaidv` varchar(50) NOT NULL,
  `giadv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`iddv`, `tendv`, `loaidv`, `giadv`) VALUES
(3, 'bimbim', 'Đồ ăn', 10000),
(4, 'coca', 'Đồ uống', 15000),
(5, 'mỳ tôm trứng', 'Đồ ăn', 15000),
(6, 'snack khoai tây', 'Đồ ăn', 20000),
(7, 'a', 'Khác', 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaodich`
--

CREATE TABLE `giaodich` (
  `idgd` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `idmay` int(11) NOT NULL,
  `idgiatien` int(11) NOT NULL,
  `thoigianbatdau` datetime NOT NULL,
  `thoigianketthuc` datetime NOT NULL,
  `tiendv` int(11) NOT NULL,
  `tien` int(11) NOT NULL,
  `giamgia` int(11) NOT NULL,
  `ghichu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giaodich`
--

INSERT INTO `giaodich` (`idgd`, `idkhachhang`, `idmay`, `idgiatien`, `thoigianbatdau`, `thoigianketthuc`, `tiendv`, `tien`, `giamgia`, `ghichu`) VALUES
(53, 8, 1, 3, '2023-05-13 20:52:36', '2023-05-13 21:20:12', 0, 5000, 0, ''),
(54, 11, 2, 3, '2023-05-13 20:52:45', '2023-05-13 23:15:12', 15000, 38000, 5, ''),
(55, 9, 3, 3, '2023-05-13 20:54:57', '2023-05-13 20:55:12', 15000, 16000, 0, ''),
(56, 9, 3, 3, '2023-05-13 21:19:45', '2023-05-13 23:15:18', 0, 20000, 0, ''),
(57, 9, 1, 3, '2023-05-13 21:22:08', '2023-05-13 21:22:30', 0, 1000, 0, ''),
(58, 9, 1, 3, '2023-05-13 21:23:33', '2023-05-13 21:24:02', 15000, 16000, 0, ''),
(59, 9, 1, 3, '2023-05-13 21:26:24', '2023-05-13 21:27:27', 35000, 36000, 0, ''),
(60, 8, 1, 3, '2023-05-13 21:32:05', '2023-05-13 21:33:20', 35000, 36000, 0, ''),
(61, 8, 1, 3, '2023-05-13 21:35:11', '2023-05-13 21:36:21', 35000, 36000, 0, ''),
(62, 8, 4, 3, '2023-05-13 21:38:45', '2023-05-13 21:40:06', 35000, 36000, 0, ''),
(63, 0, 6, 3, '2023-05-13 21:42:23', '2023-05-13 21:42:30', 0, 1000, 0, ''),
(64, 8, 1, 3, '2023-05-13 23:15:47', '2023-05-13 23:15:53', 0, 1000, 0, ''),
(65, 0, 1, 3, '2023-05-14 02:06:49', '2023-05-14 02:07:11', 0, 1000, 0, ''),
(66, 9, 1, 3, '2023-05-14 13:01:56', '2023-05-14 13:02:49', 0, 1000, 0, ''),
(67, 9, 5, 3, '2023-05-14 15:06:34', '2023-05-14 15:53:34', 15000, 23000, 0, ''),
(68, 10, 7, 3, '2023-05-14 15:06:46', '0000-00-00 00:00:00', 0, 0, 5, ''),
(69, 8, 4, 3, '2023-05-14 15:08:58', '2023-05-14 15:09:53', 35000, 36000, 0, ''),
(70, 8, 1, 3, '2023-05-14 15:13:08', '2023-05-14 15:14:42', 55000, 56000, 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giatien`
--

CREATE TABLE `giatien` (
  `idgiatien` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giatien`
--

INSERT INTO `giatien` (`idgiatien`, `gia`) VALUES
(1, 10000),
(2, 0),
(3, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maytinh`
--

CREATE TABLE `maytinh` (
  `idmay` int(11) NOT NULL,
  `tenmay` varchar(50) NOT NULL,
  `tinhtrang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `maytinh`
--

INSERT INTO `maytinh` (`idmay`, `tenmay`, `tinhtrang`) VALUES
(1, 'Máy 01', 'Bình thường'),
(2, 'Máy 02', 'Bình thường'),
(3, 'Máy 03', 'Hỏng'),
(4, 'Máy 04', 'Bình thường'),
(5, 'Máy 05', 'Bình thường'),
(6, 'Máy 06', 'Bình thường'),
(7, 'Máy 07', 'Bình thường'),
(8, 'Máy 08', 'Bình thường'),
(9, 'Máy 09', 'Bình thường'),
(10, 'Máy 10', 'Bình thường'),
(11, 'Máy 11', 'Bình thường'),
(12, 'Máy 12', 'Bình thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sudungdichvu`
--

CREATE TABLE `sudungdichvu` (
  `idsd` int(11) NOT NULL,
  `idmay` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `iddv` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `taikhoan` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `loaitaikhoan` varchar(50) NOT NULL,
  `ghichu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`taikhoan`, `matkhau`, `loaitaikhoan`, `ghichu`) VALUES
('1', '1', 'Bình thường', ''),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Bình thường', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinkhachhang`
--

CREATE TABLE `thongtinkhachhang` (
  `idkh` int(11) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `thoigiandangky` date NOT NULL,
  `loaikhachhang` varchar(50) NOT NULL,
  `gioitinh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinkhachhang`
--

INSERT INTO `thongtinkhachhang` (`idkh`, `hoten`, `username`, `password`, `thoigiandangky`, `loaikhachhang`, `gioitinh`) VALUES
(7, 'Hoàng Sang', 'sang', '1', '2023-05-14', 'Thân thuộc', ''),
(8, 'Đình Thắng', 'thang', '1', '2023-05-14', 'Bình thường', ''),
(9, 'Chu Hưng', 'hung', '1', '2023-05-14', 'Bình thường', ''),
(10, 'huy quang', 'huy', '1', '2023-05-14', 'Thân thuộc', ''),
(11, 'Đình Thắng33', '33', '33', '2023-05-14', 'Thân thuộc', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`iddv`);

--
-- Chỉ mục cho bảng `giaodich`
--
ALTER TABLE `giaodich`
  ADD PRIMARY KEY (`idgd`),
  ADD KEY `idgiatien` (`idgiatien`),
  ADD KEY `idkhachhang` (`idkhachhang`),
  ADD KEY `idmay` (`idmay`);

--
-- Chỉ mục cho bảng `giatien`
--
ALTER TABLE `giatien`
  ADD PRIMARY KEY (`idgiatien`);

--
-- Chỉ mục cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  ADD PRIMARY KEY (`idmay`);

--
-- Chỉ mục cho bảng `sudungdichvu`
--
ALTER TABLE `sudungdichvu`
  ADD PRIMARY KEY (`idsd`),
  ADD KEY `sudungdichvu_ibfk_1` (`iddv`),
  ADD KEY `idkhachhang` (`idkhachhang`),
  ADD KEY `idmay` (`idmay`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`taikhoan`);

--
-- Chỉ mục cho bảng `thongtinkhachhang`
--
ALTER TABLE `thongtinkhachhang`
  ADD PRIMARY KEY (`idkh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `iddv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `giaodich`
--
ALTER TABLE `giaodich`
  MODIFY `idgd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `giatien`
--
ALTER TABLE `giatien`
  MODIFY `idgiatien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  MODIFY `idmay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `sudungdichvu`
--
ALTER TABLE `sudungdichvu`
  MODIFY `idsd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `thongtinkhachhang`
--
ALTER TABLE `thongtinkhachhang`
  MODIFY `idkh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
