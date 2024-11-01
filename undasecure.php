<?php
/*
Plugin Name: UndaSecure
Plugin URI: https://www.undanet.com/
Description: Plugin de Securización y Optimización de WP de Grupo Undanet
Author: Adrián Santos
Version: 1.2.16
*/

if (!defined('ABSPATH')) exit;

define('UNDASECURE_PLUGIN_PATH', __DIR__);

require_once "class/UndaSecure.php";

register_activation_hook(__FILE__, 'UndaSecure_Activation');

register_deactivation_hook(__FILE__, 'UndaSecure_Deactivation');

add_action('upgrader_process_complete', 'UndaSecure_Update', 10, 2);

add_filter('the_generator', '__return_empty_string');
add_filter('script_loader_src', 'UndaSecure_Remove_Version');
add_filter('style_loader_src', 'UndaSecure_Remove_Version');


function UndaSecure_Activation()
{
    $undaSecure = new UndaSecure();
    $undaSecure->activate();
}

function UndaSecure_Deactivation()
{
    $undaSecure = new UndaSecure();
    $undaSecure->deactivate();
}


function UndaSecure_Update($upgrader_object, $options)
{
    $undaSecure = new UndaSecure();
    $undaSecure->update($options, plugin_basename(__FILE__));
}


function UndaSecure_Remove_Version($src)
{
    $src = remove_query_arg('ver', $src);
    return $src;
}