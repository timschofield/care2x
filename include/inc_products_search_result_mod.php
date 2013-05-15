<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_search_result_mod.php",$_SERVER['PHP_SELF'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

# If smarty object is not available create one
if(!isset($smarty)){
	/**
 * LOAD Smarty
 * param 2 = FALSE = dont initialize
 * param 3 = FALSE = show no copyright
 * param 4 = FALSE = load no javascript code
 */
	include_once($root_path.'gui/smarty_template/smarty_care.class.php');
	$smarty = new smarty_care('common',FALSE,FALSE,FALSE);
	
	# Set a flag to display this page as standalone
	$bShowThisForm=TRUE;
}

if($bcat) $LDMSRCindex['']=""; // if parent is order catalog add one empty column at the end
if($update||($mode=="search")){

	switch($cat)
	{
		case "pharma":
							$imgpath=$root_path."pharma/img/";
							break;
		case "medlager":
							$imgpath=$root_path."med_depot/img/";
							break;
	}

	
 	if($saveok||(!$update)) $statik=true;

	if($linecount)
	{
		 # Assign form elements
		$smarty->assign('LDOrderNr',$LDOrderNr);
		$smarty->assign('LDArticleName',$LDArticleName);
		$smarty->assign('LDGeneric',$LDGeneric);
		$smarty->assign('LDDescription',$LDDescription);
		$smarty->assign('LDPacking',$LDPacking);
		$smarty->assign('LDCAVE',$LDCAVE);
		$smarty->assign('LDCategory',$LDCategory);
		$smarty->assign('LDMinOrder',$LDMinOrder);
		$smarty->assign('LDMaxOrder',$LDMaxOrder);
		$smarty->assign('LDPcsProOrder',$LDPcsProOrder);
		$smarty->assign('LDIndustrialNr',$LDIndustrialNr);
		$smarty->assign('LDLicenseNr',$LDLicenseNr);
		$smarty->assign('LDPicFile',$LDPicFile);

		//echo $linecount;
		if($linecount==1)
		{
			$zeile=$ergebnis->FetchRow();

			# Assign the preview picture

			if(($statik||$update)&&($zeile['picfile']!="")){
				$smarty->assign('LDPreview',$LDPreview);
	 			$sTemp = '<img src="'.$imgpath.$zeile['picfile'].'" border=0 name="prevpic" ';
				if(!$update||$statik)
				{
					if(file_exists($imgpath.$zeile['picfile']))
					{
						$imgsize=GetImageSize($imgpath.$zeile['picfile']);
						$sTemp =$sTemp.$imgsize[3];
					}
				}
				$smarty->assign('sProductImage',$sTemp.'>');
			}else{
				$smarty->assign('sProductImage','<img src="../../gui/img/common/default/pixel.gif" border=0 name="prevpic">');
			}

			# Assign form inputs (or values)

			if ($statik||$update) $smarty->assign('sOrderNrInput',$zeile['bestellnum'].'</b><input type="hidden" name="bestellnum" value="'.$zeile['bestellnum'].'">');
				else $smarty->assign('sOrderNrInput','<input type="text" name="bestellnum" value="'.$zeile['bestellnum'].'" size=20 maxlength=20>');


			if ($statik){
				$smarty->assign('sArticleNameInput',$zeile['artikelname'].'<input type="hidden" name="artname" value="'.$zeile['artikelname'].'">');
				$smarty->assign('sGenericInput',$zeile['generic'].'<input type="hidden" name="generic" value="'.$zeile['generic'].'">');
				$smarty->assign('sDescriptionInput',nl2br($zeile['description']).'<input type="hidden" name="besc" value="'.$zeile['description'].'">');
				$smarty->assign('sPackingInput',$zeile['packing'].'<input type="hidden" name="pack" value="'.$zeile['packing'].'">');
				$smarty->assign('sCAVEInput',$zeile['cave'].'<input type="hidden" name="caveflag" value="'.$zeile['cave'].'">');
				$smarty->assign('sCategoryInput',$zeile['medgroup'].'<input type="hidden" name="medgroup" value="'.$zeile['medgroup'].'">');
				$smarty->assign('sMinOrderInput',$zeile['minorder'].'<input type="hidden" name="minorder" value="'.$zeile['minorder'].'">');
				$smarty->assign('sMaxOrderInput',$zeile['maxorder'].'<input type="hidden" name="maxorder" value="'.$zeile['maxorder'].'">');
				$smarty->assign('sPcsProOrderInput',$zeile['proorder'].'<input type="hidden" name="proorder" value="'.$zeile['proorder'].'">');
				$smarty->assign('sIndustrialNrInput',$zeile['artikelnum'].'<input type="hidden" name="artnum" value="'.$zeile['artikelnum'].'">');
				$smarty->assign('sLicenseNrInput',$zeile['industrynum'].'<input type="hidden" name="indusnum" value="'.$zeile['industrynum'].'">');
				$smarty->assign('sPicFileInput',$zeile['picfile'].'<input type="hidden" name="bild" value="'.$zeile['picfile'].'">');
			}else{
				$smarty->assign('sArticleNameInput','<input type="text" name="artname" value="'.$zeile['artikelname'].'" size=40 maxlength=40>');
				$smarty->assign('sGenericInput','<input type="text" name="generic" value="'.$zeile['generic'].'" size=40 maxlength=60>');
				$smarty->assign('sDescriptionInput','<textarea name="besc" cols=35 rows=4>'.$zeile['description'].'</textarea>');
				$smarty->assign('sPackingInput','<input type="text" name="pack" value="'.$zeile['packing'].'"  size=40 maxlength=40>');
				$smarty->assign('sCAVEInput','<input type="text" name="caveflag" value="'.$zeile['cave'].'" size=40 maxlength=80>');
				$smarty->assign('sCategoryInput','<input type="text" name="medgroup" value="'.$zeile['medgroup'].'" size=20 maxlength=40>');
				$smarty->assign('sMinOrderInput','<input type="text" name="minorder" value="'.$zeile['minorder'].'" size=20 maxlength=9>');
				$smarty->assign('sMaxOrderInput','<input type="text" name="maxorder" value="'.$zeile['maxorder'].'" size=20 maxlength=9>');
				$smarty->assign('sPcsProOrderInput','<input type="text" name="proorder" value="'.$zeile['proorder'].'" size=20 maxlength=40>');
				$smarty->assign('sIndustrialNrInput','<input type="text" name="artnum" value="'.$zeile['industrynum'].'" size=20 maxlength=20>');
				$smarty->assign('sLicenseNrInput','<input type="text" name="indusnum" value="'.$zeile['artikelname'].'" size=20 maxlength=20>');
				$smarty->assign('sPicFileInput','<input type="file" name="bild" onChange="getfilepath(this)">');
			}
			/*
					echo '
						  <table border=0 cellspacing=2 cellpadding=3 >
    						<tr >
      							<td align=right width=140 bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDOrderNr.'</td>
      						';
					if($statik||$update)
						echo '
								<td width=320  bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=3><b>'.$zeile['bestellnum'].'</b><input type="hidden" name="bestellnum" value="'.$zeile['bestellnum'].'">
         						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="bestellnum" value="'.$zeile['bestellnum'].'" size=20 maxlength=20>
         						 </td>';		 

					echo '
							<td rowspan=13 valign=top  >';
					if($zeile['picfile']!="")
					{
						echo'
		  							<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDPreview.':<br>
	 										<img src="'.$imgpath.$zeile['picfile'].'" border=0 name="prevpic" ';
						if(!$update||$statik)
						{
							if(file_exists($imgpath.$zeile['picfile']))
							{
								$imgsize=GetImageSize($imgpath.$zeile['picfile']);
						 		echo $imgsize['3'];
							}
						 }
						echo ' >';
					}
					else echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 name="prevpic"  >';
					echo '</td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDArticleName.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$zeile['artikelname'].'</b><input type="hidden" name="artname" value="'.$zeile['artikelname'].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artname" value="'.$zeile['artikelname'].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					echo '
   						</tr>
          					<tr bgcolor="#ffffdd">
     						 		<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDGeneric.'</td>
       						';
					if($statik)
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['generic'].'<input type="hidden" name="generic" value="'.$zeile['generic'].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="generic" value="'.$zeile['generic'].'"  size=40 maxlength=60>
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
     								 <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDDescription.'</td>
       						';
					if($statik)
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($zeile['description']).'<input type="hidden" name="besc" value="'.$zeile['desription'].'">
          							</td>
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><textarea name="besc"  cols=35 rows=4>'.$zeile['description'].'</textarea>
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPacking.'</td>
      	       						';
					if($statik)
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['packing'].'<input type="hidden" name="pack" value="'.$zeile['packing'].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="pack" value="'.$zeile['packing'].'" size=40 maxlength=40>
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCAVE.'</td>
      	       						';
					if($statik)
						echo '
							<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['cave'].'<input type="hidden" name="caveflag" value="'.$zeile['cave'].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="caveflag" value="'.$zeile['cave'].'" size=40 maxlength=80>
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCategory.'</td>
       						';
					if($statik)
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['medgroup'].'<input type="hidden" name="medgroup" value="'.$zeile['medgroup'].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="medgroup" value="'.$zeile['medgroup'].'" size=20 maxlength=40>
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDMinOrder.'</td>
      	       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['minorder'].'<input type="hidden" name="minorder" value="'.$zeile['minorder'].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="minorder" value="'.$zeile['minorder'].'" size=20 maxlength=9>
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDMaxOrder.'</td>
       	       						';
					if($statik) 
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['maxorder'].'<input type="hidden" name="maxorder" value="'.$zeile['maxorder'].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="maxorder" value="'.$zeile['maxorder'].'" size=20 maxlength=9>
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPcsProOrder.'</td>
      	       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['proorder'].'<input type="hidden" name="proorder" value="'.$zeile['proorder'].'"></td>
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="proorder" value="'.$zeile['proorder'].'" size=20 maxlength=40>
         						 </td>';
					echo '
    						</tr>
    								<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDIndustrialNr.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['artikelnum'].'<input type="hidden" name="artnum" value="'.$zeile['artikelnum'].'">
          						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artnum" value="'.$zeile['artikelnum'].'" size=20 maxlength=20>                                                                                                   
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDLicenseNr.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['industrynum'].'<input type="hidden" name="indusnum" value="'.$zeile['industrynum'].'">
          						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="indusnum" value="'.$zeile['industrynum'].'" size=20 maxlength=20>
         						 </td>';
					echo '
    						</tr>
						
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPicFile.'</td>
       	       						';
					if($statik) 
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile['picfile'].'<input type="hidden" name="bild" value="'.$zeile['picfile'].'"></td>
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="file" name="bild" onChange="getfilepath(this)">                                                                                                   
         						 </td>';
					echo '
    						</tr>
  						</table>
						';
						
					*/
				# If display is forced
				if($bShowThisForm) $smarty->display('products/form.tpl');

			}else{
				echo "<p>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>$LDClk2SeeInfo<p>";

					echo "<table border=0 cellpadding=3 cellspacing=1> ";
		
					echo '<tr class="wardlisttitlerow">';

					for($i=0;$i<sizeof($LDMSRCindex)-1;$i++)
					{
						echo '<td>'.$LDMSRCindex[$i].'</td>';
					}
					echo "</tr>";

					/* Load common icons */
					$img_info=createComIcon($root_path,'info3.gif','0');
					$img_arrow=createComIcon($root_path,'dwnarrowgrnlrg.gif','0');
					
					while($zeile=$ergebnis->FetchRow())
					{
						echo "<tr class=";
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo '
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&keyword='.$zeile['bestellnum'].'&mode=search&from=multiple&cat='.$cat.'&userck='.$userck.'"><img '.$img_info.' alt="'.$LDOpenInfo.$zeile['artikelname'].'"></a></td>
									<td valign="top"><font size=1>'.$zeile['bestellnum'].'</td>
									<td valign="top"><font size=1>'.$zeile['artikelnum'].'</td>
									<td valign="top"><font size=1>'.$zeile['industrynum'].'</td>
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&keyword='.$zeile['bestellnum'].'&mode=search&from=multiple&cat='.$cat.'&userck='.$userck.'"><font size=2 color="#800000"><b>'.$zeile['artikelname'].'</b></font></a></td>
									<td valign="top"><font size=1>'.$zeile['generic'].'</td>
									<td valign="top"><font size=1>'.$zeile['description'].'</td>
									';
						// if parent is order catalog add this option column at the end
						if($bcat) echo'
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&mode=save&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&cat='.$cat.'&userck='.$userck.'"><img '.$img_arrow.' alt="'.$LDPut2Catalog.'"></a></td>';
						echo    '
									</tr>';
					}
					echo "</table>";
					if($linecount>15)
					{
						echo '
								<a href="#pagetop">'.$LDPageTop.'</a>';
					}//end of if $linecount>15

			}//end of else
	}else{
		echo '
			<p><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
			'.$LDNoDataFound;
	}
}
?>
