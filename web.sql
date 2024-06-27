-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 03:54 AM
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
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `about_title` varchar(255) NOT NULL,
  `about_subtitle` varchar(255) NOT NULL,
  `about_description` text NOT NULL,
  `resume_link` varchar(255) NOT NULL,
  `home_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `about_title`, `about_subtitle`, `about_description`, `resume_link`, `home_id`) VALUES
(1, 'About Me', 'A student', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, quo dolore commodi in exercitationem quasi aliquid autem ullam ipsam soluta maiores cupiditate culpa explicabo recusandae perspiciatis ad esse? Doloribus, cumque.', 'https://drive.google.com/file/d/1oUF3I13YgRFClYQT2JnAQfH65xTgNvax/view', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `contact_info_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`contact_info_id`, `title`, `phone`, `email`, `address`, `linkedin`, `github`, `facebook`, `instagram`) VALUES
(1, 'My Portfolio', '+63 XXX-XXX-XXXX', 'amerilmampao@gmail.com', 'Tanauan City, Batangas, Philippines, 4232', 'https://www.linkedin.com/in/ameril-mu-menin-mampao-04740a314/', 'https://github.com/AmerilMampao', 'https://www.facebook.com/profile.php?id=100083115511418', 'https://www.instagram.com/ame.mampao/');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_us_d` int(11) NOT NULL,
  `contact_us_name` varchar(100) NOT NULL,
  `contact_us_email` varchar(100) NOT NULL,
  `contact_us_phone` varchar(20) NOT NULL,
  `contact_us_message` text NOT NULL,
  `contact_us_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_us_d`, `contact_us_name`, `contact_us_email`, `contact_us_phone`, `contact_us_message`, `contact_us_created_at`) VALUES
(1, 'hhgfghfghfh', 'adminaccount@gmail.com', '09067853219', 'FHDFDFGDF', '2024-06-27 01:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `education_image` varchar(255) DEFAULT NULL,
  `education_degree` varchar(255) NOT NULL,
  `education_institution` varchar(255) NOT NULL,
  `education_location` varchar(255) DEFAULT NULL,
  `education_duration` varchar(50) DEFAULT NULL,
  `STATUS` enum('Pursuing','Completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `education_image`, `education_degree`, `education_institution`, `education_location`, `education_duration`, `STATUS`) VALUES
(1, 'uploads/nu-lipa-hero.jpg', 'Bachelor of Science in Computer Science (BSCS-MLA)', 'National University Lipa', 'Lipa', '2022-2026', 'Pursuing'),
(2, 'uploads/DMMCIHS.jpg', 'Diploma in Science, Technology, Engineering, and Mathematics | STEM', 'DMMC Institute of Health Sciences | DMCCIHS', 'Tanauan', '2018-2019', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `home_id` int(11) NOT NULL,
  `home_profile_image` varchar(255) NOT NULL,
  `home_welcome_message` varchar(255) NOT NULL,
  `home_title` varchar(255) NOT NULL,
  `home_description` varchar(255) NOT NULL,
  `typing_texts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`typing_texts`)),
  `contact_info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`home_id`, `home_profile_image`, `home_welcome_message`, `home_title`, `home_description`, `typing_texts`, `contact_info_id`) VALUES
(1, 'uploads/profile_pic.jpg', 'Welcome to my website!', 'Ameril Mampao', 'I am passionate about creating websites and frontend design.', '[\"Web Development\", \"Frontend Design\", \"User Experience\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projects_id` int(11) NOT NULL,
  `projects_title` varchar(255) NOT NULL,
  `projects_description` text DEFAULT NULL,
  `projects_image_url` varchar(255) DEFAULT NULL,
  `projects_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projects_id`, `projects_title`, `projects_description`, `projects_image_url`, `projects_url`) VALUES
(1, 'Project Title 1', 'Brief description of the project. Highlight key features or technologies used.', 'uploads/Home Section.jpg', 'https://amerilmampao.github.io/html-css-js-portforlio/'),
(2, 'Project Title 2', 'Brief description of the project. Highlight key features or technologies used.', 'uploads/about me section.jpg', 'https://amerilmampao.github.io/html-css-js-portforlio/'),
(3, 'Project Title 3', 'Brief description of the project. Highlight key features or technologies used.', 'uploads/footer section.jpg', 'https://amerilmampao.github.io/html-css-js-portforlio/');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skills_id` int(11) NOT NULL,
  `skills_icon_class` varchar(255) NOT NULL,
  `skills_title` varchar(255) NOT NULL,
  `skills_description` text NOT NULL,
  `skills_learn_more_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skills_id`, `skills_icon_class`, `skills_title`, `skills_description`, `skills_learn_more_link`) VALUES
(1, 'bx bx-code', 'UI/UX Design', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!', 'https://dribbble.com/tags/ui-ux-design'),
(2, 'bx bx-crop', 'UI/UX Design', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!', 'https://dribbble.com/tags/ui-ux-design'),
(3, 'bx bxl-apple', 'UI/UX Design', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!', 'https://dribbble.com/tags/ui-ux-design');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_sex` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) NOT NULL,
  `account_type` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_birthday`, `user_sex`, `user_email`, `user_name`, `user_pass`, `user_profile_picture`, `account_type`) VALUES
(1, 'admin', 'account', '0012-12-12', 'Male', 'adminaccount@gmail.com', '@Adminaccount4566', '$2y$10$7A/nZU6L/PIgk6jQZhMCwuk36Y1YUAGFJalEOu9V1j0LHUTG/vcba', 'uploads/xampp_1719452565.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_id`, `street`, `barangay`, `city`, `province`) VALUES
(1, 1, '@Adminaccount4566', 'Divisoria', 'Mexico', 'Region III (Central Luzon)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `home_id` (`home_id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`contact_info_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_d`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`home_id`),
  ADD KEY `contact_info_id` (`contact_info_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projects_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skills_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `contact_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skills_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ibfk_1` FOREIGN KEY (`home_id`) REFERENCES `home` (`home_id`);

--
-- Constraints for table `home`
--
ALTER TABLE `home`
  ADD CONSTRAINT `home_ibfk_1` FOREIGN KEY (`contact_info_id`) REFERENCES `contact_info` (`contact_info_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
