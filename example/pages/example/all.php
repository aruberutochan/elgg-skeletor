<?php
/**
 * example/pages/example/all.php
 * 
 * List all example
 *
 * @package example
 */

$title = elgg_echo('example:all');

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('example'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'example',
	'full_view' => false,
));


if (!$content) {
	$content = '<p>' . elgg_echo('example:none') . '</p>';
}

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('example/sidebar'),
));

echo elgg_view_page($title, $body);
