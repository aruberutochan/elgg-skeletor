<?php
/**
 * [[NAME]]/pages/[[NAME]]/all.php
 * 
 * List all [[NAME]]
 *
 * @package [[NAME]]
 */

$title = elgg_echo('[[NAME]]:all');

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('[[NAME]]'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => '[[NAME]]',
	'full_view' => false,
));


if (!$content) {
	$content = '<p>' . elgg_echo('[[NAME]]:none') . '</p>';
}

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('[[NAME]]/sidebar'),
));

echo elgg_view_page($title, $body);
