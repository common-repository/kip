<?php
define('WLCMS','1.5.1');

if ( ! defined('ABSPATH') ) {
        die('Please do not load this file directly.');
}


global $wpdbb_content_dir;

$wpdbb_content_dir = ( defined('WP_CONTENT_DIR') ) ? WP_CONTENT_DIR : ABSPATH . 'wp-content';

if ( ! defined('WP_BACKUP_DIR') ) {
        define('WP_BACKUP_DIR', $wpdbb_content_dir . '/');
}

if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php");
}

update_option('wlcms_o_hide_wp_adminbar', true);
update_option('wlcms_o_login_custom_logo', home_url() . '/wp-admin/images/kip-logo.png');

add_action('wp_before_admin_bar_render', 'wlcms_adminbar', 0);
add_action('login_head', 'wlcms_custom_login_logo');

function wlcms_adminbar()
{
     global $wp_version;

    if(get_option('wlcms_o_dashboard_border')):
    echo '<style type="text/css"> .postbox-container .meta-box-sortables.empty-container, #side-sortables.empty-container{border:0;} </style>';
    endif;
    if( get_option('wlcms_o_hide_wp_adminbar') ):
        echo " \n\n <style type=\"text/css\">#wp-admin-bar-wp-logo { display:none; }</style> \n\n";
    endif;

    if( get_option('wlcms_o_adminbar_custom_logo') ):
        $background = get_option('wlcms_o_adminbar_custom_logo');
        if(!preg_match("@^https?://@", $background))
            $background = get_bloginfo('stylesheet_directory').'/images/'.$background;

        echo '<script type="text/javascript"> jQuery(document).ready(function(){ ';
        echo  'jQuery("#wp-admin-bar-root-default").prepend(" <li id=\"wlcms_admin_logo\"> <span style=\"float:left;height:28px;line-height:28px;vertical-align:middle;text-align:center;width:28px\"><img src=\"'.$background.'\" width=\"16\" height=\"16\" alt=\"Login\" style=\"height:16px;width:16px;vertical-align:middle\" /> </span> </li> ");  }); ';
        echo '</script> ';

    endif;

   $style = '<style type="text/css">';

        if(get_option('wlcms_o_header_custom_logo') != "")
        {
            $background = get_option('wlcms_o_header_custom_logo');

            if(!preg_match("@^https?://@", $background))
            $background = get_bloginfo('stylesheet_directory').'/images/'.$background;

            $style .= '#header-logo { background-image: url('.$background . ') !important; ';
            $css_width = get_option('wlcms_o_header_custom_logo_width');

            if ($css_width != '')
            {
                $style .= 'width: ' . get_option('wlcms_o_header_custom_logo_width') . 'px; ';
            }
            else
            {
                if (( version_compare( $wp_version, '3.2', '>=' ) ) && (!empty($customHFHeight)))
                {
                    $style .= 'height: '.$customHFHeight.'px; ';
                }
            }
            $style .= '} ';
        }

        if (( version_compare( $wp_version, '3.2', '>=' ) ) && (!empty($customHFHeight))) {
                $style .= '  #wphead { height: '.$customHFHeight.'px; }
                                #wphead h1 { font-size: 22px; padding: 10px 8px 5px; }
                                #header-logo { height: 32px; }
                                #user_info { padding-top: 8px }
                                #user_info_arrow { margin-top: 8px; }
                                #user_info_links { top: 8px; }
                                #footer p { padding-top: 15px; }
                                #wlcms-footer-container { padding-top: 10px; line-height: 30px;} '."\n";
        }

        if (( version_compare( $wp_version, '3.2', '<' ) ) && (empty($customHFHeight))) {
               $style .= '#wlcms-footer-container { 	padding-top: 10px; 	line-height: 30px; }';
        }

        if (get_option('wlcms_o_header_logo_link') == 1) {
                $style .= '#site-heading { display: none; } ';
        }

    $style .= '</style>';

    echo $style;


    if (get_option('wlcms_o_header_logo_link') == 1) {
            echo '<script type="text/javascript">';
            echo "jQuery(function($){ $('#header-logo').wrap('<a href=\"" . site_url() . "\" alt=\"" . get_bloginfo('name') . "\" title=\"" . get_bloginfo('name') . "\">'); });";
            echo '</script>';
    }
}

// custom logo login
function wlcms_custom_login_logo()
{
    wp_print_scripts( array( 'jquery' ) );

    $login_custom_logo = get_option('wlcms_o_login_custom_logo');

    if(!preg_match("@^https?://@", $login_custom_logo))
            $login_custom_logo = get_bloginfo('stylesheet_directory').'/images/'.$login_custom_logo;

    echo '<style type="text/css">';
    echo stripslashes( get_option('wlcms_o_login_bg_css') );

    if (get_option('wlcms_o_login_custom_logo')):
        echo ' .login h1 a { display:all; background: url('.$login_custom_logo . ') no-repeat bottom center !important; margin-bottom: 10px; background-size: auto; } ';

        if(get_option('wlcms_o_loginbg_white') ):
                echo ' body.login {background: #fff } ';
        endif;

        echo '</style> ';

        echo '<script type="text/javascript">
                jQuery(document).ready(function()
               {
                    jQuery(\'#login h1 a\').attr(\'title\',\'' . get_bloginfo('name') . '\');
                    jQuery(\'#login h1 a\').attr(\'href\',\'' . get_bloginfo('url') . '\');
               });
        </script>';

    elseif( get_option('wlcms_o_login_bg_css') ):

        echo  stripslashes( get_option('wlcms_o_login_bg_css') );
        echo '</style> ';
    else:
        echo '</style> ';
    endif;

    if(get_option('wlcms_o_login_bg_css')):
        echo '<script type="text/javascript"> jQuery(document).ready(function(){ jQuery("#login").wrap("<div id=\'wlcms-login-wrapper\'></div>"); }); </script> ';
    endif;

}
?>
