<html>
<head>
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/normalize.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/main.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/mmenu.css">
<link rel='stylesheet' href='../ITECH7602/css/WLI-Fugu.css' type='text/css'>
<link rel='stylesheet' href='../ITECH7602/css/style.css' type='text/css'>


</head>

<body>

<?php
session_start();

//*** Form action - the file name itself 
$form_action = basename($_SERVER['PHP_SELF']);  	
//*** ASK FOR USERNAME AND PASSWORD 
if(!isset($_POST['first'])){
  $_SESSION['loggedin'] = 0;
?>

 <FORM action=<?php echo $form_action ?> method='POST' >

	<div class="wrapper mm-page">	
			<div class="container">
				<header class="clearfix">
				
					<!-- MOBILE HEADER -->
					<a class="mobile-nav-button" href="http://www.wli.sa.edu.au/wli-students/#mmenu">
						<span class="l1"></span><span class="l2"></span><span class="l3"></span>
					</a>
				
					<a class="logo" href="http://www.wli.sa.edu.au/"><img src="./plugins/wli-logo.svg" alt="wli-logo"><h1>The William Light Institute</h1></a>
					


				</header>
			</div>
		</div>

<hr/>

<div>

<p align="center">


<div class="content internal clearfix">
					<div class="left-col">
						<div class="left-panels">
							
							<a href="http:\\www.wli.sa.edu.au" class="box green">
								<h2>Home page</h2></a>
								
							<a href="#" class="box blue">
								<h2>Other Links</h2></a>
							
						</div>
					</div>
					<div class="main purple">
<h1>Apply Online</h1>
<p>Welcome to The William Light Institute Application Form, this a web form for<br/>
international and local students to submit and save their application to study in TWLI.</p>

<table>

<tr><td><p>If you are new to these portal please select "Register as a new Applicant"</p></td></tr>
<tr><td><input name="Register" type="button" value="Register as new applicant" onClick="window.location.href='register.php'"></td></tr>
</table>

<hr>
<p>Already registered applicant?Then login to complete and submit your application to TWLI.</p>
<DIV style="width:60%">

<table>

	<tr><td>Email:</td><td><input type="text" name="txtEmail" id="txtEmail" onClick="this.select();"></td><td><p>E.g. someone@example.com<p></td></tr>
	<tr><td>Password:</td><td><input name="txtPassword" type="password"></td></tr>
	<tr><td><input name="first" type="submit" value="Login"></td></tr>
</table>
</DIV>

</div>
	<div class="sidebar clearfix">
		<div class="box text contact purple">
		
		</div>
		<div class="box text contact red">
			
			
			
		</div>
	</div>
		</div>
	</div>



</p>
</div>
</form>
</body>
</html>

<?php
}//End of if(!$first)
//*** USER HAS SUBMITED THE FORM
if(isset($_POST['first'])){
$uname = $_POST['txtEmail'];
include_once("include/config.php");
$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
mysql_select_db($DB, $conn) or die ("Unable to select database");
$query = "SELECT * FROM applicant_login WHERE email='$_POST[txtEmail]';";
		$result = mysql_query ($query,$conn);
if(!$result)
  die("Unable to execute query $query".mysql_error());

$query_result = mysql_fetch_array($result);

$username = $query_result['Email'];
$password = $query_result[2];
$form_password = md5($_POST['txtPassword']);


  //*** If user does not exist or invalid password go back to login
  if(($_POST['txtEmail'] != $username || $form_password != $password)){
   echo "<script language='JavaScript'>
	alert(\"Access denied... Invalid username $uname,$username,$form_password or $password!\"); 
        history.go(-1);
        </script>";
   }//End of if
 //************************** User exists and password is correct 
   else{
	 //Admin user logged in successfuly
       $_SESSION['loggedin'] = 1;
	   $_SESSION['appID']=$query_result[0];
	   //$_SESSION['aTable'] = $_POST['sTable'];
	 echo "<SCRIPT language='Javascript'>
               document.location=\"applicationform.php\";
	       </SCRIPT>";
	 exit();
   }//End of else
}//End of if($first)
?>

