<?php

// https://stackoverflow.com/a/41043588/1109380
remove_action('rest_api_init', 'create_initial_rest_routes', 99);

// belt and suspenders:
// https://www.ultimatewoo.com/disable-wordpress-rest-api/
/*
 * Disable the WP REST API
 */
add_filter( 'rest_authentication_errors', function ($access) {
	return new WP_Error( 'rest_disabled', __( 'The REST API on this site has been disabled.' ), array( 'status' => rest_authorization_required_code() ) );
});
