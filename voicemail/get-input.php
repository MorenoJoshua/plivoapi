<?php
	require_once 'plivo.php';
	
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
$caller = preg_replace("/[^0-9,.]/", "", $src);


if($dst == "18583246776") { $voip = "sip:javier150430234233@phone.plivo.com";}
if($dst == "18583714119") { $voip = "sip:josh150504145538@phone.plivo.com";}
if($dst == "18583714121") { $voip = "sip:george150430230703@phone.plivo.com";}
if($dst == "18583714122") { $voip = "sip:freddy150430230842@phone.plivo.com";}
if($dst == "18583714123") { $voip = "sip:dave150430230938@phone.plivo.com";}
if($dst == "18583714124") { $voip = "sip:eddy150504135415@phone.plivo.com";}
if($dst == "18583714125") { $voip = "sip:norma150430230824@phone.plivo.com";}
if($dst == "18583714126") { $voip = "sip:jimmy150430230758@phone.plivo.com";}
if($dst == "18583714127") { $voip = "sip:sal150430230736@phone.plivo.com";}
if($dst == "18583714829") { $voip = "sip:felix150430230637@phone.plivo.com";}

$dstuser1 = str_replace("sip:","",$voip);
$dstuser2 = str_replace("@phone.plivo.com","",$dstuser1);
$dstuser3 = preg_replace('/[0-9]+/', '', $dstuser2);

$agent = "http://phone.crdff.net/audios/voicemail/vm-greet-$dstuser3.mp3";
	
	$response = new Response();
	$response->addPlay("$agent");
	$response->addRecord(array('action' => 'http://' . $_SERVER["SERVER_NAME"] . /*':' . $_SERVER["SERVER_PORT"] .*/ '/voicemail/confirm-input.php',
						   'method' => 'GET',
						   'maxLength' => '60',
						   'finishOnKey' => '#',
						   'playBeep' => 'true'));
	$response->addSpeak('Recording not received');
	$response->addRedirect('http://' . $_SERVER["SERVER_NAME"] . /*':' . $_SERVER["SERVER_PORT"] .*/ '/voicemail/get-input.php', array('method' => 'GET'));
	header('content-type: text/xml');
	echo($response->toXML());
?>