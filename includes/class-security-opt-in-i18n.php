<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/includes
 * @author     Brecht Ryckaert <brecht@mediagraaf.be>
 */
class Security_Opt_In_i18n
{


    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'security-opt-in',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }


}
