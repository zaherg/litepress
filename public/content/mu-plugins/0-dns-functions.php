<?php
		// Polyfill for DNS functions/features which are not currently supported by @php-wasm/node.
		// See https://github.com/WordPress/wordpress-playground/issues/1042
		// These specific features are polyfilled so the Jetpack plugin loads correctly, but others should be added as needed.
		if ( ! function_exists( 'dns_get_record' ) ) {
			function dns_get_record() {
				return array();
			}
		}
		if ( ! defined( 'DNS_NS' ) ) {
			define( 'DNS_NS', 2 );
		}