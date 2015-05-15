<?php
/**
 * Public Filter settings form
 * 
 * @package ParentFilter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.org/
 * 
 */

// Values
$filterenabled = $vars['entity']->filterenabled;
$userlist = $vars['entity']->userlist;

$enablemods = $vars['entity']->enablemods;
$modlist = $vars['entity']->modlist;

$subtypes = $vars['entity']->subtypes;

// Labels/inputs
$user_filter_label = elgg_echo('publicfilter:label:filterusers');
$user_filter_enabled_input = elgg_view('input/dropdown', array(
	'name' => "params[filterenabled]",
	'options_values' => array(
		'1' => elgg_echo('Yes'),
		'2' => elgg_echo('No')
	),
	'value' => $filterenabled
));

$user_filter_values_input = elgg_view('input/plaintext', array(
	'name' => "params[userlist]",
	'value' => $userlist
));

$enablemods_label = elgg_echo('publicfilter:label:enablemods');

$enablemods_input = elgg_view('input/dropdown', array(
	'name' => "params[enablemods]",
	'options_values' => array(
		'1' => elgg_echo('Yes'),
		'2' => elgg_echo('No')
	),
	'value' => $enablemods
));

$modlist_input = elgg_view('input/plaintext', array(
	'name' => "params[modlist]",
	'value' => $modlist
));

$subtypes_label = elgg_echo('publicfilter:label:subtypes');


$subtypes_input = elgg_view('input/plaintext', array(
	'name' => "params[subtypes]",
	'value' => $subtypes
));


$body = <<<HTML
	<div>
		<label>$user_filter_label</label>$user_filter_enabled_input<br />
		$user_filter_values_input
	</div>
	<div>
		<label>$enablemods_label</label>$enablemods_input<br />
		$modlist_input
	</div>
	<div>
		<label>$subtypes_label<label><br />
		$subtypes_input
	</div>
HTML;

echo $body;
