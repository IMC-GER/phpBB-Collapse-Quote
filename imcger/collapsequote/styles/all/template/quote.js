function ColorToRGBA(color, opacity) {
	var rgbColors = new Object();

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
	let para = document.querySelector('blockquote');
	let compStyles = window.getComputedStyle(para);
	let lineHeight = parseInt(compStyles.getPropertyValue('line-height'));
	let paddingTop = parseInt(compStyles.getPropertyValue('padding-top'));
	let paddingBot = parseInt(compStyles.getPropertyValue('padding-bottom'));
	let bgColor	   = compStyles.getPropertyValue('background-color');
	let maxQuoteHeigth = (4 * lineHeight) + paddingTop + paddingBot;
	let shadowHeigth   = 4 * lineHeight;

	return({"bgColor": bgColor, "lineHeight": lineHeight, "shadowHeigth": shadowHeigth, "maxQuoteHeigth": maxQuoteHeigth, "padBottom": paddingBot});
}

function toggleQuote(quoteButton) {
	let styleData   = getStyleData();
	let quoteBox 	= quoteButton.previousSibling;
	let quoteText 	= quoteButton.previousSibling.firstChild;
	let quoteShadow = quoteButton.previousSibling.lastChild;

	if(quoteShadow.style.display == "none") {
		quoteBox.style.height 	  = styleData.maxQuoteHeigth + "px";
		quoteShadow.style.display = "inherit";
		quoteButton.innerHTML 	  = "&darr;&darr;&darr;&darr;&darr;&darr;&darr;";
	}
	else {
		quoteBox.style.height 	  = quoteText.offsetHeight + "px";
		quoteShadow.style.display = "none";
		quoteButton.innerHTML 	  = "&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;";
	}
}

function initQuoteBox() {
	/* Liste von <blockquote>-Elementen, deren unmittelbares übergeordnetes Element
	   ein <div> mit der Klasse "content" ist */
	let x = document.querySelectorAll("div.content > blockquote");
	
	if(x.length < 1) {
		return(0);
	}

	/* Eigenschaften des phpBB Styles abfragen */
	let styleData = getStyleData();

	for (i = 0; i < x.length; i++) {
		/* Wenn Quote Box zu groß */
		if(parseInt(x[i].querySelector(".imcger-quote-text").offsetHeight) > styleData.maxQuoteHeigth) {
			let quoteText	= x[i].querySelector(".imcger-quote-text");
			let quoteShadow = quoteText.lastChild;
			let quoteButton = quoteText.nextSibling;

			/* Eigenschaften dem Schattenelement hinzufügen */
			quoteShadow.style.backgroundImage = 'linear-gradient(' + ColorToRGBA(styleData.bgColor, 0) + ', ' + ColorToRGBA(styleData.bgColor, 0.8) + ' 70%, ' + ColorToRGBA(styleData.bgColor, 1) + ')';
			quoteShadow.style.height  = styleData.shadowHeigth + 'px';
			quoteShadow.style.bottom  = styleData.lineHeight + 'px';
			quoteShadow.style.display = "block"

			/* Eigenschaften dem Toggelbutton hinzufügen */
			quoteButton.style.backgroundColor = styleData.bgColor;
			quoteButton.style.marginBottom	  = '-' + styleData.padBottom + 'px';
			quoteButton.style.paddingBottom   = styleData.padBottom + 'px';
			quoteButton.innerHTML = "&darr;&darr;&darr;&darr;&darr;&darr;&darr;";
			quoteButton.style.cursor = "pointer";
			quoteButton.style.display = "block"
			/* Quote Box verkleinern */
			quoteText.style.height = styleData.maxQuoteHeigth + "px";
		}
	}
}

initQuoteBox();
