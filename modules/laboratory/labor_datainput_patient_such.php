<?php
//setcookie(currentuser,"");

$dbname="maho";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
$dbtable='care_admission_patient';
$thisfile="labor_datainput_patient_such.php";
$breakfile="labor.php";

$toggle=0;

$fieldname=array("Pat.nummer","Name","Vorname","Geburtsdatum");

$fielddata="care_admission_patient_patnum, care_admission_patient_name, care_admission_patient_vorname, care_admission_patient_gebdatum, care_admission_patient_item";

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Labor Patientendaten Suchen</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img src=../img/micros.gif><FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>patientendaten suchen</b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src=../img/such-b.gif></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<FORM action="<? echo $thisfile; ?>" method="post">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B>Stichwort eingeben. z.B. Name, Vorname, Geburtsdatum, oder Abkürzung u.s.w.</B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" value=<? echo $keyword ?>></font> 
<INPUT type="submit" name="versand" value="SUCHEN"></FORM>


<p>

<?php 
if(($versand!="")and($keyword))
  {
	$suchwort=trim($keyword);
	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			if($suchwort<20000000) $suchbuffer=$suchwort+20000000; else $suchbuffer=$suchwort;
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' 
			WHERE care_admission_patient_name LIKE "'.$suchwort.'%" 
			OR care_admission_patient_vorname LIKE "'.$suchwort.'%"
			OR care_admission_patient_gebdatum LIKE "'.$suchwort.'%"
			OR care_admission_patient_patnum LIKE "'.$suchbuffer.'" 
			ORDER BY care_admission_patient_patnum';

        	$ergebnis=$db->Execute($sql);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=$ergebnis->FetchRow()) $linecount++;
				echo "<hr width=80% align=left><p>Die Suche hat <font color=red><b>".$linecount."</b></font> Patientendaten gefunden.<p>";
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
					echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=orange>";
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo"<td><font face=arial size=2><b>".$fieldname[$i]."</b></td>";
		
					}
					 echo"<td>&nbsp;</td></tr>";

					while($zeile=$ergebnis->FetchRow())
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#cecece>"; $toggle=0;} else {echo "#ffffaa>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis)-1;$i++) 
						{
							echo"<td><font face=arial size=2>";
							if($zeile[$i]=="")echo "&nbsp;"; else echo $zeile[$i];
							echo "</td>";
						}
					    echo'<td><font face=arial size=2>&nbsp;
							<a href=labor_datainput.php?route=validroute&from=such&itemname='.$zeile[care_admission_patient_item].'>
							<img src=../img/file_update.gif border=0 alt="Laborwerte diesem Patient eingeben"></a>&nbsp;</td></tr>';

					}
					echo "</table>";
					if($linecount>15)
					{
						echo '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="'.$thisfile.'" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Stichwort eingeben. z.B. Fallnummer, Name, Vorname, Geburtsdatum, oder Abkürzung u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value='.$keyword.'> 
						<INPUT type="submit" name="versand" value="SUCHEN"></font></FORM>
						<p>';
					}
				}
			}
			 else {echo "<p>".$sql."<p>Das Lesen von Daten aus der Datenbank ist gescheitert.";};
		} else echo " Tabelle konnte nicht ausgewählt werden.";
	  
	}
  	 else 
		{ echo "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }

	
}

?>
<p>
<p>
<FORM action="<? echo $breakfile; ?>" >
<INPUT type="submit"  value="Abbrechen">
</FORM>
</ul>
&nbsp;
</FONT>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>

</table>        
<p>

<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>



</FONT>


</BODY>
</HTML>