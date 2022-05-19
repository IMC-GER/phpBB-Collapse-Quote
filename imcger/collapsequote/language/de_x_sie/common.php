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
	'COLLAPSEQUOTE_TITLE_EXPLAIN' => 'Hier können die Größe der Quotebox und die Farben des Buttons, der zur Größenänderung der Quotebox dient eingestellt werden.',

	'COLLAPSEQUOTE_SETTINGS_STYLE' => 'Einstellungen',

	'COLLAPSEQUOTE_VISIBLE_LINES' => 'Sichtbare Zeilen',
	'COLLAPSEQUOTE_VISIBLE_LINES_DESC' => 'Anzahl der sichtbaren Zeilen der Quotebox im minimierten Zustand.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR' => 'Button Vordergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_DESC' => 'Auswahl der Schriftfarbe des Button zum Max-/Minimieren der Quotebox. Bei leerem Feld wird die Systemfarbe verwendet.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR' => 'Button Hintergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_DESC' => 'Auswahl der Button Grundfarbe. Bei leerem Feld wird die Systemfarbe verwendet.',
]);
