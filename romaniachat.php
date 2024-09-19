<?php
		
/*
Plugin Name: Romania Chat
Plugin URI: https://wp.romaniachat.eu
Description: Integrati serviciile retelei IRC RomaniaChat.Eu in WordPress 
Author: RomaniaChat
Version: 2.0
Author URI: http://www.romaniachat.eu
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-romaniachat
*/

define( 'ROMANIACHAT_VERSION', '2.0' );
define( 'ROMANIA_CHAT', plugin_dir_path( __FILE__ ) );
define( 'ROMANIACHAT_URLBASE', 'https://kiwi.romaniachat.eu' ); 

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
        $site_link = array('support' => '<a href="https://wp.romaniachat.eu" target="_blank">Suport</a>');
        $actions = array_merge($site_link, $actions);
        $actions = array_merge($settings, $actions);
    }
    return $actions;
}

add_filter( 'plugin_action_links', 'romaniachat_plugin_links', 10, 5 );

/** I set the default values */
function romaniachat_set_defaults()
{
      $config = array(
	    'romaniachat_server'    => 'https://kiwi.romaniachat.eu:8443',
        'romaniachat_nick'      => 'RomaniaChat?',
        'romaniachat_style'     => 'osprey',
        'romaniachat_chan'      => '#Romania,#RadioClick,#Trivia',
        'romaniachat_height'    => '500',
        'romaniachat_width'     => '100%',
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