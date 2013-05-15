<?php /* Smarty version 2.6.22, created on 2010-05-31 15:30:52
         compiled from laboratory/request_aftersave.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'laboratory/request_aftersave.tpl', 8, false),)), $this); ?>

<?php echo smarty_function_config_load(array('file' => "test.conf",'section' => 'setup'), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array('title' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- This is a temporary local css, will be discarded once a global template is implemented -->
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
.lmargin {margin-left: 5;}
<?php echo $this->_tpl_vars['css_lab']; ?>

</style>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header_topblock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border=0>
  <tr valign="top">
    <td><?php echo $this->_tpl_vars['gifMascot']; ?>
</td>
    <td><FONT    SIZE=4  FACE="verdana,Arial" color="#990000">
	<?php echo $this->_tpl_vars['sAfterSavePrompt']; ?>
<br>
	<?php echo $this->_tpl_vars['LDWhatToDo']; ?>

	<p>
    <FONT    SIZE=2  FACE="verdana,Arial" color="#990000">
           <a href="<?php echo $this->_tpl_vars['pbPrintOut']; ?>
"> <?php echo $this->_tpl_vars['gifGrnArrow']; ?>
 <?php echo $this->_tpl_vars['LDPrintForm']; ?>
</a><br>
           <a href="<?php echo $this->_tpl_vars['pbEditForm']; ?>
"> <?php echo $this->_tpl_vars['gifGrnArrow']; ?>
 <?php echo $this->_tpl_vars['LDEditForm']; ?>
</a><br>
	       <a href="<?php echo $this->_tpl_vars['pbNewSamePatient']; ?>
"> <?php echo $this->_tpl_vars['gifGrnArrow']; ?>
  <?php echo $this->_tpl_vars['LDNewFormSamePatient']; ?>
</a><br>
           <?php if ($this->_tpl_vars['user_origin_lab']): ?>
	       <a href="<?php echo $this->_tpl_vars['pbNewForm']; ?>
"> <?php echo $this->_tpl_vars['gifGrnArrow']; ?>
  <?php echo $this->_tpl_vars['LDNewFormOtherPatient']; ?>
</a><br>
           <?php endif; ?>
           <a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"> <?php echo $this->_tpl_vars['gifGrnArrow']; ?>
 <?php echo $this->_tpl_vars['LDEndTestRequest']; ?>
</a><p>
        </td>
  </tr>
</table>

<div align="center">

<?php if ($this->_tpl_vars['patho']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forms/pathology.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['printout_form']; ?>

<?php endif; ?>

</div>

<p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/copyright.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>