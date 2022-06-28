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
	'ACP_COLLAPSEQUOTE_TITLE' => 'Collapse Quote',
	'ACP_COLLAPSEQUOTE_SETTINGS' => 'Einstellungen',
	'ACP_COLLAPSEQUOTE_SETTING_SAVED' => 'Collapse Quote Einstellungen erfolgreich gespeichert.',

	'IMCGER_IM_REQUIRE_PHPBB' => 'Diese Erweiterung benötigt eine phpBB Version gleich oder grösser 3.2.0 und kleiner 4.0.0',
	'IMCGER_IM_REQUIRE_PHP'	  => 'Diese Erweiterung benötigt eine php Version gleich oder grösser 5.4.7 und kleiner 8.2.',
]);
