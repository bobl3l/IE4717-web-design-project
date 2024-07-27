-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 08:58 AM
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
-- Database: `fashionstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'tops', ''),
(2, 'shoes', ''),
(3, 'pants', ''),
(4, 'accessories', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `promoprice` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(512) DEFAULT NULL,
  `hover_image_url` varchar(512) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `description`, `price`, `promoprice`, `image_url`, `hover_image_url`, `updated_at`) VALUES
(1, 1, 'Long Sleeve T-Shirt Biker Print Top', 'Laundry Guide: Machine Washing<br>Material: cotton blend<br>Season: Spring, Summer, Fall/Fall', 39.99, 19.99, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/62fcc3063ac0ajpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/62fcc3df17852jpg.jpg', '2023-10-31 14:27:17'),
(2, 1, 'Top Fashion Print Short Sleeve Blue T-Shirt', 'Fit: loose <br>Material: polyester fiber (polyester)<br>Washing method: machine wash<br>Occasion: Casual, Everyday, street fashion<br>Neckline/Neckline : Crew neck<br>Style: casual, basic, retro/vintage<br>Season: Spring, Summer, Autumn/Fall', 29.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/62f5dfdfd8dc4jpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/4/64b0a552c0a10jpg.jpg', '2023-10-31 14:27:17'),
(3, 1, 'Loose Round Neck Cotton Linen Thin Short Sleeve', 'Fabric: Cotton Blend<br>Occasion: Beach/Casual<br>Laundry Guide: Cold Hand Wash<br>Material: Linen, Cotton and Linen<br>Season: Spring, Summer, Fall/Fall<br>Style: Resort/Beach/Casual Fashion', 36.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/62fca23c30e24jpg_1.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/62fca23c56e02jpg_1.jpg', '2023-10-31 14:27:17'),
(4, 1, 'Summer new knitted short-sleeved t-shirt', 'Material: Polyester Fiber (Polyester)<br>Washing method: machine wash<br>Occasion: Casual, Daily<br>Style: casual, street shooting<br>Season: Spring, Summer, Autumn/Fall', 59.99, 39.99, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63059be6e1440jpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63059be6b8427jpg.jpg', '2023-10-31 14:27:17'),
(5, 1, 'White Loose Casual Long Sleeve T-Shirt', 'Washing method: machine wash<br>Fabric: Cotton Blend<br>Occasion: Casual, Daily, Vacation<br>Style: Casual, Basic,Street Style<br>Season: Spring,Summer, Autumn/Fall', 28.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/630866212d3e4jpg_1.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/6308662155d88jpg_1.jpg', '2023-10-31 14:27:17'),
(6, 1, 'Black and white striped casual sweater', 'Material: Cotton Blend<br>Washing method: machine wash<br>Occasion: Casual, Daily, Leisure<br>Style: Casual, Basic, Vintage/Vintage<br>Season: All season', 34.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/631084abc3bebjpg_2.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/631084abed049jpg_2.jpg', '2023-10-31 14:27:17'),
(7, 1, 'Bear Skateboard Printed T-Shirt', 'Main Material: Polyester<br>Washing method: machine wash<br>Occasion:  Everyday, Casual<br>Style: casual, basic<br>Season: Spring,Summer,Autumn,Winter', 18.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63661fcb95a74jpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63661fcbaea65jpg.jpg', '2023-10-31 14:27:17'),
(8, 1, 'Helloice Vintage Print Hoodie', 'Material: Cotton<br>Washing method: machine wash<br>Occasion: Daily, Leisure<br>Style: Casual, Basic<br>Season: Autumn/Winter/Spring/Summer', 69.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/6373347c7cc8fjpg_1.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/6373347cba63ejpg_1.jpg', '2023-10-31 14:27:17'),
(9, 1, 'Gradient Creative Crew Neck Sweater', 'Occasion: Daily<br>Fabric: Polyester<br>Sleeve Length: Long Sleeve<br>Clothing Length: Regular<br>Collar: Crew Neck<br>Season: Autumn/Winter<br>Style: Casual/Street Fashion', 45.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/4/64edd6c42e606jpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/4/64edd6d7855c6jpg.jpg', '2023-10-31 14:27:17'),
(10, 1, 'Black and White Color Block Sweatshirt', 'Material: Cotton<br>Washing method: Machine Wash<br>Occasion: Daily/Leisure<br>Style: Casual/Basic<br>Season: Autumn/Winter/Spring/Summer', 40.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63a6b7b5ed342jpg_1.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63a6b7b60fadejpg_1.jpg', '2023-10-31 14:27:17'),
(11, 1, 'Minimalist vintage long sleeve loose t-shirt', 'Main Material: Cotton <br>Washing method: machine wash<br>Occasion:  Everyday, Casual<br>Style: casual, basic<br>Season: Spring, Summer, Autumn, Winter', 28.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63774038b03dcjpg_2.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/6377403986845jpg_2.jpg', '2023-10-31 14:27:17'),
(12, 1, 'Casual Short Sleeved Polo Shirt', 'Main Material: Polyester<br>Washing method: Machine Wash<br>Occasion: every day/Casual<br>Style: Casual/Basic<br>Season: Summer', 59.99, NULL, 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63849a73de5c1jpg.jpg', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/3/63849a7413fa6jpg.jpg', '2023-10-31 14:27:17'),
(13, 2, 'ZOOM FREAK 5 EP GEODE', 'Leather Upper<br>Rubber Outsole<br>Product Colour: Geode Teal/Purple Ink/Total Orange/Jade Ice<br>Product Code: DX4996-300', 69.99, NULL, 'https://limitededt.com/cdn/shop/files/DX4996-300-3_600x.jpg?v=1698431887', 'https://limitededt.com/cdn/shop/files/DX4996-300-2_600x.jpg?v=1698431887', '2023-10-31 14:27:17'),
(14, 2, 'AIR ZOOM G.T HUSTLE 2 EP BLACK PINK', 'Engineered Mesh Upper<br>Rubber Outsole<br>Product Colour: Black/White/Pink Foam/Pure Platinum<br>Product Code: DJ9404-004', 86.99, NULL, 'https://limitededt.com/cdn/shop/files/DJ9404-004-4_600x.jpg?v=1695880557', 'https://limitededt.com/cdn/shop/files/AURORA_DJ9404-004_PHCTH001-1500_600x.jpg?v=1695880557', '2023-10-31 14:27:17'),
(15, 2, 'AIR JORDAN 1 MID AQUA PURPLE', 'Leather Upper<br>Rubber Outsole<br>Product Colour: White/Bright Concord/True Red/Black<br>Product Code: DQ8426-154', 109.99, 79.99, 'https://limitededt.com/cdn/shop/files/DQ8426-154-3_600x.jpg?v=1698134361', 'https://limitededt.com/cdn/shop/files/AURORA_DQ8426-154_PHCTH001-500_400x.jpg?v=1698134402', '2023-10-31 14:27:17'),
(16, 2, '2002R PROTECTION PACK HIGH DESERT', 'Leather and Ripstop Upper<br>Rubber Outsole<br>Product Colour: High Desert / Dark Moss / Black<br>Product Code: M2002RDP', 45.99, NULL, 'https://limitededt.com/cdn/shop/files/M2002RDP-1_600x.jpg?v=1695882065', 'https://limitededt.com/cdn/shop/files/M2002RDP-3_600x.jpg?v=1695882067', '2023-10-31 14:27:17'),
(17, 2, 'ADIDAS ORIGINAL SHANDBALL SPEZIAL GREY TWO', 'Suede Upper<br>Synthetic Lining<br>Semi-Translucent Gum Rubber Outsole<br>Product Colour: Grey Two / Hi-Res Red / Gold Metallic<br>Product Code: EF5747', 69.99, NULL, 'https://limitededt.com/cdn/shop/files/EF5747-1_600x.jpg?v=1695098035', 'https://limitededt.com/cdn/shop/files/EF5747-4_600x.jpg?v=1695098035', '2023-10-31 14:27:17'),
(18, 2, 'FENG CHEN WANG CROCS 2-IN-1 ECHO CLOG BLACK', '100% Thermoplastic<br>Product Colour: Black<br>Product Code: 209391-001', 89.99, NULL, 'https://limitededt.com/cdn/shop/files/209391-001-3_600x.jpg?v=1695092584', 'https://limitededt.com/cdn/shop/files/209391-001-5_600x.jpg?v=1695092584', '2023-10-31 14:27:17'),
(19, 2, 'NIKE AIR PENNY II PANDA', 'Leather and Textile Upper<br>Rubber Outsole<br>Product Colour: Light Bone/Black/Photon Dust/White<br>Product Code: DZ2549-001', 79.99, NULL, 'https://limitededt.com/cdn/shop/files/DZ2549-001-3_600x.jpg?v=1695062475', 'https://limitededt.com/cdn/shop/files/AURORA_DZ2549-001_PHCTH001-1500_600x.jpg?v=1695062475', '2023-10-31 14:27:17'),
(20, 2, 'NIKE AIR ZOOM G.T HUSTLE 2 EP TALARIA', 'Engineered Mesh Upper<br>Rubber Outsole<br>Product Colour: Cyber/White/Siren Red/Vivid Sulphur<br>Product Code: DJ9404-300', 69.99, NULL, 'https://limitededt.com/cdn/shop/files/DJ9404-300-3_600x.jpg?v=1695881190', 'https://limitededt.com/cdn/shop/files/AURORA_DJ9404-300_PHSYD002-1500_600x.jpg?v=1695881183', '2023-10-31 14:27:17'),
(21, 2, 'NEW BALANCE 650R SEA SALT NB NAVY', 'Nubuck Upper<br>Rubber Outsole<br>Product Colour: Sea Salt / NB Navy/  Dawn Glow<br>Product Code:  BB650RVN', 79.99, NULL, 'https://limitededt.com/cdn/shop/files/BB650RVN-1_600x.jpg?v=1692351321', 'https://limitededt.com/cdn/shop/files/BB650RVN-3_600x.jpg?v=1692351321', '2023-10-31 14:27:17'),
(22, 2, 'JORDAN LUKA 2 PF LAKE BLED', 'Synthetic Upper<br>Rubber Outsole<br>Product Colour: Polar/Psychic Blue/Diffused Blue/Bright Crimson<br>Product Code: DX9034-400', 99.99, 79.99, 'https://limitededt.com/cdn/shop/files/DX9034-400-3_600x.jpg?v=1695882386', 'https://limitededt.com/cdn/shop/files/AURORA_DX9034-400_PHCTH001-1500_600x.jpg?v=1695882386', '2023-10-31 14:27:17'),
(23, 2, 'NIKE AIR ZOOM G.T CUT 2 EP HYPER PINK', 'Lightweight Upper<br>Rubber Outsole<br>Product Colour Shown: Hyper Pink/Fierce Pink/Pearl Pink/Fireberry<br>Product Code: DJ6013-604', 109.99, NULL, 'https://limitededt.com/cdn/shop/files/DJ6013-604_b0ef86d1-e477-4771-b163-013a309ec3fe_600x.jpg?v=1692176833', 'https://limitededt.com/cdn/shop/files/DJ6013-604-3_600x.jpg?v=1692176833', '2023-10-31 14:27:17'),
(24, 2, 'NIKE AIR MORE UPTEMPO SLIDE WHITE RED', 'Padded Strap<br>Air Cushioning<br>Rubbber Sole<br>Product Colour: White / Varsity Red<br>Product Code: FD9883-100', 36.99, NULL, 'https://limitededt.com/cdn/shop/files/FD9883-100_2_600x.png?v=1688089410', 'https://limitededt.com/cdn/shop/files/FD9883-100_3_600x.png?v=1688089410', '2023-10-31 14:27:17');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fulladdress` text NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `contact`, `fulladdress`, `role`) VALUES
(3, 'friesKing', '$2y$10$XkTS649XkVYHVpMF6mKSdOCTZ0vbk4YbpyrnCmbRbRMQEmZ9epUp.', 'yijiedingTheBestLah', 'yijieding95218@gmail.com', '89428341', '                                                                                                                                                ntu hall 5                                                                                                                                    ', 'user'),
(4, 'ikun', '$2y$10$jffyxFKx39FevA/4tcxLq.o48/1GO4jhR0RhrR5YS.pG46pkMysHS', '', '', '', '', 'user'),
(5, 'ikun123', '$2y$10$iuIWJYdqzutr7Aj/gwVD5ePL29SelHDVkf2KVmk.7tJBe.wmkJV5.', 'cai xukun', 'caixukun@zzz.com', '12345', 'dskladj', 'user'),
(6, 'YDING0062222', '$2y$10$3hFPzNA.BYoVqYgGjbcwd.6qVYbJczIs9uMGxmkoJDGUbg0jwnF8C', '435345', '5', '', '54353', 'user'),
(7, 'testingtesting', '$2y$10$tzpa61eXWlMCZuHp1yQWxetyZW0mebceVTor2UDEYJOICCJqvFGni', '', '', '', '', 'user'),
(8, 'yhellohello', '$2y$10$GFDAsG3S0NRhGLjdVpFUWe5Lg2vy59J4q66KQx1so9Tb7PdqQMnui', '', '', '', '', 'user'),
(9, 'friesKing22', '$2y$10$l2Hr6Xb2OxEcpWXprIJg7.8TBcNCmoJ8uYNhl0ZKQg86GRzMrR1G6', '', '', '', '', 'user'),
(10, 'admin', '$2y$10$pMaenQyfDA/0sUcBGaw3NuL7gpBEmU57ehMg3IpmJpjGHm4P6rpDq', '', '', '', '', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
