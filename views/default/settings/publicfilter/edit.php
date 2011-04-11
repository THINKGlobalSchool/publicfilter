<?php
	/**
	 * Public Filter settings form
	 * 
	 * @package ParentFilter
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
?>
<p>
	<label><?php echo elgg_echo('publicfilter:label:filterusers'); ?></label>
	<select name="params[filterenabled]">
 		<option value="1" <?php if ($vars['entity']->filterenabled == 1) echo " selected=\"yes\" "; ?>>Yes</option>
 		<option value="0" <?php if ($vars['entity']->filterenabled == 0) echo " selected=\"yes\" "; ?>>No</option>
 	</select>
	<br />
    <?php 
	echo elgg_view('input/plaintext', array(
										'name' => 'params[userlist]', 
										'value' => $vars['entity']->userlist)
										); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('publicfilter:label:enablemods'); ?></label>
	<select name="params[modsenabled]">
 		<option value="1" <?php if ($vars['entity']->modsenabled == 1) echo " selected=\"yes\" "; ?>>Yes</option>
 		<option value="0" <?php if ($vars['entity']->modsenabled == 0) echo " selected=\"yes\" "; ?>>No</option>
 	</select>
	<br />
    <?php 
	echo elgg_view('input/plaintext', array(
										'name' => 'params[modlist]', 
										'value' => $vars['entity']->modlist)
										); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('publicfilter:label:subtypes'); ?></label>
	<br />
    <?php 
	echo elgg_view('input/plaintext', array(
										'name' => 'params[subtypes]', 
										'value' => $vars['entity']->subtypes)
										); 
	?>
</p>

