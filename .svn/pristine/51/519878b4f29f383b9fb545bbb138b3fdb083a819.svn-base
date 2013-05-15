
// Browsertyp ermitteln (und in B_Type speichern)
var B_Type = new crossBrowserType();
function crossBrowserType() {
	this.IE = false;
	this.NS4 = false;
	this.NS6 = false;
	this.id = "";

	if (document.all) {this.IE = true; this.id = "IE";}
	else if (document.getElementById) {this.NS6 = true; this.id = "NS6";}
	else if (document.layers) {this.NS4 = true; this.id = "NS4";}
}

// Mausposition zurückgeben
var crossMouseX, crossMouseY;
if (B_Type.NS4) document.captureEvents(Event.MOUSEMOVE);

function crossMousePosition(e) {
	if (B_Type.IE) {
		crossMouseX=event.x + document.body.scrollLeft; 
		crossMouseY=event.y + document.body.scrollTop;
	}
	else {crossMouseX=e.pageX; crossMouseY=e.pageY;}
}


// browserspezifisches DHTML-Objekt anhand von ID zurückgeben
function crossGetObject(id) {
	var obj = null;
	if (B_Type.IE) obj=document.all[id];
	else if (B_Type.NS6) obj=document.getElementById(id);
	else if (B_Type.NS4) obj=document.layers[id];
	return obj;
}

// Text in DHTML-Objekt ausgeben
function crossWrite(obj, text) {
		
	if (B_Type.IE) obj.innerHTML = text;
	else if (B_Type.NS6) obj.innerHTML = text;
	else if (B_Type.NS4) {
		obj.document.open();
		obj.document.write(text);
		obj.document.close();
	}
}

// verfügbare Fensterbreite ermitteln
function crossInnerWindowWidth() {
	var val;
	if (B_Type.IE) val=document.body.clientWidth;
	else if (B_Type.NS6) val=window.innerWidth;
	else if (B_Type.NS4) val=window.innerWidth;
	return val;
}

// tatsächliche Fensterbreite ermitteln
function crossOuterWindowWidth() {
	var val;
	if (B_Type.IE) val=document.body.offsetWidth;
	else if (B_Type.NS6) val=window.outerWidth;
	else if (B_Type.NS4) val=window.outerWidth;
	return val;
}

// verfügbare Fensterhöhe ermitteln
function crossInnerWindowHeight() {
	var val;
	if (B_Type.IE) val=document.body.clientHeight;
	else if (B_Type.NS6) val=window.innerHeight;
	else if (B_Type.NS4) val=window.innerHeight;
	return val;
}

// Scroll-Position ermitteln, "y" = vertikal, "x" = horizontal
function crossGetScroll(achse) {
	var val;
	if (!achse || achse == "y") {  // vertikale Achse
		if (B_Type.IE) val=document.body.scrollTop;
		else if (B_Type.NS6) val=window.pageYOffset;
		else if (B_Type.NS4) val=window.pageYOffset;
	}
	else {  // horizontale Achse
		if (B_Type.IE) val=document.body.scrollLeft;
		else if (B_Type.NS6) val=window.pageXOffset;
		else if (B_Type.NS4) val=window.pageXOffset;
	}
	return val;
}

// Scroll-Position setzen
function crossSetScroll(x, y) {
	window.scrollTo(x, y);
}


// Objekt positionieren x/y
function crossMoveTo(obj, x, y) {
	if (B_Type.IE) {obj.style.pixelLeft=x; obj.style.pixelTop=y;}
	else if (B_Type.NS4) {obj.left=x; obj.top=y;}
	else if (B_Type.NS6) {obj.style.left=x+"px"; obj.style.top=y+"px";}
}

// Objekt-Position ermitteln
function crossGetPositionX(obj) {
	if (B_Type.IE) return obj.style.pixelLeft;
	else if (B_Type.NS4) return obj.left;
	else if (B_Type.NS6) return parseInt(obj.style.left);
}
function crossGetPositionY(obj) {
	if (B_Type.IE) return obj.style.pixelTop;
	else if (B_Type.NS4) return obj.top;
	else if (B_Type.NS6) return parseInt(obj.style.top);
}

// Objekt anzeigen
function crossShowObject(obj) {
	if (B_Type.IE || B_Type.NS6) {obj.style.visibility="visible";}
	else if (B_Type.NS4) {obj.visibility="show";}
}
// Objekt ausblenden
function crossHideObject(obj) {
	if (B_Type.IE || B_Type.NS6) {obj.style.visibility="hidden";}
	else if (B_Type.NS4) {obj.visibility="hide";}
}


// Hintergrund-Farbe setzen
function crossBackgroundColor(color, obj) {
	if (typeof obj == "undefined") {document.bgColor=color; return;}
	if (B_Type.IE || B_Type.NS6) {obj.style.backgroundColor=color;}
	else if (B_Type.NS4) {obj.document.bgColor=color;}
}


// Hintergrund-Bild setzen
function crossBackgroundImage(obj, img) {
	if (B_Type.IE || B_Type.NS6) {obj.style.backgroundImage="url(" + img + ")";}
	else if (B_Type.NS4) {obj.background.src = img;}
}
