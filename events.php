<?php
// Set session path
ini_set("session.save_path", "/home/unn_w18025112/sessionData");

// Start session
session_start();

// Include header, menu and other functions
require_once("functions.php");

// Display header and create page title
echo makeHeader("Blogbusters | Events");

// Start main page body
echo startMain();
?>

<?Php
require "event-calendar/head.php";

echo "<style >
.na_dates {
    background-color: Gray !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style></head><body>";

require "event-calendar/config.php"; // Database Connection 


  

?>

<h2>Events page: Select date from calender to view upcoming events</h2>


Date: <input type="text" id="date_picker">
<br><br><br>
<div id=d1></div>

<script>
$(document).ready(function() {

/////////////////////
function checkDate(selectedDate) {
<?Php

$q="select distinct date_format( date, '%d-%m-%Y' ) as date from plus2net_event";

$str="[ ";
foreach ($dbo->query($q) as $row) {
$str.="\"$row[date]\",";
}
$str=substr($str,0,(strlen($str)-1));
$str.="]";
echo "var not_available_dates=$str"; // array is created in JavaScript 

?>	
// var not_available_dates = ["5-12-2015", "25-12-2015", "1-1-2016", "2-2-2017"];
//For month 09 should be written as 9 only, 5th of any month to be written as 5 only. 
// Try to get Month Part , date part and year part from the selected date.
 var m = selectedDate.getMonth()+1;
 var d = selectedDate.getDate();
 var y = selectedDate.getFullYear();
 m=m.toString();
 d=d.toString();
if(m.length <2){m='0'+m;} // Make the month 2 digit, Example 02 for Feb 
if(d.length <2){d='0'+d;} // Make the date 2 digit , example 08 for 8th day of the month 
 // Create  a variable in dd-mm-yyyy format ( or the format you want ) 
 // In JavaScript January month starts with 0 and December is 11 so we will increment the month count by 1 
 var date_to_check = d+ '-' + m + '-'  + y ;
 //alert(date_to_check);
  // Loop through all the elements of Not avalable dates array ///
 for (var i = 0; i < not_available_dates.length; i++) {
 
 // Now check if the selected  date is inside the not available  dates array. 
 if ($.inArray(date_to_check, not_available_dates) != -1 ) {
 return [true,'	','Open date T'];
 }else{
return [false,'na_dates','Close date F'];
}// end of if else 
} // end of for loop
} // end of function checkDate
////////
$(function() {
    $( "#date_picker" ).datepicker({
dateFormat: 'dd-mm-yy',
beforeShowDay:checkDate,
onSelect:function() {
selectedDate = $('#date_picker').val();
var url="event-calendar/display-data.php?selectedDate="+selectedDate;
$('#d1').load(url);
  }
});
});
//////////////////////////
/////////////
})
</script>



<?php
if(!empty($_POST["submit"])) {
	$fullname = $_POST["fullname"];
	$email = $_POST["email"];
	$user_message = $_POST["user_message"];

	$conn = mysql_connect("localhost","unn_w18025112","Gateshead55");
	mysql_select_db("unn_w18025112",$conn);
	mysql_query("INSERT INTO tbl_contact (fullname, email, user_message) VALUES ('" . $fullname. "', '" . $email. "','" . $user_message. "')");
	$insert_id = mysql_insert_id();
	if(!empty($insert_id)) {
	$message = "Successfully Added.";
	}
}
?>

<html>


<body>

<br></br>
<form name="frmContact" method="post" action="">

<div class="aler_message"><?php if(isset($message)) { echo $message; } ?></div>

<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<tr class="tableheader">
<td colspan="2">Sign up to Event</td>
</tr>
<tr class="tablerow">
<td>Full Name<br/>  <input type="text" class="text_input" autofocus="autofocus" name="fullname"></td>
<td>Email<br/> <input type="text" class="text_input" autofocus="autofocus" name="email"></td>
</tr>
<tr class="tablerow">
<td colspan="2">Event + Message<br/><textarea name="user_message" class="text_input" autofocus="autofocus" cols="60" rows="6"></textarea></td>
</tr>
<tr class="tableheader">
<td colspan="2"><input type="submit" class="btn_submit" name="submit" value="Submit"></td>
</tr>

</table>

</form>



<?php
// End main body
echo endMain();

// Display footer
echo makeFooter();
?>