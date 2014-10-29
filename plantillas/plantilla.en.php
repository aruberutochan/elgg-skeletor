<?php
/**
 * The core language file is in /languages/en.php and each plugin has its
 * language files in a languages directory. To change a string, copy the
 * mapping into this file.
 *
 * For example, to change the blog Tools menu item
 * from \"Blog\" to \"Rantings\", copy this pair:
 * 			'blog' => \"Blog\",
 * into the $mapping array so that it looks like:
 * 			'blog' => \"Rantings\",
 *
 * Follow this pattern for any other string you want to change. Make sure this
 * plugin is lower in the plugin list than any plugin that it is modifying.
 *
 * If you want to add languages other than English, name the file according to
 * the language's ISO 639-1 code: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 */

$mapping = array(
	'[[NAME]]:menu' => '[[NAME]]',
	'[[NAME]]:none' => 'No [[NAME]]',
	'[[NAME]]:add' => 'Add a new [[NAME]]',
	'[[NAME]]' => '[[NAME]]',
	'[[NAME]]:all' => 'All [[NAME]]',
	'[[NAME]]:title' => '[[NAME]] title',
	'[[NAME]]:description' => '[[NAME]] text',
	'[[NAME]]:tags' => 'Tags',
	'[[NAME]]:access_id' => 'Read access',
	'[[NAME]]:write_access_id' => 'Write access',
	'item:object:[[NAME]]' => '[[NAME]]',
	'[[NAME]]:edit' => 'Edit %s',
	
	
	/**
	 * River
	 */
	'river:create:object:[[NAME]]' => '%s created a [[NAME]] %s', 
	
	/**
	 * Widgets
	 */
	 
	'[[NAME]]:numbertodisplay' => 'Number of [[NAME]] to display',
	'[[NAME]]:more[[NAME]]' => 'More [[NAME]]',
	'[[NAME]]:no[[NAME]]' => 'No [[NAME]]',
	'[[NAME]]:widget:description' => 'Display your latest [[NAME]].',
	
	/**
	 * Object View
	 */
	'[[NAME]]:strapline' => 'Last updated %s by %s',
	
	/**
	 * Group View
	 */
	'[[NAME]]:group' => 'Group [[NAME]]',
	'[[NAME]]:enable[[NAME]]' => 'Enable group [[NAME]]',
	
	/**
	 * Owner
	 */
	'[[NAME]]:owner' => "%s's [[NAME]]",
	
	/**
	 * Friends
	 */
	'[[NAME]]:friends' => "Friends' [[NAME]]",  
	
	/**
	 * Estatus and error messages
	 */
	'[[NAME]]:error:no_title' => 'You must specify a title for this [[NAME]].',
	'[[NAME]]:error:no_save' => '[[NAME]] could not be saved',
	'[[NAME]]:saved' => '[[NAME]] saved',
	'[[NAME]]:error:notsaved' => '[[NAME]] could not be saved',
	'[[NAME]]:delete:success' => 'The [[NAME]] was successfully deleted.',
	'[[NAME]]:delete:failed' => 'The [[NAME]] could not be deleted.',
	'[[NAME]]:noaccess' => 'Sorry, you have no access to this item', 
	
	/**
	 * [[NAME]] plugin settings
	 */
	'[[NAME]]:plugins:settings:explanation' => 'This options will not chage anything, this page has been created by Elgg-Skeletor, the values of this options are saved in the [[NAME]] configuration and can be accessed by the function elgg_get_plugin_setting(\'[[NAME]]_option1\', \'[[NAME]]\') (to access to the option1 value) or elgg_get_plugin_setting(\'[[NAME]]_option2\', \'[[NAME]]\') (to access to the option2 value).',
	
	
	  
);

add_translation('en', $mapping);
