-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 nov. 2020 à 14:07
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `menu_recursif`
--
CREATE DATABASE IF NOT EXISTS `menu_recursif` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `menu_recursif`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
                                          `idarticles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `articles_title` varchar(150) NOT NULL,
                                          `articles_text` text NOT NULL,
                                          `articles_date` datetime DEFAULT CURRENT_TIMESTAMP,
                                          PRIMARY KEY (`idarticles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idarticles`, `articles_title`, `articles_text`, `articles_date`) VALUES
(1, 'Royal Sporting Club Anderlecht', 'Le Royal Sporting Club d\'Anderlecht, abrégé en RSC Anderlecht, est un club de football belge fondé en 1908 et basé à Anderlecht (situé au sud-ouest de Bruxelles), qui est une commune de la région de Bruxelles-Capitale.\r\n\r\nLe club omnisports du même nom est fondé le 27 mai 1999. Sa devise est « Mens sana in corpore sano » (en français : « un esprit sain dans un corps sain »). Le club omnisports a donné naissance à différentes associations, dont RSCA-Rugby, RSCA-Athlétisme et la section football, fondée deux jours après la création du club qui porte le matricule 35. Il existe également une section féminine depuis 1971.\r\n\r\nIl s\'agit du club de football belge le plus titré. Promu pour la première fois en première division du championnat de Belgique en 1921, un niveau qu\'il n\'a plus quitté depuis 1935, Anderlecht obtient son premier titre national en 1947. Depuis lors, Anderlecht a remporté le championnat à trente-quatre reprises et n\'a jamais terminé la saison en deçà de la sixième place. Sur la scène intérieure, le club a également enlevé neuf Coupes de Belgique. Le club a eu la chance de voir évoluer plusieurs de ses cadres en équipe nationale belge.', '2020-11-23 11:01:10'),
(2, 'Royal Antwerp Football Club', 'Le Royal Antwerp Football Club , familièrement appelé l\'Antwerp, est un club de football belge situé à Anvers. Fondé vers 1880, ce club est reconnu comme étant le plus ancien club de football belge, et porte à ce titre le matricule 1.\r\n\r\nLe Royal Antwerp FC est un des dix clubs fondateurs de la Fédération belge de football et un des sept fondateurs du championnat de Belgique. Il est présent sans interruption en séries nationales depuis la saison 1901-1902. Il a disputé 96 saisons en première division belge, ce qui a longtemps constitué un record, seulement dépassé par le Standard de Liège en 2015-2016.\r\n\r\nEntre 1957 et 1994, le Royal Antwerp FC a vécu 55 rencontres européennes et a disputé une finale de Coupe d\'Europe des Vainqueurs de Coupe (CE2).\r\n\r\nLe club évolue en Division 1A lors de la saison 2019-2020, ce qui constitue sa 116e saison dans les divisions nationales.', '2020-11-23 14:38:40'),
(3, 'K Beerschot Antwerpen Club', 'Le Koninklijke Beerschot Antwerpen Club est un ancien club de football belge basé à Anvers. Fondé sous le nom de FC Germinal Ekeren en 1920, il reprend le nom de Beerschot après son déménagement au Kiel en 1999 après la faillite du K Beerschot VAC. \r\n\r\nLe club troque également ses couleurs habituelles, jaune et rouge, pour reprendre le mauve et blanc du club disparu. Relégué en Division 2 et privé de licence pour le football rémunéré pour la saison 2013-2014, le club dépose le bilan en juin 2013 et est radié par l\'URBSFA le 1er juillet 2013. Son matricule était le 3530.', '2020-11-23 14:43:43');

-- --------------------------------------------------------

--
-- Structure de la table `articles_has_rubriques`
--

DROP TABLE IF EXISTS `articles_has_rubriques`;
CREATE TABLE IF NOT EXISTS `articles_has_rubriques` (
                                                        `articles_idarticles` int(10) UNSIGNED NOT NULL,
                                                        `rubriques_idrubriques` int(10) UNSIGNED NOT NULL,
                                                        PRIMARY KEY (`articles_idarticles`,`rubriques_idrubriques`),
                                                        KEY `fk_articles_has_rubriques_rubriques1_idx` (`rubriques_idrubriques`),
                                                        KEY `fk_articles_has_rubriques_articles1_idx` (`articles_idarticles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles_has_rubriques`
--

INSERT INTO `articles_has_rubriques` (`articles_idarticles`, `rubriques_idrubriques`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 4),
(3, 4),
(1, 6),
(1, 7),
(2, 11),
(3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

DROP TABLE IF EXISTS `rubriques`;
CREATE TABLE IF NOT EXISTS `rubriques` (
                                           `idrubriques` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                           `rubriques_name` varchar(120) NOT NULL,
                                           `rubriques_text` varchar(500) DEFAULT NULL,
                                           `rubriques_order` smallint(5) UNSIGNED DEFAULT '0',
                                           `rubriques_idrubriques` int(10) UNSIGNED DEFAULT '0',
                                           PRIMARY KEY (`idrubriques`),
                                           KEY `fk_rubriques_rubriques_idx` (`rubriques_idrubriques`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rubriques`
--

INSERT INTO `rubriques` (`idrubriques`, `rubriques_name`, `rubriques_text`, `rubriques_order`, `rubriques_idrubriques`) VALUES
(1, 'Belgique', 'La Belgique est un pays de l\'Europe de l\'Ouest réputé pour ses villes médiévales, son architecture Renaissance et pour accueillir le siège de l\'Union européenne et de l\'OTAN. Le pays comprend des régions distinctes, notamment la Flandre néerlandophone au nord, la Wallonie francophone au sud et une communauté germanophone à l\'est. Bruxelles, la capitale bilingue, offre des maisons des corporations richement ornées sur la Grand-Place et d\'élégants bâtiments art nouveau.', 0, 0),
(2, 'France', 'La France, pays de l\'Europe occidentale, compte des villes médiévales, des villages alpins et des plages. Paris, sa capitale, est célèbre pour ses maisons de mode, ses musées d\'art classique, dont celui du Louvre, et ses monuments comme la Tour Eiffel. Le pays est également réputé pour ses vins et sa cuisine raffinée. Les peintures rupestres des grottes de Lascaux, le théâtre romain de Lyon et l\'immense château de Versailles témoignent de sa riche histoire.', 1, 0),
(3, 'Luxembourg', 'Le Luxembourg est un petit pays européen bordé par la Belgique, la France et l\'Allemagne. Il est essentiellement rural, avec la forêt dense des Ardennes et des parcs naturels au nord, les gorges rocheuses de la région Mullerthal à l\'est et la vallée de la Moselle au sud-est. Luxembourg, la capitale, est réputée pour sa vieille ville médiévale fortifiée perchée sur des falaises abruptes.', 2, 0),
(4, 'Région flamande', 'Le territoire de la Région flamande correspond au territoire de la région de langue néerlandaise. La superficie de la Région flamande est de 13 522 km2 ce qui représente 44,31 % du territoire belge.', 2, 1),
(5, 'Région wallonne', 'La Région wallonne, communément appelée Wallonie, est l\'une des trois régions de la Belgique. Elle est constituée, comme le dispose l\'article 5 de la Constitution belge, des provinces du Brabant wallon, de Hainaut, de Liège, de Luxembourg et de Namur.', 1, 1),
(6, 'Région de Bruxelles-Capitale', 'La Région de Bruxelles-Capitale ne doit pas être confondue avec la Ville de Bruxelles, qui n\'est qu\'une des 19 communes de la région de Bruxelles-Capitale, ni avec la région bilingue de Bruxelles-Capitale (article 4 de la Constitution belge).', 0, 1),
(7, 'Anderlecht', NULL, 0, 6),
(8, 'Auderghem', NULL, 1, 6),
(9, 'Berchem-Sainte-Agathe', NULL, 2, 6),
(10, 'Ville de Bruxelles', NULL, 3, 6),
(11, 'Anvers', NULL, 0, 4),
(12, 'Limbourg', NULL, 1, 4),
(13, 'Flandre-Orientale', NULL, 2, 4),
(14, 'Brabant flamand', NULL, 3, 4),
(15, 'Flandre-Occidentale', NULL, 4, 4),
(16, 'Brabant wallon', NULL, 0, 5),
(17, 'Hainaut', NULL, 1, 5),
(18, 'Liège', NULL, 2, 5),
(19, 'Luxembourg', NULL, 3, 5),
(20, 'Namur', NULL, 4, 5),
(21, 'Paris', NULL, 0, 2),
(22, 'Province', NULL, 1, 2),
(23, 'Cureghem', NULL, 0, 7),
(24, '1er Arrondissement', '1er Arrondissement : Louvre', 0, 21),
(25, '2ème Arrondissement', '2ème Arrondissement : Bourse', 1, 21);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_has_rubriques`
--
ALTER TABLE `articles_has_rubriques`
    ADD CONSTRAINT `fk_articles_has_rubriques_articles1` FOREIGN KEY (`articles_idarticles`) REFERENCES `articles` (`idarticles`) ON DELETE CASCADE ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_articles_has_rubriques_rubriques1` FOREIGN KEY (`rubriques_idrubriques`) REFERENCES `rubriques` (`idrubriques`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rubriques`
--
ALTER TABLE `rubriques`
    ADD CONSTRAINT `fk_rubriques_rubriques` FOREIGN KEY (`rubriques_idrubriques`) REFERENCES `rubriques` (`idrubriques`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
