<html>
<head>
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/normalize.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/main.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/mmenu.css">
<link rel='stylesheet' href='../ITECH7602/css/WLI-Fugu.css' type='text/css'>
<link rel='stylesheet' href='../ITECH7602/css/style.css' type='text/css'>

<script type="text/javascript">
    function confirm_delete() {
        return confirm("Are you sure you wish to delete these item(s)?");
    }
		
	function validate(){
		if (document.forms["app_form"].txtCourseCode.value== null || document.forms["app_form"].txtCourseCode.value== " "){
			alert("Course code must be filled out");
			document.forms["app_form"].txtCourseCode.focus();
			return false;
			}
		if (document.forms["app_form"].txtCourseName.value== null || document.forms["app_form"].txtCourseName.value== " "){
			alert("Course name must be filled out");
			document.forms["app_form"].txtCourseName.focus();
			return false;
			}
	}
	
	
</script>

</head>
<title>Course Preference (Admin)</title>
<body>



?>


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
<h1>Course Preference Menu</h1>
<p align="center">


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


<form name ="app_form" action=<?php echo $_SERVER['PHP_SELF'] ?> method="post" onSubmit="javascript:return validate();">
<table>
	<th>Course Preference Data Maintenance</th>

	<p>This will page allow to add and delete course preference for choices in online application form</p>

	<tr><td>
	<div 'id='addBox'>
	<table>
	<tr>
		<td>Course Code *</td>
		<td><input type="text" name='txtCourseCode'></td>
	</tr>
	
	<tr>
		<td>Course Name *</td>
		<td><input type="text" name='txtCourseName'></td>
	</tr>
	</table>
	</div>
	</td></tr>
	
	
		<tr>
		<td colspan="2"><input type="submit" name="New" value="Save new Course">
		<input type="submit" name="Delete" value="Delete" onClick='return confirm_delete();'> 
		<a href="adminLogin.php">Back to Admin menu</a></td>
			
		</tr>
	

	<tr>
		<td>
			
				<?php
				include_once("include/config.php");
				$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
				mysql_select_db($DB, $conn) or die ("Unable to select database");
				$query ="SELECT * FROM COURSE_PREFERENCE ORDER BY COURSE_CODE";
				$result = mysql_query ($query,$conn);
				$num_rows = mysql_num_rows($result);
				
				
				print "<table border=1>";
				
				print "<th></th><th>Course Code</th><th>Course Name</th>";
				for ($i=0; $i < $num_rows; $i++){
				$row= mysql_fetch_array($result);
				echo "<tr><td><input type='checkbox' name='chkCourse[]' value=".$row['Course_Code']."></td>";
				echo "<td>".$row['Course_Code']."</td>
					<td>".$row['Course_Name']."</td></tr>";
				}
				print "</table>";
					
				?>
			</table>
			
		</td>
	</tr>

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

<?php
if (isset($_POST['New']) && (($_POST['txtCourseCode'] !="") ||($_POST['txtCourseName'] !=""))){
	$sql = "INSERT INTO COURSE_PREFERENCE VALUES(";
	$sql .= "'".$_POST['txtCourseCode']."',";
	$sql .= "'".$_POST['txtCourseName']."',";
	$sql .= "NOW())";
	
	include_once("include/config.php");
	$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
	mysql_select_db($DB, $conn) or die ("Unable to select database");
	
	$result = mysql_query ($sql,$conn);
	if(!$result)
	  die("Unable to execute query $sql<BR/> ".mysql_error());
	else
		echo "<script type='text/javascript'>location.reload();</script>";
	  

}


if(isset($_POST['Delete'])){
	if (empty($_POST['chkCourse']))
		{
			print "Please select Course to delete";
		}
	else {
		$aCourse = $_POST['chkCourse'];
		foreach($aCourse as $key=>$value){
		
			$sql ="DELETE FROM COURSE_PREFERENCE WHERE COURSE_CODE='";
			$sql.=$value;
			$sql.="'";
			include_once("include/config.php");
			$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
			mysql_select_db($DB, $conn) or die ("Unable to select database");
			$result = mysql_query ($sql,$conn);
			if(!$result)
				die("Unable to execute query $sql<BR/> ".mysql_error());
			else
				echo "<script type='text/javascript'>location.reload();</script>";
			
			}
		
		}
		
}

?>




</html>

