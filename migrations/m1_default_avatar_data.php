<?php namespace alfredoramos\defaultavatar\migrations;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

class m1_default_avatar_data extends \phpbb\db\migration\migration {
	
	public function effectively_installed() {
		return isset($this->config['default_avatar_image']);
	}
	/**
	 * Install BBCode data
	 * @return array
	 */
	public function update_data() {
		return [
			[
				'config.add',
				['default_avatar_image', './styles/prosilver/theme/images/no_avatar.gif']
			],
			[
				'config.add',
				['default_avatar_driver', 'remote']
			],
			[
				'module.add',
				['acp', 'ACP_CAT_DOT_MODS', 'ACP_DEFAULT_AVATAR']
			],
			[
				'module.add',
				['acp', 'ACP_DEFAULT_AVATAR', [
					'module_basename'	=> '\alfredoramos\defaultavatar\acp\main_module',
					'modes'				=> ['settings']
				]]
			]
		];
	}
	
	/**
	 * Uninstall BBCode data
	 * @return array
	 */
	public function revert_data() {
		return [
			[
				'config.remove',
				[
					'default_avatar_image',
					'default_avatar_driver'
				]
			]
		];
	}
}