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
		return isset($this->config['imcger_collapsequote_visible_lines']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('imcger_collapsequote_visible_lines', 4)),
			array('config.add', array('imcger_collapsequote_button_fg', '')),
			array('config.add', array('imcger_collapsequote_button_bg', '')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_COLLAPSEQUOTE_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_COLLAPSEQUOTE_TITLE',
				array(
					'module_basename'	=> '\imcger\collapsequote\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
