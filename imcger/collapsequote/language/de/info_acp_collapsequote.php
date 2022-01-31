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
	'ACP_COLLAPSEQUOTE_TITLE' => 'Collapse Quote',
	'ACP_COLLAPSEQUOTE_SETTINGS' => 'Einstellungen',
	'ACP_COLLAPSEQUOTE_SETTING_SAVED' => 'Collapse Quote Einstellungen erfolgreich gespeichert.'
));
