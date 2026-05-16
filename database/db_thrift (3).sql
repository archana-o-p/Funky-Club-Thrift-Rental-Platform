-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2026 at 09:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_thrift`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(46, 'Varun', 'varun@gmail.com', 'Varun@12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_status` int(200) NOT NULL DEFAULT 0,
  `booking_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_status`, `booking_amount`, `user_id`) VALUES
(36, '2025-11-18', 1, 699, 15),
(37, '2025-11-19', 1, 1898, 1),
(38, '2025-11-19', 1, 699, 15),
(39, '2025-11-19', 1, 999, 15),
(40, '2025-11-19', 1, 999, 15),
(41, '2025-11-19', 1, 999, 15),
(42, '2025-11-19', 1, 699, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(200) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `cart_status`, `user_id`, `product_id`, `size_id`, `color_id`, `booking_id`) VALUES
(16, 1, 1, 0, 25, 4, 5, 9),
(17, 2, 1, 0, 24, 7, 3, 9),
(20, 1, 0, 0, 25, 6, 4, 10),
(21, 1, 0, 0, 24, 7, 3, 11),
(22, 1, 1, 0, 25, 4, 5, 12),
(23, 2, 1, 0, 24, 7, 3, 12),
(24, 1, 1, 0, 25, 6, 4, 13),
(25, 1, 1, 0, 24, 7, 3, 13),
(26, 1, 1, 0, 25, 4, 5, 13),
(27, 4, 1, 0, 27, 4, 4, 14),
(31, 2, 1, 0, 28, 6, 5, 15),
(32, 3, 1, 0, 27, 4, 4, 16),
(33, 1, 1, 0, 28, 6, 5, 16),
(34, 1, 1, 0, 25, 6, 4, 16),
(35, 2, 1, 0, 25, 6, 4, 17),
(36, 1, 1, 0, 28, 6, 5, 18),
(37, 1, 1, 0, 25, 6, 4, 19),
(38, 1, 1, 0, 25, 6, 4, 20),
(39, 3, 1, 0, 28, 6, 5, 21),
(40, 1, 0, 0, 30, 12, 10, 22),
(41, 1, 1, 0, 31, 13, 8, 23),
(42, 1, 1, 0, 32, 13, 9, 23),
(43, 1, 1, 0, 31, 13, 8, 24),
(44, 1, 1, 0, 31, 13, 8, 25),
(45, 1, 1, 0, 36, 14, 8, 26),
(47, 1, 1, 0, 36, 13, 13, 28),
(48, 1, 1, 0, 36, 13, 14, 29),
(49, 1, 1, 0, 45, 12, 8, 30),
(50, 1, 1, 0, 56, 14, 13, 31),
(51, 1, 1, 0, 45, 12, 8, 32),
(52, 1, 1, 0, 36, 13, 8, 33),
(53, 1, 0, 0, 36, 13, 14, 34),
(56, 1, 0, 0, 58, 14, 9, 35),
(70, 2, 1, 0, 1, 1, 1, 1),
(71, 1, 1, 0, 2, 2, 2, 1),
(72, 1, 1, 0, 57, 15, 8, 36),
(73, 1, 1, 0, 75, 13, 14, 39),
(74, 1, 1, 0, 40, 14, 21, 40),
(75, 1, 1, 0, 36, 13, 14, 41),
(76, 1, 1, 0, 57, 15, 8, 42);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_photo`) VALUES
(26, 'Outerwear', 'download.jpeg'),
(27, 'Topwear', 'download (1).jpeg'),
(28, 'Co-ord Set', 'download (4).jpeg'),
(29, 'Dresses', 'download (3).jpeg'),
(30, 'Bottomwear', 'download (2).jpeg'),
(31, 'Occasional Wear', '8800117c9a90871ac1bbd16db309f1bc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`) VALUES
(8, 'White'),
(9, 'Blue'),
(10, 'Red'),
(11, 'Black'),
(12, 'Green'),
(13, 'Beige'),
(14, 'Classic Black'),
(15, 'Grey'),
(16, 'Playful Pink'),
(17, 'Vibrant Yellow'),
(18, 'Brown'),
(19, 'Purple'),
(20, 'Navy Blue'),
(21, 'Olive Green'),
(22, 'Off White'),
(23, 'Light Brown'),
(24, 'Maroon'),
(25, 'Light Green'),
(26, 'Light Blue'),
(27, 'Light red'),
(28, 'Brick Red'),
(29, 'Dark Green '),
(30, 'Peacock Blue');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(500) NOT NULL,
  `complaint_date` datetime DEFAULT current_timestamp(),
  `complaint_reply` varchar(500) DEFAULT NULL,
  `complaint_status` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_content`, `complaint_date`, `complaint_reply`, `complaint_status`, `user_id`, `product_id`) VALUES
(23, 'Quality issue', 'Low Quality and the product seems to be damaged!!!', '2025-11-14 00:39:39', NULL, 0, 18, 32),
(24, 'Size issue', 'Actually i ordered size M but when received the size is like XL.', '2025-11-14 00:40:42', 'Thank you for reaching out. We’re sorry to hear that you received the wrong size. Please share a photo of the product showing the size label, and we’ll assist you with an exchange or refund right away.', 1, 18, 39),
(25, 'Quality', 'poor quality', '2025-11-18 22:05:35', 'okk', 1, 15, 41);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(18, 'Thiruvananthapuram'),
(19, 'Kollam'),
(20, 'Pathanamthitta'),
(21, 'Alappuzha'),
(22, 'Kottayam'),
(23, 'Idukki'),
(24, 'Ernakulam'),
(25, 'Thrissur'),
(26, 'Palakkad'),
(27, 'Malappuram'),
(28, 'Kozhikode'),
(29, 'Wayanad'),
(30, 'Kannur'),
(31, 'Kasaragod');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_file` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_file`, `product_id`) VALUES
(6, 'y.png', 6),
(7, 'h.jpg', 6),
(10, 'y.png', 16),
(11, 'b.png', 16),
(18, 'eye.jpg', 22),
(19, 'h.jpg', 22),
(20, 'eye.jpg', 25),
(21, 'h.jpg', 25),
(22, 'b.png', 24),
(23, 'y.png', 24),
(24, 'y.png', 25),
(25, 'h.jpg', 27),
(26, 't.jpg', 27),
(27, 'y.png', 25),
(28, 'b.png', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`gender_id`, `gender_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`material_id`, `material_name`) VALUES
(6, 'Cotton'),
(7, 'Linen'),
(8, 'Rayon'),
(10, 'Polyester'),
(11, 'Silk'),
(12, 'Georgette'),
(13, 'Denim'),
(14, 'Velvet'),
(15, 'Jersey'),
(16, 'Wool'),
(17, 'Satin'),
(18, 'Leather'),
(19, 'Chiffon'),
(20, 'Crepe'),
(21, 'Lace'),
(22, 'Nylon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(4, 'da', 13),
(10, 'kalamassery', 10),
(15, 'ghfgh', 11),
(16, 'bathery', 12),
(17, 'fgwrg', 11),
(18, 'wrgwr', 12),
(19, 'fsg', 11),
(20, 'hdthj', 10),
(21, 'fgdfd', 13),
(22, 'hhh', 13),
(24, 'Kazhakootam', 18),
(25, 'Attingal', 18),
(26, 'Parassala', 18),
(27, 'Neyyattinkara', 18),
(28, 'Nedumangad', 18),
(29, 'Kattakkada', 18),
(30, 'Varkala', 18),
(31, 'Karunagappally', 19),
(32, 'Kottarakkara', 19),
(33, 'Punalur', 19),
(34, 'Kunnathur', 19),
(35, 'Pathanapuram', 19),
(36, 'Chayadayamangalam', 19),
(37, 'Adoor', 20),
(38, 'Thiruvalla', 20),
(39, 'Mallapally', 20),
(40, 'Ranni', 20),
(41, 'Konni', 20),
(42, 'Chengannur', 21),
(43, 'mavelikkara', 21),
(44, 'Kuttanad', 21),
(45, 'Cherthala', 21),
(46, 'Kayamkulam', 21),
(47, 'Changanassery', 22),
(48, 'Kanjirappally', 22),
(49, 'Pala', 22),
(50, 'Vaikom', 22),
(51, 'Uzhavoor', 22),
(52, 'Kottayam', 22),
(53, 'Idukki', 23),
(54, 'Vandiperiyar', 23),
(55, 'Thodupuzha', 23),
(56, 'Devikulam', 23),
(57, 'Udumbanchola', 23),
(64, 'North Paravur', 24),
(65, 'Kochi', 24),
(66, 'Mattancherry', 24),
(67, 'Kothamangalam', 24),
(68, 'Angamaly', 24),
(69, 'Thrissur', 25),
(70, 'Irinjalakuda', 25),
(71, 'Guruvayur', 25),
(72, 'Kodungallur', 25),
(73, 'Wadakkancherry', 25),
(74, 'Chalakkudy', 25),
(75, 'Thriprayar', 25),
(76, 'Palakkad', 26),
(77, 'Alathur', 26),
(78, 'Mannarkkad', 26),
(79, 'Ottappalam', 26),
(80, 'Pattambi', 26),
(81, 'Chittur', 26),
(82, 'Malappuram', 27),
(83, 'Kollam', 19),
(84, 'Thiruvananthapuram', 18),
(85, 'Pathanamthitta', 20),
(86, 'Alappuzha', 21),
(87, 'Kottayam', 22),
(88, 'Ernakulam', 24),
(89, 'Tirur', 27),
(90, 'Nilambur', 27),
(91, 'Ponnani', 27),
(92, 'Perinthalmanna', 27),
(93, 'Thirurangadi', 27),
(94, 'Kondatty', 27),
(99, 'Koduvally', 28),
(100, 'Nanmanda', 28),
(101, 'Perambra', 28),
(102, 'Ramanattukara', 28),
(103, 'Kalpetta', 29),
(104, 'Mananthavady', 29),
(105, 'Sulthan Bathery', 29),
(112, 'Kasaragod', 31),
(113, 'Manjeshwaram', 31),
(114, 'Vellarikund', 31),
(115, 'Hosdurg', 31),
(117, 'Malappuram', 27),
(118, 'Kozhikode', 28),
(119, 'Kannur', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_details` varchar(500) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `product_price` varchar(200) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `material_id` int(100) NOT NULL,
  `subcategory_id` int(100) NOT NULL,
  `seller_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_state` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_details`, `product_photo`, `product_price`, `gender_id`, `material_id`, `subcategory_id`, `seller_id`, `user_id`, `product_state`) VALUES
(32, 'Colar Dress', 'Knee Length Dress', 'beautiful-young-woman-wearing-fashionable-clothes-walking-down-street.jpg', '699', 2, 10, 14, 17, 0, ''),
(33, 'Short red dress', 'short red dress half sleeve ', 'woman-wearing-sundress.jpg', '699', 2, 8, 15, 17, 0, ''),
(34, 'Black full sleeve jacket', 'Black color full sleeve', 'jacket.jpeg', '899', 3, 15, 9, 17, 0, ''),
(35, 'Oversized Linen Shirt', 'Breathable pastel linen shirt with drop shoulders, perfect for summer layering.', 'images (1).jpeg', '699', 2, 7, 12, 21, 0, ''),
(36, 'Cargo Parachute Pants', 'Lightweight nylon pants with adjustable drawcords', 'download (2).jpeg', '999', 1, 22, 30, 17, 0, ''),
(37, 'Cargo Parachute Pants', 'cotton pants with adjustable drawcords', 'images (1).jpeg', '999', 3, 6, 30, 17, 0, ''),
(39, 'Cargo  Pants', 'cotton pants with adjustable drawcords', 'images (4).jpeg', '899', 2, 6, 30, 17, 0, ''),
(40, 'Cargo  Pants', 'Lightweight nylon pants with adjustable drawcords', 'images (3).jpeg', '899', 2, 22, 30, 17, 0, ''),
(41, 'Baggy Denim ', 'Oversized, loose-fit jeans with ripped knees and frayed hems for a streetwear-inspired look.', 'download (6).jpeg', '1199', 2, 13, 31, 17, 0, ''),
(42, 'Black faded Denim', 'Oversized, loose-fit jeans ', 'images (5).jpeg', '1199', 3, 13, 31, 17, 0, ''),
(44, ' High Rise Trousers', 'Elegant high-rise trousers with a flowy wide-leg silhouette, made from soft crepe fabric — perfect for formal or chic casual looks.', 'download (9).jpeg', '799', 2, 20, 29, 17, 0, ''),
(45, 'Tailored Fit Chinos ', 'Slim-cut cotton chinos with stretch, offering a crisp and smart appearance for work or semi-casual outings.', 'download (7).jpeg', '899', 1, 8, 29, 17, 0, ''),
(46, 'Straight Fit Linen Trousers', 'Breathable linen fabric with a straight leg design, ideal for summer wear and relaxed vibes.', 'download (8).jpeg', '899', 3, 7, 29, 17, 0, ''),
(47, 'Chunky Cable Knit Sweater', 'Cozy oversized sweater made with thick cable-knit design and dropped shoulders — perfect for winter layering.', 'download (11).jpeg', '699', 1, 16, 16, 17, 0, ''),
(48, 'Cropped Knit Cardigan', 'Button-down cardigan with a cropped fit and balloon sleeves — trendy and perfect over dresses or camisoles.', 'download (10).jpeg', '599', 2, 16, 16, 17, 0, ''),
(49, 'Cropped Knit Cardigan', 'Button-down cardigan with a cropped fit and balloon sleeves — trendy and perfect over dresses or camisoles.', 'images (7).jpeg', '799', 2, 16, 16, 17, 0, ''),
(50, 'Turtleneck Pullover', 'Classic high-neck knit pullover offering warmth and elegance in a minimal silhouette.', 'download (12).jpeg', '899', 3, 16, 16, 17, 0, ''),
(51, 'Printed Georgette Tunic', 'Lightweight georgette tunic featuring digital prints and flared sleeves — ideal for semi-casual outings.', 'download (13).jpeg', '599', 2, 6, 17, 17, 0, ''),
(52, 'Kaftan Style Tunic', 'Flowy kaftan-inspired tunic with drawstring waist and boho prints, offering relaxed fit and resort vibes.', 'images (9).jpeg', '599', 2, 22, 17, 17, 0, ''),
(53, 'Printed Resort Shirt', 'Lightweight rayon shirt featuring tropical or geometric prints — ideal for vacation or beach vibes.', 'download (14).jpeg', '799', 3, 22, 19, 17, 0, ''),
(54, 'Satin Collared Shirt', 'Smooth satin shirt with a glossy finish and concealed button placket — adds elegance to evening wear.', 'download (15).jpeg', '499', 2, 17, 19, 17, 0, ''),
(55, 'Classic Oxford Shirt', 'Timeless button-down shirt made from premium Oxford cotton — soft, durable, and ideal for formal or smart-casual wear.', 'download (16).jpeg', '799', 1, 6, 19, 17, 0, ''),
(56, 'Oversized Graphic Hoodie', 'Relaxed-fit fleece hoodie with bold streetwear graphics and dropped shoulders — trendy and unisex.', 'IMG_20251112_113548.jpg', '699', 1, 6, 20, 17, 0, ''),
(57, 'Oversized sweatshirt', 'Made from French terry fabric with a textured finish, providing softness and breathability.', 'IMG_20251112_113907.jpg', '699', 1, 6, 21, 17, 0, ''),
(58, 'Colorblock Sweatshirt', 'Multi-panel color design with ribbed cuffs and contrast stitching — gives a vibrant sporty appearance.', 'IMG_20251112_113857.jpg', '599', 1, 6, 21, 17, 0, ''),
(59, 'Fleece-Lined Winter Sweatshirt', 'Brushed fleece interior for warmth and comfort — perfect for cooler days.', 'IMG_20251112_113847.jpg', '799', 3, 6, 21, 17, 0, ''),
(60, 'Ribbed Neck Cropped Sweatshirt', 'Fitted sweatshirt with ribbed neckline and short hem — trendy and versatile.', 'IMG_20251112_113640.jpg', '599', 2, 6, 21, 17, 0, ''),
(61, 'Minimalist Solid Hoodie', 'Plain solid-colored hoodie with clean lines and soft brushed inner lining — a wardrobe essential.', 'IMG_20251112_113629.jpg', '799', 3, 6, 20, 17, 0, ''),
(62, 'Oversized Graphic Hoodie', 'Relaxed-fit fleece hoodie with bold streetwear graphics and dropped shoulders — trendy and unisex.', 'IMG_20251112_113611.jpg', '899', 2, 6, 20, 17, 0, ''),
(63, 'Basic Crew Neck Tee', 'Classic short-sleeve crew neck made from 100% cotton — soft, breathable, and versatile for everyday wear.', 'download (17).jpeg', '499', 3, 6, 26, 17, 0, ''),
(64, 'Cropped Baby Tee', 'Fitted cropped T-shirt with ribbed texture — Y2K inspired and trendy with high-waist jeans.', 'download (18).jpeg', '399', 2, 6, 26, 17, 0, ''),
(65, 'Pocket Patch Tee', 'Solid T-shirt with a chest pocket patch and contrast stitching — minimal yet stylish.', 'download (19).jpeg', '499', 1, 6, 26, 17, 0, ''),
(66, 'Linen Summer Co-ord Set', 'Lightweight linen shirt and matching shorts for a relaxed, breezy summer vibe — perfect for vacations.', 'images (10).jpeg', '999', 1, 22, 27, 17, 0, ''),
(67, 'Oversized Shirt & Short Set', 'Relaxed oversized half-sleeve shirt with elastic waist shorts — streetwear-inspired and comfy.', 'download (20).jpeg', '899', 2, 8, 27, 17, 0, ''),
(68, 'Tie-Dye Lounge Co-ord', 'Vibrant tie-dye pattern top and jogger pants — stylish loungewear for travel or leisure.', 'download (21).jpeg', '789', 3, 7, 27, 17, 0, ''),
(69, 'Cut-Out Shoulder Mini Dress', 'Trendy cut-out detail at shoulders and a fitted waist for a bold, modern look.', 'download (22).jpeg', '699', 2, 10, 32, 17, 0, ''),
(70, 'Satin Bodycon Slip Dress', 'Silky satin texture with spaghetti straps and body-hugging silhouette — elegant for special occasions.', 'download (23).jpeg', '899', 2, 17, 33, 17, 0, ''),
(71, 'Beige Linen Shirt & Short Set', 'Relaxed-fit beige linen shirt paired with matching drawstring shorts — ideal for summer comfort and travel style.', 'download (24).jpeg', '799', 2, 7, 28, 17, 0, ''),
(72, ' Yoke Tunic Dress', 'Soft rayon tunic with front pleats and side slits — ideal for everyday comfort and smart casuals.', '1a2ddefa842df526b257a705e6ce443b.jpg', '899', 2, 12, 34, 17, 0, ''),
(73, 'long shirt jacket', 'cotton long shirt jacket', '376af637bea2cc8bf16e27a9c861545f.jpg', '699', 3, 6, 23, 17, 0, ''),
(75, 'Cropped Moto Leather Jacket', 'Short-length moto-style jacket with zip cuffs and belted waist — chic and street-smart.', 'beautiful-young-woman-leather-jacket-standing-near-wall-with-her-arms-crossed.jpg', '999', 2, 18, 24, 21, 0, ''),
(76, 'Classic Biker Leather Jacket', 'Timeless black biker jacket with asymmetrical zipper, metallic studs, and fitted silhouette — the ultimate edgy staple.', 'couple-wearing-synthetic-leather-clothing.jpg', '899', 3, 18, 24, 21, 0, ''),
(77, ' Blue Denim Jacket', 'Mid-wash blue jacket with button closure and chest pockets — versatile for any casual look.', 'young-handsome-man-wearing-jeans-jaket-studio.jpg', '1099', 1, 13, 25, 21, 0, ''),
(78, 'Oversized Denim Jacket', 'Relaxed, loose-fit silhouette with drop shoulders — casual, comfy, and trendy.', 'medium-shot-smiley-people-wearing-trucker-hats.jpg', '799', 3, 13, 25, 20, 0, ''),
(79, 'Cropped Denim Jacket', 'Short-length denim with raw hem and boxy fit — adds a chic, youthful touch.', 'woman-model-demonstrating-winter-cloths.jpg', '799', 2, 13, 25, 20, 0, ''),
(80, 'Dark Blue Denim	', 'Regular straight fit jeans for a streetwear-inspired look.	', '565e6b47f2535fc9a0b7538f8f75f5b2.jpg', '1099', 1, 13, 31, 20, 0, ''),
(81, 'Cargo Parachute Pants', 'Lightweight nylon pants with adjustable drawcords	', 'd148ee3838013bb87a65250501e3380c.jpg', '999', 1, 22, 30, 20, 0, ''),
(82, 'Cargo Parachute Pants	', 'Lightweight nylon pants with adjustable drawcords	', '127c0cc9b63af38f2ac0467c140de74b.jpg', '899', 2, 22, 30, 20, 0, ''),
(85, 'Classic White T-Shirt', 'Comfortable cotton t-shirt for everyday wear', 'tshirt1.jpg', '499.00', 1, 1, 1, 1, 0, ''),
(86, 'Denim Jeans', 'Stylish blue denim jeans', 'jeans1.jpg', '1299.00', 1, 2, 2, 1, 0, ''),
(87, 'Summer Dress', 'Light and breezy summer dress', 'dress1.jpg', '899.00', 2, 3, 3, 1, 0, ''),
(90, 'shirt jacket', 'dgsjdgsa', '3cad59743f41046de3e315c58b4f1532.jpg', '466', 3, 18, 30, 17, 0, ''),
(91, 'tgfdrt', 'hbhb', '3cad59743f41046de3e315c58b4f1532.jpg', '658', 2, 19, 30, 17, 0, 'kerala');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_content` varchar(100) NOT NULL,
  `rating_date` date NOT NULL,
  `rating_value` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_content`, `rating_date`, `rating_value`, `user_id`, `product_id`) VALUES
(1, 'jj', '2025-09-18', '2', 5, 22),
(2, 'huy', '2025-09-22', '2', 5, 0),
(3, 'gg', '2025-09-22', '2', 13, 0),
(4, 'jj', '2025-11-02', '3', 13, 24),
(5, 'hd', '2025-11-03', '3', 15, 31),
(6, 'hjj', '2025-11-04', '2', 15, 31),
(7, 'Perfect fit and really comfortable! The stretch denim makes it easy to move around, and the wash loo', '2025-11-14', '5', 18, 58),
(8, 'rew', '2025-11-18', '2', 15, 65);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rentproductbooking`
--

CREATE TABLE `tbl_rentproductbooking` (
  `rentproductbooking_id` int(11) NOT NULL,
  `rentproductbooking_date` varchar(100) NOT NULL,
  `rentproductbooking_status` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rentproduct_id` int(11) NOT NULL,
  `rentproductbooking_fromdate` varchar(100) NOT NULL,
  `rentproductbooking_todate` varchar(100) NOT NULL,
  `rentproductbooking_amount` int(11) NOT NULL,
  `rent_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rentproductbooking`
--

INSERT INTO `tbl_rentproductbooking` (`rentproductbooking_id`, `rentproductbooking_date`, `rentproductbooking_status`, `user_id`, `rentproduct_id`, `rentproductbooking_fromdate`, `rentproductbooking_todate`, `rentproductbooking_amount`, `rent_address`) VALUES
(28, '2025-09-18', 1, 5, 14, '2025-09-18', '2025-09-22', 3200, ''),
(29, '2025-09-18', 0, 5, 12, '2025-09-24', '2025-09-19', 1110, ''),
(30, '2025-09-20', 0, 13, 14, '2025-09-23', '2025-09-25', 1600, ''),
(31, '2025-09-22', 0, 13, 12, '2025-09-23', '2025-09-25', 444, ''),
(32, '2025-09-22', 2, 13, 21, '2025-09-24', '2025-09-24', 0, ''),
(33, '2025-09-22', 1, 13, 20, '2025-09-24', '2025-09-26', 466, ''),
(34, '2025-09-22', 1, 5, 22, '2025-09-26', '2025-09-29', 1497, ''),
(35, '2025-09-29', 1, 13, 25, '2025-09-30', '2025-10-03', 1497, ''),
(36, '2025-11-01', 1, 13, 23, '2026-02-08', '2026-02-10', 1718, ''),
(37, '2025-11-01', 0, 13, 15, '2026-01-01', '2026-01-15', 13986, ''),
(38, '2025-11-01', 2, 13, 25, '2026-05-07', '2026-05-10', 1497, 'jedke'),
(39, '2025-11-01', 0, 13, 22, '2025-11-07', '2025-11-14', 3493, 'fgd'),
(40, '2025-11-01', 0, 13, 22, '2025-11-12', '2025-11-15', 1497, 'jn'),
(41, '2025-11-01', 0, 13, 21, '2025-11-05', '2025-11-07', 1798, 'jhdjwhd'),
(42, '2025-11-03', 1, 13, 26, '2025-11-05', '2025-11-13', 4528, 'hbjh'),
(43, '2025-11-03', 2, 15, 27, '2025-11-12', '2025-11-20', 7192, 'hhh'),
(44, '2025-11-03', 1, 15, 26, '2025-11-05', '2025-11-12', 3962, 'Green villa '),
(45, '2025-11-04', 0, 15, 26, '2025-11-12', '2025-11-24', 6792, 'hh'),
(46, '2025-11-12', 1, 15, 46, '2025-11-13', '2025-11-15', 472, 'Palmyra Cottage, 3/2, Riverbend Lane, Palakkad Old Town, Kerala — PIN 679002'),
(47, '2025-11-12', 3, 15, 38, '2025-11-24', '2025-11-27', 897, 'Pepper House, Plot 4, Spice Market Road, Munnar, Idukki, Kerala — PIN 685321'),
(48, '2025-11-12', 0, 15, 52, '2025-11-25', '2025-11-28', 900, 'Kasaba Residence, 5, Mango Walk, Kasaragod Central, Kasaragod, Kerala — PIN 671900'),
(49, '2025-11-13', 0, 15, 38, '2025-11-18', '2025-11-21', 1196, 'Lakshmi Nilayam, Flat No. 3B, Silver Oak Apartments, Kadavanthra, Ernakulam, Kerala — PIN 682777'),
(50, '2025-11-14', 1, 18, 29, '2025-11-19', '2025-11-24', 2394, 'Sreeram Residency, Door No. 101, Temple Road, Thrissur City, Kerala — PIN 680119'),
(51, '2025-11-14', 0, 18, 38, '2025-11-16', '2025-11-18', 897, 'Hillcrest Bungalow, 14, Pine View Drive, Wayanad Hills, Wayanad, Kerala — PIN 670450'),
(52, '2025-11-18', 0, 15, 39, '2025-11-20', '2025-11-27', 1272, 'ndjndj'),
(53, '2025-11-18', 1, 15, 44, '2025-11-20', '2025-11-27', 1896, 'kfssk'),
(54, '2025-11-19', 0, 15, 30, '2025-11-20', '2025-11-21', 718, 'hhhu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rentproducts`
--

CREATE TABLE `tbl_rentproducts` (
  `rentproduct_id` int(100) NOT NULL,
  `rentproduct_name` varchar(100) NOT NULL,
  `rentproduct_details` varchar(100) NOT NULL,
  `rentproduct_price` varchar(90) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `rentproduct_status` int(100) NOT NULL DEFAULT 0,
  `rentproduct_photo` varchar(100) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rentproducts`
--

INSERT INTO `tbl_rentproducts` (`rentproduct_id`, `rentproduct_name`, `rentproduct_details`, `rentproduct_price`, `gender_id`, `rentproduct_status`, `rentproduct_photo`, `size_id`, `color_id`, `material_id`, `subcategory_id`, `user_id`) VALUES
(27, 'Jeans', 'Baggy Jean', '899', 3, 0, 'pants-hanger-with-green-background.jpg', 13, 20, 13, 13, 15),
(29, 'Women\'s The Faux Leather Moto Jacket', 'Mid-wash jacket with button closure and chest pockets — versatile for any casual look.', '399', 2, 0, '6e3b6cff7af0c7e6445103d02f2bef5e.jpg', 13, 23, 18, 24, 15),
(30, 'shirt jacket', 'cotton white with printed shirt jacket', '359', 3, 0, 'b2d500b9286a8d73c89dad196f818069.jpg', 13, 8, 6, 23, 15),
(31, 'Corduroy Overshirt Shacket', 'Soft corduroy material with relaxed fit, patch pockets, and button cuffs — perfect for autumn layeri', '439', 2, 0, 'b4d4808c5caf82820801122306f9f131.jpg', 14, 8, 6, 23, 15),
(32, 'Oversized Cotton Shacket', 'Loose-fit cotton shacket with soft brushed fabric — casual, breathable, and trendy.', '199', 1, 0, '6f5826873e5d989d6780dbb61c1fb0bb.jpg', 14, 22, 6, 23, 15),
(33, 'Hooded knit ', 'Cozy Coffee Hooded Drawstring Knit Sweatshirts Tops Winter', '159', 3, 0, 'c7d33e5bffcb3c8f3b45ecd98fe9c96e.jpg', 14, 0, 16, 16, 15),
(34, 'Hooded knit ', 'Cozy Coffee Hooded Drawstring Knit Sweatshirts Tops Winter', '159', 3, 0, 'c7d33e5bffcb3c8f3b45ecd98fe9c96e.jpg', 13, 23, 16, 16, 15),
(35, 'Sweater Vest Twist Knitted', 'Women\'s Sweater Vest Twist Knitted Loose Sleeveless Pullover Leisure Vest', '300', 2, 0, '4536a1ef85970f61a2ef200688206cbf.jpg', 14, 23, 16, 16, 15),
(36, 'KNITTED SWEATER', 'SPACE DYE KNITTED SWEATER', '239', 1, 0, '4093145636e0d213764dad6275cc8a12.jpg', 14, 18, 16, 16, 15),
(37, 'Asymmetric Hem Tunic', 'Modern tunic with high-low hemline and mandarin collar — chic and flowy for contemporary styling.', '299', 2, 0, '330327e5b084e874702906c34f5bf9d5.jpg', 12, 0, 6, 17, 15),
(38, 'Asymmetric Hem Tunic', 'Modern tunic with high-low hemline and mandarin collar — chic and flowy for contemporary styling.', '299', 2, 0, '330327e5b084e874702906c34f5bf9d5.jpg', 12, 9, 6, 17, 15),
(39, 'Pleated Yoke Tunic', 'Rayon tunic with front pleats, keyhole neckline, and side slits — elegant yet practical for daily we', '159', 2, 0, '9c80108c20b65406f9f3537f75f77bc0.jpg', 13, 13, 8, 17, 15),
(40, 'Embroidered Cotton Tunic', 'Breezy cotton tunic with floral embroidery and three-quarter sleeves — perfect for casual and ethnic', '239', 2, 0, '16b3c53abcd1666a2c54ab921d21823c.jpg', 12, 20, 6, 17, 15),
(41, 'Oversized Shirt & Pants  Set', 'Relaxed-fit oversized shirt with elastic waist pants— streetwear-inspired and comfortable.', '239', 2, 0, 'e7401703699607e5c9b880d4f0f35347.jpg', 14, 23, 7, 27, 15),
(42, 'Black Mini Dress', 'Black mini dress with white inner dress', '139', 2, 0, '6800aa619f0cfc835b615d6fa45e80cc.jpg', 13, 11, 12, 32, 15),
(43, 'Plain tunic dress', 'pleated plain tunic dress', '149', 2, 0, '95e0319ae6ff2f9af3832aa360e7a7db.jpg', 13, 18, 7, 34, 15),
(44, 'Off White Tunic Dresses', 'Off white tunic ', '237', 2, 0, '161a418e4316c6f704f84c9dc9c328a5.jpg', 12, 22, 20, 34, 15),
(45, 'Straight Fit Linen Trousers', 'Breathable linen fabric with straight-leg cut — perfect for summer or resort wear.', '149', 3, 0, '21567c756dcce73053fec7a04a6a6101.jpg', 14, 13, 8, 29, 15),
(46, 'High-Waist Wide-Leg Trousers', 'Flowing wide-leg trousers with high-rise waist — elegant and perfect for work or chic casual looks.', '236', 2, 0, '5a5ecb9e1d7dd521f13a74592b1af185.jpg', 13, 23, 7, 29, 15),
(47, 'Tapered Cargo Trousers', 'Baggy cargo pants with integrated belt and multiple pockets — functional and stylish.', '290', 3, 0, '23606a979e992ab5f72bd95b35e2a1e4.jpg', 14, 10, 8, 30, 15),
(48, 'High-Waist Paperbag Cargo Pants', 'Waist gathered with belt, cargo pockets on thighs — feminine fit and trendy silhouette.', '239', 2, 0, '3f32da9f59945a2e8977f7f0abbd7fb3.jpg', 14, 21, 13, 30, 15),
(49, 'Casual Baggy Jeans', 'DAZY Women\'s Simple Button-Front Multi-Pocket Casual Baggy Jeans', '239', 2, 0, 'cde280b90710a2f6dd12e32ad5ac1f4b.jpg', 14, 9, 13, 31, 15),
(50, 'Black Straight Fit Denim', 'Black straight jean with medium waist', '249', 3, 0, 'e26ed6375a9641d66c9d803f77b6d369.jpg', 13, 11, 13, 31, 15),
(51, 'Grey normal fit denim', 'Grey high waist normal fit denim', '229', 2, 0, '67c48561de04dde6c85a59c9ab9245d1.jpg', 12, 15, 13, 31, 15),
(52, ' Banarasi tissue saree', 'Beautiful soft Banarasi tissue saree with beautiful borders and blouse', '300', 2, 0, '7ec1aa38539c6c7d41f9bc35569a1422.jpg', 16, 16, 11, 38, 17),
(53, 'Pattu Saree ', 'Light Pink With Golden Kasavu Pattu Saree', '260', 2, 0, '362bbc51d112e283f46c42f64663c499.jpg', 16, 16, 11, 38, 17),
(54, 'Red kasavu saree', 'Red Saree with Golden Kasavu', '240', 2, 0, '32cc51d7084daa4d949452bcdbb044d0.jpg', 16, 10, 11, 38, 17),
(55, ' Rose Gold Sherwani', 'Handmade Rose Gold Sherwani for Men', '250', 1, 0, 'a5b47a77d6332c7c32c28793df577b63.jpg', 14, 22, 8, 39, 17),
(56, 'Navy blue blazers ', 'formal Navy blue blazers with white shirt', '350', 1, 0, 'handsome-groom-wedding-suit-posting-park.jpg', 14, 20, 20, 41, 17),
(57, 'Light Blue Silk  Kurta Set', 'Light Blue Silk Printed Handcrafted Kurta Set', '450', 1, 0, '83598226861eacd215d6d2888ec0fe89.jpg', 14, 26, 17, 40, 17),
(58, 'Red with Off White lehenga set', 'Embroidery Red with Off White lehenga set', '1200', 2, 0, 'ede75b0267675dbcd3cc0d97b2678555.jpg', 14, 10, 12, 35, 17),
(59, 'Anarkali set', 'Heavy work anarkali set', '550', 2, 0, '4a92f4449cae403c11b2076821cdaf72.jpg', 13, 17, 17, 36, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(20) NOT NULL,
  `seller_email` varchar(50) NOT NULL,
  `seller_contact` varchar(11) NOT NULL,
  `seller_address` varchar(500) NOT NULL,
  `seller_photo` varchar(100) NOT NULL,
  `seller_proof` varchar(100) NOT NULL,
  `seller_password` varchar(10) NOT NULL,
  `place_id` int(11) NOT NULL,
  `seller_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_email`, `seller_contact`, `seller_address`, `seller_photo`, `seller_proof`, `seller_password`, `place_id`, `seller_status`) VALUES
(17, 'Danush', 'danush@gmail.com', '7012465388', 'green Nagar Cross, Ram nagar, kollam-563016', 'successful-businessman.jpg', 'proof.jpg', 'Danush@22', 33, 1),
(20, 'Ram K R', 'ram@gmail.com', '7893460119', 'Ashoka Villa, 21, Hilltop Street, Kottayam Junction, Kottayam, Kerala — PIN 686543', 'medium-shot-man-posing-indoors.jpg', 'proof.jpg', 'Ram@1234', 87, 1),
(21, 'Chethan ', 'chethan@gmail.com', '7985632456', 'Kasaba Residence, 5, Mango Walk, Kasaragod Central, Kasaragod, Kerala — PIN 671900', 'front-view-smiley-woman-holding-coffee-cup.jpg', 'proof.jpg', 'Chethan@45', 114, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_name`) VALUES
(11, 'XS'),
(12, 'S'),
(13, 'M'),
(14, 'L'),
(15, 'XL'),
(16, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `stock_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_count`, `product_id`, `size_id`, `color_id`, `stock_date`) VALUES
(21, 3, 25, 4, 5, '2025-09-22'),
(22, 5, 24, 7, 3, '2025-09-22'),
(24, 10, 25, 6, 4, '2025-09-22'),
(25, 5, 27, 4, 4, '2025-11-01'),
(26, 7, 28, 6, 5, '2025-11-01'),
(27, 45, 29, 12, 10, '2025-11-03'),
(28, 4, 29, 12, 12, '2025-11-03'),
(29, 5, 30, 12, 10, '2025-11-03'),
(30, 6, 31, 13, 8, '2025-11-03'),
(31, 1, 32, 14, 8, '2025-11-03'),
(32, 1, 32, 13, 9, '2025-11-03'),
(33, 1, 33, 12, 11, '2025-11-03'),
(34, 3, 33, 15, 9, '2025-11-03'),
(35, 1, 36, 14, 8, '2025-11-12'),
(36, 1, 36, 13, 8, '2025-11-12'),
(37, 1, 36, 13, 13, '2025-11-12'),
(38, 1, 46, 13, 23, '2025-11-12'),
(39, 1, 46, 15, 8, '2025-11-12'),
(40, 2, 46, 13, 14, '2025-11-12'),
(41, 1, 42, 13, 15, '2025-11-12'),
(42, 1, 42, 14, 9, '2025-11-12'),
(43, 2, 42, 13, 20, '2025-11-12'),
(44, 2, 37, 15, 8, '2025-11-12'),
(45, 1, 37, 12, 9, '2025-11-12'),
(46, 1, 82, 13, 22, '2025-11-12'),
(47, 1, 40, 14, 21, '2025-11-12'),
(48, 1, 39, 12, 13, '2025-11-12'),
(49, 1, 81, 14, 13, '2025-11-12'),
(50, 1, 80, 12, 8, '2025-11-12'),
(51, 1, 80, 13, 14, '2025-11-12'),
(52, 1, 80, 14, 23, '2025-11-12'),
(53, 2, 80, 15, 9, '2025-11-12'),
(54, 1, 72, 13, 15, '2025-11-12'),
(55, 1, 68, 13, 17, '2025-11-12'),
(56, 2, 61, 13, 13, '2025-11-12'),
(57, 1, 59, 15, 24, '2025-11-12'),
(58, 1, 60, 12, 10, '2025-11-12'),
(59, 1, 62, 13, 11, '2025-11-12'),
(60, 2, 49, 13, 23, '2025-11-12'),
(61, 1, 56, 14, 13, '2025-11-12'),
(62, 1, 77, 12, 11, '2025-11-12'),
(63, 2, 36, 13, 14, '2025-11-12'),
(64, 2, 45, 12, 8, '2025-11-12'),
(65, 3, 44, 16, 18, '2025-11-12'),
(66, 1, 58, 14, 9, '2025-11-12'),
(67, 2, 57, 15, 8, '2025-11-12'),
(68, 1, 65, 14, 8, '2025-11-12'),
(69, 1, 64, 13, 11, '2025-11-12'),
(70, 1, 48, 12, 21, '2025-11-12'),
(71, 2, 75, 13, 14, '2025-11-12'),
(72, 3, 41, 13, 20, '2025-11-19'),
(73, 2, 41, 12, 12, '2025-11-19'),
(74, 3, 55, 13, 13, '2025-11-19'),
(75, 2, 55, 15, 21, '2025-11-19'),
(76, 2, 63, 13, 14, '2025-11-19'),
(77, 1, 63, 13, 16, '2025-11-19'),
(78, 2, 54, 14, 11, '2025-11-19'),
(79, 6, 54, 12, 23, '2025-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `subcategory_photo` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `subcategory_photo`, `category_id`) VALUES
(16, 'Knitwear', 'download (5).jpeg', 27),
(17, 'Tunics', 'download (6).jpeg', 27),
(19, 'Shirts', 'images (2).jpeg', 27),
(20, 'Hoodies', 'download (8).jpeg', 27),
(21, 'Sweatshirts', 'download (9).jpeg', 27),
(23, 'Shackets (Shirt Jackets)', 'download (10).jpeg', 26),
(24, 'Leather Jackets', 'download (12).jpeg', 26),
(25, 'Denim Jackets', 'download (13).jpeg', 26),
(26, 'T Shirts', 'download (14).jpeg', 27),
(27, 'Casual Two-Piece Set', 'download (15).jpeg', 28),
(28, 'Linen Co-ord', 'Natural_Off_White_Cotton_Linen_Co-Ord_Set_-_Palla_Jaipur-5920034.webp', 28),
(29, 'Trousers', 'download (16).jpeg', 30),
(30, 'Cargo Pants', 'download (17).jpeg', 30),
(31, 'Jeans', 'download (18).jpeg', 30),
(32, 'Mini Dress', 'images (3).jpeg', 29),
(33, 'Bodycon Dress', 'download.jpeg', 29),
(34, 'Tunic Dress', 'download (1).jpeg', 29),
(35, 'Lehenga', '4b712a4bc87dfaf372dde846b13853a8.jpg', 31),
(36, 'Salwar Kameez / Anarkali', '4a92f4449cae403c11b2076821cdaf72.jpg', 31),
(37, 'Bridal gowns', 'f73fa82c004adf1e5a5d11831f109b83.jpg', 31),
(38, 'Saree', '1f5763a5be9c46ddf46f0e156fb34426.jpg', 31),
(39, 'Sherwanis', '1be7705cdd1b9ebd64a6ad67a46700af.jpg', 31),
(40, 'Kurtas / Kurta sets', '164b09f89a59a445a85abf01e8375876.jpg', 31),
(41, 'Blazers & Sports jackets', '50aad2931f8ccd691379db4667f5fb98.jpg', 31);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contact` varchar(10) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_photo` varchar(200) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `user_photo`, `user_password`, `place_id`) VALUES
(15, 'Akshay Kumar', 'akshay@gmail.com', '9947865724', 'Akshya Nagar 1st Block 1st Cross, Rammurthy nagar,', 'indian-businessman-with-his-white-car.jpg', 'Akshay@22', 68),
(16, 'Meera Prasand', 'meera@gmail.com', '7786549629', 'seetha Illam, 12/45 Rosewood Lane, Vazhuthacaud, T', 'portrait-happy-excited-asian-girl-adjusting-hair.jpg', 'Meera@12', 28),
(17, 'Lisa Elizabath', 'lisa@gmail.com', '9878503245', 'Malabar Corner, No. 6, Seaside Avenue, Kozhikode B', 'cheerful-traditional-indian-woman-white-background-studio-shot.jpg', 'Lisa@345', 118),
(18, 'Ron Kurian', 'ron@gmail.com', '9947658218', 'Sunrise Cottage, House No. 7, Backwater View, Alap', 'front-view-smiley-man-holding-camera.jpg', 'Ron@5470', 86),
(19, 'Archana', 'archanaop2255@gmail.com', '', 'Ozhukayil(H) chulliyode po mangalamcarp', '', '', 0),
(20, 'Archana', 'archanaop2255@gmail.com', '9987655495', 'Ozhukayil(H) chulliyode po mangalamcarp', 'woman-model-demonstrating-winter-cloths.jpg', 'Aghfy@55', 68);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_gender_product` (`gender_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_rentproductbooking`
--
ALTER TABLE `tbl_rentproductbooking`
  ADD PRIMARY KEY (`rentproductbooking_id`);

--
-- Indexes for table `tbl_rentproducts`
--
ALTER TABLE `tbl_rentproducts`
  ADD PRIMARY KEY (`rentproduct_id`),
  ADD KEY `fk_rentproducts_gender` (`gender_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_rentproductbooking`
--
ALTER TABLE `tbl_rentproductbooking`
  MODIFY `rentproductbooking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_rentproducts`
--
ALTER TABLE `tbl_rentproducts`
  MODIFY `rentproduct_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_gender_product` FOREIGN KEY (`gender_id`) REFERENCES `tbl_gender` (`gender_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rentproducts`
--
ALTER TABLE `tbl_rentproducts`
  ADD CONSTRAINT `fk_rentproducts_gender` FOREIGN KEY (`gender_id`) REFERENCES `tbl_gender` (`gender_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
