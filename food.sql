-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 08:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL DEFAULT current_timestamp(),
  `age` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `reset_token` varchar(100) NOT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `username`, `email`, `password`, `role`, `dateOfBirth`, `age`, `avatar`, `reset_token`, `token_expiry`) VALUES
('6569b2c6c676d', 'Dương đẹp trai', 'aduong88999@gmail.com', '$2y$10$Zdj7i.mMtXUkvjPumA1hfuE3Fh6uqn17Y42EMYrRicRDZ3XbTo9GS', 'Khach hang', '2023-12-13', 22, 'AVATAR-65786247108432.40608857.png', 'd5f818e2a170de3c3a07be0a5253365a', '2023-12-13 09:20:52'),
('657034e16a714', 'Dương', 'duong88999@st.vimaru.edu.vn', '$2y$10$Zdj7i.mMtXUkvjPumA1hfuE3Fh6uqn17Y42EMYrRicRDZ3XbTo9GS', 'Khach hang', '2023-12-19', 22, 'AVATAR-657034e16a7212.55436231.png', '', NULL),
('6505059f47b72', 'Dương', 'duong@gmail.com', '$2y$10$Zdj7i.mMtXUkvjPumA1hfuE3Fh6uqn17Y42EMYrRicRDZ3XbTo9GS', 'admin', '2222-01-31', 10, 'AVATAR-65795afc76b4c1.77042496.jpg', '', NULL),
('65485d7f3e259', 'tuan anh', 'ta@gmail.com', '$2y$10$Zdj7i.mMtXUkvjPumA1hfuE3Fh6uqn17Y42EMYrRicRDZ3XbTo9GS', 'Khach hang', '2023-11-17', 21, 'AVATAR-65485d7f3e2625.63180858.png', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favor`
--

CREATE TABLE `favor` (
  `id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `food_id` varchar(100) NOT NULL,
  `isfavorite` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favor`
--

INSERT INTO `favor` (`id`, `user_id`, `food_id`, `isfavorite`) VALUES
('64fe7c9469911', '64fd3719da62d', 'FOOD-64dc4df9d78019.90048123', 'true'),
('64fe7c96b8321', '64fd3719da62d', 'FOOD-64f1a64fdd9a45.42482028', 'true'),
('64fe849b0f54a', '64fd3719da62d', 'FOOD-64e2d2a91127e5.90595077', 'true'),
('6505302233cc4', '64fd3719da62d', 'FOOD-64dc5047713551.18237380', 'true'),
('6505633ae8542', '64fd3719da62d', 'FOOD-64dc4f05975970.87442492', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` varchar(300) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `detail` varchar(500) NOT NULL,
  `image` text NOT NULL,
  `flavor` int(5) NOT NULL,
  `price_medium` double NOT NULL,
  `price_large` double NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `type`, `price`, `detail`, `image`, `flavor`, `price_medium`, `price_large`, `state`) VALUES
('FOOD-64dc4f05975970.87442492', 'Hot dogs', 'Fastfood', 1.5, 'Xúc xích bọc trong bánh mì, thường ăn kèm với sốt cà chua, hành tây băm và các loại gia vị khác. Món ăn tiện lợi và ngon miệng.', 'IMG-65694fb1eba4a0.78716939.png', 0, 2, 2.5, 1),
('FOOD-64dc5047713551.18237380', 'Pizza xúc xích', 'Fastfood', 4, 'Pizza xúc xích là một biến thể của pizza truyền thống, với lớp bột nướng giòn, sốt cà chua, lớp phô mai và xúc xích là thành phần chính.', 'IMG-65438d24ae5e69.79382985.png', 0, 0, 0, 1),
('FOOD-64e1769445fd66.80419356', 'Bánh quy sôcôla', 'Snacks', 2.5, 'Bánh quy sôcôla thường có hình dạng phẳng và được làm từ bột mì, đường và sôcôla nấu chảy', 'IMG-64e1769445feb1.54251949.png', 5, 0, 0, 0),
('FOOD-64e177174760f4.45001576', 'Bánh quế', 'Snacks', 1.5, 'Bánh quế là một loại bánh nhỏ, có mùi thơm của quế và gia vị ấm áp. Bề mặt bánh thường được rắc đường và gia vị trước khi nướng, tạo nên lớp vỏ giòn và hương vị độc đáo.', 'IMG-64e177174761e4.88442180.png', 2, 0, 0, 0),
('FOOD-64e17782c3be52.73180343', 'Popcorn', 'Snacks', 3, 'Popcorn là nguyên liệu bắt nguồn từ hạt ngô, khi nung chảy tạo nên hạt bắp giòn và phồng ra.', 'IMG-64e17782c3c029.59685946.png', 5, 0, 0, 0),
('FOOD-64e177e7279351.15108658', 'Kẹo dẻo', 'Snacks', 2, 'Kẹo dẻo là loại kẹo mềm, có độ đàn hồi và dẻo, thường có hình dạng và màu sắc đa dạng. ', 'IMG-64e177e7279478.24519179.png', 3, 0, 0, 0),
('FOOD-64e178380debb0.22367360', 'Bánh mì que', 'Snacks', 3, 'Bánh mì que là một loại bánh mì dẹt, có hình dáng dạng que, thường có lớp vỏ giòn và bên trong mềm mịn.', 'IMG-64e178380decc4.73789825.png', 2, 0, 0, 0),
('FOOD-64e2d2a91127e5.90595077', 'Trà đào', 'Drink', 3.5, 'Trà Đào là một đồ uống giải khát được làm từ nước ép hoặc nước cốt đào tươi, thường kết hợp với đá và đường', 'IMG-64e2d2a9114921.36409699.png', 4, 0, 0, 0),
('FOOD-64f19c6eb66863.61994584', 'Gà rán', 'Fastfood', 4.2, 'Gà rán là một món ăn nhanh phổ biến được làm từ miếng gà được chế biến qua quá trình rang giòn', 'IMG-64f19c6eb66c38.76867567.png', 5, 0, 0, 0),
('FOOD-64f1a64fdd9a45.42482028', 'Cá viên chiên', 'Fastfood', 2.4, 'Cá viên chiên là một món ăn nhanh phổ biến ở Anh. Nó bao gồm miếng cá viên tươi hoặc cá tươi, được bao bọc bởi lớp bột chiên giòn', 'IMG-64f1a64fde7658.92124998.png', 5, 0, 0, 0),
('FOOD-6541f951d3f231.86007598', 'Chicken Burger', 'Fastfood', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f951d3f371.23949833.png', 3, 3.6, 4, 0),
('FOOD-6541f96e786993.62765624', 'Fatboy Burger', 'Fastfood', 3.4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f96e786b04.71791648.png', 5, 3.8, 4.2, 0),
('FOOD-6541f98370ca17.59820849', 'Classic Smash', 'Fastfood', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f98370cb79.30113517.png', 0, 4.3, 4.6, 0),
('FOOD-6541f99837d818.08538129', 'Burger Nine', 'Fastfood', 2.3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f99837dcd2.71739338.png', 0, 2.7, 3.1, 0),
('FOOD-6541f9ad73d646.68761419', 'Beef Burger', 'Fastfood', 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f9ad73d875.10054564.png', 0, 5.3, 5.5, 0),
('FOOD-6541f9bed38f43.05468763', 'Bacon Burger', 'Fastfood', 3.3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'IMG-6541f9bed39275.17599029.png', 0, 3.7, 4.2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(300) NOT NULL,
  `user_id` varchar(300) NOT NULL,
  `food_order` varchar(100) NOT NULL,
  `type` varchar(300) NOT NULL,
  `time` datetime NOT NULL,
  `total_price` float NOT NULL,
  `image` varchar(300) NOT NULL,
  `number_order` int(11) NOT NULL,
  `food_id` text NOT NULL,
  `state` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `current_price` double NOT NULL,
  `hoten` varchar(200) NOT NULL,
  `sdt` varchar(200) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `type`) VALUES
(1, 'FastFood'),
(2, 'Snack'),
(3, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `salefigure`
--

CREATE TABLE `salefigure` (
  `id` varchar(300) NOT NULL,
  `nameFood` text NOT NULL,
  `type` text NOT NULL,
  `totalPrice` float NOT NULL,
  `foodid` text NOT NULL,
  `numberSold` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salefigure`
--

INSERT INTO `salefigure` (`id`, `nameFood`, `type`, `totalPrice`, `foodid`, `numberSold`, `date`) VALUES
('64fa90b3bdefc', 'Burger gà', 'Fastfood', 20, 'FOOD-64dc4df9d78019.90048123', 8, '2023-09-08 10:10:43'),
('64fed533eca30', 'Trà đào', 'Drink', 17.5, 'FOOD-64e2d2a91127e5.90595077', 1, '2023-09-11 15:52:03'),
('64fed54f8b80d', 'Hot dogs', 'Fastfood', 27, 'FOOD-64dc4f05975970.87442492', 23, '2023-09-11 15:52:31'),
('64fed55069861', 'Cá viên chiên', 'Fastfood', 12, 'FOOD-64f1a64fdd9a45.42482028', 5, '2023-09-11 15:52:32'),
('64fed5513f23d', 'Pizza xúc xích', 'Fastfood', 16, 'FOOD-64dc5047713551.18237380', 4, '2023-09-11 15:52:33'),
('6501483994598', 'Bánh quy sôcôla', 'Snacks', 17.5, 'FOOD-64e1769445fd66.80419356', 14, '2023-09-13 12:27:21'),
('6503b33101472', 'Bánh mì que', 'Snacks', 15, 'FOOD-64e178380debb0.22367360', 5, '2023-09-15 08:28:17'),
('6503b7e58d703', 'Burger cổ điển', 'Fastfood', 17.4, 'FOOD-64dd8a8693bfb9.73850315', 6, '2023-09-15 08:48:21'),
('6505051816822', 'Popcorn', 'Snacks', 3, 'FOOD-64e17782c3be52.73180343', 1, '2023-09-16 08:30:00'),
('650505181758d', 'Bánh quế', 'Snacks', 1.5, 'FOOD-64e177174760f4.45001576', 1, '2023-09-16 08:30:00'),
('650532466dfdf', 'Khoai tây chiên', 'Snacks', 6, 'FOOD-64e1761b16bf60.20568790', 3, '2023-09-16 11:42:46'),
('6547094f2cbe2', 'Cá viên chiên', 'Fastfood', 9.6, 'FOOD-64f1a64fdd9a45.42482028', 4, '2023-11-05 10:17:35'),
('654709ba4fbe6', 'Beef Burger', 'Fastfood', 12.4, 'FOOD-6541f9ad73d646.68761419', 2, '2023-11-05 10:19:22'),
('654709db833dc', 'Bacon Burger', 'Fastfood', 9.9, 'FOOD-6541f9bed38f43.05468763', 3, '2023-11-05 10:19:55'),
('6547162044fe7', 'Fatboy Burger', 'Fastfood', 2.72, 'FOOD-6541f96e786993.62765624', 1, '2023-11-05 11:12:16'),
('65471620468dd', 'Classic Smash', 'Fastfood', 3.16, 'FOOD-6541f98370ca17.59820849', 1, '2023-11-05 11:12:16'),
('65471620493cc', 'Burger Nine', 'Fastfood', 1.61, 'FOOD-6541f99837d818.08538129', 1, '2023-11-05 11:12:16'),
('654718ecab6aa', 'Pizza xúc xích', 'Fastfood', 9.6, 'FOOD-64dc5047713551.18237380', 3, '2023-11-05 11:24:12'),
('6547197a10448', 'Burger cổ điển', 'Fastfood', 4.64, 'FOOD-64dd8a8693bfb9.73850315', 2, '2023-11-05 11:26:34'),
('654719b397d2f', 'Chicken Burger', 'Fastfood', 6, 'FOOD-6541f951d3f231.86007598', 2, '2023-11-05 11:27:31'),
('654719b3a609d', 'Gà rán', 'Fastfood', 8.4, 'FOOD-64f19c6eb66863.61994584', 2, '2023-11-05 11:27:31'),
('65694656c63e3', 'Hot dogs', 'Fastfood', 28.35, 'FOOD-64dc4f05975970.87442492', 17, '2023-12-01 09:35:02'),
('6569515b1bc62', 'Beef Burger', 'Fastfood', 41, 'FOOD-6541f9ad73d646.68761419', 10, '2023-12-01 10:22:03'),
('656955f8b1adb', 'Chicken Burger', 'Fastfood', 42, 'FOOD-6541f951d3f231.86007598', 12, '2023-12-01 10:41:44'),
('6569597cd3aab', 'Burger Nine', 'Fastfood', 10.5, 'FOOD-6541f99837d818.08538129', 6, '2023-12-01 10:56:44'),
('6569ac8fd2400', 'Fatboy Burger', 'Fastfood', 9.76, 'FOOD-6541f96e786993.62765624', 3, '2023-12-01 16:51:11'),
('657322d847084', 'Pizza xúc xích', 'Fastfood', 38.4, 'FOOD-64dc5047713551.18237380', 12, '2023-12-08 21:06:16'),
('6573238edb3b5', 'Gà rán', 'Fastfood', 4.2, 'FOOD-64f19c6eb66863.61994584', 1, '2023-12-08 21:09:18'),
('6574269aac7d7', 'Burger Nine', 'Fastfood', 7.28, 'FOOD-6541f99837d818.08538129', 4, '2023-12-09 15:34:34'),
('657427028c3b1', 'Classic Smash', 'Fastfood', 10.9, 'FOOD-6541f98370ca17.59820849', 3, '2023-12-09 15:36:18'),
('65742702900d7', 'Bacon Burger', 'Fastfood', 15.8, 'FOOD-6541f9bed38f43.05468763', 4, '2023-12-09 15:36:18'),
('6574280726e18', 'Hot dogs', 'Fastfood', 1.35, 'FOOD-64dc4f05975970.87442492', 1, '2023-12-09 15:40:39'),
('6574289328c34', 'Pizza xúc xích', 'Fastfood', 12.8, 'FOOD-64dc5047713551.18237380', 4, '2023-12-09 15:42:59'),
('65742c5cadd0d', 'Chicken Burger', 'Fastfood', 3, 'FOOD-6541f951d3f231.86007598', 1, '2023-12-09 15:59:08'),
('65742c5caebf2', 'Beef Burger', 'Fastfood', 21.73, 'FOOD-6541f9ad73d646.68761419', 5, '2023-12-09 15:59:08'),
('657918e6073e5', 'Fatboy Burger', 'Fastfood', 6.4, 'FOOD-6541f96e786993.62765624', 2, '2023-12-13 09:37:26'),
('657918e6092f1', 'Bacon Burger', 'Fastfood', 18.5, 'FOOD-6541f9bed38f43.05468763', 5, '2023-12-13 09:37:26'),
('65795144120d3', 'Hot dogs', 'Fastfood', 1.8, 'FOOD-64dc4f05975970.87442492', 1, '2023-12-13 13:37:56'),
('657959625b6a3', 'Pizza xúc xích', 'Fastfood', 3.2, 'FOOD-64dc5047713551.18237380', 1, '2023-12-13 14:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `salefood`
--

CREATE TABLE `salefood` (
  `id` varchar(100) NOT NULL,
  `foodid` text NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salefood`
--

INSERT INTO `salefood` (`id`, `foodid`, `price`, `discount`) VALUES
('65051085a2ed8', 'FOOD-64dc4f05975970.87442492', 1.5, 10),
('6505112b7dbfe', 'FOOD-64dc5047713551.18237380', 4, 20),
('65051a7acf7f3', 'FOOD-64dd8a8693bfb9.73850315', 2.9, 20),
('6545ae5f4c078', 'FOOD-6541f96e786993.62765624', 3.4, 20),
('6545ae6350718', 'FOOD-6541f98370ca17.59820849', 4, 21),
('6545ae71c7b66', 'FOOD-6541f99837d818.08538129', 2.3, 30),
('6545ae75b9d8d', 'FOOD-6541f9ad73d646.68761419', 5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` text NOT NULL,
  `session` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`) VALUES
('65795e5803205', '6569b2c6c676d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `favor`
--
ALTER TABLE `favor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salefigure`
--
ALTER TABLE `salefigure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salefood`
--
ALTER TABLE `salefood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `id` (`id`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
