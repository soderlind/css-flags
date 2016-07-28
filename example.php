<?php

/**
 * example, add to another plugin or a themes functions.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheating, are we?' );
}

add_action( 'init', function() {
	add_filter('css-flags-countries', function() {
		return array( 'no','se','gb','us' ); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
	});
	// add_filter('css-flags-regions', function() {
	// 	return array('europe'); //europe, oceania, africa, asia, northamerica, southamerica, middleeast
	// });
	add_filter('css-flags-exclude', function() {
		return array( 'gb' );
	});
});
