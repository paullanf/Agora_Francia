-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 déc. 2024 à 10:34
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
(1, 'Clio 4', 'Renault', 2019, 'Diesel', 'Manuelle', 'France', 32304, 11908, '5CV', '90ch', '7L/100km', 'Peu polluant, Caméra de recul, GPS, Bluetooth, Climatisation', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/clio.jpg', 'Carte_voiture_1'),
(2, 'M2 f87', 'BMW', 2018, 'Essence', 'Automatique', 'Allemagne', 2809, 72000, '26CV', '370ch', '8,50L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Sportive', 'Images/Voitures/m2.jpg', 'Carte_voiture_2'),
(3, 'Fiat 500', 'Fiat', 2022, 'Essence', 'Automatique', 'France', 133678, 8070, '4CV', '69ch ', '6,5L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/500.jpg', 'Carte_voiture_3'),
(4, 'Huracan', 'lamborghini', 2020, 'Essence', 'Automatique', 'Italie', 10304, 273000, '72CV', '780ch', '14L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V10', 'Sportive', 'Images/Voitures/huracan.jpg', 'Carte_voiture_4'),
(5, 'F8 Tributo', 'Ferrari', 2022, 'Essence', 'Automatique', 'France', 1003, 504769, '72CV', '720ch', '13L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort, Luxe', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V8', 'Sportive', 'Images/Voitures/f8.jpg', 'Carte_voiture_5'),
(6, 'RS6', 'Audi', 2017, 'Essence', 'Automatique', 'France', 50067, 60004, '52CV', '600ch', '12L/100km ', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Break', 'Images/Voitures/rs6.jpg', 'Carte_voiture_6'),
(7, '2008', 'Peugeot', 2019, 'Hybride', 'Manuelle', 'France', 80405, 23000, '6CV', '120ch', '4,9L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'SUV', 'Images/Voitures/2008.jpg', 'Carte_voiture_7'),
(8, 'C3', 'Citroën', 2020, 'Essence', 'Manuelle', 'France', 202085, 4800, '5CV', '110ch', '5,5L/100km', 'Peut polluant, Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/c3.jpg', 'Carte_voiture_8'),
(9, 'Expert', 'Peugeot', 2018, 'Diesel', 'Manuelle', 'France', 278000, 7990, '7CV', '120ch', '9L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Place', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'SUV', 'Images/Voitures/expert/expert.jpg', 'Carte_voiture_9'),
(10, 'Corsa', 'Opel', 2009, 'Essence', 'Manuelle', 'France', 150000, 3990, '5CV', '80ch', '5L/100km', 'Bluetooth, Climatisation', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Citadine', 'Images/Voitures/corsa/corsa.jpg', 'Carte_voiture_10'),
(11, 'Ami', 'Citroën', 2021, 'Electrique', 'Manuelle', 'France', 18000, 6000, '1CV', '8ch', '7,1kWh/100km', 'Sans Permis, légère, climatisation, électrique, enceinte Bose', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse', 'Sans Permis', 'Images/Voitures/ami/ami.jpg', 'Carte_voiture_11'),
(12, 'Leaf', 'Nissan', 2021, 'Electrique', 'Automatique', 'France', 38929, 15000, '6CV', '150ch', '17.0kWh/100km', 'Electrique, GPS, Climatisation', '6 Haut parleurs\r\n,Appel d\'Urgence Localisé\r\n,Commandes du système audio au volant\r\n,Ecran tactile\r\n,Fonction MP3\r\n,GPS Cartographique\r\n,Interface Media\r\n,Kit mains-libres Bluetooth\r\n,Prise Jack\r\n,Prise USB\r\n,Prise iPod\r\n,Radio', 'Berline', 'Images/Voitures/leaf/leaf.jpg', 'Carte_voiture_12'),
(13, 'GT3_RS', 'Porsche', 2016, 'Essence', 'Automatique', 'France', 15500, 185999, '41CV', '500ch', '16,1L/100km', 'Caméra de recul, GPS, Bluetooth, Climatisation, Puissance, Confort, Luxe', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP, Moteur V8', 'Sportive', 'Images/Voitures/gt3_rs/gt3_rs.jpg', 'Carte_voiture_13'),
(14, 'Micra', 'Nissan', 2016, 'Essence', 'Manuelle', 'France', 116000, 8700, '5CV', '98ch', '7L/100km', 'Programmée bio ethanol\r\nSérie Lolita Lempicka\r\n,Couleur blanc nacré\r\n, Toit vinyl et panoramique\r\n, Intérieur cuir noir et sièges cloutés\r\n, Jantes alu diamantés noir\r\n, Vidange : le 09/10/23\r\n, Pneus neufs', 'GPS\r\n, Auto radio CD + tel et musique Bluetooth\r\n, Ordinateur de bord\r\n, Volant multifonctions\r\n, Phare + essuie glaces automatique\r\n, Clim automatique\r\n, Accoudoir central\r\n, Régulateur et limiteur de vitesse\r\n, Glaces avants + rétro électrique\r\n, Rétro ', 'Berline', 'Images/Voitures/micra/micra.jpg', 'Carte_voiture_14'),
(15, 'Megane', 'Renault', 2016, 'Diesel', 'Automatique', 'France', 121000, 10000, '5CV', '110ch', '8L/100km', 'Renault megane4 eastate ,automatique, courroie distribution faite, très bon état intérieur et extérieur', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Break', 'Images/Voitures/megane/megane.jpg', 'Carte_voiture_15'),
(16, 'Setra', 'Mercedes', 1992, 'Essence', 'Manuelle', 'Allemagne', 670000, 55000, '12CV', '220ch', '20L/100km', 'Climatisation, stacieux', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Bus', 'Images/Voitures/bus/bus.jpg', 'Carte_voiture_16'),
(17, 'GTR', 'Nissan', 2009, 'Essence', 'Automatique', 'France', 147000, 59990, '49CV', '570ch', '12L/100km', 'Nissan GT-r R35 2009 boîte remplacer par une 2012 . Embrayage neuf tout les fluide neuf .', 'Indicateur de sous-gonflage des pneus, Apple CarPlay / Android Auto, Limiteur de vitesse, Régulateur de vitesse, Assistance au freinage d\'urgence, ESP', 'Sportive', 'Images/Voitures/gtr/gtr.jpg', 'Carte_voiture_17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
