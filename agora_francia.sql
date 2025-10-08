-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 déc. 2024 à 20:05
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

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
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_ID` int NOT NULL AUTO_INCREMENT,
  `admin_nom` varchar(255) NOT NULL,
  `admin_prenom` varchar(255) NOT NULL,
  `admin_sexe` varchar(255) NOT NULL,
  `admin_login` varchar(255) NOT NULL,
  `admin_motdepasse` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`admin_ID`, `admin_nom`, `admin_prenom`, `admin_sexe`, `admin_login`, `admin_motdepasse`) VALUES
(1, 'LANFRANCHI', 'Paul', 'M', 'paul.lanfranchi@edu.ece.fr', 'PetitCanard123');

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

DROP TABLE IF EXISTS `banque`;
CREATE TABLE IF NOT EXISTS `banque` (
  `id_carte` int NOT NULL AUTO_INCREMENT,
  `type_carte` varchar(255) NOT NULL,
  `numero_carte` varchar(255) NOT NULL,
  `mois_exp` int NOT NULL,
  `annee_exp` int NOT NULL,
  `cvc` int NOT NULL,
  `solde` int NOT NULL,
  PRIMARY KEY (`id_carte`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id_carte`, `type_carte`, `numero_carte`, `mois_exp`, `annee_exp`, `cvc`, `solde`) VALUES
(1, 'MasterCard', '1234567891011121', 9, 2025, 123, 9999000);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_ID` int NOT NULL AUTO_INCREMENT,
  `client_nom` varchar(255) NOT NULL,
  `client_prenom` varchar(255) NOT NULL,
  `client_sexe` varchar(255) NOT NULL,
  `client_datedenaissance` date NOT NULL,
  `client_login` varchar(255) NOT NULL,
  `client_motdepasse` varchar(255) NOT NULL,
  `client_telephone` varchar(255) NOT NULL,
  `client_profession` varchar(255) NOT NULL,
  `client_adresse1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `client_adresse2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `client_ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `client_codepostal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `client_pays` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`client_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_ID`, `client_nom`, `client_prenom`, `client_sexe`, `client_datedenaissance`, `client_login`, `client_motdepasse`, `client_telephone`, `client_profession`, `client_adresse1`, `client_adresse2`, `client_ville`, `client_codepostal`, `client_pays`) VALUES
(1, 'GOUNAND', 'Adrien', 'Autre', '2004-10-02', 'adrien.gounand@edu.ece.fr', '$2y$10$cabF5wsmZ/m9LMXFzqLLTulb3H45/D5edptDORARk8lJMeITBx.aS', '+33667474569', 'Etudiant', '10 Rue de la pistache', '', 'Paris', '75017', 'France');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`ID`, `modele`, `Marque`, `prix_de_depart`, `image`, `date_de_fin`) VALUES
(1, 'Senna', 'McLaren', 3000021, 'Images/voiture_enchere/senna.jpg', '2025-01-02 20:00:00'),
(2, 'Rosalie', 'Rosalie', 31001, 'Images/voiture_enchere/rosalie.jpg\r\n', '2025-01-02 20:00:00'),
(3, 'Mustang', 'Ford', 100000, 'Images/voiture_enchere/mustang.jpg\r\n', '2025-01-02 20:00:00'),
(4, 'Caleche', 'aucun', 1000000, 'Images/voiture_enchere/caleche.jpg\r\n', '2025-01-02 20:00:00'),
(5, 'Chiron', 'Bugatti', 1000000, 'Images/voiture_enchere/bugatti.jpg\r\n', '2025-01-02 20:00:00'),
(6, 'Aventador', 'Lamborghini', 250000, 'Images/voiture_enchere/aventador.jpg\r\n', '2025-01-02 20:00:00'),
(7, '250GTO', 'Ferrari', 5000000, 'Images\\voiture_enchere/250GTO.webp\r\n', '2025-01-02 20:00:00'),
(8, 'Speedtai', 'McLaren', 500000, 'Images/voiture_enchere/speedtai.jpg\r\n', '2025-01-02 20:00:00'),
(9, 'valkyrie', 'Aston Martin', 1000000, 'Images/voiture_enchere/valkyrie.jpg\r\n', '2025-01-02 20:00:00');

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
(2, 'Rosalie', 'Rosalie', 31001, 31000, 1),
(3, 'Mustang', 'Ford', 100000, 100000, NULL),
(4, 'Caleche', 'aucun', 1000000, 1000000, NULL),
(5, 'Chiron', 'Bugatti', 1000000, 1000000, NULL),
(6, 'Aventador', 'Lamborghini', 400000, 400000, NULL),
(7, '250GTO', 'Ferrari', 5000000, 5000000, NULL),
(8, 'Speedtai', 'McLaren', 500000, 500000, NULL),
(9, 'valkyrie', 'Aston Martin', 1000000, 1000000, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `id_acheteur` int DEFAULT NULL,
  `id_produit` int DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date_envoi` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` varchar(50) DEFAULT 'non lu',
  `id_vendeur` int DEFAULT NULL,
  `sens` varchar(255) NOT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_acheteur` (`id_acheteur`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_acheteur`, `id_produit`, `message`, `date_envoi`, `statut`, `id_vendeur`, `sens`) VALUES
(1, 1, 1, 'Une proposition de 9000€ vous a été faite pour votre Clio 4.', '2024-12-15 15:14:26', 'non lu', 2, 'A-V'),
(2, 1, 2, 'Ceci est une notification de test.', '2024-12-15 20:23:27', 'non lu', 2, 'V-A');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int NOT NULL AUTO_INCREMENT,
  `id_produit` int NOT NULL,
  `id_acheteur` varchar(255) NOT NULL,
  `prix_achat` int NOT NULL,
  `date_achat` date NOT NULL,
  `mode_achat` varchar(255) NOT NULL,
  `annonce` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `moyen_paiement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_panier`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_produit`, `id_acheteur`, `prix_achat`, `date_achat`, `mode_achat`, `annonce`, `status`, `moyen_paiement`) VALUES
(1, 1, '1', 9500, '2012-12-24', 'Par négociations', 'Clio 4', 'payé', 'MasterCard'),
(3, 2, '1', 73000, '2015-12-24', 'Par négociations', 'BMW', 'en attente', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `vendeur_ID` int NOT NULL AUTO_INCREMENT,
  `vendeur_nom` varchar(255) NOT NULL,
  `vendeur_prenom` varchar(255) NOT NULL,
  `vendeur_sexe` varchar(255) NOT NULL,
  `vendeur_datedenaissance` date NOT NULL,
  `vendeur_login` varchar(255) NOT NULL,
  `vendeur_motdepasse` varchar(255) NOT NULL,
  `vendeur_telephone` varchar(255) NOT NULL,
  `vendeur_profession` varchar(255) NOT NULL,
  `vendeur_adresse1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vendeur_adresse2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vendeur_ville` varchar(255) NOT NULL,
  `vendeur_codepostal` int NOT NULL,
  `vendeur_pays` varchar(255) NOT NULL,
  PRIMARY KEY (`vendeur_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vendeurs`
--

INSERT INTO `vendeurs` (`vendeur_ID`, `vendeur_nom`, `vendeur_prenom`, `vendeur_sexe`, `vendeur_datedenaissance`, `vendeur_login`, `vendeur_motdepasse`, `vendeur_telephone`, `vendeur_profession`, `vendeur_adresse1`, `vendeur_adresse2`, `vendeur_ville`, `vendeur_codepostal`, `vendeur_pays`) VALUES
(2, 'THEPAUT', 'Quentin', 'Homme', '2004-06-14', 'quentin.thepaut@edu.ece.fr', '$2y$10$iPSbwvyH/QG0/nmVOmYtbet2G2Yzc0rG3QbU9Y3sy4qRGxlI0xzh6', '0612345678', 'Commercial chez Peugeot', '10 Rue des petites voitures', '', 'Toulouse', 31330, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
CREATE TABLE IF NOT EXISTS `voiture` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `année` int NOT NULL,
  `moteur` varchar(255) NOT NULL,
  `Boite_de_vitesse` varchar(255) NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Kilometre` int NOT NULL,
  `Prix` int NOT NULL,
  `puissance_fiscale` varchar(255) NOT NULL,
  `puissance_moteur` varchar(255) NOT NULL,
  `consommation` varchar(255) NOT NULL,
  `Points_forts` varchar(255) NOT NULL,
  `equipements` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Localisation` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`ID`, `modele`, `marque`, `année`, `moteur`, `Boite_de_vitesse`, `Pays`, `Kilometre`, `Prix`, `puissance_fiscale`, `puissance_moteur`, `consommation`, `Points_forts`, `equipements`, `Type`, `Image`, `Localisation`) VALUES
(1, 'Clio 4', 'Renault', 2019, 'Diesel', 'Manuelle', 'France', 32304, 11908, '5CV', '90ch', '7L/100km', 'Peu polluant, Caméra de recul, GPS, Bluetooth, Climatisation', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/clio.jpg', ''),
(2, 'M2 f87', 'BMW', 2018, 'Essence', 'Automatique', 'Allemagne', 2809, 72000, '26CV', '370ch', '8,50L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Sportive', 'Images/Voitures/m2.jpg', ''),
(3, 'Fiat 500', 'Fiat', 2022, 'Essence', 'Automatique', 'France', 133678, 8070, '4CV', '69ch ', '6,5L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/500.jpg', ''),
(4, 'Huracan', 'lamborghini', 2020, 'Essence', 'Automatique', 'Italie', 10304, 273000, '72CV', '780ch', '14L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V10', 'Sportive', 'Images/Voitures/huracan.jpg', ''),
(5, 'F8 Tributo', 'Ferrari', 2022, 'Essence', 'Automatique', 'France', 1003, 504769, '72CV', '720ch', '13L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort, Luxe', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V8', 'Sportive', 'Images/Voitures/f8.jpg', ''),
(6, 'RS6', 'Audi', 2017, 'Essence', 'Automatique', 'France', 50067, 60004, '52CV', '600ch', '12L/100km ', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Break', 'Images/Voitures/rs6.jpg', ''),
(7, '2008', 'Peugeot', 2019, 'Hybride', 'Manuelle', 'France', 80405, 23000, '6CV', '120ch', '4,9L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'SUV', 'Images/Voitures/2008.jpg', ''),
(8, 'C3', 'Citroën', 2020, 'Essence', 'Manuelle', 'France', 202085, 4800, '5CV', '110ch', '5,5L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/c3.jpg', ''),
(9, 'Expert', 'Peugeot', 2018, 'Diesel', 'Manuelle', 'France', 278000, 7990, '7CV', '120ch', '9L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Place', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'SUV', 'Images/Voitures/expert/expert.jpg', ''),
(10, 'Corsa', 'Opel', 2009, 'Essence', 'Manuelle', 'France', 150000, 3990, '5CV', '80ch', '5L/100km', 'Bluetooth, Climatisation', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/corsa/corsa.jpg', ''),
(11, 'Ami', 'Citroën', 2021, 'Electrique', 'Manuelle', 'France', 18000, 6000, '1CV', '8ch', '7,1kWh/100km', 'Sans Permis, légère, climatisation, électrique, enceinte Bose', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse', 'Sans Permis', 'Images/Voitures/ami/ami.jpg', ''),
(12, 'Leaf', 'Nissan', 2021, 'Electrique', 'Automatique', 'France', 38929, 15000, '6CV', '150ch', '17.0kWh/100km', 'Electrique, GPS, Climatisation', '6 Haut parleurs\r\n,Appel d\'Urgence Localisé\r\n,Commandes du système audio au volant\r\n,Ecran tactile\r\n,Fonction MP3\r\n,GPS Cartographique\r\n,Interface Media\r\n,Kit mains-libres Bluetooth\r\n,Prise Jack\r\n,Prise USB\r\n,Prise iPod\r\n,Radio', 'Berline', 'Images/Voitures/leaf/leaf.jpg', ''),
(13, 'GT3_RS', 'Porsche', 2016, 'Essence', 'Automatique', 'France', 15500, 185999, '41CV', '500ch', '16,1L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort, Luxe', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V8', 'Sportive', 'Images/Voitures/gt3_rs/gt3_rs.jpg', ''),
(14, 'Micra', 'Nissan', 2016, 'Essence', 'Manuelle', 'France', 116000, 8700, '5CV', '98ch', '7L/100km', 'Programmée bio ethanol\r\nSérie Lolita Lempicka\r\n,Couleur blanc nacré\r\n, Toit vinyl et panoramique\r\n, Intérieur cuir noir et sièges cloutés\r\n, Jantes alu diamantés noir\r\n, Vidange : le 09/10/23\r\n, Pneus neufs', 'GPS\r\n, Auto radio CD + tel et musique Bluetooth\r\n, Ordinateur de bord\r\n, Volant multifonctions\r\n, Phare + essuie glaces automatique\r\n, Clim automatique\r\n, Accoudoir central\r\n, Régulateur et limiteur de vitesse\r\n, Glaces avants + rétro électrique\r\n, Rétro ', 'Berline', 'Images/Voitures/micra/micra.jpg', ''),
(15, 'Megane', 'Renault', 2016, 'Diesel', 'Automatique', 'France', 121000, 10000, '5CV', '110ch', '8L/100km', 'Renault megane4 eastate ,automatique, courroie distribution faite, très bon état intérieur et extérieur', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Break', 'Images/Voitures/megane/megane.jpg', ''),
(16, 'Setra', 'Mercedes', 1992, 'Essence', 'Manuelle', 'Allemagne', 670000, 55000, '12CV', '220ch', '20L/100km', 'Climatisation, stacieux', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Bus', 'Images/Voitures/bus/bus.jpg', ''),
(17, 'GTR', 'Nissan', 2009, 'Essence', 'Automatique', 'France', 147000, 59990, '49CV', '570ch', '12L/100km', 'Nissan GT-r R35 2009 boîte remplacer par une 2012 . Embrayage neuf tout les fluide neuf .', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Sportive', 'Images/Voitures/gtr/gtr.jpg', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
