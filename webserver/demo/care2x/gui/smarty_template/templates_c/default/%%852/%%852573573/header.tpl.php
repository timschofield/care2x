<?php /* Smarty version 2.6.0, created on 2009-01-13 00:56:52
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


 <?php if (count($_from = (array)$this->_tpl_vars['JavaScript'])):
    foreach ($_from as $this->_tpl_vars['currentJS']):
?>
 	<?php echo $this->_tpl_vars['currentJS']; ?>

 <?php endforeach; unset($_from); endif; ?>

</HEAD>
<BODY <?php echo $this->_tpl_vars['bgcolor']; ?>
 <?php echo $this->_tpl_vars['sLinkColors']; ?>
 <?php echo $this->_tpl_vars['sOnLoadJs']; ?>
 <?php echo $this->_tpl_vars['sOnUnloadJs']; ?>
>