<?php
/**
 * example helper functions
 *
 * @package example
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $example A example object.
 * @return array
 */
function example_prepare_form_vars($example = null) {
	// input names => defaults
	$values = array(
		'title' => '', 
		'description' => '',		
		'tags' => '',
		'access_id' => ACCESS_DEFAULT,
		'write_access' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $example,
	);

	if ($example) {
		foreach (array_keys($values) as $field) {
			if (isset($example->$field)) {
				$values[$field] = $example->$field;
			}
		}
	}

	if (elgg_is_sticky_form('example')) {
		$sticky_values = elgg_get_sticky_values('example');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('example');

	return $values;
}
