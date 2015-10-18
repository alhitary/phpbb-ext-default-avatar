<?php namespace alfredoramos\defaultavatar\acp;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

class main_module {
	public $u_action;

	public function main($id, $mode) {
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/common');
		$user->add_lang('acp/board');
		$this->tpl_name = 'default_avatar_settings';
		$this->page_title = $user->lang('ACP_DEFAULT_AVATAR');
		add_form_key('alfredoramos/defaultavatar');
		
		if ($request->is_set_post('submit')) {
			if (!check_form_key('alfredoramos/defaultavatar')) {
				trigger_error('FORM_INVALID');
			}
			
			/**
			 * Avatar width
			 */
			$avatar_width = $request->variable('default_avatar_width', $config['default_avatar_width']);
			$avatar_width = ($avatar_width < $config['avatar_min_width']) ? $config['avatar_min_width'] : $avatar_width ;
			$avatar_width = ($avatar_width > $config['avatar_max_width']) ? $config['avatar_max_width'] : $avatar_width ;
			
			/**
			 * Avatar height
			 */
			$avatar_height = $request->variable('default_avatar_height', $config['default_avatar_height']);
			$avatar_height = ($avatar_height < $config['avatar_min_height']) ? $config['avatar_min_height'] : $avatar_height;
			$avatar_height = ($avatar_height > $config['avatar_max_height']) ? $config['avatar_max_height'] : $avatar_height;
			
			/**
			 * Avatar settings
			 */
			$config->set('default_avatar_image', $request->variable('default_avatar_image', $config['default_avatar_image']));
			$config->set('default_avatar_driver', $request->variable('default_avatar_driver', $config['default_avatar_driver']));
			$config->set('default_avatar_width', $avatar_width);
			$config->set('default_avatar_height', $avatar_height);
			
			trigger_error($user->lang('ACP_DEFAULT_AVATAR_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
		
		$driver_notice = vsprintf(
			'%s<br />'.
			'%s<br />'.
			'%s<br />',
			[
				vsprintf('%s: %s', [
					$user->lang('ACP_DEFAULT_AVATAR_DRIVER_LOCAL'),
					vsprintf($user->lang('ACP_DEFAULT_AVATAR_DRIVER_LOCAL_INFO'), [
						'./' . $config['avatar_gallery_path']
					])
				]),
				vsprintf('%s: %s', [
					$user->lang('ACP_DEFAULT_AVATAR_DRIVER_REMOTE'),
					$user->lang('ACP_DEFAULT_AVATAR_DRIVER_REMOTE_INFO')
				]),
				vsprintf('%s: %s', [
					$user->lang('ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR'),
					$user->lang('ACP_DEFAULT_AVATAR_DRIVER_GRAVATAR_INFO'),
				])
		]);
		
		/**
		 * Template variables
		 */
		$template->assign_vars([
			'U_ACTION'							=> $this->u_action,
			'DEFAULT_AVATAR_IMAGE'				=> $config['default_avatar_image'],
			'DEFAULT_AVATAR_DRIVER'				=> $config['default_avatar_driver'],
			'DEFAULT_AVATAR_WIDTH'				=> $config['default_avatar_width'],
			'DEFAULT_AVATAR_HEIGHT'				=> $config['default_avatar_height'],
			'DEFAULT_AVATAR_DRIVER_NOTICE'		=> $driver_notice,
			'DEFAULT_AVATAR_DIMENSIONS_NOTICE'	=> sprintf($user->lang('ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS_INFO'), $user->lang('ACP_AVATAR_SETTINGS')),
			'CONFIG_AVATAR_MIN_WIDTH'			=> $config['avatar_min_width'],
			'CONFIG_AVATAR_MAX_WIDTH'			=> $config['avatar_max_width'],
			'CONFIG_AVATAR_MIN_HEIGHT'			=> $config['avatar_min_height'],
			'CONFIG_AVATAR_MAX_HEIGHT'			=> $config['avatar_max_height']
		]);
	}
}
