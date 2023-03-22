-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 22, 2023 lúc 03:50 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `banhang_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Email`, `Password`, `Role`) VALUES
(1, 'Thang', 'Thang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Thang', 'Thang1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `BrandId` int(11) NOT NULL,
  `BrandName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`BrandId`, `BrandName`, `Image`, `Status`) VALUES
(2, 'Bánh kem Tous Les Jours', '23fa8e56c2.cart-2.jpg', 0),
(87, 'Campus', '721b8284e2.product-9.jpg', 0),
(88, 'Samsung', '80ca2ccd8e.product-7.jpg', 1),
(90, 'banhs kem ngon1', '21e6742c95.cart-4.jpg', 0),
(91, 'banhs kem1234', '3139b241e5.product-12.jpg', 0),
(92, 'banhs kem ngon lamw', '655a2cd874.product-10.jpg', 0),
(93, 'banhs kem ngon1', '7492f5ea4c.product-9.jpg', 0),
(94, 'banhs kem ngon', 'b24603cd67.product-5.jpg', 0),
(95, 'banhs kem', '1678695676_product-4.jpg', 0),
(96, 'castella', 'ec7a613fec.product-8.jpg', 1),
(97, 'VUS', 'aa12716b1a.cart-2.jpg', 1),
(99, 'banhs kem ngon', '1678727174_product-3.jpg', 0),
(100, 'banhs kem ngon1', '1678758892_product-2.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CategoryId`, `CategoryName`, `status`) VALUES
(2, 'Cakes', 1),
(3, 'Donuts', 1),
(4, 'Butter Cakes', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `ContactId` int(11) NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`ContactId`, `UserName`, `Email`, `Message`) VALUES
(3, 'banhs kem ngon1', 'hongthuy004@gmail.com', 'ádfghj'),
(4, 'banhs kem ngon1', 'nguyenhung16052001@gmail.com', 'sdfghj');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL,
  `Fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` char(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date_Login` datetime NOT NULL,
  `Date_Logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`CustomerId`, `Fullname`, `Image`, `PhoneNumber`, `Address`, `Status`, `Email`, `Password`, `Date_Login`, `Date_Logout`) VALUES
(1, 'hung', '0', '', '', 0, 'hung@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-03-22 09:41:38', '2023-03-22 09:42:04'),
(2, 'thang', '', '0123456789', 'tp.hcm', 1, 'thangkhung@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2023-03-22 09:42:12', '0000-00-00 00:00:00'),
(3, 'hung', '', '', '', 1, 'hung1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-03-22 12:43:28', '2023-03-22 11:16:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oders`
--

CREATE TABLE `oders` (
  `OderId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `total_price` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `oders`
--

INSERT INTO `oders` (`OderId`, `CustomerId`, `Note`, `order_date`, `address`, `number_phone`, `status`, `total_price`) VALUES
(72, 3, ' ', '2023-03-22 15:57:06', 'TP.HCM', '0123456789', 0, 181);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `Order_Detail_Id` int(11) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT 1,
  `Price` float NOT NULL DEFAULT 0,
  `Quantity` int(11) NOT NULL DEFAULT 0,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`Order_Detail_Id`, `Status`, `Price`, `Quantity`, `ProductId`) VALUES
(72, 1, 20, 3, 6),
(72, 1, 121, 1, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `BuyPrice` float NOT NULL,
  `SellPrice` float NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `CountView` int(11) NOT NULL DEFAULT 0,
  `CategoriId` int(11) NOT NULL,
  `BrandId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ProductId`, `Name`, `Image`, `Quantity`, `Description`, `BuyPrice`, `SellPrice`, `Status`, `CountView`, `CategoriId`, `BrandId`) VALUES
(6, 'banhs kem', 'f57d9c2d03.product-2.jpg', 10, 'fdfd', 100, 20, 1, 29, 2, 2),
(7, 'banhs kem ngon', '5c89eaeba6.product-big-2.jpg', 10, 'hhjhj', 12, 13, 1, 49, 2, 2),
(8, 'banhs kem', '69dd6840bc.product-8.jpg', 100, 'adsfghj', 100, 200, 1, 11, 4, 2),
(9, 'Bánh kem Tous Les', '36d3356f46.product-7.jpg', 100, 'bánh kem rất ngon', 10, 20, 1, 23, 2, 2),
(10, 'banhs kem', '761ab9c3d8.product-big-1.jpg', 55, 'gfgfg', 100, 3224, 1, 26, 3, 2),
(11, 'banhs kem ngon', '543148f7b1.product-1.jpg', 100, 'done', 100, 121, 1, 22, 3, 88),
(12, 'banhs kem ngon lamw', '14ab6574fc.product-9.jpg', 100, 'sdf', 100, 121, 1, 19, 2, 88),
(13, 'banhs kem ngon', '1678766983_product-1.jpg', 100, 'sdsddjcshjshs', 100, 121, 1, 8, 3, 97);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receipts`
--

CREATE TABLE `receipts` (
  `ReceiptId` int(11) NOT NULL,
  `ImportDate` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `RoleId` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`RoleId`, `Name`, `Description`) VALUES
(1, 'Admin', 'Control everything'),
(2, 'SubAdmin', 'Control less than Admin\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `WishListId` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role` (`Role`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BrandId`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ContactId`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Chỉ mục cho bảng `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`OderId`),
  ADD KEY `FK_Customer_Id` (`CustomerId`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `ProductId` (`ProductId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `FK_Brand_Id` (`BrandId`),
  ADD KEY `FK_Categori_Id` (`CategoriId`);

--
-- Chỉ mục cho bảng `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `FK_Product_Id` (`ProductId`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishListId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `oders`
--
ALTER TABLE `oders`
  MODIFY `OderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `receipts`
--
ALTER TABLE `receipts`
  MODIFY `ReceiptId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishListId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `roles` (`RoleId`);

--
-- Các ràng buộc cho bảng `oders`
--
ALTER TABLE `oders`
  ADD CONSTRAINT `FK_Customer_Id` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustomerId`);

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FK_Product_Id_01` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_Brand_Id` FOREIGN KEY (`BrandId`) REFERENCES `brands` (`BrandId`),
  ADD CONSTRAINT `FK_Categori_Id` FOREIGN KEY (`CategoriId`) REFERENCES `category` (`CategoryId`);

--
-- Các ràng buộc cho bảng `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `FK_Product_Id` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `CustomerId` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustomerId`),
  ADD CONSTRAINT `ProductId` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
