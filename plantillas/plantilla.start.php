<?php /**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', '[[NAME]]_init');

function [[NAME]]_init() {
	// Rename this function based on the name of your plugin and update the
	// elgg_register_event_handler() call accordingly

	// Register a script to handle (usually) a POST request (an action)
	$base_dir = elgg_get_plugins_path() . '[[NAME]]/actions/[[NAME]]';
	elgg_register_action('[[NAME]]/edit', "$base_dir/edit.php");
	// routing of urls
	elgg_register_page_handler('[[NAME]]', '[[NAME]]_page_handler');
	// Extend the main CSS file
	elgg_extend_view('css/elgg', '[[NAME]]/css');

	// Add a menu item to the main site menu
	$item = new ElggMenuItem('[[NAME]]', elgg_echo('[[NAME]]:menu'), '[[NAME]]');
	elgg_register_menu_item('site', $item);
	// Set the config fields of webform
	elgg_set_config('[[NAME]]', array([[ARRAYFIELDS]]));
}

/**
 * Dispatches [[NAME]] pages.
 * URLs take the form of
 *  All [[NAME]]:       [[NAME]]/all
 *
 * @param array $page
 * @return bool
 */
function [[NAME]]_page_handler($page) {

	if (!isset($page[0])) {
		$page[0] = 'all';
	}
	$base_dir = elgg_get_plugins_path() . '[[NAME]]/pages/[[NAME]]';
	$page_type = $page[0];
	switch ($page_type) {
		case 'all':
			include "$base_dir/all.php";
			break;
		case 'edit' :
			set_input('guid', $page[1]);
			include "$base_dir/edit.php";
			break;
		case 'add':
			set_input('guid', $page[1]);
			include "$base_dir/edit.php";
			break;
		case 'view':
			set_input('guid', $page[1]);
			include "$base_dir/view.php";
			break;
		case 'friends':
			include "$base_dir/friends.php";
			break;
		case 'owner':
			include "$base_dir/owner.php";
			break;
		default:
			return false;
	}

	return true;
}
