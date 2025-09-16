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
(101, 'Pride and Prejudice', 'Jane Austen', '9780140434262', 'Romance', 432, 'A romantic novel of manners following Elizabeth Bennet and her family.', 1813, 'https://cdn.kobo.com/book-images/b92c31a2-6731-436c-b532-5a3207fec2b6/1200/1200/False/pride-and-prejudice-the-original-1813-edition-a-jane-austen-classic-novel.jpg', 1, 5, '2025-09-03'),
(102, '1984', 'George Orwell', '9780451524935', 'Science-Fiction', 328, 'A dystopian novel about totalitarianism and surveillance.', 1949, 'https://media.gibert.com/media/catalog/product/cache/b1940cabebdcc55af9730bc15c397023/c/_/c_9782072730030-9782072730030_1.jpg', 1, 5, '2025-09-03'),
(103, 'Crime and Punishment', 'Fyodor Dostoevsky', '9780679734505', 'Crime', 576, 'A psychological drama about a young man who commits murder and faces moral dilemmas.', 1866, 'https://m.media-amazon.com/images/I/61-3iQELiiL._SL500_.jpg', 1, 5, '2025-09-03'),
(104, 'Hamlet', 'William Shakespeare', '9780743477123', 'Drame', 160, 'A tragedy about Prince Hamlet seeking revenge for his father\'s murder.', 1603, 'https://staytuned.twic.pics/storage/media/audiobooks/7473c1f0-18f6-4a40-82f3-213bea9add55/3b573073-0403-423a-8a8d-9fcf5f5dc1ba/4057664907578-fc483ad0-3c83-469b-a8f7-2cc33fab8eed.jpg?twic=v1/resize=400', 1, 5, '2025-09-03'),
(105, 'One Hundred Years of Solitude', 'Gabriel García Márquez', '9780060883287', 'Fantaisie', 417, 'A magical realism story of the Buendía family in the town of Macondo.', 1967, 'https://i.etsystatic.com/24703877/r/il/e87bf4/5756700905/il_fullxfull.5756700905_fjzs.jpg', 0, 5, '2025-09-03'),
(106, 'Don Quixote', 'Miguel de Cervantes', '9780060934347', 'Classique', 992, 'The adventures of a man who believes he is a knight.', 1605, 'https://cdn.kobo.com/book-images/66136bf3-041c-477d-acd3-b9853a0d6591/1200/1200/False/don-quixote-101.jpg', 1, 5, '2025-09-03'),
(107, 'The Adventures of Huckleberry Finn', 'Mark Twain', '9780142437179', 'Adventure', 366, 'A boy\'s journey down the Mississippi River.', 1884, 'https://m.media-amazon.com/images/I/71Ss52smcvL._UF1000,1000_QL80_.jpg', 1, 5, '2025-09-03'),
(108, 'Alice\'s Adventures in Wonderland', 'Lewis Carroll', '9780141439761', 'Fantaisie', 128, 'A girl falls into a rabbit hole and enters a fantastical world.', 1865, 'https://m.media-amazon.com/images/I/81Yg3oFfy-L._UF1000,1000_QL80_.jpg', 1, 5, '2025-09-03'),
(109, 'War and Peace', 'Leo Tolstoy', '9781400079988', 'Classique', 1296, 'A historical novel about the Napoleonic Wars.', 1869, 'https://oafnation.com/cdn/shop/articles/dsc_8667-696x502.jpg?v=1693941427&width=2048', 1, 5, '2025-09-03'),
(110, 'The Very Hungry Caterpillar', 'Eric Carle', '9780399226908', 'Children', 26, 'A caterpillar eats its way through various foods before becoming a butterfly.', 1969, 'https://via.placeholder.com/300?text=No+Image', 0, 5, '2025-09-03'),
(111, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '9780156013987', 'Fantaisie', 96, 'Un conte poétique sur l\'amitié et l\'amour.', 1943, 'https://via.placeholder.com/300?text=Petit+Prince', 1, 5, '2025-09-05'),
(112, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', '9782070612888', 'Fantaisie', 1216, 'Une épopée fantastique dans un monde imaginaire.', 1954, 'https://via.placeholder.com/300?text=Seigneur+Anneaux', 0, 5, '2025-09-05'),
(113, 'Crime et Châtiment', 'Fiodor Dostoïevski', '9782253083054', 'Classique', 672, 'Un roman sur la moralité et la rédemption.', 1866, 'https://via.placeholder.com/300?text=Crime+Chatiment', 0, 0, '2025-09-05'),
(114, 'Dune', 'Frank Herbert', '9780441172719', 'Science-Fiction', 688, 'Une saga épique dans un univers désertique.', 1965, 'https://via.placeholder.com/300?text=Dune', 0, 5, '2025-09-05'),
(115, 'Les Misérables', 'Victor Hugo', '9780140444308', 'Classique', 1463, 'Une fresque sociale sur la justice et la rédemption.', 1862, 'https://via.placeholder.com/300?text=Misérables', 0, 0, '2025-09-05'),
(116, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '9782070541270', 'Fantaisie', 309, 'Les aventures d\'un jeune sorcier.', 1997, 'https://via.placeholder.com/300?text=Harry+Potter', 0, 5, '2025-09-05'),
(117, 'L\'Étranger', 'Albert Camus', '9782070360024', 'Classique', 184, 'Une réflexion sur l\'absurde et l\'existence.', 1942, 'https://via.placeholder.com/300?text=L\'Étranger', 1, 5, '2025-09-05'),
(118, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', '9780140449266', 'Classique', 1276, 'Une histoire de vengeance et de rédemption.', 1844, 'https://via.placeholder.com/300?text=Monte+Cristo', 0, 0, '2025-09-05'),
(119, 'To Kill a Mockingbird', 'Harper Lee', '9780446310789', 'Classique', 336, 'Une exploration des préjugés raciaux.', 1960, 'https://via.placeholder.com/300?text=Mockingbird', 0, 5, '2025-09-05'),
(120, 'The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 'Classique', 180, 'Une critique de l\'American Dream.', 1925, 'https://via.placeholder.com/300?text=Gatsby', 1, 5, '2025-09-05'),
(121, 'Le Hobbit', 'J.R.R. Tolkien', '9782070612895', 'Fantaisie', 310, 'Un voyage fantastique dans la Terre du Milieu.', 1937, 'https://via.placeholder.com/300?text=Hobbit', 0, 0, '2025-09-05'),
(122, 'Fahrenheit 451', 'Ray Bradbury', '9781451673319', 'Science-Fiction', 256, 'Une dystopie où les livres sont interdits.', 1953, 'https://via.placeholder.com/300?text=Fahrenheit', 0, 5, '2025-09-05'),
(123, 'Jane Eyre', 'Charlotte Brontë', '9780141441146', 'Romance', 507, 'Une histoire d\'amour et d\'indépendance.', 1847, 'https://via.placeholder.com/300?text=Jane+Eyre', 1, 5, '2025-09-05'),
(124, 'Les Fleurs du Mal', 'Charles Baudelaire', '9782070325764', 'Classique', 256, 'Un recueil de poèmes symbolistes.', 1857, 'https://via.placeholder.com/300?text=Fleurs+du+Mal', 0, 0, '2025-09-05'),
(125, 'Animal Farm', 'George Orwell', '9780451526342', 'Classique', 112, 'Une satire sur le totalitarisme.', 1945, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDE9VYM8KupjUIiKpu0EehCNsg0CSlgJN9Zg&s', 0, 5, '2025-09-05'),
(126, 'L\'Écume des jours', 'Boris Vian', '9782253140870', 'Romance', 317, 'Un roman surréaliste sur l\'amour.', 1947, 'https://via.placeholder.com/300?text=Écume', 0, 0, '2025-09-05'),
(127, 'Brave New World', 'Aldous Huxley', '9780060850524', 'Science-Fiction', 288, 'Une dystopie sur un futur contrôlé.', 1932, 'https://via.placeholder.com/300?text=Brave+New+World', 1, 5, '2025-09-05'),
(128, 'Madame Bovary', 'Gustave Flaubert', '9780140449129', 'Classique', 329, 'Une tragédie sur les désirs insatisfaits.', 1856, 'https://via.placeholder.com/300?text=Bovary', 1, 5, '2025-09-05'),
(129, 'The Catcher in the Rye', 'J.D. Salinger', '9780316769488', 'Classique', 277, 'Une exploration de l\'adolescence.', 1951, 'https://via.placeholder.com/300?text=Catcher', 0, 0, '2025-09-05'),
(130, 'Le Nom de la Rose', 'Umberto Eco', '9782253033134', 'Crime', 512, 'Un mystère médiéval dans une abbaye.', 1980, 'https://via.placeholder.com/300?text=Nom+Rose', 0, 5, '2025-09-05'),
(131, 'Les Hauts de Hurlevent', 'Emily Brontë', '9780141439556', 'Romance', 416, 'Une histoire d\'amour tragique sur les landes.', 1847, 'https://via.placeholder.com/300?text=Hurlevent', 1, 5, '2025-09-05'),
(132, 'L\'Odyssée', 'Homère', '9780140268867', 'Classique', 541, 'Les aventures d\'Ulysse après la guerre de Troie.', 800, 'https://via.placeholder.com/300?text=Odyssée', 0, 0, '2025-09-05'),
(133, 'Le Parfum', 'Patrick Süskind', '9782253044901', 'Crime', 272, 'Un meurtrier obsédé par les odeurs.', 1985, 'https://via.placeholder.com/300?text=Parfum', 0, 5, '2025-09-05'),
(134, 'Moby Dick', 'Herman Melville', '9780142437247', 'Classique', 704, 'La quête obsessionnelle du capitaine Achab.', 1851, 'https://via.placeholder.com/300?text=Moby+Dick', 0, 0, '2025-09-05'),
(135, 'Le Rouge et le Noir', 'Stendhal', '9780140447644', 'Classique', 576, 'Un jeune homme ambitieux dans la société française.', 1830, 'https://via.placeholder.com/300?text=Rouge+Noir', 1, 5, '2025-09-05'),
(136, 'L\'Alchimiste', 'Paulo Coelho', '9780061122415', 'Fantaisie', 208, 'Un voyage spirituel à la recherche d\'un trésor.', 1988, 'https://via.placeholder.com/300?text=Alchimiste', 0, 5, '2025-09-05'),
(137, 'Frankenstein', 'Mary Shelley', '9780141439471', 'Science-Fiction', 280, 'Un scientifique crée une créature monstrueuse.', 1818, 'https://via.placeholder.com/300?text=Frankenstein', 0, 0, '2025-09-05'),
(138, 'Guerre et Paix', 'Léon Tolstoï', '9782070409167', 'Classique', 1225, 'Une fresque sur les guerres napoléoniennes.', 1869, 'https://via.placeholder.com/300?text=Guerre+Paix', 1, 5, '2025-09-05'),
(139, 'Dracula', 'Bram Stoker', '9780141439846', 'Horreur', 418, 'Un comte vampire terrorise Londres.', 1897, 'https://via.placeholder.com/300?text=Dracula', 1, 5, '2025-09-05'),
(140, 'Le Meilleur des mondes', 'Aldous Huxley', '9782266152082', 'Science-Fiction', 288, 'Une dystopie sur un futur contrôlé.', 1932, 'https://via.placeholder.com/300?text=Meilleur+Mondes', 0, 0, '2025-09-05'),
(141, 'Les Liaisons dangereuses', 'Pierre Choderlos de Laclos', '9780140449570', 'Classique', 448, 'Une intrigue sur la manipulation et la séduction.', 1782, 'https://via.placeholder.com/300?text=Liaisons', 1, 5, '2025-09-05'),
(142, 'Le Vieil Homme et la Mer', 'Ernest Hemingway', '9780684801223', 'Classique', 128, 'Un pêcheur lutte contre un poisson géant.', 1952, 'https://via.placeholder.com/300?text=Vieil+Homme', 0, 0, '2025-09-05'),
(143, 'Candide', 'Voltaire', '9780140455106', 'Classique', 144, 'Une satire sur l\'optimisme.', 1759, 'https://via.placeholder.com/300?text=Candide', 1, 5, '2025-09-05'),
(144, 'Les Raisins de la colère', 'John Steinbeck', '9780143039433', 'Classique', 464, 'Une famille lutte pendant la Grande Dépression.', 1939, 'https://via.placeholder.com/300?text=Raisins+Colère', 1, 5, '2025-09-05'),
(145, 'Don Quichotte', 'Miguel de Cervantes', '9782070349777', 'Classique', 992, 'Les aventures d\'un chevalier imaginaire.', 1605, 'https://via.placeholder.com/300?text=Don+Quichotte', 0, 0, '2025-09-05'),
(146, 'L\'Appel de la forêt', 'Jack London', '9780141321059', 'Aventure', 160, 'Un chien découvre ses instincts sauvages.', 1903, 'https://via.placeholder.com/300?text=Appel+Forêt', 1, 5, '2025-09-05'),
(147, 'Siddhartha', 'Hermann Hesse', '9780553208849', 'Philosophie', 152, 'Un voyage spirituel en Inde.', 1922, 'https://via.placeholder.com/300?text=Siddhartha', 1, 5, '2025-09-05'),
(148, 'Le Portrait de Dorian Gray', 'Oscar Wilde', '9780141439570', 'Classique', 304, 'Un homme reste éternellement jeune.', 1890, 'https://via.placeholder.com/300?text=Dorian+Gray', 0, 0, '2025-09-05'),
(149, 'Les Aventures de Tom Sawyer', 'Mark Twain', '9780140390483', 'Aventure', 224, 'Les péripéties d\'un garçon espiègle.', 1876, 'https://via.placeholder.com/300?text=Tom+Sawyer', 1, 5, '2025-09-05'),
(150, 'Le Seigneur des Mouches', 'William Golding', '9780399501487', 'Classique', 208, 'Des enfants échoués sur une île.', 1954, 'https://via.placeholder.com/300?text=Seigneur+Mouches', 0, 5, '2025-09-05'),
(151, 'L\'Île au trésor', 'Robert Louis Stevenson', '9780141321004', 'Aventure', 240, 'Une chasse au trésor pirate.', 1883, 'https://via.placeholder.com/300?text=Île+Trésor', 0, 0, '2025-09-05'),
(152, 'Les Trois Mousquetaires', 'Alexandre Dumas', '9780141442341', 'Aventure', 736, 'Les aventures de d\'Artagnan et ses amis.', 1844, 'https://via.placeholder.com/300?text=Trois+Mousquetaires', 1, 5, '2025-09-05'),
(153, 'L\'Amant', 'Marguerite Duras', '9782707306951', 'Romance', 148, 'Une histoire d\'amour dans l\'Indochine coloniale.', 1984, 'https://via.placeholder.com/300?text=L\'Amant', 0, 5, '2025-09-05'),
(154, 'La Métamorphose', 'Franz Kafka', '9780143106258', 'Classique', 96, 'Un homme se réveille transformé en insecte.', 1915, 'https://via.placeholder.com/300?text=Métamorphose', 0, 0, '2025-09-05'),
(155, 'Le Procès', 'Franz Kafka', '9780805209990', 'Classique', 312, 'Un homme accusé sans raison.', 1925, 'https://via.placeholder.com/300?text=Procès', 1, 5, '2025-09-05'),
(156, 'Germinal', 'Émile Zola', '9780140447422', 'Classique', 592, 'La vie des mineurs dans le nord de la France.', 1885, 'https://via.placeholder.com/300?text=Germinal', 0, 0, '2025-09-05'),
(157, 'L\'Éducation sentimentale', 'Gustave Flaubert', '9780140447569', 'Classique', 464, 'Les désillusions d\'un jeune homme.', 1869, 'https://via.placeholder.com/300?text=Éducation+Sentimentale', 1, 5, '2025-09-05'),
(158, 'Le Magicien d\'Oz', 'L. Frank Baum', '9780141321028', 'Fantaisie', 208, 'Dorothy voyage dans un monde magique.', 1900, 'https://via.placeholder.com/300?text=Magicien+Oz', 1, 5, '2025-09-05'),
(159, 'Le Lion, la Sorcière blanche et l\'Armoire magique', 'C.S. Lewis', '9780064404990', 'Fantaisie', 208, 'Des enfants découvrent Narnia.', 1950, 'https://via.placeholder.com/300?text=Narnia', 0, 0, '2025-09-05'),
(160, 'Charlotte\'s Web', 'E.B. White', '9780064400558', 'Children', 192, 'Une amitié entre un cochon et une araignée.', 1952, 'https://via.placeholder.com/300?text=Charlotte', 0, 5, '2025-09-05'),
(161, 'Matilda', 'Roald Dahl', '9780142410370', 'Children', 240, 'Une petite fille avec des pouvoirs extraordinaires.', 1988, 'https://via.placeholder.com/300?text=Matilda', 0, 5, '2025-09-05'),
(162, 'Le Journal d\'Anne Frank', 'Anne Frank', '9780553296983', 'Biographie', 283, 'Le journal d\'une jeune fille pendant l\'Holocauste.', 1947, 'https://via.placeholder.com/300?text=Anne+Frank', 0, 0, '2025-09-05'),
(163, 'Les Voyages de Gulliver', 'Jonathan Swift', '9780141439495', 'Classique', 336, 'Les aventures dans des mondes étranges.', 1726, 'https://via.placeholder.com/300?text=Gulliver', 1, 5, '2025-09-05'),
(164, 'Le Fantôme de l\'Opéra', 'Gaston Leroux', '9780060809249', 'Horreur', 368, 'Un mystère dans l\'Opéra de Paris.', 1910, 'https://via.placeholder.com/300?text=Fantôme+Opéra', 1, 5, '2025-09-05'),
(165, 'Vingt Mille Lieues sous les mers', 'Jules Verne', '9780141441979', 'Aventure', 496, 'Une exploration sous-marine.', 1870, 'https://via.placeholder.com/300?text=Vingt+Mille+Lieues', 0, 0, '2025-09-05'),
(166, 'Autant en emporte le vent', 'Margaret Mitchell', '9780446675536', 'Romance', 960, 'Une saga dans le Sud américain.', 1936, 'https://via.placeholder.com/300?text=Autant+Emporte', 1, 5, '2025-09-05'),
(167, 'Les Piliers de la Terre', 'Ken Follett', '9780451166890', 'Historique', 983, 'La construction d\'une cathédrale médiévale.', 1989, 'https://via.placeholder.com/300?text=Piliers+Terre', 0, 5, '2025-09-05'),
(168, 'Le Da Vinci Code', 'Dan Brown', '9780307474278', 'Thriller', 592, 'Un mystère autour de secrets religieux.', 2003, 'https://via.placeholder.com/300?text=Da+Vinci+Code', 0, 0, '2025-09-05'),
(169, 'L\'Attrape-cœurs', 'J.D. Salinger', '9782253151425', 'Classique', 277, 'Un adolescent en crise.', 1951, 'https://via.placeholder.com/300?text=Attrape+Cœurs', 0, 5, '2025-09-05'),
(170, 'La Ferme des animaux', 'George Orwell', '9782070368228', 'Classique', 112, 'Une satire du totalitarisme.', 1945, 'https://via.placeholder.com/300?text=Ferme+Animaux', 0, 0, '2025-09-05'),
(171, 'Le Vieillard et la Mer', 'Ernest Hemingway', '9782070362363', 'Classique', 128, 'Un pêcheur face à un défi.', 1952, 'https://via.placeholder.com/300?text=Vieillard+Mer', 0, 5, '2025-09-05'),
(172, 'Le Silence des agneaux', 'Thomas Harris', '9780312924584', 'Thriller', 352, 'Un tueur en série et une agente du FBI.', 1988, 'https://via.placeholder.com/300?text=Silence+Agneaux', 0, 5, '2025-09-05'),
(173, 'Les Chroniques de Narnia', 'C.S. Lewis', '9780066238500', 'Fantaisie', 784, 'Une série d\'aventures dans un monde magique.', 1950, 'https://via.placeholder.com/300?text=Narnia+Chroniques', 0, 0, '2025-09-05'),
(174, 'Le Monde de Sophie', 'Jostein Gaarder', '9782020238120', 'Philosophie', 544, 'Une introduction à la philosophie.', 1991, 'https://via.placeholder.com/300?text=Monde+Sophie', 0, 5, '2025-09-05'),
(175, 'L\'Homme qui rit', 'Victor Hugo', '9780141441481', 'Classique', 672, 'Un homme défiguré dans une société cruelle.', 1869, 'https://via.placeholder.com/300?text=Homme+Rit', 0, 0, '2025-09-05'),
(176, 'L\'Énigme des sables', 'Erskine Childers', '9780143106142', 'Aventure', 336, 'Un mystère d\'espionnage maritime.', 1903, 'https://via.placeholder.com/300?text=Énigme+Sables', 1, 5, '2025-09-05'),
(177, 'Le Horla', 'Guy de Maupassant', '9780140449112', 'Horreur', 80, 'Un homme hanté par une présence invisible.', 1887, 'https://via.placeholder.com/300?text=Horla', 1, 5, '2025-09-05'),
(178, 'La Peste', 'Albert Camus', '9782070360420', 'Classique', 336, 'Une ville confrontée à une épidémie.', 1947, 'https://via.placeholder.com/300?text=Peste', 0, 0, '2025-09-05'),
(179, 'Les Enfants de Húrin', 'J.R.R. Tolkien', '9780007246229', 'Fantaisie', 320, 'Une tragédie dans l\'univers de Tolkien.', 2007, 'https://via.placeholder.com/300?text=Enfants+Húrin', 0, 5, '2025-09-05'),
(180, 'Le Désert des Tartares', 'Dino Buzzati', '9782070360680', 'Classique', 256, 'Un officier attend une guerre qui ne vient pas.', 1940, 'https://via.placeholder.com/300?text=Désert+Tartares', 1, 5, '2025-09-05'),
(181, 'L\'Iliade', 'Homère', '9780140275360', 'Classique', 704, 'La guerre de Troie et les héros grecs.', 800, 'https://via.placeholder.com/300?text=Iliade', 1, 5, '2025-09-05'),
(182, 'L\'Étrange Cas du Dr Jekyll et de Mr Hyde', 'Robert Louis Stevenson', '9780141439730', 'Horreur', 128, 'Un homme aux deux personnalités.', 1886, 'https://via.placeholder.com/300?text=Jekyll+Hyde', 1, 5, '2025-09-05'),
(183, 'Les Frères Karamazov', 'Fiodor Dostoïevski', '9780140449242', 'Classique', 960, 'Un drame familial et philosophique.', 1880, 'https://via.placeholder.com/300?text=Frères+Karamazov', 0, 0, '2025-09-05'),
(184, 'Le Tour du monde en quatre-vingts jours', 'Jules Verne', '9780140449068', 'Aventure', 248, 'Un voyage autour du monde contre la montre.', 1873, 'https://via.placeholder.com/300?text=Tour+Monde', 1, 5, '2025-09-05'),
(185, 'La Chartreuse de Parme', 'Stendhal', '9780140449662', 'Classique', 528, 'Les intrigues d\'un jeune noble italien.', 1839, 'https://via.placeholder.com/300?text=Chartreuse+Parme', 1, 5, '2025-09-05'),
(186, 'Les Contes de Canterbury', 'Geoffrey Chaucer', '9780140424386', 'Classique', 528, 'Des récits de pèlerins médiévaux.', 1400, 'https://via.placeholder.com/300?text=Contes+Canterbury', 0, 0, '2025-09-05'),
(187, 'L\'Archipel du Goulag', 'Alexandre Soljenitsyne', '9782020021166', 'Histoire', 672, 'Une chronique des camps soviétiques.', 1973, 'https://via.placeholder.com/300?text=Archipel+Goulag', 0, 5, '2025-09-05'),
(188, 'Le Grand Meaulnes', 'Alain-Fournier', '9780141441894', 'Romance', 224, 'Une histoire d\'amour et de mystère.', 1913, 'https://via.placeholder.com/300?text=Grand+Meaulnes', 1, 5, '2025-09-05'),
(189, 'Les Âmes mortes', 'Nikolaï Gogol', '9780140448078', 'Classique', 496, 'Un escroc achète des âmes de serfs décédés.', 1842, 'https://via.placeholder.com/300?text=Âmes+Mortes', 0, 0, '2025-09-05'),
(190, 'Le Joueur d\'échecs', 'Stefan Zweig', '9782253153757', 'Classique', 112, 'Un duel psychologique sur un paquebot.', 1943, 'https://via.placeholder.com/300?text=Joueur+Échecs', 1, 5, '2025-09-05'),
(191, 'L\'Amant de Lady Chatterley', 'D.H. Lawrence', '9780141441498', 'Romance', 384, 'Une histoire d\'amour controversée.', 1928, 'https://via.placeholder.com/300?text=Lady+Chatterley', 1, 5, '2025-09-05'),
(192, 'Le Pavillon d\'or', 'Yukio Mishima', '9782070369775', 'Classique', 288, 'Un moine obsédé par un temple.', 1956, 'https://via.placeholder.com/300?text=Pavillon+Or', 0, 0, '2025-09-05'),
(193, 'Le Bruit et la Fureur', 'William Faulkner', '9782070215324', 'Classique', 352, 'Une famille en déclin dans le Sud américain.', 1929, 'https://via.placeholder.com/300?text=Bruit+Fureur', 1, 5, '2025-09-05'),
(194, 'Le Guépard', 'Giuseppe Tomasi di Lampedusa', '9782070360284', 'Classique', 320, 'Le déclin de l\'aristocratie sicilienne.', 1958, 'https://via.placeholder.com/300?text=Guépard', 0, 0, '2025-09-05'),
(195, 'Le Mur', 'Jean-Paul Sartre', '9782070368785', 'Philosophie', 192, 'Un recueil de nouvelles existentialistes.', 1939, 'https://via.placeholder.com/300?text=Mur', 0, 5, '2025-09-05'),
(196, 'La Condition humaine', 'André Malraux', '9782070360017', 'Classique', 368, 'Une révolte en Chine dans les années 1920.', 1933, 'https://via.placeholder.com/300?text=Condition+Humaine', 1, 5, '2025-09-05'),
(197, 'Zazie dans le métro', 'Raymond Queneau', '9782070361038', 'Classique', 192, 'Les aventures d\'une jeune fille à Paris.', 1959, 'https://via.placeholder.com/300?text=Zazie', 0, 0, '2025-09-05'),
(198, 'Iliade', 'Homère', '9780140275360', 'Classique', 704, 'La guerre de Troie et ses héros.', 800, 'https://via.placeholder.com/300?text=Iliade', 1, 5, '2025-09-05');

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

--
-- Dumping data for table `loans`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;


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
(7, 'abbas', '', 'jzafari100@gmail.com', '$2y$10$D30C/fcLZs2rFvwJjoLq6eWudQL9RkvAfCpcF/oCWZqyJT7dhXZ42', 'user', '2025-09-11 14:53:44', '2025-09-12 07:36:52'),
(8, 'abbas', '', 'abbas@gmail.ocm', '$2y$10$33tqggybCOscSSjmoZRsK.2TonH9xC5Bp7brH/SKBdpGQR4FP.yLS', 'user', '2025-09-11 17:20:47', '2025-09-11 17:20:47');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_stats`
-- (See below for the actual view)
--
CREATE TABLE `user_stats` (
`new_users_30d` bigint
,`new_users_7d` bigint
,`total_users` bigint
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
(86, 'Super Mario Bros.', 'Nintendo', 'NES', 'Platform', 1985, 3, 'Mario rescues Princess Toadstool from Bowser.', 'https://m.media-amazon.com/images/I/910ijZQT8nL._UF1000,1000_QL80_.jpg', 1, 5, '2025-09-03'),
(87, 'The Legend of Zelda: Breath of the Wild', 'Nintendo', 'Switch', 'Adventure', 2017, 10, 'Link explores Hyrule to defeat Calamity Ganon.', 'https://gaming-cdn.com/images/products/2616/orig/the-legend-of-zelda-breath-of-the-wild-switch-jeu-nintendo-eshop-europe-cover.jpg?v=1730381682', 1, 5, '2025-09-03'),
(88, 'Minecraft', 'Mojang', 'Multi-platform', 'Sandbox', 2011, 7, 'Players build and explore in a blocky world.', 'https://gaming-cdn.com/images/products/442/orig/minecraft-java-bedrock-edition-java-bedrock-edition-pc-jeu-cover.jpg?v=1716387513', 1, 5, '2025-09-03'),
(89, 'Grand Theft Auto V', 'Rockstar Games', 'Multi-platform', 'Action-Adventure', 2013, 18, 'Three criminals plan heists in Los Santos.', 'https://cdn1.epicgames.com/offer/b0cd075465c44f87be3b505ac04a2e46/EGS_GrandTheftAutoVEnhanced_RockstarNorth_S1_2560x1440-906d8ae76a91aafc60b1a54c23fab496', 1, 5, '2025-09-03'),
(90, 'Tetris', 'Various', 'Multi-platform', 'Puzzle', 1984, 3, 'Arrange falling blocks to complete lines.', 'https://m.media-amazon.com/images/I/61M3rDwh4qL.png', 1, 5, '2025-09-03'),
(91, 'The Witcher 3: Wild Hunt', 'CD Projekt', 'Multi-platform', 'RPG', 2015, 18, 'Geralt searches for his adopted daughter.', 'https://cdn1.epicgames.com/offer/14ee004dadc142faaaece5a6270fb628/EGS_TheWitcher3WildHuntCompleteEdition_CDPROJEKTRED_S1_2560x1440-82eb5cf8f725e329d3194920c0c0b64f', 1, 5, '2025-09-03'),
(92, 'Super Smash Bros. Ultimate', 'Nintendo', 'Switch', 'Fighting', 2018, 10, 'Characters from various franchises battle.', 'https://www.nintendo.com/eu/media/images/10_share_images/games_15/nintendo_switch_4/H2x1_NSwitch_SuperSmashBrosUltimate_02.jpg', 1, 5, '2025-09-03'),
(93, 'Fortnite', 'Epic Games', 'Multi-platform', 'Battle Royale', 2017, 13, 'Players compete to be the last one standing.', 'https://cdn1.epicgames.com/offer/fn/FNBR_37-00_C6S4_EGS_Launcher_KeyArt_FNLogo_Carousel_PDP_2560x1440_logo_2560x1440-04348f5d3d52391f572e8c1050ddc737', 1, 5, '2025-09-03'),
(94, 'Among Us', 'Innersloth', 'Multi-platform', 'Social Deduction', 2018, 10, 'Crewmates complete tasks while impostors sabotage.', 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000036098/758ab0b61205081da2466386940752c70e0e5ea43bd39e8b9b13eaa455c69b7e', 1, 5, '2025-09-03'),
(95, 'Animal Crossing: New Horizons', 'Nintendo', 'Switch', 'Simulation', 2020, 3, 'Build and customize your island paradise.', 'https://upload.wikimedia.org/wikipedia/en/thumb/1/1f/Animal_Crossing_New_Horizons.jpg/250px-Animal_Crossing_New_Horizons.jpg', 0, 5, '2025-09-03'),
(96, 'Super Mario Odyssey', 'Nintendo', 'Nintendo Switch', 'Plateforme', 2017, 7, 'Une aventure 3D colorée avec Mario.', 'https://m.media-amazon.com/images/I/71rD3oX32lL.jpg', 1, 5, '2025-09-05'),
(97, 'Cyberpunk 2077', 'CD Projekt', 'PS5', 'RPG', 2020, 18, 'Un RPG futuriste dans une ville dystopique.', 'https://m.media-amazon.com/images/I/81JGvVvMS1L.jpg', 0, 5, '2025-09-05'),
(98, 'Red Dead Redemption 2', 'Rockstar Games', 'PS4', 'Action', 2018, 17, 'Une épopée western dans un monde ouvert.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 1, 5, '2025-09-05'),
(99, 'God of War', 'Santa Monica Studio', 'PS4', 'Action', 2018, 17, 'Un père et son fils dans une quête mythologique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(100, 'The Elder Scrolls V: Skyrim', 'Bethesda', 'PC', 'RPG', 2011, 15, 'Un monde ouvert de fantasy épique.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 0, 0, '2025-09-05'),
(101, 'Horizon Zero Dawn', 'Guerrilla Games', 'PS4', 'Action', 2017, 13, 'Une chasseuse dans un monde post-apocalyptique.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(102, 'Portal 2', 'Valve', 'PC', 'Puzzle', 2011, 10, 'Un jeu de réflexion avec des portails.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(103, 'The Last of Us Part II', 'Naughty Dog', 'PS4', 'Action', 2020, 18, 'Une histoire de vengeance dans un monde post-apocalyptique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 5, '2025-09-05'),
(104, 'Overwatch', 'Blizzard', 'PC', 'Action', 2016, 12, 'Un jeu de tir en équipe.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(105, 'Dark Souls III', 'FromSoftware', 'PS4', 'RPG', 2016, 16, 'Un RPG difficile dans un monde sombre.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 0, 0, '2025-09-05'),
(106, 'Hollow Knight', 'Team Cherry', 'PC', 'Action', 2017, 10, 'Une aventure dans un monde souterrain.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(107, 'Bloodborne', 'FromSoftware', 'PS4', 'RPG', 2015, 16, 'Un RPG gothique et terrifiant.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(108, 'Sekiro: Shadows Die Twice', 'FromSoftware', 'PS4', 'Action', 2019, 16, 'Un ninja dans le Japon féodal.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(109, 'Celeste', 'Matt Makes Games', 'PC', 'Plateforme', 2018, 10, 'Un jeu de plateforme sur l\'escalade.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(110, 'Stardew Valley', 'ConcernedApe', 'PC', 'Simulation', 2016, 7, 'Une vie à la ferme avec des aventures.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(111, 'Doom Eternal', 'id Software', 'PS4', 'Action', 2020, 17, 'Un jeu de tir frénétique contre des démons.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 0, 0, '2025-09-05'),
(112, 'Bioshock Infinite', 'Irrational Games', 'PC', 'Action', 2013, 15, 'Une aventure dans une ville flottante.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(113, 'Mass Effect 2', 'BioWare', 'PC', 'RPG', 2010, 15, 'Une épopée spatiale avec des choix narratifs.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 1, 5, '2025-09-05'),
(114, 'Uncharted 4: A Thief\'s End', 'Naughty Dog', 'PS4', 'Aventure', 2016, 13, 'Une chasse au trésor avec Nathan Drake.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(115, 'Persona 5', 'Atlus', 'PS4', 'RPG', 2016, 16, 'Un groupe d\'adolescents combat le crime.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(116, 'Death Stranding', 'Kojima Productions', 'PS4', 'Action', 2019, 17, 'Un livreur dans un monde post-apocalyptique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 5, '2025-09-05'),
(117, 'Journey', 'Thatgamecompany', 'PS4', 'Aventure', 2012, 7, 'Un voyage spirituel dans un désert.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 0, 0, '2025-09-05'),
(118, 'Fire Emblem: Three Houses', 'Nintendo', 'Nintendo Switch', 'RPG', 2019, 12, 'Un RPG tactique dans une académie.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(119, 'Splatoon 2', 'Nintendo', 'Nintendo Switch', 'Action', 2017, 10, 'Un jeu de tir coloré avec des encres.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(120, 'Monster Hunter: World', 'Capcom', 'PS4', 'Action', 2018, 13, 'Chasser des monstres dans un monde ouvert.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(121, 'Assassin\'s Creed Odyssey', 'Ubisoft', 'PS4', 'Action', 2018, 15, 'Une aventure dans la Grèce antique.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(122, 'Spider-Man', 'Insomniac Games', 'PS4', 'Action', 2018, 13, 'Un super-héros dans New York.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(123, 'Resident Evil 2', 'Capcom', 'PS4', 'Action', 2019, 17, 'Un remake d\'un survival horror.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(124, 'Control', 'Remedy Entertainment', 'PS4', 'Action', 2019, 15, 'Une aventure surnaturelle dans un bâtiment étrange.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 5, '2025-09-05'),
(125, 'Hades', 'Supergiant Games', 'PC', 'Action', 2020, 13, 'Un rogue-like dans la mythologie grecque.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 0, 5, '2025-09-05'),
(126, 'Ori and the Will of the Wisps', 'Moon Studios', 'Xbox One', 'Plateforme', 2020, 10, 'Une aventure féerique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(127, 'Ghost of Tsushima', 'Sucker Punch', 'PS4', 'Action', 2020, 17, 'Un samouraï dans le Japon féodal.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 0, 5, '2025-09-05'),
(128, 'Final Fantasy VII Remake', 'Square Enix', 'PS4', 'RPG', 2020, 13, 'Un remake d\'un RPG légendaire.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 6, '2025-09-05'),
(129, 'Elden Ring', 'FromSoftware', 'PS5', 'RPG', 2022, 16, 'Un monde ouvert par les créateurs de Dark Souls.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(130, 'Half-Life: Alyx', 'Valve', 'PC', 'Action', 2020, 15, 'Un jeu VR dans l\'univers Half-Life.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 6, '2025-09-05'),
(131, 'Destiny 2', 'Bungie', 'PC', 'Action', 2017, 13, 'Un jeu de tir en ligne dans un univers sci-fi.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(132, 'Tetris Effect', 'Enhance', 'PS4', 'Puzzle', 2018, 7, 'Une réinvention visuelle du classique Tetris.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(133, 'The Outer Worlds', 'Obsidian Entertainment', 'PS4', 'RPG', 2019, 15, 'Un RPG dans un univers spatial.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 0, 5, '2025-09-05'),
(134, 'Disco Elysium', 'ZA/UM', 'PC', 'RPG', 2019, 16, 'Un RPG narratif sur un détective.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(135, 'FIFA 21', 'EA Sports', 'PS4', 'Sport', 2020, 7, 'Un jeu de football populaire.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(136, 'Call of Duty: Modern Warfare', 'Activision', 'PS4', 'Action', 2019, 17, 'Un jeu de tir militaire.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 5, '2025-09-05'),
(137, 'Apex Legends', 'Respawn Entertainment', 'PC', 'Action', 2019, 13, 'Un battle royale compétitif.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(138, 'Rocket League', 'Psyonix', 'PC', 'Sport', 2015, 7, 'Un jeu de football avec des voitures.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(139, 'Cuphead', 'Studio MDHR', 'PC', 'Plateforme', 2017, 10, 'Un jeu de plateforme style années 30.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(140, 'Shadow of the Colossus', 'Team Ico', 'PS4', 'Aventure', 2018, 12, 'Un remake d\'une quête contre des géants.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(141, 'Metal Gear Solid V', 'Konami', 'PS4', 'Action', 2015, 17, 'Une infiltration dans un monde ouvert.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(142, 'Bayonetta 2', 'PlatinumGames', 'Nintendo Switch', 'Action', 2014, 16, 'Une sorcière combat des anges.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(143, 'Super Metroid', 'Nintendo', 'SNES', 'Plateforme', 1994, 10, 'Une aventure spatiale classique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(144, 'Chrono Trigger', 'Square', 'SNES', 'RPG', 1995, 10, 'Un RPG légendaire avec des voyages dans le temps.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(145, 'Street Fighter V', 'Capcom', 'PS4', 'Combat', 2016, 12, 'Un jeu de combat compétitif.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(146, 'The Sims 4', 'EA', 'PC', 'Simulation', 2014, 7, 'Une simulation de vie.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(147, 'Pokémon Sword', 'Game Freak', 'Nintendo Switch', 'RPG', 2019, 7, 'Une aventure Pokémon dans une nouvelle région.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(148, 'Luigi\'s Mansion 3', 'Nintendo', 'Nintendo Switch', 'Aventure', 2019, 7, 'Luigi chasse des fantômes dans un hôtel.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(149, 'Xenoblade Chronicles', 'Monolith Soft', 'Nintendo Switch', 'RPG', 2020, 12, 'Un RPG épique dans un monde fantastique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(150, 'Yakuza Like a Dragon', 'Sega', 'PS4', 'RPG', 2020, 17, 'Un RPG dans le monde du crime japonais.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 6, '2025-09-05'),
(151, 'Splinter Cell: Blacklist', 'Ubisoft', 'PC', 'Action', 2013, 15, 'Une mission d\'infiltration.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(152, 'Dead Space', 'EA', 'PC', 'Action', 2008, 17, 'Un survival horror dans l\'espace.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(153, 'Fallout 4', 'Bethesda', 'PC', 'RPG', 2015, 15, 'Un RPG post-apocalyptique.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(154, 'Diablo III', 'Blizzard', 'PC', 'RPG', 2012, 16, 'Un jeu d\'action RPG contre des démons.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(155, 'Star Wars Jedi: Fallen Order', 'Respawn Entertainment', 'PS4', 'Action', 2019, 13, 'Un Jedi en fuite dans l\'univers Star Wars.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(156, 'Borderlands 3', 'Gearbox Software', 'PS4', 'Action', 2019, 17, 'Un jeu de tir avec loot.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(157, 'Nier: Automata', 'PlatinumGames', 'PS4', 'Action', 2017, 16, 'Une aventure dans un monde futuriste.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(158, 'The Legend of Zelda: Ocarina of Time', 'Nintendo', 'Nintendo 64', 'Action', 1998, 10, 'Un classique d\'aventure dans Hyrule.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(159, 'Super Mario 64', 'Nintendo', 'Nintendo 64', 'Plateforme', 1996, 7, 'Un jeu de plateforme révolutionnaire.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 0, 0, '2025-09-05'),
(160, 'Final Fantasy XV', 'Square Enix', 'PS4', 'RPG', 2016, 13, 'Un RPG avec un voyage épique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(161, 'Overcooked 2', 'Team17', 'Nintendo Switch', 'Simulation', 2018, 7, 'Un jeu de cuisine chaotique.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 1, 5, '2025-09-05'),
(162, 'The Binding of Isaac', 'Nicalis', 'PC', 'Roguelike', 2011, 13, 'Un jeu roguelike sombre et aléatoire.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(163, 'Hollow Knight: Silksong', 'Team Cherry', 'PC', 'Action', 2023, 10, 'Une suite à Hollow Knight.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 0, 4, '2025-09-05'),
(164, 'Breath of the Wild 2', 'Nintendo', 'Nintendo Switch', 'Action', 2022, 10, 'Une suite à l\'aventure de Zelda.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05'),
(165, 'Portal', 'Valve', 'PC', 'Puzzle', 2007, 10, 'Un jeu de réflexion innovant.', 'https://m.media-amazon.com/images/I/81yZ5PQTGJL.jpg', 1, 5, '2025-09-05'),
(166, 'BioShock', '2K Games', 'PC', 'Action', 2007, 15, 'Une aventure dystopique sous-marine.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(167, 'Mass Effect 3', 'BioWare', 'PC', 'RPG', 2012, 15, 'La fin de la trilogie spatiale.', 'https://m.media-amazon.com/images/I/81MELD2dYVL.jpg', 0, 0, '2025-09-05'),
(168, 'Uncharted 2: Among Thieves', 'Naughty Dog', 'PS3', 'Aventure', 2009, 13, 'Une chasse au trésor épique.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 1, 5, '2025-09-05'),
(169, 'Shadow of the Tomb Raider', 'Eidos Montreal', 'PS4', 'Action', 2018, 15, 'Une aventure avec Lara Croft.', 'https://m.media-amazon.com/images/I/81zCm07pKJL.jpg', 1, 5, '2025-09-05'),
(170, 'The Last Guardian', 'Team Ico', 'PS4', 'Aventure', 2016, 12, 'Une histoire d\'amitié avec une créature.', 'https://m.media-amazon.com/images/I/81QPKuFEVJL.jpg', 0, 0, '2025-09-05');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

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