<?php
defined('ABSPATH') or exit;

function romaniachat_build_url($atts) {

    $base = esc_url_raw(get_option('romaniachat_server'));
    if (!$base) {
        $base = ROMANIACHAT_URLBASE;
    }

    $params = [];

    // Nick
    $nick = get_option('romaniachat_nick');
    if (!empty($nick)) {
        $nick = str_replace("?", rand(100,999), $nick);
        $params['nick'] = sanitize_text_field($nick);
    }

    // Theme
    $style = get_option('romaniachat_style');
    if (!empty($style)) {
        $params['theme'] = sanitize_text_field($style);
    }

    // Build base query
    $url = $base . '/?' . http_build_query($params);

    // 👉 Channels as fragment (#)
    $channels = isset($atts['chan']) ? $atts['chan'] : get_option('romaniachat_chan');

    if (!empty($channels)) {
        // clean spaces
        $channels = strtolower(trim($channels));
        $channels = str_replace(' ', '', $channels);

        // to ensure that they begin with #
        $channels = preg_replace('/(^|,)([^#])/','$1#$2',$channels);

        $url .= $channels;
    }

    return $url;
}

function romaniachat_page($atts) {

    $url = romaniachat_build_url($atts);

    $width  = esc_attr(get_option('romaniachat_width'));
    $height = esc_attr(get_option('romaniachat_height'));

    ?>
    <div style="text-align:center;">
        <iframe 
            src="<?php echo esc_url($url); ?>"
            width="<?php echo $width ?: '100%'; ?>"
            height="<?php echo $height ?: '500'; ?>"
            frameborder="0"
            allow="camera; microphone; fullscreen"
            referrerpolicy="no-referrer"
            loading="lazy">
        </iframe>
    </div>
    <?php
}

function romaniachat($atts) {
    ob_start();
    romaniachat_page($atts);
    return ob_get_clean();
}
/**
* shortcode
* @since  1.0
*/
add_shortcode('romaniachat', 'romaniachat');