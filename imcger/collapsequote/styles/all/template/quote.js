/**
 * Collapse Quote
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

class imcgerQuoteBox {
	static property = {};
	static styleData = {};

	static {
		// Do nothing when no quote available
		if (document.querySelector('blockquote')) {
			// Properties of the quotebox button
			this.property = imcger.collapseQuote;

			// Query properties of the phpBB style.
			this.styleData = this.getStyleData();

			// Define colors for toggle button
			this.property.buttonBG = this.property.buttonBG ? this.property.buttonBG : this.styleData.bgColor;
			this.property.buttonFG = this.property.buttonFG ? this.property.buttonFG : 'inherit';

			// Set style for toggle button
			this.addCSS();
		}
	}

	static getStyleData() {
		let para			= document.querySelector('blockquote'),
			compStyles		= window.getComputedStyle(para),
			lineHeight		= Math.ceil(parseFloat(compStyles.getPropertyValue('line-height'))),
			paddingTop		= parseInt(compStyles.getPropertyValue('padding-top')),
			paddingBottom	= parseInt(compStyles.getPropertyValue('padding-bottom')),
			bgColor	   		= compStyles.getPropertyValue('background-color'),
			maxQuoteHeigth	= (this.property.visibleLines * lineHeight),
			shadowLines		= this.property.visibleLines > 4 ? 4 : this.property.visibleLines,
			shadowHeigth	= shadowLines * lineHeight,
			shadowHeigthTop	= (shadowLines + 1) * lineHeight;

		return {'bgColor': bgColor, 'lineHeight': lineHeight, 'shadowHeigthTop': shadowHeigthTop, 'shadowHeigth': shadowHeigth, 'maxQuoteHeigth': maxQuoteHeigth, 'paddingBottom': paddingBottom, 'paddingTop': paddingTop};
	}

	static ColorToRGBA(color, opacity) {
		let rgbColors = new Array();

		// Format rgb(255, 255, 255)
		if (color[0] == 'r') {
			color = color.substring(color.indexOf('(') + 1, color.indexOf(')'));

			rgbColors = color.split(',', 3);

			rgbColors[0] = parseInt(rgbColors[0]);
			rgbColors[1] = parseInt(rgbColors[1]);
			rgbColors[2] = parseInt(rgbColors[2]);
		}
		// Format #ffffff
		else if (color.substring(0,1) == '#' && color.length == 7) {
			rgbColors[0] = parseInt(color.substring(1, 3), 16);
			rgbColors[1] = parseInt(color.substring(3, 5), 16);
			rgbColors[2] = parseInt(color.substring(5, 7), 16);
		}
		// Format #fff
		else if (color.substring(0,1) == '#') {
			rgbColors[0] = parseInt(color.substring(1, 2).concat(color.substring(1, 2)), 16);
			rgbColors[1] = parseInt(color.substring(2, 3).concat(color.substring(2, 3)), 16);
			rgbColors[2] = parseInt(color.substring(3, 4).concat(color.substring(3, 4)), 16);
		}
		// Undefined color format
		else {
			return(false);
		}

		return 'rgba(' + rgbColors[0] + ', ' + rgbColors[1] + ', ' + rgbColors[2] + ', ' + opacity + ')';
	}

	static addCSS() {
		// Set colors to the toggle button
		let buttonStyle = '.imcger-quote-togglebutton { color:' + this.property.buttonFG + '; background-color:' + this.property.buttonBG + '; }';

		// Add colors for the hover effect to the toggle button.
		if (this.property.buttonHoverFG || this.property.buttonHoverBG) {

			buttonStyle += '.imcger-quote-togglebutton:hover {';

			if (this.property.buttonHoverFG) {
				buttonStyle += 'color:' + this.property.buttonHoverFG + ';';
			}

			if (this.property.buttonHoverBG) {
				buttonStyle += 'background-color:' + this.property.buttonHoverBG + ';';
			}

			buttonStyle += '}';
		}

		// Create style document
		let css = document.createElement('style');
		css.type = 'text/css';

		if (css.styleSheet) {
			css.styleSheet.cssText = buttonStyle;
		}
		else {
			css.appendChild(document.createTextNode(buttonStyle));
		}

		// Append style to the head
		document.head.appendChild(css);
	}

	// Initialize the form
	constructor(quoteElement) {
		let quoteTextBox	= quoteElement.getElementsByClassName('imcger-quote-text')[0];

		// If Quotebox is too big reduce the size of the box and show shadow and button.
		if (parseInt(quoteTextBox.offsetHeight) > imcgerQuoteBox.styleData.maxQuoteHeigth) {
			let quoteText	= quoteTextBox.firstChild,
				quoteShadow = quoteTextBox.lastChild,
				quoteButton = quoteTextBox.nextSibling;

			if (imcgerQuoteBox.property.textTop) {
				// Add properties to the shadow on the bottom of quotebox
				quoteShadow.style.backgroundImage = 'linear-gradient(' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 0) + ',' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 0.8) + ' 70%,' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 1) + ')';
				quoteShadow.style.height  = imcgerQuoteBox.styleData.shadowHeigth + 'px';
				quoteShadow.style.bottom  = imcgerQuoteBox.styleData.lineHeight + 'px';
				quoteShadow.style.display = 'block';
			} else {
				// Add properties to the shadow on the top of quotebox
				let citeElem = quoteElement.querySelector('blockquote cite');

				if (citeElem) {
					citeElem.style.backgroundColor = imcgerQuoteBox.styleData.bgColor;
				}
				quoteShadow.style.backgroundImage = 'linear-gradient(' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 1) + ' 20%,' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 0.8) + ' 50%,' + imcgerQuoteBox.ColorToRGBA(imcgerQuoteBox.styleData.bgColor, 0) + ')';
				quoteShadow.style.height  = imcgerQuoteBox.styleData.shadowHeigthTop + 'px';
				quoteShadow.style.top	  = '-' + (imcgerQuoteBox.styleData.lineHeight + imcgerQuoteBox.styleData.paddingTop) + 'px';
				quoteShadow.style.display = 'block';

				// End of the quotetext display in the viewport
				quoteText.style.position = 'absolute';
				quoteText.style.bottom	 = imcgerQuoteBox.styleData.lineHeight + (2 * imcgerQuoteBox.styleData.paddingBottom) + 'px';
			}

			// Add properties to the toggelbutton of quotebox
			quoteButton.style.margin  = '0 -' + imcgerQuoteBox.styleData.paddingBottom + 'px -' + imcgerQuoteBox.styleData.paddingBottom + 'px -' + imcgerQuoteBox.styleData.paddingBottom + 'px';
			quoteButton.style.padding = imcgerQuoteBox.styleData.paddingBottom + 'px';
			quoteButton.innerHTML	  = imcgerQuoteBox.property.buttonDown;
			quoteButton.style.display = 'block';
			quoteButton.classList.add('imcger-quote-visible');

			// Collapse quote box.
			quoteTextBox.style.height = imcgerQuoteBox.styleData.maxQuoteHeigth + 'px';
		}

		window.addEventListener('resize', function (e) {
			// List of <blockquote> elements that are expanded
			let quoteShadow = quoteElement.getElementsByClassName('imcger-quote-shadow')[0];

			if (quoteShadow.style.display == 'none') {
				// Read offset height of the quote and adjust the display range
				quoteShadow.parentElement.style.height = parseInt(quoteShadow.previousSibling.offsetHeight) + 'px';

			}
		});

		// Toggle quotebox
		if (typeof quoteElement.getElementsByClassName('imcger-quote-visible')[0] != 'undefined') {
			quoteElement.getElementsByClassName('imcger-quote-visible')[0].addEventListener('click', function (e) {
				let quoteButton	 = e.target,
					quoteBox	 = quoteButton.previousSibling,
					quoteBoxRect = quoteBox.getBoundingClientRect(),
					quoteTextBox = quoteBox.firstChild,
					quoteShadow	 = quoteBox.lastChild;

				// Collapse the quotebox
				if (quoteShadow.style.display == 'none') {
					quoteBox.style.height	  = imcgerQuoteBox.styleData.maxQuoteHeigth + 'px';
					quoteShadow.style.display = 'block';
					quoteButton.innerHTML	  = imcgerQuoteBox.property.buttonDown;

					// If the upper part of the quote box is outside the viewport scroll it to position 0
					if (quoteBoxRect.top < 0) {
						document.getElementsByTagName('html')[0].style.scrollBehavior = 'smooth';
						window.scrollBy(0, quoteBoxRect.top - (imcgerQuoteBox.styleData.lineHeight + (2 * imcgerQuoteBox.styleData.paddingTop)));
					}
				}
				// Expand the quotebox
				else {
					quoteBox.style.height = quoteTextBox.offsetHeight + 'px'; // This way is importent for the animation (CSS transition)
					setTimeout(function() { quoteShadow.style.display = 'none'; }, 500);
					quoteButton.innerHTML = imcgerQuoteBox.property.buttonUp;
				}
			});
		}
	}
}

/* List of <blockquote> elements whose immediate parent is a <div> with class "content".
   Here by the nested blockquote elements are not listed. */
imcger.collapseQuote.bqElements = document.querySelectorAll('div.content > blockquote');
imcger.collapseQuote.box = [];

let i = 0;
for (let bqElement of imcger.collapseQuote.bqElements) {
	imcger.collapseQuote.box[i] = new imcgerQuoteBox(bqElement);
	i++;
}
