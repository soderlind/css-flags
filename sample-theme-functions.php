<?php
/**
 * Sample theme functions.php that demonstrate how to include  the CSS FLags plugin / library to theme.
 *
 * More information at https://github.com/soderlind/css-flags#theme
 */



// Best practice, load parent style from functions.php don't use @import in style.css
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

//load the CSS FLags library (You have to clone it into your theme folder first: git clone https://github.com/soderlind/css-flags.git )
require_once(dirname(__FILE__) . '/css-flags/css-flags.php');


//add filter(s)
add_action( 'init', function() {
	add_filter('css-flags-countries', function() {
		return array('no','se','dk'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
	});
	// add_filter('css-flags-countries', function() {
	// 	return array('all'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
	// });
	// add_filter('css-flags-regions', function() {
	// 	return array('europe'); //europe, oceania, africa, asia, northamerica, southamerica, middleeast
	// });
	// add_filter('css-flags-exclude', function() {
	// 	return array('gb','se');
	// });
});



if ( defined( 'ABSPATH' ) ) {
	CSSFlagShortcode::instance();
}

/**
 * [cssflag] shortcode, optional attribute is countries, a comma separated list with two letter country codes eg: [cssflag countries="no,se,dk"]
 */
class CSSFlagShortcode {

	private static $instance;


	public static function instance() {
		if ( self::$instance ) {
			return self::$instance;
		}
		self::$instance = new self();
		return self::$instance;
	}

	private function __construct() {
		add_shortcode( 'cssflag', array( $this, 'cssflag'));
		add_action( 'wp_enqueue_scripts', array( $this, 'append_inline_style' ));
	}


	function append_inline_style() {
		// Works only if the 'css-flags' has already been added
		wp_add_inline_style( 'css-flags','
			.box {
				width: 32%;
				/*float: left;*/
			}
			.flagbox {
				width: 120px;
				height: 120px;
				display: inline-block;
				vertical-align: middle;
			}
			.flag {
			    margin: auto;
				display: inline-block;
				vertical-align: middle;

				border: 1px solid #e5e5e5;
				box-shadow: inset 0px 0px 0px 2px #fff;

			}
		');
	}

	//shortcode
	function cssflag( $atts) {

		$atr = shortcode_atts( array(
			'countries' => 'no',
	    ), $atts);
		$countries = $this->multiexplode(array(",",".","|",":"),$atr['countries']);

		$output = '';
		if ( false !== wp_style_is( 'css-flags' ) ) {
			foreach ( $countries as $country) {
				$output .= sprintf('<div class="box"><div class="flagbox"><span class="flag cssflag %1$s %1$s-portrait"></span></div></div>', $country);
			}
		} else {
			$output = 'CSS Flags plugin/library is not added';
		}

		if ('' != $output) {
	    	return $output;
		}
	}

	//from http://php.net/explode#111307
	function multiexplode ($delimiters = array(',') ,$string) {
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return  $launch;
	}
}
