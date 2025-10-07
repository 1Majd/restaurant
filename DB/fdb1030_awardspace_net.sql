-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb1030.awardspace.net
-- Generation Time: Oct 07, 2025 at 07:23 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4516727_admin`
--
CREATE DATABASE IF NOT EXISTS `4516727_admin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `4516727_admin`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image-name` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image-name`, `featured`, `active`) VALUES
(24, 'Burgers', 'Category_689.jpeg', 'yes', 'yes'),
(25, 'Sandwiches', 'Category_992.jpeg', 'yes', 'yes'),
(26, 'Pizza ', 'Category_264.jpg', 'yes', 'yes'),
(27, 'Shawarma', 'Category_951.jpeg', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `discripton` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image-name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `quantity` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `discripton`, `price`, `image-name`, `category_id`, `quantity`) VALUES
(24, 'Classic Cheeseburger', 'A juicy beef patty topped with melted cheddar cheese, lettuce, tomato, pickles, and a dollop of ketchup and mustard, all sandwiched between a freshly baked bun.', 5.00, 'Food_Name_818.avif', 24, 14),
(25, 'Bacon BBQ Burger', 'A succulent beef patty layered with crispy bacon, tangy BBQ sauce, cheddar cheese, and crispy onion rings, served on a toasted bun.', 6.00, 'Food_Name_706.jpg', 24, 25),
(26, 'Veggie Burger', 'A flavorful patty made from black beans and vegetables, topped with avocado, tomato, lettuce, and a spicy mayo, served on a whole-grain bun.', 7.00, 'Food_Name_178.jpeg', 24, 20),
(27, 'Chicken Tawouk Sandwich', 'Grilled marinated chicken breast in a blend of Middle Eastern spices, served in a pita bread with garlic sauce, pickles, and lettuce.', 5.00, 'Food_Name_653.jpeg', 25, 49),
(28, 'Chicken Fajita Sandwich', ' Juicy strips of chicken seasoned with fajita spices, grilled with bell peppers and onions, topped with melted cheese, and served on a soft sub roll.', 7.00, 'Food_Name_977.jpeg', 25, 60),
(29, 'Crispy Chicken Sandwich', 'A crispy fried chicken breast topped with lettuce, tomato, and mayo, served on a toasted brioche bun.', 4.00, 'Food_Name_447.jpeg', 25, 30),
(30, 'Philadelphia Cheesesteak', 'Thinly sliced steak cooked with onions and green peppers, topped with melted provolone cheese, and served in a soft hoagie roll.', 8.00, 'Food_Name_201.jpeg', 25, 14),
(31, 'Spicy Grilled Chicken Sandwich', 'Grilled chicken breast with a spicy rub, topped with pepper jack cheese, jalapeños, and chipotle mayo, served on a toasted ciabatta roll.\r\n', 9.00, 'Food_Name_46.jpeg', 25, 10),
(33, 'Margherita Pizza', 'A classic pizza topped with fresh mozzarella, tomatoes, basil, and a drizzle of extra-virgin olive oil on a tomato sauce base.', 3.00, 'Food_Name_217.jpeg', 26, 20),
(34, 'Pepperoni Pizza', 'A crowd favorite with a generous layer of pepperoni slices, melted mozzarella cheese, and a rich tomato sauce.', 9.00, 'Food_Name_797.jpeg', 26, 15),
(35, 'Veggie Supreme Pizza', 'Loaded with a variety of fresh vegetables including bell peppers, onions, mushrooms, olives, and spinach, all topped with mozzarella cheese.', 10.00, 'Food_Name_708.jpeg', 26, 20),
(36, 'Turkish Shawarma', 'Thinly sliced, marinated beef or lamb, slow-cooked on a vertical rotisserie, served in flatbread with lettuce, tomatoes, onions, and a tangy yogurt sauce.', 10.00, 'Food_Name_519.jpeg', 27, 20),
(37, 'Beef Shawarma (Shawarma La7mi)', 'Tender beef marinated in a mix of spices, cooked on a rotisserie, and wrapped in pita bread with garlic sauce, pickles, and tomatoes.', 3.00, 'Food_Name_379.jpeg', 27, 49),
(38, 'Chicken Shawarma (Shawarma Djej)', 'Marinated chicken thighs, grilled to perfection, served in pita bread with a creamy garlic sauce, cucumbers, and onions.\r\n', 2.00, 'Food_Name_605.jpeg', 24, 50),
(39, 'Mixed Shawarma', 'A delicious combination of beef and chicken shawarma, served with fresh vegetables, pickles, and a drizzle of tahini sauce, wrapped in soft flatbread.', 5.00, 'Food_Name_174.jpeg', 27, 19),
(40, 'Lamb Shawarma', 'Succulent slices of marinated lamb, grilled on a vertical spit, wrapped in lavash bread with fresh parsley, onions, and a squeeze of lemon juice.', 10.00, 'Food_Name_332.jpeg', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `iadmin`
--

CREATE TABLE `iadmin` (
  `id` int UNSIGNED NOT NULL,
  `full-name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user-name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iadmin`
--

INSERT INTO `iadmin` (`id`, `full-name`, `user-name`, `password`) VALUES
(32, 'admin', 'admin1', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-order`
--

CREATE TABLE `tbl-order` (
  `id` int UNSIGNED NOT NULL,
  `food` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order-date` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer-name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `customer-contact` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `customer-email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `customer-address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl-order`
--

INSERT INTO `tbl-order` (`id`, `food`, `price`, `qty`, `total`, `order-date`, `status`, `customer-name`, `customer-contact`, `customer-email`, `customer-address`) VALUES
(60, 'Beef Shawarma (Shawarma La7mi)', 3.00, 1, 3.00, '2025-06-05 16:05:50', 'Pending', 'Mm', '71011358', 'majdmhanna068@gmail.com', 'Rachaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iadmin`
--
ALTER TABLE `iadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl-order`
--
ALTER TABLE `tbl-order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `iadmin`
--
ALTER TABLE `iadmin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl-order`
--
ALTER TABLE `tbl-order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
