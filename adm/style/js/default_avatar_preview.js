/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

function get_gravatar($email, $size = 90) {
	var $base_url = 'https://secure.gravatar.com/avatar/';
	var $url = $base_url + md5($email) + '.jpg?s=' + $size + '&d=identicon';
	return $url;
}

function setup_default_avatar_preview() {
	/**
	 * Attributes
	 */
	var $previewWrapper = $('#default_avatar_preview');
	var $board_url = $.trim($previewWrapper.attr('data-board-url'));
	var $board_style = $.trim($previewWrapper.attr('data-board-style'));
	var $min_width = parseInt($.trim($previewWrapper.attr('data-min-width')));
	var $max_width = parseInt($.trim($previewWrapper.attr('data-max-width')));
	var $min_height = parseInt($.trim($previewWrapper.attr('data-min-height')));
	var $max_height = parseInt($.trim($previewWrapper.attr('data-max-height')));
	
	/**
	 * Form variables
	 */
	var $type = $.trim($('[name="default_avatar_type"]:checked').val());
	var $image = $.trim($('#default_avatar_image').val());
	var $width = parseInt($.trim($('#default_avatar_width').val()));
	var $height = parseInt($.trim($('#default_avatar_height').val()));
	
	/**
	 * Helpers
	 */
	var $img = {src: '', width: $width, height: $height};
	var $html = '';
	
	switch ($type) {
		case 'local':
			$img.src = $board_url + 'images/avatars/gallery/' + $image;
			break;
		case 'style':
			$img.src = $board_url + 'styles/' + $board_style + '/theme/images/no_avatar.gif';
			break;
		case 'remote':
			var $matches = [];
			$img.src = ($matches = $image.match(/(https?:\/\/(?:www\.)?)|(data:\w+\/\w+;base64)/i)) ? $image : $board_url + $image;
			break;
		case 'gravatar':
			$img.src = get_gravatar($image, $img.width);
			break;
	}
	
	/**
	 * HTML image tag
	 */
	$html += '<img ';
	$html += 'src="' + $img.src + '" ';
	$html += 'width="' + $img.width + '" ';
	$html += 'height="' + $img.height + '" ';
	$html += 'style="min-width:' + $min_width + 'px;max-width:' + $max_width + 'px;min-height:' + $min_height + 'px;max-height:' + $max_height + 'px" ';
	$html += '/>';
	
	$previewWrapper.html($html);
}

$(document).on('ready', function() {
	setup_default_avatar_preview();
	$('.default-avatar-control').on('change', function() {
		setup_default_avatar_preview();
	});
	$('.default-avatar-control').on('keydown', function() {
		setup_default_avatar_preview();
	});
	$('.default-avatar-control').on('keyup', function() {
		setup_default_avatar_preview();
	});
});