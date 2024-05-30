<?php
/**
 * This is a temporary workaround to hide the 32bit integer warnings that
 * appear when using various time related function, such as strtotime and mktime.
 * Examples of the warnings that are displayed:
 * Warning: mktime(): Epoch doesn't fit in a PHP integer in <file>
 * Warning: strtotime(): Epoch doesn't fit in a PHP integer in <file>
 */
set_error_handler(function($severity, $message, $file, $line) {
  if (strpos($message, "fit in a PHP integer") !== false) {
      return;
  }
  return false;
});
