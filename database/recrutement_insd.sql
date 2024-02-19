-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 fév. 2024 à 17:58
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recrutement_insd`
--

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `cover_letter` text NOT NULL,
  `position_id` int NOT NULL,
  `resume_path` text NOT NULL,
  `process_id` tinyint NOT NULL DEFAULT '0' COMMENT '0=for review\r\n',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `application`
--

INSERT INTO `application` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `email`, `contact`, `address`, `cover_letter`, `position_id`, `resume_path`, `process_id`, `date_created`) VALUES
(27, 'Rosalie', 'D', 'Amina', 'Feminin', 'rosalie@gmail.com', '+226 72-42-31-59', 'bobo02', '', 7, '1701826680_CURRICULUM VITAE-1.pdf', 11, '2023-12-06 07:08:34'),
(28, 'Ariste', 'F', 'Ouedraogo', 'Masculin', 'ben@gmail.com', '65300049', 'bp01ouaga', '', 8, '1701826860_CURRICULUM VITAE-1.pdf', 11, '2023-12-06 07:11:26'),
(29, 'Yvonne', 'W', 'Bargo', 'Feminin', 'Yvonne@gmail.com', '79460089', 'bp01ouaga', '', 8, '1701826980_CURRICULUM VITAE-on.pdf', 11, '2023-12-06 07:13:50'),
(35, 'TAPSOBA', 'W', 'BENAJA', 'Masculin', 'benaja304@gmail.com', '+226 72-42-31-59', 'ouaga', '', 7, '1701946140_CURRICULUM VITAE-1.pdf', 0, '2023-12-07 10:49:04'),
(36, 'TAPSOBA', 'P', 'Japhet', 'Masculin', 'japhet@gmail.com', '', 'ouaga', '', 8, '1701946200_Corrigé .pdf', 11, '2023-12-07 10:50:13');

-- --------------------------------------------------------

--
-- Structure de la table `communiques`
--

DROP TABLE IF EXISTS `communiques`;
CREATE TABLE IF NOT EXISTS `communiques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `fichier_pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `communiques`
--

INSERT INTO `communiques` (`id`, `titre`, `fichier_pdf`, `created_at`, `updated_at`) VALUES
(10, 'communique2', '656d99cee5c2c_communique.pdf', '2023-12-04 09:20:14', '2023-12-04 09:20:14'),
(9, 'communique1', '656fb57a9e71f_communique.pdf', '2023-12-04 09:08:05', '2023-12-05 23:42:50');

-- --------------------------------------------------------

--
-- Structure de la table `communiques1`
--

DROP TABLE IF EXISTS `communiques1`;
CREATE TABLE IF NOT EXISTS `communiques1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `fichier_pdf` varchar(255) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'en cours',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `communiques1`
--

INSERT INTO `communiques1` (`id`, `titre`, `fichier_pdf`, `statut`, `created_at`, `updated_at`) VALUES
(17, 'Dossier1', '', 'conforme', '2023-12-07 10:51:57', '2023-12-07 10:52:36');

-- --------------------------------------------------------

--
-- Structure de la table `dossiers`
--

DROP TABLE IF EXISTS `dossiers`;
CREATE TABLE IF NOT EXISTS `dossiers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre_dossier` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'en cours',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers_dossier`
--

DROP TABLE IF EXISTS `fichiers_dossier`;
CREATE TABLE IF NOT EXISTS `fichiers_dossier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dossier_id` int DEFAULT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `fichier_blob` longblob,
  PRIMARY KEY (`id`),
  KEY `dossier_id` (`dossier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancy_id` int DEFAULT NULL,
  `question_text` text,
  `response_type` varchar(50) DEFAULT NULL,
  `points` int DEFAULT NULL,
  `answers` text,
  PRIMARY KEY (`id`),
  KEY `vacancy_id` (`vacancy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recruitment_status`
--

DROP TABLE IF EXISTS `recruitment_status`;
CREATE TABLE IF NOT EXISTS `recruitment_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status_label` varchar(200) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recruitment_status`
--

INSERT INTO `recruitment_status` (`id`, `status_label`, `status`) VALUES
(11, 'Accepter', 1),
(12, 'Refuser', 1);

-- --------------------------------------------------------

--
-- Structure de la table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Plateforme de recrutement de l’INSD', 'benaja304@gmail.com', '+226 72-42-31-59', '1699866900_stat.jpg', '&lt;h1 style=&quot;text-align: center; margin-bottom: 13px; line-height: 1.1; font-size: 1.8em !important; border-radius: 15px !important; color: rgb(255, 255, 255);&quot;&gt;&lt;span style=&quot;color:rgb(0,0,0);margin-bottom: 13px; line-height: 1.1; font-size: 1.8em !important; border-radius: 15px !important;&quot;&gt;&lt;b style=&quot;color:rgb(0,0,0);margin-bottom: 13px; line-height: 1.1; font-size: 1.8em !important; border-radius: 15px !important;&quot;&gt;HISTORIQUE&lt;/b&gt;&lt;/span&gt;&lt;/h1&gt;&lt;p&gt;&lt;/p&gt;&lt;h3 class=&quot;card-text&quot; style=&quot;margin-bottom: 10px; line-height: 1.1; font-size: 24px; font-family: inherit; color: inherit;&quot;&gt;&lt;p style=&quot;margin-bottom: 10px; font-size: 14px; line-height: 23px; letter-spacing: 0.5px;&quot;&gt;Historiquement, la premi&egrave;re unit&eacute; administrative &agrave; vocation statistique du Burkina Faso fut cr&eacute;&eacute;e en 1958 sous le nom &laquo; Bureau statistique &raquo;. Ce bureau deviendra en 1963 le Service national de la statistique et des &eacute;tudes &eacute;conomiques (SNSEE) pour tenir compte des nouveaux besoins apparus apr&egrave;s l&rsquo;accession &agrave; l&rsquo;ind&eacute;pendance. En 1966, le SNSEE se mua en Direction de la statistique et de la m&eacute;canographie (DSM) qui entrera dans la m&eacute;moire collective comme &eacute;tant le service charg&eacute; du traitement de la solde des fonctionnaires. Amput&eacute;e de ses pr&eacute;rogatives du traitement de la solde des fonctionnaires en 1974, la DSM devient l&rsquo;Institut national de la statistique et de la d&eacute;mographie (INSD), organe national central en charge de la statistique. Sous tutelle du Minist&egrave;re de l&rsquo;&eacute;conomie, des finances et du d&eacute;veloppement, l&rsquo;INSD est un &Eacute;tablissement public de l&rsquo;&Eacute;tat &agrave; caract&egrave;re administratif depuis 2000.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 10px; font-size: 14px; line-height: 23px; letter-spacing: 0.5px;&quot;&gt;Conform&eacute;ment &agrave; ses statuts, Il a pour mission d&rsquo;&eacute;laborer et diffuser les outils et instruments d&rsquo;analyse et d&rsquo;aide &agrave; la d&eacute;cision, de promouvoir la recherche, le d&eacute;veloppement des &eacute;tudes &agrave; caract&egrave;re statistique, &eacute;conomique, d&eacute;mographique et social suivant des principes uniformes, conform&eacute;ment aux directives nationales et aux normes internationales approuv&eacute;es par le Burkina Faso. Il assure la coordination technique et institutionnelle du Syst&egrave;me statistique national (SSN) ainsi que la gestion strat&eacute;gique du d&eacute;veloppement de la statistique.&lt;/p&gt;&lt;/h3&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1=admin , 2 = recruteur , 3 = Candidat',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `doctor_id`, `name`, `address`, `contact`, `username`, `password`, `type`) VALUES
(2, 0, 'Recruteur Kaboré', '', '', 'benaja304@gmail.com', '123456', 2),
(12, 0, 'Traoré', '', '', 'traore@gmail.com', '$2y$10$.pPTUDsZFpkZL.PZNZ6HiOUiuVJrfOj7LrkE/S99MPLoiAI8m89B2', 3),
(20, 0, 'Admin RDH', '', '', 'drh@gmail.com', 'admin123', 1),
(22, 0, 'Ariste', '', '', 'ben@gmail.com', 'admin123', 3),
(23, 0, 'Admin Palingwendé', '', '', 'drh1@gmail.com', 'admin123', 1),
(24, 0, 'Yvonne', '', '', 'yvonne@gmail.com', 'admin123', 3),
(25, 0, 'Rosalie', '', '', 'rosalie@gmail.com', 'admin123', 3),
(27, 0, 'Japhet', '', '', 'japhet@gmail.com', 'admin123', 3);

-- --------------------------------------------------------

--
-- Structure de la table `vacancy`
--

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(200) NOT NULL,
  `availability` int NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vacancy`
--

INSERT INTO `vacancy` (`id`, `position`, `availability`, `description`, `status`, `date_created`) VALUES
(7, 'Ingénieur Statiscien', 15, '&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Responsabilit&eacute;sPrincipales :&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;ul style=&quot;margin-top:0cm&quot; type=&quot;disc&quot;&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Analyse de Donn&eacute;es :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Collecter, nettoyer et analyser des ensembles de donn&eacute;es complexes pour     identifier des tendances, des corr&eacute;lations et des mod&egrave;les significatifs.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;M&eacute;thodologies Statistiques :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Appliquer des techniques statistiques avanc&eacute;es pour r&eacute;soudre des probl&egrave;mes     sp&eacute;cifiques, en utilisant des m&eacute;thodes telles que la r&eacute;gression, l&amp;#x2019;analyse     factorielle, la mod&eacute;lisation pr&eacute;dictive, etc.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Interpr&eacute;tation et Communication :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Traduire les r&eacute;sultats de l&amp;#x2019;analyse statistique en informations     exploitables pour les parties prenantes non techniques. Pr&eacute;senter les     conclusions de mani&egrave;re claire et pr&eacute;cise.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Collaboration :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Travailler en &eacute;troite collaboration avec les &eacute;quipes [pr&eacute;ciser les     d&eacute;partements] pour comprendre leurs besoins en donn&eacute;es et fournir un     soutien analytique pertinent.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Innovation :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Proposer et d&eacute;velopper de nouvelles approches statistiques pour optimiser     les processus analytiques et am&eacute;liorer la qualit&eacute; des r&eacute;sultats.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Exigences:&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;ul style=&quot;margin-top:0cm&quot; type=&quot;disc&quot;&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Dipl&ocirc;me universitaire en     statistiques, math&eacute;matiques, informatique ou domaine connexe.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Exp&eacute;rience d&eacute;montr&eacute;e dans l&amp;#x2019;analyse     statistique, id&eacute;alement dans [indiquer l&amp;#x2019;industrie ou le domaine     sp&eacute;cifique].&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Ma&icirc;trise des logiciels statistiques     tels que R, Python, SPSS, etc.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Comp&eacute;tences solides en communication     et capacit&eacute; &agrave; vulgariser des concepts statistiques complexes.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;ProfilRecherch&eacute; :&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Le candidat id&eacute;al poss&egrave;deune solide compr&eacute;hension des principes statistiques et est capable d&amp;#x2019;appliquerces connaissances de mani&egrave;re pratique pour r&eacute;soudre des probl&egrave;mes r&eacute;els. Il ouelle doit &ecirc;tre capable de travailler de mani&egrave;re autonome, tout en &eacute;tant unmembre actif et collaboratif de l&amp;#x2019;&eacute;quipe, et doit &ecirc;tre passionn&eacute; parl&amp;#x2019;innovation et l&amp;#x2019;utilisation des donn&eacute;es pour prendre des d&eacute;cisions &eacute;clair&eacute;es.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;', 1, '2023-11-16 10:05:20'),
(8, 'Agent Enquêteur', 1500, '&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Responsabilit&eacute;sPrincipales :&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;ul style=&quot;margin-top:0cm&quot; type=&quot;disc&quot;&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Conduite d&amp;#x2019;Enqu&ecirc;tes :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Mener des investigations approfondies sur divers cas, collecter des     preuves, interviewer des t&eacute;moins et des suspects, et analyser les     informations recueillies pour r&eacute;soudre les affaires.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Connaissance L&eacute;gale :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Appliquer une compr&eacute;hension approfondie des lois, des r&egrave;glements et des     proc&eacute;dures l&eacute;gales pour garantir la l&eacute;galit&eacute; et l&amp;#x2019;int&eacute;grit&eacute; des enqu&ecirc;tes.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;R&eacute;daction de Rapports :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Pr&eacute;parer des rapports d&eacute;taill&eacute;s et pr&eacute;cis contenant les conclusions des     enqu&ecirc;tes, les preuves collect&eacute;es et les recommandations pour r&eacute;soudre les     affaires.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Collaboration :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Travailler en &eacute;troite collaboration avec les &eacute;quipes internes, les forces     de l&amp;#x2019;ordre et d&amp;#x2019;autres parties prenantes pour partager des informations et     contribuer &agrave; des r&eacute;solutions efficaces.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l1 level1 lfo1;     tab-stops:list 36.0pt&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Formation Continue :&lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;     Se tenir inform&eacute; des nouvelles techniques d&amp;#x2019;enqu&ecirc;te, des d&eacute;veloppements     l&eacute;gaux et des meilleures pratiques pour am&eacute;liorer continuellement les     comp&eacute;tences professionnelles.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Exigences:&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;ul style=&quot;margin-top:0cm&quot; type=&quot;disc&quot;&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Exp&eacute;rience pr&eacute;alable en enqu&ecirc;te, de     pr&eacute;f&eacute;rence dans [indiquer le domaine sp&eacute;cifique si pertinent].&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Connaissance approfondie des m&eacute;thodes     d&amp;#x2019;investigation, des techniques d&amp;#x2019;interrogatoire et des proc&eacute;dures     l&eacute;gales.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Capacit&eacute; d&eacute;montr&eacute;e &agrave; collecter,     analyser et pr&eacute;senter des preuves de mani&egrave;re coh&eacute;rente et d&eacute;taill&eacute;e.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt; &lt;li class=&quot;MsoNormal&quot; style=&quot;text-align:justify;mso-list:l0 level1 lfo2;     tab-stops:list 36.0pt&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;     font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Excellentes comp&eacute;tences en     communication &eacute;crite et orale.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;b&gt;&lt;i&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;ProfilRecherch&eacute; :&lt;/span&gt;&lt;/i&gt;&lt;/b&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:justify&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:107%;font-family:&amp;quot;Times New Roman&amp;quot;,serif&quot;&gt;Le candidat id&eacute;al pour ceposte poss&egrave;de un esprit analytique, une capacit&eacute; &agrave; travailler de mani&egrave;reind&eacute;pendante tout en &eacute;tant un excellent communicateur. Il doit &ecirc;tre capable detravailler sous pression, avoir un sens &eacute;thique &eacute;lev&eacute; et &ecirc;tre d&eacute;termin&eacute; &agrave;r&eacute;soudre des affaires de mani&egrave;re &eacute;quitable et rigoureuse.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;', 1, '2023-11-16 10:13:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
