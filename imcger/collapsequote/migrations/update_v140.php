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

class update_v140 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return !isset($this->config['imcger_collapsequote_aktive']);
	}

	public static function depends_on()
	{
		return ['\imcger\collapsequote\migrations\update_v120'];
	}

	public function update_data()
	{
		return [
			['config.remove', ['imcger_collapsequote_aktive']],
			['config.remove', ['imcger_collapsequote_text_top']],
			['config.remove', ['imcger_collapsequote_visible_lines']],
		];
	}

	public function revert_data()
	{
		return [
			['config.add', ['imcger_collapsequote_aktive', 1]],
			['config.add', ['imcger_collapsequote_text_top', 1]],
			['config.add', ['imcger_collapsequote_visible_lines', 4]],
		];
	}
}
