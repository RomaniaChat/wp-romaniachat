<?php

/*
Plugin Name: Romania Chat
Plugin URI: https://wp.romaniachat.eu
Description: Integrează serviciul de Chat al retelei de IRC RomaniaChat in WordPress. 
Author: RomaniaChat
Version: 2.2
Author URI: http://wp.romaniachat.eu
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-romaniachat
*/

if (!defined('ABSPATH')) exit;

define('ROMANIACHAT_VERSION', '2.2');
define('ROMANIA_CHAT', plugin_dir_path(__FILE__));
define('ROMANIACHAT_URLBASE', 'https://chat.romaniachat.eu');

if (is_admin()) {
    require_once ROMANIA_CHAT . 'admin/admin.php';
}
require_once ROMANIA_CHAT . 'public/index.php';

/* Links plugin */
function romaniachat_plugin_links($actions) {
    $actions[] = '<a href="admin.php?page=romaniachat_settings_eu">Configurar</a>';
    return $actions;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'romaniachat_plugin_links');

/* Defaults */
function romaniachat_set_defaults() {
    $defaults = [
        'romaniachat_server' => 'https://chat.romaniachat.eu',
        'romaniachat_nick'   => 'RomaniaChat_?',
        'romaniachat_style'  => 'radioclick',
        'romaniachat_chan'   => '#Romania,#RadioClick,#Trivia',
        'romaniachat_height' => '500',
        'romaniachat_width'  => '100%',
    ];

    foreach ($defaults as $k => $v) {
        if (get_option($k) === false) {
            update_option($k, sanitize_text_field($v));
        }
    }
}
register_activation_hook(__FILE__, 'romaniachat_set_defaults');