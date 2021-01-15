--
-- insert `users`
--

-- admin, admin@gmail.com, 1234
INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `role`, `verified`, `blocked`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$kfBRQYmpjppbMA3fgjg3wO/qGoN2KOofRw3yceedUknf.de9Xn3nq', NULL, 'ROLE_ADMIN', 1, 0);


--
-- insert `firms`
--
INSERT INTO `firms` (`id`, `name`) VALUE (1, 'Other');
INSERT INTO `firms` (`id`, `name`) VALUE (2, 'Canon');
INSERT INTO `firms` (`id`, `name`) VALUE (3, 'Panasonic');
INSERT INTO `firms` (`id`, `name`) VALUE (4, 'Olympus');
INSERT INTO `firms` (`id`, `name`) VALUE (5, 'Fujifilm');
INSERT INTO `firms` (`id`, `name`) VALUE (6, 'Sony');
INSERT INTO `firms` (`id`, `name`) VALUE (7, 'Nikon');
INSERT INTO `firms` (`id`, `name`) VALUE (8, 'Hasselblad');
