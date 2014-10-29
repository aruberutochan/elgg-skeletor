<?php

/**
 * [[NAME]]/pages/[[NAME]]/edit.php
 * 
 *
 */

gatekeeper();

elgg_push_breadcrumb($title);
$guid = get_input('guid');
$[[NAME]] = get_entity($guid);
if (!$[[NAME]]) {
	$title = elgg_echo('[[NAME]]:add');
	$vars = [[NAME]]_prepare_form_vars($[[NAME]]);
	
	$content = elgg_view_form('[[NAME]]/edit', array(), $vars);
} else { 
	$title = elgg_echo('[[NAME]]:edit', array($[[NAME]]->title));
	if ($[[NAME]]->canEdit()) {
		$vars = [[NAME]]_prepare_form_vars($[[NAME]]);
		$content = elgg_view_form('[[NAME]]/edit', array(), $vars);
	} else {
		$content = elgg_echo("[[NAME]]:noaccess");
	}
}


$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
