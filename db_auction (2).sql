-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2025 pada 13.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_auction`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auctions`
--

CREATE TABLE `auctions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `starting_price` decimal(12,2) NOT NULL,
  `final_price` decimal(12,2) DEFAULT NULL,
  `status` enum('pending','active','sold','rejected','closed') NOT NULL DEFAULT 'pending',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auctions`
--

INSERT INTO `auctions` (`id`, `user_id`, `category_id`, `winner_id`, `title`, `description`, `image`, `starting_price`, `final_price`, `status`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 4, 6, NULL, 'Antique Jewelry', 'Beautiful vintage jewelry.', 'img_6936fd98d0b3b9.25329996.jpg', 500.00, NULL, 'rejected', '2025-12-05 08:00:00', '2025-12-10 18:00:00', '2025-12-06 02:06:14', '2025-12-08 17:32:24'),
(2, 5, 4, 5, 'Luxury Car', 'Brand new luxury car.', 'img_6936fdbfdaab90.95084665.jpg', 50000.00, 60000.00, 'sold', '2025-11-20 10:00:00', '2025-11-25 16:00:00', '2025-12-06 02:06:14', '2025-12-08 17:33:03'),
(3, 6, 2, NULL, 'Beach House', 'Beautiful house near the beach.', 'img_6936fdfbe24210.22998332.jpg', 150000.00, 200000.00, 'active', '2025-12-01 09:00:00', '2025-12-15 20:00:00', '2025-12-06 02:06:14', '2025-12-08 17:34:03'),
(4, 7, 8, NULL, 'MacBook Pro', 'Latest MacBook Pro 2025.', 'img_6936fe20667162.80302610.jpg', 2000.00, 2000.00, 'closed', '2025-12-03 11:00:00', '2025-12-08 19:00:00', '2025-12-06 02:06:14', '2025-12-09 12:27:59'),
(5, 4, 4, 6, 'Vintage Car', 'Classic vintage car in mint condition.', 'img_6936fe538630d3.06702319.jpg', 25000.00, 30000.00, 'sold', '2025-11-15 08:30:00', '2025-11-20 17:30:00', '2025-12-06 02:06:14', '2025-12-08 17:35:31'),
(6, 6, 6, NULL, 'Diamond Necklace', 'Sparkling diamond necklace.', 'img_6936fe7e368448.28325128.jpg', 1200.00, NULL, 'active', '2025-12-02 10:00:00', '2025-12-12 18:00:00', '2025-12-06 02:06:14', '2025-12-08 17:36:14'),
(7, 5, 2, NULL, 'Mountain Cabin', 'Cozy cabin in the mountains.', 'img_6936fe9cc8db49.81763269.jpg', 80000.00, NULL, 'rejected', '2025-12-04 09:00:00', '2025-12-14 20:00:00', '2025-12-06 02:06:14', '2025-12-09 11:36:14'),
(8, 7, 8, NULL, 'iMac 2025', 'Powerful desktop iMac 2025.', 'img_6936fec2eac032.70097797.jpg', 2500.00, NULL, 'active', '2025-12-01 12:00:00', '2025-12-10 18:00:00', '2025-12-06 02:06:14', '2025-12-08 17:37:22'),
(9, 6, 4, NULL, 'Sports Car', 'High-performance sports car.', 'img_6936fed8dccbd5.91947198.jpg', 70000.00, NULL, 'rejected', '2025-12-05 08:00:00', '2025-12-15 18:00:00', '2025-12-06 02:06:14', '2025-12-09 11:35:57'),
(10, 4, 6, NULL, 'Gold Ring', 'Elegant gold ring for collectors.', 'img_6936fef6ccf1f6.37191205.jpg', 800.00, NULL, 'active', '2025-12-03 09:00:00', '2025-12-13 19:00:00', '2025-12-06 02:06:14', '2025-12-08 17:38:14'),
(11, 4, 3, NULL, 'Vas Dinasti Ming Asli', 'Vas porselen biru putih langka dari abad ke-16.', 'img_6936ff13537118.64979963.jpg', 1000000.00, NULL, 'pending', '2025-12-06 16:45:00', '2025-12-20 17:46:00', '2025-12-06 10:48:51', '2025-12-08 17:38:43'),
(12, 4, 1, NULL, 'Coffe art', 'Coffee art abstract refers to creating non-representational designs using coffee as a medium (like sepia-toned paintings or coffee grounds for texture) or depicting coffee-related items (beans, cups) in artistic, often geometric or stylized ways, moving beyond realistic portrayals to evoke feeling or aesthetic through shapes, colors, and patterns', 'img_6936ff2c1b0e42.80139056.jpg', 1000000.00, 11000000.00, 'pending', '2025-12-06 17:51:00', '2025-12-13 16:50:00', '2025-12-06 10:51:09', '2025-12-08 17:39:08'),
(16, 4, 4, NULL, 'Classic Mustang 1967', 'Fully restored 1967 Ford Mustang, equipped with a powerful V8 engine and original interior. This classic American muscle car is a testament to automotive history, featuring chrome details, authentic dashboard, and a smooth ride. Perfect for collectors and car enthusiasts.', 'img_6935d5257240b0.34100794.jpg', 80000.00, NULL, 'active', '2025-12-08 02:27:00', '2025-12-18 02:27:00', '2025-12-07 20:27:33', '2025-12-08 15:46:42'),
(17, 4, 8, NULL, 'Apple iPhone 17 Pro', 'Brand new iPhone 17 Pro with 512GB storage, sealed in its original packaging. Offers the latest iOS features, advanced camera system, and high-performance chip for smooth operation. Ideal for tech enthusiasts seeking cutting-edge mobile experience.', 'img_6935d599da47e3.88841097.jpg', 1667.00, NULL, 'rejected', '2025-12-10 02:29:00', '2025-12-11 02:29:00', '2025-12-07 20:29:29', '2025-12-08 19:31:19'),
(18, 4, 9, NULL, 'Rolex Submariner', 'Luxury Rolex Submariner watch crafted from stainless steel with automatic movement. Timeless design, durable construction, and water resistance make it a perfect addition to any watch collection. Ideal for connoisseurs of fine timepieces seeking elegance and prestige.', 'img_6935d5ee19b172.53938039.jpg', 23333.00, NULL, 'active', '2025-12-08 05:30:00', '2025-12-18 06:30:00', '2025-12-07 20:30:54', '2025-12-08 03:50:20'),
(19, 4, 6, NULL, 'Diamond Necklace', 'An exquisite diamond necklace featuring high-quality diamonds set in elegant design. Perfect for special occasions or as a collector’s item, this piece embodies luxury and sophistication, sure to impress anyone with a taste for fine jewelry.', 'img_6935d656e90526.06984391.jpg', 8000.00, NULL, 'active', '2025-12-10 02:32:00', '2025-12-19 02:32:00', '2025-12-07 20:32:38', '2025-12-09 11:35:47'),
(20, 4, 2, NULL, 'Luxury Apartment in Jakarta', 'Spacious 3-bedroom luxury apartment located in the heart of Jakarta, fully furnished with modern amenities. Offers breathtaking city views, 24-hour security, and access to premium facilities such as gym, pool, and concierge services. Perfect for high-end living or investment purposes.', 'img_6935d6c02bce60.13785655.jpg', 166667.00, 170000.00, 'active', '2025-12-08 02:34:00', '2025-12-23 02:34:00', '2025-12-07 20:34:24', '2025-12-09 03:21:51'),
(21, 8, 10, NULL, 'Boeing 747 Model', 'This high-quality aviation model of the Boeing 747 features a detailed fuselage, landing gear, and authentic markings. Ideal for aviation collectors, model enthusiasts, or educational purposes. A remarkable display piece that highlights the engineering marvel of the iconic aircraft.', 'img_6935d7b8b38864.34399075.jpg', 333.00, NULL, 'active', '2025-12-08 05:38:00', '2025-12-24 02:38:00', '2025-12-07 20:38:32', '2025-12-08 03:14:58'),
(22, 5, 3, 4, 'Tribal Mask', 'Mask art involves creating face coverings for disguise, ritual, performance, or symbolic expression, using diverse materials like wood, clay, or papier-mâché, and often representing spirits, animals, or characters', 'img_6936098b215b46.64419440.jpg', 100.00, 900.00, 'closed', '2025-12-08 06:12:00', '2025-12-08 06:16:00', '2025-12-08 00:11:07', '2025-12-09 01:56:48'),
(23, 4, 1, 6, 'Poepole Art', 'Fine art refers to visual arts (painting, sculpture, drawing, etc.) created primarily for aesthetic beauty and intellectual expression, rather than for practical or commercial purposes, emphasizing creativity, emotion, and skill over utility', 'img_69366f17dadb33.99382629.jpg', 400.00, 600.00, 'closed', '2025-12-08 13:24:00', '2025-12-08 13:26:00', '2025-12-08 07:24:23', '2025-12-08 14:29:53'),
(24, 6, 4, 7, 'Lamborgini ', 'a wheeled motor vehicle, typically with four wheels, designed mainly for passenger transport, running on roads, and powered by an engine or motor', 'img_69367047d29327.21488389.jpg', 50000.00, 60000.00, 'sold', '2025-12-08 13:29:00', '2025-12-08 13:31:00', '2025-12-08 07:29:27', '2025-12-09 12:09:54'),
(25, 7, 8, 8, 'Samsung Galaxy Tab A9 Plus', 'The Samsung Galaxy Tab A9 is a compact, affordable Android tablet designed for everyday tasks, media consumption, and light gaming. It features an 8.7-inch display and a sleek, durable metal body. ', 'img_69367d5564c2f8.48183077.jpg', 78.00, 80.00, 'closed', '2025-12-08 14:24:00', '2025-12-08 14:27:00', '2025-12-08 08:25:09', '2025-12-08 14:29:31'),
(26, 7, 9, 8, 'JT 6 (Emprio Armani)', 'The Emporio Armani J06 (likely the correct code instead of JT 6) is a popular style of slim-fit jeans designed for both a modern aesthetic and everyday comfort.', 'img_6936997cd86dd0.27604556.jpg', 500.00, 1000.00, 'closed', '2025-12-08 16:25:00', '2025-12-09 16:25:00', '2025-12-08 10:25:16', '2025-12-09 16:45:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bids`
--

INSERT INTO `bids` (`id`, `auction_id`, `user_id`, `bid_amount`, `created_at`) VALUES
(2, 12, 4, 10000000.00, '2025-12-07 12:17:18'),
(3, 12, 4, 11000000.00, '2025-12-07 12:17:37'),
(4, 2, 4, 60000.00, '2025-12-07 16:36:32'),
(5, 3, 8, 155000.00, '2025-12-07 19:12:25'),
(6, 3, 8, 200000.00, '2025-12-07 19:51:06'),
(7, 22, 4, 500.00, '2025-12-08 00:11:44'),
(8, 22, 6, 600.00, '2025-12-08 00:12:17'),
(9, 22, 8, 700.00, '2025-12-08 00:13:42'),
(10, 22, 4, 800.00, '2025-12-08 00:19:21'),
(11, 23, 5, 500.00, '2025-12-08 07:25:03'),
(12, 23, 6, 600.00, '2025-12-08 07:25:31'),
(13, 24, 7, 60000.00, '2025-12-08 07:30:31'),
(14, 25, 5, 79.00, '2025-12-08 08:26:00'),
(15, 25, 8, 80.00, '2025-12-08 08:26:23'),
(16, 26, 4, 600.00, '2025-12-08 10:26:22'),
(17, 26, 8, 1000.00, '2025-12-08 13:33:19'),
(18, 22, 4, 900.00, '2025-12-08 19:56:48'),
(19, 20, 7, 170000.00, '2025-12-08 21:21:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Fine Art'),
(2, 'Real Estate'),
(3, 'Antique'),
(4, 'Cars'),
(5, 'Motorcyle'),
(6, 'Jewelry'),
(7, 'Electronic'),
(8, 'Gadget'),
(9, 'Watch'),
(10, 'Aviation');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `auction_id`, `user_id`, `amount`, `payment_proof`, `status`, `created_at`, `updated_at`) VALUES
(1, 24, 7, 60000.00, 'img_6936c0af0fb5a5.08715686.jpg', 'verified', '2025-12-08 13:12:31', '2025-12-09 12:09:54'),
(2, 24, 7, 60000.00, 'img_6936c18eeaead3.02453341.jpg', 'rejected', '2025-12-08 13:16:14', '2025-12-09 12:12:42'),
(3, 22, 4, 900.00, 'img_69371f809cb427.09749320.jpg', 'pending', '2025-12-08 19:57:04', '2025-12-09 12:09:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('client','admin') NOT NULL DEFAULT 'client',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Christian Piter w', 'christianpiterwiyoso@gmail.com', '$2y$10$ZzLsnW8igXe/ZFKp9bBqMuG98E8U1xbBwTQCW09Ho2Jo/cKlrNgzW', 'admin', '2025-12-04 11:23:02', '2025-12-05 01:56:45'),
(4, 'Yohanes Widi', 'yohanes@gmail.com', '$2y$10$cgZCMCjocdjPSnNmGRN8oO9gxkf.ojnekyWuVlOQAtdILk.oKO7I.', 'client', '2025-12-04 11:51:44', '2025-12-04 11:51:44'),
(5, 'Yesika', 'yesika@gmail.com', '$2y$10$eNn1x3lUz/euKhLTNoQQMextpaqFqa3JqpN4mkYpJUG9yXaBKPKMK', 'client', '2025-12-04 11:54:49', '2025-12-04 11:54:49'),
(6, 'Gerry', 'gerry@gmail.com', '$2y$10$ft/uvjIUOD4SPqiJYLMXkuKk4wX66Mr2pV/.kLNxHBSPOzZABzqj.', 'client', '2025-12-04 12:12:11', '2025-12-04 12:12:11'),
(7, 'Daren', 'daren@gmail.com', '$2y$10$0526KUHMyB/mjFcHh/qFZ.X/ElbSa3qXwTq8kSTL/8prtBHnSlhZm', 'client', '2025-12-05 11:18:08', '2025-12-05 11:18:08'),
(8, 'Meivaldi Arya Praditya', 'meivaldiarya@gmail.com', '$2y$10$j/97sncJOm//oorEHGcV8ehXalG7aY8GAP/DmK02Enke88dt8CYS6', 'client', '2025-12-07 18:39:35', '2025-12-07 18:39:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_auctions_user` (`user_id`),
  ADD KEY `fk_auctions_cat` (`category_id`),
  ADD KEY `fk_auctions_winner` (`winner_id`);

--
-- Indeks untuk tabel `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bids_auction` (`auction_id`),
  ADD KEY `fk_bids_user` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pay_auction` (`auction_id`),
  ADD KEY `fk_pay_user` (`user_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trans_payment` (`payment_id`),
  ADD KEY `fk_trans_auction` (`auction_id`),
  ADD KEY `fk_trans_buyer` (`buyer_id`),
  ADD KEY `fk_trans_seller` (`seller_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `fk_auctions_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_auctions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_auctions_winner` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `fk_bids_auction` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bids_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_pay_auction` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pay_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_trans_auction` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`),
  ADD CONSTRAINT `fk_trans_buyer` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_trans_payment` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `fk_trans_seller` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
