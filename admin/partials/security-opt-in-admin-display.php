<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.brechtryckaert.com
 * @since      1.0.0
 *
 * @package    Security_Opt_In
 * @subpackage Security_Opt_In/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="cleanup_options" action="options.php">
    
    <?php settings_fields($this->plugin_name); ?>
    
    <!-- Text boxes start below -->

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h2><span><?php esc_attr_e( 'About Security-Opt-In', 'wp_admin_style' ); ?></span></h2>

						<div class="inside">
							<p><?php esc_attr_e(
									'Security-Opt-In was created to disable a number of settings that are enable in a default WordPress installation and increase (in my opinion) the risk of hacking. By activating this plugin, these settings are disabled. You can always overrule these individual settings below.',
									'wp_admin_style'
								); ?></p>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h2><span><?php esc_attr_e(
									'Support', 'wp_admin_style'
								); ?></span></h2>

						<div class="inside">
							<p><?php esc_attr_e(
									'Support content to be added here.',
									'wp_admin_style'
								); ?></p>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->
    
    <!-- Form starts below -->
    
    <form method="post" name="cleanup_options" action="options.php">
    
    <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Load current setting of all functions from the database
        $xmlrpc = $options['xmlrpc'];
        $disableauthorpages = $options['disableauthorpages'];
        $removeidentifiers = $options['removeidentifiers'];
        $hidewpversion = $options['hidewpversion'];
        $disablepingback = $options['disablepingback'];
        $disablerestapi = $options['disablerestapi'];
       
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>
    
        <!-- Disable the XML-RPC protocol -->
    	<fieldset>
        	<legend class="screen-reader-text">
            	<span>Disable the XML-RPC protocol</span>
        	</legend>
        	<label for="<?php echo $this->plugin_name; ?>-xmlrpc">
            	<input type="checkbox" id="<?php echo $this->plugin_name; ?>-xmlrpc" name="<?php echo $this->plugin_name; ?>[xmlrpc]" value="1" <?php checked($xmlrpc, 1); ?> />
            	<span><?php esc_attr_e('Disable the XML-RPC protocol', $this->plugin_name); ?></span>
        	</label>
    	</fieldset>
    
        <!-- Disable Author pages -->
        <fieldset>
        	<legend class="screen-reader-text"><span>Disable Author Pages</span></legend>
        		<label for="<?php echo $this->plugin_name; ?>-disableauthorpages">
            		<input type="checkbox" id="<?php echo $this->plugin_name; ?>-disableauthorpages" name="<?php echo $this->plugin_name; ?>[disableauthorpages]" value="1" <?php checked($disableauthorpages, 1); ?> />
            		<span><?php esc_attr_e('Disable Author Pages', $this->plugin_name); ?></span>
        		</label>
    	</fieldset>
    	
    	<!-- Remove identifiers from HEAD -->
        <fieldset>
        	<legend class="screen-reader-text"><span>Remove Identifying Factors From HEAD</span></legend>
        		<label for="<?php echo $this->plugin_name; ?>-removeidentifiers">
            		<input type="checkbox" id="<?php echo $this->plugin_name; ?>-removeidentifiers" name="<?php echo $this->plugin_name; ?>[removeidentifiers]" value="1" <?php checked($removeidentifiers, 1); ?> />
            		<span><?php esc_attr_e('Remove Identifying Factors From HEAD', $this->plugin_name); ?></span>
        		</label>
    	</fieldset>
    	
    	<!-- Hide the WP Version -->
        <fieldset>
        	<legend class="screen-reader-text"><span>Hide the WP version</span></legend>
        		<label for="<?php echo $this->plugin_name; ?>-hidewpversion">
            		<input type="checkbox" id="<?php echo $this->plugin_name; ?>-hidewpversion" name="<?php echo $this->plugin_name; ?>[hidewpversion]" value="1" <?php checked($hidewpversion, 1); ?> />
            		<span><?php esc_attr_e('Hide The WordPress Version', $this->plugin_name); ?></span>
        		</label>
    	</fieldset>
    	
    	<!-- Disable Pingback -->
        <fieldset>
        	<legend class="screen-reader-text"><span>Disable Pingback</span></legend>
        		<label for="<?php echo $this->plugin_name; ?>-disablepingback">
            		<input type="checkbox" id="<?php echo $this->plugin_name; ?>-disablepingback" name="<?php echo $this->plugin_name; ?>[disablepingback]" value="1" <?php checked($disablepingback, 1); ?> />
            		<span><?php esc_attr_e('Disable Pingback', $this->plugin_name); ?></span>
        		</label>
    	</fieldset>
    	
    	    	<!-- Disable REST API -->
        <fieldset>
        	<legend class="screen-reader-text"><span>Disable REST API</span></legend>
        		<label for="<?php echo $this->plugin_name; ?>-disablerestapi">
            		<input type="checkbox" id="<?php echo $this->plugin_name; ?>-disablerestapi" name="<?php echo $this->plugin_name; ?>[disablerestapi]" value="1" <?php checked($disablerestapi, 1); ?> />
            		<span><?php esc_attr_e('Disable REST API', $this->plugin_name); ?></span>
        		</label>
    	</fieldset>
    	
    	<!-- Submit button -->        
        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
