<?php
/**
 * Sample theme functions.php that demonstrate how to include  the CSS FLags plugin / library to theme.
 *
 * More information at https://github.com/soderlind/css-flags#theme
 */



// Best practices, load parent style from functions.php don't use @import in style.css
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

//load the CSS FLags library (You have to clone it into your theme folder first: git clone https://github.com/soderlind/css-flags.git )
require_once(dirname(__FILE__) . '/css-flags/css-flags.php');


//add filter(s)
add_action( 'init', function() {
	add_filter('css-flags-countries', function() {
		return array('all'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
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
				width: 15%;
				float: left;
			}
			.flagbox {
				width: 60px;
				height: 60px;
				display: inline-block;
				vertical-align: middle;
			}
			.css-flag {
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
			'countries' => "all"
	    ), $atts,'cssflag');
		$countries = $this->multiexplode(array(",",".","|",":"),$atr['countries']);

		if (in_array('all',$countries)) {
			$countries = array('ad','ae','af','ag','ai','al','am','an','ao','ar','as','at','au','aw','ax','az','ba','basque','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bv','bw','by','bz','ca','catalonia','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cs','cu','cv','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','england','er','es','et','eu','fi','fj','fk','fm','fo','fr','ga','galicia','gb','gd','ge','gf','gg','gh','gi','gl','gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id','ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki','km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv','ly','ma','mc','md','me','mf','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu','mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz','om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re','ro','rs','ru','rw','sa','sami','sb','sc','scotland','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so','sr','st','sv','sy','sz','tc','td','tf','tg','th','tj','tk','tm','tm','tn','to','tr','tt','tv','tw','tz','ua','ug','um','us','uy','uz','va','vc','ve','vg','vi','vn','vu','wales','wf','ws','ye','yt','za','zm','zw');
		}

		$output = '';
		if ( false !== wp_style_is( 'css-flags' ) ) {
			foreach ( $countries as $country) {
				$output .= sprintf('<div class="box"><div class="flagbox"><span class="css-flag %1$s %1$s-portrait"></span></div></div>', $country);
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
