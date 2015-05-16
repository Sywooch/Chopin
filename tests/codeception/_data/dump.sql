CREATE TABLE IF NOT EXISTS `achievement` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reward` int(11) DEFAULT NULL,
  `repeatable` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `achievement` (`id`, `name`, `reward`, `repeatable`, `created_at`, `updated_at`) VALUES
(1, 'Asistencia', 11, 1, 1392559490, 1392559490);

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1429314057),
('m130524_201442_init', 1429314070),
('m150424_212243_create_table_people', 1429973204),
('m150428_010852_add_achievement_tables', 1430187057),
('m150428_034436_person_achievement', 1430358667),
('m150501_162800_rewards_to_integers', 1431653493),
('m150505_014148_user_as_person', 1431653494);

CREATE TABLE IF NOT EXISTS `person` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `person` (`id`, `name`, `surname`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Alice', 'Smith', 'alice@email.com', 1392559490, 1392559490),
(2, 'Bob', 'Dow', 'bob@email.com', 1431653493, 1431655315),
(3, 'Eve', 'Dow', 'eve@email.com', 1431653493, 1431655315),
(4, 'Dany', 'Dow', 'dany@email.com', 1431653493, 1431655315),
(5, 'Luke', 'Dow', 'luke@email.com', 1431653493, 1431655315),
(6, 'Frank', 'Dow', 'frank@email.com', 1431653493, 1431655315);

CREATE TABLE IF NOT EXISTS `person_achievement` (
`id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `achievement_id` int(11) NOT NULL,
  `reward` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `person_achievement` (`id`, `person_id`, `achievement_id`, `reward`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 46, '2015-04-29 00:00:00', 1392559490, 1392559490);

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `person_id`) VALUES
(1, 'alice', 'tUu1qHcde0diwUol3xeI-18MuHkkprQI', '$2y$13$nJ1WDlBaGcbCdbNC5.5l4.sgy.OMEKCqtDQOdQ2OWpgiKRWYyzzne', 'RkD_Jw0_8HEedzLk7MM-ZKEFfYR7VbMr_1392559490', 10, 1392559490, 1431655315, 1);

ALTER TABLE `achievement`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

ALTER TABLE `person`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `person_achievement`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_person_achievement_person` (`person_id`), ADD KEY `fk_person_achievement_achievement` (`achievement_id`);

ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `achievement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `person`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `person_achievement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `person_achievement`
ADD CONSTRAINT `fk_person_achievement_achievement` FOREIGN KEY (`achievement_id`) REFERENCES `achievement` (`id`),
ADD CONSTRAINT `fk_person_achievement_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);
