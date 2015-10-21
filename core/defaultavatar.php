<?php namespace alfredoramos\defaultavatar\core;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

class defaultavatar {
	use singletontrait;
	
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;
	
	protected function init() {
		global $db, $user, $phpbb_admin_path, $phpbb_root_path, $phpEx, $template, $request, $cache, $auth, $config;
		
		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->request = $request;
		$this->cache = $cache;
		$this->auth = $auth;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}
	
	public function get_style($id) {
		$sql = 'SELECT *
				FROM ' . STYLES_TABLE . '
				WHERE style_id = "' . $this->db->sql_escape($id) . '"';
		$result = $this->db->sql_query($sql);;
		$style = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		return $style;
	}
	
	public function get_current_style_avatar() {
		$style = $this->get_style($this->config['default_style']);
		
		if ($this->user->data['user_style'] != $this->config['default_style'] && !$this->config['override_user_style']) {
			$style = $this->get_style($this->user->data['user_style']);
		}
		
		return sprintf('./styles/%s/theme/images/no_avatar.gif', $style['style_path']);
	}
}