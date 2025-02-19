-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 02:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_std_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(20) NOT NULL,
  `admin_pass` varchar(20) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `date_save` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_user`, `admin_pass`, `admin_name`, `date_save`) VALUES
(1, '1', '1', 'admin', '2024-08-29 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `b_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `b_number` varchar(20) NOT NULL,
  `b_owner` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `b_logo` varchar(100) NOT NULL,
  `bn_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อสาขา',
  `b_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='bank';

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`b_id`, `b_name`, `b_type`, `b_number`, `b_owner`, `b_logo`, `bn_name`, `b_date`) VALUES
(3, 'KTB', 'ออมทรัพย์', '123-456-7890', 'devbanban.com', 'imgb44167291820180125_105825.jpg', 'ภูเก็ต', '2024-08-29 09:00:00'),
(5, 'KBANK', 'ออมทรัพย์', '987-654-3210', 'devbanban.com', 'imgb158414898420180125_111725.jpg', 'ภูเก็ต', '2024-08-29 09:00:00'),
(4, 'SCB', 'ออมทรัพย์', '555-666-7777', 'devbanban.com', 'imgb89969485620180125_105814.jpg', 'ภูเก็ต', '2024-08-29 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mem_id` int(8) NOT NULL,
  `mem_name` varchar(50) NOT NULL,
  `mem_address` varchar(255) NOT NULL,
  `mem_tel` varchar(10) NOT NULL,
  `mem_username` varchar(20) NOT NULL,
  `mem_password` varchar(20) NOT NULL,
  `mem_email` varchar(20) NOT NULL,
  `dateinsert` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`mem_id`, `mem_name`, `mem_address`, `mem_tel`, `mem_username`, `mem_password`, `mem_email`, `dateinsert`) VALUES
(8, 'gggg', '11/11', '0987654321', 'gggg', 'gggg', 'gggg@gmail.com', '2024-09-05 07:58:01'),
(7, '1234', '1234567890', '0987654322', '1234', '1234', '1234@g.com', '2024-08-29 09:55:53'),
(6, 'oppo', 'ประเทศจีนแดง', '0987654321', 'oppo', '1234', 'oppo1234@gmail.com', '2024-08-29 08:51:58'),
(9, '3', '3', '3', '333', '333', 'oppo.fa123456@gmail.', '2025-02-06 09:57:29'),
(10, 'ฟาอิบ', '0999', '191', 'oppo123', 'aaaa', 'oppo.fa123456@gmail.', '2025-02-14 06:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `n_id` int(11) NOT NULL,
  `n_title` varchar(200) NOT NULL,
  `n_detail` text NOT NULL,
  `n_img` varchar(100) NOT NULL,
  `date_save` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`n_id`, `n_title`, `n_detail`, `n_img`, `date_save`) VALUES
(1, '  //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย ', '<p>111</p>\r\n\r\n<p>error_reporting( error_reporting() &amp; ~E_NOTICE );<br />\r\n&nbsp;<br />\r\n&nbsp;//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย<br />\r\n&nbsp; &nbsp; date_default_timezone_set(&#39;Asia/Bangkok&#39;);<br />\r\n&nbsp;&nbsp; &nbsp;//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด<br />\r\n&nbsp;&nbsp; &nbsp;$date1 = date(&quot;Ymd_His&quot;);<br />\r\n&nbsp;&nbsp; &nbsp;//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน<br />\r\n&nbsp;&nbsp; &nbsp;$numrand = (mt_rand());</p>\r\n', 'imgn171694429820170830_101819.jpg', '2024-08-29 09:00:00'),
(2, 'asfdsadfsa', '<p>fsadfsadfasfdsafdsa</p>\r\n', 'imgn25458224820170830_101829.jpg', '2024-08-29 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `mem_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `order_status` int(1) NOT NULL,
  `pay_slip` varchar(200) DEFAULT NULL,
  `b_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อธนาคาร',
  `b_number` varchar(20) DEFAULT NULL COMMENT 'เลข บช',
  `pay_date` date DEFAULT NULL,
  `pay_amount` float(10,2) DEFAULT NULL,
  `postcode` varchar(30) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `mem_id`, `name`, `address`, `email`, `phone`, `order_status`, `pay_slip`, `b_name`, `b_number`, `pay_date`, `pay_amount`, `postcode`, `order_date`, `status`) VALUES
(0000000042, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 3, '145631279020250206_132344.jpg', 'KTB', '5222301010000000', '2025-02-06', 444.00, '', '2025-02-06 13:23:29', 1),
(0000000032, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-03 12:56:01', 1),
(0000000033, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-03 13:02:10', 1),
(0000000027, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-03 12:25:00', 1),
(0000000028, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-03 12:30:49', 1),
(0000000029, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-03 12:35:26', 1),
(0000000044, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 3, '89156822220250206_133125.jpg', 'KTB', '5222301010000000', '2025-02-06', 23.00, '', '2025-02-06 13:31:15', 1),
(0000000043, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 3, '171301208120250206_132743.jpg', 'KTB', '5222301010000000', '2025-02-06', 4444.00, '', '2025-02-06 13:27:35', 1),
(0000000046, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '162747562920250206_163746.jpg', 'KTB', '5222301010000000', '2025-02-06', 333.00, '', '2025-02-06 16:37:25', 1),
(0000000050, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '197171528820250210_142545.jpg', 'KTB', '5222301010000000', '2025-02-10', 500.00, '', '2025-02-10 14:25:27', 1),
(0000000048, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '23958720250207_093023.jpg', 'KTB', '5222301010000000', '2025-02-07', 2000.00, '', '2025-02-07 09:30:08', 1),
(0000000051, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 3, '49556137720250210_142640.jpg', 'KTB', '5222301010000000', '2025-02-10', 500.00, '', '2025-02-10 14:25:59', 1),
(0000000052, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '809037520250210_142706.jpg', 'KBANK', '8888888888888888', '2025-02-10', 999.00, '', '2025-02-10 14:26:54', 1),
(0000000054, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-13 08:35:31', 1),
(0000000055, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-13 08:35:52', 1),
(0000000056, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-13 08:36:25', 1),
(0000000057, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-13 08:38:21', 1),
(0000000058, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '76262220320250213_084311.jpg', 'KTB', '5222301010000000', '2025-02-13', 500.00, '', '2025-02-13 08:42:46', 1),
(0000000059, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '174502244220250213_084850.jpg', 'KTB', '5222301010000000', '2025-02-13', 500.00, '', '2025-02-13 08:44:31', 1),
(0000000060, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '82328154920250213_085007.jpg', 'KTB', '5222301010000000', '2025-02-13', 333.00, '', '2025-02-13 08:49:29', 1),
(0000000061, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 2, '124656668820250213_131311.jpg', 'KTB', '5222301010000000', '2025-02-13', 1000.00, '', '2025-02-13 13:12:45', 1),
(0000000062, 6, 'oppo', 'ประเทศจีนแดง', 'oppo1234@gmail.com', '0987654321', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-14 13:09:13', 1),
(0000000063, 10, 'ฟาอิบ', '0999', 'oppo.fa123456@gmail.com', '191', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-14 13:18:07', 1),
(0000000064, 10, 'ฟาอิบ', '0999', 'oppo.fa123456@gmail.com', '191', 2, '69594045420250214_131928.jpg', 'KTB', '123', '2025-02-14', 1000.00, '', '2025-02-14 13:19:05', 1),
(0000000065, 10, 'ฟาอิบ', '0999', 'oppo.fa123456@gmail.com', '191', 0, '', '', '', '0000-00-00', 0.00, '', '2025-02-14 13:21:43', 1),
(0000000066, 10, 'ฟาอิบ', '0999', 'oppo.fa123456@gmail.com', '191', 2, '213624722620250214_132951.jpg', 'KTB', '123', '2025-02-14', 1500.00, '', '2025-02-14 13:29:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `d_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `p_c_qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `p_qty` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`d_id`, `order_id`, `p_id`, `p_name`, `p_c_qty`, `total`, `p_qty`) VALUES
(32, 26, 20, 'Array', 0, 590, NULL),
(31, 26, 33, 'Array', 0, 100000000, NULL),
(30, 25, 18, 'Array', 0, 1390, NULL),
(29, 24, 17, 'Array', 0, 699, NULL),
(33, 27, 45, 'Array', 0, 444, NULL),
(34, 28, 45, 'Array', 0, 444, NULL),
(35, 30, 45, 'Array', 0, 444, NULL),
(36, 31, 45, 'Array', 0, 444, NULL),
(37, 32, 45, 'Array', 0, 444, NULL),
(38, 33, 45, 'Array', 0, 444, NULL),
(39, 34, 45, 'Array', 0, 444, NULL),
(40, 35, 45, 'Array', 0, 444, NULL),
(41, 36, 45, 'Array', 0, 444, NULL),
(42, 37, 45, 'Array', 0, 444, NULL),
(43, 38, 45, 'Array', 0, 444, NULL),
(44, 39, 45, 'Array', 0, 444, NULL),
(45, 40, 45, 'Array', 0, 444, NULL),
(46, 41, 45, 'Array', 0, 444, NULL),
(47, 42, 45, 'Array', 0, 444, NULL),
(48, 43, 45, 'Array', 0, 444, NULL),
(49, 44, 45, 'Array', 0, 444, NULL),
(50, 45, 45, 'Array', 0, 444, NULL),
(51, 46, 45, 'Array', 0, 444, NULL),
(52, 47, 45, 'Array', 0, 444, NULL),
(53, 48, 56, 'Array', 0, 2000, NULL),
(54, 49, 46, 'Array', 0, 1000, NULL),
(55, 50, 47, 'Array', 0, 500, NULL),
(56, 51, 48, 'Array', 0, 500, NULL),
(57, 52, 51, 'Array', 0, 400, NULL),
(58, 53, 49, 'Array', 0, 500, NULL),
(59, 54, 47, 'Array', 0, 500, NULL),
(60, 55, 47, 'Array', 0, 500, NULL),
(61, 56, 47, 'Array', 0, 500, NULL),
(62, 57, 48, 'Array', 0, 500, NULL),
(63, 58, 48, '001', 0, 500, NULL),
(64, 59, 47, '002', 0, 500, NULL),
(65, 61, 46, '001', 0, 1000, NULL),
(66, 62, 47, '002', 0, 500, NULL),
(67, 63, 78, '006', 0, 600, NULL),
(68, 63, 51, '001', 0, 800, NULL),
(69, 64, 48, '001', 0, 500, NULL),
(70, 64, 47, '002', 0, 500, NULL),
(71, 65, 48, '001', 0, 500, NULL),
(72, 66, 47, '002', 0, 500, NULL),
(73, 66, 46, '001', 0, 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_detial` text NOT NULL,
  `p_price` float(10,2) NOT NULL,
  `p_unit` varchar(20) NOT NULL,
  `p_img1` varchar(200) NOT NULL,
  `p_img2` varchar(100) DEFAULT NULL,
  `p_view` int(11) NOT NULL,
  `date_save` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `t_id`, `p_name`, `p_detial`, `p_price`, `p_unit`, `p_img1`, `p_img2`, `p_view`, `date_save`) VALUES
(78, 13, '006', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 600.00, 'เตียงนอน', 'img1100084617520250207_095529.png', '', 0, '2025-02-07 02:55:29'),
(79, 13, '007', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 699.00, 'เตียงนอน', 'img172689897520250207_095837.png', '', 0, '2025-02-07 02:58:37'),
(74, 13, '002', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 600.00, 'เตียงนอน', 'img14839709520250207_094738.png', '', 0, '2025-02-07 02:47:38'),
(75, 13, '003', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 600.00, 'เตียงนอน', 'img160097809920250207_095103.png', '', 1, '2025-02-07 02:51:03'),
(76, 13, '004', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 600.00, 'เตียงนอน', 'img121066003020250207_095303.png', '', 0, '2025-02-07 02:53:03'),
(77, 13, '005', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 600.00, 'เตียงนอน', 'img130764654620250207_095416.png', '', 1, '2025-02-07 02:54:16'),
(69, 11, '009', '<p>สัมผัสความสะดวกสบายในห้องพักที่กว้างขึ้น พร้อมการตกแต่งที่ทันสมัย วิวเมืองสวยงาม และสิ่งอำนวยความสะดวกที่ช่วยให้การเข้าพักของคุณราบรื่น</p>\r\n', 600.00, 'เตียงนอน', 'img1115480238620250207_091736.png', '', 0, '2025-02-07 02:17:36'),
(70, 12, '006', '<p>สัมผัสความสะดวกสบายในห้อง Superior Room ที่ตกแต่งอย่างมีสไตล์ พร้อมพื้นที่ใช้สอยที่ลงตัว เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่าและความสะดวกสบาย</p>\r\n', 600.00, 'เตียงนอน', 'img175965289420250207_093350.png', '', 0, '2025-02-07 02:33:50'),
(71, 12, '007', '<p>สัมผัสความสะดวกสบายในห้อง Superior Room ที่ตกแต่งอย่างมีสไตล์ พร้อมพื้นที่ใช้สอยที่ลงตัว เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่าและความสะดวกสบาย</p>\r\n', 600.00, 'เตียงนอน', 'img167436110120250207_093502.png', '', 1, '2025-02-07 02:35:02'),
(72, 12, '008', '<p>สัมผัสความสะดวกสบายในห้อง Superior Room ที่ตกแต่งอย่างมีสไตล์ พร้อมพื้นที่ใช้สอยที่ลงตัว เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่าและความสะดวกสบาย</p>\r\n', 600.00, 'เตียงนอน', 'img1167269609720250207_093611.png', '', 0, '2025-02-07 02:36:11'),
(73, 12, '009', '<p>สัมผัสความสะดวกสบายในห้อง Superior Room ที่ตกแต่งอย่างมีสไตล์ พร้อมพื้นที่ใช้สอยที่ลงตัว เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่าและความสะดวกสบาย</p>\r\n', 600.00, 'เตียงนอน', 'img191969182720250207_093729.png', '', 0, '2025-02-07 02:37:29'),
(46, 10, '001', '<p>ห้องพักขนาดกำลังดี เหมาะสำหรับ 2 ท่าน มีเตียงคู่ 1&nbsp;เตียง สิ่งอำนวยความสะดวกครบครันเช่นเดียวกับห้องเตียงเดี่ยว</p>\r\n', 1000.00, 'เตียงนอน', 'img134150351020250207_082534.png', '', 9, '2025-02-07 00:36:31'),
(47, 10, '002', '<p>ห้องพักที่มีขนาดใหญ่ขึ้น พร้อมการตกแต่งที่สวยงามและสิ่งอำนวยความสะดวกที่เพิ่มขึ้น เช่น โซฟา โต๊ะทำงาน และระเบียงส่วนตัว</p>\r\n', 500.00, 'เตียงนอน', 'img113254171720250207_083046.png', '', 6, '2025-02-07 00:39:50'),
(48, 11, '001', '<p>ห้องพักกว้างขวาง พร้อมเตียงคิงไซส์และวิวเมือง ให้คุณได้พักผ่อนอย่างสบาย</p>\r\n', 500.00, 'เตียงนอน', 'img163714293420250207_085833.png', '', 2, '2025-02-07 00:58:07'),
(49, 10, '003', '<p>ห้องพักเรียบหรู มองเห็นสวนสวย ให้บรรยากาศสงบและผ่อนคลาย</p>\r\n', 500.00, 'เตียงนอน', 'img1155141851320250207_083219.png', '', 1, '2025-02-07 00:59:22'),
(50, 11, '002', '<p>ห้องพักพร้อมหน้าต่างบานใหญ่ เปิดรับแสงธรรมชาติและวิวเมืองยามค่ำคืน</p>\r\n', 600.00, 'เตียงนอน', 'img1189727903420250207_085939.png', '', 0, '2025-02-07 01:02:19'),
(51, 12, '001', '<p>ห้องพักสุดหรูที่มาพร้อมการออกแบบที่พิถีพิถัน พื้นที่กว้างขวาง เตียงนุ่มพิเศษ และบรรยากาศอบอุ่น เหมาะสำหรับการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 400.00, 'เตียงนอน', 'img1144790069620250207_092242.png', '', 5, '2025-02-07 01:04:33'),
(52, 12, '002', '<p>เตียงคู่ขนาดใหญ่ พร้อมโซฟาและพื้นที่ทำงานสำหรับนักเดินทาง</p>\r\n', 700.00, 'เตียงนอน', 'img145201819620250207_092550.png', '', 0, '2025-02-07 01:10:46'),
(53, 12, '003', '<p>ห้องพักบรรยากาศอบอุ่น ขนาดกำลังดี เหมาะสำหรับการพักผ่อน</p>\r\n', 500.00, 'เตียงนอน', 'img173785665320250207_092748.png', '', 0, '2025-02-07 01:12:34'),
(54, 11, '003', '<p>ห้องพักกว้างขวาง พร้อมเตียงคิงไซส์และวิวเมือง ให้คุณได้พักผ่อนอย่างสบาย</p>\r\n', 700.00, 'เตียงนอน', 'img1202252343720250207_090446.png', '', 1, '2025-02-07 01:13:21'),
(55, 12, '004', '<p>ออกแบบมาเพื่อคู่รักโดยเฉพาะ โรแมนติกและเป็นส่วนตัว</p>\r\n', 700.00, 'เตียงนอน', 'img124951757220250207_092855.png', '', 1, '2025-02-07 01:16:31'),
(56, 13, '001', '<p>ดื่มด่ำกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัว พร้อมเตียงนุ่มสบายและสิ่งอำนวยความสะดวกระดับพรีเมียม เพื่อการพักผ่อนที่สมบูรณ์แบบ</p>\r\n', 2000.00, 'เตียงนอน', 'img177940578720250207_094153.png', '', 2, '2025-02-07 01:19:00'),
(57, 11, '004', '<p>พักผ่อนอย่างเหนือระดับในห้อง Deluxe Room ขนาดกว้างขวาง พร้อมเตียงนุ่มสบาย วิวเมืองสวยงาม และสิ่งอำนวยความสะดวกครบครันสำหรับการเข้าพักที่แสนผ่อนคลาย</p>\r\n', 500.00, 'เตียงนอน', 'img174923953120250207_082140.png', '', 0, '2025-02-07 01:21:40'),
(58, 12, '005', '<p>สัมผัสความสะดวกสบายในห้อง Superior Room ที่ตกแต่งอย่างมีสไตล์ พร้อมพื้นที่ใช้สอยที่ลงตัว เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่าและความสะดวกสบาย</p>\r\n', 600.00, 'เตียงนอน', 'img1178281706020250207_082350.png', '', 1, '2025-02-07 01:23:50'),
(59, 11, '005', '<p>ห้องพักที่มีขนาดใหญ่ขึ้น พร้อมการตกแต่งที่สวยงามและสิ่งอำนวยความสะดวกที่เพิ่มขึ้น เช่น โซฟา โต๊ะทำงาน และระเบียงส่วนตัว</p>\r\n', 800.00, 'เตียงนอน', 'img1144939028520250207_082821.png', '', 0, '2025-02-07 01:28:21'),
(60, 10, '004', '<p>เพลิดเพลินกับวิวทะเลสุดตระการตาจากระเบียงส่วนตัวของคุณ ห้องพักสุดหรูที่มาพร้อมเฟอร์นิเจอร์ระดับพรีเมียม เหมาะสำหรับวันหยุดสุดพิเศษ</p>\r\n', 600.00, 'เตียงนอน', 'img138403283320250207_083458.png', '', 1, '2025-02-07 01:34:58'),
(61, 10, '005', '<p>ห้องพักสำหรับครอบครัวที่กว้างขวาง พร้อมเตียงใหญ่และเตียงเสริม พื้นที่นั่งเล่นแยกเป็นสัดส่วน และสิ่งอำนวยความสะดวกที่ตอบโจทย์ทุกไลฟ์สไตล์ของครอบครัว</p>\r\n', 800.00, 'เตียงนอน', 'img1201184055320250207_083649.png', '', 0, '2025-02-07 01:36:49'),
(62, 10, '006', '<p>หรูหราและเงียบสงบกับห้อง Executive Suite ที่ออกแบบมาเพื่อการพักผ่อนและทำงานอย่างลงตัว พร้อมวิวพาโนรามาและพื้นที่ทำงานส่วนตัว</p>\r\n', 600.00, 'เตียงนอน', 'img1127550742020250207_083807.png', '', 0, '2025-02-07 01:38:07'),
(63, 10, '007', '<p>ห้องพักสุดหรูที่ตกแต่งอย่างประณีต พร้อมห้องนั่งเล่นแยกเป็นสัดส่วนและบริการสุดพิเศษสำหรับแขกคนพิเศษ</p>\r\n', 700.00, 'เตียงนอน', 'img118790984120250207_084919.png', '', 0, '2025-02-07 01:49:19'),
(64, 10, '008', '<p>พักผ่อนท่ามกลางธรรมชาติในห้อง Garden View Room พร้อมวิวสวนสวย ให้ความรู้สึกสดชื่นและผ่อนคลายทุกช่วงเวลา</p>\r\n', 600.00, 'เตียงนอน', 'img1195105128020250207_085039.png', '', 0, '2025-02-07 01:50:39'),
(65, 10, '009', '<p>ห้องพักสำหรับคู่รักที่ตกแต่งอย่างโรแมนติก พร้อมอ่างอาบน้ำสุดหรูและวิวพระอาทิตย์ตกดิน สร้างความทรงจำสุดพิเศษสำหรับการฮันนีมูน</p>\r\n', 700.00, 'เตียงนอน', 'img143201707520250207_085632.png', '', 0, '2025-02-07 01:56:32'),
(66, 11, '006', '<p>เจนห้องพักกว้างขวาง พร้อมเตียงคิงไซส์และวิวเมือง ให้คุณได้พักผ่อนอย่างสบาย</p>\r\n', 700.00, 'เตียงนอน', 'img1188789688420250207_090750.png', '', 0, '2025-02-07 02:07:50'),
(67, 11, '007', '<p>ห้องพักมาตรฐานที่เรียบง่ายแต่ครบครัน ด้วยเตียงนุ่มสบาย พื้นที่ใช้สอยลงตัว และสิ่งอำนวยความสะดวกพื้นฐาน เหมาะสำหรับนักเดินทางที่ต้องการความคุ้มค่า</p>\r\n\r\n<h3>&nbsp;</h3>\r\n', 600.00, 'เตียงนอน', 'img127450537420250207_091011.png', '', 0, '2025-02-07 02:10:11'),
(68, 11, '008', '<p>สัมผัสความสะดวกสบายในห้องพักที่กว้างขึ้น พร้อมการตกแต่งที่ทันสมัย วิวเมืองสวยงาม และสิ่งอำนวยความสะดวกที่ช่วยให้การเข้าพักของคุณราบรื่น</p>\r\n', 600.00, 'เตียงนอน', 'img1168920971020250207_091201.png', '', 2, '2025-02-07 02:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`t_id`, `t_name`) VALUES
(10, 'Oceanview Resort'),
(11, 'The Grand Magnolia'),
(12, 'Sapphire Retreat'),
(13, 'Moonlit Shores Hotel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mem_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
