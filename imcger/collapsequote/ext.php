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
		$language = $this->container->get('language');
		$language->add_lang('info_acp_collapsequote', 'imcger/collapsequote');

		/* phpBB version greater equal 3.2.0 */
		$config = $this->container->get('config');
		if (!phpbb_version_compare($config['version'], '3.2.0', '>='))
		{
			trigger_error($language->lang('IMCGER_IM_REQUIRE_320'), E_USER_WARNING);
		}

		return true;
	}
}
