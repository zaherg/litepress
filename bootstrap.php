<?php

require __DIR__ . '/vendor/autoload.php';

// Load .env file
$env = \Dotenv\Dotenv::createMutable(__DIR__);
$env->load();

// Salts
define('AUTH_KEY', $_ENV['AUTH_KEY']);
define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY']);
define('NONCE_KEY', $_ENV['NONCE_KEY']);
define('AUTH_SALT', $_ENV['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT']);
define('NONCE_SALT', $_ENV['NONCE_SALT']);

// Development
define('SAVEQUERIES', $_ENV['APP_ENV'] !== 'production');
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', $_ENV['SCRIPT_DEBUG']);
define('GRAPHQL_DEBUG', $_ENV['APP_ENV'] !== 'production');

// WP
$table_prefix = getenv('DB_PREFIX') ? getenv('DB_PREFIX') : 'wp_';
define('WP_HOME', $_ENV['WP_HOME']);
define('WP_SITEURL', $_ENV['WP_SITEURL']);
define('CONTENT_DIR', 'content');
define('WP_CONTENT_FOLDERNAME', 'content');
define('WP_CONTENT_DIR', __DIR__ . '/public/' . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . '/' . CONTENT_DIR);

// define('WP_DEBUG_LOG', CONTENT_DIR.'/error.log');
define('WP_DEBUG_LOG', true);
define('DISALLOW_FILE_EDIT', true);
define('ALLOW_UNFILTERED_UPLOADS', true);
define('WP_POST_REVISIONS', false);
//define('AUTOSAVE_INTERVAL', 86400);