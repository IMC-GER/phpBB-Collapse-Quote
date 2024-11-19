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

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['imcger_collapsequote_visible_lines']);
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function update_data()
	{
		return [
			['config.add', ['imcger_collapsequote_visible_lines', 4]],
			['config.add', ['imcger_collapsequote_button_fg', '']],
			['config.add', ['imcger_collapsequote_button_bg', 'e3e1c3']],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_COLLAPSEQUOTE_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_COLLAPSEQUOTE_TITLE',
				[
					'module_basename'	=> '\imcger\collapsequote\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
