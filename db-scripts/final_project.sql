-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2017 at 12:30 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `total_upvotes` varchar(255) DEFAULT NULL,
  `has_voted` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `content`, `title`, `total_upvotes`, `has_voted`, `is_active`, `date_created`) VALUES
(1, 4, 4, 'testing', NULL, NULL, 0, 1, '2017-12-07 17:24:43'),
(2, 4, 4, 'tester', NULL, NULL, 0, 1, '2017-12-07 17:24:43'),
(3, 5, 1, 'Tester Answer', NULL, NULL, 0, 1, '2017-12-07 17:48:26'),
(4, 5, 3, 'Tester answer', NULL, NULL, 0, 1, '2017-12-07 17:49:06'),
(5, 5, 5, 'my answer', NULL, NULL, 0, 1, '2017-12-07 17:49:57'),
(6, 5, 4, 'test', NULL, NULL, 0, 1, '2017-12-07 17:51:31'),
(7, 1, 6, 'test', NULL, NULL, 0, 1, '2017-12-07 18:38:11'),
(8, 2, 6, 'tester', NULL, NULL, 0, 1, '2017-12-07 18:39:04'),
(9, 2, 6, 'I am person 2', NULL, NULL, 0, 1, '2017-12-07 18:45:54'),
(10, 5, 6, 'test', NULL, NULL, 0, 1, '2017-12-07 19:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `answer_votes`
--

CREATE TABLE `answer_votes` (
  `ans_id` int(11) NOT NULL,
  `user_vote_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer_votes`
--

INSERT INTO `answer_votes` (`ans_id`, `user_vote_id`, `rating`) VALUES
(1, 2, 3),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `is_active`) VALUES
(1, 'Advanced Web Development', 'Advanced Web Development', 1),
(2, 'Advanced Topics in Programming', 'Advanced Topics in Programming', 1),
(3, 'Android Development', 'Android Development', 1),
(4, 'Generals', 'Generals', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `category_id`, `content`, `title`, `date_created`, `is_active`) VALUES
(1, 4, 1, 'let&#39;s ask a question!', 'Question 1', '2017-12-07 16:29:25', 0),
(2, 4, 2, 'test', 'test', '2017-12-07 16:30:39', 0),
(3, 4, 1, 't', 't', '2017-12-07 16:30:57', 0),
(4, 4, 1, 'r', 'r', '2017-12-07 16:33:29', 0),
(5, 5, 1, 'yes', 'my question', '2017-12-07 17:49:48', 0),
(6, 1, 4, 'yes', 'main quest', '2017-12-07 18:36:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user\r\nuser',
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `is_active`) VALUES
(1, 'user', 1),
(2, 'admin', 0),
(3, 'dev', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(25) NOT NULL,
  `bio` text,
  `image_path` varchar(255) DEFAULT NULL,
  `reputation` bigint(20) NOT NULL DEFAULT '0',
  `reputation_votes` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `salt`, `bio`, `image_path`, `reputation`, `reputation_votes`, `is_active`) VALUES
(1, 'person', 'one', '1@1.com', '$2y$10$n3zg.truDN5xEBJLGVmEROnkuaz5AHt.Aikdhs92Fc7M6mS4hd.e2', 'cae0a592cac1a9c7dd1776ed5', NULL, NULL, 0, 0, 1),
(2, 'person', '2', '2@2.com', '$2y$10$tS4VwSrfN4EIaJFii.Paa.2kcH8xr.sc.CsaPuyXTjUMJvLlEup1G', '5c2b09cfdbb5a82971b2dee7f', NULL, '/adv-web-final-project/user-images/2website.PNG', 0, 0, 1),
(3, 'test', 'test', 't@t.com', '$2y$10$mVCj18AvP1zVcKwbXU/AsObzrjfYeSm7Tk.dFVdeDLSpJAuGrN4im', 'f7b0b6669d6fa30361b029715', NULL, NULL, 0, 0, 1),
(4, 'test', 'test', 't@k.com', '$2y$10$vEEyM7P/q1quoR9GuNMWmeSZg.YgXlqHxMdp5c5ulo7Bff9UB.M9q', '97e9c7a13447a59aacfd45483', NULL, NULL, 0, 0, 1),
(5, 'a', 'a', 'a@a.com', '$2y$10$LM0/J2KFQAo8OAJmh3udWOhu6f5wt.nvBZ2hGexYHLz8XSVuyEiRi', '6c19c7f6b155a79d16a363b8b', NULL, NULL, 0, 0, 1),
(6, 'dev', 'dev', 'dev@dev.com', '$2y$10$0fUUjO9t9/WjoGH.3D/OCuu0RuZqwCPnyLvrgbIX.fx1LrjAOCROC', 'ad30f0ed82d79ee903f27a410', NULL, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`, `is_active`) VALUES
(1, 1, 1),
(2, 0, 1),
(3, 0, 1),
(4, 0, 1),
(5, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer_votes`
--
ALTER TABLE `answer_votes`
  ADD PRIMARY KEY (`ans_id`,`user_vote_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
