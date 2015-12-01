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



<div>


<div class="content internal clearfix">
					<div class="left-col">
						<div class="left-panels">
							
							<a href="#" class="box green">
								<h2>Links</h2></a>
								
								
							<a href="#" class="box blue">
								<h2>Other Links</h2></a>
							
						</div>
					</div>
					<div class="main purple">

<h1><b>Admin Page</b></h1>
<h5>Welcome to The William Light Institute Administrator Page<br/>
</h5>

					<table><th>This page is for authorised person only.</th>

  <tr>
    <td>User name:<input type="text" name="txtEmail" id="txtEmail"></td></tr>
	<tr><td>Password:<input name="txtPassword" type="password"></td></tr>
	<tr><td colspan="2"><input name="first" type="submit" value="Login"> &nbsp<input name="Register" type="button" value="Register new Admin" onClick="window.location.href='registerNewAdmin.php'"></td></tr>
</table>
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
$query = "SELECT * FROM admin WHERE Username='$_POST[txtEmail]';";
		$result = mysql_query ($query,$conn);
if(!$result)
  die("Unable to execute query $query".mysql_error());

$query_result = mysql_fetch_array($result);

$username = $query_result['Username'];
$password = $query_result['Password'];
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
               document.location=\"adminpage.php\";
	       </SCRIPT>";
	 exit();
   }//End of else
}//End of if($first)
?>

