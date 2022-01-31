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
	'COLLAPSEQUOTE_TITLE_EXPLAIN' => 'Hier können die Größe der Quotebox und die Farben des Buttons, der zur Größenänderung der Quotebox dient eingestellt werden.',

	'COLLAPSEQUOTE_SETTINGS_STYLE' => 'Einstellungen',

	'COLLAPSEQUOTE_VISIBLE_LINES' => 'Sichtbare Zeilen',
	'COLLAPSEQUOTE_VISIBLE_LINES_DESC' => 'Anzahl der sichtbaren Zeilen der Quotebox im minimierten Zustand.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR' => 'Button Vordergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_DESC' => 'Auswahl der Schriftfarbe des Button zum Max-/Minimieren der Quotebox. Bei leerem Feld wird die Systemfarbe verwendet.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR' => 'Button Hintergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_DESC' => 'Auswahl der Button Grundfarbe. Bei leerem Feld wird die Systemfarbe verwendet.',
));
