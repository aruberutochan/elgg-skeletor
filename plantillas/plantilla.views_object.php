<?php
/**
 * View for [[NAME]] object
 *
 * @package [[NAME]]
 *
 * @uses $vars['entity']    The [[NAME]] object
 * @uses $vars['full_view'] Whether to display the full view
 * 
 */


$full = elgg_extract('full_view', $vars, FALSE);
$[[NAME]] = elgg_extract('entity', $vars, FALSE);

if (!$[[NAME]]) {
	return TRUE;
}

// [[NAME]] used to use Public for write access
if ($[[NAME]]->write_access_id == ACCESS_PUBLIC) {
	// this works because this metadata is public
	$[[NAME]]->write_access_id = ACCESS_LOGGED_IN;
}


$annotation = $[[NAME]]->getAnnotations(array('[[NAME]]', 1, 0, 'desc'));
if ($annotation) {
	$annotation = $annotation[0];
}


$[[NAME]]_icon = elgg_view('[[NAME]]/icon', array('entity_guid' => $[[NAME]]->guid, 'size' => 'small'));

$editor = get_entity($annotation->owner_guid);
$editor_link = elgg_view('output/url', array(
	'href' => "[[NAME]]/owner/$editor->username",
	'text' => $editor->name,
	'is_trusted' => true,
));

$date = elgg_view_friendly_time($annotation->time_created);
$editor_text = elgg_echo('[[NAME]]:strapline', array($date, $editor_link));
$categories = elgg_view('output/categories', $vars);

$comments_count = $[[NAME]]->countComments();
//only display if there are commments
if ($comments_count != 0 && !$revision) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $[[NAME]]->getURL() . '#[[NAME]]-comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$subtitle = "$editor_text $comments_link $categories";

// do not show the metadata and controls in widget view
if (!elgg_in_context('widgets')) {
	// Regular entity menu
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => '[[NAME]]',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
}


if ($full) {
	$body = elgg_view('output/longtext', array('value' => $annotation->value));

	$params = array(
		'entity' => $[[NAME]],
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'entity' => $[[NAME]],
		'title' => false,
		'icon' => $[[NAME]]_icon,
		'summary' => $summary,
		'body' => $body,
	));

} else {
	// brief view

	$excerpt = elgg_get_excerpt($[[NAME]]->description);

	$params = array(
		'entity' => $[[NAME]],
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($[[NAME]]_icon, $list_body);
}
