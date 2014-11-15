<?php
/**
 * example plugin settings
 */

// set default value
if (!isset($vars['entity']->example_option1)) {
	$vars['entity']->example_option1 = 'no';
}

// set default value
if (!isset($vars['entity']->example_option2)) {
	$vars['entity']->example_option2 = 'no';
}

echo '<div>';
echo elgg_echo('example:plugins:settings:explanation');
echo '</div><div>';
echo elgg_echo('example:exampleoption1');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[example_option1]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->example_option1,
));
echo '</div>';

echo '<div>';
echo elgg_echo('example:exampleoption2');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[example_option2]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->example_option2,
));
echo '</div>';
