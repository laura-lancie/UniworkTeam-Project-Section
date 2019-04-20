<?Php

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Calender</title>

";
require "head.php";

echo "<style >
.na_dates {
    background-color: Gray !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style></head><body>";

require "config.php"; // Database Connection 


  

?>
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
var url="display-data.php?selectedDate="+selectedDate;
$('#d1').load(url);
  }
});
});
//////////////////////////
/////////////
})
</script>

<?Php
require "footer.php";
?>
</body>
</html>
