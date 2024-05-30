<?php

/**
 * Plugin Name: Using SMTP
 * Description: Modify WP to use SMTP
 * Version:     1.0.0
 * Update URI:  false
 */


function helo($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = '127.0.0.1';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'wordpress-Name';
    $phpmailer->Password = '';
}

add_action('phpmailer_init', 'helo');