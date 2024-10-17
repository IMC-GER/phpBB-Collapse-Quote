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

class update_v120 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['imcger_collapsequote_aktive']);
	}

	public static function depends_on()
	{
		return ['\imcger\collapsequote\migrations\update_v110'];
	}

	public function update_data()
	{
		return [
			['config.add', ['imcger_collapsequote_aktive', 1]],
			['config.add', ['imcger_collapsequote_text_top', 1]],
		];
	}

	public function update_schema()
	{
		$visible_lines = $this->config['imcger_collapsequote_visible_lines'] ?? 4;

		return [
			'add_columns' => [
				USERS_TABLE => [
					'user_collapsequote_aktive'	  => ['BOOL', 1],
					'user_collapsequote_lines'	  => ['UINT:4', $visible_lines],
					'user_collapsequote_text_top' => ['BOOL', 1],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns' => [
				USERS_TABLE => [
					'user_collapsequote_aktive',
					'user_collapsequote_lines',
					'user_collapsequote_text_top',
				],
			],
		];
	}
}
