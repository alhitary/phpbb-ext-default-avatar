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
		$this->tpl_name = 'default_avatar_settings';
		$this->page_title = $user->lang('ACP_DEFAULT_AVATAR');
		add_form_key('alfredoramos/defaultavatar');
		
		if ($request->is_set_post('submit')) {
			if (!check_form_key('alfredoramos/defaultavatar')) {
				trigger_error('FORM_INVALID');
			}
			
			/**
			 * Localization
			 */
			$config->set('default_avatar_image', $request->variable('default_avatar_image', $config['default_avatar_image']));
			$config->set('default_avatar_driver', $request->variable('default_avatar_driver', $config['default_avatar_driver']));
			
			trigger_error($user->lang('ACP_DEFAULT_AVATAR_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
		
		$notice = vsprintf(
			'<p>%s</p>'.
			'<p>%s</p>'.
			'<p>%s</p>'.
			'<p>%s</p>',
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
				]),
				vsprintf($user->lang('ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'), [
					$user->lang('ACP_AVATAR_SETTINGS'),
					$config['avatar_max_width'],
					$config['avatar_max_height']
				])
		]);
		
		/**
		 * Template variables
		 */
		$template->assign_vars([
			'U_ACTION'				=> $this->u_action,
			'DEFAULT_AVATAR_IMAGE'	=> $config['default_avatar_image'],
			'DEFAULT_AVATAR_DRIVER'	=> $config['default_avatar_driver'],
			'DEFAULT_AVATAR_NOTICE'	=> $notice
		]);
	}
}
