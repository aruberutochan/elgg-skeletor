<?php
/**
 * [[NAME]] helper functions
 *
 * @package [[NAME]]
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $[[NAME]] A [[NAME]] object.
 * @return array
 */
function [[NAME]]_prepare_form_vars($[[NAME]] = null) {
	// input names => defaults
	$values = array(
		'title' => '', 
		'description' => '',		
		'tags' => '',
		'access_id' => ACCESS_DEFAULT,
		'write_access' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $[[NAME]],
	);

	if ($[[NAME]]) {
		foreach (array_keys($values) as $field) {
			if (isset($[[NAME]]->$field)) {
				$values[$field] = $[[NAME]]->$field;
			}
		}
	}

	if (elgg_is_sticky_form('[[NAME]]')) {
		$sticky_values = elgg_get_sticky_values('[[NAME]]');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('[[NAME]]');

	return $values;
}
