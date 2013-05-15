<?php
$source_host="localhost";
$source_user="root";
$source_password="";
$source_dbname="caredb";
$source_dbtyp="mysql";

$des_host="localhost";
$des_user="root";
$des_password="";
$des_dbname="caredb";
$des_dbtyp="mysql";

$conn_source = &ADONewConnection($source_dbtyp);
$conn_des = &ADONewConnection($des_dbtyp);

$conn_des->PConnect($des_host, $des_user, $des_password, $des_dbname);
$conn_source->PConnect($source_host, $source_user, $source_password, $source_dbname);
?>