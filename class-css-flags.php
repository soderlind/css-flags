<?php
/**
 * class CSSFlags creates a CSS with SVG flags
 *
 * The CSS greated are defined using the following filters:
 * - css-flags-regions
 * - css-flags-all-regions
 * - css-flags-exclude
 * The filters are documented at https://github.com/soderlind/css-flags#usage
 *
 * @since 0.1.3
 */
header( "Content-type: text/css; charset: UTF-8" );

if ( defined( 'ABSPATH' ) ) {
	CSSFlags::instance();
}

class CSSFlags {

	private static $instance;
	private $start = 0;

	public static function instance() {
		if ( self::$instance ) {
			return self::$instance;
		}
		self::$instance = new self();
		return self::$instance;
	}

	private function __construct() {
		$this->get_css();
	}

	private function get_css() {

		$this->timer('start');

		$cachetime = filter_var( apply_filters( 'css-flags-cachetime', 7200 ) , FILTER_VALIDATE_INT, array( 'default'    => 7200 ) );
		$data_path = dirname( __FILE__ );

		//new version? reset the cache
		$options = get_option( "CSS_Flags" );
		$version = (isset($options['version'])) ? $options['version'] : '0';
		if ( $version != CSSFLAGS_VERSION ) {
			$options['version'] = CSSFLAGS_VERSION;
			delete_transient( 'css-flags-all-countries' );
			delete_transient( 'css-flags-all-regions' );
			update_option( "CSS_Flags", $options );
		}

		//add country falgs to cache
		if ( false === ( $css_flags = get_transient( "css-flags-all-countries" ) ) ) {
			$json = file_get_contents( esc_url( $data_path  . '/data/flags.json' ) );
			$css_flags = json_decode( $json, true );

			set_transient( "css-flags-all-countries", $css_flags,  $cachetime );
		}

		//add regions to cache
		if ( false === ( $regions = get_transient( "css-flags-all-regions" ) ) ) {
			$json = file_get_contents( esc_url( $data_path  . '/data/regions.json' ) );
			$regions = json_decode( $json, true );

			set_transient( "css-flags-all-regions", $regions, $cachetime );
		}


		$countries = array();
		if ( count( $regions_selected = apply_filters( 'css-flags-regions', array() ) ) > 0 ) { // europe, oceania, africa, asia, northamerica, southamerica, middleeast
			$countries_regions = array();
			foreach ( array_values( array_intersect_key( $regions, array_flip( $regions_selected ) ) ) as $key => $value ) {
				$countries_regions = array_merge( $countries_regions, $value );
			}
			$countries = array_keys( $countries_regions );
		} else {
			$countries = apply_filters( 'css-flags-countries', array() );
		}



		if ( count( $countries ) > 0 ) {
			$countries = array_diff( $countries , apply_filters( 'css-flags-exclude', array() ) );
		}


		$this->timer('stop');

		$template = '
		.css-flag.%1$s {
			background-image: %2$s;
			height: %3$s;
			width: %4$s;
			background-size: 100%% 100%%;
		}
		.css-flag.%1$s-landscape {
			height: %3$s;
			width: %4$s;
		}
		.css-flag.%1$s-portrait {
			height: %5$s;
			width: %6$s;
		}
		';

		if ( 'all' == implode( '', $countries ) ) {
			foreach ( $css_flags as $country_code => $css ) {
				printf( $template,
					$country_code,
					$css['background'],
					$css['renderer']['landscape']['height'],
					$css['renderer']['landscape']['width'],
					$css['renderer']['portrait']['height'],
					$css['renderer']['portrait']['width']
				);
			}
		} elseif ( count( $countries ) > 0 ) {
			foreach ( array_intersect_key( $css_flags, array_flip( $countries ) ) as $country_code => $css ) {
				printf( $template,
					$country_code,
					$css['background'],
					$css['renderer']['landscape']['height'],
					$css['renderer']['landscape']['width'],
					$css['renderer']['portrait']['height'],
					$css['renderer']['portrait']['width']
				);
			}
		}

	}

	/**
	 * helper method, used to benchmark CSS Flags
	 * @param  string $event 'start' or 'stop'
	 */
	private function timer($event = 'start') {

		$time = microtime();
		$time = explode( ' ', $time );
		$time = $time[1] + $time[0];


		switch ($event) {
			case 'start':
				$this->start = $time;
				break;
			case 'stop':
				if (0 != $this->start) {
					$finish = $time;
					$total_time = round( ( $finish - $this->start ), 4 );

					echo '/* CSS Flags (https://github.com/soderlind/css-flags) generated in '.$total_time.' seconds. */';
				}
				break;
		}
	}

}
