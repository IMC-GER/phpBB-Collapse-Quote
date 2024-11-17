<?php
/**
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
	// Module
	'ACP_COLLAPSEQUOTE_TITLE'			=> 'Collapse Quote',
	'ACP_COLLAPSEQUOTE_SETTINGS'		=> 'Einstellungen',
	'ACP_COLLAPSEQUOTE_SETTING_SAVED'	=> 'Collapse Quote Einstellungen erfolgreich gespeichert.',

	// Language pack author
	'COLLAPSEQUOTE_LANG_DESC'				=> 'Deutsch (Du)',
	'COLLAPSEQUOTE_LANG_EXT_VER' 			=> '1.4.0',
	'COLLAPSEQUOTE_LANG_AUTHOR' 			=> 'IMC-Ger',

	// Message text
	'COLLAPSEQUOTE_SETTING_SAVED'			=> 'Die Einstellungen wurden erfolgreich gespeichert.',
	'COLLAPSEQUOTE_USER_SETTING_SAVED'		=> 'Die Einstellungen wurden für alle Benutzern erfolgreich gespeichert.',
	'COLLAPSEQUOTE_DEFAULT_SETTING_SAVED'	=> 'Die Standarteinstellungen für neue Benutzer und Gäste wurden erfolgreich gespeichert.',

	// Confirm Box
	'COLLAPSEQUOTE_USER_SET_CONFIRM'		=> 'Diese Einstellung überschreibt alle Benutzereinstellungen mit deinen Standardwerten.<br><strong>Dieser Vorgang kann nicht rückgängig gemacht werden!</strong>',

	// Extension description
	'COLLAPSEQUOTE_TITLE'					=> 'Collapse Quote',
	'COLLAPSEQUOTE_TITLE_EXPLAIN'			=> 'Hier können die Größe des Zitatfeldes und die Farben des Buttons, der zur Größenänderung der Zitate dient, eingestellt werden.',

	// User settings
	'COLLAPSEQUOTE_SETTINGS_USER'			=> 'Einstellungen für Gäste und neue Benutzer',

	'COLLAPSEQUOTE_ACTIVE'					=> 'Zitate minimieren',
	'COLLAPSEQUOTE_ACTIVE_DESC'				=> 'Die Zitate werden auf die Anzahl der sichtbaren Zeilen minimiert und können mit einem Mausklick vollständig angezeigt werden.',

	'COLLAPSEQUOTE_VISIBLE_LINES'			=> 'Sichtbare Textzeilen',
	'COLLAPSEQUOTE_VISIBLE_LINES_DESC'		=> 'Anzahl der sichtbaren Textzeilen der Zitate im minimierten Zustand.',

	'COLLAPSEQUOTE_TEXT_TOP'				=> 'Textausrichtung',
	'COLLAPSEQUOTE_TEXT_TOP_DESC'			=> 'Bei Aktivierung werden im minimierten Zustand die ersten Zeilen angezeigt. Bei Deaktivierung die letzten Zeilen.',

	'COLLAPSEQUOTE_OVERWRITE_USERSET'		=> 'Benutzereinstellungen überschreiben',
	'COLLAPSEQUOTE_OVERWRITE_USERSET_DEC'	=> 'Bei dieser Auswahl werden die Einstellungen aller Benutzer überschrieben. Ohne diese Auswahl werden nur die Standartwerte für neue Benutzer und Gäste gesetzt.',

	// General settings
	'COLLAPSEQUOTE_SETTINGS_STYLE'				=> 'Einstellungen',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR'				=> 'Button Vordergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_DESC'		=> 'Auswahl der Schriftfarbe des Button zum Max-/Minimieren der Zitatfelder. Bei leerem Feld wird die Systemfarbe verwendet.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR'				=> 'Button Hintergrundfarbe',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_DESC'		=> 'Auswahl der Button Grundfarbe. Bei leerem Feld wird die Systemfarbe verwendet.',

	'COLLAPSEQUOTE_BUTTON_FG_COLOR_HOVER'		=> 'Button Vordergrundfarbe für den Mouseover-Effekt',
	'COLLAPSEQUOTE_BUTTON_FG_COLOR_HOVER_DESC'	=> 'Auswahl der Schriftfarbe des Button zum Max-/Minimieren der Zitatfelder beim Überfahren mit der Maus. Bei leerem Feld tritt keine Farbänderung ein.',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_HOVER'		=> 'Button Hintergrundfarbe für den Mouseover-Effekt',
	'COLLAPSEQUOTE_BUTTON_BG_COLOR_HOVER_DESC'	=> 'Auswahl der Button Grundfarbe beim überfahren mit der Maus. Bei leerem Feld tritt keine Farbänderung ein.',

	// Messages requirement check
	'IMCGER_REQUIRE_PHPBB'   => 'Diese Erweiterung benötigt eine phpBB Version gleich oder grösser %1$s und kleiner %2$s. Deine Version ist %3$s.',
	'IMCGER_REQUIRE_PHP'     => 'Diese Erweiterung benötigt eine php Version gleich oder grösser %1$s und kleiner %2$s. Deine Version ist %3$s.',
]);
