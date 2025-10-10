-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 11 oct. 2025 à 01:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ap1_boulangerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `note_avis` int(11) NOT NULL,
  `commentaire_avis` longtext NOT NULL,
  `date_avis` datetime NOT NULL,
  `utilisateur_avis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `note_avis`, `commentaire_avis`, `date_avis`, `utilisateur_avis_id`) VALUES
(6, 3, 'Service de boulangerie/pâtisserie propre, pourrais tout de même s\'améliorer.', '2025-10-09 21:06:50', 10),
(7, 4, 'Je retire mon précédent avis, le service c\'est grandement amélioré ! Bravo !', '2025-10-09 21:07:54', 10),
(8, 5, 'J\'adore mon site !', '2025-10-09 21:13:03', 11),
(9, 5, 'Je m\'aime beaucoup !', '2025-10-09 21:13:13', 11);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `numero_contact` longtext NOT NULL,
  `demande_contact` longtext NOT NULL,
  `date_contact` datetime NOT NULL,
  `utilisateur_contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `numero_contact`, `demande_contact`, `date_contact`, `utilisateur_contact_id`) VALUES
(9, '0682714934', 'Bonjour, comment faites vous tout ça ?!', '2025-10-09 21:08:19', 10),
(10, '0682714934', 'Dites moi votre recette par pitié !', '2025-10-09 21:08:36', 10),
(11, '0741526398', 'Ceci est mon premier message en tant qu\'administrateur !', '2025-10-09 21:12:42', 11),
(12, '0741526398', 'Ceci est mon deuxième message', '2025-10-09 21:12:52', 11);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250930095309', '2025-09-30 12:00:29', 208),
('DoctrineMigrations\\Version20250930100612', '2025-09-30 12:06:21', 84),
('DoctrineMigrations\\Version20250930101301', '2025-09-30 12:13:06', 230),
('DoctrineMigrations\\Version20250930101611', '2025-09-30 12:16:18', 177),
('DoctrineMigrations\\Version20250930115042', '2025-09-30 13:51:09', 195),
('DoctrineMigrations\\Version20250930173221', '2025-09-30 19:32:28', 181),
('DoctrineMigrations\\Version20251001152153', '2025-10-01 17:22:12', 131),
('DoctrineMigrations\\Version20251005122101', '2025-10-05 14:22:24', 538),
('DoctrineMigrations\\Version20251007120915', '2025-10-07 14:09:29', 101),
('DoctrineMigrations\\Version20251007123141', '2025-10-07 14:31:47', 143),
('DoctrineMigrations\\Version20251009194917', '2025-10-09 21:50:40', 245),
('DoctrineMigrations\\Version20251010071342', '2025-10-10 09:13:57', 88),
('DoctrineMigrations\\Version20251010071439', '2025-10-10 09:14:44', 37),
('DoctrineMigrations\\Version20251010192716', '2025-10-10 21:27:37', 116);

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

CREATE TABLE `presentation` (
  `id` int(11) NOT NULL,
  `image_presentation` longtext NOT NULL,
  `description_presentation` varchar(255) NOT NULL,
  `utilisateur_presentation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`id`, `image_presentation`, `description_presentation`, `utilisateur_presentation_id`) VALUES
(1, '', 'La présentation est fonctionnelle à 50%', 11);

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` int(11) NOT NULL,
  `article` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `utilisateur_prestation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `article`, `image`, `utilisateur_prestation_id`) VALUES
(3, NULL, 'uploads/68e95e4c361c7.webp', 11),
(4, 'oki', 'uploads/68e9614691ed1.webp', 11);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `roles`, `password`, `identifiant`, `nom`, `prenom`, `telephone`, `is_verified`) VALUES
(10, 'User.Test.1@mondomaine.fr', '[]', '$2y$13$NhtdCmiKP35KndaNzNB9j.0xmQMkz6I6XkBqnXR4lWjabc6Bk2bqK', 'User_TEST_1', 'User', 'Test1', '0682714934', 0),
(11, 'admin@boulangerie.fr', '[\"ROLE_ADMIN\"]', '$2y$13$BhjjQQftxlEAOsyswAOlfOeqY4noYxn97RAgqcjnT7WyY.tjVZryW', 'Admin', 'Admin', 'Admin', '0741526398', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F91ABF06375870D` (`utilisateur_avis_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C62E638D519E75C` (`utilisateur_contact_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B66E893BEBBC1FD` (`utilisateur_presentation_id`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_51C88FADBA9894D6` (`utilisateur_prestation_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER` (`identifiant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF06375870D` FOREIGN KEY (`utilisateur_avis_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638D519E75C` FOREIGN KEY (`utilisateur_contact_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `FK_9B66E893BEBBC1FD` FOREIGN KEY (`utilisateur_presentation_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `FK_51C88FADBA9894D6` FOREIGN KEY (`utilisateur_prestation_id`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
