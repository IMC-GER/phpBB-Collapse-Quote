<?php
/**
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\collapsequote\controller;

class cquote_admin_controller
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
		add_form_key('imcger/collapsequote');

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('imcger/collapsequote'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$overwrite_userset = $this->request->variable('imcger_collapsequote_overwrite_userset', 0);

			$this->set_vars_config();
			$this->set_vars_userset($overwrite_userset);

			$trigger_text = $overwrite_userset ? $this->language->lang('COLLAPSEQUOTE_USER_SETTING_SAVED') : $this->language->lang('COLLAPSEQUOTE_DEFAULT_SETTING_SAVED');
			trigger_error($trigger_text . adm_back_link($this->u_action));
		}

		$this->set_template_vars();
	}

	/**
	 * Set template variables
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_template_vars()
	{
		// Read guest account settings as default
		$sql = 'SELECT user_collapsequote_aktive, user_collapsequote_text_top, user_collapsequote_lines
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . ANONYMOUS;

		$result	= $this->db->sql_query_limit($sql, 1);
		$user_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		$metadata_manager = $this->ext_manager->create_extension_metadata_manager('imcger/collapsequote');

		$this->template->assign_vars([
			'U_ACTION'				=> $this->u_action,
			'COLLAPSEQUOTE_TITLE'	=> $metadata_manager->get_metadata('display-name'),
			'COLLAPSEQUOTE_EXT_VER'	=> $metadata_manager->get_metadata('version'),

			'UCP_COLLAPSEQUOTE_AKTIVE'			=> $user_data['user_collapsequote_aktive'],
			'UCP_COLLAPSEQUOTE_LINES'			=> $user_data['user_collapsequote_lines'],
			'UCP_COLLAPSEQUOTE_TEXT_TOP'		=> $user_data['user_collapsequote_text_top'],
			'UCP_COLLAPSEQUOTE_TEXT_TOP_OPTION' => [
				'COLLAPSEQUOTE_TOP'		=> 1,
				'COLLAPSEQUOTE_BOTTOM'	=> 0,
			],
			'S_COLLAPSEQUOTE_OVERWRITE_USERSET'	=> false,

			'COLLAPSEQUOTE_BUTTON_BG'			=> $this->config['imcger_collapsequote_button_bg'],
			'COLLAPSEQUOTE_BUTTON_FG'			=> $this->config['imcger_collapsequote_button_fg'],
			'COLLAPSEQUOTE_BUTTON_BG_HOVER'		=> $this->config['imcger_collapsequote_button_bg_hover'],
			'COLLAPSEQUOTE_BUTTON_FG_HOVER'		=> $this->config['imcger_collapsequote_button_fg_hover'],
		]);
	}

	/**
	 * Store the variable to config
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_vars_config()
	{
		$this->config->set('imcger_collapsequote_button_bg', $this->request->variable('imcger_collapsequote_button_bg', ''));
		$this->config->set('imcger_collapsequote_button_fg', $this->request->variable('imcger_collapsequote_button_fg', ''));
		$this->config->set('imcger_collapsequote_button_bg_hover', $this->request->variable('imcger_collapsequote_button_bg_hover', ''));
		$this->config->set('imcger_collapsequote_button_fg_hover', $this->request->variable('imcger_collapsequote_button_fg_hover', ''));
	}

	/**
	 * Overwrite settings for all user
	 *
	 * @param  bool		$all_user	Store data to all user
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_vars_userset($all_user)
	{
		$sql_ary = [
			'user_collapsequote_aktive'		=> $this->request->variable('user_collapsequote_aktive', 1),
			'user_collapsequote_lines'		=> $this->request->variable('user_collapsequote_lines', 4),
			'user_collapsequote_text_top'	=> $this->request->variable('user_collapsequote_text_top', 1),
		];

		$sql_where = $all_user ? '' : ' WHERE user_id = ' . ANONYMOUS;

		// Upate user settings whith default data
		$sql = 'UPDATE ' . USERS_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . $sql_where;

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
