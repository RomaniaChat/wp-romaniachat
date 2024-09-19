<?php

if ( !defined( 'ABSPATH' ) ) exit;
/**
* Function that generates an entry in the Administration menu
* @since  1.0
*/
function romaniachat_plugin_menu() {
    add_menu_page(
		'Configurare RomaniaChat',             // page title
        'RomaniaChat',                         // menu title
        'administrator',                       // capability role with permissions
        'romaniachat_settings',                // slug
        'romaniachat_settingspage',            // callback function
	plugins_url('img/rcr.png', dirname( __FILE__ ) ), // icon URL
        60                                     // menu position
        );

    add_submenu_page('romaniachat_settings',
        'Configuracion',
        'Informati',                          // submenu title
        'administrator',                      // capability role with permissions
        'romaniachat_settings',               // slug
        'romaniachat_settingspage');          // callback function

    add_submenu_page('romaniachat_settings',
        'Configuracion',
        'Setarii',                            // submenu title
        'administrator',                      // capability role with permissions
        'romaniachat_settings_eu',            // slug
        'romaniachat_settingspage_eu');       // callback function

}

add_action('admin_menu', 'romaniachat_plugin_menu');

/**
 * Function that records the values from the internal DB
 * @since  1.0
 */
function romaniachat_settings() {
	
	register_setting('romaniachat-eu',
                     'romaniachat_nick');
    register_setting('romaniachat-eu',
                     'romaniachat_server');
    register_setting('romaniachat-eu',
                     'romaniachat_chan');
    register_setting('romaniachat-eu',
                     'romaniachat_style');
    register_setting('romaniachat-eu',
                     'romaniachat_height');
    register_setting('romaniachat-eu',
                     'romaniachat_width');
}

add_action('admin_init', 'romaniachat_settings');

/**
 * filter versin echo
 * @since  2.0
 */
add_filter( 'wp_romaniachat', 'wp_romaniachat_version' );
function wp_romaniachat_version( $arg = '' ) {
    return '2.0';
}

/**
 * Function that renders the main configuration page
 * info wp romaniachat
 * @since  1.0
 */
function romaniachat_settingspage() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
?>

    <div class="wrap">
        <h2>Informati WordPress Plugin RomaniaChat</h2>
        <p>Pluginul RomaniaChat pentru WordPress va permite sa utilizati in pagina dvs de web wordpress, servicile pe care reteaua <a href="https://romaniachat.eu/" target="_blank"><strong>RomaniaChat</strong></a> le ofera pentru webmasteri.</p>
		<p>WebChat complet adaptabil la dimensiunea ecranului pe care este afisat, modificand utilitatea sa pentru a fi mai usor de utilizat.</p>
        <div class="card pressthis">
            <h3>Instructiuni de utilizare</h3>
            <p>Introduceti urmatorul cod intr-o pagina:</p>
            <h4>[romaniachat]</h4>
            <p>Puteti specifica canalul pentru o anumita pagina in loc sa utilizati canalul implicit configurat cu:</p>
            <h4>[romaniachat chan=#Romania]</h4>
            <br/>
        </div>
        <div class="card pressthis">
        <p>Pentru mai multe documentatii despre utilizare si configurare <a href="https://wp.romaniachat.eu" target="_blank" title="Documentatie">Click Aici.</p>
        <br>
		<div class="actions alignleft"><a href="admin.php?page=romaniachat_settings_eu" title="Settings"><button>Setari WP RomaniaChat</button></a></div>
			<br>
			<br>
			Rulati Versiunea RomaniaChat<?php echo apply_filters( 'wp_romaniachat', '' ); ?>
        </div>
    </div>
<?php
}

/**
 * Function that renders the main configuration page
 * config wp romaniachat
 * @since  2.0
 */
function romaniachat_settingspage_eu() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    //Error message
    if (isset($_GET['settings-updated'])) {
        add_settings_error('rcr_messages', 'rcr_message_ok', ('Updated values'), 'updated');
    }
    if (isset($_GET['settings-error'])) {
        add_settings_error('rcr_messages', 'rcr_message_error', ('An error occurred while saving'), 'error');
    }

    settings_errors('rcr_messages');
?>

    <div class="wrap">
        <h2>Configurare WP RomaniaChat</h2>
        <h3>Din aceasta sectiune puteti configura comportamentul WebChat-ului WP RomaniaChat.</h3>
        <form method="POST" action="options.php">
            <?php
                settings_fields('romaniachat-eu');
                do_settings_sections('romaniachat-eu');
            ?>
   <table width="100%" border="0">
	<tr>
    <td><strong><?php esc_html_e("Nick Sugestie:" ); ?></strong></td>
    <td><input type="text" id="romaniachat_nick" name="romaniachat_nick" value="<?php echo esc_attr( get_option('romaniachat_nick') ); ?>" size="21"></td>
    <td><em>
	<?php esc_html_e('Nick implicit pentru oaspetii camerei dvs de chat. (Inplicit este RomaniaChat_? unde ? este inlocuit cu 3-numere aleatoriu)', 'wp-romaniachat'); ?></em></td>
  </tr>
    <tr>
    <td><strong><?php esc_html_e("Numele Canalului:" ); ?></strong></td>
    <td><input type="text" name="romaniachat_chan"  value="<?php echo esc_attr( get_option('romaniachat_chan') ); ?>" size="21"></td>
    <td><em>
	<?php esc_html_e('Numele camerei de chat. (Implicit este #Romania,#RadioClick,#Trivia)', 'wp-romaniachat'); ?></em></td>
  </tr>					
  <tr>
    <td><strong><?php esc_html_e("Tema Stilul:" ); ?></strong></td>
    <td><select name="romaniachat_style"
	            id="romaniachat_style">
	           <option value="default" <?php selected(get_option('romaniachat_style'), "default"); ?>>Default</option>
               <option value="osprey" <?php selected(get_option('romaniachat_style'), "osprey"); ?>>Osprey</option>
               <option value="radioactive" <?php selected(get_option('romaniachat_style'), "radioactive"); ?>>Radioactive</option>
               <option value="dark" <?php selected(get_option('romaniachat_style'), "dark"); ?>>Dark</option>
               <option value="nightswatch" <?php selected(get_option('romaniachat_style'), "nightswatch"); ?>>Nightswatch</option>
			   <option value="sky" <?php selected(get_option('romaniachat_style'), "sky"); ?>>Sky</option>
			   <option value="coffee" <?php selected(get_option('romaniachat_style'), "coffee"); ?>>Coffee</option>
			   <option value="grayfox" <?php selected(get_option('romaniachat_style'), "grayfox"); ?>>GrayFox</option>
        </select>
		<td><em>
		<?php esc_html_e('Stilul de culoare al camerei de chat. (Implicit este Default)', 'wp-romaniachat'); ?></em></td>
  </tr> 
	<tr>
    <td><strong><?php esc_html_e("Latime:" ); ?></strong></td>
    <td><input type="text" 
	name="romaniachat_width"
	id="romaniachat_width"
	value="<?php echo esc_attr( get_option('romaniachat_width') ); ?>" size="10"></td>
    <td><em>
	<?php esc_html_e('Latimea camerei de chat. (Implicit este 100%)', 'wp-romaniachat'); ?></em></td>
  </tr>
   <tr>
    <td><strong><?php esc_html_e("Inaltime:" ); ?></strong></td>
    <td><input type="text"
	name="romaniachat_height"
	id="romaniachat_height"
    value="<?php echo esc_attr( get_option('romaniachat_height') ); ?>" size="10"></td>
    <td><em>
	<?php esc_html_e('Inaltimea camerei de chat. (Implicit este 500)', 'wp-romaniachat'); ?></em></td>
  </tr>
<br/>				
</table>		
        <p style="font-weight: bold;">
		<?php esc_html_e('NOTA: Preferintele utilizatorilor vor avea intotdeauna prioritate fata de aceasta configuratie. De exemplu, daca un utilizator configureaza ca o anumita porecla este utilizata si un anumit canal este accesat, configuratia respectiva va avea intotdeauna prioritate fata de cea a acestei configuratii, deci va intra in canalul indicat in configuratie.', 'wp-romaniachat'); ?></p>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>