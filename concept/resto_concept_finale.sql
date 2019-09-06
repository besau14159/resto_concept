--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `idAdrs` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `noCvq` varchar(10) DEFAULT NULL,
  `Rue` varchar(50) NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `province` varchar(2) DEFAULT NULL,
  `codePostal` char(7) DEFAULT NULL,
  `telephone` char(15) DEFAULT NULL
);

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(100) NOT NULL
);


--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `datecommande` datetime NOT NULL,
  `idetat` int(11) NOT NULL,
  `idModePaiement` int(11) NOT NULL,
  `noClient` int(11) NOT NULL,
  `noAdrs` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `commentaires` varchar(250) NOT NULL
);

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `noCompte` int(11) NOT NULL,
  `notpCmpt` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `noAdrs` int(11) NOT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `Courriel` varchar(100) DEFAULT NULL,
  `nomUtilisateur` varchar(20) NOT NULL,
  `motPasse` varchar(40) NOT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1',
  `commentaires` varchar(250) NOT NULL
);

--
-- Structure de la table `etatcommandes`
--

CREATE TABLE `etatcommandes` (
  `idEtat` int(11) NOT NULL,
  `Etat` varchar(35) CHARACTER SET utf8 NOT NULL
);

--
-- Structure de la table `items_commande`
--

CREATE TABLE `items_commande` (
  `noCommande` int(11) NOT NULL,
  `noProduit` int(11) NOT NULL,
  `qte` int(11) NOT NULL
);

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `idMenu` int(11) NOT NULL,
  `titreMenu` varchar(100) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `commentaires` varchar(200) NOT NULL,
  `idResto` int(11) NOT NULL
);

--
-- Structure de la table `menu_produits`
--

CREATE TABLE `menu_produits` (
  `idItem` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL
);

--
-- Structure de la table `modespaiement`
--

CREATE TABLE `modespaiement` (
  `idMode` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
);

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `idProduit` int(11) NOT NULL,
  `nomProd` varchar(100) NOT NULL,
  `descProd` varchar(500) NOT NULL,
  `prixProd` decimal(10,0) NOT NULL,
  `imgProd` varchar(1000) NOT NULL,
  `idCategorie` int(11) NOT NULL
);

--
-- Structure de la table `restaurants`
--

CREATE TABLE `restaurants` (
  `idResto` int(11) NOT NULL,
  `nomResto` varchar(150) NOT NULL,
  `idAdrs` int(11) NOT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1'
);

--
-- Structure de la table `typecomptes`
--

CREATE TABLE `typecomptes` (
  `idtype` int(11) NOT NULL,
  `nomType` varchar(35) CHARACTER SET utf8 NOT NULL
);
--
-- Index pour les tables déchargées
--


--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `commandes_ibfk_2` (`noClient`),
  ADD KEY `commandes_ibfk_4` (`idetat`),
  ADD KEY `commandes_ibfk_1` (`idModePaiement`),
  ADD KEY `commandes_ibfk_3` (`noAdrs`),
  ADD KEY `commandes_ibfk_5` (`idMenu`);

ALTER TABLE `commandes` CHANGE `idCommande` `idCommande` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `commandes` CHANGE `datecommande` `datecommande` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `commandes` CHANGE `commentaires` `commentaires` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`noCompte`),
  ADD KEY `notpCmpt` (`notpCmpt`),
  ADD KEY `adrs_ibfk_2` (`noAdrs`);

ALTER TABLE `comptes` CHANGE `noCompte` `noCompte` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `etatcommandes`
--
ALTER TABLE `etatcommandes`
  ADD PRIMARY KEY (`idEtat`);

ALTER TABLE `etatcommandes` CHANGE `idEtat` `idEtat` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `items_commande`
--
ALTER TABLE `items_commande`
  ADD KEY `itemcommandes_ibfk_1` (`noCommande`),
  ADD KEY `itemcommandes_ibfk_2` (`noProduit`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`idMenu`),
  ADD KEY `Menus_ibfk_1` (`idResto`);

ALTER TABLE `menus` CHANGE `idMenu` `idMenu` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `menu_produits`
--
ALTER TABLE `menu_produits`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `menuprod_ibfk_1` (`idMenu`),
  ADD KEY `menuprod_ibfk_2` (`idProduit`);

ALTER TABLE `menu_produits` CHANGE `idItem` `idItem` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `modespaiement`
--
ALTER TABLE `modespaiement`
  ADD PRIMARY KEY (`idMode`);

ALTER TABLE `modespaiement` CHANGE `idMode` `idMode` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `prod_ibfk_1` (`idCategorie`);

ALTER TABLE `produits` CHANGE `idProduit` `idProduit` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`idResto`),
  ADD KEY `restaurants_ibfk_1` (`idAdrs`);

ALTER TABLE `restaurants` CHANGE `idResto` `idResto` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `typecomptes`
--
ALTER TABLE `typecomptes`
  ADD PRIMARY KEY (`idtype`);

ALTER TABLE `typecomptes` CHANGE `idtype` `idtype` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT commandes_ibfk_1 FOREIGN KEY (idModePaiement) REFERENCES modespaiement(idMode),
  ADD CONSTRAINT commandes_ibfk_2 FOREIGN KEY (noClient) REFERENCES comptes(noCompte),
  ADD CONSTRAINT commandes_ibfk_3 FOREIGN KEY (noAdrs) REFERENCES adresses(idAdrs),
  ADD CONSTRAINT commandes_ibfk_4 FOREIGN KEY (idetat) REFERENCES etatcommandes(idEtat),
  ADD CONSTRAINT commandes_ibfk_5 FOREIGN KEY (idMenu) REFERENCES menus(idMenu);

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `adrs_ibfk_2` FOREIGN KEY (`noAdrs`) REFERENCES `adresses` (`idAdrs`),
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`notpCmpt`) REFERENCES `typecomptes` (`idtype`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `prod_ibfk_1` FOREIGN KEY (`idcategorie`) REFERENCES `categories` (`idCategorie`);
COMMIT;



--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`idAdrs`, `noCvq`, `Rue`, `ville`, `province`, `codePostal`, `telephone`) VALUES
(1, '154', 'la lune', 'Quebec', 'QC', 'G1X 3T3', '418-547-1234'),
(2, '198', 'Mars', 'Quebec', 'QC', 'G1K 3C3', '418-524-8484'),
(3, '128', 'Jupiter', 'Quebec', 'QC', 'G1K 3C4', '418-524-3414'),
(4, '587', 'La terre', 'Quebec', 'QC', 'G2F 4T5', '418-148-1482'),
(5, '569', 'Le soleil', 'Quebec', 'QC', 'G1F 4T7', '418-952-3654');

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Promotions'),
(2, 'Pizza'),
(3, 'Poutines'),
(4, 'Hamburgers'),
(5, 'Poulet'),
(6, 'Pates'),
(7, 'Salade'),
(9, 'Desserts'),
(10, 'Boissons');

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `datecommande`, `idetat`, `idModePaiement`, `noClient`, `noAdrs`, `idMenu`, `commentaires`) VALUES
(1, '2017-10-03 01:30:00', 5, 2, 3, 2, 1, ''),
(2, '2017-11-13 11:33:18', 3, 1, 3, 2, 1, ''),
(3, '2017-12-11 11:30:10', 1, 2, 3, 4, 2, ''),
(4, '2017-11-10 12:32:20', 3, 4, 2, 3, 1, ''),
(5, '2017-12-12 10:39:50', 4, 1, 3, 3, 3, '');

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`noCompte`, `notpCmpt`, `prenom`, `nom`, `noAdrs`, `telephone`, `Courriel`, `nomUtilisateur`, `motPasse`, `Actif`, `commentaires`) VALUES
(1, 1, 'Alain', 'Bernad', 1, '418-148-1482', 'alain@yahoo.com', 'alainber', '12345678', 1, ''),
(2, 3, 'bob', 'LE super', 1, '418-952-3654', 'monchef@concept.ca', 'lesuperchef', '123456789', 1, ''),
(3, 5, 'Eric', 'lavisite', 2, '418-148-2382', 'labonne@yahoo.com', 'ericlavivi', '12345678', 1, ''),
(4, 5, 'Marie', 'La france', 3, '418-952-5754', 'france@gmail.com', 'francemarie', '123456789', 1, ''),
(5, 2, 'Gilles', 'Gérant', 3, '418-952-5754', 'gilles@gillesmail.com', 'gg', '123456789', 1, '');

--
-- Déchargement des données de la table `etatcommandes`
--

INSERT INTO `etatcommandes` (`Etat`) VALUES
('en Validation'),
('Refusée'),
('Acceptée'),
('En préparation'),
('Prête à livrer'),
('En livraison'),
('Livrée avec succès'),
('En attende'),
('Autre');

--
-- Déchargement des données de la table `items_commande`
--

INSERT INTO `items_commande` (`noCommande`, `noProduit`, `qte`) VALUES
(2, 2, 1),
(2, 1, 4),
(2, 8, 3),
(1, 1, 1),
(1, 4, 1),
(1, 2, 1),
(3, 14, 1),
(3, 18, 1),
(4, 2, 20),
(4, 4, 1),
(4, 8, 1),
(4, 10, 10),
(5, 14, 1);

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`idMenu`, `titreMenu`, `actif`, `commentaires`, `idResto`) VALUES
(1, 'Menu de l\'été sur la lune', 1, '', 1),
(2, 'Menu de l\'hiver sur la lune', 0, 'n\'est pas actif', 1),
(3, 'Menu festival', 1, '', 2),
(4, 'Un menu santé ', 1, 'Super humm', 3);

--
-- Déchargement des données de la table `menu_produits`
--

INSERT INTO `menu_produits` (`idItem`, `idMenu`, `idProduit`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 8),
(5, 1, 10),
(6, 1, 12),
(7, 2, 14),
(8, 2, 18),
(9, 2, 10),
(11, 2, 8),
(12, 2, 11),
(10, 2, 6),
(13, 3, 14),
(14, 3, 18);

--
-- Déchargement des données de la table `modespaiement`
--

INSERT INTO `modespaiement` (`idMode`, `description`) VALUES
(1, 'Argents comptants'),
(2, 'Crédit'),
(3, 'Débit'),
(4, 'Coupons'),
(5, 'Carte cadeau');

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `nomProd`, `descProd`, `prixProd`, `imgProd`, `idCategorie`) VALUES
(1, 'Duo pizza 12 pouces', 'Obtenez deux pizzas de notre éventail complet pour un prix incroyable !', '16', 'images/deuxpizzas.jpg', 1),
(2, 'Deux poutines', 'Obtenez deux poutines de format régulier pour seulement 15$ !', '15', 'images/poutine.jpg', 1),
(3, 'Le burger du Prince', 'Le burger du Prince, frite régulière et canette de liqueur de votre choix.', '9', 'images/trioprince.jpg', 1),
(4, 'La lasagne du chef', 'La lasagne suprême de notre chef émoustillera vos papilles !', '14', 'images/lasagnechef.jpg', 1),
(5, 'Special du chef', 'Description: Obtenez deux pizzas de notre ï¿½ventail complet pour un prix incroyable !', '18', 'images/pizzaquebecoise.jpg', 2),
(6, 'Pizza All-Dressed', 'Une pizza composée de fromage, peperonnis, champignons et piments verts.', '8', 'images/pizzaalldressed.jpg', 2),
(7, 'Pizza québécoise', 'Sauce tomates, boeuf haché, oignons, fromage.', '10', 'images/pizzaquebecoise.jpg', 2),
(8, 'Club sandwich (viande blanche)', 'Des tranches de poulet rôti (viande blanche), tomates, bacon, laitue frisée entre des tranches de pain grillé, le tout servi avec l’accompagnement de votre choix, sauce BBQ, salade de chou et 2 sachets de mayonnaise. ', '14', 'images/clubSandwich.jpg', 8),
(9, 'Burger artisan', 'Effiloché de porc nappé de sauce whisky BBQ, rondelles d’oignon, salade de chou, laitue frisée et tartinade de poivrons rouges grillés. Le tout servi dans un pain burger avec graines de pavot. \r\n', '12', 'images/burgerPorcEffiloche.jpg', 4),
(16, 'Économix avec boisson gazeuse (2 à 9 repas)', 'Repas pour 2 personnes et plus (prix indiqué par personne). Combinaison de quarts de poulet cuisse et quarts de poulet poitrine (50%/50%). ', '10', 'images/economixBoissonGazeuse.jpg', 1),
(17, 'Shish Royal', 'Délicieuse délicatesse exotique.', '6', 'images/shishTaouk.jpg', 8),
(18, 'Spaghetti Yolonaise', 'Delicieux spaghetti maison', '10', 'images/spagYolonaise.jpg', 6);

--
-- Déchargement des données de la table `restaurants`
--

INSERT INTO `restaurants` (`idResto`, `nomResto`, `idAdrs`, `Actif`) VALUES
(1, 'La lune brillante', 1, 1),
(2, 'Mon Mars', 2, 1),
(3, 'Velo', 3, 0);

INSERT INTO `typecomptes` (`nomType`) VALUES
('Admin'),
('Gérant'),
('Chef'),
('Livreur'),
('Client');




