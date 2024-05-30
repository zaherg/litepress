<?php
	function check_current_theme_availability() {
			// Get the current theme's directory
			$current_theme = wp_get_theme();
			$theme_dir = get_theme_root() . '/' . $current_theme->stylesheet;

			if (!is_dir($theme_dir)) {
					$all_themes = wp_get_themes();
					$available_themes = [];

					foreach ($all_themes as $theme_slug => $theme_obj) {
							if ($theme_slug != $current_theme->get_stylesheet()) {
									$available_themes[$theme_slug] = $theme_obj;
							}
					}

					if (!empty($available_themes)) {
							$new_theme_slug = array_keys($available_themes)[0];
							switch_theme($new_theme_slug);
					}
			}
	}
	add_action('after_setup_theme', 'check_current_theme_availability');
