<?php
/**
 * Delete a [[NAME]]
 *
 * @package [[NAME]]
 */

$guid = get_input('guid');
$[[NAME]] = get_entity($guid);

if (elgg_instanceof($[[NAME]], 'object', '[[NAME]]') && $[[NAME]]->canEdit()) {
	$container = $[[NAME]]->getContainerEntity();
	if ($[[NAME]]->delete()) {
		system_message(elgg_echo("[[NAME]]:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("[[NAME]]/group/$container->guid/all");
		} else {
			forward("[[NAME]]/owner/$container->username");
		}
	}
}

register_error(elgg_echo("[[NAME]]:delete:failed"));
forward(REFERER);
