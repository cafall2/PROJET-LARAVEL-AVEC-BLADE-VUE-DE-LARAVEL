-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 mai 2023 à 16:20
-- Version du serveur : 5.7.31-log
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetlaravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `boursesocial`
--

DROP TABLE IF EXISTS `boursesocial`;
CREATE TABLE IF NOT EXISTS `boursesocial` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ine` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extrait` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificat_deces` blob,
  `certificat_egalite_chance` blob,
  `certificat_indigence` blob,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `boursesocial_ine_unique` (`ine`),
  UNIQUE KEY `boursesocial_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_23_151518_create_reclamations_table', 1),
(6, '2023_04_28_161733_create_boursesocial_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

DROP TABLE IF EXISTS `reclamations`;
CREATE TABLE IF NOT EXISTS `reclamations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receptionnee` tinyint(1) NOT NULL DEFAULT '0',
  `acceptee` tinyint(1) NOT NULL DEFAULT '0',
  `refusee` tinyint(1) NOT NULL DEFAULT '0',
  `motif_refus` text COLLATE utf8mb4_unicode_ci,
  `date_traitement` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_traitement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reclamations_user_id_foreign` (`user_id`),
  KEY `reclamations_user_traitement_id_foreign` (`user_traitement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reclamations`
--

INSERT INTO `reclamations` (`id`, `uid`, `objet`, `message`, `receptionnee`, `acceptee`, `refusee`, `motif_refus`, `date_traitement`, `user_id`, `user_traitement_id`, `created_at`, `updated_at`) VALUES
(1, 'c72642ae-6e59-4713-b8ed-b34c8aa4a65c', 'j\'ai pas reçu mon bourse de ce mois ci', 'j\'aimerai récupérer mon bourse si possible', 1, 0, 1, 'tu n\'es pas éligible à ce bourse pour cette années', '2023-05-11 05:07:00', 7, NULL, '2023-05-10 15:43:01', '2023-05-11 17:57:15'),
(2, '172fd1fc-85a9-4644-98e7-ae9c3614cee2', 'j\'ai pas reçu mon bourse de ce mois ci', 'j\'aimerai recevoir mon bourse de ce mois ci', 1, 0, 1, 'tu n\'es pas éligible à ce bourse', '2023-05-11 18:04:00', 7, NULL, '2023-05-10 16:48:38', '2023-05-11 18:05:13'),
(3, '3f9b6771-3c4b-462f-8a50-01ff60d7f0c2', 'j\'ai pas reçu mon bourse de ce mois ci', 'cher administrateur du site j\'aimerai que mon bourse de se moi ci me soit payer dans les \r\nplus bref délai', 1, 0, 1, 'tu n\'es pas éligible à ce bourse', NULL, 11, NULL, '2023-05-10 19:22:05', '2023-05-12 15:26:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UFR` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Licence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `ine`, `UFR`, `Licence`, `date_naissance`, `telephone`, `email`, `photo`, `password`, `admin`, `enabled`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `nom`, `prenom`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 'fcheikhadrame@gmail.com', NULL, '$2y$10$mfetQowwhKK/.rxkZO8v..wmjpBzj5rQegPQDz.xjX6xqi.M12fuK', 1, 1, NULL, NULL, '2023-04-29 14:10:06', '2023-04-29 14:10:06', '', NULL),
(2, NULL, NULL, NULL, NULL, NULL, 'paultine@gmail.com', NULL, '$2y$10$tWSwjVCPESDkqBsAfGt6/OLx0UoKzJvznkSxof1qoZlsNT4plN37e', 1, 1, NULL, NULL, '2023-04-30 09:56:05', '2023-04-30 09:56:05', '', NULL),
(3, NULL, NULL, NULL, NULL, NULL, 'adamadiop@gmail.com', NULL, '$2y$10$7BNivh2YOGOqOyOebmQBP.wZJ70DMknAj5tFUQKO2sy0lkCURkgfm', 1, 1, NULL, NULL, '2023-05-02 08:17:13', '2023-05-02 08:17:13', '', NULL),
(4, 'N00A25120184', NULL, NULL, '1999-01-18', '778978427', 'abdouldiop@gmail.com', NULL, '$2y$10$DTW6C2QhJ.Q9RTcNhFxL6uoQXpHYp9v/FdBj0QzyZvgZh6HRxW2Vi', 1, 1, NULL, NULL, '2023-05-03 21:36:51', '2023-05-03 21:36:51', '', NULL),
(5, NULL, NULL, NULL, NULL, NULL, 'adama2diop@gmail.com', NULL, '$2y$10$vlpRcJPaKGjnPbOz3SH1GeadFzNlUoqn.HVeWuLhHmvZcqJ8o/5Uy', 1, 1, NULL, NULL, '2023-05-04 13:32:11', '2023-05-04 13:32:11', '', NULL),
(6, 'N00A25120194', NULL, NULL, '1999-02-01', '784444444', 'badarafall@gmail.com', NULL, '$2y$10$MYuxUIs5BybDAEObg93WIeq35E1DPU/d9r.vfJKsKxVPR5Xb6V.WS', 1, 1, NULL, NULL, '2023-05-04 23:29:27', '2023-05-04 23:29:27', '', NULL),
(7, 'N00A25520184', NULL, NULL, '1899-02-01', '789999999', 'paulmendy7@gmail.com', NULL, '$2y$10$MC43NTLZqdBxv6es9WJhpuSsJWdT2BA9I5nOc7ZYVh32eCVROJE42', 0, 1, NULL, NULL, '2023-05-09 15:03:57', '2023-05-09 15:03:57', '', NULL),
(8, '123456789', NULL, NULL, '1999-02-01', '778888888', 'cheikhdiop@gmail.com', NULL, '$2y$10$F5/SmHkRVVG8P6Ma8IgJqebkMh33CUM9ND/Ydns4NcYVlaowR0BbO', 1, 1, NULL, NULL, '2023-05-10 17:51:27', '2023-05-10 17:51:27', '', NULL),
(9, '946496522881', NULL, NULL, '2000-12-12', '770001122', 'fch@gmail.com', NULL, '$2y$10$gB/RE.kqDkqmmhuiAtBig.I9v6suS35uYB5rIh6nNZmb7XdgvvmTu', 1, 1, NULL, NULL, '2023-05-10 17:57:49', '2023-05-10 17:57:49', '', NULL),
(10, '123', NULL, NULL, '1999-04-14', '778592255', 'hjkngyvu@g.com', NULL, '$2y$10$H056.uc/C29was6X6p/Rl.iSBcrdna8p6QfuMvHdXgYPc1Bg9Ckpa', 1, 1, NULL, NULL, '2023-05-10 18:04:56', '2023-05-10 18:04:56', '', NULL),
(11, '1234567890', NULL, NULL, '1996-01-12', '778444455', 'oulimata12@gmail.com', NULL, '$2y$10$sp2B08GPgdlQE3TuC4ayh.ZL9NoHXep1pxzV24yQMqg87jDRnA77O', 0, 1, NULL, NULL, '2023-05-10 19:16:38', '2023-05-10 19:16:38', '', NULL),
(12, '9874561230', NULL, NULL, '1999-02-03', '778995522', 'pascalemendy@gmail.com', NULL, '$2y$10$Jk8QZ8lZXLDT6eTmpCy8TeeQIKbbpurIr4SwxLWSlEMNlfic6q/Fe', 1, 1, NULL, NULL, '2023-05-10 19:31:00', '2023-05-10 19:31:00', '', NULL),
(13, '777777777', NULL, NULL, '1999-03-01', '7711100088', 'layediallo@gmail.com', NULL, '$2y$10$7HivMDdWRCRBage8bdKvc.1xM4edhTqYV6PxF/SVsd2VfNYfe4PH6', 1, 1, NULL, NULL, '2023-05-11 13:09:51', '2023-05-11 13:09:51', '', NULL),
(14, '88888888', NULL, NULL, '1999-02-10', '7788888888', 'ndiayelhadji1@gmail.com', NULL, '$2y$10$fvcF6ky/pD8KbYP.f9aN/ej3i/MvxX0.wbCmqEjV8rRkKmDfLwTeS', 0, 1, NULL, NULL, '2023-05-11 16:08:30', '2023-05-11 16:08:30', 'ndiaye', 'ehadji'),
(15, '888888882', NULL, NULL, '1999-02-01', '7788888888', 'elhadjidiaye@gmail.com', NULL, '$2y$10$koYDIQwOkvIUMc0r5MsWLOtbvgVaD4mNMlXIQ7m9ar984vVZTdonq', NULL, 1, NULL, NULL, '2023-05-11 16:30:54', '2023-05-11 16:30:54', 'ndiaye', 'el hadji'),
(16, 'NA00A25120151', 'SFI', 'MPI', '1999-10-10', '778978427', 'adramendiaye@gmail.com', NULL, '$2y$10$yvjKjJnhNLZbEKB1BlIjDe08UfYmHhKz5MSpAIK2alpWLlMSspkny', NULL, 1, NULL, NULL, '2023-05-11 16:56:20', '2023-05-11 16:56:20', 'ndiaye', 'adrame');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
