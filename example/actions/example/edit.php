<?php
/**
 * example/actions/example/edit.php
 * 
 * Save example entity
 *
 * @package example
 */
 
$variables = elgg_get_config('example');
$input = array();
foreach ($variables as $name => $type) {
	if ($name == 'title') {
		$input[$name] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
	} else {
		$input[$name] = get_input($name);
	}
	if ($type == 'tags') {
		$input[$name] = string_to_tag_array($input[$name]);
	}
}

// Get guids
$example_guid = (int)get_input('example_guid');
$container_guid = (int)get_input('container_guid'); 


elgg_make_sticky_form('example');

if (!$input['title']) {
	register_error(elgg_echo('example:error:no_title'));
	forward(REFERER);
}

if ($example_guid) {
	$example = get_entity($example_guid);
	if (!$example || !$example->canEdit()) {
		register_error(elgg_echo('example:error:no_save'));
		forward(REFERER);
	}
	$new_example = false;
} else {
	$example = new ElggObject();
	$example->subtype = 'example';
	$new_example = true;
}

if (sizeof($input) > 0) {
	// don't change access if not an owner/admin
	$user = elgg_get_logged_in_user_entity();
	$can_change_access = true;

	if ($user && $example) {
		$can_change_access = $user->isAdmin() || $user->getGUID() == $example->owner_guid;
	}
	
	foreach ($input as $name => $value) {
		if (($name == 'access_id' || $name == 'write_access_id') && !$can_change_access) {
			continue;
		}
		
	$example->$name = $value;
	}
}

// need to add check to make sure user can write to container
$example->container_guid = $container_guid;

if ($example->save()) {

	elgg_clear_sticky_form('example');

	// Now save description as an annotation
	$example->annotate('example', $example->description, $example->access_id);

	system_message(elgg_echo('example:saved'));

	if ($new_example) {
		add_to_river('river/object/example/create', 'create', elgg_get_logged_in_user_guid(), $example->guid);
	}

	forward($example->getURL());
} else {
	register_error(elgg_echo('example:error:notsaved'));
	forward(REFERER);
}


