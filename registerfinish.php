
<?php
session_start();
$form_action = basename($_SERVER['PHP_SELF']);  	
if (!$_POST['regEmail']){
	die("Nothing to do here!");

}
else{
	include_once "include/config.php";
	$conn = mysql_connect ($HOST, $USER, $PASS) or die("Unable to connect to mysql database server");
	mysql_select_db($DB, $conn) or die ("Unable to select $DB database");
	
	$query = "INSERT INTO APPLICANT_LOGIN(EMAIL,PASSWORD) VALUES('$_POST[regEmail]',MD5('$_POST[regPassword]'));";
	
	$result = mysql_query ($query,$conn);
	if(!$result)
	  die("Unable to execute query $query".mysql_error());
	else
		
		$_SESSION['message']="<h1>You're registration was succesful.</h1>
		<p>You can now fill up and submit your application form</p>";
		echo "<SCRIPT language='Javascript'>
               document.location=\"success.php\";
	       </SCRIPT>";
	 exit();
}
?>

