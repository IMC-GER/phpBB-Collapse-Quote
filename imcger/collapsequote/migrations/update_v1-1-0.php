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

namespace imcger\collapsequote\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['imcger_collapsequote_button_fg_hover']);
	}

	public static function depends_on()
	{
		return array('\imcger\collapsequote_button\migration\install_acp_module');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('imcger_collapsequote_button_fg_hover', '')),
			array('config.add', array('imcger_collapsequote_button_bg_hover', '')),
		);
	}
}
