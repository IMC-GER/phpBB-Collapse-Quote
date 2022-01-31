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

namespace imcger\collapsequote\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Collapse Quote listener
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;
	
	/** @var \phpbb\language\language */
	protected $language;


	public function __construct
	(
		\phpbb\config\config $config, 
		\phpbb\template\template $template,
		\phpbb\language\language $language
	)
	{
		$this->config   = $config;
		$this->template = $template;
		$this->language = $language;
	}
	
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewtopic_assign_template_vars_before' => 'viewtopic_assign_template_vars',
			'core.text_formatter_s9e_configure_after' 	 => 'configure_textformatter',
		);
	}

	public function viewtopic_assign_template_vars()
	{  
		// Add Fancybox language file
		$this->language->add_lang('collapsequote_lang','imcger/collapsequote');

		$imcger_collapsequote_visible_lines	= $this->config['imcger_collapsequote_visible_lines'];
		$imcger_collapsequote_button_fg		= $this->config['imcger_collapsequote_button_fg'];
		$imcger_collapsequote_button_bg		= $this->config['imcger_collapsequote_button_bg'];

		$this->template->assign_vars( array(
			'IMCGER_COLLAPSEQUOTE_VISIBLE_LINES' => $imcger_collapsequote_visible_lines,
			'IMCGER_COLLAPSEQUOTE_BUTTON_FG'	 => $imcger_collapsequote_button_fg,
			'IMCGER_COLLAPSEQUOTE_BUTTON_BG'	 => $imcger_collapsequote_button_bg,
		));
	}

	/**
	 * Extends the s9e TextFormatter template for the URL and IMG tag to include more
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
						'<div class="imcger-quote-button" onclick="toggleQuote(this)"></div>' .
					'</div>';

		$configurator->tags['QUOTE']->template = str_replace('<xsl:apply-templates/>', $newquote, $default_quote_template);
	} 
}
