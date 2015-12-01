<html>
<body>
<?php
session_start();

$status="0";
$appID=" ";
$GivenName="";
$FamilyName="";
$MiddleName="";
$BirthDate="";
$gender="";
$Passport="";
$Address="";
$Suburb="";
$PostCode="";
$Country="";
$HomeNo="";
$MobileNo="";
$Email="";
$ProgramReference="";
$Intake="";
$ApplyCROPL="";
$IsFormerID="";
$prevNo="";
$EngFirst="0";
$EngLangInst="0";
$EngTestCompleted="0";
$TestName="";
$testScore="";
$DateTestTaken="";
$OSHCTWLI="0";
$OSHCType="";
$OSHCByApplicant="0";
$survey="";
$CurrentAUStudent="0";
$InstitutionName="";
$CurrentCourse="";
$DeclarationAgreement="";
$DateSubmitted=date("d/m/Y");
$LocalInternational="0";
$chkEng= "";
$Submitted="0";

if(isset($_SESSION['appID'])){$appID = $_SESSION['appID'];}
if(isset($_POST['txtGivenName'])){$GivenName= $_POST['txtGivenName'];}
if(isset($_POST['txtFamilyName'])){$FamilyName = $_POST['txtFamilyName'];}
if(isset($_POST['txtMiddleName'])){$MiddleName = $_POST['txtMiddleName'];}
if(isset($_POST['txtDateOfBirth'])){$BirthDate = $_POST['txtDateOfBirth'];}
if(isset($_POST['gender'])){$gender=$_POST['gender'];}
if(isset($_POST['txtPassport'])){$Passport = $_POST['txtPassport'];}
if(isset($_POST['txtAddress'])){$Address = $_POST['txtAddress'];}
if(isset($_POST['txtSuburb'])){$Suburb = $_POST['txtSuburb'];}
if(isset($_POST['txtPostCode'])){$PostCode = $_POST['txtPostCode'];}
if(isset($_POST['txtCountry'])){$Country = $_POST['txtCountry'];}
if(isset($_POST['txtHomeNo'])){$HomeNo = $_POST['txtHomeNo'];}
if(isset($_POST['txtMobileNo'])){$MobileNo = $_POST['txtMobileNo'];}
if(isset($_POST['txtEmail'])){$Email = $_POST['txtEmail'];}
if(isset($_POST['txtProgramReference'])){$ProgramReference = $_POST['txtProgramReference'];}
if(isset($_POST['txtIntake'])){$Intake = $_POST['txtIntake'];}
if(isset($_POST['txtApplyCROPL'])){$ApplyCROPL = $_POST['txtCredits'];}
if(isset($_POST['IsFormerID'])){$IsFormerID = $_POST['txtStudyBefore'];}
if(isset($_POST['txtprevNo'])){$prevNo = $_POST['txtprevNo'];}
if(isset($_POST['Submit'])){$Submitted = "1";} 

if(isset($_POST['chkEng'])){
	$chkEng = $_POST['chkEng'];
	if ($chkEng == "EngFirstLang"){
		$EngFirst = "1";
	}
	else if($chkEng =="EngInst"){
		$EngLangInst ="1";
	}
	else if($chkEng =="EngTest"){
		$EngTestCompleted="1";
	}
}

if(isset($_POST['TestName'])){$TestName = $_POST['TestName'];}
if(isset($_POST['testScore'])){$testScore = $_POST['testScore'];}
if(isset($_POST['DateTestTaken'])){$DateTestTaken = $_POST['DateTestTaken'];}
if(isset($_POST['OSHCTWLI'])){ $OSHCTWLI = $_POST['OSHCTWLI'];}
if(isset($_POST['OSHCType'])){ $OSHCType = $_POST['OSHCType'];}
if(isset($_POST['OSHCByApplicant'])){ $OSHCByApplicant = $_POST['OSHCByApplicant'];}
if(isset($_POST['survey'])){ $survey = $_POST['survey'];}
if(isset($_POST['CurrentAUStudent'])){ $CurrentAUStudent = $_POST['CurrentAUStudent'];}
if(isset($_POST['InstitutionName'])){ $InstitutionName = $_POST['InstitutionName'];}
if(isset($_POST['CurrentCourse'])){ $CurrentCourse = $_POST['CurrentCourse'];}
if(isset($_POST['DeclarationAgreement'])){ $DeclarationAgreement = $_POST['DeclarationAgreement'];}
if(isset($_POST['DateSubmitted'])){ $DateSubmitted = $_POST['DateSubmitted'];}
if(isset($_POST['LocalInternational'])){ $LocalInternational = $_POST['LocalInternational'];}


//Truncate


$GivenName = trim(substr(trim($GivenName), 0, 30));



$FamilyName = trim(substr(trim($FamilyName), 0, 20));
$MiddleName = trim(substr(trim($MiddleName), 0, 20));

$gender = trim(substr(trim($gender), 0, 1));
$Passport = trim(substr(trim($Passport), 0, 30));
$Address = trim(substr(trim($Address), 0, 100));
$Suburb = trim(substr(trim($Suburb), 0, 30));
$PostCode = trim(substr(trim($PostCode), 0, 10));
$Country = trim(substr(trim($Country), 0, 20));
$HomeNo = trim(substr(trim($HomeNo), 0, 15));
$MobileNo = trim(substr(trim($MobileNo), 0, 15));
$Email = trim(substr(trim($Email), 0, 50));
$ProgramReference = trim(substr(trim($ProgramReference), 0, 50));

$prevNo = trim(substr(trim($prevNo), 0, 10));


//PHPMailer - Student Info
	$body_stud_info = "<br/><br/>Student Applicant Information:";
	$body_stud_info = $body_stud_info."<br/>Name: $GivenName";	
	if (!$FamilyName == ""){
		$body_stud_info = $body_stud_info.", $FamilyName ";	
	}
	$body_stud_info = $body_stud_info."<br/>Course Preference: $ProgramReference";
	$body_stud_info = $body_stud_info."<br/>Email: $Email ";
	$body_stud_info = $body_stud_info."<br/><br/>AutoMailer";





include_once("include/config.php");
$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
mysql_select_db($DB, $conn) or die ("Unable to select database");


// ========IF NEW APPLICANT (Personal Details)=========
if ($_SESSION['returningApplicant']=="0"){
$query = "INSERT INTO applicant(Applicant_ID, Given_Name, Family_Name, Middle_Name, BirthDate,Gender, Passport_Number, Address,
 Suburb, Postcode, Country, Home_Number, Mobile_Number, Email, Program_Preference, Intake, Applying_For_CROPL, 
 Is_Former_Student, Previous_ID_Number, English_First_Lang, English_Lang_of_Inst, English_Test_Completed, Test_Name,
 Test_Score, Date_Test_Taken, OSHC_By_TWLI, OSHC_Type, OSHC_By_Applicant, Survey_TWLI, Is_Cur_Aust_Stud, Institution_Name,
 Current_Course, Declaration_Agreement, Date_Submitted, Local_International,Submitted) VALUES
('$appID','$GivenName','$FamilyName','$MiddleName','$BirthDate',
'$gender','$Passport','$Address','$Suburb','$PostCode','$Country','$HomeNo','$MobileNo','$Email',
'$ProgramReference','$Intake','$ApplyCROPL','$IsFormerID','$prevNo','$EngFirst',
'$EngLangInst','$EngTestCompleted','$TestName','$testScore','$DateTestTaken','$OSHCTWLI',
'$OSHCType','$OSHCByApplicant','$survey','$CurrentAUStudent','$InstitutionName','$CurrentCourse',
'$DeclarationAgreement',NOW(),'$LocalInternational','$Submitted')";
}

// ================ IF RETURNING APPLICANT (Personal Details) ========================

if ($_SESSION['returningApplicant']=="1"){

$query = "UPDATE  applicant  SET   
Given_Name ='$GivenName', Family_Name ='$FamilyName', Middle_Name ='$MiddleName', BirthDate ='$BirthDate', Gender ='$gender', 
Passport_Number ='$Passport', Address ='$Address', Suburb ='$Suburb', Postcode ='$PostCode', Country ='$Country', 
Home_Number ='$HomeNo', Mobile_Number ='$MobileNo', Email ='$Email', Program_Preference ='$ProgramReference', Intake ='$Intake', 
Applying_For_CROPL ='$ApplyCROPL', Is_Former_Student ='$IsFormerID', Previous_ID_Number ='$prevNo', English_First_Lang ='$EngFirst', 
English_Lang_of_Inst ='$EngLangInst', English_Test_Completed ='$EngTestCompleted', Test_Name ='$TestName', Test_Score ='$testScore', Date_Test_Taken ='$DateTestTaken', 
OSHC_By_TWLI ='$OSHCTWLI', OSHC_Type ='$OSHCType', OSHC_By_Applicant ='$OSHCByApplicant', Survey_TWLI ='$survey', Is_Cur_Aust_Stud ='$CurrentAUStudent', 
Institution_Name ='$InstitutionName', Current_Course ='$CurrentCourse', Declaration_Agreement ='$DeclarationAgreement', Date_Submitted =NOW(), Local_International ='$LocalInternational',Submitted='$Submitted' 
WHERE Applicant_ID = '$appID'";

}



$result = mysql_query ($query,$conn);
	if(!$result)
	  die("Unable to execute query $query $_SESSION[appID]<BR/> ".mysql_error());
	else
		//echo "<script>document.location=\"submit_completed.php\"</script>"; 
		$status = "1";
	
		
		
		
// ----------------------------------------		
// =======================================Save Education Details=================================
$i=0;
while(isset($_POST['NameOfSchool'][$i]))
{
	$nameSchool= $_POST['NameOfSchool'][$i];
	$nameAward = $_POST['NameOfAward'][$i];
	$yearCompleted = $_POST['YearCompleted'][$i];
	$LangOfInstruction = $_POST['LangOfInstruction'][$i];
	$EducCountry = $_POST['EducCountry'][$i];
	$ATARScore = $_POST['ATARScore'][$i];

	if ($_SESSION['returningApplicant']=="0") {
		$query="INSERT INTO applicant_education(Education_ID, Applicant_ID, Name_of_school, Name_of_awards, 
		Year_completed, Language_of_instruction, Country, ATAR_Score) VALUES ($i,$appID,'$nameSchool','$nameAward','$yearCompleted','$LangOfInstruction','$EducCountry','$ATARScore')";
	}	

	if ($_SESSION['returningApplicant']=="1") {
		$query=" UPDATE  applicant_education  SET  
		Name_of_school ='$nameSchool', Name_of_awards ='$nameAward', Year_completed ='$yearCompleted',
		Language_of_instruction ='$LangOfInstruction', Country ='$EducCountry', ATAR_Score ='$ATARScore'
		WHERE Education_ID='$i' and Applicant_ID='$appID'";
	}

	$result = mysql_query ($query,$conn);
	if(!$result)
	  die("Unable to execute query $query $_SESSION[appID]<BR/> ".mysql_error());
	else{
		$status="1";
	}
	$i++;
	
	
}


		
// ========= END OF EDUCATION DETAILS ===============
		
// ----------------------------------------		
//Save Work Experience Details
$i=0;
while(isset($_POST['txtWorkOrg'][$i])){
	
	$txtWorkOrg=$_POST['txtWorkOrg'][$i];
	$txtWorkPosition = $_POST['txtWorkPosition'][$i];
	$txtWorkFrom = $_POST['txtWorkFrom'][$i];
	$txtWorkTo = $_POST['txtWorkTo'][$i];

	
	//========================= INSERT QUERY FOR NEW APPLICANT ======================================
	if ($_SESSION['returningApplicant']=="0"){
	
		$query = "INSERT INTO  applicant_work ( Work_ID ,  Applicant_ID ,  Organization ,  Position ,  From_MonthYear ,  To_MonthYear ) VALUES (
		$i,$appID,'$txtWorkOrg','$txtWorkPosition','$txtWorkFrom','$txtWorkTo')";
	}
	
	//================= INSERT QUERY FOR RETURNING APPLICANT =======================================
	if($_SESSION['returningApplicant']=="1") {
		$query = "UPDATE applicant_work SET 
		Organization ='$txtWorkOrg',Position = '$txtWorkPosition', From_MonthYear = '$txtWorkFrom', To_MonthYear = '$txtWorkTo'
		WHERE Work_ID = '$i' AND Applicant_ID='$appID'";
	}
	
	$result = mysql_query ($query,$conn);
	if(!$result)
	  die("Unable to execute query $query $_SESSION[appID]<BR/> ".mysql_error());
	else
		$status="1";
	$i++;
	
	
	

}

if ($status=="1"){

		if($Submitted=="1"){
			require 'mailer.php';
			$_SESSION['message']="<h1>Thank you!</h1>	
			<p>Your online application has been successfully received and we will send you an email verification. For more
			enquiries please contact us thru phone +61 8 8223 2544 or email us at <a href='mailto:info@wli.sa.edu.au'>info@wli.sa.edu.au</a></p><br>
			<h5>If you would like to have print copy of your application<a href='formreport.php' target='_blank'> click here</a></h5><br>";
			//echo "<script>document.location=\"success.php\"</script>"; 
			}
		else{
			$_SESSION['message']="<h1>Your application was saved!</h1>	
			<p>Your online application has been successfully saved and you can update your application whenever you need it. For more
			enquiries please contact us thru phone +61 8 8223 2544 or email us at <a href='mailto:info@wli.sa.edu.au'>info@wli.sa.edu.au</a></p><br>
			<h5>If you would like to have print copy of your application<a href='formreport.php' target='_blank'> click here</a></h5><br>";
			echo "<script>document.location=\"success.php\"</script>"; 
		
		}
		

	}

// =============== END OF WORK EXPERIENCE DETAILS =====================

mysql_close($conn);
?>
</body>
</html>
