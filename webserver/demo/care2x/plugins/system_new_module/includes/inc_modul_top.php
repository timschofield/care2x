<?php
//error_reporting unterdr�ckt Warnmeldungen f�r fehlende Variablen,....
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
* See the file "copy_notice.txt" for the licence notice
*/

//Sprachdatei f�r das Modul einbinden, muss VOR den defines stehen.
$lang_tables[]=$lang_thismodule_used;
//enth�lt Sprachvariablen wie zur�ck, weiter, drucken,...
$lang_tables[]='actions.php';
//enth�lt Sprachvariablen f�r l�ngere allgemeine Textphrasen
$lang_tables[]='prompt.php';
//auch eine langfile, m�sste auf neuere art($-ang_tables[]... umgestellt werden (noch rudiment�r) in front_chain_nalg.php
define('LANG_FILE','edp.php');
//define('NO_TEMPLATE', TRUE);
//Konstante definieren, FLAG ob Dateischutz gecheckt wird oder nicht bei eins wird nicht gecheckt
//zur entwicklung dieses define auf 1 lassen, so kann man das modul direkt im browser angeben
define('NO_2LEVEL_CHK',1);

//Name des Schutzcookies, macht nur Sinn wenn No_2level_chk =0 ist
//$local_user='ck_edv_user'; original-Zeile statt der folgenden drei.
//der Cookie heisst f�r dieses Modul wie der in der edv-main-pass, und die variable $this_cookie_name
//wird in der edv_modul_neu.php gesetzt.
$local_user=$this_cookie_name;


//macht dateischutz und l�dt die sprachdateien, andere Funktionen werden geladen (createldimgsrc)
require_once($root_path.'include/inc_front_chain_lang.php');

//setzt alle cookies zur�ck nur n�tig wenn ein passwortscript generiert wird
//require($root_path.'include/inc_2level_reset.php');

//$breakfile und $returnfile f�r den "R�ckweg" setzen

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
$returnfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_user_origin']='it';
// Set this file as the referer
$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
?>

<!-- dieses muss vor dem head integriert werden, stellt bei arabisch das Men� nach rechts, 
text wird von re nach links gesetzt -->
<?php 
html_rtl($lang); 
?>
