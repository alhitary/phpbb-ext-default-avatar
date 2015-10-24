<?php namespace alfredoramos\defaultavatar\includes;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
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
	
	/** @var \phpbb\db\tools */
	protected $db_tools;
	
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
		$this->db_tools = new \phpbb\db\tools($this->db);
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
	
	public function style_avatar_exists($style, $avatar, $ext = 'gif') {
		$avatar = vsprintf('%s/styles/%s/theme/images/%s.%s', [$this->phpbb_root_path, $style, $avatar, $ext]);
		
		return file_exists(realpath($avatar));
	}
	
	public function get_current_style() {
		$style = $this->get_style($this->config['default_style']);
		
		if ($this->user->data['user_style'] != $this->config['default_style'] && !$this->config['override_user_style']) {
			$style = $this->get_style($this->user->data['user_style']);
		}
		
		return $style;
	}
	
	public function get_current_style_avatar() {
		$style = $this->get_current_style();
		$gender = '';
		$avatar_img = 'no_avatar';
		$avatar_img_ext = 'gif';
		$image_extensions = explode(',', trim($this->config['default_avatar_image_extensions']));
		
		if ($this->can_enable_gender_avatars() && $this->config['default_avatar_by_gender']) {
			$gender = ($this->user->data['user_gender'] === '1') ? 'male' : $gender;
			$gender = ($this->user->data['user_gender'] === '2') ? 'female' : $gender;
			
			if (!empty($gender) && !empty($this->config[sprintf('default_avatar_image_%s', $gender)])) {
				$avatar_img = $this->config[sprintf('default_avatar_image_%s', $gender)];
			}
			
			if ($this->config['default_avatar_type'] === 'style') {
				foreach ($image_extensions as $img_ext) {
					$img_ext = trim($img_ext);
				
					if (!empty($img_ext) && $this->style_avatar_exists($style['style_path'], $avatar_img, $img_ext)) {
						$avatar_img = (!empty($gender)) ? sprintf('no_avatar_%s', $gender) : $avatar_img;
						$avatar_img_ext = $img_ext;
					}
				}
			}
		}
		
		return vsprintf('./styles/%s/theme/images/%s.%s', [$style['style_path'], $avatar_img, $avatar_img_ext]);
	}
	
	public function can_enable_gender_avatars() {
		return $this->db_tools->sql_column_exists(USERS_TABLE, 'user_gender');
	}
}