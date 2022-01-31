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

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'COLLAPSEQUOTE_TITLE' => 'Collapse Quote',
	'COLLAPSEQUOTE_TITLE_EXPLAIN' => 'Here you can set the size of the quote box and the colors of the button used to resize the quote box.',

	'COLLAPSEQUOTE_SETTINGS_STYLE' => 'Settings',

	'COLLAPSEQUOTE_VISIBLE_LINES' => 'Visible lines',
	'COLLAPSEQUOTE_VISIBLE_LINES_DESC' => 'Number of visible lines of the quote box in minimized state.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR' => 'Foreground button color',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_DESC' => 'Selection of the font color of the button to max-/minimize the quote box. If the field is empty, the system color is used.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR' => 'Background button color',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_DESC' => 'Selection of the background button color.  If the field is empty, the system color is used.',
));
