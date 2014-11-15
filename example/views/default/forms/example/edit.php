<?php
/** 
 * example/views/default/forms/example/edit.php
 * 
 * example new form body
 *
 * @package example
 */
$variables = elgg_get_config('example');
$user = elgg_get_logged_in_user_entity();
$entity = elgg_extract('entity', $vars);

$can_change_access = true;
if ($user && $entity) {
	$can_change_access = ($user->isAdmin() || $user->getGUID() == $entity->owner_guid);
}

foreach ($variables as $name => $type) {
	// don't show read / write access inputs for non-owners or admin when editing
	if (($type == 'access' || $type == 'write_access') && !$can_change_access) {
		continue;
	}
	
	$input_view = "input/$type";
	if ($type == 'auto_add_text') {
	
		?>
		<div>		
		<?php	
			echo elgg_view($input_view, array(
				'name' => $name,
				'value' => $vars[$name],
			));
		?>
		</div>
		<?php
		
	} elseif ($type == 'checkbox') {
		?>
		<div>
			<?php
						
				echo elgg_view($input_view, array(
					'name' => $name,
					'value' => $vars[$name],
				));
			?>
			<label><?php echo elgg_echo("example:$name") ?></label>
			
		</div>
		<?php
		
		
		} else {

		?>
		<div>
			<label><?php echo elgg_echo("example:$name") ?></label>
			<?php
				if ($type != 'longtext') {
					echo '<br />';
				}
		
				echo elgg_view($input_view, array(
					'name' => $name,
					'value' => $vars[$name],
				));
			?>
		</div>
		<?php
	}
}

$cats = elgg_view('input/categories', $vars);
if (!empty($cats)) {
	echo $cats;
}


echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'example_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';
