<?php
/*
Plugin Name: CookieHub - Cookie Consent Banner (DSGVO, CCPA, RGPD and GDPR compliance)
Plugin URI: https://www.cookiehub.com/wordpress
Description: Take control effortlessly with CookieHub – GDPR-compliant solution for cookie management and compliance. 
Version: 1.1.4
Author: CookieHub
Author URI: https://www.cookiehub.com/
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'includes/ch-install.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-activate.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-generate.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-register-domain.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-sidebar.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-toolbar.php';
require_once plugin_dir_path(__FILE__) . 'includes/ch-api.php';


add_filter("plugin_action_links_".plugin_basename(__FILE__), 'chh_settings_link');
function chh_settings_link($links) {
    $settings_link = '<a href="admin.php?page=my-setting-admin">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

register_uninstall_hook(__FILE__, 'dcchub_uninstall');

add_action('admin_notices', 'chh_custom_notice');
function chh_custom_notice() {
    $options = get_option('dcchub_option_name');
    
    if (!isset( $options['dcchub_api_key'] )) {
        // Check if we are on the Plugins page
        $current_screen = get_current_screen();
        if ($current_screen && $current_screen->id === 'plugins') {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e('You CookieHub plugin hasn\'t been setup. Click <a href="admin.php?page=my-setting-admin">here</a> to start your jurney to GDPR compliancy.', 'my-setting-admin'); ?></p>
            </div>
            <?php
        }
    }
}