<?php
/*
Plugin Name: CSS Flags
Plugin URI: https://github.com/soderlind/css-flags
Description: The plugin has responsive SVG flags for 252 countries. See <a href="https://github.com/soderlind/css-flags#usage">documentation</a>.
Author: Per Soderlind
Version: 0.1.9
Author URI: http://soderlind.no
GitHub Plugin URI: soderlind/css-flags
Credits: http://www.phoca.cz/cssflags/
*/

if ( !defined( 'ABSPATH' ) ) {
	die( 'Cheating, are we?' );
}


define( 'CSSFLAGS_VERSION', '0.1.9' );


function css_flags_enqueue() {
	wp_enqueue_style( 'css-flags', admin_url( 'admin-ajax.php' ).'?action=css_flags_loader&wpnonce=' . wp_create_nonce( 'css-flags-nonce' ), false,  CSSFLAGS_VERSION );
}

function css_flags_loader() {
	$nonce = $_REQUEST['wpnonce'];
	if ( ! wp_verify_nonce( $nonce, 'css-flags-nonce' ) ) {
		die( 'invalid nonce' );
	} else {
		/**
		 * NOTE: Using require or include to call an URL (created by plugins_url() or get_template_directory(), can create the following error:
		 *       Warning: require(): http:// wrapper is disabled in the server configuration by allow_url_include=0
		 *       Warning: require(http://domain/path/flags/css.php): failed to open stream: no suitable wrapper could be found
		 *       Fatal error: require(): Failed opening required 'http://domain/path/css.php'
		 */
		require dirname( __FILE__ ) . '/class-css-flags.php';
	}
	exit;
}

add_action( 'wp_ajax_css_flags_loader', 'css_flags_loader' );
add_action( 'wp_ajax_nopriv_css_flags_loader', 'css_flags_loader' );
add_action( 'wp_enqueue_scripts', 'css_flags_enqueue' );
