-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2025 at 08:01 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16
CREATE DATABASE IF NOT EXISTS php_mvc_app CHARACTER SET utf8 COLLATE utf8_general_ci;
USE php_mvc_app;

-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 12:59 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `writer` varchar(255) NOT NULL,
  `ISBN13` varchar(13) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `page_number` int NOT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `year` int NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `available` int NOT NULL,
  `stock` int NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `writer`, `ISBN13`, `gender`, `page_number`, `synopsis`, `year`, `image_url`, `available`, `stock`, `upload_date`) VALUES
(105, 'One Hundred Years of Solitude', 'Gabriel García Márquez', '9780060883287', 'Fantaisie', 417, 'A magical realism story of the Buendía family in the town of Macondo.', 1967, 'https://i.etsystatic.com/24703877/r/il/e87bf4/5756700905/il_fullxfull.5756700905_fjzs.jpg', 3, 5, '2025-09-03'),
(110, 'The Very Hungry Caterpillar', 'Eric Carle', '9780399226908', 'Children', 26, 'A caterpillar eats its way through various foods before becoming a butterfly.', 1969, 'https://via.placeholder.com/300?text=No+Image', 1, 5, '2025-09-03'),
(114, 'Dune', 'Frank Herbert', '9780441172719', 'Science-Fiction', 688, 'Une saga épique dans un univers désertique.', 1965, 'https://via.placeholder.com/300?text=Dune', 3, 5, '2025-09-05'),
(116, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '9782070541270', 'Fantaisie', 309, 'Les aventures d\'un jeune sorcier.', 1997, 'https://via.placeholder.com/300?text=Harry+Potter', 3, 5, '2025-09-05'),
(119, 'To Kill a Mockingbird', 'Harper Lee', '9780446310789', 'Classique', 336, 'Une exploration des préjugés raciaux.', 1960, 'https://via.placeholder.com/300?text=Mockingbird', 3, 5, '2025-09-05'),
(130, 'Le Nom de la Rose', 'Umberto Eco', '9782253033134', 'Crime', 512, 'Un mystère médiéval dans une abbaye.', 1980, 'https://via.placeholder.com/300?text=Nom+Rose', 2, 5, '2025-09-05'),
(133, 'Le Parfum', 'Patrick Süskind', '9782253044901', 'Crime', 272, 'Un meurtrier obsédé par les odeurs.', 1985, 'https://via.placeholder.com/300?text=Parfum', 1, 5, '2025-09-05'),
(136, 'L\'Alchimiste', 'Paulo Coelho', '9780061122415', 'Fantaisie', 208, 'Un voyage spirituel à la recherche d\'un trésor.', 1988, 'https://via.placeholder.com/300?text=Alchimiste', 1, 5, '2025-09-05'),
(153, 'L\'Amant', 'Marguerite Duras', '9782707306951', 'Romance', 148, 'Une histoire d\'amour dans l\'Indochine coloniale.', 1984, 'https://via.placeholder.com/300?text=L\'Amant', 1, 5, '2025-09-05'),
(161, 'Matilda', 'Roald Dahl', '9780142410370', 'Children', 240, 'Une petite fille avec des pouvoirs extraordinaires.', 1988, 'https://via.placeholder.com/300?text=Matilda', 1, 5, '2025-09-05'),
(167, 'Les Piliers de la Terre', 'Ken Follett', '9780451166890', 'Historique', 983, 'La construction d\'une cathédrale médiévale.', 1989, 'https://via.placeholder.com/300?text=Piliers+Terre', 2, 5, '2025-09-05'),
(168, 'Le Da Vinci Code', 'Dan Brown', '9780307474278', 'Thriller', 592, 'Un mystère autour de secrets religieux.', 2003, 'https://via.placeholder.com/300?text=Da+Vinci+Code', 5, 0, '2025-09-05'),
(172, 'Le Silence des agneaux', 'Thomas Harris', '9780312924584', 'Thriller', 352, 'Un tueur en série et une agente du FBI.', 1988, 'https://via.placeholder.com/300?text=Silence+Agneaux', 4, 5, '2025-09-05'),
(174, 'Le Monde de Sophie', 'Jostein Gaarder', '9782020238120', 'Philosophie', 544, 'Une introduction à la philosophie.', 1991, 'https://via.placeholder.com/300?text=Monde+Sophie', 1, 5, '2025-09-05'),
(179, 'Les Enfants de Húrin', 'J.R.R. Tolkien', '9780007246229', 'Fantaisie', 320, 'Une tragédie dans l\'univers de Tolkien.', 2007, 'https://via.placeholder.com/300?text=Enfants+Húrin', 0, 1, '2025-09-05'),
(187, 'L\'Archipel du Goulag', 'Alexandre Soljenitsyne', '9782020021166', 'Histoire', 672, 'Une chronique des camps soviétiques.', 1973, 'https://via.placeholder.com/300?text=Archipel+Goulag', 2, 5, '2025-09-05'),
(194, 'Le Guépard', 'Giuseppe Tomasi di Lampedusa', '9782070360284', 'Classique', 320, 'Le déclin de l\'aristocratie sicilienne.', 1958, 'https://via.placeholder.com/300?text=Guépard', 3, 0, '2025-09-05'),
(197, 'Zazie dans le métro', 'Raymond Queneau', '9782070361038', 'Classique', 192, 'Les aventures d\'une jeune fille à Paris.', 1959, 'https://via.placeholder.com/300?text=Zazie', 3, 0, '2025-09-05'),
(199, 'Livre Test 1', 'Auteur 1', '9781234567890', 'Science-Fiction', 300, 'Un voyage épique dans l’espace.', 2023, 'https://via.placeholder.com/200', 0, 3, '2025-09-15'),
(200, 'Livre Test 2', 'Auteur 2', '9780987654321', 'Drame', 250, 'Une histoire émouvante de famille.', 2022, 'https://via.placeholder.com/200', 0, 3, '2025-09-14'),
(201, 'Livre Test 3', 'Auteur 3', '9781122334455', 'Classique', 400, 'Un classique intemporel.', 2021, 'https://via.placeholder.com/200', 0, 0, '2025-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `media_id` int NOT NULL,
  `media_type` enum('book','movie','video_game') NOT NULL,
  `loan_date` datetime NOT NULL COMMENT 'Date et heure précise de l''emprunt',
  `return_date` datetime NOT NULL COMMENT 'Date et heure précise de retour prévue',
  `returned_at` datetime DEFAULT NULL COMMENT 'Date et heure réelle de retour'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `media_stats`
-- (See below for the actual view)
--
CREATE TABLE `media_stats` (
`books_count` bigint
,`movies_count` bigint
,`games_count` bigint
,`total_media` bigint
);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `year` year NOT NULL,
  `gender` varchar(255) NOT NULL,
  `duration` int NOT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `classification` varchar(255) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `available` int NOT NULL,
  `stock` int NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `producer`, `year`, `gender`, `duration`, `synopsis`, `classification`, `image_url`, `available`, `stock`, `upload_date`) VALUES
(106, 'La La Land', 'Damien Chazelle', '2016', 'Romance', 128, 'Une histoire d\'amour entre un musicien et une actrice.', '8.0', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UX1000_.jpg', 1, 4, '2025-09-05'),
(107, 'Blade Runner 2049', 'Denis Villeneuve', '2017', 'Science-Fiction', 163, 'Une suite futuriste explorant l\'humanité.', '8.0', 'https://m.media-amazon.com/images/M/MV5BMTczNDc3MDMxOV5BMl5BanBnXkFtZTgwOTM0OTg3MjE@._V1_FMjpg_UX1000_.jpg', 3, 6, '2025-09-05'),
(108, 'Parasite', 'Bong Joon-ho', '2019', 'Drame', 132, 'Une satire sur les inégalités sociales.', '8.6', 'https://m.media-amazon.com/images/M/MV5BYjJiZjMzYzktNjU0NS00OTkxLWEwYzItYzdhYWJjN2QzMTRlL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_FMjpg_UX1000_.jpg', 0, 0, '2025-09-05'),
(126, 'Whiplash', 'Damien Chazelle', '2014', 'Drame', 107, 'Un jeune batteur poussé à ses limites.', '8.5', 'https://m.media-amazon.com/images/M/MV5BMjE4MjA1NTAyMV5BMl5BanBnXkFtZTcwNzM1NDQyMQ@@._V1_FMjpg_UX1000_.jpg', 0, 5, '2025-09-05'),
(127, 'Mad Max: Fury Road', 'George Miller', '2015', 'Action', 120, 'Une poursuite post-apocalyptique.', '8.1', 'https://m.media-amazon.com/images/M/MV5BMjE4NzgzNzEwMl5BMl5BanBnXkFtZTgwMTMzMDE0NjE@._V1_FMjpg_UX1000_.jpg', 2, 0, '2025-09-05'),
(128, 'The Grand Budapest Hotel', 'Wes Anderson', '2014', 'Comédie', 99, 'Les aventures dans un hôtel européen.', '8.1', 'https://m.media-amazon.com/images/M/MV5BMTc2MTQ3MDA1Nl5BMl5BanBnXkFtZTgwODA3OTI4NjE@._V1_FMjpg_UX1000_.jpg', 1, 5, '2025-09-05'),
(129, 'Moonlight', 'Barry Jenkins', '2016', 'Drame', 111, 'L\'histoire d\'un jeune homme noir à Miami.', '7.4', 'https://m.media-amazon.com/images/M/MV5BMTYwMTA4MzgyNF5BMl5BanBnXkFtZTgwMjEyMjE0MDE@._V1_FMjpg_UX1000_.jpg', 2, 6, '2025-09-05'),
(130, 'Arrival', 'Denis Villeneuve', '2016', 'Science-Fiction', 116, 'Une linguiste communique avec des extraterrestres.', '7.9', 'https://m.media-amazon.com/images/M/MV5BMTU5OTAzMTcxMV5BMl5BanBnXkFtZTgwMjg1MDY4ODE@._V1_FMjpg_UX1000_.jpg', 4, 0, '2025-09-05'),
(145, 'Joker', 'Todd Phillips', '2019', 'Drame', 122, 'L\'origine d\'un méchant iconique.', '8.4', 'https://m.media-amazon.com/images/M/MV5BMjIxMjgxNTk0MF5BMl5BanBnXkFtZTgwNjIyOTk2MDE@._V1_FMjpg_UX1000_.jpg', 0, 5, '2025-09-05'),
(148, 'The Revenant', 'Alejandro G. Iñárritu', '2015', 'Drame', 156, 'Un trappeur cherche vengeance dans la nature.', '8.0', 'https://m.media-amazon.com/images/M/MV5BNGZiMzBkZjUtNjE0U15BMl5BanBnXkFtZTgwNDc4OTk0NTE@._V1_FMjpg_UX1000_.jpg', 3, 5, '2025-09-05'),
(149, 'Room', 'Lenny Abrahamson', '2015', 'Drame', 118, 'Une mère et son fils vivent en captivité.', '8.1', 'https://m.media-amazon.com/images/M/MV5BMzVlYzgxYi00YzhhLWEzODQtMGMxN2E1ZGQ2YjU3XkEyXkFqcGdeQXVyMzAzNTY3MDM@._V1_FMjpg_UX1000_.jpg', 2, 5, '2025-09-05'),
(150, 'The Shape of Water', 'Guillermo del Toro', '2017', 'Fantaisie', 123, 'Une histoire d\'amour entre une femme et une créature.', '7.3', 'https://m.media-amazon.com/images/M/MV5BMjAwMDU5MTE3N15BMl5BanBnXkFtZTgwOTc1MDA4OTE@._V1_FMjpg_UX1000_.jpg', 3, 0, '2025-09-05'),
(151, 'Get Out', 'Jordan Peele', '2017', 'Drame', 104, 'Un thriller sur le racisme caché.', '7.7', 'https://m.media-amazon.com/images/M/MV5BMzg2Mzg4YmUtNDdkNy00NWY1LWE3NmEtZWMzNGZhMjkzYjdjXkEyXkFqcGdeQXVyNTIxMDMyMTk@._V1_FMjpg_UX1000_.jpg', 1, 5, '2025-09-05'),
(152, 'Knives Out', 'Rian Johnson', '2019', 'Crime', 130, 'Un mystère autour d\'un meurtre familial.', '7.9', 'https://m.media-amazon.com/images/M/MV5BMjQ3MDc1Mzc5Ml5BMl5BanBnXkFtZTgwODQzMDU3MzI@._V1_FMjpg_UX1000_.jpg', 0, 5, '2025-09-05'),
(153, '1917', 'Sam Mendes', '2019', 'Drame', 119, 'Une mission dans les tranchées de la WWI.', '8.3', 'https://m.media-amazon.com/images/M/MV5BMGUyM2ZiZmUtMWY0OC00NTVkLTgyYmMtYjBhODYzODFhMTU0XkEyXkFqcGdeQXVyMTAyMjQ3NzQ1._V1_FMjpg_UX1000_.jpg', 2, 0, '2025-09-05'),
(154, 'Jojo Rabbit', 'Taika Waititi', '2019', 'Comédie', 108, 'Un garçon et son ami imaginaire Hitler.', '7.9', 'https://m.media-amazon.com/images/M/MV5BMTgxOTYxMTg3OF5BMl5BanBnXkFtZTgwMDgyMzA2ODI@._V1_FMjpg_UX1000_.jpg', 2, 6, '2025-09-05'),
(155, 'The Irishman', 'Martin Scorsese', '2019', 'Crime', 209, 'Une saga sur la mafia et la loyauté.', '7.8', 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_FMjpg_UX1000_.jpg', 1, 6, '2025-09-05'),
(156, 'Once Upon a Time in Hollywood', 'Quentin Tarantino', '2019', 'Drame', 161, 'Une ode au Hollywood des années 60.', '7.6', 'https://m.media-amazon.com/images/M/MV5BY2NkZjEzMDgtN2RjYy00YzM1LWI4ZmQtMjIwYjFjNmNlOGVkXkEyXkFqcGdeQXVyNTAzNzgwNTg@._V1_FMjpg_UX1000_.jpg', 1, 0, '2025-09-05'),
(191, 'Film Test 1', 'Réalisateur 1', '2023', 'Science-Fiction', 120, 'Une aventure spatiale palpitante.', 'PG-13', 'https://via.placeholder.com/200', 0, 4, '2025-09-15'),
(192, 'Film Test 2', 'Réalisateur 2', '2022', 'Drame', 90, 'Un drame psychologique intense.', 'R', 'https://via.placeholder.com/200', 0, 2, '2025-09-14'),
(193, 'Film Test 3', 'Réalisateur 3', '2021', 'Romance', 100, 'Une histoire d’amour touchante.', 'PG', 'https://via.placeholder.com/200', 0, 0, '2025-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `key_name` varchar(100) NOT NULL,
  `value` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'PHP MVC Starter', 'Nom du site web', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(2, 'maintenance_mode', '0', 'Mode maintenance (0 = désactivé, 1 = activé)', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(3, 'max_login_attempts', '5', 'Nombre maximum de tentatives de connexion', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(4, 'session_timeout', '3600', 'Timeout de session en secondes', '2025-09-09 16:37:49', '2025-09-09 16:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-09-11 11:31:39', '2025-09-11 11:31:39'),
(2, 'Jane', 'Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-09-11 11:31:39', '2025-09-11 11:31:39'),
(3, 'Admin', 'User', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2025-09-11 11:31:39', '2025-09-12 07:37:36'),
(7, 'abbas', '', 'jzafari100@gmail.com', '$2y$10$D30C/fcLZs2rFvwJjoLq6eWudQL9RkvAfCpcF/oCWZqyJT7dhXZ42', 'admin', '2025-09-11 14:53:44', '2025-09-14 11:10:36'),
(8, 'abbas', '', 'abbas@gmail.ocm', '$2y$10$33tqggybCOscSSjmoZRsK.2TonH9xC5Bp7brH/SKBdpGQR4FP.yLS', 'user', '2025-09-11 17:20:47', '2025-09-17 09:00:13');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_stats`
-- (See below for the actual view)
--
CREATE TABLE `user_stats` (
`total_users` bigint
,`new_users_30d` bigint
,`new_users_7d` bigint
);

-- --------------------------------------------------------

--
-- Table structure for table `video_games`
--

CREATE TABLE `video_games` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL,
  `plateform` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `year` int NOT NULL,
  `min_age` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `available` int NOT NULL,
  `stock` int NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `video_games`
--

INSERT INTO `video_games` (`id`, `title`, `editor`, `plateform`, `gender`, `year`, `min_age`, `description`, `image_url`, `available`, `stock`, `upload_date`) VALUES
(95, 'Animal Crossing: New Horizons', 'Nintendo', 'Switch', 'Simulation', 2020, 3, 'Build and customize your island paradise.', 'https://upload.wikimedia.org/wikipedia/en/thumb/1/1f/Animal_Crossing_New_Horizons.jpg/250px-Animal_Crossing_New_Horizons.jpg', 5, 5, '2025-09-03'),
(97, 'Cyberpunk 2077', 'CD Projekt', 'PS5', 'RPG', 2020, 18, 'Un RPG futuriste dans une ville dystopique.', 'https://m.media-amazon.com/images/I/81JGvVvMS1L.jpg', 2, 5, '2025-09-05'),
(103, 'The Last of Us Part II', 'Naughty Dog', 'PS4', 'Action', 2020, 18, 'Une histoire de vengeance dans un monde post-apocalyptique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 4, 5, '2025-09-05'),
(111, 'Doom Eternal', 'id Software', 'PS4', 'Action', 2020, 17, 'Un jeu de tir frénétique contre des démons.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 0, '2025-09-05'),
(125, 'Hades', 'Supergiant Games', 'PC', 'Action', 2020, 13, 'Un rogue-like dans la mythologie grecque.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 2, 5, '2025-09-05'),
(126, 'Ori and the Will of the Wisps', 'Moon Studios', 'Xbox One', 'Plateforme', 2020, 10, 'Une aventure féerique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 3, 0, '2025-09-05'),
(127, 'Ghost of Tsushima', 'Sucker Punch', 'PS4', 'Action', 2020, 17, 'Un samouraï dans le Japon féodal.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 2, 5, '2025-09-05'),
(128, 'Final Fantasy VII Remake', 'Square Enix', 'PS4', 'RPG', 2020, 13, 'Un remake d\'un RPG légendaire.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 6, '2025-09-05'),
(129, 'Elden Ring', 'FromSoftware', 'PS5', 'RPG', 2022, 16, 'Un monde ouvert par les créateurs de Dark Souls.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 5, 0, '2025-09-05'),
(130, 'Half-Life: Alyx', 'Valve', 'PC', 'Action', 2020, 15, 'Un jeu VR dans l\'univers Half-Life.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 4, 6, '2025-09-05'),
(135, 'FIFA 21', 'EA Sports', 'PS4', 'Sport', 2020, 7, 'Un jeu de football populaire.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 3, 0, '2025-09-05'),
(136, 'Call of Duty: Modern Warfare', 'Activision', 'PS4', 'Action', 2019, 17, 'Un jeu de tir militaire.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 3, 5, '2025-09-05'),
(137, 'Apex Legends', 'Respawn Entertainment', 'PC', 'Action', 2019, 13, 'Un battle royale compétitif.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(147, 'Pokémon Sword', 'Game Freak', 'Nintendo Switch', 'RPG', 2019, 7, 'Une aventure Pokémon dans une nouvelle région.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(149, 'Xenoblade Chronicles', 'Monolith Soft', 'Nintendo Switch', 'RPG', 2020, 12, 'Un RPG épique dans un monde fantastique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 3, 0, '2025-09-05'),
(150, 'Yakuza Like a Dragon', 'Sega', 'PS4', 'RPG', 2020, 17, 'Un RPG dans le monde du crime japonais.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 4, 6, '2025-09-05'),
(163, 'Hollow Knight: Silksong', 'Team Cherry', 'PC', 'Action', 2023, 10, 'Une suite à Hollow Knight.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 3, 4, '2025-09-05'),
(164, 'Breath of the Wild 2', 'Nintendo', 'Nintendo Switch', 'Action', 2022, 10, 'Une suite à l\'aventure de Zelda.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 3, 0, '2025-09-05'),
(171, 'Jeu Test 1', 'Éditeur 1', 'PS5', 'Action', 2023, 16, 'Un jeu d’action explosif.', 'https://via.placeholder.com/200', 1, 6, '2025-09-15'),
(172, 'Jeu Test 2', 'Éditeur 2', 'PC', 'Fantaisie', 2022, 12, 'Une aventure fantastique immersive.', 'https://via.placeholder.com/200', 1, 3, '2025-09-14'),
(173, 'Jeu Test 3', 'Éditeur 3', 'Xbox', 'Science-Fiction', 2021, 18, 'Un shooter futuriste.', 'https://via.placeholder.com/200', 0, 0, '2025-09-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_name` (`key_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_email` (`email`);

--
-- Indexes for table `video_games`
--
ALTER TABLE `video_games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `video_games`
--
ALTER TABLE `video_games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

-- --------------------------------------------------------

--
-- Structure for view `media_stats`
--
DROP TABLE IF EXISTS `media_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `media_stats`  AS SELECT (select count(0) from `books`) AS `books_count`, (select count(0) from `movies`) AS `movies_count`, (select count(0) from `video_games`) AS `games_count`, (((select count(0) from `books`) + (select count(0) from `movies`)) + (select count(0) from `video_games`)) AS `total_media` ;

-- --------------------------------------------------------

--
-- Structure for view `user_stats`
--
DROP TABLE IF EXISTS `user_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_stats`  AS SELECT count(0) AS `total_users`, count((case when (`users`.`created_at` >= (now() - interval 30 day)) then 1 end)) AS `new_users_30d`, count((case when (`users`.`created_at` >= (now() - interval 7 day)) then 1 end)) AS `new_users_7d` FROM `users` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
