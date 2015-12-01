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
							Admin Reporting Tool
						</p>
						<form method="post" action="create_file.php">
							Student Applications
							<select id="stud_submissions" name="stud_submissions" style="width: 200px;">
								<option value="all">All</option>
								<option value="completed">Complete</option>
								<!--<option value="all">Incomplete</option>-->
							</select><br/><br/>
							Date Range: (FROM)
							<input type="date" id="date_from" name="date_from" value="<?php echo date("Y-m-d");?>"/>
							(TO)
							<input type="date" id="date_to" name="date_to" value="<?php echo date("Y-m-d");?>"/><br/><br/>
							
<?php
							include_once("include/config.php");

							$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
							mysql_select_db($DB, $conn) or die ("Unable to select database");

							//$query_desc_tbl = "DESCRIBE Applicant";
							$query_desc_tbl = "SHOW FULL COLUMNS FROM applicant";
							$result_desc_tbl = mysql_query ($query_desc_tbl,$conn);

							if(!$result_desc_tbl)
							  die("Unable to execute query $query_desc_tbl" );
?>
							Order by:
								<select id="order_by" name="order_by" style="width: 200px;">
									<?php
									while ($tbl_fields = mysql_fetch_row($result_desc_tbl)){
										$field_comment = explode("-", $tbl_fields[8]);
										$field_group = $field_comment[0];
										$field_specific = $field_comment[1];

										if ($field_group != "System"){
											print "<option value='$tbl_fields[0]'>$field_specific</option>";
										}
									}
									?>
								</select><br/><br/>

							List by:
								<select id="list_by" name="list_by"  style="width: 200px;">
									<option value='All' selected="selected">All</option>
									<option value='Country'>Country</option>
									<option value='Program_Preference'>Course Preference</option>
									<!--<option value=''>Agent</option>-->
								</select>
								<input type="text" id="list_by_value" name="list_by_value"   style="width: 200px;"/>
								<br/><br/>

							Select Applicant's Data to include in the report:
							<TABLE>
						  		<TR valign="top">
								<?php
									$count = 0;
									$td_tag = "open_td";
									$hold_field_group = "new";
									print "<td valign='top'>";
									mysql_data_seek($result_desc_tbl, 0);
									while ($tbl_fields = mysql_fetch_row($result_desc_tbl)){
										//$count++;
										$field_comment = explode("-", $tbl_fields[8]);
										$field_group = $field_comment[0];
										$field_specific = $field_comment[1];

										if ($field_group != "System"){
					  						if ($field_group != $hold_field_group){
					  							$count++;
												$hold_field_group = $field_group;
												if ($count == 4){
													print "</td>";
						  							print "<td valign='top'>";
							  						print "<br/>$count - $field_group:<br/>";
							  						print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							  						print "<input type='checkbox' id='tbl_field[]' name='tbl_field[]' checked='checked' value='$tbl_fields[0]-$field_specific'>$field_specific</input><br/>";
							  					}
							  					else{
						  							print "<br/>$count - $field_group:<br/>";
						  							print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							  						print "<input type='checkbox' id='tbl_field[]' name='tbl_field[]' checked='checked' value='$tbl_fields[0]-$field_specific'>$field_specific</input><br/>";
							  					}
						  					}
						  					else{
						  						print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						  						print "<input type='checkbox' id='tbl_field[]' name='tbl_field[]' checked='checked' value='$tbl_fields[0]-$field_specific'>$field_specific</input><br/>";
						  					}
						  				}
					  				}
					  				print "</td>";
								?>
								</TR>
								<!--
								<TR>
									<TD><input type='checkbox' id='tbl_educ' name='tbl_educ' checked='checked' value='education'>Applicant's Education<br/></TD>
									<TD></TD>
								</TR>
								<TR>
									<TD><input type='checkbox' id='tbl_work' name='tbl_work' checked='checked' value='work'>Applicant's Work<br/></TD>
									<TD></TD>
								</TR>-->
							</TABLE>

							<center><input type="submit" value="Generate Report"/>   <input name="back" type="button" value="Back to Admin Menu" onClick="window.location.href='adminpage.php'"></center>
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