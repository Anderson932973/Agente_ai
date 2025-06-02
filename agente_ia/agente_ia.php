<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Agente de I.A.s
Description: Agentes de I.A para Perfex CRM
Version: 1.0.0
Requires at least: 3.0.0
Author: Liquida SP
Author URI: https://liquidasp.com.br
*/

define('AGENTE_IA_MODULE_NAME', 'agente_ia');
update_option('module_agente_ia_prodid', 58);

/**
 * Register activation module hook
 */
register_activation_hook(AGENTE_IA_MODULE_NAME, 'agente_ia_activation_hook');
function agente_ia_activation_hook()
{
    require_once(__DIR__ . '/install.php');
}
$CI = &get_instance();


function agente_ia_init_menu_items()
{
    if (is_admin()) {
        $CI = &get_instance();
        /**
         * If the logged in user is administrator, add custom menu in Setup
         */
        $CI->app_menu->add_setup_menu_item('agente_ia', [
            'slug'     => 'agente_ia',
            'name'     => _l('agente_ia_builder'),
            'position' => 65,
        ]);

        /**AI */
        $CI->app_menu->add_setup_children_item('agente_ia', [
            'slug'     => 'agente_ia',
            'href'     => admin_url('agente_ia'),
            'name'     => _l('agente_ia_builder_list'),
            'position' => 65,
        ]);
    }
}
hooks()->add_action('admin_init', 'agente_ia_init_menu_items');

// $CI->load->library(AGENTE_IA_MODULE_NAME.'/Agente_i_a');
// echo "<pre>";
// $resposta = $CI->agente_i_a->gpt('Que dia é hoje?');
// echo $resposta;
// exit;

$CI->load->helper(AGENTE_IA_MODULE_NAME . '/agente_ia');

register_language_files(AGENTE_IA_MODULE_NAME, [AGENTE_IA_MODULE_NAME]);