<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
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
	'ACP_DEFAULT_AVATAR_TYPE'					=> 'Avatar type',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE'				=> 'From style',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE_INFO'		=> 'Get the image from the user\'s style',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL'				=> 'Local',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL_INFO'		=> 'Must be in the <code>%s</code> path.',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE'			=> 'Remote',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE_INFO'		=> 'Can be an external link or a relative image to your phpBB root directory.',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR'			=> 'Gravatar',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR_INFO'		=> 'Must be a valid email address.',
	'ACP_DEFAULT_AVATAR_IMAGE'					=> 'Avatar image',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'		=> 'Avatar dimensions',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS_INFO'	=> 'Maximum and minimum image dimensions depend on the <strong>%s</strong>.',
	'ACP_DEFAULT_AVATAR_JAVASCRIPT_WARNING'		=> 'Preview requires JavaScript to function, please turn it on.',
	'ACP_DEFAULT_AVATAR_IMAGE_PREVIEW_INFO'		=> 'This is what the avatar will look like.',
	'ACP_DEFAULT_AVATAR_SETTINGS_SAVED'			=> 'Settings have been saved successfully!'
]);