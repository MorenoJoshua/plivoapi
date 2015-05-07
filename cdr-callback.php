<?php
include("inc/conn.php");


$month = date ("m");
$daynumber = date ("d");
$year = date ("Y");
$date = ("$year$month$daynumber");

$hours = date ("G");
$minutes = date ("i");
$seconds = date ("s");
$time = ("$hours$minutes$seconds");

$CallUUID = addslashes($_POST['CallUUID']);
$cFrom = addslashes($_POST['From']);
$cTo = addslashes($_POST['To']);
$ForwardedFrom = addslashes($_POST['ForwardedFrom']);
$CallStatus = addslashes($_POST['CallStatus']);
$Direction = addslashes($_POST['Direction']);
$ALegUUID = addslashes($_POST['ALegUUID']);
$ALegRequestUUID = addslashes($_POST['ALegRequestUUID']);
$Duration = addslashes($_POST['Duration']);
$BillDuration = addslashes($_POST['BillDuration']);


$sql = "INSERT INTO plivocdr 
(CallUUID, 
cFrom, 
cTo, 
ForwardedFrom, 
CallStatus, 
Direction, 
ALegUUID, 
ALegRequestUUID, 
Duration, 
BillDuration) 

VALUES 

('$CallUUID', 
'$cFrom', 
'$cTo', 
'$ForwardedFrom', 
'$CallStatus', 
'$Direction', 
'$ALegUUID', 
'$ALegRequestUUID', 
'$Duration', 
'$BillDuration') ";

$res = mysql_query($sql) or die(mysql_error());


?>