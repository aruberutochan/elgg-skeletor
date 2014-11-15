<?php

/**
 * example/pages/example/edit.php
 * 
 *
 */

gatekeeper();

elgg_push_breadcrumb($title);
$guid = get_input('guid');
$example = get_entity($guid);
if (!$example) {
	$title = elgg_echo('example:add');
	$vars = example_prepare_form_vars($example);
	
	$content = elgg_view_form('example/edit', array(), $vars);
} else { 
	$title = elgg_echo('example:edit', array($example->title));
	if ($example->canEdit()) {
		$vars = example_prepare_form_vars($example);
		$content = elgg_view_form('example/edit', array(), $vars);
	} else {
		$content = elgg_echo("example:noaccess");
	}
}


$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
