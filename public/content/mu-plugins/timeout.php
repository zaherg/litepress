<?php

/**
 * Plugin Name: HTTP Request timeout modifier
 * Description: Modify the timeout value to 150
 * Version:     1.0.0
 * Update URI:  false
 */

add_filter('http_request_args', function ($args) {
    $args['timeout'] = 150;
    return $args;
}, 100, 1);

add_action('http_api_curl', function ($handle) {
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 150);
    curl_setopt($handle, CURLOPT_TIMEOUT, 150);
}, 100, 1);

add_action('admin_init', function () {
    wp_deregister_script('autosave');
}, 100, 1);
