<?php /* Smarty version 2.6.22, created on 2010-06-20 11:55:31
         compiled from nursing/ward_create_form.tpl */ ?>

<ul>
<?php echo $this->_tpl_vars['sMascotImg']; ?>
 <?php echo $this->_tpl_vars['sStationExists']; ?>
 <?php echo $this->_tpl_vars['LDEnterAllFields']; ?>

<p>

<form action="nursing-station-new.php" method="post" name="newstat" onSubmit="return check(this)">
<table>
  <tbody>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDStation']; ?>
</td>
      <td class="adm_input"><input type="text" name="name" size=20 maxlength=40 value="<?php echo $this->_tpl_vars['name']; ?>
"></td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDWard_ID']; ?>
</td>
      <td class="adm_input"><input type="text" name="ward_id" size=20 maxlength=40 value="<?php echo $this->_tpl_vars['ward_id']; ?>
"> [a-Z,1-0] <?php echo $this->_tpl_vars['LDNoSpecChars']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDept']; ?>
</td>
      <td class="adm_input"><?php echo $this->_tpl_vars['sDeptSelectBox']; ?>
 <?php echo $this->_tpl_vars['sSelectIcon']; ?>
 <?php echo $this->_tpl_vars['LDPlsSelect']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDescription']; ?>
</td>
      <td class="adm_input"><textarea name="description" cols=40 rows=8 wrap="physical"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom1Nr']; ?>
</td>
      <td class="adm_input"><input type="text" name="room_nr_start" size=4 maxlength=4 value="<?php echo $this->_tpl_vars['room_nr_start']; ?>
"></td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom2Nr']; ?>
</td>
      <td class="adm_input"><input type="text" name="room_nr_end" size=4 maxlength=4 value="<?php echo $this->_tpl_vars['room_nr_end']; ?>
"></td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoomPrefix']; ?>
</td>
      <td class="adm_input"><input type="text" name="roomprefix" size=4 maxlength=4 value="<?php echo $this->_tpl_vars['roomprefix']; ?>
"></td>
    </tr>
  </tbody>
</table>
<?php echo $this->_tpl_vars['sSaveButton']; ?>

</form>
<p>
<?php echo $this->_tpl_vars['sCancel']; ?>

</p>
</ul>