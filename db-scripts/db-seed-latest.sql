

INSERT INTO `questions` (`id`, `user_id`, `category_id`, `content`, `title`, `is_active`) 
VALUES ('', '2', '2', 'This the first question', 'Where am i?', '1'), 
('', '3', '4', 'The second question', 'Is the question', '0'),
('', '3', '4', 'The third question', 'hello question', '0'),
('', '3', '4', 'The fourth question', 'test question', '0');




INSERT INTO `answers` (`id`, `user_id`, `question_id`, `content`, `title`, `total_upvotes`, `has_voted`, `is_active`) 
VALUES (NULL, '2', '1', 'Answer1', 'the answer', '1', '1', '0'), 
(NULL, '', '2', 'Answer2', 'A answer', '3', '1', '0'),
(NULL, '', '3', 'Answer3', 'Another answer', '3', '1', '0');




INSERT INTO `categories` (`id`, `category`, `description`, `is_active`) 
VALUES (NULL, 'Advanced Web Development', 'Advanced Web Development', 1), 
(NULL, 'Advanced Topics in Programming', 'Advanced Topics in Programming', 1),
(NULL, 'Android Development', 'Android Development', 1),
(NULL, 'Generals', 'Generals', 1);

