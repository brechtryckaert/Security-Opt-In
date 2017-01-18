<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.brechtryckaert.com
 * @since      1.0.0
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/admin
 * @author     Brecht Ryckaert <brecht@mediagraaf.be>
 */
class Security_Opt_In_Admin
{
    /**
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Security_Opt_In_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Security_Opt_In_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(Security_Opt_In::PLUGIN_NAME, plugin_dir_url(__FILE__) . 'css/security-opt-in-admin.css',
            array(), Security_Opt_In::PLUGIN_VERSION, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Security_Opt_In_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Security_Opt_In_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(Security_Opt_In::PLUGIN_NAME, plugin_dir_url(__FILE__) . 'js/security-opt-in-admin.js',
            array('jquery'), Security_Opt_In::PLUGIN_VERSION, false);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     */

    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_options_page('Security-Opt-In Settings', 'Security-Opt-In', 'manage_options', Security_Opt_In::PLUGIN_NAME,
            array($this, 'display_plugin_setup_page')
        );
    }

    /**
     * Add settings action link to the plugins page.
     */

    public function add_action_links($links)
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . Security_Opt_In::PLUGIN_NAME) . '">' . __('Settings',
                Security_Opt_In::PLUGIN_NAME) . '</a>',
        );
        return array_merge($settings_link, $links);

    }

    /**
     * Render the settings page for this plugin.
     */

    public function display_plugin_setup_page()
    {
        include_once('partials/security-opt-in-admin-display.php');
    }

    public function options_update()
    {
        register_setting(Security_Opt_In::PLUGIN_NAME, Security_Opt_In::PLUGIN_NAME, array($this, 'validate'));
    }

    public function validate($input)
    {
        // All checkboxes inputs
        $valid = array();

        //Validate the input of all different functions
        $valid['xmlrpc'] = (isset($input['xmlrpc']) && !empty($input['xmlrpc'])) ? 1 : 0;
        $valid['disableauthorpages'] = (isset($input['disableauthorpages']) && !empty($input['disableauthorpages'])) ? 1 : 0;
        $valid['removeidentifiers'] = (isset($input['removeidentifiers']) && !empty($input['removeidentifiers'])) ? 1 : 0;
        $valid['hidewpversion'] = (isset($input['hidewpversion']) && !empty($input['hidewpversion'])) ? 1 : 0;
        $valid['disablepingback'] = (isset($input['disablepingback']) && !empty($input['disablepingback'])) ? 1 : 0;
        $valid['disablerestapi'] = (isset($input['disablerestapi']) && !empty($input['disablerestapi'])) ? 1 : 0;

        return $valid;
    }

}
