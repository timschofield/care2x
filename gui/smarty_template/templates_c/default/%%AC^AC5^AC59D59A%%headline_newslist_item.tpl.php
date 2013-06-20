<?php /* Smarty version 2.6.22, created on 2013-06-16 22:54:39
         compiled from news/headline_newslist_item.tpl */ ?>

<img <?php echo $this->_tpl_vars['sHeadlineImg']; ?>
 align="left" border=0 hspace=10 <?php echo $this->_tpl_vars['sImgWidth']; ?>
>
<?php echo $this->_tpl_vars['sHeadlineItemTitle']; ?>


<?php if ($this->_tpl_vars['sPreface']): ?>
	<br>
	<?php echo $this->_tpl_vars['sPreface']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['sNewsPreview']): ?>
	<p>
	<?php echo $this->_tpl_vars['sNewsPreview']; ?>

<?php endif; ?>

<br>
<font size=1><?php echo $this->_tpl_vars['sEditorLink']; ?>
</font>