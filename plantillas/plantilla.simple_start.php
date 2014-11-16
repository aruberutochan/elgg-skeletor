<?php /**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', '[[NAME]]_init');

function [[NAME]]_init() {
	// Rename this function based on the name of your plugin and update the
	// elgg_register_event_handler() call accordingly
	
	// Register library
	$root = dirname(__FILE__);
	elgg_register_library('[[NAME]]', "$root/lib/[[NAME]].php");
	elgg_register_library('[[NAME]]:aat', "$root/lib/aat.php");

	// Register a script to handle (usually) a POST request (an action)
	$base_dir = elgg_get_plugins_path() . '[[NAME]]/actions/[[NAME]]';
	elgg_register_action('[[NAME]]/edit', "$base_dir/edit.php");
	elgg_register_action('[[NAME]]/delete', "$base_dir/delete.php");
	
	// routing of urls
	elgg_register_page_handler('[[NAME]]', '[[NAME]]_page_handler');
	
	// Extend the main CSS file
	elgg_extend_view('css/elgg', '[[NAME]]/css');
	
	// Register for search.
	elgg_register_entity_type('object', '[[NAME]]');
	
	// add a [[NAME]] widget
	elgg_register_widget_type('[[NAME]]', elgg_echo('[[NAME]]'), elgg_echo('[[NAME]]:widget:description'));
	
	// Add a menu item to the main site menu
	$item = new ElggMenuItem('[[NAME]]', elgg_echo('[[NAME]]:menu'), '[[NAME]]');
	elgg_register_menu_item('site', $item);
	
	// Set the config fields of [[NAME]]
	elgg_set_config('[[NAME]]', array(
		'title' => 'text',
		'description' => 'longtext',
		'auto_add_text' => 'auto_add_text',
		'tags' => 'tags',
		'access_id' => 'access',
		'write_access_id' => 'write_access'
	));
	
	// Register url handler
	elgg_register_entity_url_handler('object', '[[NAME]]', '[[NAME]]_url');
	
	//elgg_register_plugin_hook_handler('register', 'menu:page', '[[NAME]]_page_menu');
	
	// Register owner block menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', '[[NAME]]_owner_block_menu');
	
	// Groups
	add_group_tool_option('[[NAME]]', elgg_echo('[[NAME]]:enable[[NAME]]'), false);
	elgg_extend_view('groups/tool_latest', '[[NAME]]/group_module');
	
	// write permission plugin hooks
	elgg_register_plugin_hook_handler('permissions_check', 'object', '[[NAME]]_write_permission_check');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', '[[NAME]]_container_permission_check');
	
	// icon url override
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', '[[NAME]]_icon_url_override');
	
	
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
	elgg_load_library('[[NAME]]');
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
	elgg_push_breadcrumb(elgg_echo('[[NAME]]'), '[[NAME]]/all');
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
function [[NAME]]_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "[[NAME]]/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('[[NAME]]', elgg_echo('[[NAME]]'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->[[NAME]]_enable != 'no') {
			$url = "[[NAME]]/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('[[NAME]]', elgg_echo('[[NAME]]:group'), $url);
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
function [[NAME]]_page_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		// only show [[NAME]] menu in [[NAME]] pages
		if (elgg_in_context('[[NAME]]')) {
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}

			if ($page_owner instanceof ElggGroup) {
				if (!$page_owner->isMember()) {
					return $return;
				}
				$title = elgg_echo('[[NAME]]:menu:group');
			} else {
				$title = elgg_echo('[[NAME]]:menu');
			}

			$return[] = new ElggMenuItem('[[NAME]]_page_menu', $title, '[[NAME]]/group/' . $page_owner->getGUID());
		}
	}

	return $return;
}
*/

/**
 * Populates the ->getUrl() method for [[NAME]] objects
 *
 * @param ElggEntity $entity The [[NAME]] object
 * @return string [[NAME]] item URL
 */
function [[NAME]]_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "[[NAME]]/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param string $hook
 * @param string $entity_type
 * @param bool   $returnvalue
 * @param array  $params
 */
function [[NAME]]_write_permission_check($hook, $entity_type, $returnvalue, $params) {
	if ($params['entity']->getSubtype() == '[[NAME]]') {

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
function [[NAME]]_container_permission_check($hook, $entity_type, $returnvalue, $params) {

	if (elgg_get_context() == "[[NAME]]") {
		if (elgg_get_page_owner_guid()) {
			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
		}
		if ($[[NAME]]_guid = get_input('[[NAME]]_guid',0)) {
			$entity = get_entity($[[NAME]]_guid);
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
 * Override the default entity icon for [[NAME]]
 *
 * @return string Relative URL
 */
function [[NAME]]_icon_url_override($hook, $type, $returnvalue, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', '[[NAME]]')) {
		switch ($params['size']) {
			case 'topbar':
				return 'mod/[[NAME]]/images/topbar.png';
				break;
			case 'tiny':
				return 'mod/[[NAME]]/images/tiny.png';
				break;
			case 'small':
				return 'mod/[[NAME]]/images/small.png';
				break;
			case 'medium':
				return 'mod/[[NAME]]/images/medium.png';
				break;
			case 'large':
				return 'mod/[[NAME]]/images/large.png';
				break;
			default:
				return 'mod/[[NAME]]/images/medium.png';
				break;
		}
	}
}




