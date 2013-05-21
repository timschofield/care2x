<?php

	require_once($root_path.'include/care_api_classes/class_core.php');

	/**
	*
	* Class for Multiple small functionalities of the system
	*
	* You should initialize "$db" in each db query
	*
	* @author Dennis Mollel
	*
	* @version beta 2.05.4d
	* @package multi_moduler
	*
	*/

	class multi extends Core {
		/**#@+
		* @access private
		*/
		var $str;
		var $sql;
		var $enc = '';

		var $notin = '-- UNKNOWN --';

		# docSTATS
		var $docname = '';
		var $docroom = '';
		var $docpatient = '';
		var $docdept = '';

		var $tb_users = ' `care_users` ';
		var $tb_region = ' `care_tz_region` ';
		var $tb_ward = ' `care_tz_ward` ';
		var $tb_district = ' `care_ug_district`';
		var $tb_county = '`care_ug_county`';
		var $tb_subcounty = '`care_ug_subcounty`';
		var $tb_parish = '`care_ug_parish`';
		var $tb_village = '`care_ug_village`';
		var $tb_room = '`care_tz_hospital_rooms`';
		var $tb_diagnosis = '`care_tz_diagnosis`';
		var $tb_conf = '`care_tz_hospital_rooms_conf`';
		var $tb_chemlabor = 'care_test_request_chemlabor' ;
		var $tb_measurement = 'care_encounter_measurement';
		var $tb_prescription = 'care_encounter_prescription';
		var $tb_docHistory = '`care_tz_hospital_doctor_history`';
		var $tb_encounter = '`care_encounter`';
		var $tb_notes = 'care_encounter_notes';
		var $tb_doctor_history = 'care_tz_hospital_doctor_history';

		# ASSIGN REPORT DATE
		var $Dates = '';

		# current department
		var $dept  = '';

		# return name only
		var $room_display = 'name';

		var $userlist = array();

		/*
		 * Save Patient numbers
		 */

		function _saveNumbers($s){
			global $db;

			#replace if incoming string is not in corect format
			if (strlen($s)<5) $s = '1|1|1|0|0|0|0|0|1|0|0|0';
			$this->sql = "UPDATE `care_config_global` SET " .
									"`value` = '".$s."' " .
									" WHERE " .
									"`type` = 'hospital_numbers_to_display';";
			//print $this->sql.'';
			if ($db->Execute($this->sql)) return 'saved';

		}

		/*
		 * Edit Patient numbers
		 */
		function __read_hospno(){
			global $db;
			$this->sql="Select `value` FROM `care_config_global` WHERE `type` = 'hospital_numbers_to_display'";
			$dc = $db->Execute($this->sql);

			# if have data
			if ($row=$dc->FetchRow()) return $row[0];

			# its the first time to initialize this feature
			# create a single row of default values
			else {
				$this->sql="INSERT INTO `care_config_global` (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES (" .
											"'hospital_numbers_to_display', " .
											"'1|1|1|0|0|0|0|0|1|0|0|0', "   .
											"NULL, '', '', '', "      .
											"CURRENT_TIMESTAMP, '', " .
											"'0000-00-00 00:00:00'"   .
										"); ";

				if($db->Execute($this->sql))
					return '1|1|1|0|0|0|0|0|1|0|0|0';

			}
		}

		# get all system config numbers
		# @ str
		function __genNumbers(){
			$vt = $this->__read_hospno();
			$vc = explode('|',$vt);
			return $vc;
		}




		function _save_Password_Expiring($s){
			global $db;

			#replace if incoming string is not in corect format
			if (intval($s)<1) $s = '0';
			$this->sql = "UPDATE `care_config_global` SET " .
									"`value` = '".$s."' " .
									" WHERE " .
									"`type` = 'system_password_expire';";
			//print $this->sql.'';
			if ($db->Execute($this->sql)) return 'saved';

		}

		/*
		 * Edit Patient numbers
		 */
		function __read_Password_Expiring(){
			global $db;
			$this->sql="Select `value` FROM `care_config_global` WHERE `type` = 'system_password_expire'";
			$dc = $db->Execute($this->sql);

			# if have data
			if ($row=$dc->FetchRow()) return $row[0];

			# its the first time to initialize this feature
			# create a single row of default values
			else {
				$this->sql="INSERT INTO `care_config_global` (`type` ,`value` ,`notes` ,`status` ,`history` ,`modify_id` ,`modify_time` ,`create_id` ,`create_time`)
									VALUES (
										'system_password_expire', '0', 'Password Expiring Time', '', '', '',
										CURRENT_TIMESTAMP , 'system', '2010-11-23 00:00:00'
									);";

				if($db->Execute($this->sql))
					return 0;

			}
		}



		/*save room (system conf)*/
		function SaveRoom($v){
			global $db;
			if ($v['name'])  $v['name']  = addslashes($v['name']);
			if ($v['notes']) $v['notes'] = addslashes($v['notes']);

			if ($v['mode']=='add'){
				$sql="INSERT INTO " . $this->tb_room . "
						(`name` ,`notes` ,`active`,`dpt` ,`createdby` ,`createdate`)
						VALUES ('".$v['name']."', '".$v['notes']."', '".$v['status']."','".$v['dpt']."', '".$v['by']."', '".date('Y-m-d')."');";

			} else if ($v['mode']=='edit')
				$sql = "UPDATE " . $this->tb_room . " SET " .
						"`notes` = '".$v['notes']."'," .
						"`active` = '".$v['status']."', " .
						"`name` = '".$v['name']."', " .
						"`dpt` = '".$v['dpt']."' " .
						" WHERE `name` = '".$v['iname']."' " .
						" AND " .
						" `dpt` =".$v['idpt']." ;";

			else if ($v['mode']=='remove')
				$sql = "DELETE FROM " . $this->tb_room . " WHERE `name` = '".$v['name']."' AND `dpt` = ".$v['dpt']." LIMIT 1";

			else if ($v['mode']=='conf') {
				$sql = "DELETE FROM  " . $this->tb_conf . " WHERE `name` = '".$v['name']."' AND `dpt` = ".$v['dpt']." AND `date` = '".$v['dates']."';";

				if (!$db->Execute($sql))
					print mysql_error();

				$sql = "INSERT INTO " . $this->tb_conf .
						" (`name` ,`dpt` ,`users`,`date`)" .
						" VALUES " .
						" ('".$v['name']."', '".$v['dpt']."', '".$v['users']."', '".$v['dates']."');";
			}

			if ($sql!='')
		    	if ($db->Execute($sql))
					return  1; # done;
			else {
		    		print mysql_error();
		    		return -1; # failed;
			}
		}


		/*get list of room saved (sys conf)*/
		function listRooms($v){
			global $db;

			$sql="SELECT * FROM " . $this->tb_room . $v . " ORDER BY name ASC";

		    if ($o = $db->Execute($sql))
				 return $o;      # done;
			else return array(); # failed;
		}

		/*get user list (sys conf)*/
		function GetAllUsers($jk,$v){
			global $db;
			$sql="SELECT `name`,`login_id` FROM " . $this->tb_users . " WHERE `lockflag` =0 AND `personell_nr` NOT IN (0) or ( `name` NOT IN ('admin',".$jk.")) ".$v." ORDER BY name ASC";
		    if ($o = $db->Execute($sql))
				 return $o; # done;
		}


		function StripUsers($str){
			global $db;
			$str = explode('|',$str);
			$this->userlist = array();
			$temp = '';
			$h = 1;
			foreach($str as $u){
				if ($u!=''){
					$s = 'SELECT name FROM '. $this->tb_users .' WHERE login_id="'.$u.'"';
					$y = $db->Execute($s);
					if ($r=$y->FetchRow()){
						$temp .= ($h==1)?$r[0]:'<br />'.$r[0];
						$this->userlist[$u] = $r[0];
						$h++;
					}
				}
			}
			return $temp;
		}

		/* Get room assigned by patient */
		function GetPatientRoom($id){
			global $db;
			$id = ($id)?$id:'-1';
			$sql="SELECT `room` FROM " . $this->tb_encounter . " WHERE `encounter_nr`=".$id;
			#print $sql.'<hr>';
		    if ($o = $db->Execute($sql))
		    if ($rw = $o->FetchRow())
				return $rw[0];      # done;
			# !v!
		}

		/* Get users assigned to a room */
		function ListAsignedUsers($n,$d){
			global $db;
			$sql="SELECT `users` FROM " . $this->tb_conf . " WHERE `name` = '".$n."' AND `dpt` = ".$d. " AND `date`='".$this->Dates."' ";
		    if ($o = $db->Execute($sql)){
		    	$u = $o->FetchRow();
				return $u[0];
		    }
		}

		/*get list of room assigned to the department */
		function GetRoomsAssigned($dpt){
			global $db;
			$dpt = ($dpt!='')?$dpt : '-1';
			$this->room_display = ($this->room_display!='')?$this->room_display : 'name';
			$this->Dates = ($this->Dates!='')? $this->Dates : date('Y-m-d');
			$sql="SELECT ".$this->room_display." FROM " . $this->tb_conf .
						 " WHERE `dpt` =".$dpt.
						 " AND `date`='".$this->Dates."' " .
						 " ORDER BY name";
		    if ($o = $db->Execute($sql))
				return $o;
		}

		/* Get a room assigned from */
		function user_RoomLookup($users,$dpt){
			global $db;
			$room = 'General Room';
			$sql="SELECT * FROM " . $this->tb_conf . " WHERE `dpt` = ".$dpt." AND `date`='".date('Y-m-d')."'";
		    if ($o = $db->Execute($sql));

	    	while( $u = $o->FetchRow()){
	    		$uza = explode('|',$u['users']);
				foreach($uza as $vx){
					if (strtolower($vx)==strtolower($users)){
		    			$room = $u['name'];
		    			break;
					}
				if ($room!='General Room') break;
	    		}
			}

			return $room;
		}

		function unlink_user_assign(){
			global $db;


		}

		/* transfer room from one room to another of any department*/
		function SwapPatientRoom($enc,$rm){
			global $db;
			$enc = ($enc!='')?$enc:'-1';
			$sql="Select `room`,`room_history`,`current_dept_nr`,`current_dept_history` FROM " . $this->tb_encounter . " WHERE encounter_nr=".$enc;
			$W = $db->Execute($sql);
			if ($r = $W->FetchRow()){
				$rh = $r[0].'|'.$r[1];
				$dh = $r[2].'|'.$r[3];
			}
			$sql="UPDATE " . $this->tb_encounter . " SET room = '".$rm."',`room_history`='".$rh."',`current_dept_history`='".$dh."' WHERE encounter_nr=".$enc;
		    $db->Execute($sql);

		}

		function PrintPatientHistory(){

		 	for($i=1; $i<5; $i++)
			echo '<tr>
		            <td width="15%" bgcolor="#D2DFD0" style="border-top:1px solid black;" valign="top"><strong>Diagnosis '.$i.'</strong></td>
		            <td width="85%" style="border-top:1px solid black;">lasjdf askdjf; alsfj <br ><br><br> lasjdfl</td>
		          </tr>';

		}

		function GetPreviousVisit($n,$id){
			global $db;
			$n = ($n!='')?$n:'-1';
			$sql="SELECT encounter_nr FROM " . $this->tb_encounter . " WHERE pid=$id AND encounter_nr<$n order by encounter_nr ASC LIMIT 1";
		    $hb = $db->Execute($sql);
		    if($rw = $hb->FetchRow())
				$v = $rw[0];

			if ($v>0) return  array($v,1);
			else return array($n,0);
		}

		function room_GetVisits($rm){
			global $db;
			$rm = ($rm!='')?$rm:'GENERAL';
			$sum = '';

			$s = 'SELECT attend FROM '.$this->tb_doctor_history. ' ' .
							' WHERE ' .
							' date like "'.$this->Dates.'%" ' .
							' AND (room like "%'.$rm.'%") ' .
							' AND  (dept ='.$this->dept.')';

			$u = $db->Execute($s);

			if ($p = $u->FetchRow())
				$sum +=$p[0];

			return $sum;

		}

		# creates all encounter of $this->Dates
		function create_visits($kn,$rm){
			global $db;
			$this->enc = array();

			$s = 'SELECT encounter_nr FROM '.$this->tb_encounter. ' ' .
							' WHERE encounter_date like "'.$this->Dates.'%"';

			if ($u = $db->Execute($s))
				while($m = $u->FetchRow())
					$this->enc[] = $m[0];
		}

		# creates all encounter of using PID
		function get_5_visits($nr){
			global $db;
			$enc = array();

			$s = 'SELECT encounter_nr FROM '.$this->tb_encounter. ' ' .
							' WHERE pid = '.$nr.' ORDER BY encounter_nr DESC LIMIT 5';

			if ($u = $db->Execute($s))
				while($m = $u->FetchRow())
					$enc[] = $m[0];

			return $enc;
		}

		function doctors_attend_patients($str){
			global $db;
			$all = '---';

			if ($str!=''){
				$sql = 'SELECT doctor,attend FROM '.$this->tb_doctor_history.' ' .
							'WHERE ((date LIKE "'.$this->Dates.'%") AND ' .
								   ' (room="'.$str.'" ) AND ' .
								   ' (dept LIKE "'.$this->dept.'%"))';
				$y = $db->Execute($sql);

				while($E=$y->FetchRow())
					$user[$E[0]] += $E[1];


			}

			$all = (count($user)>0)?'':$all;

			foreach($user as $h => $k)
				$all .= (count($user)>0)?'<FONT color="red"> ['.$user[$h].']</font> '.$h.'<br />': '';

			return $all;

		}

		/**
		 *
		 * HOSPITAL ROOM SEARCHING REPORT
		 *
		 */

		function GetRowsFromRooming($var,$ca,$cb,$action,$dept){
			global $db;

			extract($var);

			$cc='0';
			$toto = 0;
			$nipo = FALSE;

			 echo '<table width="' .
				  '' .
				  '' ;
					($print == '1') ? print '95%' : print '70%';

			echo  '" border="0" align="left" cellpadding="5" cellspacing="1" class="tablebg">
				    <tr class="searchtxthead" id="rowhead" valign="middle">
				      <td width="15%" align="center" height="25" nowrap>Date</td>
				      <td width="15%" align="center" nowrap>Room Name</td>
				      <td width="10%" align="center" nowrap>Patients Attended</td>
				      <td width="30%" align="center" nowrap>Doctors Assigned</td>
				      <td width="30%" align="center" nowrap>Doctors Attend</td>
				    </tr>';

			$nim = 0;

			if ($dpt!=''){
		        $nim = cal_days_in_month(CAL_GREGORIAN, $mnth, $yrs);
		        $this->dept = $dpt;
		        $this->room_display = '*'; # return all fields
				$nim++;
				$zz = 1;
				$vc = 1;
				$oo = 1;
				$psd = array();
		        while($zz!=$nim):
		        	$dat = (($zz<10)?'0'.$zz:$zz).'/'.$mnth.'/'.$yrs;
		        	$this->Dates = $yrs . '-' . $mnth . '-' . (($zz<10)?'0'.$zz:$zz);
		        	$qr = $this->GetRoomsAssigned($dpt);

		        	# GENERAL
					$nr = $this->room_GetVisits('GENERAL');
					$attend = $this->doctors_attend_patients('GENERAL');
					echo
					   '<!--<tr valign="middle" class="'.(($oo==1)?$ca:$cb).'">
					      <td align="center" valign="top" nowrap>'.$dat.'</td>
					      <td align="center" valign="top" nowrap>General</td>
					      <td align="center" valign="top" nowrap>'.$nr.'</td>
					      <td align="center" valign="top" nowrap>---</td>
					      <td align="left" valign="top" nowrap>'  .$attend.'</td>
					    </tr>-->';

					$oo = ($oo==1)?2:1;

		        	if ($qr->RecordCount()>0){
		        		while($rw=$qr->FetchRow()){
							$nr = $this->room_GetVisits($rw[0]);
							$attend= $this->doctors_attend_patients($rw[0]);
							echo
							   '<tr valign="middle" class="'.(($oo==1)?$ca:$cb).'">
							      <td align="center" valign="top" nowrap>&raquo;</td>
							      <td align="center" valign="top" nowrap>'.$rw['name'].'</td>
							      <td align="center" valign="top" nowrap>'.$nr.   '</td>
							      <td align="left" valign="top" nowrap>'  .$users.'</td>
					      		  <td align="left" valign="top" nowrap>'  .$attend.'</td>
							    </tr>';
							$vc++;
							$oo = ($oo==1)?2:1;
		        		}
		        	}
					$zz++;
				endwhile;
			}

		   echo ' <tr style="font:normal 12px Tahoma, monospace; color:black; " bgcolor="#DEFDD9">
		  			<td colspan=5 align="center" valign="middle">' .
				    	((($vc==1)&&($dept!=''))?'<span style="color:red; font:bold 17px Tahoma;">NO ONE ATTEND A PATIENT</span>':' SELECT OPTIONS ABOVE ') .
			    	'</td>
			  </tr>
			</table>';

		}

		function doctorSTAT($docn,$id){
			global $db;
			$p    = '';
			$in4  = $this->load_Encounter_info($id);
			$room = $in4['room'];

			$this->docname = $docn;
			$this->docdept = $in4['current_dept_nr'];

			if (($room!='')&&($id!='')&&($this->docname!='')&&($this->docdept!='')){
				$g = $db->Execute("SELECT * FROM ".$this->tb_docHistory." " .
										"where date='".date('Y-m-d')."' AND " .
											  " doctor='".$this->docname."' AND " .
											  " dept=".$this->docdept." AND " .
											  " room='".$room."'");


				if ($g->RecordCount()<1){
					# create new row for docname
					$sq = $db->execute("INSERT INTO ".$this->tb_docHistory."
									(`date` ,`doctor` ,`dept` ,`room` ,`attend` ,`patients`)
										VALUES ('".date('Y-m-d')."',
											'".$this->docname."',
											'".$this->docdept."',
											'".$room."',
											'1',
											'".$id."');");

					# ' ' ' '
				}else {
					$dv = $g->FetchRow();
					$yy = explode('|',$dv['patients']);

					if (in_array($id,$yy)) return '';
					else {
						$dv['attend']++;
						$p = ($dv['patients']!='')?$dv['patients'].'|'.$id:$id;
						$db->execute('UPDATE '.$this->tb_docHistory.' SET attend='.$dv['attend'].', patients="'.$p.'" '.
										" where date='".date('Y-m-d')."' AND " .
											  " doctor='".$this->docname."' AND " .
											  " dept=".$this->docdept." AND " .
											  " room='".$room."' ");


					}
				}
			}
			#''
		}

		function load_Encounter_info($wn){
			global $db;
			if (intval($wn)){
				$y = $db->Execute('SELECT * FROM '.$this->tb_encounter.' where encounter_nr='.$wn.' LIMIT 1');
				print mysql_error();
				return $y->FetchRow();
			}
		}

		function Affect($i,$k){
			global $db;
			return false;
			#''

		}


		/*get user list (sys conf)*/
		function has_notes($enc){
			global $db;
			if ($enc!=''){
				$sql="SELECT count(*) FROM " . $this->tb_notes . " WHERE encounter_nr=".$enc;
			    $o = $db->Execute($sql);
				if ($v=$o->FetchRow())
					return $v[0]; # done;
				else return 0;
			} else return 0;
		}

		function CheckDiagnosis($enc){
			global $db;
			if ($enc!=''){
				$sql="SELECT count(*) FROM " . $this->tb_diagnosis . " WHERE encounter_nr=".$enc;
			    $o = $db->Execute($sql);
				if ($v=$o->FetchRow())
					return $v[0]; # done;
				else return 0;
			} else return 0;
		}

		function dateDiff($dateTimeBegin, $dateTimeEnd){
			$arBegin = getdate(strtotime($dateTimeBegin));
			$dateBegin = mktime(0, 0, 0, $arBegin["mon"], $arBegin["mday"], $arBegin["year"]);

			$arEnd = getdate(strtotime($dateTimeEnd));
			$dateEnd = mktime(0, 0, 0, $arEnd["mon"], $arEnd["mday"], $arEnd["year"]);

			$df = $dateEnd - $dateBegin;

			return floor($df/(60*60*24));
		}



		function GetRegionName($id){
			global $db;
			if ($id!=''){
				$sql="SELECT region_name FROM " . $this->tb_region . " WHERE region_id=".$id." ORDER BY region_id desc LIMIT 1";
			    $o = $db->Execute($sql);
			    print mysql_error();
				if ($v=$o->FetchRow())
					return $v[0]; # gat u right;
				else return $this->notin;
			} else return $this->notin;
		}

		function GetDistrictName($id) {
			global $db;
			if ($id!=''){
				$sql="SELECT district_name FROM " . $this->tb_district. " WHERE id = ".$id;
			    $o = $db->Execute($sql);
			    print mysql_error();
				if ($v=$o->FetchRow())
					return $v[0]; # gat u;
				else return $this->notin;
			} else return $this->notin;
		}

		function GetCountyName($id) {
                        global $db;
                        if ($id!=''){
                                $sql="SELECT county FROM " . $this->tb_county. " WHERE id = ".$id;
                            $o = $db->Execute($sql);
                            print mysql_error();
                                if ($v=$o->FetchRow())
                                        return $v[0]; # gat u;
                                else return $this->notin;
                        } else return $this->notin;
                }
		function GetSubCountyName($id) {
                        global $db;
                        if ($id!=''){
                                $sql="SELECT subcounty FROM " . $this->tb_subcounty. " WHERE id = ".$id;
                            $o = $db->Execute($sql);
                            print mysql_error();
                                if ($v=$o->FetchRow())
                                        return $v[0]; # gat u;
                                else return $this->notin;
                        } else return $this->notin;
                }
		function GetParishName($id) {
                        global $db;
                        if ($id!=''){
                                $sql="SELECT parish FROM " . $this->tb_parish. " WHERE id = ".$id;
                            $o = $db->Execute($sql);
                            print mysql_error();
                                if ($v=$o->FetchRow())
                                        return $v[0]; # gat u;
                                else return $this->notin;
                        } else return $this->notin;
                }
		function GetVillageName($id) {
                        global $db;
                        if ($id!=''){
                                $sql="SELECT village FROM " . $this->tb_village. " WHERE id = ".$id;
                            $o = $db->Execute($sql);
                            print mysql_error();
                                if ($v=$o->FetchRow())
                                        return $v[0]; # gat u;
                                else return $this->notin;
                        } else return $this->notin;
                }

		function GetWardName($id){
			global $db;
			if ($id!=''){
				$sql="SELECT ward_name FROM " . $this->tb_ward . " WHERE ward_id=".$id." ORDER BY ward_id desc LIMIT 1";
			    $o = $db->Execute($sql);
			    print mysql_error();
				if ($v=$o->FetchRow())
					return $v[0]; # gat u;
				else return $this->notin;
			} else return $this->notin;
		}
	}
?>
