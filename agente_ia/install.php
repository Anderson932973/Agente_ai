<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
if (!$CI->db->table_exists(db_prefix() . 'agente_iachat')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "agente_iachat` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `session_id` VARCHAR(255) NOT NULL,
        `staffid` INT(11) NOT NULL,
        `message` LONGTEXT NOT NULL,
        `datetime` DATETIME NOT NULL,
        `sender` ENUM('staff', 'ia') NOT NULL,
        `status` ENUM('sent', 'delivered', 'read', 'pending') DEFAULT 'sent',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
}

/**agente_iaai */
if (!$CI->db->table_exists(db_prefix() . 'agente_iaai')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "agente_iaai` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(128) NOT NULL,
        `description` TEXT NOT NULL,
        `agente` VARCHAR(128) NOT NULL,
        `modelo` VARCHAR(128) NOT NULL,
        `role` VARCHAR(128) NOT NULL,
        `content` LONGTEXT NOT NULL,
        `max_tokens` INT(11) NOT NULL DEFAULT 250,
        `temperature` FLOAT NOT NULL DEFAULT 0.2,
        `token` VARCHAR(255) NOT NULL,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `atuacao` ENUM('staff', 'client', 'all') DEFAULT 'all',
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
}

add_option('agente_ia_chat_staff', 1);
add_option('agente_ia_chat_client', 1);