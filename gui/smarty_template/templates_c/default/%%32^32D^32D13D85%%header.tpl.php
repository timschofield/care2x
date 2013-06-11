<?php /* Smarty version 2.6.22, created on 2013-06-09 13:51:32
         compiled from common/header.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php echo $this->_tpl_vars['HTMLtag']; ?>

<HEAD>
 <TITLE><?php echo $this->_tpl_vars['sWindowTitle']; ?>
 - <?php echo $this->_tpl_vars['Name']; ?>
</TITLE>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/metaheaders.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php echo $this->_tpl_vars['setCharSet']; ?>


 <?php $_from = $this->_tpl_vars['JavaScript']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currentJS']):
?>
 	<?php echo $this->_tpl_vars['currentJS']; ?>

 <?php endforeach; endif; unset($_from); ?>

</HEAD>
<BODY <?php echo $this->_tpl_vars['bgcolor']; ?>
 <?php echo $this->_tpl_vars['sLinkColors']; ?>
 <?php echo $this->_tpl_vars['sOnLoadJs']; ?>
 <?php echo $this->_tpl_vars['sOnUnloadJs']; ?>
>