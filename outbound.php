<?php
require 'plivo.php';
include("inc/conn.php");
$dst = $_REQUEST['ForwardTo'];
if(! $dst)
    $dst = $_REQUEST['To'];
$src = $_REQUEST['CLID'];
if(! $src)
    $src = $_REQUEST['From'] or "";
$cname = $_REQUEST['CallerName'] or "";
$hangup = $_REQUEST['HangupCause'];
$dial_music = $_REQUEST['DialMusic'];
$disable_call = $_REQUEST['DisableCall'];
$callid = $_REQUEST['CallUUID'];

$dstuser = "NA";
    
if($src == "sip:javier150430234233@phone.plivo.com") { $clid = "18583246776";}
if($src == "sip:josh150504145538@phone.plivo.com")	 { $clid = "18583714119";}
if($src == "sip:george150430230703@phone.plivo.com") { $clid = "18589098849";}
if($src == "sip:freddy150430230842@phone.plivo.com") { $clid = "18589098854";}
if($src == "sip:dave150430230938@phone.plivo.com")	 { $clid = "18589098852";}
if($src == "sip:eddy150504135415@phone.plivo.com")	 { $clid = "18589098847";}
if($src == "sip:norma150430230824@phone.plivo.com")	 { $clid = "18589098851";}
if($src == "sip:jimmy150430230758@phone.plivo.com")	 { $clid = "18589098853";}
if($src == "sip:sal150430230736@phone.plivo.com")	 { $clid = "18589098857";}
if($src == "sip:felix150430230637@phone.plivo.com")	 { $clid = "18582175823";}

$month = date ("m");
$daynumber = date ("d");
$year = date ("Y");
$date = ("$year$month$daynumber");

$src1 = str_replace("sip:","",$src);
$src2 = str_replace("@phone.plivo.com","",$src1);
$src3 = preg_replace('/[0-9]+/', '', $src2);

$type = "Outbound";

$sql = "INSERT INTO cdr (callid, type, src, dst, dstuser, date, time, duration, billduration, dispo) VALUES ('$callid', '$type', '$src3', '$dst', '$dstuser', curdate(), curtime(), 'Null', 'Null', 'In-progress') ";
$res = mysql_query($sql) or die(mysql_error());

$r = new Response();
if($dst) {
    $dial_params = array();
    if($src)
        $dial_params['callerId'] = $clid;
    if($cname)
        $dial_params['callerName'] = $cname;
    if(substr($dst, 0,4) == "sip:")
        $is_sip_user = TRUE;
    else
        $is_sip_user = FALSE;
    if($is_sip_user and in_array($disable_call, array("all", "sip"))) {
        $r->addHangup(array("reason" => "busy"));
    } elseif (! $is_sip_user and in_array($disable_call, array("all", "number"))) {
        $r->addHangup(array("reason" => "busy"));
    } else {
        if($dial_music)  {
            $dial_params["dialMusic"] = $dial_music;
            $d = $r->addDial($dial_params);
        } else
            $d = $r->addDial($dial_params);
        if($is_sip_user)
            $d->addUser($dst);
        else
            $d->addNumber($dst);
    } 
 } else {
     $r->addHangup();
 }
header("Content-Type: text/xml");
echo($r->toXML());
?>