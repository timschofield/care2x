<?php /* Smarty version 2.6.22, created on 2009-02-13 21:13:23
         compiled from products/ordering_frameset.tpl */ ?>

<frameset rows="33,*">
  <frame name="BHEADER" <?php echo $this->_tpl_vars['sHeaderSource']; ?>
 scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
	<frame name="BESTELLKORB" <?php echo $this->_tpl_vars['sBasketSource']; ?>
 scrolling="auto" frameborder="yes">
     <frame name="BESTELLKATALOG" <?php echo $this->_tpl_vars['sCatalogSource']; ?>
 scrolling="auto" frameborder="yes">
  </frameset>
</frameset>