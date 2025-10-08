-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 déc. 2024 à 16:29
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agora_francia`
--

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) NOT NULL,
  `Marque` varchar(255) NOT NULL,
  `prix_de_depart` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_de_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`ID`, `modele`, `Marque`, `prix_de_depart`, `image`, `date_de_fin`) VALUES
(1, 'Senna', 'McLaren', 3000021, 'Images/voiture_enchere/senna.jpg', '2024-12-30 00:00:00'),
(2, 'Rosalie', 'Rosalie', 30000, 'Images/voiture_enchere/rosalie.jpg\r\n', '2025-01-02 20:00:00'),
(3, 'Mustang', 'Ford', 100000, 'Images/voiture_enchere/mustang.jpg\r\n', '2025-01-04 20:00:00'),
(4, 'Caleche', 'aucun', 1000000, 'Images/voiture_enchere/caleche.jpg\r\n', '2025-12-29 00:00:00'),
(5, 'Chiron', 'Bugatti', 1000000, 'Images/voiture_enchere/bugatti.jpg\r\n', '2025-01-02 20:00:00'),
(6, 'Aventador', 'Lamborghini', 250000, 'Images/voiture_enchere/aventador.jpg\r\n', '2025-02-02 22:00:00'),
(7, '250GTO', 'Ferrari', 5000000, 'Images\\voiture_enchere/250GTO.webp\r\n', '2025-12-24 00:00:00'),
(8, 'Speedtai', 'McLaren', 500000, 'Images/voiture_enchere/speedtai.jpg\r\n', '2025-03-04 20:00:00'),
(9, 'valkyrie', 'Aston Martin', 1000000, 'Images/voiture_enchere/valkyrie.jpg\r\n', '2025-01-02 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
