<?php
/**
 *
 */
header( "Content-type: text/css; charset: UTF-8" );


$css_flags_time = microtime();
$css_flags_time = explode( ' ', $css_flags_time );
$css_flags_time = $css_flags_time[1] + $css_flags_time[0];
$css_flags_start = $css_flags_time;


$css_flags_cachetime = filter_var( apply_filters( 'css-flags-cachetime', 7200 ) , FILTER_VALIDATE_INT, array( 'default'    => 7200 ) );
$css_flags_data_path = dirname( __FILE__ );

//new version? reset the cache
$css_flags_options = get_option( "CSS_Flags" );
$css_flags_version = (isset($css_flags_options['version'])) ? $css_flags_options['version'] : '0';
if ( $css_flags_version != CSSFLAGS_VERSION ) {
	$css_flags_options['version'] = CSSFLAGS_VERSION;
	delete_transient( 'css-flags-all-countries' );
	delete_transient( 'css-flags-all-regions' );
	update_option( "CSS_Flags", $css_flags_options );
}

//add country falgs to cache
if ( false === ( $css_flags = get_transient( "css-flags-all-countries" ) ) ) {
	$css_flags_json = file_get_contents( esc_url( $css_flags_data_path  . '/data/flags.json' ) );
	$css_flags = json_decode( $css_flags_json, true );

	set_transient( "css-flags-all-countries", $css_flags,  $css_flags_cachetime );
}

//add regions to cache
if ( false === ( $css_flags_regions = get_transient( "css-flags-all-regions" ) ) ) {
	$css_flags_json = file_get_contents( esc_url( $css_flags_data_path  . '/data/regions.json' ) );
	$css_flags_regions = json_decode( $css_flags_json, true );

	set_transient( "css-flags-all-regions", $css_flags_regions, $css_flags_cachetime );
}


$css_flags_countries = array();
if ( count( $css_flags_regions_selected = apply_filters( 'css-flags-regions', array() ) ) > 0 ) { // europe, oceania, africa, asia, northamerica, southamerica, middleeast
	$css_flags_countries_regions = array();
	foreach ( array_values( array_intersect_key( $css_flags_regions, array_flip( $css_flags_regions_selected ) ) ) as $key => $value ) {
		$css_flags_countries_regions = array_merge( $css_flags_countries_regions, $value );
	}
	$css_flags_countries = array_keys( $css_flags_countries_regions );
} else {
	$css_flags_countries = apply_filters( 'css-flags-countries', array() );
}



if ( count( $css_flags_countries ) > 0 ) {
	$css_flags_countries = array_diff( $css_flags_countries , apply_filters( 'css-flags-exclude', array() ) );
}


$css_flags_time = microtime();
$css_flags_time = explode( ' ', $css_flags_time );
$css_flags_time = $css_flags_time[1] + $css_flags_time[0];
$css_flags_finish = $css_flags_time;
$css_flags_total_time = round( ( $css_flags_finish - $css_flags_start ), 4 );

echo '/* CSS generated in '.$css_flags_total_time.' seconds. */';

$css_flags_template = '
.css-flag .%1$s {
	background-image: %2$s;
	height: %3$s;
	width: %4$s;
	background-size: 100%% 100%%;
}
.css-flag .%1$s-landscape {
	height: %3$s;
	width: %4$s;
}
.css-flag .%1$s-portrait {
	height: %5$s;
	width: %6$s;
}
';

if ( 'all' == implode( '', $css_flags_countries ) ) {
	foreach ( $css_flags as $country_code => $css ) {
		printf( $css_flags_template,
			$country_code,
			$css['background'],
			$css['renderer']['landscape']['height'],
			$css['renderer']['landscape']['width'],
			$css['renderer']['portrait']['height'],
			$css['renderer']['portrait']['width']
		);
	}
} elseif ( count( $css_flags_countries ) > 0 ) {
	foreach ( array_intersect_key( $css_flags, array_flip( $css_flags_countries ) ) as $country_code => $css ) {
		printf( $css_flags_template,
			$country_code,
			$css['background'],
			$css['renderer']['landscape']['height'],
			$css['renderer']['landscape']['width'],
			$css['renderer']['portrait']['height'],
			$css['renderer']['portrait']['width']
		);
	}
}
