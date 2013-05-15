<?php /* Smarty version 2.6.0, created on 2009-01-13 00:55:06
         compiled from common/baseframe.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php echo $this->_tpl_vars['HTMLtag']; ?>

<HEAD>
 <TITLE><?php echo $this->_tpl_vars['sWindowTitle']; ?>
</TITLE>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/metaheaders.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php echo $this->_tpl_vars['setCharSet']; ?>


</HEAD>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sBaseFramesetTemplate'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<noframes>
<BODY bgcolor=white>
<?php echo $this->_tpl_vars['LDNoFrame']; ?>
<BR>
<A HREF="contents.htm"> OK</A>
</BODY>
</noframes>

</HTML>