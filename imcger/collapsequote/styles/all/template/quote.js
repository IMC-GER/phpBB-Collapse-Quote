/**
 *
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

function ColorToRGBA(color, opacity) {
	let rgbColors = new Array();

	/* Format rgb(255, 255, 255) */
	if (color[0] == 'r') {
		color = color.substring(color.indexOf('(') + 1, color.indexOf(')'));

		rgbColors = color.split(',', 3);

		rgbColors[0] = parseInt(rgbColors[0]);
		rgbColors[1] = parseInt(rgbColors[1]);
		rgbColors[2] = parseInt(rgbColors[2]);
	}
	/* Format #ffffff */
	else if (color.substring(0,1) == '#' && color.length == 7) {
		rgbColors[0] = parseInt(color.substring(1, 3), 16);
		rgbColors[1] = parseInt(color.substring(3, 5), 16);
		rgbColors[2] = parseInt(color.substring(5, 7), 16);
	}
	/* Format #fff */
	else if (color.substring(0,1) == '#') {
		rgbColors[0] = parseInt(color.substring(1, 2).concat(color.substring(1, 2)), 16);
		rgbColors[1] = parseInt(color.substring(2, 3).concat(color.substring(2, 3)), 16);
		rgbColors[2] = parseInt(color.substring(3, 4).concat(color.substring(3, 4)), 16);
	}
	/* Undefined color format */
	else {
		return(false);
	}

	return 'rgba(' + rgbColors[0] + ', ' + rgbColors[1] + ', ' + rgbColors[2] + ', ' + opacity + ')';
}

function getStyleData() {
	let para	   = document.querySelector('blockquote');
	let compStyles = window.getComputedStyle(para);
	let lineHeight = parseInt(compStyles.getPropertyValue('line-height'));
	let paddingTop = parseInt(compStyles.getPropertyValue('padding-top'));
	let paddingBot = parseInt(compStyles.getPropertyValue('padding-bottom'));
	let bgColor	   = compStyles.getPropertyValue('background-color');
	let maxQuoteHeigth = (imcgerVisibleLines * lineHeight) + paddingTop + paddingBot;
	let shadowLines	   = imcgerVisibleLines > 4 ? 4 : imcgerVisibleLines;
	let shadowHeigth   =  shadowLines * lineHeight;

	return {'bgColor': bgColor, 'lineHeight': lineHeight, 'shadowHeigth': shadowHeigth, 'maxQuoteHeigth': maxQuoteHeigth, 'padBottom': paddingBot};
}

function toggleQuote(quoteButton) {
	let styleData	 = getStyleData();
	let quoteBox	 = quoteButton.previousSibling;
	let quoteBoxRect = quoteBox.getBoundingClientRect();
	let quoteText	 = quoteBox.firstChild;
	let quoteShadow	 = quoteBox.lastChild;

	/* Collapse the quotebox */
	if (quoteShadow.style.display == 'none') {
		quoteBox.style.height	  = styleData.maxQuoteHeigth + 'px';
		quoteShadow.style.display = 'block';
		quoteButton.innerHTML	  = imcgerButtonDown;

		/* If the upper part of the quote box is outside the viewport scroll it to position 0 */
		if (quoteBoxRect.top < 0) {
			document.getElementsByTagName('html')[0].style.scrollBehavior = 'smooth';
			window.scrollBy(0, quoteBoxRect.top);
		}
	}
	/* Expand the quotebox */
	else {
		quoteBox.style.height	  = quoteText.offsetHeight + 'px'; // This way is importent for the animation (CSS transition)
		quoteShadow.style.display = 'none';
		quoteButton.innerHTML	  = imcgerButtonUp;
	}
}

function resizeQuote() {
	/* List of <blockquote> elements that are expanded */
	let x = document.getElementsByClassName('imcger-quote-shadow');

	for (i = 0; i < x.length; i++) {
		if (x[i].style.display == 'none') {
			/* Read offset height of the quote and adjust the display range */
			x[i].parentElement.style.height = parseInt(x[i].previousSibling.offsetHeight) + 'px';
		}
	}
}

function initQuoteBox() {
	/* List of <blockquote> elements whose immediate parent is a <div> with class "content".
	   Here by the nested blockquote elements are not listed. */
	let x = document.querySelectorAll('div.content > blockquote');

	/* If no element found Cancel initialization. */
	if (x.length < 1) {
		return 0;
	}

	/* Query properties of the phpBB style. */
	let styleData = getStyleData();

	/* Check the size of the found quote boxes and reduce them if necessary. */
	for (i = 0; i < x.length; i++) {
		let quoteText	= x[i].getElementsByClassName('imcger-quote-text')[0];

		/* If Quotebox is too big reduce the size of the box and show shadow and button. */
		if (parseInt(quoteText.offsetHeight) > styleData.maxQuoteHeigth) {
			let quoteShadow = quoteText.lastChild;
			let quoteButton = quoteText.nextSibling;

			/* Add properties to the shadow element. */
			quoteShadow.style.backgroundImage = 'linear-gradient(' + ColorToRGBA(styleData.bgColor, 0) + ',' + ColorToRGBA(styleData.bgColor, 0.8) + ' 70%,' + ColorToRGBA(styleData.bgColor, 1) + ')';
			quoteShadow.style.height  = styleData.shadowHeigth + 'px';
			quoteShadow.style.bottom  = styleData.lineHeight + 'px';
			quoteShadow.style.display = 'block';

			/* Add properties to toggle button. */
			quoteButton.style.backgroundColor = imcgerButtonBG.length > 3 ? imcgerButtonBG : styleData.bgColor;
			quoteButton.style.color			  = imcgerButtonFG.length > 3 ? imcgerButtonFG : 'inherit';

			quoteButton.style.margin  = '0 -' + styleData.padBottom + 'px -' + styleData.padBottom + 'px -' + styleData.padBottom + 'px';
			quoteButton.style.padding = styleData.padBottom + 'px';
			quoteButton.innerHTML	  = imcgerButtonDown;
			quoteButton.style.display = 'block';

			/* Collapse quote box. */
			quoteText.style.height = styleData.maxQuoteHeigth + 'px';
		}
	}
}

/* Call initialization routine. */
initQuoteBox();

/* Resize the quote box when the browser window changes its size. */
window.addEventListener('resize', resizeQuote);
