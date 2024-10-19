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
class acp_listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var bool form is submit */
	protected $submit;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\language\language	$language	language object
	 * @param \phpbb\request\request	$request	Request objectt
	 *
	 * @return null
	 */
	public function __construct
	(
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\request\request $request
	)
	{
		$this->template = $template;
		$this->language = $language;
		$this->request	= $request;
		$this->submit	= false;
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
			'core.acp_users_prefs_modify_data'			=> 'acp_users_prefs_modify_data',
			'core.acp_users_prefs_modify_sql'			=> 'acp_users_prefs_modify_sql',
			'core.acp_users_prefs_modify_template_data' => 'acp_users_prefs_modify_template_data',
		];
	}

	/**
	 * Add collapsequote language file
	 * Modify users preferences data
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function acp_users_prefs_modify_data($event)
	{
		// Add language file in ACP
		$this->language->add_lang('common', 'imcger/collapsequote');

		$event['user_row'] = array_merge($event['user_row'], [
			'user_collapsequote_aktive'		=> $this->request->variable('user_collapsequote_aktive', $event['user_row']['user_collapsequote_aktive']),
			'user_collapsequote_text_top'	=> $this->request->variable('user_collapsequote_text_top', $event['user_row']['user_collapsequote_text_top']),
			'user_collapsequote_lines'		=> $this->request->variable('user_collapsequote_lines', $event['user_row']['user_collapsequote_lines']),
		]);
	}

	/**
	 * Modify SQL query before users preferences are updated
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function acp_users_prefs_modify_sql($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], [
			'user_collapsequote_aktive'		=> $event['user_row']['user_collapsequote_aktive'],
			'user_collapsequote_text_top'	=> $event['user_row']['user_collapsequote_text_top'],
			'user_collapsequote_lines'		=> $event['user_row']['user_collapsequote_lines'],
		]);
	}

	/**
	 * Modify users preferences data before assigning it to the template
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function acp_users_prefs_modify_template_data($event)
	{
		$event['user_prefs_data'] = array_merge($event['user_prefs_data'], [
			'ACP_COLLAPSEQUOTE_AKTIVE'		=> $event['user_row']['user_collapsequote_aktive'],
			'ACP_COLLAPSEQUOTE_TEXT_TOP'	=> $event['user_row']['user_collapsequote_text_top'],
			'ACP_COLLAPSEQUOTE_LINES'		=> $event['user_row']['user_collapsequote_lines'],
		]);
	}
}
