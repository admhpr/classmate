ALTER TABLE `questions` ADD `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `title`;
ALTER TABLE `users` ADD UNIQUE ('id');
ALTER TABLE `users` ADD UNIQUE ('email');


RENAME TABLE `final_project`.`catergories` TO `final_project`.`categories`;
ALTER TABLE `questions` CHANGE `catergory_id` `category_id` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `catergories` CHANGE `catergory` `category` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;