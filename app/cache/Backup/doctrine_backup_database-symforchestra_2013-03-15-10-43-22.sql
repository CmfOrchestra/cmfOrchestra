###################################### 
### Doctrine Backup File Generated on 2013-03-15 10:03:22 
### Backup DATABASE symforchestra 
###################################### 
SET FOREIGN_KEY_CHECKS=0; 
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"; 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(1, 'Groupe Subscriber', 'a:1:{i:0;s:15:\"ROLE_SUBSCRIBER\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(2, 'Groupe Member', 'a:1:{i:0;s:11:\"ROLE_MEMBER\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(3, 'Groupe User', 'a:1:{i:0;s:9:\"ROLE_USER\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(4, 'Groupe Admin', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(5, 'Groupe Super Admin', 'a:2:{i:0;s:10:\"ROLE_ADMIN\";i:1;s:16:\"ROLE_SUPER_ADMIN\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(6, 'Groupe Manager', 'a:1:{i:0;s:20:\"ROLE_CONTENT_MANAGER\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(7, 'Groupe designer', 'a:1:{i:0;s:13:\"ROLE_DESIGNER\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 
INSERT INTO fos_group (`id`, `name`, `roles`, `created_at`, `updated_at`, `enabled`) VALUES(8, 'Groupe Editorial', 'a:2:{i:0;s:11:\"ROLE_EDITOR\";i:1;s:14:\"ROLE_MODERATOR\";}', '2013-03-15 10:42:13', '2013-03-15 10:42:13', 1); 

INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(1, 'VIEW', 'Utilisateur autorisé à voir l\'objet de domaine.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(2, 'EDIT', 'Utilisateur autorisé à apporter des changements à l\'objet de domaine.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(3, 'CREATE', 'Utilisateur autorisé à créer l\'objet de domaine.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(4, 'DELETE', 'Utilisateur autorisé à supprimer l\'objet de domaine.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(5, 'UNDELETE', 'Utilisateur autorisé à restaurer un objet de domaine précédemment supprimé.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(6, 'OPERATOR', 'Utilisateur autorisé à effectuer toutes les actions possibles sur les objets de domaine.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(7, 'MASTER', 'Utilisateur disposant des mêmes permissions qu\'un OPERATOR, étant en plus autorisé à accorder les autorisations des actions à d\'autres.', 1); 
INSERT INTO fos_permission (`id`, `name`, `comment`, `enabled`) VALUES(8, 'OWNER', 'Utilisateur disposant des mêmes permissions qu\'un MASTER, et possédant le domaine est en plus autorisé à accorder les autorisations de MASTER ET OWNER.', 1); 


INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(1, NULL, 'Default', 'ROLE_ALLOWED_TO_SWITCH', 'Utilisateur disposant du droit par default', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(2, NULL, 'Subscriber', 'ROLE_SUBSCRIBER', 'Utilisateur enregistré sur le site.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(3, NULL, 'Member', 'ROLE_MEMBER', 'Utilisateur enregistré sur le site et identifié comme membre.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(4, NULL, 'User', 'ROLE_USER', 'Utilisateur disposant d\'un accès à un espace.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(5, NULL, 'Editor', 'ROLE_EDITOR', 'Utilisateur ayant un accès restreint du backoffice, et pouvant ecrire, modifier des pages sans les publier.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(6, NULL, 'Moderator', 'ROLE_MODERATOR', 'Utilisateur disposant des mêmes droits qu\'un redacteur, et capable en plus de publier une page et de la supprimer.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(7, NULL, 'Designer', 'ROLE_DESIGNER', 'Utilisateur ayant un accès restreint du backoffice, et capable de modifier seulement le code des block des pages, des css et layout.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(8, NULL, 'Content manager', 'ROLE_CONTENT_MANAGER', 'Utilisateur disposant des mêmes droits qu\'un designer et un modérateur mais ayant un accès total des services CMS du backoffice.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(9, NULL, 'Administrator', 'ROLE_ADMIN', 'Utilisateur ayant un accès total du backoffice sans l\'accès à l\'admin SONATA.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(10, NULL, 'Sonata', 'SONATA', 'Utilisateur ayant un accès à SONATA.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 
INSERT INTO fos_role (`id`, `layout_id`, `label`, `name`, `comment`, `heritage`, `route_name`, `enabled`) VALUES(11, NULL, 'Super administrator', 'ROLE_SUPER_ADMIN', 'Utilisateur ayant un accès total du backoffice avec l\'accès à l\'admin SONATA.', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', NULL, 1); 


INSERT INTO fos_user (`id`, `lang_code`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `nickname`, `permissions`, `created_at`) VALUES(1, 'en_GB', 'admin', 'admin', 'admin@hotmail.com', 'admin@hotmail.com', 1, 'i46mzlnlkxkwko8k4og8w04ss0o4sg8', 'umHVAL1eIGnGQywZS9WPlrjreg/Vk+CguVhbUENighlnaZcshxvf7bLEjamArcSIvV8O1HCqF+05qvo0H1sCkQ==', NULL, 0, 0, NULL, '11yzqflez92oo0gs4osgocc08ogs0wk04ocw4g4kk0w8ogk8sk', NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 0, NULL, NULL, NULL, 'a:4:{i:0;s:4:\"VIEW\";i:1;s:4:\"EDIT\";i:2;s:6:\"CREATE\";i:3;s:6:\"DELETE\";}', '2013-03-15 10:42:13'); 
INSERT INTO fos_user (`id`, `lang_code`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `nickname`, `permissions`, `created_at`) VALUES(2, 'en_GB', 'superadmin', 'superadmin', 'superadmin@gmail.com', 'superadmin@gmail.com', 1, '6s2n9jvfuzgg48kw0kcgsgwcc4ksg8', 'UbLyzlt8bqqyHSuf6k0mkuno4LBqPlrWt8Xf2apFqNB2NiRCp1CKh00HghNk0DYTuOtx0s2eHrF/BhfVhegpJA==', NULL, 0, 0, NULL, '5jskpkqal74scc88wgwo0s08gkk4cks8s8s844wk008488cocw', NULL, 'a:2:{i:0;s:10:\"ROLE_ADMIN\";i:1;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, NULL, NULL, 'a:4:{i:0;s:4:\"VIEW\";i:1;s:4:\"EDIT\";i:2;s:6:\"CREATE\";i:3;s:6:\"DELETE\";}', '2013-03-15 10:42:13'); 
INSERT INTO fos_user (`id`, `lang_code`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `nickname`, `permissions`, `created_at`) VALUES(3, 'fr_FR', 'user', 'user', 'user@gmail.com', 'user@gmail.com', 1, 'a3x42skxn6okoocgko8s0g0k8w480s8', 'KY81EEm79bAzkh7oBQgMdxd3pavvybRm9qcNEpdnVB2GgQB/QLns06KJhPjFI1onY2dCT4R68/37bpRD+UU7fw==', NULL, 0, 0, NULL, '3ikx6qdneym840gswkkwww0sgocgwsss88ow844okww444swwk', NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 0, NULL, NULL, NULL, 'a:3:{i:0;s:4:\"VIEW\";i:1;s:4:\"EDIT\";i:2;s:6:\"CREATE\";}', '2013-03-15 10:42:13'); 

INSERT INTO fos_user_group (`user_id`, `group_id`) VALUES(3, 3); 
INSERT INTO fos_user_group (`user_id`, `group_id`) VALUES(1, 4); 
INSERT INTO fos_user_group (`user_id`, `group_id`) VALUES(2, 5); 












































INSERT INTO pi_keyword (`id`, `groupname`, `groupnameother`, `name`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(1, 'Group Rubrique', NULL, 'visible', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_keyword (`id`, `groupname`, `groupnameother`, `name`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(2, 'Groupe Page', NULL, 'visible', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_keyword (`id`, `groupname`, `groupnameother`, `name`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(3, 'Group Rubrique', NULL, 'invisible', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_keyword (`id`, `groupname`, `groupnameother`, `name`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(4, 'Groupe Page', NULL, 'invisible', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 



INSERT INTO pi_langue (`id`, `label`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES('ar_SA', 'Arabe', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_langue (`id`, `label`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES('en_GB', 'Anglais', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_langue (`id`, `label`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES('fr_FR', 'Français', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 

INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(1, 'en_GB', 'fr_FR', 'label', 'Anglais'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(2, 'en_GB', 'en_GB', 'label', 'English'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(3, 'en_GB', 'ar_SA', 'label', 'الإنجليزية'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(4, 'fr_FR', 'fr_FR', 'label', 'Français'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(5, 'fr_FR', 'en_GB', 'label', 'French'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(6, 'fr_FR', 'ar_SA', 'label', 'الفرنسية'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(7, 'ar_SA', 'fr_FR', 'label', 'Arabe'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(8, 'ar_SA', 'en_GB', 'label', 'Arabic'); 
INSERT INTO pi_langue_translations (`id`, `object_id`, `locale`, `field`, `content`) VALUES(9, 'ar_SA', 'ar_SA', 'label', 'العربية'); 

INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(1, 'pi-admin', 'layout-pi-admin.html.twig', 'Default', '<?xml version=\"1.0\"?><config></config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(2, 'pi-orchestra', 'layout-pi-orchestra.html.twig', 'Default', '<?xml version=\"1.0\"?><config></config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(3, 'pi-error', 'layout-pi-error.html.twig', 'Default', '<?xml version=\"1.0\"?><config></config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(4, 'pi-model-head-two-columns-fixed-foot', 'models\\layout-pi-model-head-two-columns-fixed-foot.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(5, 'pi-model-left-menu-fluid-column', 'models\\layout-pi-model-left-menu-fluid-column.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(6, 'pi-model-one-column-fixed-central', 'models\\layout-pi-model-one-column-fixed-central.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(7, 'pi-model-one-column-fixed-left', 'models\\layout-pi-model-one-column-fixed-left.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(8, 'pi-model-one-column', 'models\\layout-pi-model-one-column.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(9, 'pi-model-three-columns-main-fluid', 'models\\layout-pi-model-three-columns-main-fluid.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content_secondaire</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(10, 'pi-model-three-fixed-columns', 'models\\layout-pi-model-three-fixed-columns.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>content_secondaire</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(11, 'pi-model-three-fluid-columns', 'models\\layout-pi-model-three-fluid-columns.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n        <name>content_secondaire</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(12, 'pi-model-two-columns-fixed-horiz-menu', 'models\\layout-pi-model-two-columns-fixed-horiz-menu.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(13, 'pi-model-two-fluid-columns', 'models\\layout-pi-model-two-fluid-columns.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_layout (`id`, `name`, `file_pc`, `file_mobile`, `configXml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(14, 'pi-model-two-fluid-intelligent-columns', 'models\\layout-pi-model-two-fluid-intelligent-columns.html.twig', 'Default', '<?xml version=\"1.0\"?>\n<config>\n	<blocks>\n		<name>pc_header</name>\n		<name>pc_menuwrapper</name>\n		<name>content</name>\n		<name>pc_footer</name>\n		<name>mobile_novHeader</name>\n		<name>mobile_content</name>\n		<name>mobile_novFooter</name>\n	</blocks>\n</config>', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 

INSERT INTO pi_page (`id`, `layout_id`, `rubrique_id`, `user_id`, `is_cacheable`, `is_public`, `lifetime`, `route_name`, `url`, `meta_content_type`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(1, 2, NULL, 1, 1, 1, 86400, 'home_page', NULL, 'text/html', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 
INSERT INTO pi_page (`id`, `layout_id`, `rubrique_id`, `user_id`, `is_cacheable`, `is_public`, `lifetime`, `route_name`, `url`, `meta_content_type`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`) VALUES(2, 3, NULL, 1, 0, 1, NULL, 'error_404', 'error', 'text/html', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0); 




INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(1, 'fr_FR', 1, 'Reference', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 
INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(2, 'en_GB', 1, 'Traduction', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 
INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(3, 'ar_SA', 1, 'Traduction', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 
INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(4, 'fr_FR', 2, 'Reference', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, 'error-fr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 
INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(5, 'en_GB', 2, 'Traduction', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, 'error-en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 
INSERT INTO pi_page_translation (`id`, `lang_code`, `page_id`, `lang_status`, `status`, `is_secure`, `secure_roles`, `is_indexable`, `breadcrumb`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `surtitre`, `titre`, `soustitre`, `descriptif`, `chapo`, `texte`, `ps`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(6, 'ar_SA', 2, 'Traduction', 'Published', 0, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, 'error-ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-15 10:42:13', '2013-03-15 10:42:13', '2013-03-15', NULL, 1, 0); 

INSERT INTO pi_routing (`id`, `route`, `locales`, `defaults`, `requirements`) VALUES(1, 'home_page', '{\"fr_FR\":\"\",\"en_GB\":\"\",\"ar_SA\":\"\"}', '{\"_controller\":\"PiAppAdminBundle:Frontend:page\"}', '{\"_method\":\"get|post\"}'); 
INSERT INTO pi_routing (`id`, `route`, `locales`, `defaults`, `requirements`) VALUES(2, 'error_404', '{\"fr_FR\":\"error\\/error-fr\",\"en_GB\":\"error\\/error-en\",\"ar_SA\":\"error\\/error-ar\"}', '{\"_controller\":\"PiAppAdminBundle:Frontend:page\"}', '{\"_method\":\"get|post\"}'); 





INSERT INTO pi_widget (`id`, `block_id`, `plugin`, `action`, `is_cacheable`, `is_public`, `lifetime`, `config_css_class`, `config_xml`, `created_at`, `updated_at`, `archive_at`, `enabled`, `archived`, `position`) VALUES(1, NULL, 'content', '-', 1, 1, 86400, 'error', '<?xml version=\"1.0\"?>\n<config>\n	<widgets>\n		<user>\n			<controller>BootStrapUserBundle:User:_connexion_default</controller>\n			<params>\n				<template>FOSUserBundle:Security:login.html.twig</template>\n				<referer_redirection>true</referer_redirection>\n			</params>\n		</user>\n		<content>\n			<id></id>\n			<snippet>false</snippet>\n			<controller>TWITTER:tweets_blog</controller>\n			<params>\n				<cachable>true</cachable>\n				<template></template>\n				<enabledonly>true</enabledonly>\n			</params>\n			<media>\n				<format>default_small</format>\n				<align>right</align>\n				<class>maclass</class>\n				<link>MonImage</link>\n			</media>\n		</content>\n		<search>\n			<controller>LUCENE:search-lucene</controller>\n			<params>\n				<cachable>false</cachable>\n				<template>searchlucene-result.html.twig</template>\n				<MaxResults></MaxResults>\n				<lucene>\n					<action>renderDefault</action>\n					<menu>searchlucene</menu>\n					<searchBool>true</searchBool>\n					<searchBoolType>AND</searchBoolType>\n					<searchByMotif>true</searchByMotif>\n					<setMinPrefixLength>0</setMinPrefixLength>\n					<getResultSetLimit>0</getResultSetLimit>\n					<searchFields>\n						<sortField>Contents</sortField>\n						<sortType>SORT_STRING</sortType>\n						<sortOrder>SORT_ASC</sortOrder>\n					</searchFields>\n					<searchFields>\n						<sortField>Key</sortField>\n						<sortType>SORT_NUMERIC</sortType>\n						<sortOrder>SORT_DESC</sortOrder>\n					</searchFields>\n				</lucene>\n			</params>\n		</search>\n		<gedmo>\n			<id></id>\n			<snippet>false</snippet>\n			<controller>PiAppGedmoBundle:Activity:_template_list</controller>\n			<params>\n				<id></id>\n				<node></node>\n				<enabledonly>true</enabledonly>\n				<category></category>\n				<template></template>\n				<MaxResults></MaxResults>\n				<order>DESC</order>\n				<cachable>true</cachable>\n				<navigation>\n					<separatorClass>separateur</separatorClass>\n					<separatorText><![CDATA[ &ndash; ]]></separatorText>\n					<separatorFirst>false</separatorFirst>\n					<separatorLast>false</separatorLast>\n					<ulClass>infoCaption</ulClass>\n					<liClass>menuContainer</liClass>\n					<counter>true</counter>\n					<routeActifMenu>\n						<liActiveClass></liActiveClass>\n						<liInactiveClass></liInactiveClass>\n						<aActiveClass></aActiveClass>\n						<aInactiveClass></aInactiveClass>\n						<enabledonly>true</enabledonly>\n					</routeActifMenu>\n					<lvlActifMenu>\n						<liActiveClass></liActiveClass>\n						<liInactiveClass></liInactiveClass>\n						<aActiveClass></aActiveClass>\n						<aInactiveClass></aInactiveClass>\n						<enabledonly>true</enabledonly>\n					</lvlActifMenu>\n				</navigation>\n				<organigram>\n					<params>\n						<action>renderDefault</action>\n						<menu>organigram</menu>\n						<id>orga</id>\n					</params>\n					<fields>\n						<field>\n							<content>title</content>\n							<class>pi_tree_desc</class>\n						</field>\n						<field>\n							<content>descriptif</content>\n						</field>\n					</fields>\n				</organigram>\n				<slider>\n					<action>renderDefault</action>\n					<menu>entity</menu>\n					<id>flexslider</id>\n					<boucle_array>false</boucle_array>\n					<orderby_date></orderby_date>\n					<orderby_position>ASC</orderby_position>\n					<MaxResults>4</MaxResults>\n					<query_function>getAllAdherents</query_function>\n					<searchFields>\n                      	<nameField>field1</nameField>\n                      	<valueField>value1</valueField>\n                   </searchFields>\n					<searchFields>\n                      	<nameField>field2</nameField>\n                      	<valueField>value2</valueField>\n                   </searchFields>\n					<params>\n						<animation>slide</animation>\n						<direction>horizontal</slideDirection>\n						<slideshow>true</slideshow>\n						<redirection>false</redirection>\n						<startAt>0</slideToStart>\n						<slideshowSpeed>6000</slideshowSpeed>\n						<animationSpeed>800</animationDuration>\n						<directionNav>true</directionNav>\n						<pauseOnAction>false</pauseOnAction>\n						<pauseOnHover>true</pauseOnHover>\n						<pausePlay>true</pausePlay>\n						<controlNav>true</controlNav>\n						<minItems>1</minItems>\n						<maxItems>1</maxItems>\n					</params>\n				</slider>\n			</params>\n		</gedmo>\n	</widgets>\n	<advanced>\n		<roles>\n			<role>ROLE_VISITOR</role>\n			<role>ROLE_USER</role>\n			<role>ROLE_ADMIN</role>\n			<role>ROLE_SUPER_ADMIN</role>\n		</roles>\n	</advanced>\n</config>\n', '2013-03-15 10:42:13', '2013-03-15 10:42:13', NULL, 1, 0, NULL); 

INSERT INTO pi_widget_translation (`id`, `lang_code`, `widget_id`, `content`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(1, 'ar_SA', 1, 'القطعة غير موجودة!', '2013-03-15 10:42:22', '2013-03-15 10:42:22', NULL, NULL, 1, 0); 
INSERT INTO pi_widget_translation (`id`, `lang_code`, `widget_id`, `content`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(2, 'fr_FR', 1, 'Le widget n\'existe pas !', '2013-03-15 10:42:22', '2013-03-15 10:42:22', NULL, NULL, 1, 0); 
INSERT INTO pi_widget_translation (`id`, `lang_code`, `widget_id`, `content`, `created_at`, `updated_at`, `published_at`, `archive_at`, `enabled`, `archived`) VALUES(3, 'en_GB', 1, 'The widget doesn\'t exist !', '2013-03-15 10:42:22', '2013-03-15 10:42:22', NULL, NULL, 1, 0); 




SET FOREIGN_KEY_CHECKS=1; 
