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
class cquote_main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config			$config
	 * @param \phpbb\template\template		$template	Template object
	 * @param \phpbb\language\language		$language	language object
	 * @param \phpbb\user					$user		User object
	 *
	 * @return null
	 */
	public function __construct
	(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\user $user
	)
	{
		$this->config   = $config;
		$this->template = $template;
		$this->language = $language;
		$this->user 	= $user;
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
			'core.viewtopic_assign_template_vars_before' => 'viewtopic_assign_template_vars', // topics
			'core.ucp_pm_view_message'					 => 'viewtopic_assign_template_vars', // private message
			'core.modify_format_display_text_before'	 => 'viewtopic_assign_template_vars', // post and pm preview
			'core.text_formatter_s9e_configure_after' 	 => ['configure_textformatter', 1],
		];
	}

	/**
	 * Add collapsequote language file
	 * Set template variables
	 *
	 * @param	null
	 * @return	null
	 * @access	public
	 */
	public function viewtopic_assign_template_vars()
	{
		// Add language file
		$this->language->add_lang('collapsequote_lang','imcger/collapsequote');

		$this->template->assign_vars([
			'COLLAPSEQUOTE_ACTIVE'			=> $this->user->data['user_collapsequote_aktive'],
			'COLLAPSEQUOTE_VISIBLE_LINES'	=> $this->user->data['user_collapsequote_lines'],
			'COLLAPSEQUOTE_TEXT_TOP'		=> $this->user->data['user_collapsequote_text_top'],
			'COLLAPSEQUOTE_BUTTON_FG'		=> $this->config['imcger_collapsequote_button_fg'],
			'COLLAPSEQUOTE_BUTTON_BG'		=> $this->config['imcger_collapsequote_button_bg'],
			'COLLAPSEQUOTE_BUTTON_FG_HOVER' => $this->config['imcger_collapsequote_button_fg_hover'],
			'COLLAPSEQUOTE_BUTTON_BG_HOVER' => $this->config['imcger_collapsequote_button_bg_hover'],
		]);
	}

	/**
	 * Extends the s9e TextFormatter template for the QUOTE template.
	 * templates.
	 *
	 * @param	object		$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function configure_textformatter($event)
	{
		/** @var \s9e\TextFormatter\Configurator $configurator */
		$configurator = $event['configurator'];

		$default_quote_template = $configurator->tags['QUOTE']->template;
		$newquote = '<div class="imcger-quote">' .
						'<div class="imcger-quote-text">' .
							'<div>' .
								'<xsl:apply-templates/>' .
							'</div>' .
							'<div class="imcger-quote-shadow"></div>' .
						'</div>' .
						'<div class="imcger-quote-togglebutton"></div>' .
					'</div>';

		$configurator->tags['QUOTE']->template = str_replace('<xsl:apply-templates/>', $newquote, $default_quote_template);
	}
}
