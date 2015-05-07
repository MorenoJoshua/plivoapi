<?php
include("inc/conn.php");




$sql = "SELECT * FROM  `cdr` ORDER BY `date` DESC, `time` DESC LIMIT 75";
$res = mysql_query($sql) or die(mysql_error());


?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Call Details Report (WebRTC Phone Operation)</title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<p align="center"><font face="Arial" style="font-size: 9pt"><br>
</font><font face="Arial" size="5">Call Details Report (WebRTC Phone 
Operation)</font></p>
<div align="center">
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">&nbsp; 
			CallID</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Date</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Time</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Type</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Src</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Dst</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			DstUser</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Duration</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			BillDuration</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Disposition</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Xxxxx</font></td>
			<td bgcolor="#0066CC" height="40">
			<font color="#FFFFFF" face="Arial" style="font-size: 10pt; font-weight: 700">
			Xxxxx</font></td>
		</tr>
		<?php while($row = mysql_fetch_array($res, MYSQL_BOTH)) { ?>
		<tr>
			<td height="35"><font face="Arial" size="2">&nbsp; <?php echo $row[0]; ?> 
			</font> </td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[5]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[6]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[1]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[2]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[3]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[4]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[7]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[8]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[9]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[10]; ?></font></td>
			<td height="35"><font face="Arial" size="2"><?php echo $row[11]; ?></font></td>
		</tr>
		<?php } ?>
	</table>
</div>
<p align="center">&nbsp;</p>

</body>

</html>
