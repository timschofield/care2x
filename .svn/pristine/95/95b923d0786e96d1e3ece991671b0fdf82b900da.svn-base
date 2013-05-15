<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (preg_match('/inc_string_cleaner.php/i',$_SERVER['PHP_SELF'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

function cleanString($dirty_str)
{

    if(!empty($dirty_str))
    {
        $clean_str=str_replace(' ','',strtolower($dirty_str));
        $clean_str=strtr($clean_str,"/%&!?.*'#[]{}`��()_-;:+��@|<>^�ߵ,=����������������������濹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
        $clean_str=str_replace('~','',$clean_str);
        $clean_str=str_replace("\"","",$clean_str);
        $clean_str=str_replace('\\','',$clean_str);
        $clean_str=str_replace('\$','',$clean_str);
	
	    return $clean_str;
    }
}
?>
