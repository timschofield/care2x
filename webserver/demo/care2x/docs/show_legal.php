<?php
if(file_exists('../language/'.$_GET['lang'].'/'.$_GET['lang'].'_legal.htm')) include('../language/'.$_GET['lang'].'/'.$_GET['lang'].'_legal.htm');
	else include('../language/en/en_legal.htm');
?>
