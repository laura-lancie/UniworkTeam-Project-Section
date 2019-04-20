<?Php
require "config.php"; // Database Connection 
$date=$_GET['selectedDate'];
$date = new DateTime($date);
$date=$date->format('Y-m-d');

//echo $date;
$sql="select * from plus2net_event where date ='$date'";

foreach ($dbo->query($sql) as $row) {
echo "$row[date]: $row[detail]<br>";
}
?>