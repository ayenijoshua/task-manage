
DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` ENUM('completed','in-progress','not-started') NOT NULL,
  `created_at` timestamp COLLATE utf8mb4_unicode_ci NULL,
  `updated_at` timestamp COLLATE utf8mb4_unicode_ci NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp COLLATE utf8mb4_unicode_ci NULL,
  `updated_at` timestamp COLLATE utf8mb4_unicode_ci NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp COLLATE utf8mb4_unicode_ci NULL,
  `updated_at` timestamp COLLATE utf8mb4_unicode_ci NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;