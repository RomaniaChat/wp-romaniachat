<?php
		
/*
Plugin Name: Romania Chat
Plugin URI: https://wp.romaniachat.tk/
Description: Plugin de Wordpress pentru a pune un WebChat in Blogul/Wordpress RomaniaChat.eu
Author: RomaniaChat
Version: 1.3
Author URI: http://www.romaniachat.eu
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: romaniachat
*/

/*  Copyright 2017 Oscar BaiatRau <baiatrau.romaniachat@gmail.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'ROMANIACHAT_VERSION', '1.3' );

define( 'ROMANIA_CHAT', plugin_dir_path( __FILE__ ) );

define( 'ROMANIACHAT_URLBASE', 'http://irc.romaniachat.eu' );
define( 'RADIOCLICK_URLBASE', 'https://wp.romaniachat.tk/' );

if ( is_admin() ) {
    require_once( ROMANIA_CHAT . 'admin/admin.php' );
}
require_once( ROMANIA_CHAT . 'public/index.php' );


function romaniachat_plugin_links( $actions, $plugin_file ) {
    static $plugin;

    if ( !isset($plugin) )
        $plugin = plugin_basename(__FILE__);

    if ( $plugin == $plugin_file ) {
        $settings = array('settings' => '<a href="admin.php?page=romaniachat_settings_eu">Configurare</a>');
        $site_link = array('support' => '<a href="https://wp.romaniachat.tk" target="_blank">Suport</a>');
        $actions = array_merge($site_link, $actions);
        $actions = array_merge($settings, $actions);
    }
    return $actions;
}

add_filter( 'plugin_action_links', 'romaniachat_plugin_links', 10, 5 );

/* Am setat valorile implicite */
function romaniachat_set_defaults()
{
    $config = array(
        'romaniachat_nick'      => 'RomaniaChat_?',
        'romaniachat_chan'      => '#Romania,#RadioClick',
        'romaniachat_style'     => '',
        'romaniachat_conectare' => '1',
        'romaniachat_height'    => '500',
        'romaniachat_width'     => '100%',
		'radioclick_pozitie'    => 'center',
    );

    foreach ( $config as $key => $value )
    {
        if (!get_option($key)) {
            update_option($key, $value);
        }
    }
}

register_activation_hook( __FILE__, 'romaniachat_set_defaults');

?>