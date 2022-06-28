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

namespace imcger\collapsequote\controller;

class admin_controller
{
	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var language */
	protected $language;

	/** @var request */
	protected $request;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param config				$config
	 * @param template				$template
	 * @param language				$language
	 * @param request				$request
	 *
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\request\request $request
	)
	{
		$this->config	= $config;
		$this->template	= $template;
		$this->language	= $language;
		$this->request	= $request;
	}

	/**
	 * Display the options a user can configure for this extension
	 *
	 * @return null
	 * @access public
	 */
	public function display_options()
	{
		/* Add ACP lang file */
		$this->language->add_lang('common', 'imcger/collapsequote');

		add_form_key('imcger/collapsequote');

		/* Is the form being submitted to us? */
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('imcger/collapsequote'))
			{
				trigger_error('FORM_INVALID' . adm_back_link($this->u_action), E_USER_WARNING);
			}

			/* Store the variable to the db */
			$this->set_variable();

			trigger_error($this->language->lang('ACP_COLLAPSEQUOTE_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars([
			'U_ACTION'								=> $this->u_action,
			'IMCGER_COLLAPSEQUOTE_VISIBLE_LINES'	=> $this->config['imcger_collapsequote_visible_lines'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_BG'		=> $this->config['imcger_collapsequote_button_bg'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_FG'		=> $this->config['imcger_collapsequote_button_fg'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_BG_HOVER'	=> $this->config['imcger_collapsequote_button_bg_hover'],
			'IMCGER_COLLAPSEQUOTE_BUTTON_FG_HOVER'	=> $this->config['imcger_collapsequote_button_fg_hover'],
		]);
	}

	/**
	 * Store the variable to the db
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_variable()
	{
		/* Show minium 2 lines in the Quotebox */
		$visible_lines = $this->request->variable('imcger_collapsequote_visible_lines', 4) < 2 ? 2 : $this->request->variable('imcger_collapsequote_visible_lines', 4);

		$this->config->set('imcger_collapsequote_visible_lines', $visible_lines);
		$this->config->set('imcger_collapsequote_button_bg', $this->request->variable('imcger_collapsequote_button_bg', ''));
		$this->config->set('imcger_collapsequote_button_fg', $this->request->variable('imcger_collapsequote_button_fg', ''));
		$this->config->set('imcger_collapsequote_button_bg_hover', $this->request->variable('imcger_collapsequote_button_bg_hover', ''));
		$this->config->set('imcger_collapsequote_button_fg_hover', $this->request->variable('imcger_collapsequote_button_fg_hover', ''));
	}

	/**
	 * Set page url
	 *
	 * @param string $u_action Custom form action
	 * @return null
	 * @access public
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
