<?php
/*
 * Plugin Name: Google Drive
 * Plugin URI: http://wordpress.lowtone.nl/media-google-drive
 * Description: Add files from Google Drive.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2011-2012, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\plugins\lowtone\media\google\drive
 */

namespace lowtone\media\google\drive {

	use lowtone\content\packages\Package,
		lowtone\media\types\Type;

	// Includes
	
	if (!include_once WP_PLUGIN_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content plugin is required", E_USER_ERROR) && false;

	$__i = Package::init(array(
			Package::INIT_PACKAGES => array("lowtone", "lowtone\\media"),
			Package::INIT_MERGED_PATH => __NAMESPACE__,
			Package::INIT_SUCCESS => function() {

				// Register textdomain
				
				load_plugin_textdomain("lowtone_media_google_drive", false, basename(__DIR__) . "/assets/languages");

				// Add media type

				\lowtone\media\addMediaType(new Type(array(
						Type::PROPERTY_TITLE => __("Google Drive", "lowtone_media_google_drive"),
						Type::PROPERTY_NEW_FILE_TEXT => __("Import a file from Google Drive.", "lowtone_media_google_drive"),
						Type::PROPERTY_SLUG => "google-drive",
						Type::PROPERTY_IMAGE => plugins_url("/assets/images/google-drive-icon.png", __FILE__),
						Type::PROPERTY_NEW_FILE_CALLBACK => function() {

							echo '<div class="wrap">' . 
								get_screen_icon() . 
								'<h2>' . __("Select a file on Google Drive", "lowtone_media_google_drive") . '</h2>' . 
								'<p>' . __("Select the file you want to import.", "lowtone_media_google_drive") . '</p>';

							echo '</div>';
							
						}
					)));

				add_filter("media_upload_tabs", function($tabs) {
					$tabs["google-drive"] = __("Google Drive", "lowtone_media_google_drive");

					return $tabs;
				});

				add_action("media_upload_google-drive", function() {
					
				});

				return true;
			}
		));

	if (!$__i)
		return false;

}