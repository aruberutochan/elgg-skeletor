<?php
/**
 * [[NAME]] plugin settings
 */

// set default value
if (!isset($vars['entity']->[[NAME]]_option1)) {
	$vars['entity']->[[NAME]]_option1 = 'no';
}

// set default value
if (!isset($vars['entity']->[[NAME]]_option2)) {
	$vars['entity']->[[NAME]]_option2 = 'no';
}

echo '<div>';
echo elgg_echo('[[NAME]]:plugins:settings:explanation');
echo '</div><div>';
echo elgg_echo('[[NAME]]:[[NAME]]option1');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[[[NAME]]_option1]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->[[NAME]]_option1,
));
echo '</div>';

echo '<div>';
echo elgg_echo('[[NAME]]:[[NAME]]option2');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[[[NAME]]_option2]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->[[NAME]]_option2,
));
echo '</div>';
