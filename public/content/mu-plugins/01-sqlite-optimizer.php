<?php
/**
 * Plugin Name: SQLite Optimizer
 * Description: Optimizes SQLite database performance with configurable PRAGMA settings via define constants
 * Version: 1.0.0
 * Author: Claude.ai
 * Author URI: https://Claude.ai
 * Based on: https://briandouglas.ie/sqlite-defaults/
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get define constant with a default value
 */
function get_sqlite_constant($name, $default) {
    return defined($name) ? constant($name) : $default;
}

/**
 * Initialize SQLite optimizations
 */
function optimize_sqlite_database() {
    global $wpdb;

    // Only proceed if we're using SQLite
    if (!defined('DB_ENGINE') || 'sqlite' !== DB_ENGINE) {
        return;
    }

    // Get the PDO instance
    if (isset($GLOBALS['@pdo'])) {
        $pdo = $GLOBALS['@pdo'];
    } else {
        return;
    }

    try {
        // Array of PRAGMA settings with constants and defaults
        $pragma_settings = [
            // Write-Ahead Logging for better concurrency
            'journal_mode' => [
                'value' => get_sqlite_constant('SQLITE_JOURNAL_MODE', 'WAL'),
                'description' => 'Journal mode setting'
            ],

            // Balance between performance and data safety
            'synchronous' => [
                'value' => get_sqlite_constant('SQLITE_SYNCHRONOUS', 'NORMAL'),
                'description' => 'Synchronous mode setting'
            ],

            // Prevent "database is locked" errors (in milliseconds)
            'busy_timeout' => [
                'value' => (int)get_sqlite_constant('SQLITE_BUSY_TIMEOUT', 5000),
                'description' => 'Busy timeout setting'
            ],

            // Cache size in KB (negative value means KB instead of pages)
            'cache_size' => [
                'value' => (int)get_sqlite_constant('SQLITE_CACHE_SIZE', -20000),
                'description' => 'Cache size setting'
            ],

            // Enable foreign key constraints
            'foreign_keys' => [
                'value' => get_sqlite_constant('SQLITE_FOREIGN_KEYS', 'ON'),
                'description' => 'Foreign keys enforcement'
            ],

            // Auto vacuum mode
            'auto_vacuum' => [
                'value' => get_sqlite_constant('SQLITE_AUTO_VACUUM', 'INCREMENTAL'),
                'description' => 'Auto vacuum mode'
            ],

            // Temporary storage location
            'temp_store' => [
                'value' => get_sqlite_constant('SQLITE_TEMP_STORE', 'MEMORY'),
                'description' => 'Temporary storage location'
            ],

            // Memory map size in bytes
            'mmap_size' => [
                'value' => (int)get_sqlite_constant('SQLITE_MMAP_SIZE', 2147483648),
                'description' => 'Memory map size'
            ],

            // Page size in bytes
            'page_size' => [
                'value' => (int)get_sqlite_constant('SQLITE_PAGE_SIZE', 8192),
                'description' => 'Database page size'
            ]
        ];

        // Apply each PRAGMA setting
        foreach ($pragma_settings as $pragma => $config) {
            try {
                // Skip if the constant is explicitly set to 'OFF'
                if ($config['value'] === 'OFF') {
                    if (defined('WP_DEBUG') && WP_DEBUG) {
                        error_log("SQLite Optimizer: Skipping $pragma (disabled by constant)");
                    }
                    continue;
                }

                $result = $pdo->exec("PRAGMA $pragma = " . $config['value']);

                // Log the operation if in debug mode
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    $status = $result !== false ? 'Success' : 'Failed';
                    error_log("SQLite Optimizer: Setting $pragma to {$config['value']} - $status");
                }
            } catch (PDOException $e) {
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    error_log("SQLite Optimizer Error ($pragma): " . $e->getMessage());
                }
            }
        }

        // Verify the settings if in debug mode
        if (defined('WP_DEBUG') && WP_DEBUG) {
            foreach ($pragma_settings as $pragma => $config) {
                if ($config['value'] !== 'OFF') {
                    $value = $pdo->query("PRAGMA $pragma")->fetch(PDO::FETCH_COLUMN);
                    error_log("SQLite Optimizer: $pragma is set to: $value");
                }
            }
        }

    } catch (Exception $e) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("SQLite Optimizer Error: " . $e->getMessage());
        }
    }
}

// Hook into WordPress initialization
add_action('plugins_loaded', 'optimize_sqlite_database', 0);