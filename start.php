<?php
/**
 * Public filter start.php
 * 
 * @package PublicFilter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

elgg_register_event_handler('init', 'system', 'publicfilter_init');

// Init
function publicfilter_init() {
	global $CONFIG;
	
	// Listen to create events, setting low priority
	elgg_register_event_handler('create','all','publicfilter_access_listener', 2000);
	
	// Listen to update event, setting low priority
	elgg_register_event_handler('update','all','publicfilter_access_listener', 2000);
	
	// Register for acl write hook
	elgg_register_plugin_hook_handler('access:collections:write', 'user', 'publicfilter_hook');
}

/** 
 * Gets a the list of users to filter again
 * from the plugin settings
 * 
 */
function publicfilter_get_users() {
	// Get contacts from plugin settings
	$users = elgg_get_plugin_setting('userlist','publicfilter');
	$users = explode("\n", $users);
	$users_array = array();
	foreach ($users as $idx => $user) {
		$users_array[] = trim($user);
	}
	return $users_array;
}

/** 
 * Gets a the list of mod specified mod users
 * 
 */
function publicfilter_get_mods() {
	// Get mods from plugin settings
	$users = elgg_get_plugin_setting('modlist','publicfilter');
	$users = explode("\n", $users);
	$users_array = array();
	foreach ($users as $idx => $user) {
		$user = get_user_by_username(trim($user));
		$users_array[] = $user;
		
	}
	return $users_array;
}

/** 
 * Get the specified subtypes to filter
 */
function publicfilter_get_subtypes() {
	// Get subtypes from plugin settings
	$subtypes = elgg_get_plugin_setting('subtypes','publicfilter');		
	$subtypes = explode("\n", $subtypes);
	$subtypes_array = array();
	foreach ($subtypes as $idx => $subtype) {
		$subtypes_array[] = trim($subtype);
	}
	return $subtypes_array;
}

/**
 * Plugin hook handler to remove public access if enabled
 *
 * @param sting  $hook   access:collections:write
 * @param string $type   user
 * @param mixed  $value  Value
 * @param mixed  $params Params
 *
 * @return array
 */
function publicfilter_hook($hook, $type, $value, $params) {
	if (elgg_get_plugin_setting('filterenabled','publicfilter') && in_array(elgg_get_logged_in_user_entity()->username, publicfilter_get_users())) {
		unset($value[2]);
	}

	return $value;
}

/**
 * Listen to the create/update events and fire off a notification if moderation is enabled
 */
function publicfilter_access_listener($event, $object_type, $object) {	
	global $CONFIG;
	if (elgg_get_plugin_setting('modsenabled','publicfilter')) {
		$object_type_exceptions = array(
			'user', 
			'metadata'
		);

		$object_allowed_subtypes = publicfilter_get_subtypes();

		// Groups are always public, so notify on create, but not on updates
		if ($event == 'update') {
			$object_type_exceptions[] = 'group';
		}

		if (!in_array($object_type, $object_type_exceptions)
			&& in_array($object->getSubtype(), $object_allowed_subtypes)
			&& $object->access_id == ACCESS_PUBLIC) {
			$mods = publicfilter_get_mods();

			$user = elgg_get_logged_in_user_entity();

			$owner = get_entity($object->owner_guid);

			// Check for a standard name/title field
			if ($object->name) {
				$title = $object->name;
			} else if ($object->title) {
				$title = $object->title;
			} else { 
				$title = 'n/a'; // It's possible that the object has none, ie: thewire
			}

			foreach($mods as $mod) {
				if ($mod) {
					notify_user( 
						$mod->getGUID(), $CONFIG->site->guid, 
						elgg_echo('publicfilter:notifymod:subject'), 
						elgg_echo('publicfilter:notifymod:body', array($user->name, $title, $owner->name, $object_type, $object->getSubtype(), $object->getURL()))
					);
				}
			}
		}
	}
}
