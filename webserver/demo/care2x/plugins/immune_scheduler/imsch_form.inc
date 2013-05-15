<BODY>
<form name="frmeddga" method="POST" action="im_sch_calculator.php">
<div align="center">
<table border="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#FFFFFF" width="500" bordercolorlight="#CCCCCC" bordercolordark="#C0C0C0" bgcolor="#FFFFFF" cellpadding="0">
  <tr>
    <td width="100%" bgcolor="#CCCCCC">
    <p align="center"><i><font face="Verdana" color="#FF0000"><?php echo $LDImmunisationSchedule; ?></font></i></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="2" cellspacing="4" style="border-collapse: collapse" bordercolor="#FFFFFF" width="100%" bordercolorlight="#CCCCCC" bordercolordark="#808080" bgcolor="#C0C0C0" cellpadding="0">
      <tr>
        <td width="50%" bgcolor="#CCCCCC">
        <p align="right"><b><font face="Verdana" size="2" color="#0000FF"><?php echo $LDYourChildIs; ?></font></b></td>
        <td width="50%" bgcolor="#CCCCCC">
          <select size="1" name="TheSex">
          <option value="1"><?php echo $LDMale; ?></option>
          <option value="2"><?php echo $LDFemal; ?></option>
          </select></td>
      </tr>
      <tr>
        <td width="50%" bgcolor="#CCCCCC">
        <p align="right"><b><font face="Verdana" size="2" color="#0000FF"><?php echo $LDChildsBirthdate; ?></font></b></td>
        <td width="50%" bgcolor="#CCCCCC">
          <font face="Verdana">&nbsp;<select size="1" name="TheDay">
          <option selected>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
          <option>24</option>
          <option>25</option>
          <option>26</option>
          <option>27</option>
          <option>28</option>
          <option>29</option>
          <option>30</option>
          <option>31</option>
          </select><font size="2">/</font><select size="1" name="TheMonth">
          <option value="01" selected><?php echo $LDMonthFullName[1]; ?></option>
          <option value="02"><?php echo $LDMonthFullName[2]; ?></option>
          <option value="03"><?php echo $LDMonthFullName[3]; ?></option>
          <option value="04"><?php echo $LDMonthFullName[4]; ?></option>
          <option value="05"><?php echo $LDMonthFullName[5]; ?></option>
          <option value="06"><?php echo $LDMonthFullName[6]; ?></option>
          <option value="07"><?php echo $LDMonthFullName[7]; ?></option>
          <option value="08"><?php echo $LDMonthFullName[8]; ?></option>
          <option value="09"><?php echo $LDMonthFullName[9]; ?></option>
          <option value="10"><?php echo $LDMonthFullName[10]; ?></option>
          <option value="11"><?php echo $LDMonthFullName[11]; ?></option>
          <option value="12"><?php echo $LDMonthFullName[12]; ?></option>
          </select><font size="2">/</font><select size="1" name="TheYear">
          <option>1990</option>
          <option>1991</option>
          <option>1992</option>
          <option>1993</option>
          <option>1994</option>
          <option>1995</option>
          <option>1996</option>
          <option>1997</option>
          <option>1998</option>
          <option>1999</option>
          <option>2000</option>
          <option>2001</option>
          <option>2002</option>
          <option>2003</option>
          <option>2004</option>
          <option>2005</option>
          <option>2006</option>
          <option>2007</option>
          <option>2008</option>
          <option>2009</option>
          <option>2010</option>
          <option>2011</option>
          <option>2012</option>
          <option>2013</option>
          <option>2014</option>
          </select></font></p>
        </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#C0C0C0">
    <p align="center"><button name="calculate" type="submit"><font face="Verdana"><?php echo $LDCalculate; ?></font></button>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#FFFFCC">
    <p align="center"><font size="1" face="Verdana">©Sudisa - 2004 to 2014</font></td>
  </tr>
</table>
<INPUT TYPE="hidden" NAME="do" VALUE="calculate">
</form>
</div>