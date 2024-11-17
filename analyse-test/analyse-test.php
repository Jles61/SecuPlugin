<?php
/*
Plugin Name: Analyse Test
Description: Adds a custom page to wp-admin for plugin analysis and a button to analyze plugins on the install page.
Version: 2.1
Author: Jules HENRIETTE
*/

// Includes
include_once plugin_dir_path(__FILE__) . 'includes/analyse-admin.php';
include_once plugin_dir_path(__FILE__) . 'includes/analyse-ajax.php';
include_once plugin_dir_path(__FILE__) . 'includes/analyse-utilities.php';

// Hooks
add_action('admin_menu', 'analyse_plugin_add_menu');
add_action('admin_enqueue_scripts', 'analyse_plugin_enqueue_script');

add_action('admin_enqueue_scripts', 'enqueue_version_script');

add_action('wp_ajax_delete_plugin_info', 'analyse_plugin_delete_info');
add_action('wp_ajax_save_plugin_info', 'analyse_plugin_save_info');

