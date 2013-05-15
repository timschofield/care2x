<?php /* Smarty version 2.6.22, created on 2009-06-01 19:34:23
         compiled from nursing/ward_profile.tpl */ ?>


<form action="nursing-station-info.php" method="post" onSubmit="return check(this)">

<ul>
<table>
  <tbody>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDStation']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['name']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDWard_ID']; ?>
</td>
      <!--<td class="adm_input"><textarea name="nr" cols=4 rows=1 wrap="physical"><?php echo $this->_tpl_vars['ward_id']; ?>
</textarea></td>-->
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['ward_id']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDept']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['dept_name']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDescription']; ?>
</td>
      <td class="adm_input"><textarea name="description" cols=40 rows=8 wrap="physical"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td>
      <!--<td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['description']; ?>
</td>-->
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom1Nr']; ?>
</td>
      <td class="adm_input"><textarea name="room_nr_start" cols=4 rows=1 wrap="physical"><?php echo $this->_tpl_vars['room_nr_start']; ?>
</textarea></td>
      <!--<td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['room_nr_start']; ?>
</td>-->
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom2Nr']; ?>
</td>
      <td class="adm_input"><textarea name="room_nr_end" cols=4 rows=1 wrap="physical"><?php echo $this->_tpl_vars['room_nr_end']; ?>
</textarea></td>
      <!--<td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['room_nr_end']; ?>
</td>-->
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoomPrefix']; ?>
</td>
      <td class="adm_input"><textarea name="roomprefix" cols=4 rows=1 wrap="physical"><?php echo $this->_tpl_vars['roomprefix']; ?>
</textarea></td>
      <!--<td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['roomprefix']; ?>
</td>-->
    </tr>
   <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDCreatedOn']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['date_create']; ?>
</td>
    </tr>
   <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDCreatedBy']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['create_id']; ?>
</td>
    </tr>

  <?php if ($this->_tpl_vars['bShowRooms']): ?>
   <tr>
      <td class="adm_item" colspan="3">&nbsp;</td>
    </tr>
   <tr  class="wardlisttitlerow">
      <td><?php echo $this->_tpl_vars['LDRoom']; ?>
</td>
      <td><?php echo $this->_tpl_vars['LDBedNr']; ?>
</td>
      <td><?php echo $this->_tpl_vars['LDRoomShortDescription']; ?>
</td>
    </tr>

	<?php echo $this->_tpl_vars['sRoomRows']; ?>


  <?php endif; ?>

  </tbody>
</table>
<p>
<input type="hidden" name="roomCount" value="<?php echo $this->_tpl_vars['roomCount']; ?>
">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="nr" value="<?php echo $this->_tpl_vars['ward_descr']; ?>
">
<input type="submit" value="save">

</form>
<table width="100%">
  <tbody>
  	<tr valign="top">
  	  <td><?php echo $this->_tpl_vars['sClose']; ?>
</td>
      <td align="right"><?php echo $this->_tpl_vars['sWardClosure']; ?>
</td>
    </tr>
  </tbody>
</table>