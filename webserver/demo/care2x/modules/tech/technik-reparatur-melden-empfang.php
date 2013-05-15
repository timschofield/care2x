<?php if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}
 require_once($root_path.'include/inc_config_color.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Technik - Best�tigung</TITLE>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <!-- <img src="../img/gears.gif" align="absmiddle">  -->Technik</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 width=93 height=41  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0 width=93 height=41   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/fenszu.gif" border=0 width=93 height=41   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr>
<td colspan=2 bgcolor=<?php echo $cfg['body_bgcolor']; ?>>
 
<FONT    SIZE=4  FACE="Arial" color="#cc0000">
<ul>
<b>Best�tigung</b></FONT><p>
</ul>
<FONT    SIZE=2  FACE="Arial" >

<?php /*
echo("<hr> <font color=#cc0000 ><b>Eine Anforderung f�r eine Reparaturarbeit ist eingegangen.</b> <p>");
echo("Datum:</font> $tdate <br>");
echo("<font color=#cc0000 >Uhrzeit:</font> $ttime <br>");
echo("<font color=#cc0000 >Abteilung:</font> $dept <br>");
echo("<font color=#cc0000 >Absender:</font> $reporter <br>");
*/
?>

</FONT>
<p>
<table align="center"  cellpadding="15"  border="0">
<tr>
<td>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align=left>
</td>
<td bgcolor=#fefefe>
<FONT    SIZE=2  FACE="Verdana,Arial" >
Vielen Dank Herr/Frau <b><?php echo("$reporter") ?></b>. <p>
Ihre Anforderung wurde am <b><?php echo($tdate); ?></b> um <b><?php echo($ttime); ?></b> 
an der technischen Abteilung empfangen.
</td>

</tr>

</table>
<p>
<center>

<FORM action="technik-reparatur-anfordern.php" >
<input type="hidden" name="sid" value="<?php echo $sid ?>">

<INPUT type="submit"  value="  OK  "></font></FORM>

</center>


</FONT>
<ul>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-anfordern.php?sid=<?php echo $sid ?>"> Eine Reparaturarbeit anfordern</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php?sid=<?php echo $sid ?>"> Eine Reparatur anmelden</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-questions.php?sid=<?php echo $sid ?>">Fragen an der Technik</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-info.php?sid=<?php echo $sid ?>"> Technische Informationen</a><br>
</FONT>
</ul>
<p>
<HR>

<?php
require("../language/$lang/".$lang."_copyrite.php");

 ?>

</td>
</tr>
</table>        
</BODY>
</HTML>
