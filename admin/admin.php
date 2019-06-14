<?php
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Functie care genereaza o intrare in meniul Administrare
 */
function romaniachat_plugin_menu() {
    add_menu_page('Configurare RomaniaChat', //Titlul pagini
        'RomaniaChat',                        //Titlul meniu
        'administrator',                      //Rol cu permisiuni
        'romaniachat_settings',                //Id de la pagina
        'romaniachat_settingspage',            //Functia de redare
        plugins_url('wp-romaniachat/img/rcr.png'), //Icon
        60                                     //Pozitie
        );

    add_submenu_page('romaniachat_settings',
        'Configuracion',
        'Informati',
        'administrator',                      //Rol cu permisiuni
        'romaniachat_settings',               //Id de la pagina
        'romaniachat_settingspage');          //Functia de redare

    add_submenu_page('romaniachat_settings',
        'Configuracion',
        'Setarii',
        'administrator',                      //Rol cu permisiuni
        'romaniachat_settings_eu',       //Id de la pagina
        'romaniachat_settingspage_eu');  //Functia de redare

}

add_action('admin_menu', 'romaniachat_plugin_menu');

/*
 * Functie care inregistreaza valorile din DB intern
 */
function romaniachat_settings() {

    register_setting('romaniachat-eu',
                     'romaniachat_nick');
    register_setting('romaniachat-eu',
                     'romaniachat_chan');
    register_setting('romaniachat-eu',
                     'romaniachat_style');
    register_setting('romaniachat-eu',
                     'romaniachat_conectare');
    register_setting('romaniachat-eu',
                     'romaniachat_height');
    register_setting('romaniachat-eu',
                     'romaniachat_width');	
					 
    register_setting('romaniachat-eu',
                     'radioclick_pozitie');
}

add_action('admin_init', 'romaniachat_settings');


/*
 * Functie care reda pagina principala de configurare
 */
function romaniachat_settingspage() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
?>

    <div class="wrap">
        <h2>Informati RomaniaChat WordPress Plugin</h2>
        <p>Pluginul RomaniaChat pentru WordPress va permite sa utilizati in pagina dvs de web wordpress, servicile pe care reteaua RomaniaChat le ofera pentru webmasteri.</p>
        <p>Un WebChat pe baza qwebirc</p>
		<p>Webchat complet adaptabil la dimensiunea ecranului pe care este afisat, modificand utilitatea sa pentru a fi mai usor de utilizat.</p>
		<p>Acesta include caracteristici cum ar fi Html5 Audio SHOUTcast RadioClick Player</p>
        <div class="card pressthis">
            <h3>Instructiuni de utilizare</h3>
            <p>Introduceti urmatorul cod intr-o pagina:</p>
            <h4>[romaniachat]</h4>
            <p>Puteti specifica canalul pentru o anumita pagina in loc sa utilizati canalul implicit configurat cu:</p>
            <h4>[romaniachat chan=#Romania]</h4>
            <br/>
        </div>
		<div class="card pressthis">
            <h3>Html5 Audio SHOUTcast RadioClick Player</h3>
            <p>Introduceti urmatorul cod intr-o pagina:</p>
            <h4>[romaniachat] [radioclick]</h4>
            <br/>
        </div>
	        <div class="card pressthis">
        <p>Pentru mai multe documentatii despre utilizare si configurare <a href="https://wp.romaniachat.tk/" target="_blank" title="Documentatie">Click Aici.</p>
        <br/>
        </div>
    </div>
<?php
}


/*
 * Functie care reda pagina principala de configurare
 */
function romaniachat_settingspage_eu() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    //Mesaj de eroare
    if (isset($_GET['settings-updated'])) {
        add_settings_error('rcr_messages', 'rcr_message_ok', ('Valorile actualizate'), 'updated');
    }
    if (isset($_GET['settings-error'])) {
        add_settings_error('rcr_messages', 'rcr_message_error', ('A aparut o eroare la salvare'), 'error');
    }

    settings_errors('rcr_messages');
?>

    <div class="wrap">
        <h1>Configurare RomaniaChat</h1>
        <p>Din aceasta sectiune puteti configura comportamentul WebChat-ului RomaniaChat.</p>
        <form method="POST" action="options.php">
            <?php
                settings_fields('romaniachat-eu');
                do_settings_sections('romaniachat-eu');
            ?>
   <table width="100%" border="0">

	<tr>
    <td><strong><?php _e("Nick Sugestie:" ); ?></strong></td>
    <td><input type="text" id="romaniachat_nick" name="romaniachat_nick" value="<?php echo get_option('romaniachat_nick'); ?>" size="25"></td>
    <td><em>Nick implicit pentru oaspetii camerei dvs de chat. (Inplicit este RomaniaChat_?) [? este inlocuit cu 5-numere aleatoriu]</em></td>
  </tr>
  
    <tr>
    <td><strong><?php _e("Numele Canalului:" ); ?></strong></td>
    <td><input type="text" name="romaniachat_chan"  value="<?php echo get_option('romaniachat_chan'); ?>" size="25"></td>
    <td><em>Numele camerei de chat. (Implicit este #Romania & #RadioClick)</em></td>
  </tr>
						
  <tr>
    <td><strong><?php _e("Tema Stilul:" ); ?></strong></td>
    <td><select name="romaniachat_style"
	            id="romaniachat_style">
	           <option value="MT1mYWxzZSYxMT0xOTU3b" <?php selected(get_option('romaniachat_style'), "MT1mYWxzZSYxMT0xOTU3b"); ?>>Albastru</option>
               <option value="MTE9MA4c" <?php selected(get_option('romaniachat_style'), "MTE9MA4c"); ?>>Rosu</option>
               <option value="MT1mYWxzZSYxMT0xMTMff" <?php selected(get_option('romaniachat_style'), "MT1mYWxzZSYxMT0xMTMff"); ?>>Verde</option>
               <option value="MTE9MjU207" <?php selected(get_option('romaniachat_style'), "MTE9MjU207"); ?>>Lila</option>
               <option value="MTE9NTE3a" <?php selected(get_option('romaniachat_style'), "MTE9NTE3a"); ?>>Galben</option>
        </select>
    <td><em>Stilul de culoare al camerei de chat. (Implicit este Implicit)</em></td>
  </tr>

	<tr>
    <td><strong><?php _e("Afisati caseta de Conectare:" ); ?></strong></td>
    <td><select name="romaniachat_conectare"
	            id="romaniachat_conectare">
				                <option value="1" <?php selected(get_option('romaniachat_conectare'), "1"); ?>>Da</option>
                                <option value="0" <?php selected(get_option('romaniachat_conectare'), "0"); ?>>Nu</option>
                            </select>
	<td><em>Permite sa selectati Nick-ul si Canalul inainte de conectare.</em></td>  
    </tr>

	<tr>
    <td><strong><?php _e("Latime:" ); ?></strong></td>
    <td><input type="text" 
	name="romaniachat_width"
	id="romaniachat_width"
	value="<?php echo get_option('romaniachat_width'); ?>" size="8"></td>
    <td><em>Latimea camerei de chat. (Implicit este 100%)</em></td>
  </tr>
  
  <tr>
    <td><strong><?php _e("Inaltime:" ); ?></strong></td>
    <td><input type="text"
	name="romaniachat_height"
	id="romaniachat_height"
    value="<?php echo get_option('romaniachat_height'); ?>" size="8"></td>
    <td><em>Inaltimea camerei de chat. (Implicit este 500)</em></td>
  </tr>

<br/>	
	<tr>
    <td><strong><?php _e("Pozitie RadioClick:" ); ?></strong></td>
    <td>
	<select name="radioclick_pozitie"
	 id="radioclick_pozitie">
	           <option value="center" <?php selected(get_option('radioclick_pozitie'), "center"); ?>>Centru</option>
               <option value="left" <?php selected(get_option('radioclick_pozitie'), "left"); ?>>Stanga</option>
               <option value="right" <?php selected(get_option('radioclick_pozitie'), "right"); ?>>Dreapta</option>
    </select>
    <td><em>Pozitia RadioClick Player e valabil numai daca e activat Player RadioClick.</em></td>
  </tr>
				
				
		       </table>		
        <p style="font-weight: bold;">
		NOTA: Preferintele utilizatorilor vor avea intotdeauna prioritate fata de aceasta configuratie. De exemplu, daca un utilizator configureaza ca o anumita porecla este utilizata si un anumit canal este accesat, configuratia respectiva va avea intotdeauna prioritate fata de cea a acestei configuratii, deci va intra in canalul indicat in configuratie.</p>
            <?php submit_button(); ?>
        </form>
    </div>


<?php
}
?>