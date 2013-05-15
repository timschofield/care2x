 <?php
 /*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("headline-format.php",$_SERVER['PHP_SELF'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>
<tr>
<td>

<table border=0 bgcolor=#cfcfcf cellpadding=1 cellspacing=0 width="100%">
  <tr>
    <td>
	<table border=0 bgcolor=#ffffff cellpadding=1 cellspacing=0 width="100%">
   <tr>
     <td><font face="Verdana, Arial" size=6 color=#800000>
	 <b><?php echo $LDHeadline ?></b>
	 </font>
	 </td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>

<!-- <img <?php //echo createLDImgSrc($root_path,'headline4.png','0') ?>><br>
 -->
 </td>
</tr>
<tr>
<?php
 /**
 * Routine to display the headlines
 */
for($j=1;$j<=$news_num_stop;$j++)
 {
		$picalign=($j==2)? 'right' : 'left';
 ?>

    <td>
<?php
include($root_path.'include/inc_news_preview.php');
?>
<hr>
</td>
  </tr>

<?php
}
?>
