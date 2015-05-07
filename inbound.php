<?php
require 'plivo.php';
include("inc/conn.php");

$dst = $_REQUEST['ForwardTo'];
if (!$dst) {
    $dst = $_REQUEST['To'];
}
$src = $_REQUEST['CLID'];

if (!$src) {
    $src = $_REQUEST['From'] or "";
}
$cname = $_REQUEST['CallerName'] or "";
$hangup = $_REQUEST['HangupCause'];
$dial_music = $_REQUEST['DialMusic'];
$disable_call = $_REQUEST['DisableCall'];
$callid = $_REQUEST['CallUUID'];
$caller = preg_replace("/[^0-9,.]/", "", $src);
$start = $_REQUEST['StartTime'];

if ($dst == "18583246776") {
    $voip = "sip:javier150430234233@phone.plivo.com";
}
if ($dst == "18583714119") {
    $voip = "sip:josh150504145538@phone.plivo.com";
}
if ($dst == "18583714121") {
    $voip = "sip:george150430230703@phone.plivo.com";
}
if ($dst == "18583714122") {
    $voip = "sip:freddy150430230842@phone.plivo.com";
}
if ($dst == "18583714123") {
    $voip = "sip:dave150430230938@phone.plivo.com";
}
if ($dst == "18583714124") {
    $voip = "sip:eddy150504135415@phone.plivo.com";
}
if ($dst == "18583714125") {
    $voip = "sip:norma150430230824@phone.plivo.com";
}
if ($dst == "18583714126") {
    $voip = "sip:jimmy150430230758@phone.plivo.com";
}
if ($dst == "18583714127") {
    $voip = "sip:sal150430230736@phone.plivo.com";
}
if ($dst == "18583714829") {
    $voip = "sip:felix150430230637@phone.plivo.com";
}

$dstuser1 = str_replace("sip:", "", $voip);
$dstuser2 = str_replace("@phone.plivo.com", "", $dstuser1);
$dstuser3 = preg_replace('/[0-9]+/', '', $dstuser2);

$src1 = str_replace("sip:", "", $src);
$src2 = str_replace("@phone.plivo.com", "", $src1);
$src3 = preg_replace('/[0-9]+/', '', $src2);

$type = "Inbound";

$sql = <<<MYSQL
INSERT INTO cdr (
  callid,
  TYPE,
  src,
  dst,
  dstuser,
  DATE,
  TIME,
  duration,
  billduration,
  dispo
)
VALUES
  (
    '$callid',
    '$type',
    '$src3',
    '$dst',
    '$dstuser3',
    CURDATE(),
    CURTIME(),
    'Null',
    'Null',
    'In-progress'
  ) ;
MYSQL;
$res = mysql_query($sql) or die(mysql_error());

$xml = new SimpleXMLElement('<Response/>');
$dial = $xml->addChild('Dial');
$dial->addAttribute('callerid', "$src");
$dial->addChild('User', "$voip");
Header('Content-type: text/xml');
print($xml->asXML());
?>