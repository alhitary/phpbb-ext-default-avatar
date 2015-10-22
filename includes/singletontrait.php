<?php namespace alfredoramos\defaultavatar\includes;

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

trait singletontrait {
	private static $instance = null;
	
	final private function __construct(){
		static::init();
	}
	
	final private function __clone() {}
	final private function __wakeup() {}
	
	final public static function instance() {
		if (static::$instance === null) {
			static::$instance = new static;
		}
		
		return static::$instance;
	}
	
	protected function init() {}
}