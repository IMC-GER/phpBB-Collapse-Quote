<?php
/**
 *
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'COLLAPSEQUOTE_TITLE' => 'Collapse Quote',
	'COLLAPSEQUOTE_TITLE_EXPLAIN' => 'Here you can set the size of the quote box and the colors of the button used to resize the quote box.',

	'COLLAPSEQUOTE_SETTINGS_STYLE' => 'Settings',

	'COLLAPSEQUOTE_VISIBLE_LINES' => 'Visible lines',
	'COLLAPSEQUOTE_VISIBLE_LINES_DESC' => 'Number of visible lines of the quote box in minimized state.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR' => 'Foreground button color',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_DESC' => 'Selection of the font color of the button to max-/minimize the quote box. If the field is empty, the system color is used.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR' => 'Background button color',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_DESC' => 'Selection of the background button color.  If the field is empty, the system color is used.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR_HOVER' => 'Foreground button color for mouseover-effect',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_HOVER_DESC' => 'Selection of the font color of the button for enlarging or reducing the quotation mark field, when moving the mouse over it. No color change occurs if the field is empty.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_HOVER' => 'Background button color for mouseover-effect',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_HOVER_DESC' => 'Selection of the button background color, when moving the mouse over it. No color change occurs if the field is empty.',
]);
