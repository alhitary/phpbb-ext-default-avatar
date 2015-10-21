<?php namespace alfredoramos\defaultavatar\acp;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

class main_info {
	
	public function module() {
		return [
			'filename'	=> '\alfredoramos\defaultavatar\acp\main_module',
			'title'		=> 'ACP_DEFAULT_AVATAR',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'SETTINGS',
					'auth'	=> 'ext_alfredoramos/defaultavatar && acl_a_board',
					'cat'	=> ['ACP_DEFAULT_AVATAR']
				]
			]
		];
	}
	
}