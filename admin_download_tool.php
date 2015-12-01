<!DOCTYPE html>
<!-- saved from url=(0038)http://www.wli.sa.edu.au/wli-students/ -->
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths mti-inactive"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>TWLI Students | The William Light Institute</title>
    <meta name="description" content="">        
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
    <meta name="google-site-verification" content="Y-vLaktB9Lbw2FHN13OEXMNDLsahQ8808Ty44CBi2ag">
    <link rel="stylesheet" href="http://www.wli.sa.edu.au/css/normalize.css">
    <link rel="stylesheet" href="http://www.wli.sa.edu.au/css/main.css">
    <link rel="stylesheet" href="http://www.wli.sa.edu.au/css/mmenu.css">
	<link rel='stylesheet' href='../ITECH7602/css/style.css' type='text/css'>
        <!--
		/* @license
		 * MyFonts Webfont Build ID 2671346, 2013-10-22T01:17:39-0400
		 * 
		 * The fonts listed in this notice are subject to the End User License
		 * Agreement(s) entered into by the website owner. All other parties are 
		 * explicitly restricted from using the Licensed Webfonts(s).
		 * 
		 * You may obtain a valid license at the URLs below.
		 * 
		 * Webfont: Fugu by Positype
		 * URL: http://www.myfonts.com/fonts/positype/fugu/regular/
		 * Copyright: Copyright (c) 2009 by Neil Summerour. All rights reserved.
		 * Licensed pageviews: 10,000
		 * 
		 * 
		 * License: http://www.myfonts.com/viewlicense?type=web&buildid=2671346
		 * 
		 * © 2013 MyFonts Inc
		*/
		
		-->
		<link rel="stylesheet" type="text/css" href="./plugins/WLI-Fugu.css">
    
        <!--[if lt IE 7]>
    	
    <![endif]--><style type="text/css" id="mti_fontface_c5b628e0-7ca7-4122-9671-a0498afa306e">@font-face{
font-family:"Proxima N W01 Reg";
src:url("http://fast.fonts.net/dv2/3/e56ecb6d-da41-4bd9-982d-2d295bec9ab0.woff?d44f19a684109620e484157ea690e8186c87a44ba593d5d52209965dda96d1749d5cb5eb4c3a45d4ee012af8c80f1f99699258ea0d0fddc8b0255ad7c2a5278c28bc821d95bc555299120b24a835152e7103de776eb33b5c0207a6a4b2b5fedecfd127f0d194c0c495ebd80cfef26489480dceb5a87cbf6d03ac6319caf7a4276945da6e387199d65cf16e7615818da3d4223b39196522c8de5c13e1b736f5c61b35cbce7378e8327427f7&projectId=c5b628e0-7ca7-4122-9671-a0498afa306e") format('woff');}
</style>
    
<link id="MonoTypeFontApiFontTracker" type="text/css" rel="stylesheet" href="./plugins/1.css"></head>
<body>
		<div class="wrapper mm-page">	
			<div class="container">
				<header class="clearfix">
				
					<!-- MOBILE HEADER -->
					<a class="mobile-nav-button" href="http://www.wli.sa.edu.au/wli-students/#mmenu">
						<span class="l1"></span><span class="l2"></span><span class="l3"></span>
					</a>
				
					<a class="logo" href="http://www.wli.sa.edu.au/"><img src="./plugins/wli-logo.svg" alt="wli-logo"><h1>The William Light Institute</h1></a>
					


				</header>
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
												<p class="intro">
							Admin Download Tool
						</p>
						<form method="post" action="<?php basename($_SERVER['PHP_SELF']) ?>" name="frmDownloadAttached">
						<p>This page allows the admin to download the attached file submitted by the applicant</p>
						<table><tr><td>
						<label>Search Applicant:</label></td><td><input type="text" name="txtApplicant" value="e.g. Lastname" onfocus="this.select();" onClick="this.select();"></td>
						<td><input type="submit" value="find"></td></tr>
						
						<?php
// Connect to the database
include_once("include/config.php");
$dbLink = new mysqli($HOST, $USER, $PASS, $DB);
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = 'SELECT file.*,applicant.Family_name FROM `file`, applicant WHERE applicant.applicant_ID=file.applicant_ID AND applicant.Submitted="1"';

if (isset($_POST['txtApplicant'])){
$sql = $sql." AND applicant.family_name='".$_POST['txtApplicant']."'";
}


$result = $dbLink->query($sql);
 
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="100%" name="tblDownloadAttached" class="tblDownloadAttached">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created</b></td>
					<td><b>Family Name</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['mime']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
					<td>{$row['Family_name']}</td>
                    <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                </tr>";
        }
 
        // Close table
        echo '</table>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();
?>
<input name="back" type="button" value="Back to Admin Menu" onClick="window.location.href='adminpage.php'">
						</form>
						<hr>
					</div>
					<div class="sidebar clearfix">
						<div class="box text contact purple">
						</div>
						<div class="box text contact red">
						</div>
					</div>
				</div>
			</div>
		</div>
<div id="mm-blocker"></div></body></html>