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

namespace imcger\collapsequote;

/**
 * Extension base
 */
class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$config = $this->container->get('config');

		/* If phpBB version 3.1 or less cancel */
		if (phpbb_version_compare($config['version'], '3.2.0', '<'))
		{
			return false;
		}

		$language = $this->container->get('language');
		$language->add_lang('info_acp_collapsequote', 'imcger/collapsequote');
		$error_message = [];

		/* phpBB version greater equal 3.2.0 and less then 4.0 */
		if (phpbb_version_compare($config['version'], '3.2.0', '<') || phpbb_version_compare($config['version'], '4.0.0', '>='))
		{
			$error_message += ['error1' => $language->lang('IMCGER_REQUIRE_PHPBB'),];
		}

		/* php version equal or greater 5.4.7 and less 8.2 */
		if (version_compare(PHP_VERSION, '5.4.7', '<') || version_compare(PHP_VERSION, '8.2', '>='))
		{
			$error_message += ['error2' => $language->lang('IMCGER_REQUIRE_PHP'),];
		}

		/* When phpBB older then 3.3.0 use trigger_error() for message output */
		if (phpbb_version_compare($config['version'], '3.3.0', '<') && !empty($error_message))
		{
			$error_message = implode('<br>', $error_message);
			trigger_error($error_message, E_USER_WARNING);
		}

		return empty($error_message) ? true : $error_message;
	}
}
