--
-- insert `users`
--

-- admin, admin@gmail.com, 1234
INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `role`, `verified`, `blocked`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$kfBRQYmpjppbMA3fgjg3wO/qGoN2KOofRw3yceedUknf.de9Xn3nq', NULL, 'ROLE_ADMIN', 1, 0);