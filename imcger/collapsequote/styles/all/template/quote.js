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
	else if (color.substring(0,1) == "#" && color.length == 7) {
		rgbColors[0] = parseInt(color.substring(1, 3), 16);
		rgbColors[1] = parseInt(color.substring(3, 5), 16);
		rgbColors[2] = parseInt(color.substring(5, 7), 16);
	}
	/* Format #fff */
	else if (color.substring(0,1) == "#") {
		rgbColors[0] = parseInt(color.substring(1, 2).concat(color.substring(1, 2)), 16);
		rgbColors[1] = parseInt(color.substring(2, 3).concat(color.substring(2, 3)), 16);
		rgbColors[2] = parseInt(color.substring(3, 4).concat(color.substring(3, 4)), 16);
	}
	/* Undefiniertes Color Format */
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

	return({"bgColor": bgColor, "lineHeight": lineHeight, "shadowHeigth": shadowHeigth, "maxQuoteHeigth": maxQuoteHeigth, "padBottom": paddingBot});
}

function toggleQuote(quoteButton) {
	let styleData   = getStyleData();
	let quoteBox 	= quoteButton.previousSibling;
	let quoteText 	= quoteButton.previousSibling.firstChild;
	let quoteShadow = quoteButton.previousSibling.lastChild;

	if(quoteShadow.style.display == "none") {
		quoteBox.style.height 	  = styleData.maxQuoteHeigth + "px";
		quoteShadow.style.display = "block";
		quoteButton.innerHTML 	  = imcgerButtonDown;
	}
	else {
		quoteBox.style.height 	  = quoteText.offsetHeight + "px";
		quoteShadow.style.display = "none";
		quoteButton.innerHTML 	  = imcgerButtonUp;
	}
}

function resizeQuote() {
	/* Liste von <blockquote> Elementen die aufgeklappt sind */
	let x = document.getElementsByClassName("imcger-quote-shadow");

	for (i = 0; i < x.length; i++) {
		if(x[i].style.display == "none") {
			/* Offsetheight des Zitates auslesen und den Anzeigebereich anpassen */
			x[i].parentElement.style.height = parseInt(x[i].previousSibling.offsetHeight) + "px";
		}
	}
}

function initQuoteBox() {
	/* Liste von <blockquote> Elementen, deren unmittelbares übergeordnetes Element
	   ein <div> mit der Klasse "content" ist.
	   Hier durch wird ausgeschossen das verschachtelte blockquote Elemente angezeigt werden */
	let x = document.querySelectorAll("div.content > blockquote");

	/* Wenn kein Element gefunden Initialisierung abbrechen */
	if(x.length < 1) {
		return(0);
	}

	/* Eigenschaften des phpBB Styles abfragen */
	let styleData = getStyleData();

	/* Grösse der gefundenen Quoteboxen überprüfen und gegebenenfalls verkleinern */
	for (i = 0; i < x.length; i++) {
		let quoteText	= x[i].getElementsByClassName("imcger-quote-text")[0];

		/* Wenn Quotebox zu groß die Box verkleinern und Schatten und Button anzeigen */
		if(parseInt(quoteText.offsetHeight) > styleData.maxQuoteHeigth) {
			let quoteShadow = quoteText.lastChild;
			let quoteButton = quoteText.nextSibling;

			/* Eigenschaften dem Schattenelement hinzufügen */
			quoteShadow.style.backgroundImage = 'linear-gradient(' + ColorToRGBA(styleData.bgColor, 0) + ',' + ColorToRGBA(styleData.bgColor, 0.8) + ' 70%,' + ColorToRGBA(styleData.bgColor, 1) + ')';
			quoteShadow.style.height  = styleData.shadowHeigth + 'px';
			quoteShadow.style.bottom  = styleData.lineHeight + 'px';
			quoteShadow.style.display = "block";

			/* Eigenschaften dem Toggelbutton hinzufügen */
			quoteButton.style.backgroundColor = imcgerButtonBG.length > 3 ? imcgerButtonBG : styleData.bgColor;
			if(imcgerButtonFG.length > 3) {
				quoteButton.style.color = imcgerButtonFG;
			}
			quoteButton.style.margin  = '0 -' + styleData.padBottom + 'px -' + styleData.padBottom + 'px -' + styleData.padBottom + 'px';
			quoteButton.style.padding = styleData.padBottom + 'px';
			quoteButton.innerHTML	  = imcgerButtonDown;
			quoteButton.style.display = "block";

			/* Quote Box verkleinern */
			quoteText.style.height = styleData.maxQuoteHeigth + "px";
		}
	}
}

/* Initialisierungsroutine aufrufen */
initQuoteBox();

/* Grösse der Quotebox anpassen wenn das Browserfenster seine grösse ändert */
window.addEventListener("resize", resizeQuote);
