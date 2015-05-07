<?php
require_once 'plivo.php';
require 'conn.php';

// XML
Header('Content-type: text/xml');

$r = new Response();
$url = $_SERVER['DOCUMENT_ROOT'] . '/josh/mmpr.mp3';
$attr = array(
    'loop' => 2,
);

$r->addPlay($url, $attr);
$wait = array(
    'lenght' => 2,
);
$r->addWait($wait);
header('Content-type: text/xml');
echo($r->toXML());

/*//SQL
// Saves all variables on a sql db, if a record with UUID exists, it is updated
$fields = '`';
$values = '\'';
foreach($_REQUEST as $field => $value){
    $fields .= $field . '`, `';
    $values .= $value . "', '";
    $ifupdate .= '`' . $field . '` ="' . $value . '", ';
}
$fields = rtrim($fields, ', `') . '`';
$values = rtrim($values , ", '") . "'";
$ifupdate = rtrim($ifupdate, ', ') . '';
$query = <<<MYSQL
INSERT INTO crm.`plivo_test_out` ($fields) VALUES ($values) ON DUPLICATE KEY UPDATE $ifupdate;
MYSQL;
mysqli_query($conn, $query) or die(mysqli_error($conn));
*/
?>