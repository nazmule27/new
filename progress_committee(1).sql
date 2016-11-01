-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2016 at 12:01 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progress_committee`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `faculty_designation`(user_id VARCHAR(50)) RETURNS varchar(50) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
        DECLARE DESIGNATION_FOUND VARCHAR(50);
        SELECT designation INTO DESIGNATION_FOUND FROM users WHERE username = user_id;
	RETURN DESIGNATION_FOUND;
	
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `faculty_full_name`(user_id VARCHAR(50)) RETURNS varchar(50) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
        DECLARE FULL_NAME_FOUND VARCHAR(50);
        SELECT full_name INTO FULL_NAME_FOUND FROM users WHERE username = user_id;
	RETURN FULL_NAME_FOUND;
	
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `faculty_name`(`userid` VARCHAR(50)) RETURNS varchar(50) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
        DECLARE NAME_FOUND VARCHAR(50);
        SELECT CONCAT(full_name," (", username,")") INTO NAME_FOUND FROM users WHERE username = userid order by joining_date;
	RETURN NAME_FOUND;
	
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `student_name`(id VARCHAR(50)) RETURNS varchar(50) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
        DECLARE NAME_FOUND VARCHAR(50);
        SELECT CONCAT(STUDENTNAME," (", STUDENTID,")") INTO NAME_FOUND FROM cseweb.csestudents WHERE STUDENTID = id;
	RETURN NAME_FOUND;
	
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE IF NOT EXISTS `committee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `for_student` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supervisor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_supervisor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ex_officio` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `for_student` (`for_student`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`id`, `for_student`, `supervisor`, `co_supervisor`, `ex_officio`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '0413054001', 'asmlatifulhoque', '', 'headcse', 'headcse', '2016-08-21 04:55:29', NULL),
(2, '0412054002', 'saidurrahman', '', 'headcse', 'headcse', '2016-08-21 06:37:16', NULL),
(3, '040805053', 'anindyaiqbal', 'wasif', 'headcse', 'nazmul', '2016-09-05 08:08:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `committee_member`
--

CREATE TABLE IF NOT EXISTS `committee_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `member` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_committee+_member` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `committee_member`
--

INSERT INTO `committee_member` (`id`, `cid`, `member`) VALUES
(1, 1, 'msrahman'),
(2, 1, 'saidurrahman'),
(3, 1, 'eunus'),
(4, 1, 'tanzimahashem'),
(5, 2, 'kashem'),
(6, 2, 'mdmonirulislam'),
(7, 2, 'elias_MATH_BUET'),
(8, 2, 'rkarim_CSE_DU'),
(9, 3, 'arup'),
(10, 3, 'sayeedhyder'),
(11, 3, 'asmlatifulhoque'),
(12, 3, 'anindyaiqbal'),
(13, 3, 'kaykobad');

-- --------------------------------------------------------

--
-- Table structure for table `external`
--

CREATE TABLE IF NOT EXISTS `external` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('Local','Foreign') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `external`
--

INSERT INTO `external` (`id`, `username`, `full_name`, `designation`, `email`, `phone`, `type`) VALUES
(1, 'elias_MATH_BUET', 'Dr. Md. Elias', 'Professor', 'melias@math.buet.ac.bd', '', 'Local'),
(2, 'rkarim_CSE_DU', 'Dr. Md. Rezaul Karim', 'Professor', 'rkarim101@gmail.com', '', 'Local');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_date_time` timestamp NULL DEFAULT NULL,
  `called_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_committee_meeting` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `cid`, `title`, `type`, `external`, `meeting_date_time`, `called_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Reschedule of the Comprehensive Examination of Ph.D. student Golam Md. Muradul Bashir, Roll No. 0413054001', 'comprehensive', '', '2016-08-22 05:00:00', 'asmlatifulhoque', '2016-08-21 05:14:27', NULL),
(2, 2, 'Geometric Representations of Graphs', 'comprehensive', '', '2016-08-24 02:30:00', 'saidurrahman', '2016-08-22 06:11:25', NULL),
(3, 3, 'Test for note', 'progress', '', '2016-09-06 08:30:00', 'anindyaiqbal', '2016-09-05 08:09:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_document`
--

CREATE TABLE IF NOT EXISTS `meeting_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `file_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_can_see` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uploaded_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meeting_document` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `meeting_document`
--

INSERT INTO `meeting_document` (`id`, `mid`, `comment`, `file_name`, `document_type`, `meeting_type`, `student_can_see`, `created_at`, `uploaded_by`) VALUES
(1, 1, 'As per the decision of the Doctoral Committee meeting held on 12th June, 2016, the comprehensive examination of Golam Md. Muradul Bashir, Ph.D. student, Roll No. 0413054001, Department of Computer Science and Engineering was scheduled to be held on 16th  August, 2016. \r\nThe examination was requested to be postponed. The examination has been re-scheduled to be held on 22nd August, 2016 at 11:00am at Graduate Seminar Room, 5th floor, ECE building, CSE wing, Dept. of CSE, BUET.\r\n', NULL, 'pre_meeting_document', 'comprehensive', 1, '2016-08-21 05:14:27', 'asmlatifulhoque'),
(2, 1, '', '1asmlatifulhoque.docx', 'pre_meeting_document', 'comprehensive', 1, '2016-08-21 05:16:55', 'asmlatifulhoque'),
(3, 1, 'Paper given for Comprehensive Examination', '1asmlatifulhoque.pdf', 'pre_meeting_document', 'comprehensive', 1, '2016-08-22 04:18:26', 'asmlatifulhoque'),
(4, 1, 'Paper given for Comprehensive Examination', '1asmlatifulhoque1.pdf', 'pre_meeting_document', 'comprehensive', 1, '2016-08-22 04:19:13', 'asmlatifulhoque'),
(5, 3, 'Student can see', '3anindyaiqbal.jpg', 'pre_meeting_document', 'progress', 1, '2016-09-05 08:09:50', 'anindyaiqbal');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_type`
--

CREATE TABLE IF NOT EXISTS `meeting_type` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_type`
--

INSERT INTO `meeting_type` (`id`, `title`) VALUES
('comprehensive', 'Comprehensive Exam'),
('defense', 'Defense'),
('progress', 'Progress Meeting');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `full_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `designation` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `joining_date` int(11) NOT NULL DEFAULT '100000',
  `role` enum('Admin','Supervisor','Member','External','Student','Officer') CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `full_name`, `designation`, `joining_date`, `role`, `email`, `status`) VALUES
('040805053', NULL, 'Abdullah Al Nahian', 'Student', 100000, 'Student', '', 1),
('0412054002', NULL, 'Shaheena Sultana', 'Student', 0, 'Student', 'shaheenaasbd@yahoo.com', 1),
('0413054001', NULL, 'GOLAM MD. MURADUL BASHIR MURAD', 'Student', 0, 'Student', '0413054001.gmmb@grad.cse.buet.ac.bd', 1),
('aashik', '21c4bc6806f1ae740f4b994bc08fb6e0', 'Md. Aashikur Rahman Azim', 'Lecturer', 7600, 'Supervisor', 'aashikazim@gmail.com', 1),
('adnan', 'd1a0a9e9391af09e978c4c3d11711e75', 'Dr. Muhammad Abdullah Adnan', 'Assistant Professor', 3300, 'Supervisor', 'abdullah.adnan@gmail.com', 1),
('ahmedkhurshid', '1894fca52996f089bc916c4813d26362', 'Ahmed Khurshid', 'Assistant Professor', 2900, 'Supervisor', 'ahmedkhurshid80@yahoo.com', 1),
('ali_nayeem', '50d7bb1e119052bdfd0a7ae2e78eba1e', 'Muhammad Ali Nayeem', 'Lecturer', 7300, 'Supervisor', 'ali_nayeem@cse.buet.ac.bd', 1),
('anindyaiqbal', '245456820536e2d1568a607f862d6300', 'Dr. Anindya Iqbal', 'Assistant Professor', 4900, 'Supervisor', 'anindya_iqbal@yahoo.com', 1),
('anupam', 'd19c70167e04aedfcd9b4ec440489ba6', 'Anupam Das', 'Assistant Professor', 3800, 'Supervisor', 'anupamdas@cse.buet.ac.bd', 1),
('arup', '65f84c80177190a32f4c13b38931aed6', 'Arup Raton Roy', 'Lecturer', 5400, 'Supervisor', 'roy.arup@gmail.com', 1),
('ashikurrahman', 'aa9f54e6edd3236d37d3f3ac3348fc1f', 'Dr. A.K.M. Ashikur Rahman', 'Professor', 1750, 'Supervisor', 'ashikur@cse.buet.ac.bd', 1),
('ashraful', '7d04559ddb86598ab0e369f4a5e82eab', 'Md. Ashraful Alam', 'Assistant Professor', 3100, 'Supervisor', 'shovon21@yahoo.com', 1),
('asmlatifulhoque', '6589b0c057fe2def4822562ec28c7547', 'Dr. Abu Sayed Md. Latiful Hoque', 'Professor', 800, 'Supervisor', 'asmlatifulhoque@cse.buet.ac.bd', 1),
('atif', '182b68b5c4ddcdd81b3d54335c82027a', 'Dr. Atif Hasan Rahman', 'Assistant Professor', 7650, 'Supervisor', 'atif.bd@gmail.com', 1),
('ayonsn', 'af774a48162b38ff1a20bd947b3abc37', 'Ayon Sen', 'Lecturer', 6500, 'Supervisor', 'ayonsn@gmail.com', 1),
('azadsalam', '2832315844309cb7c5fdabb0b974e767', 'Abdus Salam Azad', 'Lecturer', 7710, 'Supervisor', 'azadsalam@cse.buet.ac.bd', 1),
('azizahmed', 'azizahmed', 'Aziz Ahmed', 'Technical Officer', 50000, 'Officer', 'office@cse.buet.ac.bd', 1),
('bayzid', 'ff975eb19c7bfff6e749a798a58f2959', 'Md. Shamsuzzoha Bayzid', 'Assistant Professor', 3700, 'Supervisor', 'shams.bayzid@gmail.com', 1),
('ehtesam', 'a079cf25a97ac0300ac83b90aedabb9a', 'Md. Ehtesamul Haque', 'Lecturer', 5100, 'Supervisor', 'ehtesam@cse.buet.ac.bd', 1),
('elias_MATH_BUET', NULL, 'Dr. Md. Elias', 'Professor', 0, 'External', 'melias@math.buet.ac.bd', 1),
('eunus', '96986317f6d07850f55916121e2b5997', 'Dr. Mohammed Eunus Ali', 'Professor', 1800, 'Supervisor', 'eunus@cse.buet.ac.bd', 1),
('faiz', '9d4d4ab0dfdb72a54b895d78b90b09c7', 'Md. Faizul Bari', 'Assistant Professor', 3600, 'Supervisor', 'faizulbari@cse.buet.ac.bd', 1),
('fatema', 'e98222275fed1ee02bf908216586c63d', 'Fatema Tuz Zohora', 'Assistant Professor', 7500, 'Supervisor', 'anne.06.cse@gmail.com', 1),
('hasanmm', 'fd1eaf0ead824f6dfd7c354cedcac57f', 'Mohammad Masud Hasan', 'Assistant Professor', 2000, 'Supervisor', 'masud209@yahoo.com', 1),
('headcse', 'headcse', 'Head of the CSE DEPT', 'professor', 0, 'Admin', 'head@cse.buet.ac.bd', 1),
('hemayet', '9c46a59867acd3c8503d8b1076426ced', 'Hemayet Hossain', 'Lecturer', 4600, 'Supervisor', 'hossain@cs.rochester.edu', 1),
('himeldev', '957a3af5c805c23ef05a8d3b19b6b85f', 'Himel Dev', 'Lecturer', 7740, 'Supervisor', 'himeldev@gmail.com', 1),
('ierabban', 'd349dab7444fa23d94ab0a53576dd442', 'Md. Ishat - E - Rabban', 'Lecturer', 7730, 'Supervisor', 'ieranikg@gmail.com', 1),
('ishtiyaque', '33ebc2d041164f333159097327f4ada9', 'Ishtiyaque Ahmad', 'Lecturer', 7900, 'Supervisor', 'ishtiyaque.2197@yahoo.com', 1),
('johramoosa', '560aacd128d7f411204ef6ac5498aa66', 'Johra Muhammad Moosa', 'Assistant Professor', 7450, 'Supervisor', 'johra.moosa@gmail.com', 1),
('kantishubhra', '683951725c47cc00df8c9ba9c2d4dd93', 'Shubhra Kanti Karmaker Santu', 'Lecturer', 6400, 'Supervisor', 'kantishubhra@cse.buet.ac.bd', 1),
('kashem', '617eb9cdc5dee39804ff0b7ea0047a4a', 'Dr. Md. Abul Kashem Mia', 'Professor', 400, 'Supervisor', 'kashem@cse.buet.ac.bd', 1),
('kaykobad', '85763a959d076b164341184b6a5678c3', 'Dr. M. Kaykobad', 'Professor', 200, 'Supervisor', 'kaykobad@cse.buet.ac.bd', 1),
('kaysar', '8ed56e3f78275e9450a0bb9c7df0205b', 'Mohammed Kaysar Abdullah', 'Lecturer', 7770, 'Supervisor', 'kaysar@cse.buet.ac.bd', 1),
('khaledshahriar', '565d88cd0de5f5d8b6c997442525ab4c', 'Khaled Mahmud Shahriar', 'Assistant Professor', 2800, 'Supervisor', 'k.m.shahriar@gmail.com', 1),
('madhusudan', '9d253b2f2edc4a4c8c002caace66f80d', 'Madhusudan Basak', 'Lecturer', 7790, 'Supervisor', 'madhusudan.buet@gmail.com', 1),
('mahbubul', 'd7886e9f69c68c5452afb12aabd24e2b', 'Md. Mahbubul Hasan', 'Lecturer', 6100, 'Supervisor', 'shanto86@gmail.com', 1),
('mahfuz', 'e31dd3474905d4269cd24fbd23195c64', 'Dr. Mohammad Mahfuzul Islam', 'Professor', 1000, 'Supervisor', 'mahfuz@cse.buet.ac.bd', 1),
('mahfuza', '830c194cf4d993dd2280943ab550bd42', 'Mahfuza Sharmin', 'Lecturer', 5700, 'Supervisor', 'sharmin@cse.buet.ac.bd', 1),
('mahmudanaznin', 'ba6f9791857efbaf23f36eb9afc90ef6', 'Dr. Mahmuda Naznin', 'Professor', 1805, 'Supervisor', 'mahmudanaznin@cse.buet.ac.bd', 1),
('masattar', '71a8511fa797dfb6c13d269a7387c56f', 'Md. Abdus Sattar', 'Associate Professor', 1500, 'Supervisor', 'masattar@cse.buet.ac.bd', 1),
('masruba', 'ed74fd49f32a0489e3ff8647c8253f5f', 'Masruba Tasnim', 'Lecturer', 6900, 'Supervisor', 'masruba@gmail.com', 1),
('masudhasan', 'fe9996f4cc78a8e3608634e61cccfb00', 'Dr. Masud Hasan', 'Professor', 1100, 'Supervisor', 'masudhasan@cse.buet.ac.bd', 1),
('mdabedul', '2ef1a4da685f487ff6b12c360901a6ef', 'Md. Abedul Haque', 'Assistant Professor', 3000, 'Supervisor', 'mdabedul@cse.buet.ac.bd', 1),
('mdmonirulislam', 'e7320977395cc4e43289390764ecb851', 'Dr. Md. Monirul Islam', 'Professor', 600, 'Supervisor', 'mdmonirulislam@cse.buet.ac.bd', 1),
('mdmuhibur', 'cc649cb883188e09c38ee207c014a54b', 'Md. Muhibur Rasheed', 'Lecturer', 4800, 'Supervisor', 'm3r2buet@yahoo.com', 1),
('mehnaztabassum', 'c8d0a614a8e63a0451459212ed2acb0e', 'Mehnaz Tabassum Mahin', 'Lecturer', 8200, 'Supervisor', 'mehnaztabassummahin@gmail.com', 1),
('mhkabir', '9324b739f9cd431caa02e49a2cbefaa4', 'Dr. Md. Humayun Kabir', 'Professor', 900, 'Supervisor', 'mhkabir@cse.buet.ac.bd', 1),
('mmasroorali', '79d7300b64a603dec0517a13ebd36ee5', 'Dr. Muhammad Masroor Ali', 'Professor', 300, 'Supervisor', 'mmasroorali@cse.buet.ac.bd', 1),
('mmislam', '8aa2f18dbad685474729dc4ec473035c', 'Dr. Md. Monirul Islam', 'Associate Professor', 3200, 'Supervisor', 'mmislam@cse.buet.ac.bd', 1),
('mmrahman', '386bc32c0736dc187b7d5d217103e4e7', 'Md. Mustafizur Rahman', 'Assistant Professor', 6200, 'Supervisor', 'mustafiz_rahman@cse.buet.ac.bd', 1),
('mostofa', 'a8869cde8df751595b21b5dfc4bd1228', 'Dr. Md. Mostofa Akbar', 'Professor', 700, 'Supervisor', 'mostofa@cse.buet.ac.bd', 1),
('mostofapatwary', 'd0f3224efb76e4513539af69cc232b44', 'Md. Mostofa Ali Patwary', 'Assistant Professor', 2400, 'Supervisor', 'mostofapatwary@cse.buet.ac.bd', 1),
('mrahman', '8c90029cfdde5ff8440a8bd713800254', 'Mohammad Saifur Rahman', 'Assistant Professor', 7400, 'Supervisor', 'srautonu@yahoo.com', 1),
('mshohrabhossain', 'b7d933acdc1b787cdb8bbd2f5a808c7f', 'Dr. Md. Shohrab Hossain', 'Associate Professor', 3210, 'Supervisor', 'mshohrabhossain@cse.buet.ac.bd', 1),
('msrahman', '65b3a43e2808f2cc1e2a9de8d5223cba', 'Dr. M. Sohel Rahman', 'Professor', 1700, 'Supervisor', 'msrahman@cse.buet.ac.bd', 1),
('mtirfan', 'e129c01867d50c0c4280117d2815ac04', 'Mohammad Tanvir Irfan', 'Assistant Professor', 2500, 'Supervisor', 'mtirfan@cse.buet.ac.bd', 1),
('nazmul', 'nazmul', 'Nazmul Haque', 'Assistant Programmer', 0, 'Admin', 'nlnazmul@gmail.com', 1),
('nazmus', '37ec1c96169cc2b57cfe3bcd827cdf16', 'Nazmus Saquib', 'Lecturer', 8000, 'Supervisor', 'saquib2527@gmail.com', 1),
('nshahriar', '2b93846e9c7f4303510620aa698e42d0', 'Nashid Shahriar', 'Assistant Professor', 4400, 'Supervisor', 'nshahriar@cse.buet.ac.bd', 1),
('papon', '50d9590f89961bdf9f36b2d18d02dfb9', 'Md. Tarikul Islam Papon', 'Lecturer', 8100, 'Supervisor', 'tarikulpapon@gmail.com', 1),
('radireza', 'fa2a29354b8fc2b25df1d93685ca2fcb', 'Radi Muhammad Reza', 'Lecturer', 7750, 'Supervisor', 'radireza@gmail.com', 1),
('rajkumar', 'c223199626bf0875cbc4e5859c93040c', 'Rajkumar Das', 'Assistant Professor', 3900, 'Supervisor', 'rajkumardash05@yahoo.com', 1),
('rakinhaider', 'f36a39a80b06a7ad32fe0640d30a6b0f', 'Ch. Md. Rakin Haider', 'Lecturer', 8500, 'Supervisor', 'rakinhaider@gmail.com', 1),
('razi', 'd6e0303b490c89f6590d410a55cd1eae', 'Dr. A. B. M. Alim Al Islam', 'Assistant Professor', 4500, 'Supervisor', 'alim_razi@cse.buet.ac.bd', 1),
('reazahmedXXX', '54bdedd81bf1c587bb6c1ac78494a241', 'Dr. Reaz Ahmed', 'Associate Professor', 1600, 'Supervisor', 'reaz@cse.buet.ac.bd', 1),
('rezwana', 'bc69c09f24254311194dd59db27b0761', 'Rezwana Reaz Rimpi', 'Lecturer', 6000, 'Supervisor', 'rimpi0505042@gmail.com', 1),
('rifat', '35c0c28414ac08bb8b6729631f69ee01', 'Dr. Rifat Shahriyar', 'Assistant Professor', 3500, 'Supervisor', 'rifat@cse.buet.ac.bd', 1),
('rkarim_CSE_DU', NULL, 'Dr. Md. Rezaul Karim', 'Professor', 0, 'External', 'rkarim101@gmail.com', 1),
('roots', 'c5f6f584b79463f58c223f18fef206ef', 'webadmin', 'webadmin', 0, 'Supervisor', 'enggiqbal@gmail.com', 1),
('sabbirahmad', 'c26b31ea9b0260477a54c31aaf981273', 'Sabbir Ahmad', 'Lecturer', 8300, 'Supervisor', 'ahmadsabbir@cse.buet.ac .bd', 1),
('sadia', '91b5cd208feabcc9b01cd14b7e4e83ad', 'Dr. Sadia Sharmin', 'Assistant Professor', 7410, 'Supervisor', 'sadiasharmin@cse.buet.ac.bd', 1),
('saidurrahman', '68a316f2ab93d5d56d1198141b275cec', 'Dr. Md. Saidur Rahman', 'Professor', 500, 'Supervisor', 'saidurrahman@cse.buet.ac.bd', 1),
('sakib', '28e9ae3ae3f544edf077eae414725fa2', 'Md. Iftekharul Islam Sakib', 'Lecturer', 7780, 'Supervisor', 'miisakib@gmail.com', 1),
('sarah_masud', '19468effd814f9e27ba15d7cb0a757ef', 'Sarah Masud Preum', 'Lecturer', 7200, 'Supervisor', 'sarahmasud.sm@gmail.com', 1),
('sayeedhyder', 'a6e36dbb34804cdb0728f0c45cf643ad', 'Chowdhury Sayeed Hyder', 'Lecturer', 5000, 'Supervisor', 'deeyas017@yahoo.com', 1),
('sayeedmondol', 'a66f05c2d38fc33a2d7a12e26b98e9fb', 'Md. Abu Sayeed Mondol', 'Assistant Professor', 4000, 'Supervisor', 'abusayeedbd@gmail.com', 1),
('shagufta_mehnaz', 'c0ef145960823338233298c021c7c1ac', 'Shagufta Mehnaz', 'Lecturer', 7100, 'Supervisor', 'shagufta.me@gmail.com', 1),
('shahrear', 'e0cff155bfeed8ea9c3fd6cb06a700b1', 'Md. Shahrear Iqbal', 'Assistant Professor', 4200, 'Supervisor', 'shahreariqbal@cse.buet.ac.bd', 1),
('shaifur', 'b2eac3cf2fb9742950290e1a0b63638f', 'Md. Shaifur Rahman', 'Assistant Professor', 5500, 'Supervisor', 'shaifur@cse.buet.ac.bd', 1),
('shampa', '40783719ac051c03a39ac0fa3aa7f554', 'Shampa Shahriyar', 'Lecturer', 7000, 'Supervisor', 'shampa077@gmail.com', 1),
('shamsul', 'b21f0689425fa2932096b0a812439e2b', 'Dr. Md. Shamsul Alam', 'Professor', 100, 'Supervisor', 'shamsul@cse.buet.ac.bd', 1),
('shareeftamal', 'dee645d6c1c5651ad37e500af302ef28', 'Shareef Ahmed', 'Lecturer', 8400, 'Supervisor', 'shareef.tamal@gmail.com', 1),
('sharif', '585a097e7ec1f2ba93c7d066d6f7fc5e', 'Md. Shariful Islam Bhuyan', 'Assistant Professor', 3400, 'Supervisor', 'sharifulislam@cse.buet.ac.bd', 1),
('shihab', '256bcc24b08cca0e54de7e6ab70e12a3', 'Shihabur Rahman Chowdhury', 'Lecturer', 5600, 'Supervisor', 'shihab@cse.buet.ac.bd', 1),
('siddhartha', '2b651f73856219b06e9659b2867524d5', 'Siddhartha Shankar Das', 'Lecturer', 7760, 'Supervisor', 'siddhartha047@gmail.com', 1),
('smfarhad', 'e9b56a9dd1e8b9759f3ed959c92b2fa4', 'Dr. S. M. Farhad', 'Associate Professor', 3201, 'Supervisor', 'smfarhad@cse.buet.ac.bd', 1),
('snazeen', '865c1afbde7cf95d30406aef6dff5016', 'Sumaiya Nazeen', 'Lecturer', 5900, 'Supervisor', 'nazeen@webmail.buet.ac.bd', 1),
('sohansayed', '8265608cd6df6f26023366019d3aa736', 'A.S.M. Sohidull Islam', 'Lecturer', 6700, 'Supervisor', 'sohansayed at gmail dot com', 1),
('sukarnabarua', 'd68614fe68a853dd6ed0d286487395ca', 'Sukarna Barua', 'Assistant Professor', 4300, 'Supervisor', 'sukarna.barua@gmail.com', 1),
('sumaiya', '928ab7a29ae22e4a609e8a1bb869b96e', 'Sumaiya Iqbal', 'Assistant Professor', 5800, 'Supervisor', 'anni.are@gmail.com', 1),
('sunnysajjad', '8929c5f5b8db096a8f0baa701d798ae7', 'Sajjadur Rahman', 'Lecturer', 6800, 'Supervisor', 'rahmansunny071@gmail.com', 1),
('tahsin', '86b0aaef2b969ea4bc380e378fb2b952', 'Md. Anindya Tahsin Prodhan', 'Assistant Professor', 4100, 'Supervisor', 'anindya.tahsin@gmail.com', 1),
('takhan', '29e85900868804838267f23322d3f8de', 'Tanvir Ahmed Khan', 'Lecturer', 7720, 'Supervisor', 'takhandipu@gmail.com', 1),
('tanmoycse', '45b0a9e12960381ab94a108ab12f37b3', 'Tanmoy Sen', 'Lecturer', 7800, 'Supervisor', 'sen.buet@gmail.com', 1),
('tanveerawal', '89005223c3674cf678ea49a70b2def2a', 'Tanveer Awal', 'Assistant Professor', 2700, 'Supervisor', 'tanveerawal@cse.buet.ac.bd', 1),
('tanzimahashem', '7ac2a94b77d927300c21e173f5cb1bbe', 'Dr. Tanzima Hashem', 'Associate Professor', 3230, 'Supervisor', 'tanzimahashem@cse.buet.ac.bd', 1),
('toufique', '583dbd5cc711f0b734400c8d2babbbd6', 'Toufique Ahmed', 'Lecturer', 7700, 'Supervisor', 'toufique90@gmail.com', 1),
('utpalkumar', '09fff65f50ca6a472831da307b4a2c70', 'Utpal Kumar Paul', 'Lecturer', 4700, 'Supervisor', 'utpalkumar@cse.buet.ac.bd', 1),
('wasif', 'ac9c3b9aafeb3165e642a29e5be59032', 'Abu Wasif', 'Assistant Professor', 1900, 'Supervisor', 'wasif@cse.buet.ac.bd', 1),
('webtonmoy', 'bd5cc3f98bd63fafff5fb59d6eabc537', 'Hasan Shahid Ferdous', 'Assistant Professor', 4550, 'Supervisor', 'hsferdous@cse.buet.ac.bd', 1),
('yusufsarwar', '11053928f43e5a82aed113e79bf800d2', 'Dr. Md. Yusuf Sarwar Uddin', 'Associate Professor', 3220, 'Supervisor', 'yusufsarwar@cse.buet.ac.bd', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `committee_member`
--
ALTER TABLE `committee_member`
  ADD CONSTRAINT `fk_committee+_member` FOREIGN KEY (`cid`) REFERENCES `committee` (`id`);

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `fk_committee` FOREIGN KEY (`cid`) REFERENCES `committee` (`id`);

--
-- Constraints for table `meeting_document`
--
ALTER TABLE `meeting_document`
  ADD CONSTRAINT `fk_meeting` FOREIGN KEY (`mid`) REFERENCES `meeting` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
