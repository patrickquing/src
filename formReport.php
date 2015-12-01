<?php 
session_start();
if ($_SESSION['loggedin']!="1"){
		header("Location:index.php");
	}
else{ 
	
	include_once("include/config.php");
	$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
	mysql_select_db($DB, $conn) or die ("Unable to select database");
	$query ="SELECT * FROM APPLICANT WHERE APPLICANT_ID = '$_SESSION[appID]'";
	$result = mysql_query ($query,$conn);
	$num_rows = mysql_num_rows($result);
	
	print "<html>
	<head>
	<link rel='stylesheet' href='./css/WLI-Fugu.css' type='text/css'>
	<link rel='stylesheet' href='./css/style.css' type='text/css'></head>
	<body>";
	print "<a class='logo' href='http://www.wli.sa.edu.au/'><img src='./plugins/wli-logo.svg' alt='wli-logo'></a>";
	echo "<h1>International Student Application Form</h1>";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		print "<h2>Personal Details</h2>";
		print "<table><tr><td>";
		print "Family Name:</td><td>".$row['Family_Name']."</td>";
		print "<td>Given  Name:</td><td>".$row['Given_Name']."</td></tr>";
		print "<td>Middle Name( if any ):</td><td>".$row['Middle_Name']."</td>";
		print "<td>Date of Birth: </td><td>".$row['BirthDate']." ( day/month/year )</td></tr>";
		print "<td>Gender: </td><td>" .$row['Gender']."</td>";
		print "<td>Passport Number: </td><td>".$row['Passport_Number']."</td></tr>";
		print "</table>";
		print "<hr><h3>Contact Details</h3>";
		print "<table><tr>";
		print "<td>Address: </td><td>".$row['Address']."</td></tr>";
		print "<td>Suburb: </td><td>".$row['Suburb']."</td>";
		print "<td>PostCode: </td><td>".$row['Postcode']."</td>";
		print "<td>Country: </td><td>".$row['Country']."</td></tr>";
		print "<td>Home number: </td><td>".$row['Home_Number']."</td>";
		print "<td>Mobile number: </td><td>".$row['Mobile_Number']."</td></tr>";
		print "<td>Email address: </td><td>".$row['Email']."</td></tr>";
		print "</table><hr>";
		
		print "<h2>Course Preference</h2>";
		print "<table><tr><td>";
		print "Program you wish to apply:</td><td>".$row['Program_Preference']."</td>";
		print "<td>Intake:</td><td>".$row['Intake']."</td></tr>";
		print "<td>Are you applying for Credits/Recognition for prior Learning:</td><td>".$row['Applying_For_CROPL']."</td>";
		print "<td>Have you studied at TWLI before: </td><td>".$row['Is_Former_Student']."</td></tr>";
		print "<td>Yes, if yes, ID Numnber </td><td>" .$row['Previous_ID_Number']."</td>";
		
		print "</table>";
		
		
		print "<h2>English Language Proficiency</h2>";
		print "<table><tr><td>";
		if ($row['English_First_Lang']=="1"){
			print "<input type='checkbox' checked>English is my first language:</td><td></td>";
		}
		else print "<input type='checkbox'>English is my first language:</td><td></td>";
		print "</tr><tr>";
		if ($row['English_Lang_of_Inst']=="1"){
		
			print "<td><input type='checkbox' checked>English was the language of instruction during my secondary studies and I gained a satisfactory pass in final year English:</td></tr>";
		}
		else print "<td><input type='checkbox' >English was the language of instruction during my secondary studies and I gained a satisfactory pass in final year English:</td></tr>";
		print "<tr></tr>";
		print "</tr><tr>";
		
		print "<table>";
		if ($row['English_Test_Completed']=="1"){
			print "<td><input type='checkbox' checked>I have completed a test:</td>";
			}
		else
			print "<td><input type='checkbox'>I have completed a test:</td>";
		print "<tr>";
		
		print "<td>Test Name: </td><td>".$row['Test_Name']."</td></tr>";
		print "<td>Score: </td><td>" .$row['Test_Score']."</td>";
		print "<td>Date Taken: </td><td>" .$row['Date_Test_Taken']."</td>";
		
		
		print "</table><hr>";
		
			
// ===================== EDUCATION DETAILS 
$NameOfSchool0="N/A";$NameOfSchool1="N/A";$NameOfSchool2="N/A";
	$NameOfAward0="N/A";$NameOfAward1="N/A";$NameOfAward2="N/A";
	$YearCompleted0="N/A";$YearCompleted1="N/A";$YearCompleted2="N/A";
	$LanguageOfInstruction0="N/A";$LanguageOfInstruction1="N/A";$LanguageOfInstruction2="N/A";
	$educCountry0 ="N/A";$educCountry1 ="N/A";$educCountry2 ="N/A";
	$ATARScore0="N/A";$ATARScore1="N/A";$ATARScore2="N/A";
	
$query = "SELECT * FROM APPLICANT_EDUCATION WHERE APPLICANT_ID ='$_SESSION[appID]'";
	$result = mysql_query ($query,$conn);
	
	//initiate variable
		
	$i=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	${'NameOfSchool'.$i}=$row["Name_of_school"];
	${'NameOfAward'.$i}=$row["Name_of_awards"];
	${'YearCompleted'.$i}=$row["Year_completed"];
	${'LanguageOfInstruction'.$i}=$row["Language_of_instruction"];
	${'educCountry'.$i}=$row["Country"];
	${'ATARScore'.$i}=$row["ATAR_Score"];
	
	$i++;
	}
			
		print "<h2>Education Details</h2>";
		print "<p> List of all previous studies you have attempted, completed or not completed.
		Certified or original documentary evidence of qualifiction claimed must be attached at the time of this application.
		Documents not in English  must be accompanied by certified translations.</p>";
		
		print 
		"<table name ='tblEducationDetails' border='1'>
		<th>Name of School</th>
		<th>Name of Awards</th>
		<th>Year completed</th>
		<th>Language of instruction</th>
		<th>Country</th>
		<th>ATAR score if applicable</th>
		<tr><td>$NameOfSchool0</td><td>$NameOfAward0</td><td>$YearCompleted0</td><td>$LanguageOfInstruction0</td><td>$educCountry0</td><td>$ATARScore0</td></tr>
		<tr><td>$NameOfSchool1</td><td>$NameOfAward1</td><td>$YearCompleted1</td><td>$LanguageOfInstruction1</td><td>$educCountry1</td><td>$ATARScore1</td></tr>
		<tr><td>$NameOfSchool2</td><td>$NameOfAward2</td><td>$YearCompleted2</td><td>$LanguageOfInstruction2</td><td>$educCountry2</td><td>$ATARScore2</td></tr>
		</table><hr>";
		
		
		// ============= RETRIEVED WORK EXPERIENCE DETAILS ===================
	$Organization0="NIL";	$Organization1="NIL";	$Organization2="NIL";
	$Position0="NIL";$Position1="NIL";$Position2="NIL";
	$From_MonthYear0="NIL";	$From_MonthYear1="NIL";	$From_MonthYear2="NIL";
	$To_MonthYear0="NIL";$To_MonthYear1="NIL";$To_MonthYear2="NIL";
	$query = "SELECT * FROM APPLICANT_WORK WHERE APPLICANT_ID ='$_SESSION[appID]'";
	$result = mysql_query ($query,$conn);
	$Organization0="NIL";	$Organization1="NIL";	$Organization2="NIL";
	$Position0="NIL";$Position1="NIL";$Position2="NIL";
	$From_MonthYear0="NIL";	$From_MonthYear1="NIL";	$From_MonthYear2="NIL";
	$To_MonthYear0="NIL";$To_MonthYear1="NIL";$To_MonthYear2="NIL";
	$i=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	${'Organization'.$i}=$row["Organization"];
	${'Position'.$i}=$row["Position"];
	${'From_MonthYear'.$i}=$row["From_MonthYear"];
	${'To_MonthYear'.$i}=$row["To_MonthYear"];
	$i++;
	}
		print "<h3>Work Experience/relevant employment history if applicable (attach CV or resume)</h3>
		<table name ='tblWorkExperience' border='1'>
		<th>Name of Organization</th>
		<th>Position</th>
		<th>From (month/year)</th>
		<th>To(month/year)</th>
		<tr><td>$Organization0</td><td>$Position0</td><td>$From_MonthYear0</td><td>$To_MonthYear0</td></tr>
		<tr><td>$Organization1</td><td>$Position1</td><td>$From_MonthYear1</td><td>$To_MonthYear1</td></tr>
		<tr><td>$Organization2</td><td>$Position2</td><td>$From_MonthYear2</td><td>$To_MonthYear2</td></tr>
		</table><hr>";
		
		
	
	
	
	$OSHCByTWLI = "unchecked";
	if ($row['OSHC_By_TWLI'] =="1"){
		$OSHCByTWLI = "checked";
		
	}
	
	$OSHCTypeSingle = "unchecked";
	$OSHCTypeFamily = "unchecked";
	if($row['OSHC_Type']=="Single"){
		$OSHCTypeSingle="checked";
	}
	else if($row['OSHC_Type']=="Family"){
		$OSHCTypeFamily="checked";
	}
	
	$OSHCByApplicant="unchecked";
	$OSHCByApplicant=$row['OSHC_By_Applicant'];
	if($row['OSHC_By_Applicant']=="1"){
			$OSHCByApplicant=="checked";
	}
	
	print "<table>
	<tr><td colspan='2'><h3>Section 5:OSHC Information</h3></td></tr>
	<tr>
	<td><input type = 'radio' name='chkOSHC' value = 'OSHCByTWLI' $OSHCByTWLI>Yes,I would like  TWLI arrange my OSHC<br/><br/>	&nbsp;&nbsp;
		<input type = 'radio' name='chkOSHCchoice' value='Single' $OSHCTypeSingle>Single OSHC for myself&nbsp;&nbsp;
		<input type = 'radio' name='chkOSHCchoice' value='Family' $OSHCTypeFamily>Family OSHC for me and my dependents</td></tr>
	<tr><td><input type = 'radio' name='chkOSHC' value = 'OSHCByApplicant' $OSHCByApplicant>No, I will make my own arrangement</td></tr>

	</table><hr>";
	
	
	$StudAUYes = "unchecked";
	$StudAUNo ="unchecked";
	if( $row['Is_Cur_Aust_Stud']=="1"){
		$StudAUYes = "checked";
	}
	else $StudAUNo ="checked";
	
	
	
	print"<table>
	<tr><td colspan='3'><h3>Section 6:Other Information</h3><h5>How did you first learn  about TWLI</h5></td></tr>
	<tr><td>Survey from:</td><td></td>$row[Survey_TWLI]</td></tr>
	<tr><td>Are you currently studying in Australia?</td><td><input type='radio' $StudAUYes>Yes</td><td><input type='radio' $StudAUNo'>No</td></tr>
	<tr><td>If yes, Name of Institution: $row[Institution_Name]</td><td>Course: $row[Current_Course]</td></tr>
	</table>";
	print "</body></html>";
	
	print"<table>
	<tr><td><h5>Declaration Agreement</h5></td></tr>
	<tr><td><ul>
	<label><li> I declare that the information submitted with this application form is complete and true. I acknowledge that failure to disclose my academic records my result  in the Institute revoking an offer or my studies at any stage</li></label>";
	echo "<label><li>I authorise the Institute to verify my academic and professional qualifications, and work experience</li></label>";
	echo "<label><li>I understand that at the time of enrolment I will be required  to supply originals of all documents provided  at the time of application</li></label>";
	echo "<label><li>I hereby certify that the information provided on this form, and on all documents submitted may be made available to Commonwealth and State agencies and the Fund Manager of ESOS Assurance Fund, pursuant  to obligations under ESOS Act 2000 and National Code.
	I understand that the institution is required under section  19 of ESOS Act 2000 to inform Department of Education, Employment and Workplace Relations changes to my enrolment and any breach  of a student visa condition relating to attendance or unsatisfactory academic performance.</li></label>";
	echo "<label><li>I confirm that I have received and read copy of TWLI's current prospectus and information  available on www.wli.sa.edu.au and fully understand the requirements of the course.</li></label>";
	echo "<label><li>I understand that I will need to obtain health insurance for the duration of my studies and/or for visa purposes.</li></label></ul>";
	echo "<br/>By clicking the submit button, you accept and agreed with the terms and condition above of The William Light Institute.";
	print "</td></tr></table>";
}
}
?>