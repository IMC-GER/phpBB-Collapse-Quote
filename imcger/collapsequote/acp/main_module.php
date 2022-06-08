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

namespace imcger\collapsequote\acp;

/**
 * Collapse Quote ACP module.
 */
class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user;

		$user->add_lang_ext('imcger/collapsequote', 'common');
		$this->tpl_name = 'acp_collapsequote_body';
		$this->page_title = $user->lang('ACP_COLLAPSEQUOTE_TITLE');
		add_form_key('imcger/collapsequote');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('imcger/collapsequote'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$visible_lines = $request->variable('imcger_collapsequote_visible_lines', 4) < 2 ? 2 : $request->variable('imcger_collapsequote_visible_lines', 4);

			$config->set('imcger_collapsequote_visible_lines', $visible_lines);
			$config->set('imcger_collapsequote_button_bg', $request->variable('imcger_collapsequote_button_bg', ''));
			$config->set('imcger_collapsequote_button_fg', $request->variable('imcger_collapsequote_button_fg', ''));
			$config->set('imcger_collapsequote_button_bg_hover', $request->variable('imcger_collapsequote_button_bg_hover', ''));
			$config->set('imcger_collapsequote_button_fg_hover', $request->variable('imcger_collapsequote_button_fg_hover', ''));

			trigger_error($user->lang('ACP_COLLAPSEQUOTE_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars([
			'U_ACTION'								=> $this->u_action,
			'IMCGER_COLLAPSEQUOTE_VISIBLE_LINES'	=> $config['imcger_collapsequote_visible_lines'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_BG'		=> $config['imcger_collapsequote_button_bg'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_FG'		=> $config['imcger_collapsequote_button_fg'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_BG_HOVER'	=> $config['imcger_collapsequote_button_bg_hover'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_FG_HOVER'	=> $config['imcger_collapsequote_button_fg_hover'],
		]);
	}
}
