<html>
<head>

<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/normalize.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/main.css">
<link rel="stylesheet" href="http://www.wli.sa.edu.au/css/mmenu.css">
<link rel='stylesheet' href='./css/WLI-Fugu.css' type='text/css'>
<link rel='stylesheet' href='./css/style.css' type='text/css'>

</head>
<body>

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

	if ($num_rows>0){
		$_SESSION['returningApplicant']="1";
			
	
	}
	else $_SESSION['returningApplicant']="0";
	
	$query_result = mysql_fetch_array($result);
	$GivenName=$query_result['Given_Name'];
	$FamilyName = $query_result['Family_Name'];
	$MiddleName = $query_result['Middle_Name'];
	$DateOfBirth = $query_result['BirthDate'];
	
	$gender="uncheked";
	$gender2="unchecked";
	
	if ($query_result['Gender'] =="m"){
		$gender = "checked";
	}
	else if($query_result['Gender'] =="f"){
		$gender1= "checked";
	}
	
	$Passport = $query_result['Passport_Number'];
	$Address = $query_result['Address'];
	$Suburb = $query_result['Suburb'];
	$Postcode =$query_result['Postcode'];
	$Country = $query_result['Country'];
	$HomeNo = $query_result['Home_Number'];
	$MobileNo = $query_result['Mobile_Number'];
	$Email = $query_result['Email'];
	$ProgramPreference = $query_result['Program_Preference'];
	$Intake = $query_result['Intake'];
	$ApplyForCROPL="unchecked";
	$ApplyForCROPL2="unchecked";
	$IsFormerStudent ="unchecked";
	$IsFormerStudent2="unchecked";
	
	//$ApplyForCROPL = $query_result['Applying_For_CROPL'];
	if ($query_result['Applying_For_CROPL'] =="1"){
		$ApplyForCROPL="checked";
		}
	else{
		$ApplyForCROPL2="checked";
		}
		
	
	//$IsFormerStudent = $query_result['Is_Former_Student'];
	if ($query_result['Is_Former_Student']=="1"){
		$IsFormerStudent ="checked";
		}
	else{
		$IsFormerStudent2 = "checked";
		}
	
	
	$PreviousNo = $query_result['Previous_ID_Number'];
	$EngFirstLang ="unchecked";
	if ($query_result['English_First_Lang']=="1"){
		$EngFirstLang="checked";
	}	
	$EngLangInst = "unchecked";
	if ($query_result['English_Lang_of_Inst'] == "1"){
		$EngLangInst = "checked";	
	}
	
	$EngTestCompleted = "unchecked";
	if($query_result['English_Test_Completed']=="1"){
		$EngTestCompleted = "checked";
	}
	
	$TestName = $query_result['Test_Name'];
	$TestScore = $query_result['Test_Score'];
	$DateTestTaken = $query_result['Date_Test_Taken'];
	//$OSHCByTWLI = $query_result['OSHC_By_TWLI'];
	$OSHCByTWLI = "unchecked";
	if ($query_result['OSHC_By_TWLI'] =="1"){
		$OSHCByTWLI = "checked";
		
	}
	
	$OSHCTypeSingle = "unchecked";
	$OSHCTypeFamily = "unchecked";
	if($query_result['OSHC_Type']=="Single"){
		$OSHCTypeSingle="checked";
	}
	else if($query_result['OSHC_Type']=="Family"){
		$OSHCTypeFamily="checked";
	}
	
	$OSHCByApplicant="unchecked";
	$OSHCByApplicant=$query_result['OSHC_By_Applicant'];
	if($query_result['OSHC_By_Applicant']=="1"){
			$OSHCByApplicant=="checked";
	}
	
	
	$Survey = $query_result['Survey_TWLI'];
	$IsCurrentAUStudent = $query_result['Is_Cur_Aust_Stud'];
	$InstName = $query_result['Institution_Name'];
	$CurrentCourse = $query_result['Current_Course'];
	$Declaration_Agreement = $query_result['Declaration_Agreement'];
	$DateSubmitted = $query_result['Date_Submitted'];
	$LocalInternational = $query_result['Local_International'];

	// ============= RETRIEVED EDUCATION DETAILS ===================
	
	$query = "SELECT * FROM APPLICANT_EDUCATION WHERE APPLICANT_ID ='$_SESSION[appID]'";
	$result = mysql_query ($query,$conn);
	
	//initiate variable
	$NameOfSchool0="";$NameOfSchool1="";$NameOfSchool2="";
	$NameOfAward0="";$NameOfAward1="";$NameOfAward2="";
	$YearCompleted0="";$YearCompleted1="";$YearCompleted2="";
	$LanguageOfInstruction0="";$LanguageOfInstruction1="";$LanguageOfInstruction2="";
	$educCountry1 ="";$educCountry1 ="";$educCountry2 ="";
	$ATARScore0="";$ATARScore1="";$ATARScore2="";
	
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

	// =============== END OF EDUCATION DETAILS =======================
	
	// ============= RETRIEVED WORK EXPERIENCE DETAILS ===================
	
	$query = "SELECT * FROM APPLICANT_WORK WHERE APPLICANT_ID ='$_SESSION[appID]'";
	$result = mysql_query ($query,$conn);
	$Organization0="";	$Organization1="";	$Organization2="";
	$Position0="";$Position1="";$Position2="";
	$From_MonthYear0="";	$From_MonthYear1="";	$From_MonthYear2="";
	$To_MonthYear0="";$To_MonthYear1="";$To_MonthYear2="";
	$i=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		${'Organization'.$i}=$row["Organization"];
		${'Position'.$i}=$row["Position"];
		${'From_MonthYear'.$i}=$row["From_MonthYear"];
		${'To_MonthYear'.$i}=$row["To_MonthYear"];
	
		$i++;
	}

	// =============== END OF WORK EXPERIENCE DETAILS =======================
	
}

mysql_close($conn);
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


<div>

<p align="center">
<script type="text/javascript" src="form_validation.js"></script>
<form method="post" action="save.php" name="app_form" onSubmit="javascript:return validate();">

<div class="content internal clearfix">
					<div class="left-col">
						<div class="left-panels">
							
							<a href="#" class="box green">
								<h2>Links</h2></a>
								
								
							<a href="http:\\www.wli.sa.edu.au" class="box blue">
								<h2>TWLI Homepage</h2></a>
							
						</div>
					</div>
					<div class="main purple">
				
<h1>International Student Application Form</h1>
<h6><em>(*)represents necessary information</em></h6>
<table>
<tr><td colspan="2"><h3>Section 1:Personal Details</h3></td></tr>
<tr><td>Family Name:</td><td><input type="text" name="txtFamilyName" onFocus="javascript:this.select()" value="<?php echo $FamilyName; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Given Name: </td><td><input type="text" name="txtGivenName" onFocus="javascript:this.select()" value="<?php echo $GivenName; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="txtMiddleName" onFocus="javascript:this.select()" value="<?php echo $MiddleName; ?>"></td></tr>
<tr>
	<td>Gender:</td>
	<td><input type="radio" name="gender" value="m" <?php echo $gender; ?>>Male
		<input type="radio" name="gender" value="f" <?php echo $gender2; ?>>Female</td>
	</tr>
<tr><td>Date of Birth:</td><td> <input type="date" name="txtDateOfBirth" value = <?php echo $DateOfBirth;?>></td></tr>
<tr><td>Passport:</td><td><input type="text" name="txtPassport" onFocus="javascript:this.select()" value="<?php echo $Passport; ?>"></td></tr></td></tr>
</table>


<table>
<tr><td colspan="2" ><h4>Contact Details (Home country)</h4></td></tr>
<tr><td>Address:</td><td><input type="text" name="txtAddress"onFocus="javascript:this.select()" value="<?php echo $Address; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Suburb:</td><td><input type="text" name="txtSuburb" onFocus="javascript:this.select()" value="<?php echo $Suburb; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Postcode:</td><td><input type="text" name="txtPostCode" onFocus="javascript:this.select()" value="<?php echo $Postcode; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Country:</td><td>


<select name="txtCountry">
<?php
include('include\country.php');
foreach ($countryList as $key=>$value)
	{
		if($Country==$value) {
			print "<option selected value=\"$value\">$value</option>";
			}
		else 
			print "<option value=\"$value\">$value</option>";
	}

?>

</select>


</td></tr>
<tr><td>Home Number:</td><td><input type="text" name="txtHomeNo" onFocus="javascript:this.select()" value="<?php echo $HomeNo; ?>"></td></tr>
<tr><td>Mobile Number:</td><td><input type="text" name="txtMobileNo" onFocus="javascript:this.select()" value="<?php echo $MobileNo; ?>"></td><td><label name="requiredField">*</label></td></tr>
<tr><td>Email Address:</td><td><input type="text" name="txtEmail" onFocus="javascript:this.select()" value="<?php echo $Email; ?>"></td><td><label name="requiredField">*</label></td></tr>
</table>
<table>
<tr><td colspan="2"><h3>Section 2:Course Preference</h3></td></tr>
<tr><td>Program wish to apply:</td>
		<td><select name="txtProgramReference" >
		
			<?php 
				include_once("include/config.php");
				$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
				mysql_select_db($DB, $conn) or die ("Unable to select database");
				$query ="SELECT * FROM COURSE_PREFERENCE ORDER BY COURSE_CODE";
				$result = mysql_query ($query,$conn);
				$num_rows = mysql_num_rows($result);
				
				///* echo "<option selected>Select Program</option>"; */
				for ($i=0; $i < $num_rows; $i++){
					$row= mysql_fetch_array($result);
					$strOpt="<option value=". $row['Course_Name'];
					if ($row['Course_Name']==$ProgramPreference){
						$strOpt.= " selected";
					}
					$strOpt.=">".$row['Course_Name']."</option>";
					print $strOpt;
				}
			?>
			
			
			</select>
		</td></tr>
<tr><td>Intake:</td><td><input type="date" name="txtIntake" onFocus="javascript:this.select()" value="<?php echo $Intake; ?>"></td></tr>
<tr><td>Are you applying for Credits/Recognition of prior Learning</td>
	
	<td><input type="radio" name="txtCredits" value="1" <?php echo $ApplyForCROPL;?>>Yes(Please see attachement)</td>
	<td><input type="radio" name="txtCredits" value="0" <?php echo $ApplyForCROPL2;?>>No</td>
</tr>
<tr><td>Have you studied at TWLI before?</td>
	<td><input type="radio" name="txtStudyBefore" value="1" <?php echo $IsFormerStudent;?>>Yes(indicate ID number)<input type="text" name="txtIDNo" maxlength="7" value = "<?php echo $PreviousNo; ?>"></td>
	<td><input type="radio" name="txtStudyBefore" value="0" <?php echo $IsFormerStudent2;?>>No</td>
</tr>
</table>
<table>

<tr><td colspan="2"><h3>Section 3:English Language Proficiency</h3><h5>Documentary Evidence must be provided if English is not your first language</h5></td></tr>
<tr><td><input type="radio" name="chkEng" value = "EngFirstLang" onClick="disableTextEngTest()"  <?php echo $EngFirstLang;?>>English is my first language</td></tr>
<tr><td><input type="radio" name="chkEng" value = "EngInst" onClick="disableTextEngTest()"   <?php echo $EngLangInst;?>>English was the language of instruction during my secondary <br/>
studies and I gained a satisfactory pass in final year English. </td></tr>
<tr><td><input type="radio" name="chkEng" value="EngTest" onClick="enableTextEngTest()" <?php echo $EngTestCompleted;?>>I have completed a test</td>
<tr><td><label>Test Name:</label><input type="text" name="txtEnglishTest" value = "<?php echo $TestName; ?>"><br><label>Score</label><input type="text" name="txtEngScore" value = "<?php echo $TestScore; ?>"><label>Date Taken:</label><input type="date" name = "txtEngDateTaken" value = "<?php echo $DateTestTaken; ?>"></td></tr>
</table>
<table>
<tr><td colspan="2"><h3>Section 4:Education Details</h3>
<h5>List of all previous studies you have attempted, completed, or not completed. Certified or original documentary evidence of qualification claimed must
be attached at the time of this application. Documents not in English must be accompanied by certified translations.</h5>
</td></tr>
<tr><td>
	<table name ="tblEducationDetails" border="1">
		<th>Name of School</th>
		<th>Name of Awards</th>
		<th>Year completed</th>
		<th>Language of instruction</th>
		<th>Country</th>
		<th>ATAR score if applicable</th>
		<tr><td><input type="text" name = "NameOfSchool[]" id = "NameOfSchool1" value = <?php echo $NameOfSchool0;?>></td><td><input type="text" name = "NameOfAward[]" value = <?php echo $NameOfAward0;?>></td><td><input type="text" name = "YearCompleted[]" value = <?php echo $YearCompleted0;?>></td><td><input type="text" name="LangOfInstruction[]" value = <?php echo $LanguageOfInstruction0;?>></td><td><input type="text" name="EducCountry[]"></td><td><input type="text" name="ATARScore[]" value = <?php echo $ATARScore0;?>></td></tr>
		<tr><td><input type="text" name = "NameOfSchool[]" id = "NameOfSchool1" value = <?php echo $NameOfSchool1;?>></td><td><input type="text" name = "NameOfAward[]" value = <?php echo $NameOfAward1;?>></td><td><input type="text" name = "YearCompleted[]" value = <?php echo $YearCompleted1;?>></td><td><input type="text" name="LangOfInstruction[]" value = <?php echo $LanguageOfInstruction1;?>></td><td><input type="text" name="EducCountry[]"></td><td><input type="text" name="ATARScore[]" value = <?php echo $ATARScore1;?>></td></tr>
		<tr><td><input type="text" name = "NameOfSchool[]" id = "NameOfSchool1" value = <?php echo $NameOfSchool2;?>></td><td><input type="text" name = "NameOfAward[]" value = <?php echo $NameOfAward2;?>></td><td><input type="text" name = "YearCompleted[]" value = <?php echo $YearCompleted2;?>></td><td><input type="text" name="LangOfInstruction[]" value = <?php echo $LanguageOfInstruction2;?>></td><td><input type="text" name="EducCountry[]"></td><td><input type="text" name="ATARScore[]" value = <?php echo $ATARScore2;?>></td></tr>
	</table>
</td></tr>
<tr><td><h5>Work Experience/relevant employment history if applicable (attach CV or resume)</h5></td></tr>
<tr><td>
	<table name ="tblWorkExperience" border="1">
		<th>Name of Organization</th>
		<th>Position</th>
		<th>From (month/year)</th>
		<th>To(month/year)</th>
		<tr><td><input type="text" name = "txtWorkOrg[]" id = "txtWorkOrg1" value = <?php echo $Organization0;?> ></td><td><input type="text" name="txtWorkPosition[]" id = "txtWorkPosition1" value = <?php echo $Position0;?>></td><td><input type="text" name="txtWorkFrom[]" id="txtWorkFrom1" value = <?php echo $From_MonthYear0;?>></td><td><input type="text" name="txtWorkTo[]" id ="txtWorkTo1" value = <?php echo $To_MonthYear0;?>></td></tr>
		<tr><td><input type="text" name = "txtWorkOrg[]" id = "txtWorkOrg1" value = <?php echo $Organization1;?> ></td><td><input type="text" name="txtWorkPosition[]" id = "txtWorkPosition2" value = <?php echo $Position1;?>></td><td><input type="text" name="txtWorkFrom[]" id="txtWorkFrom2" value = <?php echo $From_MonthYear1;?>></td><td><input type="text" name="txtWorkTo[]" id ="txtWorkTo2" value = <?php echo $To_MonthYear1;?>></td></tr>
		<tr><td><input type="text" name = "txtWorkOrg[]" id = "txtWorkOrg1" value = <?php echo $Organization2;?> ></td><td><input type="text" name="txtWorkPosition[]" id = "txtWorkPosition3" value = <?php echo $Position2;?>></td><td><input type="text" name="txtWorkFrom[]" id="txtWorkFrom3" value = <?php echo $From_MonthYear2;?>></td><td><input type="text" 	name="txtWorkTo[]" id ="txtWorkTo3" value = <?php echo $To_MonthYear2;?>></td></tr>
	</table>
</td></tr>

</table>
<table>
<tr><td colspan="2"><h3>Section 5:OSHC Information</h3></td></tr>
<tr>
	<td><input type = "radio" name="chkOSHC" value = "OSHCByTWLI" checked <?php echo $OSHCByTWLI;?>>Yes, I would like  TWLI arrange my OSHC<br/><br/>	&nbsp;&nbsp;
			<input type ="radio" name="chkOSHCchoice" value="Single" checked <?php echo $OSHCTypeSingle; ?>>Single OSHC for myself&nbsp;&nbsp;
			<input type = "radio" name="chkOSHCchoice" value="Family" <?php echo $OSHCTypeFamily; ?>>Family OSHC for me and my dependents</td></tr>
<tr><td><input type = "radio" name="chkOSHC" value = "OSHCByApplicant" <?php echo $OSHCByApplicant; ?>>No, I will make my own arrangement</td></tr>
</table>

<table>
<tr><td colspan="3"><h3>Section 6:Other Information</h3><h5>How did you first learn  about TWLI</h5></td></tr>
<tr><td>You may tick more than one box</td>
</tr><tr><td><input type ="checkbox" name="chkOther">Internet</td><td><input type="checkbox" name ="chkOther">Agent:<input type="text" name="txtAgent"></td></tr>
<tr><td><input type="checkbox" name="chkOther">Other:<input type="text" name="txtother"></td><td>Country:<input type="text" name="txtOtherCountry"></td></tr>
<tr><td>Are you currently studying in Australia?</td><td><input type="radio" name="optStudyAU" value = "1">Yes</td><td><input type="radio" name="optStudyAU" value="0">No</td></tr>
<tr><td>If yes, Name of Institution:<input type="text" name="txtInstitution"></td><td>Course:<input type="text" name="txtCourse"></td></tr>
</table>

</form>



<form action="add_file.php" method="post"enctype="multipart/form-data">
        

<table>
<tr><td colspan="2"><h3>Section 7:Declaration And Application Checklist</h3><h5>Ensure certified copies of the following documents are attached to this application form</h5></td></tr>
<tr><td><input type="checkbox" name="checklist">Academic results and certificates</td><td><input type="file" name="uploaded_file"><input type="submit" value="Upload file"></td></tr>
	<td><input type="checkbox" name="checklist">Passport Copy</td><td><input type="file" name="uploaded_file2"  ><input type="submit" value="Upload file"></td></tr>
	<td><input type="checkbox" name="checklist">Visa copy(if applicable)</td><td><input type="file" name="uploaded_file3"  ><input type="submit" value="Upload file"></td></tr>
<tr><td><input type="checkbox" name="checklist">Proof of English Proficiency(if applicable)</td><td><input type="file" name="uploaded_file4"  ><input type="submit" value="Upload file"></td></tr>
<td><input type="checkbox" name="checklist">Proof of work experience (if applicable)</td><td><input type="file" name="uploaded_file5"  ><input type="submit" value="Upload file"></td></tr>
</table>



		
<hr>
<table>
<tr><td><h5>Declaration Agreement</h5></td></tr>
<tr><td><?php echo "<ul>
<label><li> I declare that the information submitted with this application form is complete and true. I acknowledge that failure to disclose my academic records my result  in the Institute revoking an offer or my studies at any stage</li></label>";
echo "<label><li>I authorise the Institute to verify my academic and professional qualifications, and work experience</li></label>";
echo "<label><li>I understand that at the time of enrolment I will be required  to supply originals of all documents provided  at the time of application</li></label>";
echo "<label><li>I hereby certify that the information provided on this form, and on all documents submitted may be made available to Commonwealth and State agencies and the Fund Manager of ESOS Assurance Fund, pursuant  to obligations under ESOS Act 2000 and National Code.
I understand that the institution is required under section  19 of ESOS Act 2000 to inform Department of Education, Employment and Workplace Relations changes to my enrolment and any breach  of a student visa condition relating to attendance or unsatisfactory academic performance.</li></label>";
echo "<label><li>I confirm that I have received and read copy of TWLI's current prospectus and information  available on www.wli.sa.edu.au and fully understand the requirements of the course.</li></label>";
echo "<label><li>I understand that I will need to obtain health insurance for the duration of my studies and/or for visa purposes.</li></label></ul>";

echo "<br/>By clicking the submit button, you accept and agreed with the terms and condition above of The William Light Institute.";
/*echo "<a href =save.php?appID='$_SESSION[appID]'>"; */

?>
</td>
</tr>	

</table>
</form>

&nbsp<input type="submit" name="Submit" value="Submit">
&nbsp<input type="submit" name="Save" value="Save">

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











</body>
</html>
