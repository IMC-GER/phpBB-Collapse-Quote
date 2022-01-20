<?php
/**
 *
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2021, Thorsten Ahlers
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
	static public function getSubscribedEvents()
	{
		return array(
			'core.text_formatter_s9e_configure_after' => 'configure_textformatter',
		);
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
