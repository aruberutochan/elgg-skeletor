<?php
/**
 * Delete a example
 *
 * @package example
 */

$guid = get_input('guid');
$example = get_entity($guid);

if (elgg_instanceof($example, 'object', 'example') && $example->canEdit()) {
	$container = $example->getContainerEntity();
	if ($example->delete()) {
		system_message(elgg_echo("example:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("example/group/$container->guid/all");
		} else {
			forward("example/owner/$container->username");
		}
	}
}

register_error(elgg_echo("example:delete:failed"));
forward(REFERER);
