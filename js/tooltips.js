// integriert: Crossbrowser-Funktionen von "cross.js"

/* bitte vergesst nicht, ein Link auf meine Site zu setzen */

// Config:
var ballonBack = "#00ff77";  // Hintergrundfarbe
var ballonText = "#000000";  // Text und Randfarbe
var ballonBreite = 200;        // Ballon-Breite (Vorgabewert)
var ballonBorder = 1;      // Randstärke
var ballonFont = "Arial";
var ballonDir = 0;         // Ausrichtung; 0=rechts 1=links
var ballonVDir = 0;        // Ausrichtung; 0=unten 1=oberhalb
var ballonChangeVDir = 65;    // Schwellwert für Wechsel der 
			      // V-Ausrichtung am unteren Rand
var ballonSpace = 10;        // Abstand vom Cursor
var ballonShow = false; // Anzeige aktiv/inaktiv

var Ballon = null;        // das DIV-Objekt
var b_Breite;             // aktueller Speicher für Ballonbreite
var b_Dir, b_VDir;

// Ballon-Objekt (div) festlegen
function setBallon(id, breite, bgcolor) {
		
	document.onmousemove = cursorMove;
	
	if (breite && breite>20) b_Breite = breite;
	if (bgcolor) ballonBack = bgcolor;
	Ballon = crossGetObject(id);
	if (Ballon == null) {
		alert("keine Unterstützung für Ballon-Infos");
		showBallon = noBallon; hideBallon = noBallon;
	}
	ballonShow = false;
}
function noBallon() {} // functionsaufrufe abfangen
document.write('<meta name="scripts" content="TOOLTIPS 1.03 (c)2001-2002 Peter Kerl [www.peterkerl.de]">');

// Ballon kreieren und anzeigen
function showBallon(msg, dir, breite, bgcolor) {
	var b_Back;
	var relWidth, relHeight;

	if (Ballon == null) return;
	if (breite && breite>20) b_Breite = breite;
	else b_Breite=ballonBreite;
	if (bgcolor) b_Back=bgcolor;
	else b_Back=ballonBack;
	msg = '<table width=' + b_Breite + ' border=0 cellpadding=' + ballonBorder + ' cellspacing=0 bgcolor=\"' + ballonText + '\"><tr><td><table width=100% border=0 cellpadding=3 cellspacing=0 bgcolor=\"' + b_Back + '\"><tr><td><font face=\"'  + ballonFont + '\" color=\"' + ballonText + '\" size=-1>' + msg + '</font></td></tr></table></td></tr></table>';
	if (!dir) b_Dir = ballonDir;
	else b_Dir = dir;
	relWidth = crossInnerWindowWidth() + crossGetScroll("x");
	relHeight = crossInnerWindowHeight() + crossGetScroll("y");
	if (crossMouseX + b_Breite + ballonSpace > relWidth) 
		{b_Dir = 1;}
	else if (crossMouseX < b_Breite + ballonSpace) b_Dir = 0;
	b_VDir = ballonVDir;
	if (crossMouseY + ballonChangeVDir > relHeight) b_VDir = 1;
	else if (crossMouseY - ballonChangeVDir < 0) b_VDir = 0;
	crossWrite(Ballon, msg);
	ballonShow = true;
	crossShowObject(Ballon);
}

function hideBallon() {
	if (Ballon == null) return;
	crossHideObject(Ballon);
	ballonShow=false;
	crossMoveTo(Ballon, -200, 0);
}

// der Maus folgen
function cursorMove(e) {
	var posX, posY;
	
	crossMousePosition(e);

	if (ballonShow) {
		
		if (b_Dir==0) {
			posX = crossMouseX + ballonSpace; 
			if (b_VDir==0) {posY = crossMouseY + ballonSpace;}
			else {posY = crossMouseY - ballonChangeVDir;}
		}
		else {
			posX = crossMouseX-b_Breite-ballonSpace;
			if (b_VDir==0) {posY = crossMouseY + ballonSpace;}
			else {posY = crossMouseY - ballonChangeVDir;}
		}
		crossMoveTo(Ballon, posX, posY)
	}
}
