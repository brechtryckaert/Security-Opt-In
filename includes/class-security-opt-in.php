<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.brechtryckaert.com
 * @since      1.0.0
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/includes
 * @author     Brecht Ryckaert <brecht@mediagraaf.be>
 */
class Security_Opt_In
{
    /**
     * Plugin name
     */
    const PLUGIN_NAME = 'Security_Opt_In';
    /**
     * Plugin version
     */
    const PLUGIN_VERSION = '1.0.0';
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     * @var      Security_Opt_In_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct()
    {
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Security_Opt_In_Loader. Orchestrates the hooks of the plugin.
     * - Security_Opt_In_i18n. Defines internationalization functionality.
     * - Security_Opt_In_Admin. Defines all hooks for the admin area.
     * - Security_Opt_In_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     */
    protected function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-security-opt-in-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-security-opt-in-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-security-opt-in-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-security-opt-in-public.php';

        $this->loader = new Security_Opt_In_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Security_Opt_In_i18n class in order to set the domain and to register the hook
     * with WordPress.
     */
    protected function set_locale()
    {

        $plugin_i18n = new Security_Opt_In_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     */
    protected function define_admin_hooks()
    {

        $plugin_admin = new Security_Opt_In_Admin();

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        // Save/Update our plugin options
        $this->loader->add_action('admin_init', $plugin_admin, 'options_update');
        // Add menu item
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
        // Add Settings link to the plugin
        $plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . Security_Opt_In::PLUGIN_NAME . '.php');
        $this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links');

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     * @todo: Provide Security_Opt_In_Public constructor arguments
     */
    protected function define_public_hooks()
    {
        //TODO
        $plugin_public = new Security_Opt_In_Public();

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     * @return    Security_Opt_In_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }
}
