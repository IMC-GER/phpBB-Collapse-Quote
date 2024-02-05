/**
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

var imcgerCollapseQuote = {};

(function () {	// IIFE start

'use strict';

class LukeWCSphpBBConfirmBox {
/*
* phpBB ConfirmBox class for checkboxes - v1.1.0
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector) {
		this.$submitObject = $(submitSelector);
		var _this = this;

		$('div[id$="_confirmbox"]').each(function () {
			var elementName = $(this)[0].id.replace('_confirmbox', '')

			$('input[name="' + elementName + '"]')				.on('change'	, _this.Show);
			$('input[name^="' + elementName + '_confirm_"]')	.on('click'		, _this.Button);
		});
		this.$submitObject.parents('form')						.on('reset'		, this.HideAll);
	}

	Show = (e) => {
		var elementDefault = $('div[id="' + e.target.name + '_confirmbox"]').attr('data-default') == 1;
		var $elementObject = $('input[name="' + e.target.name + '"]');

		if ($elementObject.prop('checked') != elementDefault) {
			$elementObject									.prop('disabled', true)
			$elementObject									.addClass('confirmbox_active');
			$('div[id="' + e.target.name + '_confirmbox"]')	.toggle('scale');
			this.$submitObject								.prop('disabled', true);
		}
	}

	Button = (e) => {
		var elementName = e.target.name.replace(/_confirm_.*/, '');
		var elementDefault = $('div[id="' + elementName + '_confirmbox"]').attr('data-default') == 1;
		var $elementObject = $('input[name="' + elementName + '"]');

		if (e.target.name.endsWith('_confirm_no')) {
			$elementObject.prop('checked', elementDefault);
		}

		$elementObject									.prop('disabled', false);
		$elementObject									.removeClass('confirmbox_active');
		$('div[id="' + elementName + '_confirmbox"]')	.toggle('scale');
		this.$submitObject								.prop('disabled', $('input[class*="confirmbox_active"]').length);
	}

	HideAll = () => {
		var $elementObject = $('input[class*="confirmbox_active"]');

		$elementObject				.prop('disabled', false);
		$elementObject				.removeClass('confirmbox_active');
		$('div[id$="_confirmbox"]').each(function() {
			if ($(this).is(":visible")) {
				$(this).toggle("scale")
			}
		});
		this.$submitObject			.prop('disabled', false);
	}
}

// Register events

$(window).ready(function() {
	imcgerCollapseQuote.ConfirmBox = new LukeWCSphpBBConfirmBox('input[name="submit"]');
});

})();	// IIFE end
