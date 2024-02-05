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
	'ACP_COLLAPSEQUOTE_TITLE'			=> 'Collapse Quote',
	'ACP_COLLAPSEQUOTE_SETTINGS'		=> 'Settings',
	'ACP_COLLAPSEQUOTE_SETTING_SAVED'	=> 'Collapse Quote Settings saved successfully.',

	// Messages requirement check
	'IMCGER_REQUIRE_PHPBB'	 => 'This extension requires a phpBB version greater or equal than %1$s and less than %2$s. Your version is %3$s.',
	'IMCGER_REQUIRE_PHP'	 => 'This extension requires a php version greater or equal than %1$s and less than %2$s. Your version is %3$s.',
]);
