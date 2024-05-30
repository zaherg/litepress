<?php
		// Facilitates the taking of screenshots to be used as thumbnails.
		if ( isset( $_GET['studio-hide-adminbar'] ) ) {
			add_filter( 'show_admin_bar', '__return_false' );
		}
		