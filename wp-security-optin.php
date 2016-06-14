<?php
/*
Plugin Name: Security Opt-In
Plugin URI: http://www.brechtryckaert.com/plugins
Description: This plugin provides an opt-in functionality for several security related settings in the WordPress backend.
Version: 1.0
Author: Brecht Ryckaert
Author URI: http://www.brechtryckaert.com/
License: GPLv2
*/

/*  Copyright 2016 Brecht Ryckaert  (http://www.brechtryckaert.com/)

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

add_action('admin_menu', 'wp_security_optin_add_page');

// Init plugin options to white list our options
function wp_security_optin_init(){
	register_setting( 'wp_security_optin_options', 'wp_security_optin_settings' );
}

// Add menu page
function wp_security_optin_add_page() {
	add_options_page('Security Opt-In', 'Security Opt-In', 'manage_options', 'wp_security_optin', 'wp_security_optin_do_page');
}

add_action('admin_init', 'wp_security_optin_init' );

// Draw the menu page itself
function wp_security_optin_do_page() {
	?>
	<div class="wrap">
		<h1>Security Opt-In</h1>
		<p>This plugin allows you to control several security related settings from withing the WordPress Backend. By default, when WP Security Opt-In will be activated, these options are disabled for improved security. By default in WordPress though, these options are enabled, which may result in a security risk. You can't opt-in to these functionalities when and if you need them by changing the options below.</p>
		<form method="post" action="options.php">
			<?php settings_fields('wp_security_optin_options'); ?>
			<?php $options = get_option('wp_security_optin_settings'); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row">XML-RPC is enabled</th>
					<td><input name="wp_security_optin_settings[xmlrpcenabled]" type="checkbox" value="1" <?php checked('1', $options['xmlrpcenabled']); ?> /></td>
				</tr>
				<th scope="row">Author Pages are enabled (currently unsupported)</th>
					<td><input name="wp_security_optin_settings[authorpagesenabled]" type="checkbox" value="1" <?php checked('1', $options['authorpagesenabled']); ?> /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function wp_security_optin_validate($input) {
	// Validate input of XML-RPC function being 0 or 1
	$input['xmlrpcenabled'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Validate input of XML-RPC function being 0 or 1
	$input['authorpagesenabled'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	return $input;
}

// Perform actions based on input of user
#$off = '0'
#if $option[xmlrpcenabled] > $off
#	wp_security_optin_xmlrpc_enabled;

 
#Action if XML-RPC is set to disabled
function wp_security_optin_xmlrpc_disabled(){
	add_filter( 'xmlrpc_enabled', '__return_false' );
}

#Action if XML-RPC is set to enabled
function wp_security_optin_xmlrpc_enabled(){
	add_filter( 'xmlrpc_enabled', '__return_true' );
}
 
?>