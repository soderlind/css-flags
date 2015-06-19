<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

delete_transient( 'css-flags-all-countries' );
delete_transient( 'css-flags-all-regions' );
delete_option( 'CSS_Flags' );
