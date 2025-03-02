-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2025 at 12:28 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(18, 'پودر چربی', '💥 پودر چربی حیوانی با کیفیت عالی 💥\r\nپودر چربی حیوانی ما، محصولی با منشاء طبیعی است که به دقت از بهترین منابع چربی حیوانی استخراج شده و فرآوری می‌شود. این محصول با خاصیت‌های شگفت‌انگیز خود، به عنوان یک افزودنی مغذی در صنایع مختلف از جمله تولید مواد غذایی، دارویی و بهداشتی کاربرد دارد.\r\n🔥 ویژگی‌ها و مزایا:\r\n✔️ انرژی‌زا و مغذی برای تقویت سیستم بدن\r\n✔️ حاوی اسیدهای چرب ضروری برای بهبود سلامت\r\n✔️ بهبود طعم و بافت محصولات غذایی\r\n✔️ استفاده گسترده در تولید لوازم بهداشتی و دارویی\r\nبا استفاده از پودر چربی حیوانی ما، به راحتی می‌توانید محصولات خود را با کیفیتی برتر و طعمی متفاوت به بازار ارائه دهید. این محصول، انتخابی ایده‌آل برای حرفه‌ای‌هاست که به کیفیت اهمیت می‌دهند.\r\n💎 انتخابی مطمئن برای کیفیت و نوآوری! 💎', '110000', 'mahsol1.jpg', '2025-02-24 11:15:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
