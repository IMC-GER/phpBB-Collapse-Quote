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

class admin_controller_userset
{
	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var language */
	protected $language;

	/** @var request */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\extension\manager */
	protected $ext_manager;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\language\language			$language
	 * @param \phpbb\request\request			$request
	 * @param \phpbb\user						$user
	 * @param \phpbb\db\driver\driver_interface $db
	 * @param \phpbb\extension\manager			$ext_manager
	 *
	 */
	public function __construct
	(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\user $user,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\extension\manager $ext_manager
	)
	{
		$this->config		= $config;
		$this->template		= $template;
		$this->language		= $language;
		$this->request		= $request;
		$this->user 		= $user;
		$this->db			= $db;
		$this->ext_manager	= $ext_manager;
	}

	/**
	 * Display the options a user can configure for this extension
	 *
	 * @return null
	 * @access public
	 */
	public function display_options()
	{
		// Add ACP lang file
		$this->language->add_lang(['common', ], 'imcger/collapsequote');

		add_form_key('imcger/collapsequote');

		// Is the form being submitted to us?
		if ($this->request->is_set_post('action'))
		{
			if (!check_form_key('imcger/collapsequote'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$action = $this->request->variable('action', 'default');
			$overwrite_userset = $this->request->variable('imcger_collapsequote_overwrite_userset', 0);

			switch ($action)
			{
				case 'write_data':
					if (!$overwrite_userset)
					{
						$this->set_vars_config();
						$this->set_template_vars('config');
						trigger_error($this->language->lang('COLLAPSEQUOTE_DEFAULT_SETTING_SAVED') . adm_back_link($this->u_action));
					}
					else
					{
						if (!confirm_box(true))
						{
							// Request confirmation from the user to delete the auto group rule
							confirm_box(false, 'COLLAPSEQUOTE_USER_SET',
										build_hidden_fields([
											'action'								=> $action,
											'imcger_collapsequote_aktive'			=> $this->request->variable('imcger_collapsequote_aktive', 0),
											'imcger_collapsequote_visible_lines'	=> $this->request->variable('imcger_collapsequote_visible_lines', 0),
											'imcger_collapsequote_text_top'			=> $this->request->variable('imcger_collapsequote_text_top', 0),
											'imcger_collapsequote_button_bg'		=> $this->request->variable('imcger_collapsequote_button_bg', 0),
											'imcger_collapsequote_button_fg'		=> $this->request->variable('imcger_collapsequote_button_fg', 0),
											'imcger_collapsequote_button_bg_hover'	=> $this->request->variable('imcger_collapsequote_button_bg_hover', 0),
											'imcger_collapsequote_button_fg_hover'	=> $this->request->variable('imcger_collapsequote_button_fg_hover', 0),
										]),
										'@imcger_collapsequote/acp_collapsequote_body_confirm_box.html');

							$this->set_template_vars('request', false);
						}
						else
						{
							$this->set_vars_config();
							$this->set_vars_userset();
							$this->set_template_vars('config');
							trigger_error($this->language->lang('COLLAPSEQUOTE_USER_SETTING_SAVED') . adm_back_link($this->u_action));
						}
					}
				break;

				case 'cancel':
					$this->set_template_vars('request');
				break;

				default:
					$this->set_template_vars('config');
				break;
			}
		}
		else
		{
			$this->set_template_vars('config');
		}
	}

	/**
	 * Set template variables
	 *
	 * @param string	$get_data			Data to set in template
	 * @param bool		$overwrite_userset	Display message box
	 * @return null
	 * @access protected
	 */
	protected function set_template_vars($get_data = 'config', $overwrite_userset = false)
	{
		$metadata_manager = $this->ext_manager->create_extension_metadata_manager('imcger/collapsequote');

		$this->template->assign_vars([
			'U_ACTION'						=> $this->u_action,
			'IMCGER_COLLAPSEQUOTE_TITLE'	=> $metadata_manager->get_metadata('display-name'),
			'IMCGER_COLLAPSEQUOTE_EXT_VER'	=> $metadata_manager->get_metadata('version'),
			'S_IMCGER_OVERWRITE_USERSET'	=> $overwrite_userset,
		]);

		if ($get_data == 'config')
		{
			$this->template->assign_vars([
				'IMCGER_COLLAPSEQUOTE_AKTIVE'			=> $this->config['imcger_collapsequote_aktive'],
				'IMCGER_COLLAPSEQUOTE_VISIBLE_LINES'	=> $this->config['imcger_collapsequote_visible_lines'],
				'IMCGER_COLLAPSEQUOTE_TEXT_TOP'			=> $this->config['imcger_collapsequote_text_top'],
				'IMCGER_COLLAPSEQUOTE_BUTTON_BG'		=> $this->config['imcger_collapsequote_button_bg'],
				'IMCGER_COLLAPSEQUOTE_BUTTON_FG'		=> $this->config['imcger_collapsequote_button_fg'],
				'IMCGER_COLLAPSEQUOTE_BUTTON_BG_HOVER'	=> $this->config['imcger_collapsequote_button_bg_hover'],
				'IMCGER_COLLAPSEQUOTE_BUTTON_FG_HOVER'	=> $this->config['imcger_collapsequote_button_fg_hover'],
				'S_IMCGER_RESET_BUTTON'					=> true,
			]);
		}

		if ($get_data == 'request')
		{
			$this->template->assign_vars([
				'IMCGER_COLLAPSEQUOTE_AKTIVE'			=> $this->request->variable('imcger_collapsequote_aktive', 0),
				'IMCGER_COLLAPSEQUOTE_VISIBLE_LINES'	=> $this->request->variable('imcger_collapsequote_visible_lines', 0),
				'IMCGER_COLLAPSEQUOTE_TEXT_TOP'			=> $this->request->variable('imcger_collapsequote_text_top', 0),
				'IMCGER_COLLAPSEQUOTE_BUTTON_BG'		=> $this->request->variable('imcger_collapsequote_button_bg', 0),
				'IMCGER_COLLAPSEQUOTE_BUTTON_FG'		=> $this->request->variable('imcger_collapsequote_button_fg', 0),
				'IMCGER_COLLAPSEQUOTE_BUTTON_BG_HOVER'	=> $this->request->variable('imcger_collapsequote_button_bg_hover', 0),
				'IMCGER_COLLAPSEQUOTE_BUTTON_FG_HOVER'	=> $this->request->variable('imcger_collapsequote_button_fg_hover', 0),
				'S_IMCGER_RESET_BUTTON'					=> false,
			]);
		}
	}

	/**
	 * Store the variable to config
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_vars_config()
	{
		/* Show minium 2 lines in the Quotebox */
		$visible_lines = $this->request->variable('imcger_collapsequote_visible_lines', 4) < 2 ? 2 : $this->request->variable('imcger_collapsequote_visible_lines', 4);

		$this->config->set('imcger_collapsequote_aktive', $this->request->variable('imcger_collapsequote_aktive', ''));
		$this->config->set('imcger_collapsequote_visible_lines', $visible_lines);
		$this->config->set('imcger_collapsequote_text_top', $this->request->variable('imcger_collapsequote_text_top', ''));
		$this->config->set('imcger_collapsequote_button_bg', $this->request->variable('imcger_collapsequote_button_bg', ''));
		$this->config->set('imcger_collapsequote_button_fg', $this->request->variable('imcger_collapsequote_button_fg', ''));
		$this->config->set('imcger_collapsequote_button_bg_hover', $this->request->variable('imcger_collapsequote_button_bg_hover', ''));
		$this->config->set('imcger_collapsequote_button_fg_hover', $this->request->variable('imcger_collapsequote_button_fg_hover', ''));
	}

	/**
	 * Overwrite settings for all user
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_vars_userset()
	{
		$this->config->set('imcger_extlink_user_setting_time', time());

		$sql_ary = [
			'user_collapsequote_aktive'		=> $this->config['imcger_collapsequote_aktive'],
			'user_collapsequote_lines'		=> $this->config['imcger_collapsequote_visible_lines'],
			'user_collapsequote_text_top'	=> $this->config['imcger_collapsequote_text_top'],
		];

		// Upate user settings whith default data
		$sql =	'UPDATE ' . USERS_TABLE .
				' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary);

		$this->db->sql_query($sql);
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
