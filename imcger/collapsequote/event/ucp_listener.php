<?php
/**
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\collapsequote\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Collapse Quote listener
 */
class ucp_listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\template\template			$template		Template object
	 * @param \phpbb\user						$user			User object
	 * @param \phpbb\language\language			$language		language object
	 * @param \phpbb\request\request			$request		Request objectt
	 * @param \phpbb\db\driver\driver_interface $db
	 *
	 * @return null
	 */
	public function __construct
	(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\user $user,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\db\driver\driver_interface $db
	)
	{
		$this->config	= $config;
		$this->template = $template;
		$this->user 	= $user;
		$this->language = $language;
		$this->request	= $request;
		$this->db		= $db;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.ucp_display_module_before'	=> 'ucp_display_module_before',
			'core.ucp_prefs_view_data'			=> 'ucp_prefs_get_data',
			'core.ucp_prefs_view_update_data'	=> 'ucp_prefs_set_data',
			'core.ucp_register_register_after'	=> 'ucp_register_set_data',
		];
	}

	/**
	 * Add collapsequote language file
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function ucp_display_module_before()
	{
		// Add language file in UCP
		$this->language->add_lang('info_acp_collapsequote', 'imcger/collapsequote');
	}

	/**
	 * Add UCP edit display options data before they are assigned to the template or submitted
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function ucp_prefs_get_data($event)
	{
		$event['data'] = array_merge($event['data'], [
			'user_collapsequote_aktive'		=> $this->request->variable('user_collapsequote_aktive', $this->user->data['user_collapsequote_aktive']),
			'user_collapsequote_text_top'	=> $this->request->variable('user_collapsequote_text_top', $this->user->data['user_collapsequote_text_top']),
			'user_collapsequote_lines'		=> $this->request->variable('user_collapsequote_lines', $this->user->data['user_collapsequote_lines']),
		]);

		if (!$event['submit'])
		{
			$this->template->assign_vars([
				'TOGGLECTRL_CQ'				 => 'radio',
				'UCP_COLLAPSEQUOTE_AKTIVE'	 => $event['data']['user_collapsequote_aktive'],
				'UCP_COLLAPSEQUOTE_TEXT_TOP' => $event['data']['user_collapsequote_text_top'],
				'UCP_COLLAPSEQUOTE_LINES'	 => $event['data']['user_collapsequote_lines'],
			]);
		}
	}

	/**
	 * Update UCP edit display options data on form submit
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function ucp_prefs_set_data($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], [
			'user_collapsequote_aktive'		=> $event['data']['user_collapsequote_aktive'],
			'user_collapsequote_text_top'	=> $event['data']['user_collapsequote_text_top'],
			'user_collapsequote_lines'		=> $event['data']['user_collapsequote_lines'],
		]);
	}

	/**
	 * After new user registration, set user parameters to default;
	 *
	 * @param	$event
	 * @return	null
	 * @access	public
	 */
	public function ucp_register_set_data($event)
	{
		// Read guest account settings as default
		$sql = 'SELECT user_collapsequote_aktive, user_collapsequote_text_top, user_collapsequote_lines
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . ANONYMOUS;

		$result	= $this->db->sql_query_limit($sql, 1);
		$user_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		// Set user data whith default
		$sql = 'UPDATE ' . USERS_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $user_data) . '
				WHERE user_id = ' . (int) $event['user_id'];

		$this->db->sql_query($sql);
	}
}
