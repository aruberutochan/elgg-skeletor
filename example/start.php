<?php /**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'example_init');

function example_init() {
	// Rename this function based on the name of your plugin and update the
	// elgg_register_event_handler() call accordingly
	
	// Register library
	$root = dirname(__FILE__);
	elgg_register_library('example', "$root/lib/example.php");
	elgg_register_library('example:aat', "$root/lib/aat.php");

	// Register a script to handle (usually) a POST request (an action)
	$base_dir = elgg_get_plugins_path() . 'example/actions/example';
	elgg_register_action('example/edit', "$base_dir/edit.php");
	elgg_register_action('example/delete', "$base_dir/delete.php");
	
	// routing of urls
	elgg_register_page_handler('example', 'example_page_handler');
	
	// Extend the main CSS file
	elgg_extend_view('css/elgg', 'example/css');
	
	// Register for search.
	elgg_register_entity_type('object', 'example');
	
	// add a example widget
	elgg_register_widget_type('example', elgg_echo('example'), elgg_echo('example:widget:description'));
	
	// Add a menu item to the main site menu
	$item = new ElggMenuItem('example', elgg_echo('example:menu'), 'example');
	elgg_register_menu_item('site', $item);
	
	// Set the config fields of example
	elgg_set_config('example', array(
		'title' => 'text',
		'description' => 'longtext',
		'auto_add_text' => 'auto_add_text',
		'tags' => 'tags',
		'access_id' => 'access',
		'write_access_id' => 'write_access'
	));
	
	// Register url handler
	elgg_register_entity_url_handler('object', 'example', 'example_url');
	
	//elgg_register_plugin_hook_handler('register', 'menu:page', 'example_page_menu');
	
	// Register owner block menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'example_owner_block_menu');
	
	// Groups
	add_group_tool_option('example', elgg_echo('example:enableexample'), false);
	elgg_extend_view('groups/tool_latest', 'example/group_module');
	
	// write permission plugin hooks
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'example_write_permission_check');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'example_container_permission_check');
	
	// icon url override
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'example_icon_url_override');
	
	
}

/**
 * Dispatches example pages.
 * URLs take the form of
 *  All example:       example/all
 *
 * @param array $page
 * @return bool
 */
function example_page_handler($page) {
	elgg_load_library('example');
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
	elgg_push_breadcrumb(elgg_echo('example'), 'example/all');
	$base_dir = elgg_get_plugins_path() . 'example/pages/example';
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
			//set_input('guid', $page[1]);
			
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
		case 'group':
			
			include "$base_dir/owner.php";
			break;
		default:
			return false;
	}

	return true;
}

/**
 * Add a menu item to an ownerblock
 * 
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function example_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "example/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('example', elgg_echo('example'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->example_enable != 'no') {
			$url = "example/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('example', elgg_echo('example:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add a page menu menu.
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 * A completar cuando se tenga claro
function example_page_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		// only show example menu in example pages
		if (elgg_in_context('example')) {
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}

			if ($page_owner instanceof ElggGroup) {
				if (!$page_owner->isMember()) {
					return $return;
				}
				$title = elgg_echo('example:menu:group');
			} else {
				$title = elgg_echo('example:menu');
			}

			$return[] = new ElggMenuItem('example_page_menu', $title, 'example/group/' . $page_owner->getGUID());
		}
	}

	return $return;
}
*/

/**
 * Populates the ->getUrl() method for example objects
 *
 * @param ElggEntity $entity The example object
 * @return string example item URL
 */
function example_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "example/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param string $hook
 * @param string $entity_type
 * @param bool   $returnvalue
 * @param array  $params
 */
function example_write_permission_check($hook, $entity_type, $returnvalue, $params) {
	if ($params['entity']->getSubtype() == 'example') {

		$write_permission = $params['entity']->write_access_id;
		$user = $params['user'];

		if ($write_permission && $user) {
			switch ($write_permission) {
				case ACCESS_PRIVATE:
					// Elgg's default decision is what we want
					return;
					break;
				case ACCESS_FRIENDS:
					$owner = $params['entity']->getOwnerEntity();
					if ($owner && $owner->isFriendsWith($user->guid)) {
						return true;
					}
					break;
				default:
					$list = get_access_array($user->guid);
					if (in_array($write_permission, $list)) {
						// user in the access collection
						return true;
					}
					break;
			}
		}
	}
}

/**
 * Extend container permissions checking to extend can_write_to_container for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function example_container_permission_check($hook, $entity_type, $returnvalue, $params) {

	if (elgg_get_context() == "example") {
		if (elgg_get_page_owner_guid()) {
			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
		}
		if ($example_guid = get_input('example_guid',0)) {
			$entity = get_entity($example_guid);
		}
		if ($entity instanceof ElggObject) {
			if (
					can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid)
					|| in_array($entity->write_access_id,get_access_list())
				) {
					return true;
			}
		}
	}

}

/**
 * Override the default entity icon for example
 *
 * @return string Relative URL
 */
function example_icon_url_override($hook, $type, $returnvalue, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'example')) {
		switch ($params['size']) {
			case 'topbar':
				return 'mod/example/images/topbar.png';
				break;
			case 'tiny':
				return 'mod/example/images/tiny.png';
				break;
			case 'small':
				return 'mod/example/images/small.png';
				break;
			case 'medium':
				return 'mod/example/images/medium.png';
				break;
			case 'large':
				return 'mod/example/images/large.png';
				break;
			default:
				return 'mod/example/images/medium.png';
				break;
		}
	}
}




