-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2021 at 03:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nifticals_db_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountfulltbl`
--

DROP TABLE IF EXISTS `accountfulltbl`;
CREATE TABLE IF NOT EXISTS `accountfulltbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone_num` bigint(20) NOT NULL,
  `country_phone_num` smallint(6) NOT NULL,
  `user_birth` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_state_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_action` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `admin_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountfulltbl`
--

INSERT INTO `accountfulltbl` (`id`, `user_id`, `phone_num`, `country_phone_num`, `user_birth`, `user_street`, `user_city`, `user_state`, `user_state_code`, `zipcode`, `admin_action`, `admin_comments`, `created_at`, `updated_at`) VALUES
(1, 1, 7908194389, 91, '2021-04-07 18:30:00', 'Apexno', 'Phenox', 'Arioxi', 'TZ', '85004', 'yes', NULL, '2021-04-07 18:30:00', '2021-04-07 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$TtHiDxJ6.Ds4vhwlM2beOuz8lL8heSTXBj/xFGBP84eEmsCaFqYu.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auction_product_img_tbls`
--

DROP TABLE IF EXISTS `auction_product_img_tbls`;
CREATE TABLE IF NOT EXISTS `auction_product_img_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auction_product_images` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `auction_product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction_product_img_tbls`
--

INSERT INTO `auction_product_img_tbls` (`id`, `auction_product_images`, `auction_product_id`, `created_at`, `updated_at`) VALUES
(1, 'public/auction801/VSKmEEWtxKYhJR8kIGDTekrvR2IWTSgg9gxUCRk7.png', 1, NULL, NULL),
(2, 'public/auction801/Zk17qvqBXbESMghEU5G7cI99TlKGq9X4hwn6BvlE.png', 1, NULL, NULL),
(3, 'public/auction801/Wviv8RduO4hXM1hLuOso28lo5GpvN3S0uwrq8QWG.png', 1, NULL, NULL),
(4, 'public/auction801/Hv46fAMs30unhMq7t1v3tOmP4RMJW6jv2O8awIGM.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auction_product_tbls`
--

DROP TABLE IF EXISTS `auction_product_tbls`;
CREATE TABLE IF NOT EXISTS `auction_product_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_full_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_additional_information` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unique_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `auction_time` bigint(20) NOT NULL,
  `product_available_status` enum('available','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction_product_tbls`
--

INSERT INTO `auction_product_tbls` (`id`, `category_id`, `sub_category_id`, `product_name`, `product_short_description`, `product_full_description`, `product_additional_information`, `product_unique_code`, `product_thumbnail`, `auction_time`, `product_available_status`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Auction Product', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '55622968', 'public/auction/thumbnail/UY75LWwFQSUtUn8G9jj3QmfdOK0h6LgWXbmE7zeU.jpg', 150, 'available', 'active', NULL, '2021-06-23 08:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `banner_tbl`
--

DROP TABLE IF EXISTS `banner_tbl`;
CREATE TABLE IF NOT EXISTS `banner_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_heading_quote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_heading_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_paragraph` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_img` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_tbl`
--

INSERT INTO `banner_tbl` (`id`, `banner_heading_quote`, `banner_heading_name`, `banner_paragraph`, `banner_img`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 'Nifticals', 'Physical NFT\'s', 'Bringing art from your digital wallet to your wall.', 'public/banners/banner26662/8FdZ13o5VjZ0fTzQCpfqNnPAADeWPIpqUxXAOrN2.png', 'active', '1617086958', '1617094954');

-- --------------------------------------------------------

--
-- Table structure for table `billing_address_tbl`
--

DROP TABLE IF EXISTS `billing_address_tbl`;
CREATE TABLE IF NOT EXISTS `billing_address_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_one` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_two` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_num` bigint(20) DEFAULT NULL,
  `email_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_action` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbls`
--

DROP TABLE IF EXISTS `cart_tbls`;
CREATE TABLE IF NOT EXISTS `cart_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_ip` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_product_id` int(11) NOT NULL DEFAULT 0,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `admin_action` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_tbls`
--

INSERT INTO `cart_tbls` (`id`, `user_id`, `user_ip`, `product_id`, `product_name`, `additional_product_id`, `product_price`, `product_quantity`, `admin_action`, `created_at`, `updated_at`) VALUES
(6, 0, '127.0.0.1', 6, 'test', 13, 45.00, 1, 'active', '2021-04-21 18:30:00', '2021-04-21 18:30:00'),
(7, 0, '127.0.0.1', 6, 'test', 0, 45.00, 1, 'active', '2021-05-05 18:30:00', '2021-05-05 18:30:00'),
(8, 0, '127.0.0.1', 3, 'Product 02', 0, 199.00, 1, 'active', '2021-06-02 18:30:00', '2021-06-02 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_03_01_101608_create_admins_table', 1),
(4, '2021_03_04_102838_create-product-category-tbl', 2),
(6, '2021_03_05_051410_create-sub-category', 3),
(8, '2021_03_05_093002_create-product-table', 4),
(9, '2021_03_05_095322_create-product-images-tbl', 5),
(10, '2021_03_11_071539_create-subscribe-tbls', 6),
(11, '2021_03_25_112920_create-payment-tbl', 7),
(12, '2021_03_26_092448_create-banner-tbl', 8),
(13, '2021_04_05_085209_create-reviews-tbl', 9),
(14, '2021_04_07_111302_create-user-full-address-table', 10),
(15, '2021_04_08_072617_alter-my-account-table-add-country-code-column', 11),
(16, '2021_04_13_074954_create-product-additional-data', 12),
(17, '2021_04_13_122215_alter-product-additional-tbl', 13),
(18, '2021_04_14_094941_create-cart-table', 14),
(19, '2021_04_14_122036_alter-cart-table', 15),
(20, '2021_05_10_130538_create-billing-address-tbl', 16),
(21, '2021_05_10_130619_create-shipping-address-tbl', 16),
(22, '2021_05_19_122130_create_payments_table', 17),
(23, '2021_05_21_105641_create-order-details-tbl', 18),
(24, '2021_05_24_070550_alter-add-tracking-table', 19),
(25, '2021_06_23_045130_create-auction-product-tbls', 20),
(27, '2021_06_23_045252_create-auction-product-img-tbls', 21);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_product_id` int(11) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placed_ordered',
  `admin_action` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

DROP TABLE IF EXISTS `payment_tbl`;
CREATE TABLE IF NOT EXISTS `payment_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `admin_action` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`id`, `user_id`, `user_name`, `payment_status`, `admin_action`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', 'no', 'yes', '2021-03-26 06:15:51', '2021-03-26 03:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_additional_tbl`
--

DROP TABLE IF EXISTS `product_additional_tbl`;
CREATE TABLE IF NOT EXISTS `product_additional_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_customize_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_customize_link` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional_status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_additional_tbl`
--

INSERT INTO `product_additional_tbl` (`id`, `product_id`, `product_customize_name`, `product_customize_link`, `user_ip`, `user_id`, `created_at`, `updated_at`, `additional_status`) VALUES
(1, 4, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-12 18:30:00', '2021-04-14 00:39:25', 'off'),
(2, 5, 'New Test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-13 18:30:00', 'on'),
(3, 4, 'New Test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-14 00:39:25', 'off'),
(4, 4, 'Web Logos', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-14 00:39:25', 'off'),
(5, 4, 'Nifticals', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-13 18:30:00', 'on'),
(6, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-22 05:43:27', 'off'),
(7, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-22 05:43:27', 'off'),
(8, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-22 05:43:27', 'off'),
(9, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-13 18:30:00', '2021-04-22 05:43:27', 'off'),
(10, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-18 18:30:00', '2021-04-22 05:43:27', 'off'),
(11, 1, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-21 18:30:00', '2021-04-21 18:30:00', 'on'),
(12, 3, 'New Test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-21 18:30:00', '2021-04-21 18:30:00', 'on'),
(13, 6, 'test', 'https://nifticals.io/', '127.0.0.1', 0, '2021-04-21 18:30:00', '2021-04-21 18:30:00', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_quote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_name`, `category_quote`, `admin_status`, `created_at`, `updated_at`) VALUES
(3, 'category1', '', 'active', NULL, '2021-04-06 03:50:43'),
(4, 'category2', 'Lorem ipsum is used for testing ...', 'active', NULL, '2021-03-05 01:26:02'),
(5, 'category3', '', 'active', NULL, '2021-03-04 23:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_img_tbls`
--

DROP TABLE IF EXISTS `product_img_tbls`;
CREATE TABLE IF NOT EXISTS `product_img_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_images` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_img_tbls`
--

INSERT INTO `product_img_tbls` (`id`, `product_images`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 'public/gallery87655/3r02Sbvclu9A0DXJdNuYCSSBYKifd0OINvwBV5OA.png', 1, NULL, NULL),
(10, 'public/gallery87655/VbJNcxaJkYyqmZIrxujsRcGMMexoa857f7UkvD7S.png', 1, NULL, NULL),
(12, 'public/gallery54559/RONoyuEhsQncT60yF5T3yrthPvEsmwLMcs8ZQNFi.jpg', 3, NULL, NULL),
(13, 'public/gallery54559/BBT5GhHWmtRJdGOykkjk5luxd7FKO18tlrbWCw0H.jpg', 3, NULL, NULL),
(14, 'public/gallery54559/dWNw3JdnY7mxrmzxRevBOEGg0dnQhvAlcncBPhoK.png', 3, NULL, NULL),
(15, 'public/gallery54559/u64u9ImIGejkkMzix5COmluQfSBMK7PjwCT9eARe.jpg', 3, NULL, NULL),
(16, 'public/gallery96737/nULq0Nc1DhWlXYagE03oZcCN9buMoOjDCFz95t7m.jpg', 4, NULL, NULL),
(17, 'public/gallery96737/LMhg13XohovkNOerL6A0ov4pcOGaiSXRDjMnaW6Z.jpg', 4, NULL, NULL),
(18, 'public/gallery96737/RHwunj9lqLL7kElaciCzv2LQRyocLBDAuSNKssuV.png', 4, NULL, NULL),
(19, 'public/gallery96737/tB61PdxSK5wPOv81BcxkSIY8bL7KIotxTEIz911F.jpg', 4, NULL, NULL),
(20, 'public/gallery73760/gM8oUL8PmRkYU8KVSSC5gYmYDv7AWYxDP5AL7jHK.jpg', 5, NULL, NULL),
(21, 'public/gallery73760/HvHdAu8ORLtkij1ZAWLlBEsLf5KQBZjJofDGTJjS.png', 5, NULL, NULL),
(23, 'public/gallery73760/3CEwafENf9NEnvCKMb2HDSsvSbvgbpa5uj8vaBs8.png', 5, NULL, NULL),
(24, 'public/gallery73760/dmZjgEwIq7gv2wTBs5IFDsHGtJeDl883mQ0s8KFZ.png', 5, NULL, NULL),
(25, 'public/gallery73760/AfB9Oi8vpPJYdKa3jMgP4At4rJ2hYsuQPFug092t.jpg', 5, NULL, NULL),
(26, 'public/gallery87655/OpepMEylBoC4GZrXOVY417rStvvqqSfORzlKVIcM.png', 1, NULL, NULL),
(27, 'public/gallery87655/IzGm9o4erwEECWBaWKKoUp35mWvPODjSHxNkQqhf.png', 1, NULL, NULL),
(28, 'public/gallery6910/zJbglqmyxLroAGDQ6m1bMGG2VH5ZvfdJCznULgHy.jpg', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbls`
--

DROP TABLE IF EXISTS `product_tbls`;
CREATE TABLE IF NOT EXISTS `product_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_full_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_additional_information` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unique_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_stock` bigint(20) NOT NULL DEFAULT 0,
  `product_thumbnail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_available_status` enum('available','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tbls`
--

INSERT INTO `product_tbls` (`id`, `category_id`, `sub_category_id`, `product_name`, `product_price`, `product_short_description`, `product_full_description`, `product_additional_information`, `product_unique_code`, `product_stock`, `product_thumbnail`, `product_available_status`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Product 01', 199.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '25438347', 25, 'public/thumbnail/8XhyvAtlycn6Q1Pf3QvowlQT7SIGhbGin8upnAVi.jpg', 'available', 'active', NULL, '2021-05-05 23:34:33'),
(3, 3, 1, 'Product 02', 199.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '43735841', 99, 'public/thumbnail/MMNBYcgbCw863EFIN9PwW0FExBwG5dTrZ9nUTYYQ.png', 'available', 'active', NULL, NULL),
(4, 3, 1, 'Product 03', 399.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '12093680', 89, 'public/thumbnail/mOrkmc5ZlIewnIlPDTSqpVWtsiijsn2iLO11PkyD.jpg', 'available', 'active', NULL, '2021-04-02 00:37:29'),
(5, 3, 2, 'Product 04', 199.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '32973025', 199, 'public/thumbnail/UIIk4Fkq5CwRDHZ1GzL0sLLvNuvRNWrxsjPrYSQ8.png', 'available', 'active', NULL, '2021-04-22 02:01:06'),
(6, 3, 1, 'test', 45.00, NULL, NULL, 'dgfg', '72608512', 34, 'public/thumbnail/YbHlPwfcbJ8yTYgKwlezbPrKQ0nypC19W3KXsqRE.png', 'available', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_tbl`
--

DROP TABLE IF EXISTS `reviews_tbl`;
CREATE TABLE IF NOT EXISTS `reviews_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `review_start_count` tinyint(4) NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews_tbl`
--

INSERT INTO `reviews_tbl` (`id`, `product_id`, `review_start_count`, `customer_name`, `customer_msg`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Satirtha Das', '', '2021-04-04 18:30:00', '2021-04-04 18:30:00'),
(2, 1, 5, 'Raj Das', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-04-04 18:30:00', '2021-04-04 18:30:00'),
(3, 3, 4, 'Satirtha Das', 'Lorem test', '2021-04-05 18:30:00', '2021-04-05 18:30:00'),
(4, 3, 4, 'Ram ', 'Lorem test', '2021-04-06 18:30:00', '2021-04-06 18:30:00'),
(5, 1, 3, 'Test', 'test', '2021-04-20 18:30:00', '2021-04-20 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address_tbl`
--

DROP TABLE IF EXISTS `shipping_address_tbl`;
CREATE TABLE IF NOT EXISTS `shipping_address_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_one` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_two` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_num` bigint(20) DEFAULT NULL,
  `email_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_action` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_tbls`
--

DROP TABLE IF EXISTS `subscriber_tbls`;
CREATE TABLE IF NOT EXISTS `subscriber_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscriber_email_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriber_tbls`
--

INSERT INTO `subscriber_tbls` (`id`, `subscriber_email_address`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 'satirtha63@gmail.com', 'active', NULL, '2021-04-12 00:17:38'),
(3, 'satirtha64@gmail.com', 'active', NULL, NULL),
(4, 'satirtha.kreative@gmail.com', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_tbls`
--

DROP TABLE IF EXISTS `sub_category_tbls`;
CREATE TABLE IF NOT EXISTS `sub_category_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_quote` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category_tbls`
--

INSERT INTO `sub_category_tbls` (`id`, `category_id`, `sub_category_name`, `sub_category_quote`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 3, 'subcategory1', '', 'active', NULL, '2021-03-05 03:49:31'),
(2, 3, 'subcategory2', '', 'active', NULL, '2021-03-05 03:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Satirtha Das', 'satirtha63@gmail.com', NULL, '$2y$10$eufTcuLcQGpdt8G8yONL5uPO.yE9sl9FFogclib03M5K8bQq9iIoG', NULL, '2021-04-07 05:08:05', '2021-04-08 07:19:35'),
(2, 'Satirtha', 'admin@gmail.com', NULL, '$2y$10$zmuGwvUZicksWjHpP.HfL./Cr6gk44UDduJ86Rqnv5FlpDUspZtqK', NULL, '2021-04-07 05:09:02', '2021-04-07 05:09:02'),
(3, 'CMS', 'james@outdoorlivingtoday.com', NULL, '$2y$10$L7z5C5oJuOAhoE4.EZgrr.FqCtNi9jV45QqP/1arLhVBcTEL6kItO', NULL, '2021-04-07 05:29:59', '2021-04-07 05:29:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
