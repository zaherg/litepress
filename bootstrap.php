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

/**
-- Set the journal mode to Write-Ahead Logging for concurrency
PRAGMA journal_mode = WAL;

-- Set synchronous mode to NORMAL for performance and data safety balance
PRAGMA synchronous = NORMAL;

-- Set busy timeout to 5 seconds to avoid "database is locked" errors
PRAGMA busy_timeout = 5000;

-- Set cache size to 20MB for faster data access
PRAGMA cache_size = -20000;

-- Enable foreign key constraint enforcement
PRAGMA foreign_keys = ON;

-- Enable auto vacuuming and set it to incremental mode for gradual space reclaiming
PRAGMA auto_vacuum = INCREMENTAL;

-- Store temporary tables and data in memory for better performance
PRAGMA temp_store = MEMORY;

-- Set the mmap_size to 2GB for faster read/write access using memory-mapped I/O
PRAGMA mmap_size = 2147483648;

-- Set the page size to 8KB for balanced memory usage and performance
PRAGMA page_size = 8192;
 */

// SQLite PRAGMA Settings
define('SQLITE_JOURNAL_MODE', $_ENV['SQLITE_JOURNAL_MODE'] ?? 'WAL');
define('SQLITE_SYNCHRONOUS', 'NORMAL');
define('SQLITE_BUSY_TIMEOUT', 5000);
define('SQLITE_CACHE_SIZE', -20000);
define('SQLITE_FOREIGN_KEYS', 'ON');
define('SQLITE_AUTO_VACUUM', 'INCREMENTAL');
define('SQLITE_TEMP_STORE', 'MEMORY');
define('SQLITE_MMAP_SIZE', 2147483648);
define('SQLITE_PAGE_SIZE', 8192);


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
