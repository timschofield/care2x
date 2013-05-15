<?php

//TODO: (Prakash) Why you do not extends from encounter? Then you would have many work still done ADOdb e.g.
// require_once($root_path.'include/care_api_classes/class_encounter.php');
// class eyeclinic extends encounter
// instead of:
class eyeclinic
{
   var $host;
   var $user;
   var $password;
   var $db;
   var $connection;
   var $vart1;
   var $vart2;
   var $vart3;
   var $valt1;
   var $valt2;
   var $valt3;
   var $iprt1;
   var $iplt1;
   var $ipt2;
   var $pid;
   var $tr1;
   var $signataure;




   /* Class constructor */
   function _construct(){



   }


   //TODO (Prakash) Please disable that: We are using ADOdb. Do not use mysql_connect - it will give trouble by PHP5 and its future
   function dbconnect(){
         $this->connection=mysql_connect("localhost","root","")or die(mysql_error());
         return $this->connection;
   }

   //TODO: (Prakash) please use ADOdb - no mysql_select_db - change it
   function dbselect(){
       $dbselect=mysql_select_db("caredb",$this->connection);
       return $dbselect;
   }

   	  // TODO: (Prakash) you can kick out that. We have from class_code the Execute(SQLCommand) what is doing exactley the same

	  //excuting any query
	  function query($sql){
	  	$query=mysql_query($sql)or die(mysql_error());
	  return $query;
	  }

	  //TODO: (Prakash) are these not private methods? Then put either "private" in front or a prefix "_" like "function _setvart1($vart1){"

	  //setting visual acuity test attributes and getting them
	  function setvart1($vart1){
	  $this->vart1=$vart1;
	  }
	  function getvart1(){
	  return $this->vart1;
	  }
	  function setvart2($vart2){
	  $this->vart2=$vart2;
	  }
	  function getvart2(){
	  return $this->vart2;
	  }
	  function setvart3($vart3){
	  $this->vart3=$vart3;
	  }
	  function getvart3(){
	  return $this->vart3;
	  }
	  function setvalt1($valt1){
	  $this->valt1=$valt1;
	  }
	  function getvalt1(){
	  return $this->valt1;
	  }
	  function setvalt2($valt2){
	  $this->valt2=$valt2;
	  }
	  function getvalt2(){
	  return $this->valt2;
	  }
	   function setvalt3($valt3){
	  $this->valt3=$valt3;
	  }
	  function getvalt3(){
	  return $this->valt3;
	  }
	   function setiprt1($iprt1){
	  $this->iprt1=$iprt1;
	  }
	  function getiprt1(){
	  return $this->iprt1;
	  }
	   function setiplt1($iplt1){
	  $this->iplt1=$iplt1;
	  }
	  function getiplt1(){
	  return $this->iplt1;
	  }
	  function setipt2($ipt2){
	  $this->ipt2=$ipt2;
	  }
	  function getipt2(){
	  return $this->ipt2;
	  }

	   function setfoosrt1($foosrt1){
	  $this->foosrt1=$foosrt1;
	  }
	  function getfoosrt1(){
	  return $this->foosrt1;
	  }
	   function setfooslt1($fooslt1){
	  $this->fooslt1=$fooslt1;
	  }
	  function getfooslt1(){
	  return $this->fooslt1;
	  }

	   function setfoosrt2($foosrt2){
	  $this->foosrt2=$foosrt2;
	  }
	  function getfoosrt2(){
	  return $this->foosrt2;
	  }
	   function setfooslt2($fooslt2){
	  $this->fooslt2=$fooslt2;
	  }
	  function getfooslt2(){
	  return $this->fooslt2;
	  }


	   function setfoosrt3($foosrt3){
	  $this->foosrt3=$foosrt3;
	  }
	  function getfoosrt3(){
	  return $this->foosrt3;
	  }
	   function setfooslt3($fooslt3){
	  $this->fooslt3=$fooslt3;
	  }
	  function getfooslt3(){
	  return $this->fooslt3;
	  }

	   function setfoosrt4($foosrt4){
	  $this->foosrt4=$foosrt4;
	  }
	  function getfoosrt4(){
	  return $this->foosrt4;
	  }
	   function setfooslt4($fooslt4){
	  $this->fooslt4=$fooslt4;
	  }
	  function getfooslt4(){
	  return $this->fooslt4;
	  }


	   function setfoosrt5($foosrt5){
	  $this->foosrt5=$foosrt5;
	  }
	  function getfoosrt5(){
	  return $this->foosrt5;
	  }
	  	   function setfooslt5($fooslt5){
	  $this->fooslt5=$fooslt5;
	  }
	  function getfooslt5(){
	  return $this->fooslt5;
	  }

	   function setfoosrt6($foosrt6){
	  $this->foosrt6=$foosrt6;
	  }
	  function getfoosrt6(){
	  return $this->foosrt6;
	  }
	   function setfooslt6($fooslt6){
	  $this->fooslt6=$fooslt6;
	  }
	  function getfooslt6(){
	  return $this->fooslt6;
	  }

	   function setfoosrt7($foosrt7){
	  $this->foosrt7=$foosrt7;
	  }
	  function getfoosrt7(){
	  return $this->foosrt7;
	  }
	   function setfooslt7($fooslt7){
	  $this->fooslt7=$fooslt7;
	  }
	  function getfooslt7(){
	  return $this->fooslt7;
	  }


	   function setprt1($prt1){
	  $this->prt1=$prt1;
	  }
	  function getprt1(){
	  return $this->prt1;
	  }
	   function setplt1($plt1){
	  $this->plt1=$plt1;
	  }
	  function getplt1(){
	  return $this->plt1;
	  }

	   function setprt2($prt2){
	  $this->prt2=$prt2;
	  }
	  function getprt2(){
	  return $this->prt2;
	  }
	   function setplt2($plt2){
	  $this->plt2=$plt2;
	  }
	  function getplt2(){
	  return $this->plt2;
	  }


	   function setprt3($prt3){
	  $this->prt3=$prt3;
	  }
	  function getprt3(){
	  return $this->prt3;
	  }
	   function setplt3($plt3){
	  $this->plt3=$plt3;
	  }
	  function getplt3(){
	  return $this->plt3;
	  }

	   function setprt4($prt4){
	  $this->prt4=$prt4;
	  }
	  function getprt4(){
	  return $this->prt4;
	  }
	   function setplt4($plt4){
	  $this->plt4=$plt4;
	  }
	  function getplt4(){
	  return $this->plt4;
	  }


	   function setprt5($prt5){
	  $this->prt5=$prt5;
	  }
	  function getprt5(){
	  return $this->prt5;
	  }
	  	   function setplt5($plt5){
	  $this->plt5=$plt5;
	  }
	  function getplt5(){
	  return $this->plt5;
	  }

	   function setprt6($prt6){
	  $this->prt6=$prt6;
	  }
	  function getprt6(){
	  return $this->prt6;
	  }
	   function setplt6($plt6){
	  $this->plt6=$plt6;
	  }
	  function getplt6(){
	  return $this->plt6;
	  }

	   function setprt7($prt7){
	  $this->prt7=$prt7;
	  }
	  function getprt7(){
	  return $this->prt7;
	  }
	   function setplt7($plt7){
	  $this->plt7=$plt7;
	  }
	  function getplt7(){
	  return $this->plt7;
	  }




function setssrt1($ssrt1){
	  $this->ssrt1=$ssrt1;
	  }
	  function getssrt1(){
	  return $this->ssrt1;
	  }
	   function setsslt1($sslt1){
	  $this->sslt1=$sslt1;
	  }
	  function getsslt1(){
	  return $this->sslt1;
	  }

	   function setssrt2($ssrt2){
	  $this->ssrt2=$ssrt2;
	  }
	  function getssrt2(){
	  return $this->ssrt2;
	  }
	   function setsslt2($sslt2){
	  $this->sslt2=$sslt2;
	  }
	  function getsslt2(){
	  return $this->sslt2;
	  }


	   function setssrt3($ssrt3){
	  $this->ssrt3=$ssrt3;
	  }
	  function getssrt3(){
	  return $this->ssrt3;
	  }
	   function setsslt3($sslt3){
	  $this->sslt3=$sslt3;
	  }
	  function getsslt3(){
	  return $this->sslt3;
	  }

	   function setssrt4($ssrt4){
	  $this->ssrt4=$ssrt4;
	  }
	  function getssrt4(){
	  return $this->ssrt4;
	  }
	   function setsslt4($sslt4){
	  $this->sslt4=$sslt4;
	  }
	  function getsslt4(){
	  return $this->sslt4;
	  }


	   function setssrt5($ssrt5){
	  $this->ssrt5=$ssrt5;
	  }
	  function getssrt5(){
	  return $this->ssrt5;
	  }
	  	   function setsslt5($sslt5){
	  $this->sslt5=$sslt5;
	  }
	  function getsslt5(){
	  return $this->sslt5;
	  }

	   function settrt1($trt1){
	  $this->trt1=$trt1;
	  }
	  function gettrt1(){
	  return $this->trt1;
	  }
	  	   function settl1($tl1){
	  $this->tl1=$tl1;
	  }
	  function gettl1(){
	  return $this->tl1;
	  }

function settrt2($trt2){
	  $this->trt2=$trt2;
	  }
	  function gettrt2(){
	  return $this->trt2;
	  }
	  	   function settl2($tl2){
	  $this->tl2=$tl2;
	  }
	  function gettl2(){
	  return $this->tl2;
	  }

function settrt3($trt3){
	  $this->trt3=$trt3;
	  }
	  function gettrt3(){
	  return $this->trt3;
	  }
	  	   function settl3($tl3){
	  $this->tl3=$tl3;
	  }
	  function gettl3(){
	  return $this->tl3;
	  }

	  function settrt4($trt4){
	  $this->trt4=$trt4;
	  }
	  function gettrt4(){
	  return $this->trt4;
	  }
	  	   function settl4($tl4){
	  $this->tl4=$tl4;
	  }
	  function gettl4(){
	  return $this->tl4;
	  }
	  function settrt5($trt5){
	  $this->trt5=$trt5;
	  }
	  function gettrt5(){
	  return $this->trt5;
	  }
	  	   function settl5($tl5){
	  $this->tl5=$tl5;
	  }
	  function gettl5(){
	  return $this->tl5;
	  }
	  function settrt6($trt6){
	  $this->trt6=$trt6;
	  }
	  function gettrt6(){
	  return $this->trt6;
	  }
	  	   function settl6($tl6){
	  $this->tl6=$tl6;
	  }
	  function gettl6(){
	  return $this->tl6;
	  }
	  function settrt7($trt7){
	  $this->trt7=$trt7;
	  }
	  function gettrt7(){
	  return $this->trt7;
	  }
	  	   function settl7($tl7){
	  $this->tl7=$tl7;
	  }
	  function gettl7(){
	  return $this->tl7;
	  }
	  function settrt8($trt8){
	  $this->trt8=$trt8;
	  }
	  function gettrt8(){
	  return $this->trt8;
	  }
	  	   function settl8($tl8){
	  $this->tl8=$tl8;
	  }
	  function gettl8(){
	  return $this->tl8;
	  }
	  function settrt9($trt9){
	  $this->trt9=$trt9;
	  }
	  function gettrt9(){
	  return $this->trt9;
	  }
	  	   function settl9($tl9){
	  $this->tl9=$tl9;
	  }
	  function gettl9(){
	  return $this->tl9;
	  }
	  function settr10($tr10){
	  $this->tr10=$tr10;
	  }
	  function gettr10(){
	  return $this->tr10;
	  }
	  	   function settl10($tl10){
	  $this->tl10=$tl10;
	  }
	  function gettl10(){
	  return $this->tl10;
	  }
	  function settr11($tr11){
	  $this->tr11=$tr11;
	  }
	  function gettr11(){
	  return $this->tr11;
	  }
	  	   function settl11($tl11){
	  $this->tl11=$tl11;
	  }
	  function gettl11(){
	  return $this->tl11;
	  }
	  function settr12($tr12){
	  $this->tr12=$tr12;
	  }
	  function gettr12(){
	  return $this->tr12;
	  }
	  	   function settl12($tl12){
	  $this->tl12=$tl12;
	  }
	  function gettl12(){
	  return $this->tl12;
	  }



	  function seter1($er1){
	  $this->er1=$er1;
	  }
	  function geter1(){
	  return $this->er1;
	  }
	  	   function setel1($el1){
	  $this->el1=$el1;
	  }
	  function getel1(){
	  return $this->el1;
	  }

	function seter2($er2){
	  $this->er2=$er2;
	  }
	  function geter2(){
	  return $this->er2;
	  }
	  	   function setel2($el2){
	  $this->el2=$el2;
	  }
	  function getel2(){
	  return $this->el2;
	  }

	function seter3($er3){
	  $this->er3=$er3;
	  }
	  function geter3(){
	  return $this->er3;
	  }
	  	   function setel3($el3){
	  $this->el3=$el3;
	  }
	  function getel3(){
	  return $this->el3;
	  }

function seter4($er4){
	  $this->er4=$er4;
	  }
	  function geter4(){
	  return $this->er4;
	  }
	  	   function setel4($el4){
	  $this->el4=$el4;
	  }
	  function getel4(){
	  return $this->el4;
	  }

function seter5($er5){
	  $this->er5=$er5;
	  }
	  function geter5(){
	  return $this->er5;
	  }
	  	   function setel5($el5){
	  $this->el5=$el5;
	  }
	  function getel5(){
	  return $this->el5;
	  }
function seter6($er6){
	  $this->er6=$er6;
	  }
	  function geter6(){
	  return $this->er6;
	  }
	  	   function setel6($el6){
	  $this->el6=$el6;
	  }
	  function getel6(){
	  return $this->el6;
	  }
function seter7($er7){
	  $this->er7=$er7;
	  }
	  function geter7(){
	  return $this->er7;
	  }
	  	   function setel7($el7){
	  $this->el7=$el7;
	  }
	  function getel7(){
	  return $this->el7;
	  }

function seter8($er8){
	  $this->er8=$er8;
	  }
	  function geter8(){
	  return $this->er8;
	  }
	  	   function setel8($el8){
	  $this->el8=$el8;
	  }
	  function getel8(){
	  return $this->el8;
	  }

	function seter9($er9){
	  $this->er9=$er9;
	  }
	  function geter9(){
	  return $this->er9;
	  }
	  	   function setel9($el9){
	  $this->el9=$el9;
	  }
	  function getel9(){
	  return $this->el9;
	  }



	function setcr1($cr1){
	  $this->cr1=$cr1;
	  }
	  function getcr1(){
	  return $this->cr1;
	  }
	  	   function setcl1($cl1){
	  $this->cl1=$cl1;
	  }
	  function getcl1(){
	  return $this->cl1;
	  }


	function setcr2($cr2){
	  $this->cr2=$cr2;
	  }
	  function getcr2(){
	  return $this->cr2;
	  }
	  	   function setcl2($cl2){
	  $this->cl2=$cl2;
	  }
	  function getcl2(){
	  return $this->cl2;
	  }

	function setcr3($cr3){
	  $this->cr3=$cr3;
	  }
	  function getcr3(){
	  return $this->cr3;
	  }
	  	   function setcl3($cl3){
	  $this->cl3=$cl3;
	  }
	  function getcl3(){
	  return $this->cl3;
	  }

	function setcr4($cr4){
	  $this->cr4=$cr4;
	  }
	  function getcr4(){
	  return $this->cr4;
	  }
	  	   function setcl4($cl4){
	  $this->cl4=$cl4;
	  }
	  function getcl4(){
	  return $this->cl4;
	  }

	function setcr5($cr5){
	  $this->cr5=$cr5;
	  }
	  function getcr5(){
	  return $this->cr5;
	  }
	  	   function setcl5($cl5){
	  $this->cl5=$cl5;
	  }
	  function getcl5(){
	  return $this->cl5;
	  }
	function setcr6($cr6){
	  $this->cr6=$cr6;
	  }
	  function getcr6(){
	  return $this->cr6;
	  }
	  	   function setcl6($cl6){
	  $this->cl6=$cl6;
	  }
	  function getcl6(){
	  return $this->cl6;
	  }

	function setcr7($cr7){
	  $this->cr7=$cr7;
	  }
	  function getcr7(){
	  return $this->cr7;
	  }
	  	   function setcl7($cl7){
	  $this->cl7=$cl7;
	  }
	  function getcl7(){
	  return $this->cl7;
	  }

	function setcr8($cr8){
	  $this->cr8=$cr8;
	  }
	  function getcr8(){
	  return $this->cr8;
	  }
	  	   function setcl8($cl8){
	  $this->cl8=$cl8;
	  }
	  function getcl8(){
	  return $this->cl8;
	  }




	function setcor1($cor1){
	  $this->cor1=$cor1;
	  }
	  function getcor1(){
	  return $this->cor1;
	  }
	  	   function setcol1($col1){
	  $this->col1=$col1;
	  }
	  function getcol1(){
	  return $this->col1;
	  }


	function setcor2($cor2){
	  $this->cor2=$cor2;
	  }
	  function getcor2(){
	  return $this->cor2;
	  }
	  	   function setcol2($col2){
	  $this->col2=$col2;
	  }
	  function getcol2(){
	  return $this->col2;
	  }

	function setcor3($cor3){
	  $this->cor3=$cor3;
	  }
	  function getcor3(){
	  return $this->cor3;
	  }
	  	   function setcol3($col3){
	  $this->col3=$col3;
	  }
	  function getcol3(){
	  return $this->col3;
	  }

	function setcor4($cor4){
	  $this->cor4=$cor4;
	  }
	  function getcor4(){
	  return $this->cor4;
	  }
	  	   function setcol4($col4){
	  $this->col4=$col4;
	  }
	  function getcol4(){
	  return $this->col4;
	  }

	function setcor5($cor5){
	  $this->cor5=$cor5;
	  }
	  function getcor5(){
	  return $this->cor5;
	  }
	  	   function setcol5($col5){
	  $this->col5=$col5;
	  }
	  function getcol5(){
	  return $this->col5;
	  }
	function setcor6($cor6){
	  $this->cor6=$cor6;
	  }
	  function getcor6(){
	  return $this->cor6;
	  }
	  	   function setcol6($col6){
	  $this->col6=$col6;
	  }
	  function getcol6(){
	  return $this->col6;
	  }

	function setcor7($cor7){
	  $this->cor7=$cor7;
	  }
	  function getcor7(){
	  return $this->cor7;
	  }
	  	   function setcol7($col7){
	  $this->col7=$col7;
	  }
	  function getcol7(){
	  return $this->col7;
	  }


	function setacr1($acr1){
	  $this->acr1=$acr1;
	  }
	  function getacr1(){
	  return $this->acr1;
	  }
	  	   function setacl1($acl1){
	  $this->acl1=$acl1;
	  }
	  function getacl1(){
	  return $this->acl1;
	  }


	function setacr2($acr2){
	  $this->acr2=$acr2;
	  }
	  function getacr2(){
	  return $this->acr2;
	  }
	  	   function setacl2($acl2){
	  $this->acl2=$acl2;
	  }
	  function getacl2(){
	  return $this->acl2;
	  }

	function setacr3($acr3){
	  $this->acr3=$acr3;
	  }
	  function getacr3(){
	  return $this->acr3;
	  }
	  	   function setacl3($acl3){
	  $this->acl3=$acl3;
	  }
	  function getacl3(){
	  return $this->acl3;
	  }

	function setacr4($acr4){
	  $this->acr4=$acr4;
	  }
	  function getacr4(){
	  return $this->acr4;
	  }
	  	   function setacl4($acl4){
	  $this->acl4=$acl4;
	  }
	  function getacl4(){
	  return $this->acl4;
	  }

	function setacr5($acr5){
	  $this->acr5=$acr5;
	  }
	  function getacr5(){
	  return $this->acr5;
	  }
	  	   function setacl5($acl5){
	  $this->acl5=$acl5;
	  }
	  function getacl5(){
	  return $this->acl5;
	  }
	function setacr6($acr6){
	  $this->acr6=$acr6;
	  }
	  function getacr6(){
	  return $this->acr6;
	  }
	  	   function setacl6($acl6){
	  $this->acl6=$acl6;
	  }
	  function getacl6(){
	  return $this->acl6;
	  }

	function setacr7($acr7){
	  $this->acr7=$acr7;
	  }
	  function getacr7(){
	  return $this->acr7;
	  }
	  	   function setacl7($acl7){
	  $this->acl7=$acl7;
	  }
	  function getacl7(){
	  return $this->acl7;
	  }


function setlr1($lr1){
	  $this->lr1=$lr1;
	  }
	  function getlr1(){
	  return $this->lr1;
	  }
	  	   function setll1($ll1){
	  $this->ll1=$ll1;
	  }
	  function getll1(){
	  return $this->ll1;
	  }

function setlr2($lr2){
	  $this->lr2=$lr2;
	  }
	  function getlr2(){
	  return $this->lr2;
	  }
	  	   function setll2($ll2){
	  $this->ll2=$ll2;
	  }
	  function getll2(){
	  return $this->ll2;
	  }

function setlr3($lr3){
	  $this->lr3=$lr3;
	  }
	  function getlr3(){
	  return $this->lr3;
	  }
	  	   function setll3($ll3){
	  $this->ll3=$ll3;
	  }
	  function getll3(){
	  return $this->ll3;
	  }
function setlr4($lr4){
	  $this->lr4=$lr4;
	  }
	  function getlr4(){
	  return $this->lr4;
	  }
	  	   function setll4($ll4){
	  $this->ll4=$ll4;
	  }
	  function getll4(){
	  return $this->ll4;
	  }
function setlr5($lr5){
	  $this->lr5=$lr5;
	  }
	  function getlr5(){
	  return $this->lr5;
	  }
	  	   function setll5($ll5){
	  $this->ll5=$ll5;
	  }
	  function getll5(){
	  return $this->ll5;
	  }
function setlr6($lr6){
	  $this->lr6=$lr6;
	  }
	  function getlr6(){
	  return $this->lr6;
	  }
	  	   function setll6($ll6){
	  $this->ll6=$ll6;
	  }
	  function getll6(){
	  return $this->ll6;
	  }
function setlr7($lr7){
	  $this->lr7=$lr7;
	  }
	  function getlr7(){
	  return $this->lr7;
	  }
	  	   function setll7($ll7){
	  $this->ll7=$ll7;
	  }
	  function getll7(){
	  return $this->ll7;
	  }
function setlr8($lr8){
	  $this->lr8=$lr8;
	  }
	  function getlr8(){
	  return $this->lr8;
	  }
	  	   function setll8($ll8){
	  $this->ll8=$ll8;
	  }
	  function getll8(){
	  return $this->ll8;
	  }
function setlr9($lr9){
	  $this->lr9=$lr9;
	  }
	  function getlr9(){
	  return $this->lr9;
	  }
	  	   function setll9($ll9){
	  $this->ll9=$ll9;
	  }
	  function getll9(){
	  return $this->ll9;
	  }

function setpsr1($psr1){
	  $this->psr1=$psr1;
	  }
	  function getpsr1(){
	  return $this->psr1;
	  }
	  	   function setpsl1($psl1){
	  $this->psl1=$psl1;
	  }
	  function getpsl1(){
	  return $this->psl1;
	  }
function setpsr2($psr2){
	  $this->psr2=$psr2;
	  }
	  function getpsr2(){
	  return $this->psr2;
	  }
	  	   function setpsl2($psl2){
	  $this->psl2=$psl2;
	  }
	  function getpsl2(){
	  return $this->psl2;
	  }
function setpsr3($psr3){
	  $this->psr3=$psr3;
	  }
	  function getpsr3(){
	  return $this->psr3;
	  }
	  	   function setpsl3($psl3){
	  $this->psl3=$psl3;
	  }
	  function getpsl3(){
	  return $this->psl3;
	  }

function setpsr4($psr4){
	  $this->psr4=$psr4;
	  }
	  function getpsr4(){
	  return $this->psr4;
	  }
	  	   function setpsl4($psl4){
	  $this->psl4=$psl4;
	  }
	  function getpsl4(){
	  return $this->psl4;
	  }
function setpsr5($psr5){
	  $this->psr5=$psr5;
	  }
	  function getpsr5(){
	  return $this->psr5;
	  }
	  	   function setpsl5($psl5){
	  $this->psl5=$psl5;
	  }
	  function getpsl5(){
	  return $this->psl5;
	  }
function setpsr6($psr6){
	  $this->psr6=$psr6;
	  }
	  function getpsr6(){
	  return $this->psr6;
	  }
	  	   function setpsl6($psl6){
	  $this->psl6=$psl6;
	  }
	  function getpsl6(){
	  return $this->psl6;
	  }
function setpsr7($psr7){
	  $this->psr7=$psr7;
	  }
	  function getpsr7(){
	  return $this->psr7;
	  }
	  	   function setpsl7($psl7){
	  $this->psl7=$psl7;
	  }
	  function getpsl7(){
	  return $this->psl7;
	  }
function setpsr8($psr8){
	  $this->psr8=$psr8;
	  }
	  function getpsr8(){
	  return $this->psr8;
	  }
	  	   function setpsl8($psl8){
	  $this->psl8=$psl8;
	  }
	  function getpsl8(){
	  return $this->psl8;
	  }

function setpsr9($psr9){
	  $this->psr9=$psr9;
	  }
	  function getpsr9(){
	  return $this->psr9;
	  }
	  	   function setpsl9($psl9){
	  $this->psl9=$psl9;
	  }
	  function getpsl9(){
	  return $this->psl9;
	  }

function setodr1($odr1){
	  $this->odr1=$odr1;
	  }
	  function getodr1(){
	  return $this->odr1;
	  }
	  	   function setodl1($odl1){
	  $this->odl1=$odl1;
	  }
	  function getodl1(){
	  return $this->odl1;
	  }

function setodr2($odr2){
	  $this->odr2=$odr2;
	  }
	  function getodr2(){
	  return $this->odr2;
	  }
	  	   function setodl2($odl2){
	  $this->odl2=$odl2;
	  }
	  function getodl2(){
	  return $this->odl2;
	  }

function setodr3($odr3){
	  $this->odr3=$odr3;
	  }
	  function getodr3(){
	  return $this->odr3;
	  }
	  	   function setodl3($odl3){
	  $this->odl3=$odl3;
	  }
	  function getodl3(){
	  return $this->odl3;
	  }
function setodr4($odr4){
	  $this->odr4=$odr4;
	  }
	  function getodr4(){
	  return $this->odr4;
	  }
	  	   function setodl4($odl4){
	  $this->odl4=$odl4;
	  }
	  function getodl4(){
	  return $this->odl4;
	  }
function setodr5($odr5){
	  $this->odr5=$odr5;
	  }
	  function getodr5(){
	  return $this->odr5;
	  }
	  	   function setodl5($odl5){
	  $this->odl5=$odl5;
	  }
	  function getodl5(){
	  return $this->odl5;
	  }
	function setodr6($odr6){
	  $this->odr6=$odr6;
	  }
	  function getodr6(){
	  return $this->odr6;
	  }
	  function setodl6($odl6){
	  $this->odl6=$odl6;
	  }
	  function getodl6(){
	  return $this->odl6;
	  }



function sethis1e($his1e){
	  $this->his1e=$his1e;
	  }
	  function gethis1e(){
	  return $this->his1e;
	  }

function sethis1d($his1d){
	  $this->his1d=$his1d;
	  }
	  function gethis1d(){
	  return $this->his1d;
	  }

function sethis2e($his2e){
	  $this->his2e=$his2e;
	  }
	  function gethis2e(){
	  return $this->his2e;
	  }

function sethis2d($his2d){
	  $this->his2d=$his2d;
	  }
	  function gethis2d(){
	  return $this->his2d;
	  }


function sethis3e($his3e){
	  $this->his3e=$his3e;
	  }
	  function gethis3e(){
	  return $this->his3e;
	  }

function sethis3d($his3d){
	  $this->his3d=$his3d;
	  }
	  function gethis3d(){
	  return $this->his3d;
	  }


function sethis4e($his4e){
	  $this->his4e=$his4e;
	  }
	  function gethis4e(){
	  return $this->his4e;
	  }

function sethis4d($his4d){
	  $this->his4d=$his4d;
	  }
	  function gethis4d(){
	  return $this->his4d;
	  }

function sethis5e($his5e){
	  $this->his5e=$his5e;
	  }
	  function gethis5e(){
	  return $this->his5e;
	  }

function sethis5d($his5d){
	  $this->his5d=$his5d;
	  }
	  function gethis5d(){
	  return $this->his5d;
	  }

function sethis6e($his6e){
	  $this->his6e=$his6e;
	  }
	  function gethis6e(){
	  return $this->his6e;
	  }

function sethis6d($his6d){
	  $this->his6d=$his6d;
	  }
	  function gethis6d(){
	  return $this->his6d;
	  }


function sethis7e($his7e){
	  $this->his7e=$his7e;
	  }
	  function gethis7e(){
	  return $this->his7e;
	  }

function sethis7d($his7d){
	  $this->his7d=$his7d;
	  }
	  function gethis7d(){
	  return $this->his7d;
	  }




function sethid1($hid1){
	  $this->hid1=$hid1;
	  }
	  function gethid1(){
	  return $this->hid1;
	  }

function sethid2($hid2){
	  $this->hid2=$hid2;
	  }
	  function gethid2(){
	  return $this->hid2;
	  }

function sethid3($hid3){
	  $this->hid3=$hid3;
	  }
	  function gethid3(){
	  return $this->hid3;
	  }

function sethid4($hid4){
	  $this->hid4=$hid4;
	  }
	  function gethid4(){
	  return $this->hid4;
	  }

function sethid5($hid5){
	  $this->hid5=$hid5;
	  }
	  function gethid5(){
	  return $this->hid5;
	  }
function sethid6($hid6){
	  $this->hid6=$hid6;
	  }
	  function gethid6(){
	  return $this->hid6;
	  }

function sethid7($hid7){
	  $this->hid7=$hid7;
	  }
	  function gethid7(){
	  return $this->hid7;
	  }

function sethid8($hid8){
	  $this->hid8=$hid8;
	  }
	  function gethid8(){
	  return $this->hid8;
	  }


	   function setcomments($comments){
	  $this->comments=$comments;
	  }
	  function getcomments(){
	  return $this->comments;
	  }
	    function setsignature($signature){
	  $this->signature=$signature;
	  }
	  function getsignature(){
	  return $this->signature;
	  }
	    function setpid($pid){
	  $this->pid=$pid;
	  }
	  function getpid(){
	  return $this->pid;
	  }
	    function setsearch_keyword($searchkeyword){
	  	$this->keyword=$searchkeyword;

	  }
	  function setcriteria($searchcriteria){
	  	$this->criteria=$searchcriteria;
	  }
	  function getkeyword(){
	  	return $this->keyword;
	  }
      function getcriteria(){
      	return $this->criteria;
      }

      //TODO (Prakash) See above my comments on the other native interfaces what we should not use

      function fetch_object($results){

      	return mysql_fetch_object($results);
      }
      function recordcount($record){

      	return mysql_num_rows($record);
      }

	  //Add supplier info
   function addTest($pid,$vart1,$vart2,$vart3,$valt1,$valt2,$valt3,$comments,$signature)
	   {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_visualacuity  (pid,right_eye_test1,right_eye_test2,right_eye_test3,left_eye_test1,left_eye_test2,left_eye_test3,signature,examination_date)
	   VALUES ('$pid', '$vart1','$vart2','$vart3','$valt1','$valt2','$valt3','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest2($pid,$iprt1,$iplt1,$ipt2,$signature)
	   {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_intraocularpressure   (pid,right_eye_test1,left_eye_test1,test3,signature,examination_date)
	   VALUES ('$pid','$iprt1','$iplt1','$ipt2','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }


function addTest3($pid,$foosrt1,$fooslt1,$foosrt2,$fooslt2,$foosrt3,$fooslt3,$foosrt4,$fooslt4,$foosrt5,$fooslt5,$foosrt6,$fooslt6,$foosrt7,$fooslt7,$comments,$signature)
	   {
	   $date=Date('Y-m-d');
	   $sql1= "INSERT INTO care_tz_eye_facial_ocular_orbitalsymmetry (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,signature,examination_date)
	   VALUES ('$pid','$foosrt1','$fooslt1','$foosrt2','$fooslt2','$foosrt3','$fooslt3','$foosrt4','$fooslt4','$foosrt5','$fooslt5','$foosrt6','$fooslt6','$foosrt7','$fooslt7','$signature', '$date')";
       if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest4($pid,$prt1,$plt1,$prt2,$plt2,$prt3,$plt3,$prt4,$plt4,$prt5,$plt5,$prt6,$plt6,$prt7,$plt7,$comments,$signature)
	   {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_pupils (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,signature,examination_date)
	   VALUES ('$pid','$prt1','$plt1','$prt2','$plt2','$prt3','$plt3','$prt4','$plt4','$prt5','$plt5','$prt6','$plt6','$prt7','$plt7','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest5($pid,$ssrt1,$sslt1,$ssrt2,$sslt2,$ssrt3,$sslt3,$ssrt4,$sslt4,$ssrt5,$sslt5,$comments,$signature)
	   {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_squint_strabismus  (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,signature,examination_date)
	   VALUES ('$pid','$ssrt1','$sslt1','$ssrt2','$sslt2','$ssrt3','$sslt3','$ssrt4','$sslt4','$ssrt5','$sslt5','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest6($pid,$trt1,$tl1,$trt2,$tl2,$trt3,$tl3,$trt4,$tl4,$trt5,$tl5,$trt6,$tl6,$trt7,$tl7,$trt8,$tl8,$trt9,$tl9,$tr10,$tl10,$tr11,$tl11,$tr12,$tl12,$comments,$signature)	   {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_trauma   (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,right_eye_test8,left_eye_test8,right_eye_test9,left_eye_test9,right_eye_test10,left_eye_test10,right_eye_test11,left_eye_test11,right_eye_test12,left_eye_test12,signature,examination_date)
	   VALUES ('$pid','$trt1','$tl1','$trt2','$tl2','$trt3','$tl3','$trt4','$tl4','$trt5','$tl5','$trt6','$tl6','$trt7','$tl7','$trt8','$tl8','$trt9','$tl9','$tr10','$tl10','$tr11','$tl11','$tr12','$tl12','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest7($pid,$er1,$el1,$er2,$el2,$er3,$el3,$er4,$el4,$er5,$el5,$er6,$el6,$er7,$el7,$er8,$el8,$er9,$el9,$comments,$signature)  {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_eyelids    (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,right_eye_test8,left_eye_test8,right_eye_test9,left_eye_test9,signature,examination_date)
	   VALUES ('$pid','$er1','$el1','$er2','$el2','$er3','$el3','$er4','$el4','$er5','$el5','$er6','$el6','$er7','$el7','$er8','$el8','$er9','$el9','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest8($pid,$cr1,$cl1,$cr2,$cl2,$cr3,$cl3,$cr4,$cl4,$cr5,$cl5,$cr6,$cl6,$cr7,$cl7,$cr8,$cl8,$comments,$signature)  {
	   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_conjunctiva     (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,right_eye_test8,left_eye_test8,signature,examination_date)
	   VALUES ('$pid','$cr1','$cl1','$cr2','$cl2','$cr3','$cl3','$cr4','$cl4','$cr5','$cl5','$cr6','$cl6','$cr7','$cl7','$cr8','$cl8','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest9($pid,$cor1,$col1,$cor2,$col2,$cor3,$col3,$cor4,$col4,$cor5,$col5,$cor6,$col6,$cor7,$col7,$comments,$signature)  {
   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_cornea (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,signature,examination_date)
	   VALUES ('$pid','$cor1','$col1','$cor2','$col2','$cor3','$col3','$cor4','$col4','$cor5','$col5','$cor6','$col6','$cor7','$col7','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest10($pid,$acr1,$acl1,$acr2,$acl2,$acr3,$acl3,$acr4,$acl4,$acr5,$acl5,$acr6,$acl6,$acr7,$acl7,$comments,$signature)  {
   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_anterior_segment  (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,signature,examination_date)
	   VALUES ('$pid','$acr1','$acl1','$acr2','$acl2','$acr3','$acl3','$acr4','$acl4','$acr5','$acl5','$acr6','$acl6','$acr7','$acl7','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }


function addTest11($pid,$lr1,$ll1,$lr2,$ll2,$lr3,$ll3,$lr4,$ll4,$lr5,$ll5,$lr6,$ll6,$lr7,$ll7,$lr8,$ll8,$lr9,$ll9,$comments,$signature){
   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_lens   (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,right_eye_test8,left_eye_test8,right_eye_test9,left_eye_test9,signature,examination_date)
	   VALUES ('$pid','$lr1','$ll1','$lr2','$ll2','$lr3','$ll3','$lr4','$ll4','$lr5','$ll5','$lr6','$ll6','$lr7','$ll7','$lr8','$ll8','$lr9','$ll9','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest12($pid,$psr1,$psl1,$psr2,$psl2,$psr3,$psl3,$psr4,$psl4,$psr5,$psl5,$psr6,$psl6,$psr7,$psl7,$psr8,$psl8,$psr9,$psl9,$comments,$signature){
   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO Care_tz_eye_Posterior_segment  (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,right_eye_test7,left_eye_test7,right_eye_test8,left_eye_test8,right_eye_test9,left_eye_test9,signature,examination_date)
	   VALUES ('$pid','$psr1','$psl1','$psr2','$psl2','$psr3','$psl3','$psr4','$psl4','$psr5','$psl5','$psr6','$psl6','$psr7','$psl7','$psr8','$psl8','$psr9','$psl9','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addTest13($pid,$odr1,$odl1,$odr2,$odl2,$odr3,$odl3,$odr4,$odl4,$odr5,$odl5,$odr6,$odl6,$comments,$signature){
   	$date=Date('Y-m-d');
	 $sql1= "INSERT INTO care_tz_eye_optic_disc   (pid,right_eye_test1,left_eye_test1,right_eye_test2,left_eye_test2,right_eye_test3,left_eye_test3,right_eye_test4,left_eye_test4,right_eye_test5,left_eye_test5,right_eye_test6,left_eye_test6,signature,examination_date)
	   VALUES ('$pid','$odr1','$odl1','$odr2','$odl2','$odr3','$odl3','$odr4','$odl4','$odr5','$odl5','$odr6','$odl6','$signature', '$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }



function addHistory($pid,$hid1,$his1e,$his1d,$hid2,$his2e,$his2d,$hid3,$his3e,$his3d,$hid4,$his4e,$his4d,$hid5,$his5e,$his5d,$hid,$comments,$signature){
   	$date=Date('Y-m-d');
	  $sql1= "INSERT INTO care_tz_eye_history1(pid,hid1,hid1e,hid1d,hid2,hid2e,hid2d,hid3,hid3e,hid3d,hid4,hid4e,hid4d,hid5,hid5e,hid5d,hid6,signature,remarks,examination_date)
	   VALUES ('$pid','$hid1','$his1e','$his1d','$hid2','$his2e','$his2d','$hid3','$his3e','$his3d','$hid4','$his4e','$his4d','$hid5','$his5e','$his5d','$hid6','$signature','$remarks','$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addHistory2($pid,$hid1,$his1e,$his1d,$hid2,$his2e,$his2d,$hid3,$his3e,$his3d,$hid4,$his4e,$his4d,$hid5,$his5e,$his5d,$hid6,$his6e,$his6d,$hid7,$his7e,$his7d,$hid8,$comments,$signature){
   	$date=Date('Y-m-d');
	  $sql1= "INSERT INTO care_tz_eye_history2(pid,hid1,hid1e,hid1d,hid2,hid2e,hid2d,hid3,hid3e,hid3d,hid4,hid4e,hid4d,hid5,hid5e,hid5d,hid6,hid6e,hid6d,hid7,hid7e,hid7d,hid8,signature,remarks,examination_date)
	   VALUES ('$pid','$hid1','$his1e','$his1d','$hid2','$his2e','$his2d','$hid3','$his3e','$his3d','$hid4','$his4e','$his4d','$hid5','$his5e','$his5d','$hid6','$his6e','$his6d','$hid7','$his7e','$his7d','$hid8','$signature','$remarks','$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addHistory3($pid,$hid1,$his1e,$his1d,$hid2,$his2e,$his2d,$hid3,$his3e,$his3d,$hid4,$his4e,$his4d,$hid5,$his5e,$his5d,$hid6,$comments,$signature){
   	$date=Date('Y-m-d');
	  $sql1= "INSERT INTO care_tz_eye_history3(pid,hid1,hid1e,hid1d,hid2,hid2e,hid2d,hid3,hid3e,hid3d,hid4,hid4e,hid4d,hid5,hid5e,hid5d,hid6,signature,remarks,examination_date)
	   VALUES ('$pid','$hid1','$his1e','$his1d','$hid2','$his2e','$his2d','$hid3','$his3e','$his3d','$hid4','$his4e','$his4d','$hid5','$his5e','$his5d','$hid6','$signature','$remarks','$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addHistory4($pid,$hid1,$his1e,$his1d,$hid2,$his2e,$his2d,$hid3,$his3e,$his3d,$hid4,$his4e,$his4d,$hid5,$his5e,$his5d,$hid6,$his6e,$his6d,$hid7,$comments,$signature){
   	$date=Date('Y-m-d');
	  $sql1= "INSERT INTO care_tz_eye_history4(pid,hid1,hid1e,hid1d,hid2,hid2e,hid2d,hid3,hid3e,hid3d,hid4,hid4e,hid4d,hid5,hid5e,hid5d,hid6,hid6e,hid6d,hid7,signature,remarks,examination_date)
	   VALUES ('$pid','$hid1','$his1e','$his1d','$hid2','$his2e','$his2d','$hid3','$his3e','$his3d','$hid4','$his4e','$his4d','$hid5','$his5e','$his5d','$hid6','$his6e','$his6d','$hid7','$signature','$remarks','$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }

function addHistory5($pid,$hid1,$his1e,$his1d,$hid2,$his2e,$his2d,$hid3,$his3e,$his3d,$hid4,$his4e,$his4d,$hid5,$his5e,$his5d,$hid6,$his6e,$his6d,$hid7,$comments,$signature){
   	$date=Date('Y-m-d');
	  $sql1= "INSERT INTO care_tz_eye_history5(pid,hid1,hid1e,hid1d,hid2,hid2e,hid2d,hid3,hid3e,hid3d,hid4,hid4e,hid4d,hid5,hid5e,hid5d,hid6,hid6e,hid6d,hid7,signature,remarks,examination_date)
	   VALUES ('$pid','$hid1','$his1e','$his1d','$hid2','$his2e','$his2d','$hid3','$his3e','$his3d','$hid4','$his4e','$his4d','$hid5','$his5e','$his5d','$hid6','$his6e','$his6d','$hid7','$signature','$remarks','$date')";
      if($result=$this->query($sql1)){

		return true;
	  }
	  else{
	  return $result;
	  }
	   }


}
?>