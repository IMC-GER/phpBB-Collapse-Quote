function ColorToRGBA(color, opacity)
{  
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
	else if (color.substring(0,1) == "#") {
		rgbColors[0] = parseInt(color.substring(1, 3), 16);
		rgbColors[1] = parseInt(color.substring(3, 5), 16);
		rgbColors[2] = parseInt(color.substring(5, 7), 16);
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
	let maxQuoteHeigth = (5 * lineHeight) + paddingTop + paddingBot;
	let shadowHeigth   = 3 * lineHeight;
	
	return({"bgColor": bgColor, "shadowHeigth": shadowHeigth, "maxQuoteHeigth": maxQuoteHeigth, "padBottom": paddingBot});
}

function toggleQuote(quoteButton) {
	let styleData   = getStyleData();
	let quoteShadow = quoteButton.previousSibling.lastChild;
	let quoteBox 	= quoteButton.previousSibling;
	
	if(quoteShadow.style.display == "none") {
		quoteBox.style.height 	  = styleData.maxQuoteHeigth + "px";
		quoteShadow.style.display = "inherit";
		quoteButton.innerHTML 	  = "&darr;&darr;&darr;&darr;&darr;&darr;&darr;";
	}
	else {
		quoteBox.style.height 	  = "auto";
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
		if(parseInt(x[i].offsetHeight) > styleData.maxQuoteHeigth) {
			let quoteWrap	 = x[i].children[0];
			let shadow 		 = '<div class="imcger-quote-shadow"></div>';
			let toggleButton = '<div class="imcger-quote-button" onclick="toggleQuote(this)"></div>';

			/* Elemente der Quote Box hinzufügen */
			quoteWrap.classList.add("imcger-quote");
			quoteWrap.insertAdjacentHTML("beforeend", shadow);
			quoteWrap.insertAdjacentHTML("afterend", toggleButton);

			let quoteShadow = quoteWrap.lastChild;
			let quoteButton = quoteWrap.nextSibling;

			/* Eigenschaften dem Schattenelement hinzufügen */
			quoteShadow.style.backgroundImage = 'linear-gradient(' + ColorToRGBA(styleData.bgColor, 0) + ', ' + ColorToRGBA(styleData.bgColor, 0.8) + ' 70%, ' + ColorToRGBA(styleData.bgColor, 1) + ')';
			quoteShadow.style.height = styleData.shadowHeigth + 'px';

			/* Eigenschaften dem Toggelbutton hinzufügen */
			quoteButton.style.backgroundColor = styleData.bgColor;
			quoteButton.style.marginBottom	  = '-' + styleData.padBottom + 'px';
			quoteButton.style.paddingBottom   = styleData.padBottom + 'px';
			quoteButton.innerHTML = "&darr;&darr;&darr;&darr;&darr;&darr;&darr;";
			quoteButton.style.cursor = "pointer";

			/* Quote Box verkleinern */
			quoteWrap.style.height = styleData.maxQuoteHeigth + "px";
		}
	}
}

initQuoteBox();
