<html>
<body>
<?php

$form_action = basename($_SERVER['PHP_SELF']);  	
if (!$_POST['regUsername']){
	die("Nothing to do here!");

}
else{
	include_once "include/config.php";
	$conn = mysql_connect ($HOST, $USER, $PASS) or die("Unable to connect to mysql database server");
	mysql_select_db($DB, $conn) or die ("Unable to select $DB database");
	
	$query = "INSERT INTO ADMIN(Username,Password) VALUES('$_POST[regUsername]',MD5('$_POST[regPassword]'));";
	echo $query;
	$result = mysql_query ($query,$conn);
	if(!$result)
	  die("Unable to execute query $query".mysql_error());
	else
		print "Registration successful";
} 
?>

</body>
</html>
