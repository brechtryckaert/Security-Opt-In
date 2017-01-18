<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.brechtryckaert.com
 * @since             1.0.0
 * @package           Security_Opt_In
 *
 * @wordpress-plugin
 * Plugin Name:       Security-Opt-In
 * Plugin URI:        https://www.brechtryckaert.com/plugins
 * Description:       Security-Opt-In disables a number of features (that are enabled in WordPress by default) to improve the security of your WordPress website. Since certain other plugins and themes need these functions, you also get a control panel where you can manually override settings.
 * Version:           1.0.0
 * Author:            Brecht Ryckaert
 * Author URI:        https://www.brechtryckaert.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       security-opt-in
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-security-opt-in-activator.php
 */
function activate_security_opt_in()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-security-opt-in-activator.php';
    Security_Opt_In_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-security-opt-in-deactivator.php
 */
function deactivate_security_opt_in()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-security-opt-in-deactivator.php';
    Security_Opt_In_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_security_opt_in');
register_deactivation_hook(__FILE__, 'deactivate_security_opt_in');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-security-opt-in.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_security_opt_in()
{

    $plugin = new Security_Opt_In();
    $plugin->run();

}

run_security_opt_in();
