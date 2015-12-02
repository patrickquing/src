<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Australia/Adelaide');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/classes/PHPExcel.php';


// Create new PHPExcel object
//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
//echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator("William Light Institute Administrator")
							 ->setLastModifiedBy("William Light Institute Administrator")
							 ->setTitle("Student Online Application Report")
							 ->setSubject("Student Online Application Report")
							 ->setDescription("Student Online Application Report")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Report file");

// Query Database
include_once("include/config.php");

//START POST DATA
	$str_fields = "";
	$fields = array();
	$field_tbl = array();
	$fields =$_POST['tbl_field'];
	//$sheet_titles = array();
	$sheet_titles = "";

	foreach ($fields as $field){
		// print "1".$field."<br/>";
		$field_tbl 		= explode("-", $field);
		$field_name 	= $field_tbl[0];
		//$sheet_titles 	= $sheet_title."-".$field_tbl[1];
		
		if ($str_fields == ""){
			$str_fields = $field_name;
			$str_first_field = $field_name;
			$sheet_titles 	= $field_tbl[1];
		}
		else{
			$str_fields = $str_fields.", ".$field_name;
			$sheet_titles 	= $sheet_titles."-".$field_tbl[1];
		}
 	} 

 	$q_order_by = $_POST['order_by'];
 	$date_from = $_POST['date_from'];
 	$date_to = $_POST['date_to'];
 	$q_list_by = $_POST['list_by'];
 	$q_list_by_value = strtoupper($_POST['list_by_value']);
 	//$tbl_educ = $_POST['tbl_educ'];
 	//$tbl_work = $_POST['tbl_work'];
 	// $worksheet_size = 1;
 	// if ($tbl_educ == "education"){
 	// 	$worksheet_size++;
 	// if ($tbl_work == "work"){
 	// 	$worksheet_size++;
 	//$worksheet_count = 0;
 	
//FOR TESTING
		// $sheet_title = array();
		// $sheet_title = explode("-", $sheet_titles);
		// for ($i = 0; $i < count($sheet_title); $i++) { 
		// 	print "2".$sheet_title[$i]."<br/>";
		// } 
//FOR TESTING



	// $field_comment = explode("-", $_POST['tbl_field']);
	// $field_group = $field_comment[0];
	// $field_specific = $field_comment[1];
//END POST DATA

$conn = mysql_connect ($HOST,$USER,$PASS) or die("Unable to connect to mysql database server");
mysql_select_db($DB, $conn) or die ("Unable to select database");

// Add some data
//echo date('H:i:s') , " Add some data" , EOL;

	//START WRITE APPLICANTS RECORD
		//START QUERYING APPLICANT TABLE
		//$str_query = "SELECT ".$str_fields." FROM Applicant WHERE date_submitted between '".$date_from."' and '".$date_to."' ORDER BY ".$q_order_by."";
		$str_query = "SELECT ".$str_fields." FROM Applicant WHERE date_submitted between '".$date_from."' and '".$date_to."' ";
		if ($q_list_by == "" || $q_list_by== "All"){
		}
		else{
			$str_query = $str_query." AND ".$q_list_by." LIKE '%".$q_list_by_value."%' ";
		}
			$str_query = $str_query." ORDER BY ".$q_order_by."";
		//print $str_query;
		//exit;
		$result = mysql_query ($str_query,$conn);

		if(!$result)
			die("Unable to execute query $str_query" );
		//END QUERYING APPLICANT TABLE

		$sheet_title = array();
		$sheet_title = explode("-", $sheet_titles);
		for ($i = 0; $i < count($sheet_title); $i++) { 
			//print "2".$sheet_title[$i]."<br/>";
			$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, 1, $sheet_title[$i]);
		} 
		//for ($i = 0; $i < mysql_num_fields($result); $i++) { 
			//$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, 1, mysql_field_name($result, $i));
		//} 

		$row = 2; // 1-based index

		while($row_data = mysql_fetch_assoc($result)) {
		    $col = 0;
		    foreach($row_data as $key=>$value) {
		    	if ($value == "0"){
		    		$value = "No";
		    	}
		    	else if ($value == "1"){
		    		$value = "Yes";
		    	}
		    	$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, $row, $value);
		        $col++;
		    }
		    $row++;
		}	

		$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Applicant');
	//END WRITE APPLICANTS RECORD

	//START WRITE APPLICANT'S EDUCATION RECORD
	//if ($tbl_educ == "education"){
		//START QUERYING EDUCATION TABLE	
		$str_query = "SELECT a.Given_Name, a.Family_Name, a.Passport_Number, 
		e.Name_Of_School, e.Name_Of_Awards, e.Country, e.Year_Completed, 
		e.Language_Of_Instruction, e.ATAR_Score 
		from applicant a, applicant_education e 
		where a.applicant_id = e.applicant_id
		and date_submitted between '".$date_from."' and '".$date_to."'";
		//print $str_query."<br/>";
		$result_educ = mysql_query ($str_query,$conn);

		if(!$result_educ)
			die("Unable to execute query $str_query" );
		//END QUERYING EDUCATION TABLE

		$objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
		$objPHPExcel->addSheet($objWorksheet);
		$objWorksheet->setTitle('Education');

		for ($i = 0; $i < mysql_num_fields($result_educ); $i++) { 
					$objPHPExcel->setActiveSheetIndex(1)->setCellValueByColumnAndRow($i, 1, mysql_field_name($result, $i));
		} 

		$row = 2; // 1-based index
		//$worksheet_count++;
		while($row_data = mysql_fetch_assoc($result_educ)) {
		    $col = 0;
		    foreach($row_data as $key=>$value) {
		    	$objPHPExcel->setActiveSheetIndex(1)->setCellValueByColumnAndRow($col, $row, $value);
		        $col++;
		    }
		    $row++;
		}	

		$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
	//}
	//END WRITE APPLICANT'S EDUCATION RECORD

	//START WRITE APPLICANT'S WORK RECORD
	//if ($tbl_work == "work"){
		//START QUERYING WORK TABLE
		$str_query = "SELECT a.Given_Name, a.Family_Name, a.Passport_Number, 
		w.Organization, w.Position, w.From_MonthYear, w.To_MonthYear 
		from applicant a, applicant_work w 
		where a.applicant_id = w.applicant_id
		and date_submitted between '".$date_from."' and '".$date_to."'";
		//print $str_query."<br/>";
		//exit;
		$result_educ = mysql_query ($str_query,$conn);

		if(!$result_educ)
			die("Unable to execute query $str_query" );
		//END QUERYING WORK TABLE
		$objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
		$objPHPExcel->addSheet($objWorksheet);
		$objWorksheet->setTitle('Work');

		for ($i = 0; $i < mysql_num_fields($result_educ); $i++) { 
					$objPHPExcel->setActiveSheetIndex(2)->setCellValueByColumnAndRow($i, 1, mysql_field_name($result, $i));
		} 

		$row = 2; // 1-based index
		//$worksheet_count++;
		while($row_data = mysql_fetch_assoc($result_educ)) {
		    $col = 0;
		    foreach($row_data as $key=>$value) {
		    	$objPHPExcel->setActiveSheetIndex(2)->setCellValueByColumnAndRow($col, $row, $value);
		        $col++;
		    }
		    $row++;
		}	

		$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
	//}
	//END WRITE APPLICANT'S WORK RECORD

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

// Save Excel 95 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TWLI_Student_Applicants.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;