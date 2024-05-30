<?php
	// Needed because gethostbyname( <host> ) returns
	// a private network IP address for some reason.
	add_filter( 'allowed_redirect_hosts', function( $hosts ) {
		$redirect_hosts = array(
			'wordpress.org',
			'api.wordpress.org',
			'downloads.wordpress.org',
			'themes.svn.wordpress.org',
			'fonts.gstatic.com',
		);
		return array_merge( $hosts, $redirect_hosts );
	} );
	add_filter('http_request_host_is_external', '__return_true', 20, 3 );
	