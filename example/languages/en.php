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
	'example:menu' => 'example',
	'example:none' => 'No example',
	'example:add' => 'Add a new example',
	'example' => 'example',
	'example:all' => 'All example',
	'example:title' => 'example title',
	'example:description' => 'example text',
	'example:tags' => 'Tags',
	'example:access_id' => 'Read access',
	'example:write_access_id' => 'Write access',
	'item:object:example' => 'example',
	'example:edit' => 'Edit %s',
	
	
	/**
	 * River
	 */
	'river:create:object:example' => '%s created a example %s', 
	
	/**
	 * Widgets
	 */
	 
	'example:numbertodisplay' => 'Number of example to display',
	'example:moreexample' => 'More example',
	'example:noexample' => 'No example',
	'example:widget:description' => 'Display your latest example.',
	
	/**
	 * Object View
	 */
	'example:strapline' => 'Last updated %s by %s',
	
	/**
	 * Group View
	 */
	'example:group' => 'Group example',
	'example:enableexample' => 'Enable group example',
	
	/**
	 * Owner
	 */
	'example:owner' => "%s's example",
	
	/**
	 * Friends
	 */
	'example:friends' => "Friends' example",  
	
	/**
	 * Estatus and error messages
	 */
	'example:error:no_title' => 'You must specify a title for this example.',
	'example:error:no_save' => 'example could not be saved',
	'example:saved' => 'example saved',
	'example:error:notsaved' => 'example could not be saved',
	'example:delete:success' => 'The example was successfully deleted.',
	'example:delete:failed' => 'The example could not be deleted.',
	'example:noaccess' => 'Sorry, you have no access to this item', 
	
	/**
	 * example plugin settings
	 */
	'example:plugins:settings:explanation' => 'This options will not chage anything, this page has been created by Elgg-Skeletor, the values of this options are saved in the example configuration and can be accessed by the function elgg_get_plugin_setting(\'example_option1\', \'example\') (to access to the option1 value) or elgg_get_plugin_setting(\'example_option2\', \'example\') (to access to the option2 value).',
	
	
	  
);

add_translation('en', $mapping);
