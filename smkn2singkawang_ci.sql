-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2019 at 02:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkn2singkawang_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_phases`
--

CREATE TABLE `admission_phases` (
  `id` int(255) NOT NULL,
  `academic_year` int(4) NOT NULL,
  `phase_start_date` date NOT NULL,
  `phase_end_date` date NOT NULL,
  `active` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_phases`
--

INSERT INTO `admission_phases` (`id`, `academic_year`, `phase_start_date`, `phase_end_date`, `active`) VALUES
(4, 2019, '2019-05-11', '2019-05-16', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`) VALUES
(2, 'Sample Album Y');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `address` text NOT NULL,
  `telp` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `jurusan_id` int(255) NOT NULL,
  `job` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `image` text,
  `is_verified` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `name`, `gender`, `address`, `telp`, `email`, `angkatan`, `jurusan_id`, `job`, `college`, `image`, `is_verified`) VALUES
(1, 'ivan', 'L', 'Rumah', '123456', 'ivansu.webmail@gmail.com', 2010, 42, '', '', NULL, 'false'),
(2, 'ivannie', 'P', 'jalan singkawang', '0822123123123', '', 1974, 43, '', '', NULL, 'true'),
(3, 'client alumni', 'L', 'jalan localhost', '09123123123123', '', 1979, 43, '', '', NULL, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `headmaster`
--

CREATE TABLE `headmaster` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headmaster`
--

INSERT INTO `headmaster` (`id`, `name`, `content`, `image`) VALUES
(1, 'H. Aprizal, S.Pd, M.Pd', '<p>lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia molestiae obcaecati nihil, quidem reprehenderit aliquid incidunt nisi vel minima soluta provident repudiandae temporibus? Nobis ut tempore tempora ex necessitatibus facere!</p>\n', 'c677671816258a0c6a43f7645d9101e1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `href` text NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `name`, `href`, `image`) VALUES
(3, 'sample', 'http://localhost:8080/public/ci-smkn2-singkawang/index.php/public/page/index/register_alumni', 'f34fa23e80feb53664c4917dbb1de059.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `title`) VALUES
(0, 'SINGLE_PAGE'),
(8, 'Dropdown 1'),
(14, 'Dropdown Nav'),
(16, 'dropdown 3');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `nav_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `post_id`, `nav_id`) VALUES
(1, 34, 14),
(6, 39, 14),
(7, 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(255) NOT NULL,
  `image` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `image`, `created_at`, `album_id`) VALUES
(1, 'aab6fc521bf1b1571f4d23fe61d5258c.png', '2019-05-06 10:24:46', 2),
(2, '483c6209e2c1fb309d3a56be79d23d3e.jpg', '2019-05-06 10:24:59', 2),
(3, '0907833a3df1232e5fe38583ab512b30.jpg', '2019-05-06 10:25:04', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `author` int(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `image`, `author`, `type`, `created_at`, `updated_at`) VALUES
(32, 'LKS', NULL, '<p>lalsdl hhhhh ppsappspsps</p>\n', '6f918895d80a84b0df7ddd6fa734162d.jpg', 1, 'prestasi', '2019-04-27 10:02:22', '2019-05-08 11:31:44'),
(34, 'Child 1', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iusto exercitationem sint veritatis blanditiis? Ratione beatae libero obcaecati numquam corrupti, tempore culpa illum earum fuga dignissimos quae aliquam, et quasi.</p>\n', NULL, 1, 'page', '2019-05-02 14:22:07', '2019-05-07 10:42:29'),
(39, 'Child 2', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iusto exercitationem sint veritatis blanditiis? Ratione beatae libero obcaecati numquam corrupti, tempore culpa illum earum fuga dignissimos quae aliquam, et quasi.</p>\n', NULL, 1, 'page', '2019-05-02 17:47:39', '2019-05-07 10:43:00'),
(40, 'Informasi 1', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>\n', NULL, 1, 'information', '2019-05-06 06:59:50', '2019-05-06 12:11:26'),
(41, 'Informasi 2', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>\n', NULL, 1, 'information', '2019-05-06 06:59:55', '2019-05-06 12:11:37'),
(42, 'Multimedia', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In sit perspiciatis porro eius, possimus repellat qui, accusantium consectetur dolores assumenda molestias esse voluptate nam exercitationem molestiae aliquam quae ipsum vitae?</p>', '99914178b35986168cb8e7c0ea91d6c3.png', 1, 'jurusan', '2019-05-06 09:56:09', '2019-05-06 09:56:09'),
(43, 'Tata Niaga', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In sit perspiciatis porro eius, possimus repellat qui, accusantium consectetur dolores assumenda molestias esse voluptate nam exercitationem molestiae aliquam quae ipsum vitae?</p>', 'cd1175a86c306f5d0f00043a6b65d7c9.png', 1, 'jurusan', '2019-05-06 09:56:22', '2019-05-06 09:56:22'),
(44, 'Single Page', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iusto exercitationem sint veritatis blanditiis? Ratione beatae libero obcaecati numquam corrupti, tempore culpa illum earum fuga dignissimos quae aliquam, et quasi.</p>\n', NULL, 1, 'page', '2019-05-06 11:41:16', '2019-05-07 10:42:35'),
(45, 'Sampel Artikel 1', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '82d0e6aca2da67f7a22dee98626a45d9.jpg', 1, 'article', '2019-05-06 12:08:37', '2019-05-06 12:08:37'),
(46, 'Sampel Artikel 2', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', 'ff352ff45cf8ac4252870b9e5e6f4616.jpg', 1, 'article', '2019-05-06 12:08:47', '2019-05-06 12:08:47'),
(47, 'Sampel Artikel 3', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '2049f230e7a439c957a4e5b33783eb83.jpg', 1, 'article', '2019-05-06 12:08:58', '2019-05-06 12:08:58'),
(48, 'Sampel Artikel 4', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '4184901df742469ce2bfec0c1633d1d1.jpg', 1, 'article', '2019-05-06 12:09:09', '2019-05-06 12:09:09'),
(49, 'Sampel Artikel 5', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '77c0dbc9cff90e8566b008247f0255f6.jpg', 1, 'article', '2019-05-06 12:09:21', '2019-05-06 12:09:21'),
(50, 'Sampel Artikel 6', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '8a357f4b9f5c3ab77007fd56c74826bd.png', 1, 'article', '2019-05-06 12:09:32', '2019-05-06 12:09:32'),
(51, 'Sampel Artikel 7', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', 'f5669e981a58acee1a4aed34e3e6836d.jpg', 1, 'article', '2019-05-06 12:09:47', '2019-05-06 12:09:47'),
(52, 'Sampel Artikel 8', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', '8535358d46618d8c9ce41b9e8041956a.jpg', 1, 'article', '2019-05-06 12:10:09', '2019-05-06 12:10:09'),
(53, 'Informasi 3', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', NULL, 1, 'information', '2019-05-06 12:11:44', '2019-05-06 12:11:44'),
(54, 'Informasi 4', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', NULL, 1, 'information', '2019-05-06 12:11:48', '2019-05-06 12:11:48'),
(55, 'Informasi 5', NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nam reiciendis iusto accusamus recusandae illo minima optio aliquid animi, perferendis delectus placeat sequi corporis odio, qui veniam? Mollitia, voluptatem eos?</p>', NULL, 1, 'information', '2019-05-06 12:12:10', '2019-05-06 12:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pos` varchar(7) NOT NULL,
  `video` varchar(255) NOT NULL,
  `img_header` text,
  `img_logo` text,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `address`, `phone`, `email`, `pos`, `video`, `img_header`, `img_logo`, `facebook`, `twitter`, `youtube`, `instagram`) VALUES
(1, 'SMK Negeri 2 Singkawang', 'Jl. Bambang Ismoyo No. 17, Kel. Jawa, Jawa, Singkawang Tengah, Kota Singkawang, Kalimantan Barat', '+0526 5555', 'smkn2-singkawang@sch.id', '79113', '6bV7x-Ld2Xw', '42309caf16293fc306b886634aa9b8bb.jpg', NULL, 'SMK Negeri 2 Singkawang', 'SMK Negeri 2 Singkawang', 'SMK Negeri 2 Singkawang', '@smkn2singkawang');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `registration_id` varchar(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `jurusan_id` int(255) DEFAULT NULL,
  `admission_phase_id` int(255) DEFAULT NULL,
  `is_student` enum('true','false') DEFAULT 'false',
  `is_candidate` enum('true','false') DEFAULT 'false',
  `is_alumni` enum('true','false') DEFAULT 'false',
  `passed_selection` enum('on_going','passed','not_passed') DEFAULT 'on_going' COMMENT 'status of candidate, passed ? notpassed ? or just on_going (no action from admin)',
  `national_exam_scores` varchar(255) DEFAULT NULL COMMENT 'Format: mtk=54,bi=78,bing=95,ipa=100',
  `gender` enum('L','P') DEFAULT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL COMMENT 'Kelurahan',
  `sub_district` varchar(255) DEFAULT NULL COMMENT 'Kecamatan',
  `district` varchar(255) DEFAULT NULL COMMENT 'Kabupaten / Kota',
  `postal_code` int(7) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `ambition` varchar(255) DEFAULT NULL COMMENT 'Cita-cita',
  `mileage` int(30) DEFAULT NULL COMMENT 'Jarak Tempu',
  `travelling_time` int(30) DEFAULT NULL COMMENT 'Waktu Tempu',
  `height` int(3) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `siblings_number` int(2) DEFAULT NULL,
  `prev_school_name` varchar(255) DEFAULT NULL,
  `prev_school_address` varchar(255) DEFAULT NULL,
  `berkas_ijazah` text,
  `berkas_skhun` text,
  `berkas_akte` text,
  `berkas_kk` text,
  `berkas_foto` text,
  `father_name` varchar(255) DEFAULT NULL,
  `father_education` varchar(255) DEFAULT NULL,
  `father_job` varchar(255) DEFAULT NULL,
  `father_monthly_income` int(255) DEFAULT NULL COMMENT 'Kurang dari VALUE',
  `father_phone` varchar(30) DEFAULT NULL,
  `father_email` varchar(255) DEFAULT NULL,
  `father_condition` enum('alive','passed away') DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_education` varchar(255) DEFAULT NULL,
  `mother_job` varchar(255) DEFAULT NULL,
  `mother_monthly_income` int(255) DEFAULT NULL,
  `mother_phone` varchar(30) DEFAULT NULL,
  `mother_email` varchar(255) DEFAULT NULL,
  `mother_condition` enum('alive','passed away') DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_education` varchar(255) DEFAULT NULL,
  `guardian_job` varchar(255) DEFAULT NULL,
  `guardian_monthly_income` int(255) DEFAULT NULL,
  `guardian_phone` varchar(30) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `current_candidate_step` tinyint(1) NOT NULL DEFAULT '1' COMMENT '4 => verified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `registration_id`, `user_id`, `jurusan_id`, `admission_phase_id`, `is_student`, `is_candidate`, `is_alumni`, `passed_selection`, `national_exam_scores`, `gender`, `birth_place`, `birth_date`, `religion`, `street_address`, `rt`, `rw`, `village`, `sub_district`, `district`, `postal_code`, `phone`, `hobby`, `ambition`, `mileage`, `travelling_time`, `height`, `weight`, `siblings_number`, `prev_school_name`, `prev_school_address`, `berkas_ijazah`, `berkas_skhun`, `berkas_akte`, `berkas_kk`, `berkas_foto`, `father_name`, `father_education`, `father_job`, `father_monthly_income`, `father_phone`, `father_email`, `father_condition`, `mother_name`, `mother_education`, `mother_job`, `mother_monthly_income`, `mother_phone`, `mother_email`, `mother_condition`, `guardian_name`, `guardian_education`, `guardian_job`, `guardian_monthly_income`, `guardian_phone`, `guardian_email`, `current_candidate_step`) VALUES
(1, '15076939485cdcfd88739f1', 2, 42, 4, 'false', 'true', 'false', 'on_going', 'mtk=12,bi=12,bing=12,ipa=12', 'L', 'singkawang', '2019-05-16', 'buddha', 'singkawang', '01', '01', 'singkawang', 'skw', 'skw', 1111, '1111111', '', '', 0, 0, 0, 0, 0, 'smp bruder', 'singkawang', NULL, NULL, NULL, NULL, NULL, '', '', '', 200000, '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','CONTRIBUTORS','STUDENTS','CANDIDATE_STUDENTS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin@mail.com', '$2y$10$PwnVQfX/6t3nxfduM2uLfeRckNwOGMRsE7kkF9xB693Djl97D4D6S', 'ADMIN'),
(2, 'ivan', 'ivan', 'ivansu@mail.com', '$2y$10$F0PE9dHvgNROopG4.lZMhe9UGdIIT722CW6G1i2kSovZwrZQ/kzAu', 'CANDIDATE_STUDENTS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_phases`
--
ALTER TABLE `admission_phases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headmaster`
--
ALTER TABLE `headmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_phases`
--
ALTER TABLE `admission_phases`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `headmaster`
--
ALTER TABLE `headmaster`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
