<?php
/**
* public
*
* structure adapted for kiwiirc irc client
* see http://showchat.eu.org/blog/noutate-wp-romaniachat for more information.
* @since  2.0
*/

defined('ABSPATH') or die("Don't change anything here!");

	function romaniachat_page( $atts ) {
        $url = ROMANIACHAT_URLBASE.":8443/?";
	 if (get_option('romaniachat_server') != 'https://kiwi.romaniachat.eu:8443')
        $url = $url."".get_option('romaniachat_server');
	 // ? is replaced whit 3 radom numbers 
	 if (get_option('romaniachat_nick') != '')
        $url = $url."nick=".str_replace("?", rand(100,999), get_option('romaniachat_nick'));
     if (get_option('romaniachat_style') != '')
        $url = $url."&theme=".get_option('romaniachat_style');
	  $channels = isset($atts['chan']) ? $atts['chan'] : '';
     if ($channels == '')
        $channels = get_option('romaniachat_chan');
     if ($channels != '')
        $url = $url."".$channels;

?>
<center><iframe marginwidth="0" marginheight="0" src="<?php echo esc_url( $url ); ?>"
<?php
    if (get_option('romaniachat_width') != '')
	    echo "width=\"".esc_attr( get_option('romaniachat_width'))."\""; ?>
 <?php
    if (get_option('romaniachat_height') != '')
        echo "height=\"".esc_attr( get_option('romaniachat_height'))."\""; ?>
 scrolling="no" frameborder="0"></iframe></center>
<?php
}

function romaniachat( $atts ) {
    ob_start();
    romaniachat_page( $atts );

    return ob_get_clean();
}

/**
* shortcode
* @since  1.0
*/

add_shortcode( 'romaniachat', 'romaniachat' );
?>