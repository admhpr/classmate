ALTER TABLE `questions` ADD `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `title`;
ALTER TABLE `users` ADD UNIQUE (id);
ALTER TABLE `users` ADD UNIQUE (email);
ALTER TABLE `user_roles` CHANGE `role_id` `role_id` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `user_roles` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `answers` ADD `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `is_active`
ALTER TABLE `categories` CHANGE `catergory` `category` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
REPLACE INTO `answer_votes`(`ans_id`, `user_vote_id`, `rating`) VALUES (1,2,2)
ALTER TABLE `answers` CHANGE `total_votes` `total_votes` INT(255) NULL DEFAULT '0';