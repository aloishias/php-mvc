-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Lun 04 Décembre 2017 à 13:14
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `lbc`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `ID` char(2) NOT NULL,
  `LIBELLE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`ID`, `LIBELLE`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE `fichefrais` (
  `ID` int(11) NOT NULL,
  `NBJUSTIFICATIFS` varchar(30) DEFAULT NULL,
  `DATEFICHE` date NOT NULL,
  `MONTANT` double DEFAULT NULL,
  `ID_USER` varchar(25) NOT NULL,
  `ID_ETAT` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`ID`, `NBJUSTIFICATIFS`, `DATEFICHE`, `MONTANT`, `ID_USER`, `ID_ETAT`) VALUES
(1, NULL, '2017-11-01', 0.62, 'a131', 'CR'),
(6, NULL, '2017-12-04', 115, 'a131', 'CR');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE `fraisforfait` (
  `ID` char(3) NOT NULL,
  `LIBELLE` char(32) DEFAULT NULL,
  `MONTANT` double(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`ID`, `LIBELLE`, `MONTANT`) VALUES
('ETP', 'Forfait Etape', 110.00),
('KM', 'Frais Kilométrique', 0.62),
('NUI', 'Nuitée Hôtel', 80.00),
('REP', 'Repas Restaurant', 25.00);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE `lignefraisforfait` (
  `ID_FICHE` int(11) NOT NULL,
  `ID_FRAIS` varchar(11) NOT NULL,
  `QUANTITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`ID_FICHE`, `ID_FRAIS`, `QUANTITE`) VALUES
(1, 'KM', 1),
(6, 'ETP', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE `lignefraishorsforfait` (
  `ID` int(11) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL,
  `DATEFRAIS` date NOT NULL,
  `MONTANT` float NOT NULL,
  `ID_FICHE` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`ID`, `LIBELLE`, `DATEFRAIS`, `MONTANT`, `ID_FICHE`) VALUES
(28, 'Kebab', '2017-11-23', 3, 0),
(30, 'Kebab', '2017-12-30', 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` char(4) NOT NULL,
  `NOM` char(32) DEFAULT NULL,
  `PRENOM` char(32) DEFAULT NULL,
  `LOGIN` char(32) DEFAULT NULL,
  `MDP` char(20) DEFAULT NULL,
  `ADRESSE` char(32) DEFAULT NULL,
  `CP` char(5) DEFAULT NULL,
  `VILLE` char(32) DEFAULT NULL,
  `DATEEMBAUCHE` date DEFAULT NULL,
  `COMPTABLE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID`, `NOM`, `PRENOM`, `LOGIN`, `MDP`, `ADRESSE`, `CP`, `VILLE`, `DATEEMBAUCHE`, `COMPTABLE`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 0),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 0),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 0),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 0),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 0),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 0),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 0),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05', 0),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 0),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 0),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12', 0),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 0),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 0),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 0),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 0),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 0),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 0),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 0),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 0),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 0),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 0),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 0),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 0),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 0),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 0),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 0),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD PRIMARY KEY (`ID_FICHE`,`ID_FRAIS`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
