<?php

defined('ABSPATH') or die("Nu schimba nimic aici!");

function romaniachat_page( $atts ) {
    $url = ROMANIACHAT_URLBASE.":9090/?";


    if (get_option('romaniachat_nick') != '')
        $url = $url."nick=".str_replace("?", rand(10000,99999), get_option('romaniachat_nick'));

    $channels = isset($atts['chan']) ? $atts['chan'] : '';
    if ($channels == '')
        $channels = get_option('romaniachat_chan');
    if ($channels != '')
        $url = $url."&channels=".$channels;

    if (get_option('romaniachat_style') != '')
        $url = $url."&uio=".get_option('romaniachat_style');

    if (get_option('romaniachat_conectare') != '')
        $url = $url."&prompt=".get_option('romaniachat_conectare');

?>
<center>
        <iframe
            marginwidth="0"
            marginheight="0"
            src="<?php echo $url; ?>"
<?php
    if (get_option('romaniachat_width') != '')
        echo "width=\"".get_option('romaniachat_width')."\"";
    if (get_option('romaniachat_height') != '')
        echo "height=\"".get_option('romaniachat_height')."\"";
?>
            scrolling="no"
            frameborder="0">
        </iframe>
	 </center>
<?php
}

function romaniachat( $atts ) {
    ob_start();
    romaniachat_page( $atts );

    return ob_get_clean();
}

//Functia Radioclick

function radioclick_page( $atts ) {
    $rcr = RADIOCLICK_URLBASE."radioclick";
	
	    if (get_option('radioclick_pozitie') != '')
        echo "<div align=\"".get_option('radioclick_pozitie')."\">";
?>
       <iframe
            marginwidth="0"
            marginheight="0"
            src="<?php echo $rcr; ?>"
			height="62" 
			width="320"
            scrolling="no"
            frameborder="0">
        </iframe>
</div>
<?php
}

function radioclick( $atts ) {
    ob_start();
    radioclick_page( $atts );

    return ob_get_clean();
}	
	
add_shortcode( 'radioclick', 'radioclick' );
add_shortcode( 'romaniachat', 'romaniachat' );
?>