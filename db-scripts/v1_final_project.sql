-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 05:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



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
  `total_votes` int(255) DEFAULT '0',
  `has_voted` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `content`, `title`, `total_votes`, `has_voted`, `is_active`, `date_created`) VALUES
(1, 2, 3, 'I have the answer', NULL, NULL, 0, 1, '2017-12-11 03:53:14'),
(2, 2, 5, 'I can help!', NULL, NULL, 0, 1, '2017-12-11 05:01:57'),
(3, 2, 1, 'sure I can help out', NULL, 1, 0, 1, '2017-12-11 05:30:21'),
(4, 3, 1, 'testde jfkkjrgk', NULL, NULL, 0, 1, '2017-12-12 03:38:04'),
(5, 4, 12, 'I got it', NULL, 0, 0, 1, '2017-12-12 05:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `answer_votes`
--

CREATE TABLE `answer_votes` (
  `ans_id` int(11) NOT NULL,
  `user_vote_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `has_voted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer_votes`
--

INSERT INTO `answer_votes` (`ans_id`, `user_vote_id`, `rating`, `has_voted`) VALUES
(1, 2, 3, 0),
(2, 2, 2, 0),
(3, 3, 2, 1);

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
(1, 1, 4, 'does this work?', 'first question', '2017-12-08 02:18:36', 1),
(2, 1, 1, 'better', 'second question', '2017-12-08 02:25:36', 0),
(3, 1, 2, 'test', 'third', '2017-12-11 03:20:40', 0),
(4, 2, 3, 'test', 'fourth', '2017-12-11 03:23:11', 0),
(5, 2, 1, 'test', 'active', '2017-12-11 04:49:31', 0),
(6, 2, 4, 'tester', 'tester', '2017-12-11 05:15:52', 0),
(7, 2, 1, 'tester', 'test', '2017-12-11 05:16:50', 0),
(8, 2, 1, 'test', 'another test', '2017-12-11 05:18:24', 0),
(9, 2, 1, 'test', 'test', '2017-12-11 05:21:12', 0),
(10, 4, 1, 'yessir', 'big ol test', '2017-12-12 04:57:28', 1),
(11, 4, 1, 'yeppppp', 'ok here we go', '2017-12-12 04:58:07', 1),
(12, 4, 1, 'test', 'my question', '2017-12-12 05:09:41', 1);

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
(1, 'admin', 'admin', 'admin@classmate.com', '$2y$10$MsSrJRXbFnwHPFy1GlLLj.McoDgbOMXTRPophU/lLZq7OZIrBVBme', '40e0dc6c61ec477d1a027c8ff', NULL, NULL, 0, 0, 1),
(2, 'a', 'a', 'a@a.com', '$2y$10$cI34UeEarr.x8n8fsu6dzO5Afd57hSY5B7nIO1LVbarwgODmpzAn6', '1e7e9f26ce1776d04d99de7c6', NULL, 'http://localhost/adv-web-final-project/user-images/2me7.png', 0, 0, 1),
(3, 'b', 'b', 'b@b.com', '$2y$10$M2V5rsy5vrFHvROBywf/Zuue.qNkuScCoy6WoaogC9oKDgdYL4Xnq', '7f841a13419a08002c3774747', NULL, 'http://localhost/adv-web-final-project/user-images/3me8.png', 0, 0, 1),
(4, 'adam', 'ad', 'ad@ad.com', '$2y$10$kWTMast1gd/OIKB5ihFoZeDXp536wltO52PunK.B6iQfGyfVwQftO', '461ad875b90c16bfc453bbc53', 'testing', 'http://localhost/adv-web-final-project/user-images/4me8.png', 0, 0, 1);

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
(1, 2, 1),
(2, 1, 1),
(3, 1, 1),
(4, 2, 1);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;


