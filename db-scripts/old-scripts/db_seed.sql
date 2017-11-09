 INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `salt`, `bio`, `image_path`, `reputation`, `reputation_votes`, `is_active`)
 VALUES (NULL, 'courtney', 'mcclary', 'test1@test.com', '', '', 'This is a test bio', NULL, '0', '', '0'), 
 (NULL, 'richard', 'jones', 'test2@test.com', '', '', 'Another test bio', NULL, '0', '', '1'),
 (NULL, 'adam', 'harpur', 'test3@test.com', '', '', 'Another test bio', NULL, '0', '', '1') 

INSERT INTO `questions` (`id`, `user_id`, `catergory_id`, `content`, `title`, `date_created`, `is_active`) 
VALUES (NULL, '', '1', 'test?', 'this is a test question', CURRENT_TIMESTAMP, '0'),
(NULL, '', '1', 'testing?', 'this is an active test question', CURRENT_TIMESTAMP, '1');

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `content`, `title`, `total_upvotes`, `has_voted`, `is_active`) 
VALUES (NULL, '', '1', 'yes this works', 'success', '2', '0', '0'),
 (NULL, '', '2', 'yes this works aswell', 'success', '2', '0', '0');