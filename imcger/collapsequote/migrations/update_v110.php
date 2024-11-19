<?php
/**
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\collapsequote\migrations;

class update_v110 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['imcger_collapsequote_button_fg_hover']);
	}

	public static function depends_on()
	{
		return ['\imcger\collapsequote\migrations\install_acp_module'];
	}

	public function update_data()
	{
		return [
			['config.add', ['imcger_collapsequote_button_fg_hover', 'd31141']],
			['config.add', ['imcger_collapsequote_button_bg_hover', '']],
		];
	}
}
