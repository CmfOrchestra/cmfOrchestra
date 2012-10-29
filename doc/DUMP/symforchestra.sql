-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 25 Octobre 2012 à 15:01
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `symforchestra`
--

-- --------------------------------------------------------

--
-- Structure de la table `fos_group`
--

CREATE TABLE IF NOT EXISTS `fos_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4B019DDB5E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_permission`
--

CREATE TABLE IF NOT EXISTS `fos_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `comment` longtext,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_ressource`
--

CREATE TABLE IF NOT EXISTS `fos_ressource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` longtext,
  `slug` longtext NOT NULL,
  `url` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_role`
--

CREATE TABLE IF NOT EXISTS `fos_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label` varchar(55) NOT NULL,
  `name` varchar(25) NOT NULL,
  `comment` longtext,
  `heritage` longtext COMMENT '(DC2Type:array)',
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_role_ressource`
--

CREATE TABLE IF NOT EXISTS `fos_role_ressource` (
  `role_id` bigint(20) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`ressource_id`),
  KEY `IDX_4A41058D60322AC` (`role_id`),
  KEY `IDX_4A41058FC6CD52A` (`ressource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(5) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `permissions` longtext NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  KEY `IDX_957A6479627579FF` (`lang_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_group` (
  `user_id` bigint(20) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_583D1F3EA76ED395` (`user_id`),
  KEY `IDX_583D1F3EFE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_block`
--

CREATE TABLE IF NOT EXISTS `gedmo_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT NULL,
  `page_intro_id` bigint(20) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `title` longtext,
  `descriptif` longtext,
  `content` longtext,
  `author` varchar(255) DEFAULT NULL,
  `url` varchar(314) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AAD87EB0EA9FDD75` (`media_id`),
  KEY `IDX_AAD87EB064C19C1` (`category`),
  KEY `IDX_AAD87EB01874536E` (`page_intro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_block_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_block_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_FD62B11A232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_category`
--

CREATE TABLE IF NOT EXISTS `gedmo_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_category_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_category_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_D191D1FE232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_content`
--

CREATE TABLE IF NOT EXISTS `gedmo_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_intro_id` bigint(20) DEFAULT NULL,
  `page_cssclass` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `categoryother` varchar(128) DEFAULT NULL,
  `descriptif` varchar(128) DEFAULT NULL,
  `content` longtext,
  `url` varchar(314) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6464AB2E1874536E` (`page_intro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_content_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_content_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_E411AECD232D562B` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_media`
--

CREATE TABLE IF NOT EXISTS `gedmo_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT NULL,
  `media` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(314) DEFAULT NULL,
  `mediaId` int(11) DEFAULT NULL,
  `mediadelete` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43EF489E64C19C1` (`category`),
  KEY `IDX_43EF489E6A2CA10C` (`media`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_media_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_media_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_85481D9F232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_menu`
--

CREATE TABLE IF NOT EXISTS `gedmo_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(64) NOT NULL,
  `category` varchar(128) DEFAULT NULL,
  `categoryother` varchar(128) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(314) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_672530EA989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_672530EAEA9FDD75` (`media_id`),
  KEY `IDX_672530EAC4663E4` (`page_id`),
  KEY `IDX_672530EA727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_menu_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_menu_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_D8F32BD9232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_organigram`
--

CREATE TABLE IF NOT EXISTS `gedmo_organigram` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(64) NOT NULL,
  `category` varchar(128) DEFAULT NULL,
  `categoryother` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `descriptif` longtext,
  `question` varchar(128) DEFAULT NULL,
  `content` longtext,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_257FB08A989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_257FB08AEA9FDD75` (`media_id`),
  KEY `IDX_257FB08AC4663E4` (`page_id`),
  KEY `IDX_257FB08A727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_organigram_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_organigram_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_B699CC5A232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_slider`
--

CREATE TABLE IF NOT EXISTS `gedmo_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `categoryother` varchar(128) DEFAULT NULL,
  `css_class` varchar(255) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `subtitle` varchar(128) DEFAULT NULL,
  `descriptif_left` longtext,
  `descriptif_right` longtext,
  `page_title` varchar(128) DEFAULT NULL,
  `page_cssclass` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `meta_keywords` longtext,
  `meta_description` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D1EF2186EA9FDD75` (`media_id`),
  KEY `IDX_D1EF2186C4663E4` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gedmo_slider_translations`
--

CREATE TABLE IF NOT EXISTS `gedmo_slider_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_1BE96665232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery`
--

CREATE TABLE IF NOT EXISTS `media__gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `context` varchar(255) NOT NULL,
  `default_format` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery_media`
--

CREATE TABLE IF NOT EXISTS `media__gallery_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80D4C541EA9FDD75` (`media_id`),
  KEY `IDX_80D4C5414E7AF8F` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__media`
--

CREATE TABLE IF NOT EXISTS `media__media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) NOT NULL,
  `provider_metadata` longtext COMMENT '(DC2Type:array)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(64) DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `context` varchar(16) DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_block`
--

CREATE TABLE IF NOT EXISTS `pi_block` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `config_css_class` varchar(255) NOT NULL,
  `config_xml` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6FBD9DD2C4663E4` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_comment`
--

CREATE TABLE IF NOT EXISTS `pi_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagetrans_id` bigint(20) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `email` longtext,
  `is_approved` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_601DB669BDC78D6A` (`pagetrans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_keyword`
--

CREATE TABLE IF NOT EXISTS `pi_keyword` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) DEFAULT NULL,
  `groupnameother` varchar(128) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_keyword_page`
--

CREATE TABLE IF NOT EXISTS `pi_keyword_page` (
  `page_id` bigint(20) NOT NULL,
  `keyword_id` bigint(20) NOT NULL,
  PRIMARY KEY (`page_id`,`keyword_id`),
  KEY `IDX_5577B62BC4663E4` (`page_id`),
  KEY `IDX_5577B62B115D4552` (`keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_keyword_rubrique`
--

CREATE TABLE IF NOT EXISTS `pi_keyword_rubrique` (
  `rubrique_id` bigint(20) NOT NULL,
  `keyword_id` bigint(20) NOT NULL,
  PRIMARY KEY (`rubrique_id`,`keyword_id`),
  KEY `IDX_C3EFF8C03BD38833` (`rubrique_id`),
  KEY `IDX_C3EFF8C0115D4552` (`keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_langue`
--

CREATE TABLE IF NOT EXISTS `pi_langue` (
  `id` varchar(5) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_langue_translations`
--

CREATE TABLE IF NOT EXISTS `pi_langue_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` varchar(5) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_E8378639232D562B` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_layout`
--

CREATE TABLE IF NOT EXISTS `pi_layout` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_pc` varchar(255) NOT NULL,
  `file_mobile` varchar(255) NOT NULL,
  `configXml` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_876B3FF45E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_page`
--

CREATE TABLE IF NOT EXISTS `pi_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `rubrique_id` bigint(20) DEFAULT NULL,
  `layout_id` bigint(20) DEFAULT NULL,
  `is_cacheable` tinyint(1) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `meta_content_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D1F260E1F3667F83` (`route_name`),
  KEY `IDX_D1F260E1A76ED395` (`user_id`),
  KEY `IDX_D1F260E13BD38833` (`rubrique_id`),
  KEY `IDX_D1F260E18C22AA1A` (`layout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_page_css`
--

CREATE TABLE IF NOT EXISTS `pi_page_css` (
  `page_id` bigint(20) NOT NULL,
  `pagecss_id` bigint(20) NOT NULL,
  PRIMARY KEY (`page_id`,`pagecss_id`),
  KEY `IDX_C4EF3322C4663E4` (`page_id`),
  KEY `IDX_C4EF33228DE34652` (`pagecss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_page_historical_status`
--

CREATE TABLE IF NOT EXISTS `pi_page_historical_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagetrans_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `comment` longtext,
  `created_at` datetime NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1B1651F2BDC78D6A` (`pagetrans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_page_js`
--

CREATE TABLE IF NOT EXISTS `pi_page_js` (
  `page_id` bigint(20) NOT NULL,
  `pagejs_id` bigint(20) NOT NULL,
  PRIMARY KEY (`page_id`,`pagejs_id`),
  KEY `IDX_50D151E5C4663E4` (`page_id`),
  KEY `IDX_50D151E52FCBE760` (`pagejs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_page_translation`
--

CREATE TABLE IF NOT EXISTS `pi_page_translation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) DEFAULT NULL,
  `lang_code` varchar(5) NOT NULL,
  `lang_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `is_secure` tinyint(1) DEFAULT NULL,
  `secure_roles` longtext COMMENT '(DC2Type:array)',
  `is_indexable` tinyint(1) DEFAULT NULL,
  `breadcrumb` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` longtext,
  `meta_description` longtext,
  `surtitre` varchar(255) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `soustitre` varchar(255) DEFAULT NULL,
  `descriptif` longtext,
  `chapo` longtext,
  `texte` longtext,
  `ps` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7EF527F0C4663E4` (`page_id`),
  KEY `IDX_7EF527F0627579FF` (`lang_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_routing`
--

CREATE TABLE IF NOT EXISTS `pi_routing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) DEFAULT NULL,
  `locales` longtext NOT NULL COMMENT '(DC2Type:array)',
  `defaults` longtext NOT NULL COMMENT '(DC2Type:array)',
  `requirements` longtext NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_51915DFF2C42079` (`route`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_rubrique`
--

CREATE TABLE IF NOT EXISTS `pi_rubrique` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `descriptif` longtext,
  `texte` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FF3A9417727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_tag`
--

CREATE TABLE IF NOT EXISTS `pi_tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) DEFAULT NULL,
  `groupnameother` varchar(128) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `Hicolor` varchar(7) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_tag_page`
--

CREATE TABLE IF NOT EXISTS `pi_tag_page` (
  `page_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`page_id`,`tag_id`),
  KEY `IDX_8A9B94FDC4663E4` (`page_id`),
  KEY `IDX_8A9B94FDBAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pi_tag_translations`
--

CREATE TABLE IF NOT EXISTS `pi_tag_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) DEFAULT NULL,
  `locale` varchar(8) NOT NULL,
  `field` varchar(32) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_id`,`field`),
  KEY `IDX_BB81CD68232D562B` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_widget`
--

CREATE TABLE IF NOT EXISTS `pi_widget` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `block_id` bigint(20) DEFAULT NULL,
  `plugin` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `is_cacheable` tinyint(1) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `config_css_class` varchar(255) DEFAULT NULL,
  `config_xml` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_38A84AC6E9ED820C` (`block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi_widget_translation`
--

CREATE TABLE IF NOT EXISTS `pi_widget_translation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `widget_id` bigint(20) DEFAULT NULL,
  `lang_code` varchar(5) NOT NULL,
  `content` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `archive_at` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4ECCE3E5FBE885E2` (`widget_id`),
  KEY `IDX_4ECCE3E5627579FF` (`lang_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `routing_translations`
--

CREATE TABLE IF NOT EXISTS `routing_translations` (
  `id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `localized_value` varchar(255) NOT NULL,
  `original_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_291BA3522C420794180C698FA7AEFFB` (`route`,`locale`,`attribute`),
  KEY `IDX_291BA352D951F3E4` (`localized_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fos_role_ressource`
--
ALTER TABLE `fos_role_ressource`
  ADD CONSTRAINT `FK_4A41058D60322AC` FOREIGN KEY (`role_id`) REFERENCES `fos_role` (`id`),
  ADD CONSTRAINT `FK_4A41058FC6CD52A` FOREIGN KEY (`ressource_id`) REFERENCES `fos_ressource` (`id`);

--
-- Contraintes pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A6479627579FF` FOREIGN KEY (`lang_code`) REFERENCES `pi_langue` (`id`);

--
-- Contraintes pour la table `fos_user_group`
--
ALTER TABLE `fos_user_group`
  ADD CONSTRAINT `FK_583D1F3EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_583D1F3EFE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_group` (`id`);

--
-- Contraintes pour la table `gedmo_block`
--
ALTER TABLE `gedmo_block`
  ADD CONSTRAINT `FK_AAD87EB01874536E` FOREIGN KEY (`page_intro_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_AAD87EB064C19C1` FOREIGN KEY (`category`) REFERENCES `gedmo_category` (`id`),
  ADD CONSTRAINT `FK_AAD87EB0EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `gedmo_media` (`id`);

--
-- Contraintes pour la table `gedmo_block_translations`
--
ALTER TABLE `gedmo_block_translations`
  ADD CONSTRAINT `FK_FD62B11A232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_block` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_category_translations`
--
ALTER TABLE `gedmo_category_translations`
  ADD CONSTRAINT `FK_D191D1FE232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_category` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_content`
--
ALTER TABLE `gedmo_content`
  ADD CONSTRAINT `FK_6464AB2E1874536E` FOREIGN KEY (`page_intro_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `gedmo_content_translations`
--
ALTER TABLE `gedmo_content_translations`
  ADD CONSTRAINT `FK_E411AECD232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_content` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_media`
--
ALTER TABLE `gedmo_media`
  ADD CONSTRAINT `FK_43EF489E64C19C1` FOREIGN KEY (`category`) REFERENCES `gedmo_category` (`id`),
  ADD CONSTRAINT `FK_43EF489E6A2CA10C` FOREIGN KEY (`media`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `gedmo_media_translations`
--
ALTER TABLE `gedmo_media_translations`
  ADD CONSTRAINT `FK_85481D9F232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_menu`
--
ALTER TABLE `gedmo_menu`
  ADD CONSTRAINT `FK_672530EA727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `gedmo_menu` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_672530EAC4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_672530EAEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `gedmo_media` (`id`);

--
-- Contraintes pour la table `gedmo_menu_translations`
--
ALTER TABLE `gedmo_menu_translations`
  ADD CONSTRAINT `FK_D8F32BD9232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_menu` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_organigram`
--
ALTER TABLE `gedmo_organigram`
  ADD CONSTRAINT `FK_257FB08A727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `gedmo_organigram` (`id`),
  ADD CONSTRAINT `FK_257FB08AC4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_257FB08AEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `gedmo_media` (`id`);

--
-- Contraintes pour la table `gedmo_organigram_translations`
--
ALTER TABLE `gedmo_organigram_translations`
  ADD CONSTRAINT `FK_B699CC5A232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_organigram` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gedmo_slider`
--
ALTER TABLE `gedmo_slider`
  ADD CONSTRAINT `FK_D1EF2186C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_D1EF2186EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `gedmo_media` (`id`);

--
-- Contraintes pour la table `gedmo_slider_translations`
--
ALTER TABLE `gedmo_slider_translations`
  ADD CONSTRAINT `FK_1BE96665232D562B` FOREIGN KEY (`object_id`) REFERENCES `gedmo_slider` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`),
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `pi_block`
--
ALTER TABLE `pi_block`
  ADD CONSTRAINT `FK_6FBD9DD2C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `pi_comment`
--
ALTER TABLE `pi_comment`
  ADD CONSTRAINT `FK_601DB669BDC78D6A` FOREIGN KEY (`pagetrans_id`) REFERENCES `pi_page_translation` (`id`);

--
-- Contraintes pour la table `pi_keyword_page`
--
ALTER TABLE `pi_keyword_page`
  ADD CONSTRAINT `FK_5577B62B115D4552` FOREIGN KEY (`keyword_id`) REFERENCES `pi_keyword` (`id`),
  ADD CONSTRAINT `FK_5577B62BC4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `pi_keyword_rubrique`
--
ALTER TABLE `pi_keyword_rubrique`
  ADD CONSTRAINT `FK_C3EFF8C0115D4552` FOREIGN KEY (`keyword_id`) REFERENCES `pi_keyword` (`id`),
  ADD CONSTRAINT `FK_C3EFF8C03BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `pi_rubrique` (`id`);

--
-- Contraintes pour la table `pi_langue_translations`
--
ALTER TABLE `pi_langue_translations`
  ADD CONSTRAINT `FK_E8378639232D562B` FOREIGN KEY (`object_id`) REFERENCES `pi_langue` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pi_page`
--
ALTER TABLE `pi_page`
  ADD CONSTRAINT `FK_D1F260E13BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `pi_rubrique` (`id`),
  ADD CONSTRAINT `FK_D1F260E18C22AA1A` FOREIGN KEY (`layout_id`) REFERENCES `pi_layout` (`id`),
  ADD CONSTRAINT `FK_D1F260E1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `pi_page_css`
--
ALTER TABLE `pi_page_css`
  ADD CONSTRAINT `FK_C4EF33228DE34652` FOREIGN KEY (`pagecss_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_C4EF3322C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `pi_page_historical_status`
--
ALTER TABLE `pi_page_historical_status`
  ADD CONSTRAINT `FK_1B1651F2BDC78D6A` FOREIGN KEY (`pagetrans_id`) REFERENCES `pi_page_translation` (`id`);

--
-- Contraintes pour la table `pi_page_js`
--
ALTER TABLE `pi_page_js`
  ADD CONSTRAINT `FK_50D151E52FCBE760` FOREIGN KEY (`pagejs_id`) REFERENCES `pi_page` (`id`),
  ADD CONSTRAINT `FK_50D151E5C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `pi_page_translation`
--
ALTER TABLE `pi_page_translation`
  ADD CONSTRAINT `FK_7EF527F0627579FF` FOREIGN KEY (`lang_code`) REFERENCES `pi_langue` (`id`),
  ADD CONSTRAINT `FK_7EF527F0C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page` (`id`);

--
-- Contraintes pour la table `pi_rubrique`
--
ALTER TABLE `pi_rubrique`
  ADD CONSTRAINT `FK_FF3A9417727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `pi_rubrique` (`id`);

--
-- Contraintes pour la table `pi_tag_page`
--
ALTER TABLE `pi_tag_page`
  ADD CONSTRAINT `FK_8A9B94FDBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `pi_tag` (`id`),
  ADD CONSTRAINT `FK_8A9B94FDC4663E4` FOREIGN KEY (`page_id`) REFERENCES `pi_page_translation` (`id`);

--
-- Contraintes pour la table `pi_tag_translations`
--
ALTER TABLE `pi_tag_translations`
  ADD CONSTRAINT `FK_BB81CD68232D562B` FOREIGN KEY (`object_id`) REFERENCES `pi_tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pi_widget`
--
ALTER TABLE `pi_widget`
  ADD CONSTRAINT `FK_38A84AC6E9ED820C` FOREIGN KEY (`block_id`) REFERENCES `pi_block` (`id`);

--
-- Contraintes pour la table `pi_widget_translation`
--
ALTER TABLE `pi_widget_translation`
  ADD CONSTRAINT `FK_4ECCE3E5627579FF` FOREIGN KEY (`lang_code`) REFERENCES `pi_langue` (`id`),
  ADD CONSTRAINT `FK_4ECCE3E5FBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `pi_widget` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
