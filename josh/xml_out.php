<?php
$dst = $_REQUEST['To'];
$src = $_REQUEST['CLID'];
$conn = mysqli_connect('dev.crdff.net', 'josh', 'espada98');

// XML
Header('Content-type: text/xml');
$response = new SimpleXMLElement('<Response/>');
$hangup = $response->addChild('Hangup');
    $hangup->addAttribute('schedule', '25');
    $hangup->addAttribute('reason', 'rejected');
$play = $response->addChild('Play','http://morenojoshua.com/webphone/mmpr.mp3');
print($response->asXML());

//SQL
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
?>