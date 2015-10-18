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
	'ACP_DEFAULT_AVATAR_DRIVER_REMOTE_INFO'		=> 'Can be an external link or a relative image to your phpBB root directory.',
	'ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR'		=> 'Gravatar',
	'ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR_INFO'	=> 'Must be a valid email address.',
	'ACP_DEFAULT_AVATAR_IMAGE'					=> 'Avatar image',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'		=> 'Avatar dimensions',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS_INFO'	=> 'Maximum and minimum image dimensions depend on the <strong>%s</strong>.',
	'ACP_DEFAULT_AVATAR_JAVASCRIPT_WARNING'		=> 'Preview requires JavaScript to function, please turn it on.',
	'ACP_DEFAULT_AVATAR_IMAGE_PREVIEW_INFO'		=> 'This is what the avatar will look like.',
	'ACP_DEFAULT_AVATAR_SETTINGS_SAVED'			=> 'Settings have been saved successfully!'
]);