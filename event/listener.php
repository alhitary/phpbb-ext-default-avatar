<?php namespace alfredoramos\defaultavatar\event;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface {
	
	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\config\config */
	protected $config;
	
	/* @vat \phpbb\user */
	protected $user;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template			$template	Template object
	 * @param \phpbb\config\config		$config		Config object
	 * @param \phpbb\user				$user		User object
	 */
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\user $user) {
		$this->helper = $helper;
		$this->template = $template;
		$this->config = $config;
		$this->user = $user;
	}
	
	static public function getSubscribedEvents() {
		return [
			'core.user_setup'					=> 'load_language_on_setup',
			'core.page_header'					=> 'page_header_default_avatar',
			'core.viewtopic_post_rowset_data'	=> 'viewtopic_post_default_avatar',
			'core.ucp_pm_view_messsage'			=> 'ucp_pm_default_avatar',
			'core.memberlist_view_profile'		=> 'viewprofile_default_avatar'
		];
	}
	
	public function load_language_on_setup($event) {
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/defaultavatar',
			'lang_set'	=> 'defaultavatar'
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	public function page_header_default_avatar($event) {
		if (empty($this->user->data['user_avatar']) && $this->config['allow_avatar']) {
			$default_avatar_set_ext = array_merge($this->user->data, [
				'user_avatar'			=> $this->config['default_avatar_image'],
				'user_avatar_type'		=> 'avatar.driver.' . $this->config['default_avatar_driver'],
				'user_avatar_width'		=> $this->config['default_avatar_width'],
				'user_avatar_height'	=> $this->config['default_avatar_height']
			]);
			$this->user->data = $default_avatar_set_ext;
		}
	}
	
	public function viewtopic_post_default_avatar($event) {
		if (empty($event['row']['user_avatar']) && $this->config['allow_avatar']) {
			$default_avatar_set_ext = array_merge($event['row'], [
				'user_avatar'			=> $this->config['default_avatar_image'],
				'user_avatar_type'		=> 'avatar.driver.' . $this->config['default_avatar_driver'],
				'user_avatar_width'		=> $this->config['default_avatar_width'],
				'user_avatar_height'	=> $this->config['default_avatar_height']
			]);
			$event['row'] = $default_avatar_set_ext;
		}
	}
	
	public function ucp_pm_default_avatar($event) {
		if (empty($event['msg_data']['AUTHOR_AVATAR']) && $this->config['allow_avatar']) {
			$default_avatar_set_ext = array_merge($event['msg_data'], [
				'AUTHOR_AVATAR'	=> vsprintf('<img src="%s" width="%d" height="%d" alt="%s" />', [
					$this->config['default_avatar_image'],
					$this->config['default_avatar_width'],
					$this->config['default_avatar_height'],
					$this->user->lang('USER_AVATAR')
				])
			]);
			$event['msg_data'] = $default_avatar_set_ext;
		}
	}
	
	public function viewprofile_default_avatar($event) {
		if (empty($event['member']['user_avatar']) && $this->config['allow_avatar']) {
			$default_avatar_set_ext = array_merge($event['member'], [
				'user_avatar'			=> $this->config['default_avatar_image'],
				'user_avatar_type'		=> 'avatar.driver.' . $this->config['default_avatar_driver'],
				'user_avatar_width'		=> $this->config['default_avatar_width'],
				'user_avatar_height'	=> $this->config['default_avatar_height']
			]);
			$event['member'] = $default_avatar_set_ext;
		}
	}
	
}