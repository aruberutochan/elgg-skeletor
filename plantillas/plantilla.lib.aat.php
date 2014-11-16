<?php

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
