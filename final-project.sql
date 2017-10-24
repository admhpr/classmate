/* 
*  DB Script Tool
*  MySQL - 2017-10-24 10:56:27
*  
*/ 
CREATE DATABASE IF NOT EXISTS `final-project`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE `final-project`;



/* 
*  users
*  defines a user
*  2017-10-24 10:20:40
*/ 
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `last_name` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `email` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `password` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `salt` VARCHAR(25) COLLATE utf8_general_ci NOT NULL,
    `bio` TEXT,
    `image_path` VARCHAR(255) COLLATE utf8_general_ci,
    `reputation` BIGINT DEFAULT '0' NOT NULL,
    `reputation_votes` INT UNSIGNED NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  user_roles
*  defines user roles
*  2017-10-24 10:20:50
*/ 
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  catergories
*  2017-10-24 10:21:02
*/ 
DROP TABLE IF EXISTS `catergories`;
CREATE TABLE IF NOT EXISTS `catergories` (
    `catergory_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `catergory` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `description` VARCHAR(255) COLLATE utf8_general_ci,
 PRIMARY KEY (`catergory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  questions
*  defines a question
*  2017-10-24 10:21:09
*/ 
DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
    `question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `catergory_id` INT UNSIGNED NOT NULL,
    `content` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
    `title` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
 FOREIGN KEY fk_user(`user_id`)
 FOREIGN KEY fk_catergory(`catergory_id`)
 PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  answers
*  defines an answer
*  2017-10-24 10:21:43
*/ 
DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
    `answer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `question_id` INT UNSIGNED NOT NULL,
    `content` VARCHAR(255) COLLATE utf8_general_ci,
    `title` VARCHAR(255) COLLATE utf8_general_ci,
    `total_upvotes` VARCHAR(255) COLLATE utf8_general_ci,
    `has_voted` TINYINT(1) DEFAULT '0',
 FOREIGN KEY fk_user(`user_id`)
 FOREIGN KEY fk_question(`question_id`)
 PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  roles
*  defines roles a user can have
*/ 
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
    `role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(255) COLLATE utf8_general_ci DEFAULT 'user
user' NOT NULL,
 PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;
