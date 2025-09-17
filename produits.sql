-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:33006
-- Generation Time: May 16, 2025 at 10:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `image`, `quantite`) VALUES
(1, 'produit_de_corps', 100, 'image2pro.jpg', 20),
(2, 'produit_de_corps', 100, 'image2pro.jpg', 20),
(3, 'produit_de_corps', 100, 'image2pro.jpg', 20),
(4, 'produit_de_visage', 140, 'imagepro.jpeg', 23),
(5, 'produit_de_visage', 100, 'imagepro.jpeg', 23),
(6, 'produit_de_visage', 100, 'imagepro.jpeg', 23),
(7, 'produit_de_cheuveux', 200, 'image3pro.jpg', 30),
(8, 'produit_de_cheuveux', 30, 'image3pro.jpg', 30),
(9, 'produit_de_cheuveux', 100, 'image3pro.jpg', 30),
(10, 'gommage', 300, 'image1.jpg', 24),
(11, 'gommage', 300, 'image1.jpg', 24),
(12, 'gommage', 300, 'image1.jpg', 24);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
