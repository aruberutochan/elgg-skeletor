<?php
/**
 * User [[NAME]] widget display view
 */

$num = $vars['entity']->num_display;

$options = array(
	'type' => 'object',
	'subtype' => '[[NAME]]',
	'container_guid' => $vars['entity']->owner_guid,
	'limit' => $num,
	'full_view' => FALSE,
	'pagination' => FALSE,
);
$content = elgg_list_entities($options);

echo $content;

if ($content) {
	$[[NAME]]_url = "[[NAME]]/owner/" . elgg_get_page_owner_entity()->username;
	$more_link = elgg_view('output/url', array(
		'href' => $[[NAME]]_url,
		'text' => elgg_echo('[[NAME]]:more[[NAME]]'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('[[NAME]]:no[[NAME]]');
}
