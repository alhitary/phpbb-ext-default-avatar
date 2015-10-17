<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB')) {
	exit;
}

if (empty($lang) || !is_array($lang)) {
	$lang = [];
}

$lang = array_merge($lang, [
	/**
	 * ACP
	 */
	'ACP_DEFAULT_AVATAR'						=> 'Default Avatar Extension',
	'ACP_DEFAULT_AVATAR_DRIVER'					=> 'Avatar driver',
	'ACP_DEFAULT_AVATAR_DRIVER_LOCAL'			=> 'Local',
	'ACP_DEFAULT_AVATAR_DRIVER_LOCAL_INFO'		=> 'Must be a relative image to <code>%s</code>.',
	'ACP_DEFAULT_AVATAR_DRIVER_REMOTE'			=> 'Remote',
	'ACP_DEFAULT_AVATAR_DRIVER_REMOTE_INFO'		=> 'Can be an external link as well as a relative image to your phpBB root directory.',
	'ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR'		=> 'Gravatar',
	'ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR_INFO'	=> 'Must be a valid email address.',
	'ACP_DEFAULT_AVATAR_IMAGE'					=> 'Avatar image',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'		=> 'Default image dimensions depend on the <strong>%s</strong>. Currently are set to <code>%d</code> x <code>%d</code> pixels.',
	'ACP_DEFAULT_AVATAR_SETTINGS_SAVED'			=> 'Settings have been saved successfully!'
]);