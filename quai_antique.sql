-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 28, 2023 at 02:04 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quai_antique`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergy`
--

CREATE TABLE `allergy` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allergy`
--

INSERT INTO `allergy` (`id`, `title`) VALUES
(2, 'Arachide'),
(3, 'Mollusques ou crustacés'),
(4, 'Lait ou oeuf'),
(5, 'Moutarde'),
(6, 'Soja');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `openingday_id` int(11) NOT NULL,
  `openinghour_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `booked_at` date NOT NULL,
  `start_at` time NOT NULL,
  `remainingseats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `restaurant_id`, `user_id`, `openingday_id`, `openinghour_id`, `guest_id`, `created_at`, `booked_at`, `start_at`, `remainingseats`) VALUES
(9, 6, 5, 9, 21, 3, '2023-04-05 13:01:36', '2023-04-11', '12:45:00', 57),
(11, 6, 5, 8, 24, 5, '2023-04-05 13:36:25', '2023-04-17', '19:30:00', 55),
(14, 6, 5, 8, 24, 1, '2023-04-05 15:19:54', '2023-04-17', '19:45:00', 54),
(16, 6, 5, 8, 21, 3, '2023-04-05 15:48:05', '2023-04-17', '12:30:00', 57),
(17, 6, 5, 8, 24, 1, '2023-04-05 16:01:17', '2023-04-17', '19:30:00', 53),
(18, 6, 5, 9, 21, 5, '2023-04-05 16:02:48', '2023-04-11', '12:15:00', 52),
(19, 6, 7, 11, 24, 4, '2023-04-14 12:49:40', '2023-04-20', '20:00:00', 56),
(20, 6, 7, 11, 24, 2, '2023-04-14 12:51:43', '2023-04-20', '19:30:00', 54),
(21, 6, 5, 11, 21, 5, '2023-04-14 12:55:46', '2023-04-27', '12:30:00', 55),
(22, 6, 5, 9, 21, 1, '2023-04-14 13:09:43', '2023-04-18', '13:00:00', 59),
(23, 6, 5, 9, 24, 1, '2023-04-14 13:14:01', '2023-04-18', '21:00:00', 59),
(24, 6, 5, 9, 21, 2, '2023-04-14 14:08:55', '2023-04-25', '12:45:00', 58),
(25, 6, 6, 11, 21, 3, '2023-04-25 13:17:04', '2023-04-27', '13:00:00', 52),
(26, 6, 5, 11, 24, 2, '2023-04-27 12:59:22', '2023-05-18', '20:00:00', 58);

-- --------------------------------------------------------

--
-- Table structure for table `booking_allergy`
--

CREATE TABLE `booking_allergy` (
  `booking_id` int(11) NOT NULL,
  `allergy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_allergy`
--

INSERT INTO `booking_allergy` (`booking_id`, `allergy_id`) VALUES
(9, 2),
(19, 2),
(20, 4),
(20, 5),
(21, 2),
(22, 3),
(23, 6),
(24, 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`) VALUES
(26, 'entrées', 'starters.png'),
(27, 'plats', 'dishes.png'),
(28, 'desserts', 'desserts.png'),
(29, 'burgers', 'burgers.png'),
(30, 'salades', 'salads.png');

-- --------------------------------------------------------

--
-- Table structure for table `daytime`
--

CREATE TABLE `daytime` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daytime`
--

INSERT INTO `daytime` (`id`, `title`) VALUES
(1, 'Midi'),
(2, 'Soir');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `favorite` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `restaurant_id`, `category_id`, `title`, `price`, `description`, `image`, `created_at`, `favorite`, `active`) VALUES
(98, 6, 27, 'Filet de perche', '19.00', '(Filet de perche, petits-pois)', 'perche-63fb70a9d80a9-.png', '2023-02-26 15:45:04', 1, 1),
(99, 6, 28, 'Gâteau de Savoie', '9.00', '(Framboises, gâteau de Savoie)', 'gateau-savoie-63fb70e9b8162-.png', '2023-02-24 14:52:04', 1, 1),
(101, 6, 27, 'Fondue pétillante de Savoie', '15.00', '(Beaufort, Emmental de Savoie, Abondance)', 'fondue-63fb8b757124e-.png', '2023-02-26 15:52:04', 1, 1),
(106, 6, 28, 'Tarte aux myrtilles', '11.00', '(Framboises, gâteau de Savoie)', 'myrtilles-63fb71ae91e9b-.png', '2023-02-26 14:00:04', 1, 1),
(110, 6, 27, 'Croziflette', '15.00', '(Crozets, jambon de Savoie,  reblochon)', 'croziflette-63fb7e6f815fb-.png', '2023-02-26 14:52:04', 1, 1),
(116, 6, 26, 'Ecrevisses  d’Annecy', '9.00', '(Ecrevisses, ravioles, tomate cerise)', 'ecrevisse-63fb737ccda8e-.png', '2023-02-26 12:04:56', 1, 1),
(119, 6, 26, 'Carpaccio de pamplemousses', '7.00', '(Pamplemousses,  fenouil, jeunes pousses)', 'carpaccio-63fb743bc7a31-.png', '2023-02-26 16:00:26', 0, 1),
(120, 6, 26, 'Croûte savoyarde', '8.00', '(Jambon de Savoie, artichaut, tapenade, toasts)', 'jambon-63fb746d18113-.png', '2023-02-26 15:01:30', 0, 1),
(121, 6, 26, 'Sushis de Savoie', '10.00', '(Ombre chevalier, riz, oeufs de lompe)', 'sushi-63fb74985583d-.png', '2023-02-26 15:01:30', 0, 1),
(122, 6, 27, 'Diot au vin blanc', '17.00', '(Saucisse  de Savoie fumée, vin blanc sec)', 'diot-63fb7f3a00749-.png', '2023-02-26 15:46:35', 0, 1),
(123, 6, 28, 'Truffes aux trois chocolats', '10.00', '(Chocolats blanc, au lait et noir)', 'truffes-63fb80290a577-.png', '2023-02-26 15:51:18', 0, 1),
(124, 6, 28, 'Flan au caramel', '12.00', '(Crème caramel, copeaux de chocolat)', 'flan-63fb80728b3b3-.png', '2023-02-26 15:52:16', 0, 1),
(125, 6, 29, 'L’original', '15.00', '(Steak, cheddar, salade, tomate,  sauce barbecue)', 'original-63fb80ffedfa5-.png', '2023-02-26 15:55:04', 0, 1),
(126, 6, 29, 'Le végétarien', '16.00', '(Courgettes, oignons, houmous, tomate)', 'vegetarien-63fb8122cbacb-.png', '2023-02-26 15:55:50', 0, 1),
(127, 6, 29, 'Le rustique', '17.00', '(Boeuf, composée d’oignons, morbier, salade)', 'rustique-63fb81451711f-.png', '2023-02-26 15:56:31', 0, 1),
(128, 6, 29, 'Cheeseburger savoyard', '18.00', '(Steak, cheddar, jambon de Savoie, raclette, salade)', 'cheeseburger-63fb817ba8d23-.png', '2023-02-26 15:57:03', 0, 1),
(129, 6, 30, 'Salade  César au Beaufort', '16.00', '(Salade, poulet,  croutons, Beaufort)', 'cesar-63fb81d775e05-.png', '2023-02-26 15:58:58', 0, 1),
(130, 6, 30, 'Poké salade', '16.00', '(Salade, chou kale, quinoa, pois-chiche, haricots)', 'poke-salade-63fb82273f8d2-.png', '2023-02-26 15:59:24', 0, 1),
(131, 6, 30, 'Salade impériale', '17.00', '(Endives, tome de Savoie, noix, magret de canard)', 'imperiale-63fb8258c597b-.png', '2023-02-26 16:01:03', 0, 1),
(132, 6, 30, 'Salade savoyarde', '18.00', '(Laitue, jambon de Savoie, pomme de terre)', 'salade-savoyarde-63fb827cb7cc7-.png', '2023-02-26 16:01:33', 0, 1),
(133, 6, 26, 'test de carpaccio', '11.00', 'test test test', 'carpaccio-644a92724432b-.png', '2023-03-21 15:49:45', 0, 0),
(134, 6, 27, 'test 2234', '11.00', 'test tets', 'cesar-6419d59924494-.png', '2023-03-21 16:02:39', 1, 0),
(138, 6, 28, 'test35', '2.00', 'test modif', 'sushi-644a70cec5fc6-.png', '2023-04-27 11:23:31', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230214130408', '2023-02-14 13:06:03', 1510),
('DoctrineMigrations\\Version20230324093253', '2023-03-24 09:35:08', 124),
('DoctrineMigrations\\Version20230329083134', '2023-03-29 08:33:27', 147),
('DoctrineMigrations\\Version20230405083527', '2023-04-05 08:36:05', 171),
('DoctrineMigrations\\Version20230427090803', '2023-04-27 09:08:25', 101);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `quantity`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `active`) VALUES
(1, 'Menu du jour', 1),
(2, 'Menu dégustation', 1),
(3, 'Menu burger', 1),
(4, 'Menu salade', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_daytime`
--

CREATE TABLE `menu_daytime` (
  `menu_id` int(11) NOT NULL,
  `daytime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_daytime`
--

INSERT INTO `menu_daytime` (`menu_id`, `daytime_id`) VALUES
(1, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `openingday`
--

CREATE TABLE `openingday` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `openingday`
--

INSERT INTO `openingday` (`id`, `restaurant_id`, `day`, `open`) VALUES
(8, 6, 'lundi', 1),
(9, 6, 'mardi', 1),
(10, 6, 'mercredi', 0),
(11, 6, 'jeudi', 1),
(12, 6, 'vendredi', 1),
(13, 6, 'samedi', 1),
(14, 6, 'dimanche', 1);

-- --------------------------------------------------------

--
-- Table structure for table `openinghour`
--

CREATE TABLE `openinghour` (
  `id` int(11) NOT NULL,
  `starthour` time NOT NULL,
  `endhour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `openinghour`
--

INSERT INTO `openinghour` (`id`, `starthour`, `endhour`) VALUES
(21, '12:00:00', '14:00:00'),
(22, '12:00:00', '15:00:00'),
(24, '19:00:00', '22:00:00'),
(26, '19:00:00', '23:00:00'),
(28, '20:00:00', '23:00:00'),
(29, '11:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `openinghour_openingday`
--

CREATE TABLE `openinghour_openingday` (
  `openinghour_id` int(11) NOT NULL,
  `openingday_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `openinghour_openingday`
--

INSERT INTO `openinghour_openingday` (`openinghour_id`, `openingday_id`) VALUES
(21, 8),
(21, 9),
(21, 11),
(21, 12),
(21, 14),
(24, 8),
(24, 9),
(24, 11),
(24, 12),
(26, 13);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbseatings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`, `zipcode`, `city`, `phone`, `email`, `nbseatings`) VALUES
(6, 'Le Quai Antique', '5 Quai du Jeu de Paume', '73 000', 'Chambéry', '+33(0)4 79 60 26 26', 'infosquaiantique@gmail.com', 60);

-- --------------------------------------------------------

--
-- Table structure for table `setmenu`
--

CREATE TABLE `setmenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `shortdesc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setmenu`
--

INSERT INTO `setmenu` (`id`, `menu_id`, `title`, `price`, `shortdesc`, `description`, `active`) VALUES
(1, 1, 'Formule du jour légère', '20.00', 'Le midi du lundi au vendredi', 'Entrée + Plat ou Plat + Dessert', 1),
(2, 1, 'Formule du jour complète', '26.00', 'Le midi du lundi au samedi', 'Entrée + Plat + Dessert', 1),
(3, 2, 'Formule dégustation légère', '27.00', 'Le soir du lundi au vendredi', 'Entrée + Plat ou Plat + Dessert', 1),
(4, 2, 'Formule dégustation complète', '35.00', 'Le soir du lundi au samedi', 'Entrée + Plat + Dessert', 1),
(5, 3, 'Formule burger légère', '18.00', 'Le soir et midi du lundi au vendredi', 'Entrée + Plat ou Plat + Dessert', 1),
(6, 3, 'Formule burger complète', '24.00', 'Le soir et midi du lundi au samedi', 'Entrée + Plat + Dessert', 1),
(7, 4, 'Formule salade légère', '19.00', 'Le soir et midi du lundi au vendredi', 'Entrée + Plat ou Plat + Dessert', 1),
(8, 4, 'Formule salade complète', '25.00', 'Le soir et midi du lundi au samedi', 'Entrée + Plat + Dessert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setmenu_dish`
--

CREATE TABLE `setmenu_dish` (
  `setmenu_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setmenu_dish`
--

INSERT INTO `setmenu_dish` (`setmenu_id`, `dish_id`) VALUES
(1, 99),
(1, 101),
(1, 110),
(1, 119),
(1, 120),
(1, 123),
(2, 99),
(2, 101),
(2, 110),
(2, 119),
(2, 120),
(2, 123),
(3, 98),
(3, 106),
(3, 116),
(3, 121),
(3, 122),
(3, 124),
(4, 98),
(4, 106),
(4, 116),
(4, 121),
(4, 122),
(4, 124),
(5, 99),
(5, 106),
(5, 119),
(5, 120),
(5, 125),
(5, 126),
(6, 99),
(6, 106),
(6, 119),
(6, 120),
(6, 125),
(6, 126),
(7, 106),
(7, 116),
(7, 121),
(7, 124),
(7, 130),
(7, 131),
(8, 106),
(8, 116),
(8, 121),
(8, 124),
(8, 130),
(8, 131);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `guest_id`, `email`, `roles`, `password`, `lastname`, `firstname`) VALUES
(5, NULL, 'jlefebvre@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$7fckCG3uLftzh8gRfllI5eGUl0nTDstRwgubTHF75bZDvIiNf0MLe', 'Lefebvre', 'Julien'),
(6, NULL, 'julie@gmail.com', '[]', '$2y$13$ZIW4PtHDmxRBXLHvba.8Ve0Uce43FkmHsc193TgMTHqcaNHx7RVpi', 'Després', 'Julie'),
(7, NULL, 'romain@gmail.com', '[]', '$2y$13$u0ua9uO.qOUUjaN.hW3DtOLoZve1tYyGau5nog6HPd2Dhb/n59VCe', 'Jacquet', 'Romain'),
(8, 2, 'emma@gmail.com', '[]', '$2y$13$BGKA1On2hxGNp.UyI.aF5.VbW5TaRsqMfABD25JMinhN5Dx9GVI62', 'Carpentier', 'Emma'),
(9, 2, 'claire@gmail.com', '[]', '$2y$13$P5eaFSwzxqYXPVc2I4WP9O7x.KDcZa9Uk/LCy0OKBswiIJbsVbHD2', 'Leroi', 'Claire'),
(10, 4, 'damien@gmail.com', '[]', '$2y$13$eQ3L51KODrjHJp3oGqnTXuJW2N.PeIlXOK3FptZqzOhUzk6/MdClW', 'Chevalier', 'Damien');

-- --------------------------------------------------------

--
-- Table structure for table `user_allergy`
--

CREATE TABLE `user_allergy` (
  `user_id` int(11) NOT NULL,
  `allergy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_allergy`
--

INSERT INTO `user_allergy` (`user_id`, `allergy_id`) VALUES
(8, 2),
(9, 5),
(10, 2),
(10, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergy`
--
ALTER TABLE `allergy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E00CEDDEB1E7706E` (`restaurant_id`),
  ADD KEY `IDX_E00CEDDEA76ED395` (`user_id`),
  ADD KEY `IDX_E00CEDDE2FA0D13C` (`openingday_id`),
  ADD KEY `IDX_E00CEDDE48D7E013` (`openinghour_id`),
  ADD KEY `IDX_E00CEDDE9A4AA658` (`guest_id`);

--
-- Indexes for table `booking_allergy`
--
ALTER TABLE `booking_allergy`
  ADD PRIMARY KEY (`booking_id`,`allergy_id`),
  ADD KEY `IDX_910F07953301C60` (`booking_id`),
  ADD KEY `IDX_910F0795DBFD579D` (`allergy_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daytime`
--
ALTER TABLE `daytime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957D8CB82B36786B` (`title`),
  ADD KEY `IDX_957D8CB8B1E7706E` (`restaurant_id`),
  ADD KEY `IDX_957D8CB812469DE2` (`category_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_daytime`
--
ALTER TABLE `menu_daytime`
  ADD PRIMARY KEY (`menu_id`,`daytime_id`),
  ADD KEY `IDX_13F4B32ECCD7E912` (`menu_id`),
  ADD KEY `IDX_13F4B32E7D165` (`daytime_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `openingday`
--
ALTER TABLE `openingday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C5AEC5BFB1E7706E` (`restaurant_id`);

--
-- Indexes for table `openinghour`
--
ALTER TABLE `openinghour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `openinghour_openingday`
--
ALTER TABLE `openinghour_openingday`
  ADD PRIMARY KEY (`openinghour_id`,`openingday_id`),
  ADD KEY `IDX_F957227248D7E013` (`openinghour_id`),
  ADD KEY `IDX_F95722722FA0D13C` (`openingday_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setmenu`
--
ALTER TABLE `setmenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_48C628A1CCD7E912` (`menu_id`);

--
-- Indexes for table `setmenu_dish`
--
ALTER TABLE `setmenu_dish`
  ADD PRIMARY KEY (`setmenu_id`,`dish_id`),
  ADD KEY `IDX_4D1BE2AB91A13B00` (`setmenu_id`),
  ADD KEY `IDX_4D1BE2AB148EB0CB` (`dish_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6499A4AA658` (`guest_id`);

--
-- Indexes for table `user_allergy`
--
ALTER TABLE `user_allergy`
  ADD PRIMARY KEY (`user_id`,`allergy_id`),
  ADD KEY `IDX_93BC5CBFA76ED395` (`user_id`),
  ADD KEY `IDX_93BC5CBFDBFD579D` (`allergy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergy`
--
ALTER TABLE `allergy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `daytime`
--
ALTER TABLE `daytime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `openingday`
--
ALTER TABLE `openingday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `openinghour`
--
ALTER TABLE `openinghour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setmenu`
--
ALTER TABLE `setmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_E00CEDDE2FA0D13C` FOREIGN KEY (`openingday_id`) REFERENCES `openingday` (`id`),
  ADD CONSTRAINT `FK_E00CEDDE48D7E013` FOREIGN KEY (`openinghour_id`) REFERENCES `openinghour` (`id`),
  ADD CONSTRAINT `FK_E00CEDDE9A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `FK_E00CEDDEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E00CEDDEB1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Constraints for table `booking_allergy`
--
ALTER TABLE `booking_allergy`
  ADD CONSTRAINT `FK_910F07953301C60` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_910F0795DBFD579D` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `FK_957D8CB812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_957D8CB8B1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Constraints for table `menu_daytime`
--
ALTER TABLE `menu_daytime`
  ADD CONSTRAINT `FK_13F4B32E7D165` FOREIGN KEY (`daytime_id`) REFERENCES `daytime` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_13F4B32ECCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `openingday`
--
ALTER TABLE `openingday`
  ADD CONSTRAINT `FK_C5AEC5BFB1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Constraints for table `openinghour_openingday`
--
ALTER TABLE `openinghour_openingday`
  ADD CONSTRAINT `FK_F95722722FA0D13C` FOREIGN KEY (`openingday_id`) REFERENCES `openingday` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F957227248D7E013` FOREIGN KEY (`openinghour_id`) REFERENCES `openinghour` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setmenu`
--
ALTER TABLE `setmenu`
  ADD CONSTRAINT `FK_48C628A1CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `setmenu_dish`
--
ALTER TABLE `setmenu_dish`
  ADD CONSTRAINT `FK_4D1BE2AB148EB0CB` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4D1BE2AB91A13B00` FOREIGN KEY (`setmenu_id`) REFERENCES `setmenu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6499A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`);

--
-- Constraints for table `user_allergy`
--
ALTER TABLE `user_allergy`
  ADD CONSTRAINT `FK_93BC5CBFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_93BC5CBFDBFD579D` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
