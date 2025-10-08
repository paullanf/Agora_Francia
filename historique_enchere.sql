-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 déc. 2024 à 10:56
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
-- Structure de la table `historique_enchere`
--

DROP TABLE IF EXISTS `historique_enchere`;
CREATE TABLE IF NOT EXISTS `historique_enchere` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) NOT NULL,
  `Marque` varchar(255) NOT NULL,
  `nouveau_prix` int NOT NULL,
  `ancien_prix` int NOT NULL,
  `acheteur_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `historique_enchere`
--

INSERT INTO `historique_enchere` (`ID`, `modele`, `Marque`, `nouveau_prix`, `ancien_prix`, `acheteur_ID`) VALUES
(1, 'Senna', 'McLaren', 3000021, 3000020, 1),
(2, 'Rosalie', 'Rosalie', 31000, 31000, NULL),
(3, 'Mustang', 'Ford', 100000, 100000, NULL),
(4, 'Caleche', 'aucun', 1000000, 1000000, NULL),
(5, 'Chiron', 'Bugatti', 1000000, 1000000, NULL),
(6, 'Aventador', 'Lamborghini', 400000, 400000, NULL),
(7, '250GTO', 'Ferrari', 5000000, 5000000, NULL),
(8, 'Speedtai', 'McLaren', 500000, 500000, NULL),
(9, 'valkyrie', 'Aston Martin', 1000000, 1000000, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
