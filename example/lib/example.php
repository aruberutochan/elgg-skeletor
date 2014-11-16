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

function aat_get_fields_from_form($name = '') {
	
	$n = get_input($name . '_n_fields');
	
	for ($i = 0; $i < $n; $i++) {
		$return[$i] = get_input($name . '_field' . $i);
	}		
	return $return;
}

function aat_get_n_fields_from_form($name) {
	$n = get_input($name . '_n_fields');
	return $n;
	
}

function aat_get_not_empty_fields_from_form($name) {
	$n = get_input($name . '_n_fields');
	
	for ($i = 0; $i < $n; $i++) {
		$input = get_input($name . '_field' . $i);
		if (!empty($input)) {
			$return[] = get_input($name . '_field' . $i);
		}
	}		
	return $return;
}

function aat_get_not_empty_n_fields_from_form($name) {
	$not_empty = aat_get_not_empty_fields_from_form($name);
	$n = count($not_empty);
	return $n;
	
}

function aat_get_fields_from_entity($name, $entity) {
	$return = array();
	$fields = array();
	$n_string = "$name" . '_n';	
	$n_fields = $entity->$n_string;
	$return[$n_string] = $n_fields;
	for ($i=0; $i < $n_fields; $i++){
		$field_string = "$name" . '_field_' . "$i";
		$fields[$field_string] = $entity->$field_string;
	
	}
	$return[$name] = $fields;
	return $return;
}
