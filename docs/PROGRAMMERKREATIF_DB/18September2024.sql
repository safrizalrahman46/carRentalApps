-- Adminer 4.8.1 MySQL 5.5.5-10.11.6-MariaDB-0+deb12u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `additional_services`;
CREATE TABLE `additional_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `additional_services` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1,	'GPS Navigation',	50000.00,	NULL,	NULL),
(2,	'Child Seat',	75000.00,	NULL,	NULL),
(3,	'Additional Driver',	100000.00,	NULL,	NULL);

DROP TABLE IF EXISTS `area_zones`;
CREATE TABLE `area_zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(100) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `area_zones` (`id`, `zone_name`, `rate`, `created_at`, `updated_at`) VALUES
(1,	'Zone A',	100000.00,	NULL,	NULL),
(2,	'Zone B',	150000.00,	NULL,	NULL),
(3,	'Zone C',	200000.00,	NULL,	NULL);

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_booking` varchar(255) NOT NULL,
  `booking_group_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `car_id` int(11) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` enum('booked','completed','canceled') NOT NULL DEFAULT 'booked',
  `booking_duration` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `total_deposit` double DEFAULT NULL,
  `total_payment` double DEFAULT NULL,
  `total_additional_price` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bookings` (`id`, `code_booking`, `booking_group_id`, `user_id`, `car_id`, `pickup_location`, `dropoff_location`, `start_datetime`, `end_datetime`, `status`, `booking_duration`, `total_price`, `total_deposit`, `total_payment`, `total_additional_price`, `created_at`, `updated_at`) VALUES
(1,	'112',	2,	2,	2,	'ss',	'fdf',	'2024-09-14 16:19:00',	'2024-09-16 16:19:00',	'booked',	13,	NULL,	NULL,	NULL,	NULL,	'2024-09-14 09:19:37',	'2024-09-15 02:31:12'),
(2,	'11',	NULL,	3,	1,	'sa',	'dd',	'2024-09-14 17:10:00',	'2024-09-14 17:15:00',	'booked',	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-09-14 10:10:22',	'2024-09-14 10:10:22');

DROP TABLE IF EXISTS `booking_deposits`;
CREATE TABLE `booking_deposits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `status` enum('held','returned','deducted') DEFAULT 'held',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `booking_services`;
CREATE TABLE `booking_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `additional_service_id` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) DEFAULT NULL,
  `car_name` varchar(255) NOT NULL,
  `transmision` enum('Automatic','Manual') DEFAULT NULL,
  `buy_year` year(4) DEFAULT NULL,
  `seat` int(255) DEFAULT NULL,
  `type` enum('self_drive','with_driver') NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `price_per_km` decimal(10,2) NOT NULL,
  `price_per_area` decimal(10,2) NOT NULL,
  `availability_start_time` time NOT NULL,
  `availability_end_time` time NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_available` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cars` (`id`, `brand`, `car_name`, `transmision`, `buy_year`, `seat`, `type`, `capacity`, `price_per_day`, `price_per_km`, `price_per_area`, `availability_start_time`, `availability_end_time`, `photo`, `is_available`, `created_at`, `updated_at`) VALUES
(1,	NULL,	's',	NULL,	NULL,	NULL,	'self_drive',	5,	22.00,	22.00,	22.00,	'00:00:22',	'00:00:22',	NULL,	'ya',	'2024-09-13 02:34:58',	'2024-09-13 02:34:58'),
(2,	NULL,	'ss',	NULL,	NULL,	NULL,	'self_drive',	11,	11.00,	1.00,	1.00,	'20:57:00',	'20:59:00',	NULL,	'Not_Available',	'2024-09-13 13:55:11',	'2024-09-13 13:55:11');

DROP TABLE IF EXISTS `car_availability`;
CREATE TABLE `car_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `status` enum('available','booked') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `buffer_time` int(11) DEFAULT 120,
  PRIMARY KEY (`id`),
  KEY `fk_car_availability_car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `car_availability` (`id`, `car_id`, `start_datetime`, `end_datetime`, `status`, `created_at`, `updated_at`, `buffer_time`) VALUES
(1,	1,	'2024-09-13 09:35:00',	'2024-09-14 09:35:00',	'booked',	NULL,	NULL,	120),
(2,	1,	'2024-09-20 18:16:00',	'2024-09-20 15:16:00',	'available',	NULL,	NULL,	120),
(3,	2,	'2024-09-20 09:19:00',	'2024-10-03 09:19:00',	'available',	NULL,	NULL,	130);

DROP TABLE IF EXISTS `delivery_pickup_charges`;
CREATE TABLE `delivery_pickup_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pickup_location` varchar(255) DEFAULT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `charge` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `delivery_pickup_charges` (`id`, `pickup_location`, `dropoff_location`, `charge`, `created_at`, `updated_at`) VALUES
(1,	'Jakarta',	'Bandung',	300000.00,	NULL,	NULL),
(2,	'Jakarta',	'Bogor',	150000.00,	NULL,	NULL),
(3,	'Jakarta',	'Bekasi',	100000.00,	NULL,	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`, `created_at`, `updated_at`) VALUES
(1,	'a1b2c3d4',	'database',	'default',	'{}',	'Some exception message',	'2024-09-12 06:10:46',	NULL,	NULL);

DROP TABLE IF EXISTS `manage_bookings`;
CREATE TABLE `manage_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `status` enum('confirmed','canceled','completed') NOT NULL,
  `notes` text DEFAULT NULL,
  `processed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manage_bookings_ibfk_1` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `manage_bookings` (`id`, `booking_id`, `status`, `notes`, `processed_at`, `created_at`, `updated_at`) VALUES
(3,	2,	'confirmed',	'ssdd',	'2024-09-14 10:42:23',	NULL,	NULL);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2016_08_03_072729_create_provinces_table',	2),
(6,	'2016_08_03_072750_create_cities_table',	2),
(7,	'2016_08_03_072804_create_districts_table',	2),
(8,	'2016_08_03_072819_create_villages_table',	2),
(9,	'2024_09_15_053933_create_provinces_table',	3);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('user@example.com',	'reset-token-123',	'2024-09-12 06:10:46');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\User',	1,	'API Token',	'token-xyz',	'[\"*\"]',	'2024-09-12 06:10:46',	NULL,	'2024-09-12 06:10:46',	'2024-09-12 06:10:46');

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `rental_rates`;
CREATE TABLE `rental_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `daily_rate` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `season` enum('high','low') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rental_rates` (`id`, `car_id`, `date`, `daily_rate`, `created_at`, `updated_at`, `season`) VALUES
(4,	1,	'2024-09-14',	222.00,	NULL,	NULL,	NULL),
(5,	2,	'2024-09-16',	22.00,	NULL,	NULL,	'high');

DROP TABLE IF EXISTS `tour_packages`;
CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `package_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tour_packages` (`id`, `photo`, `package_name`, `description`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'gfgf',	'vhvh',	20000.00,	'23',	'2024-09-15 03:22:00',	'2024-09-15 03:22:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','agent') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `points` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `points`) VALUES
(1,	'Admin',	'admin@gmail.com',	'$2y$12$DmCVAQCHJfKjMUWv/y80g.5LnE2lstzD0tjFyQecGzByp0Wu5wxQK',	'user',	'2024-09-13 03:17:53',	'2024-09-16 08:48:49',	0),
(2,	'agent',	'agent@gmail.com',	'$2y$12$DmCVAQCHJfKjMUWv/y80g.5LnE2lstzD0tjFyQecGzByp0Wu5wxQK',	'user',	'2024-09-13 03:17:53',	'2024-09-16 08:48:54',	0),
(3,	'user',	'user@gmail.com',	'$2y$12$DmCVAQCHJfKjMUWv/y80g.5LnE2lstzD0tjFyQecGzByp0Wu5wxQK',	'user',	'2024-09-13 03:17:53',	'2024-09-16 08:48:58',	0);

DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `regency_city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `domicile_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2024-09-18 18:50:50