<?php
/**
 * WPZOOM Shortcodes.
 *
 * Functions for frontend.
 */

// Replace WP autop formatting
if (!function_exists( "wpz_remove_wpautop")) {
    function wpz_remove_wpautop($content) {
        $content = do_shortcode( shortcode_unautop( $content ) );
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
        return $content;
    }
}

// Enqueue shortcode JS file.
add_action( 'wp_enqueue_scripts' , 'wpz_enqueue_shortcode_css' );

// Include shortcodes .css file
function wpz_enqueue_shortcode_css() {
    wp_enqueue_style( 'wpz-shortcodes', WPZOOM::$assetsPath . '/css/shortcodes.css' );
    wp_enqueue_style( 'zoom-font-awesome', WPZOOM::$assetsPath . '/css/font-awesome.min.css' );
}

/*-----------------------------------------------------------------------------------*/
/* Boxes - box
/*-----------------------------------------------------------------------------------*/
function wpz_shortcode_box( $atts, $content = null ) {
    $defaults = array(
        'type'   => 'normal',
        'size'   => '',
        'style'  => '',
        'border' => '',
        'icon'   => ''
    );

   extract( shortcode_atts( $defaults, $atts ) );

   $custom = '';
    if ( $icon == "none" ) {
        $none_class = ' none_class ';
    } elseif ( $icon ) {
        $custom = ' style="padding-left:50px;background-image:url( '.$icon.' ); background-repeat:no-repeat; background-position:20px 45%;"';
    }

   return '<div class="wpz-sc-box '.$none_class.' '.$type.' '.$size.' '.$style.' '.$border.'"'.$custom.'>' . do_shortcode( wpz_remove_wpautop( $content ) ) . '</div>';
}
add_shortcode( 'box', 'wpz_shortcode_box' );

/*-----------------------------------------------------------------------------------*/
/* Buttons - button
/*-----------------------------------------------------------------------------------*/
function wpz_shortcode_button( $atts, $content = null ) {
    $defaults = array(
        'size'     => '',
        'style'    => '',
        'bg_color' => '',
        'color'    => '',
        'border'   => '',
        'text'     => '',
        'class'    => '',
        'link'     => '#',
        'window'   => '',
        'icon'     => ''
    );

    extract( shortcode_atts( $defaults, $atts ) );

    // Set custom background and border color
    $color_output = '';
    $color_options = array( 'red', 'orange', 'green', 'aqua', 'teal', 'purple', 'pink', 'silver' );

    $background_style = '';
    if ( $color ) {
        if ( in_array($color, $color_options) ) {
            $class .= " " . $color;
        }
    } else {
        if ( $bg_color ) {
            $background_style = ';background:' . $bg_color;
        }
    }

    $border_style = '';
    if ( $border ) {
        $border_style = ';border-color:' . $border;
    }

    $color_output = sprintf( 'style="%s"', esc_attr( $background_style . $border_style ) );

    $class_output = '';

    // Set text color
    if ( $text ) {
        $class_output .= ' dark';
    }

    // Set class
    if ( $class ) {
        $class_output .= ' '.$class;
    }

    // Set Size
    if ( $size ) {
        $class_output .= ' '.$size;
    }

    if ( $window ) {
        $window = 'target="_blank" ';
    }

    if ( $icon ) {
      $icon_class = sprintf( 'fa fa-%s', $icon );
      $output = '<a '.$window.'href="'.esc_attr($link).'"class="wpz-sc-button'.esc_attr($class_output).'" '.$color_output.'><span><i class="' . esc_attr($icon_class) . '" style="padding-right:6px;"></i>' . wpz_remove_wpautop( $content ) . '</span></a>';
    } else {
      $output = '<a '.$window.'href="'.esc_attr($link).'"class="wpz-sc-button'.esc_attr($class_output).'" '.$color_output.'><span class="wpz-'.esc_attr($style).'">' . wpz_remove_wpautop( $content ) . '</span></a>';
    }

    return $output;
}
add_shortcode( 'button', 'wpz_shortcode_button' );


/*-----------------------------------------------------------------------------------*/
/* Twitter button - twitter
/*-----------------------------------------------------------------------------------*/
function wpz_shortcode_twitter( $atts, $content = null ) {
    $defaults = array(
        'url'     => '',
        'style'   => 'vertical',
        'source'  => '',
        'text'    => '',
        'related' => '',
        'lang'    => '',
        'float'   => 'left'
    );

    extract( shortcode_atts( $defaults, $atts ) );

    $output = '';

    if ( $url ) {
        $output .= ' data-url="'.$url.'"';
    }

    if ( $source ) {
        $output .= ' data-via="'.$source.'"';
    }

    if ( $text ) {
        $output .= ' data-text="'.$text.'"';
    }

    if ( $related ) {
        $output .= ' data-related="'.$related.'"';
    }

    if ( $lang ) {
        $output .= ' data-lang="'.$lang.'"';
    }

    $output = '<div class="wpz-sc-twitter '.$float.'"><a href="http://twitter.com/share" class="twitter-share-button"'.$output.' data-count="'.$style.'">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
    return $output;

}
add_shortcode( 'twitter', 'wpz_shortcode_twitter' );

/*-----------------------------------------------------------------------------------*/
/* Facebook Like Button - fblike
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_fblike($atts, $content = null) {
       extract(shortcode_atts(array(    'float' => 'none',
                                       'url' => '',
                                       'style' => 'standard',
                                       'showfaces' => 'false',
                                       'width' => '450',
                                       'verb' => 'like',
                                       'colorscheme' => 'light',
                                       'font' => 'arial'), $atts));

    global $post;

    if ( ! $post ) {

        $post = new stdClass();
        $post->ID = 0;

    } // End IF Statement

    $allowed_styles = array( 'standard', 'button_count', 'box_count' );

    if ( ! in_array( $style, $allowed_styles ) ) { $style = 'standard'; } // End IF Statement

    if ( !$url )
        $url = get_permalink($post->ID);

    $height = '60';
    if ( $showfaces == 'true')
        $height = '100';

    if ( ! $width || ! is_numeric( $width ) ) { $width = 450; } // End IF Statement

    switch ( $float ) {

        case 'left':

            $float = 'fl';

        break;

        case 'right':

            $float = 'fr';

        break;

        default:
        break;

    } // End SWITCH Statement

    $output = '
<div class="wpz-fblike '.$float.'">
<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$style.'&amp;show_faces='.$showfaces.'&amp;width='.$width.'&amp;action='.$verb.'&amp;colorscheme='.$colorscheme.'&amp;font=' . $font . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px"></iframe>
</div>
    ';
    return $output;

}
add_shortcode( 'fblike', 'wpz_shortcode_fblike' );


/*-----------------------------------------------------------------------------------*/
/* Columns
/*-----------------------------------------------------------------------------------*/

/* ============= Two Columns ============= */

function wpz_shortcode_twocol_one($atts, $content = null) {
   return '<div class="twocol-one">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'twocol_one', 'wpz_shortcode_twocol_one' );

function wpz_shortcode_twocol_one_last($atts, $content = null) {
   return '<div class="twocol-one last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'twocol_one_last', 'wpz_shortcode_twocol_one_last' );


/* ============= Three Columns ============= */

function wpz_shortcode_threecol_one($atts, $content = null) {
   return '<div class="threecol-one">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_one', 'wpz_shortcode_threecol_one' );

function wpz_shortcode_threecol_one_last($atts, $content = null) {
   return '<div class="threecol-one last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_one_last', 'wpz_shortcode_threecol_one_last' );

function wpz_shortcode_threecol_two($atts, $content = null) {
   return '<div class="threecol-two">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_two', 'wpz_shortcode_threecol_two' );

function wpz_shortcode_threecol_two_last($atts, $content = null) {
   return '<div class="threecol-two last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_two_last', 'wpz_shortcode_threecol_two_last' );

/* ============= Four Columns ============= */

function wpz_shortcode_fourcol_one($atts, $content = null) {
   return '<div class="fourcol-one">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_one', 'wpz_shortcode_fourcol_one' );

function wpz_shortcode_fourcol_one_last($atts, $content = null) {
   return '<div class="fourcol-one last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_one_last', 'wpz_shortcode_fourcol_one_last' );

function wpz_shortcode_fourcol_two($atts, $content = null) {
   return '<div class="fourcol-two">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_two', 'wpz_shortcode_fourcol_two' );

function wpz_shortcode_fourcol_two_last($atts, $content = null) {
   return '<div class="fourcol-two last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_two_last', 'wpz_shortcode_fourcol_two_last' );

function wpz_shortcode_fourcol_three($atts, $content = null) {
   return '<div class="fourcol-three">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_three', 'wpz_shortcode_fourcol_three' );

function wpz_shortcode_fourcol_three_last($atts, $content = null) {
   return '<div class="fourcol-three last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_three_last', 'wpz_shortcode_fourcol_three_last' );

/* ============= Five Columns ============= */

function wpz_shortcode_fivecol_one($atts, $content = null) {
   return '<div class="fivecol-one">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_one', 'wpz_shortcode_fivecol_one' );

function wpz_shortcode_fivecol_one_last($atts, $content = null) {
   return '<div class="fivecol-one last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_one_last', 'wpz_shortcode_fivecol_one_last' );

function wpz_shortcode_fivecol_two($atts, $content = null) {
   return '<div class="fivecol-two">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_two', 'wpz_shortcode_fivecol_two' );

function wpz_shortcode_fivecol_two_last($atts, $content = null) {
   return '<div class="fivecol-two last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_two_last', 'wpz_shortcode_fivecol_two_last' );

function wpz_shortcode_fivecol_three($atts, $content = null) {
   return '<div class="fivecol-three">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_three', 'wpz_shortcode_fivecol_three' );

function wpz_shortcode_fivecol_three_last($atts, $content = null) {
   return '<div class="fivecol-three last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_three_last', 'wpz_shortcode_fivecol_three_last' );

function wpz_shortcode_fivecol_four($atts, $content = null) {
   return '<div class="fivecol-four">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_four', 'wpz_shortcode_fivecol_four' );

function wpz_shortcode_fivecol_four_last($atts, $content = null) {
   return '<div class="fivecol-four last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_four_last', 'wpz_shortcode_fivecol_four_last' );


/* ============= Six Columns ============= */

function wpz_shortcode_sixcol_one($atts, $content = null) {
   return '<div class="sixcol-one">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_one', 'wpz_shortcode_sixcol_one' );

function wpz_shortcode_sixcol_one_last($atts, $content = null) {
   return '<div class="sixcol-one last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_one_last', 'wpz_shortcode_sixcol_one_last' );

function wpz_shortcode_sixcol_two($atts, $content = null) {
   return '<div class="sixcol-two">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_two', 'wpz_shortcode_sixcol_two' );

function wpz_shortcode_sixcol_two_last($atts, $content = null) {
   return '<div class="sixcol-two last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_two_last', 'wpz_shortcode_sixcol_two_last' );

function wpz_shortcode_sixcol_three($atts, $content = null) {
   return '<div class="sixcol-three">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_three', 'wpz_shortcode_sixcol_three' );

function wpz_shortcode_sixcol_three_last($atts, $content = null) {
   return '<div class="sixcol-three last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_three_last', 'wpz_shortcode_sixcol_three_last' );

function wpz_shortcode_sixcol_four($atts, $content = null) {
   return '<div class="sixcol-four">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_four', 'wpz_shortcode_sixcol_four' );

function wpz_shortcode_sixcol_four_last($atts, $content = null) {
   return '<div class="sixcol-four last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_four_last', 'wpz_shortcode_sixcol_four_last' );

function wpz_shortcode_sixcol_five($atts, $content = null) {
   return '<div class="sixcol-five">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_five', 'wpz_shortcode_sixcol_five' );

function wpz_shortcode_sixcol_five_last($atts, $content = null) {
   return '<div class="sixcol-five last">' . wpz_remove_wpautop($content) . '</div>';
}
add_shortcode( 'sixcol_five_last', 'wpz_shortcode_sixcol_five_last' );

/*-----------------------------------------------------------------------------------*/
/* Tabs - [tabs][/tabs]
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_tabs ( $atts, $content = null ) {
    if ( ! defined( 'WPZ_SHORTCODE_TABS_JS' ) ) define( 'WPZ_SHORTCODE_TABS_JS', true );

    $defaults = array( 'title' => '', 'css' => '', 'id' => '' );

    extract( shortcode_atts( $defaults, $atts ) );

    // If no unique ID is set, set the ID as a random number between 1 and 100 (to make sure each tab group is unique).
    if ( $id == '' ) { $id = rand( 1, 100 ); }
    if ( $css != '' ) { $css = ' ' . $css; }

    // Extract the tab titles for use in the tabber widget.
    preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

    $tab_titles = array();
    $tabs_class = 'tab_titles';

    if ( isset( $matches[1] ) ) { $tab_titles = $matches[1]; }

    $titles_html = '';

    if ( count( $tab_titles ) ) {
        if ( $title ) { $titles_html .= '<h4 class="tab_header"><span>' . esc_html( $title ) . '</span></h4>'; $tabs_class .= ' has_title'; }

        $titles_html .= '<ul class="' . esc_attr( $tabs_class ) . '">' . "\n";

        $counter = 1;

        foreach ( $tab_titles as $t ) {
            $titles_html .= '<li class="nav-tab"><a href="#tab-' . esc_attr( $counter ) . '">' . esc_html( $t[0] ) . '</a></li>' . "\n";
            $counter++;
        } // End FOREACH Loop

        $titles_html .= '</ul>' . "\n";
    } // End IF Statement

    return '<div id="tabs-' . esc_attr( $id ) . '" class="shortcode-tabs ' . esc_attr( $css ) . '">' . $titles_html . do_shortcode( $content ) . "\n" . '<div class="fix"></div><!--/.fix-->' . "\n" . '</div><!--/.tabs-->';
}

add_shortcode( 'tabs', 'wpz_shortcode_tabs' );

/*-----------------------------------------------------------------------------------*/
/* A Single Tab - [tab title="The title goes here"][/tab]
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_tab_single ( $atts, $content = null ) {
    $defaults = array( 'title' => 'Tab' );

    extract( shortcode_atts( $defaults, $atts ) );

    $class = '';

    if ( $title != 'Tab' ) {
        $class = ' tab-' . sanitize_title( $title );
    }

    return '<div class="tab' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '</div><!--/.tab-->';
}

add_shortcode( 'tab', 'wpz_shortcode_tab_single' );

function wpz_shortcode_tabs_register_js() {
    wp_register_script( 'wpz-shortcode-tabs', WPZOOM::$assetsPath . '/js/shortcode-tabs.js', array( 'jquery', 'jquery-ui-tabs' ), '20140529', true );
}
add_action( 'init', 'wpz_shortcode_tabs_register_js' );

function wpz_shortcode_tabs_print_js() {
    if ( ! defined( 'WPZ_SHORTCODE_TABS_JS' ) ) return;

    wp_print_scripts( 'wpz-shortcode-tabs' );
}

add_action( 'wp_footer', 'wpz_shortcode_tabs_print_js' );

/*-----------------------------------------------------------------------------------*/
/* Icon links - ilink
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_ilink($atts, $content = null) {
       extract(shortcode_atts(array( 'style' => 'info', 'url' => '', 'icon' => ''), $atts));

       $custom_icon = '';
       if ( $icon )
           $custom_icon = 'style="background:url( '.$icon.') no-repeat left 40%;"';

   return '<span class="wpz-sc-ilink"><a class="'.$style.'" href="'.$url.'" '.$custom_icon.'>' . wpz_remove_wpautop($content) . '</a></span>';
}
add_shortcode( 'ilink', 'wpz_shortcode_ilink' );


/*-----------------------------------------------------------------------------------*/
/* List Styles - Unordered List - [unordered_list style=""][/unordered_list]
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_unorderedlist ( $atts, $content = null ) {

    $defaults = array( 'style' => 'default' );

    extract( shortcode_atts( $defaults, $atts ) );

    return '<div class="shortcode-unorderedlist ' . $style . '">' . do_shortcode( $content ) . '</div>' . "\n";

} // End wpz_shortcode_unorderedlist()

add_shortcode( 'unordered_list', 'wpz_shortcode_unorderedlist' );

/*-----------------------------------------------------------------------------------*/
/* List Styles - Ordered List - [ordered_list style=""][/ordered_list]
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_orderedlist ( $atts, $content = null ) {

    $defaults = array( 'style' => 'default' );

    extract( shortcode_atts( $defaults, $atts ) );

    return '<div class="shortcode-orderedlist ' . $style . '">' . do_shortcode( $content ) . '</div>' . "\n";

} // End wpz_shortcode_orderedlist()

add_shortcode( 'ordered_list', 'wpz_shortcode_orderedlist' );

/*-----------------------------------------------------------------------------------*/
/* Social Icon - [social_icon url="" float="" icon_url="" title="" profile_type="" window=""]
/*-----------------------------------------------------------------------------------*/

function wpz_shortcode_socialicon ( $atts, $content = null ) {

    $defaults = array( 'url' => '', 'float' => 'none', 'icon_url' => '', 'title' => '', 'profile_type' => '', 'window' => 'no' );

    extract( shortcode_atts( $defaults, $atts ) );

    if ( ! $url ) { return; } // End IF Statement - Don't run the shortcode if no URL has been supplied.

    // Attempt to determine the location of the social profile.
    // If no location is found, a default icon will be used.

    $_default_icon = '';

    $_supported_profiles = array(
        'facebook' => 'facebook.com',
        'twitter' => 'twitter.com',
        'youtube' => 'youtube.com',
        'delicious' => 'delicious.com',
        'flickr' => 'flickr.com',
        'linkedin' => 'linkedin.com'
    );

    $_profile_to_display = '';
    $_alt_text = '';
    $_classes = 'social-icon';

    $_profile_match = false;

    // If they've specified an icon, skip the automation.

    if ( $profile_type != '' ) {

        $_profile_match = true;
        $_profile_to_display = $profile_type;
        if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile', 'wpzoom' ), $_alt_text ); } // End IF Statement
        $_profile_class = ' social-icon-' . $_profile_to_display;

        if ( $icon_url ) {

            $_img_url = $icon_url;

        } else {

            $_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/wpzoom/assets/images/shortcodes/social/' . $_profile_to_display . '.png';

        } // End IF Statement

    } // End IF Statement

    // Create a special scenario for use with the RSS feed for this website.

    if ( $url == 'feed' ) {

        $_profile_match = true;
        $_profile_to_display = 'rss';
        if ( $title ) { $_alt_text = $title; } else { $_alt_text = __( 'Subscribe to our RSS feed', 'wpzoom' ); } // End IF Statement
        $_classes .= ' social-icon-subscribe';
        $url = get_bloginfo( 'rss2_url' );

        if ( $icon_url ) {

            $_img_url = $icon_url;

        } else {

            $_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/wpzoom/assets/images/ico-social-' . $_profile_to_display . '.png';

        } // End IF Statement

    } else {

        foreach ( $_supported_profiles as $k => $v ) {

            if ( $_profile_match == true ) { break; } // End IF Statement - Break out of the loop if we already have a match.

            // Get host name from URL

            preg_match( '@^(?:http://)?([^/]+)@i', $url, $matches );
            $host = $matches[1];

            if ( $host == $v ) {

                $_profile_match = true;
                $_profile_to_display = $k;
                if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile', 'wpzoom' ), $_alt_text ); } // End IF Statement
                $_profile_class = ' social-icon-' . $_profile_to_display;

                if ( $icon_url ) {

                    $_img_url = $icon_url;

                } else {

                $_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/wpzoom/assets/images/' . $_profile_to_display . '.png';

                } // End IF Statement

            } else {

                $_profile_to_display = 'default';
                if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $matches[1] ); $_alt_text = sprintf( __( 'My %s Profile', 'wpzoom' ), $_alt_text ); } // End IF Statement

                $_host_bits = explode( '.', $matches[1] );
                $_profile_class = ' social-icon-' . $_host_bits[0];

                if ( $icon_url ) {

                    $_img_url = $icon_url;

                } else {

                    $_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/wpzoom/assets/images/' . $_profile_to_display . '.png';

                    // Check if an image has been added for this social icon.

                    if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'images/' . $_host_bits[0] . '.png' ) ) {

                        $_img_url = trailingslashit( get_stylesheet_directory_uri() ) . 'images/' . $_host_bits[0] . '.png';

                    } // End IF Statement

                } // End IF Statement

            } // End IF Statement

        } // End FOREACH Loop

        $_classes .= $_profile_class;

        // Determine the floating CSS class to be used.

        switch ( $float ) {

            case 'left':

                $_classes .= ' fl';

            break;

            case 'right':

                $_classes .= ' fr';

            break;

            default:

            break;

        } // End SWITCH Statement

    } // End IF Statement

    $target = '';
    if ( $window == 'yes' ) { $target = ' target="_blank"'; } // End IF Statement

    return '<a href="' . $url . '" title="' . $_alt_text . '"' . $target . '><img src="' . $_img_url . '" alt="' . $_alt_text . '" class="' . $_classes . '" /></a>' . "\n";

} // End wpz_shortcode_socialicon()

add_shortcode( 'social_icon', 'wpz_shortcode_socialicon' );
