<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/public
 * @author     Brecht Ryckaert <brecht@mediagraaf.be>
 */
class Security_Opt_In_Public
{
    /**
     * @var      bool $disableXmlrpc Whether or not to enable XMLRPC
     */
    protected $disableXmlrpc;

    /**
     * @var      bool $disableAuthorPages Whether or not to disable author pages
     */
    protected $disableAuthorPages;

    /**
     * @var      bool $removeIdentifiers Whether or not to remove identifiers
     */
    protected $removeIdentifiers;

    /**
     * @var      bool $hideWPVersion Whether or not to hide the Wordpress version
     */
    protected $hideWPVersion;

    /**
     * @var      bool $disablePingback Whether or not to disable pingback
     */
    protected $disablePingback;

    /**
     * @var      bool $disableRestApi Whether or not to disable the REST API
     */
    protected $disableRestApi;

    public function __construct($disableXmlrpc=false, $disableAuthorPages=false, $removeIdentifiers=false, $hideWPVersion=false, $disablePingback=false, $disableRestApi=false)
    {
        $this->disableXmlrpc = $disableXmlrpc;
        $this->disableAuthorPages = $disableAuthorPages;
        $this->removeIdentifiers = $removeIdentifiers;
        $this->hideWPVersion = $hideWPVersion;
        $this->disablePingback = $disablePingback;
        $this->disableRestApi = $disableRestApi;
    }

    /**
     * Disable the XML-RPC protocol - function
     */
    public function Security_Opt_In_xmlrpc()
    {

        if ($this->disableXmlrpc) {

            add_filter('xmlrpc_enabled', '__return_false');

        }
    }

    /**
     * Disable Author Pages - function
     */
    public function Security_Opt_In_disableAuthorPages()
    {

        if ($this->disableAuthorPages && preg_match($_SERVER['REQUEST_URI'], '/^\/\?author=[0-9]+/')) {
            wp_safe_redirect(get_bloginfo('url'), '301');
        }
    }

    /**
     * Remove Identifying Factors From HEAD - function
     */
    public function Security_Opt_In_removeidentifiers()
    {

        if ($this->removeIdentifiers) {

            remove_action('wp_head', 'rsd_link');                 // RSD link
            remove_action('wp_head', 'feed_links_extra', 3);            // Category feed link
            remove_action('wp_head', 'feed_links', 2);                // Post and comment feed links
            remove_action('wp_head', 'index_rel_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'parent_post_rel_link', 10, 0);        // Parent rel link
            remove_action('wp_head', 'start_post_rel_link', 10, 0);       // Start post rel link
            remove_action('wp_head', 'rel_canonical', 10, 0);
            remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Adjacent post rel link
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');

        }
    }

    public function Security_Opt_In_hidewpversion()
    {

        if ($this->hideWPVersion) {
            remove_action('wp_head', 'wp_generator');
            add_filter('the_generator', function () {
                return '';
            });
        }
    }


    /**
     * Disable Pingback - function
     */
    public function Security_Opt_In_disablepingback()
    {

        if ($this->disablePingback) {

            add_filter('xmlrpc_methods', function ($methods) {
                unset($methods['pingback.ping']);
                return $methods;
            });

        }
    }


    /**
     * Disable Rest API - function
     */
    public function Security_Opt_In_disablerestapi()
    {

        if ($this->disableRestApi) {
            add_filter('json_enabled', '__return_false');
            add_filter('json_jsonp_enabled', '__return_false');

        }
    }


    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style(Security_Opt_In::PLUGIN_NAME, plugin_dir_url(__FILE__) . 'css/security-opt-in-public.css',
            array(), Security_Opt_In::PLUGIN_VERSION, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script(Security_Opt_In::PLUGIN_NAME, plugin_dir_url(__FILE__) . 'js/security-opt-in-public.js',
            array('jquery'), Security_Opt_In::PLUGIN_VERSION, false);

    }


}
