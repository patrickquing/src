
function validate() 
{
	var gname = document.forms["app_form"]["txtGivenName"].value;
	if (gname == null || gname == "")
	{
		alert("Given Name must be filled out");
		document.forms["app_form"].txtGivenName.focus();
		return false;
	}
	var passport = document.forms["app_form"].txtPassport.value;
	if (passport == null || passport == "")
	{
		alert("Passport must be filled out");
		document.forms["app_form"].txtPassport.focus();
		return false;
	}

	var address = document.forms["app_form"].txtAddress.value;
	if (address == null || address == "")
	{
		alert("Address must be filled out");
		document.forms["app_form"].txtAddress.focus();
		return false;
	}
	var suburb = document.forms["app_form"].txtSuburb.value;
	if (suburb == null || suburb == "")
	{
		alert("Suburb must be filled out");
		document.forms["app_form"].txtSuburb.focus();
		return false;
	}
	var postcode = document.forms["app_form"].txtPostCode.value;
	if(postcode == null || postcode == "")
	{
		alert("Postcode must be filled out");
		document.forms["app_form"].txtPostCode.focus();
		return false;
	}
	if(isNaN(postcode))
	{
		alert("Postcode should contain only numerical values.");
		document.forms["app_form"].txtPostcode.focus();
		return false;
	}

	var mobile = document.forms["app_form"].txtMobileNo.value;
	if (mobile == null || mobile == "")
	{
		alert("Mobile No. must be filled out");
		document.forms["app_form"].txtMobileNo.focus();
		return false;
	}
	var email = document.forms["app_form"].txtEmail.value;
	if (email == null || email == "")
	{
		alert("Email must be filled out");
		document.forms["app_form"].txtEmail.focus();
		return false;
	}

	return true;

	// app_form

	// txtFamilyName
	// 		txtGivenName
	// txtMiddleName
	// 		txtPassport
	// 		txtAddress
	// 		txtSuburb
	// 		txtPostCode
	// txtHomeNo
	// 		txtMobileNo
	// 		txtEmail
	// txtProgram
	// txtIDNo
	// txtEnglishTest
	// txtEngScore
	// txtother
	// txtAgent
	// txtCountry
	// txtCourse
	// txtInstitution
}

function popup()
{
	alert("HELLO");
}

function enableTextEngTest(){
	document.forms["app_form"].txtEnglishTest.disabled =false;
	document.forms["app_form"].txtEngScore.disabled =false;
	document.forms["app_form"].txtEngDateTaken.disabled =false;
}


function disableTextEngTest(){
	document.forms["app_form"].txtEnglishTest.disabled =true;
	document.forms["app_form"].txtEngScore.disabled =true;
	document.forms["app_form"].txtEngDateTaken.disabled =true;
}
