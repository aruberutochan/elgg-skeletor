<?php
/**
 * Elgg [[NAME]] plugin everyone page
 *
 * @package [[NAME]]
 */

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('', '404');
}
group_gatekeeper();
elgg_push_breadcrumb($page_owner->name);

elgg_register_title_button();

$content .= elgg_list_entities(array(
	'type' => 'object',
	'subtype' => '[[NAME]]',
	'container_guid' => $page_owner->guid,
	'full_view' => false,
	'view_toggle_type' => false
));

if (!$content) {
	$content = elgg_echo('[[NAME]]:none');
}

$title = elgg_echo('[[NAME]]:owner', array($page_owner->name));

$filter_context = '';
if ($page_owner->getGUID() == elgg_get_logged_in_user_guid()) {
	$filter_context = 'mine';
}

$vars = array(
	'filter_context' => $filter_context,
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('[[NAME]]/sidebar'),
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
	$vars['filter'] = false;
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);
