-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;

SET time_zone = '+00:00';

SET foreign_key_checks = 0;

SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `additional_request`;

CREATE TABLE `additional_request` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) DEFAULT NULL,
    `additional_price` double DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `car`;

CREATE TABLE `car` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `rent_type_id` int(11) DEFAULT NULL,
    `price_per_day` double DEFAULT NULL,
    `machine_capacity` int(11) DEFAULT NULL,
    `seat` int(11) DEFAULT NULL,
    `brand` varchar(255) DEFAULT NULL,
    `car_identity` varchar(255) DEFAULT NULL,
    `transmition` enum('Automatic', 'Manual') DEFAULT NULL,
    `fuel` enum('Bensin', 'Solar') DEFAULT NULL,
    `buy_year` year(4) DEFAULT NULL,
    `photo` varchar(255) DEFAULT NULL,
    `status` enum('Booked', 'Available') DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `car_status`;

CREATE TABLE `car_status` (
    `id` int(11) NOT NULL,
    `car_id` int(11) DEFAULT NULL,
    `status` enum(
        'Booked',
        'Available',
        'Clean and maintanable'
    ) DEFAULT NULL,
    `active` int(11) DEFAULT NULL,
    `pickup_date` datetime DEFAULT NULL,
    `return_date` datetime DEFAULT NULL,
    `actual_return_date` datetime DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `driver`;

CREATE TABLE `driver` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(150) DEFAULT NULL,
    `sim_number` varchar(100) DEFAULT NULL,
    `photo` varchar(255) DEFAULT NULL,
    `domicile` varchar(100) DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
    `id` int(11) DEFAULT NULL,
    `car_id` int(11) DEFAULT NULL,
    `user_id` int(11) DEFAULT NULL,
    `pickup_date` datetime DEFAULT NULL,
    `pickup_location` varchar(255) DEFAULT NULL,
    `return_date` datetime DEFAULT NULL,
    `return_location` varchar(255) DEFAULT NULL,
    `total_day` int(11) DEFAULT NULL,
    `price` double DEFAULT NULL,
    `deposit` double DEFAULT NULL,
    `total_payment` double DEFAULT NULL,
    `total_price` double DEFAULT NULL,
    `total_deposit` double DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `order_detail`;

CREATE TABLE `order_detail` (
    `id` int(11) NOT NULL,
    `order_id` int(11) DEFAULT NULL,
    `additiona_request` int(11) DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `pricing_type`;

CREATE TABLE `pricing_type` (
    `id` int(11) NOT NULL,
    `type` enum('Perkm', 'Perarea') DEFAULT NULL,
    `price` double DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `reminder`;

CREATE TABLE `reminder` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `date` date NOT NULL,
    `status_send` varchar(11) NOT NULL,
    `description` longtext NOT NULL,
    `type` enum(
        'Notification',
        'Final Notification'
    ) DEFAULT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `reminder` (
        `id`,
        `user_id`,
        `date`,
        `status_send`,
        `description`,
        `type`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        '2024-07-27',
        'waiting',
        '',
        'Notification',
        '2024-07-27 20:44:55',
        '2024-07-27 20:44:55'
    ),
    (
        2,
        1,
        '2024-09-27',
        'waiting',
        '',
        'Notification',
        '2024-07-27 20:44:55',
        '2024-07-27 20:44:55'
    ),
    (
        3,
        1,
        '2024-10-12',
        'waiting',
        '',
        'Notification',
        '2024-07-27 20:44:55',
        '2024-07-27 20:44:55'
    ),
    (
        4,
        1,
        '2024-10-27',
        'waiting',
        '',
        'Final Notification',
        '2024-07-27 20:44:55',
        '2024-07-27 20:44:55'
    ),
    (
        5,
        2,
        '2024-07-30',
        'sent',
        'Hi, Sulaiman Ayo, tingkatkan order anda, target order anda sampai October adalah 50 order Royalaura.com',
        'Notification',
        '2024-07-30 04:48:38',
        '2024-07-30 04:48:38'
    ),
    (
        6,
        2,
        '2024-09-30',
        'waiting',
        '',
        'Notification',
        '2024-07-30 04:48:38',
        '2024-07-30 04:48:38'
    ),
    (
        7,
        2,
        '2024-10-15',
        'waiting',
        '',
        'Notification',
        '2024-07-30 04:48:38',
        '2024-07-30 04:48:38'
    ),
    (
        8,
        2,
        '2024-07-30',
        'sent',
        'Hi, Sulaiman Maaf anda tidak mencapat target adalah 50 order selama periode July - October Akun anda terpaksa kami banned Royalaura.com',
        'Final Notification',
        '2024-07-30 04:48:38',
        '2024-07-30 04:48:38'
    );

DROP TABLE IF EXISTS `rent_type`;

CREATE TABLE `rent_type` (
    `id` int(11) NOT NULL,
    `rent_type` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- 2024-09-16 07:25:50