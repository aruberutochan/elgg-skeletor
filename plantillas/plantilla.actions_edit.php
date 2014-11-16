<?php
/**
 * [[NAME]]/actions/[[NAME]]/edit.php
 * 
 * Save [[NAME]] entity
 *
 * @package [[NAME]]
 */
 
$variables = elgg_get_config('[[NAME]]');
$input = array();
foreach ($variables as $name => $type) {
	if ($name == 'title') {
		$input[$name] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
	}
	if ($type == 'auto_add_text') {
		elgg_load_library('[[NAME]]:aat');
		$fields = aat_get_not_empty_fields_from_form($name);		
		$n_fields = aat_get_not_empty_n_fields_from_form($name);
		$input[$name . '_n'] = $n_fields;
		foreach ($fields as $num => $field) {
			$input[$name . '_field_' . $num] = $field;
		}
		
	} else {
		$input[$name] = get_input($name);
	}
	if ($type == 'tags') {
		$input[$name] = string_to_tag_array($input[$name]);
	}
}

// Get guids
$[[NAME]]_guid = (int)get_input('[[NAME]]_guid');
$container_guid = (int)get_input('container_guid'); 


elgg_make_sticky_form('[[NAME]]');

if (!$input['title']) {
	register_error(elgg_echo('[[NAME]]:error:no_title'));
	forward(REFERER);
}

if ($[[NAME]]_guid) {
	$[[NAME]] = get_entity($[[NAME]]_guid);
	if (!$[[NAME]] || !$[[NAME]]->canEdit()) {
		register_error(elgg_echo('[[NAME]]:error:no_save'));
		forward(REFERER);
	}
	$new_[[NAME]] = false;
} else {
	$[[NAME]] = new ElggObject();
	$[[NAME]]->subtype = '[[NAME]]';
	$new_[[NAME]] = true;
}

if (sizeof($input) > 0) {
	// don't change access if not an owner/admin
	$user = elgg_get_logged_in_user_entity();
	$can_change_access = true;

	if ($user && $[[NAME]]) {
		$can_change_access = $user->isAdmin() || $user->getGUID() == $[[NAME]]->owner_guid;
	}
	
	foreach ($input as $name => $value) {
		if (($name == 'access_id' || $name == 'write_access_id') && !$can_change_access) {
			continue;
		}
		
	$[[NAME]]->$name = $value;
	}
}

// need to add check to make sure user can write to container
$[[NAME]]->container_guid = $container_guid;

if ($[[NAME]]->save()) {

	elgg_clear_sticky_form('[[NAME]]');

	// Now save description as an annotation
	$[[NAME]]->annotate('[[NAME]]', $[[NAME]]->description, $[[NAME]]->access_id);

	system_message(elgg_echo('[[NAME]]:saved'));

	if ($new_[[NAME]]) {
		add_to_river('river/object/[[NAME]]/create', 'create', elgg_get_logged_in_user_guid(), $[[NAME]]->guid);
	}

	forward($[[NAME]]->getURL());
} else {
	register_error(elgg_echo('[[NAME]]:error:notsaved'));
	forward(REFERER);
}


