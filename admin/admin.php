<?php
if (!defined('ABSPATH')) exit;

/* =========================
   MENU
========================= */
/**
* Function that generates an entry in the Administration menu
* @since  2.1
*/
function romaniachat_plugin_menu() {

    add_menu_page(
        'RomaniaChat',
        'RomaniaChat',
        'manage_options',
        'romaniachat_settings',
        'romaniachat_settingspage',
        'dashicons-format-chat'
    );

    add_submenu_page(
        'romaniachat_settings',
        'Setări',
        'Configurare',
        'manage_options',
        'romaniachat_settings_eu',
        'romaniachat_settingspage_eu'
    );
}
add_action('admin_menu', 'romaniachat_plugin_menu');

/**
 * Function that records the values from the internal DB
 * @since  1.0
 */
function romaniachat_register_settings() {

    register_setting('romaniachat-eu', 'romaniachat_nick');
    register_setting('romaniachat-eu', 'romaniachat_server');
    register_setting('romaniachat-eu', 'romaniachat_chan');
    register_setting('romaniachat-eu', 'romaniachat_style');
    register_setting('romaniachat-eu', 'romaniachat_width');
    register_setting('romaniachat-eu', 'romaniachat_height');

}
add_action('admin_init', 'romaniachat_register_settings');


/* =========================
   INFO PAGE (MODERN RO)
========================= */
/**
 * Function that renders the main configuration page
 * info wp romaniachat
 * @since  1.0
 */
function romaniachat_settingspage() {
    if (!current_user_can('manage_options')) return;

    $version = defined('ROMANIACHAT_VERSION') ? ROMANIACHAT_VERSION : '1.0';
    ?>

    <div class="wrap">

        <style>
        .rc-container { max-width: 900px; }

        .rc-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .rc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rc-title {
            font-size: 24px;
            margin: 0;
        }

        .rc-badge {
            background: #2271b1;
            color: #fff;
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .rc-section { margin-top: 25px; }

        .rc-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .rc-code {
            background: #f6f7f7;
            border: 1px solid #e5e7eb;
            padding: 10px;
            border-radius: 8px;
            margin: 6px 0;
            font-family: monospace;
        }

        .rc-desc {
            font-size: 14px;
            color: #444;
        }

        .rc-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #2271b1;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
        }

        .rc-button:hover {
            background: #135e96;
            color: #fff;
        }

        .rc-footer {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
        </style>

        <div class="rc-container">
            <div class="rc-card">

                <div class="rc-header">
                    <h1 class="rc-title">💬 RomaniaChat</h1>
                    <span class="rc-badge">WP RomaniaChat <?php echo esc_html($version); ?></span>
                </div>

                <p class="rc-desc">
                    Integrează serviciul de Chat al retelei de IRC RomaniaChat in WordPress.
                </p>

                <div class="rc-section">
                    <h2>📌 Utilizare</h2>

                    <p class="rc-desc">Shortcode standard:</p>
                    <div class="rc-code">[romaniachat]</div>

                    <p class="rc-desc">Canal specific:</p>
                    <div class="rc-code">[romaniachat chan="#Romania"]</div>

                    <p class="rc-desc">Mai multe canale:</p>
                    <div class="rc-code">[romaniachat chan="#Romania,#Radioclick"]</div>
                </div>

                <div class="rc-section">
                    <h2>🌐 Platformă</h2>

                    <p class="rc-desc">
                        RomaniaChat este o platformă IRC gratuită, modernă și optimizată pentru toate dispozitivele.
                    </p>

                    <a href="https://wp.romaniachat.eu/" target="_blank" class="rc-button">
                        🔗 Vizitează site-ul pluginului
                    </a>
                </div>

                <div class="rc-footer">
                    Versiune plugin: <?php echo esc_html($version); ?>
                </div>

            </div>
        </div>

    </div>
    <?php
}


/* =========================
   SETTINGS PAGE (MODERN RO)
========================= */
/**
 * Function that renders the main configuration page
 * config wp romaniachat
 * @since  2.1
 */
function romaniachat_settingspage_eu() {
    if (!current_user_can('manage_options')) return;
    ?>

    <div class="wrap">

        <style>
        .rc-settings {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            max-width: 820px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .rc-settings h2 { margin-top: 0; }

        .rc-table th {
            text-align: left;
            padding: 12px;
            width: 180px;
        }

        .rc-table td { padding: 10px; }

        .rc-table input,
        .rc-table select {
            width: 100%;
            max-width: 320px;
        }

        .rc-desc {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
            display: block;
        }
        </style>

        <div class="rc-settings">

            <h2>⚙️ Setări chat</h2>

            <form method="post" action="options.php">
                <?php settings_fields('romaniachat-eu'); ?>

                <table class="form-table rc-table">

                    <tr>
                        <th>Pseudonim (Nick)</th>
                        <td>
                            <input type="text" name="romaniachat_nick"
                                value="<?php echo esc_attr(get_option('romaniachat_nick')); ?>">
                            <span class="rc-desc">
                                Exemplu: User_? → generează automat User_123
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Canale</th>
                        <td>
                            <input type="text" name="romaniachat_chan"
                                value="<?php echo esc_attr(get_option('romaniachat_chan')); ?>">
                            <span class="rc-desc">
                                Separate prin virgulă: #romania,#radioclick,#trivia
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Tema</th>
                        <td>
                            <select name="romaniachat_style">
                                <option value="default" <?php selected(get_option('romaniachat_style'), "default"); ?>>Default</option>
								<option value="radioclick" <?php selected(get_option('romaniachat_style'), "radioclick"); ?>>RadioClick</option>
                                <option value="osprey" <?php selected(get_option('romaniachat_style'), "osprey"); ?>>Osprey</option>
                                <option value="dark" <?php selected(get_option('romaniachat_style'), "dark"); ?>>Dark</option>
                                <option value="nightswatch" <?php selected(get_option('romaniachat_style'), "nightswatch"); ?>>Nightswatch</option>
								<option value="elite" <?php selected(get_option('romaniachat_style'), "elite"); ?>>Elite</option>
								<option value="grayfox" <?php selected(get_option('romaniachat_style'), "grayfox"); ?>>Grayfox</option>
								<option value="sky" <?php selected(get_option('romaniachat_style'), "sky"); ?>>Sky</option>
								<option value="roz" <?php selected(get_option('romaniachat_style'), "roz"); ?>>Roz</option>
								<option value="marou" <?php selected(get_option('romaniachat_style'), "marou"); ?>>Marou</option>
								<option value="albastru" <?php selected(get_option('romaniachat_style'), "albastru"); ?>>Albastru</option>
                            </select>
							<span class="rc-desc">
                                Stil vizual al chat-ului
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Lățime</th>
                        <td>
                            <input type="text" name="romaniachat_width"
                                value="<?php echo esc_attr(get_option('romaniachat_width')); ?>">
								<span class="rc-desc">
                                Exemplu: 100% sau 800px
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Înălțime</th>
                        <td>
                            <input type="text" name="romaniachat_height"
                                value="<?php echo esc_attr(get_option('romaniachat_height')); ?>">
								<span class="rc-desc">
                                Exemplu: 500px
                            </span>
                        </td>
                    </tr>

                </table>

                <?php submit_button('💾 Salvează setările'); ?>
            </form>

        </div>

    </div>

    <?php
}