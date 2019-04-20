<?Php

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Calender</title>

";
require "../head.php";

echo "<style >
.na_dates {
    background-color: Green !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style></head><body>";

require "../config.php"; // Database Connection 

$todo=$_REQUEST['todo'];

if($todo=='delete'){
	
$event_id=$_GET['event_id'];
$count=$dbo->prepare("DELETE FROM plus2net_event WHERE event_id=:event_id");
$count->bindParam(":event_id",$event_id,PDO::PARAM_INT,3);
$count->execute();	
}
if($todo=='add'){
$date=$_POST['date'];
$event=$_POST['event'];
$date = new DateTime($date);
$date=$date->format('Y-m-d');

$sql=$dbo->prepare("insert into plus2net_event(date,detail) values(:date,:detail)");
$sql->bindParam(':date',$date,PDO::PARAM_STR, 15);
$sql->bindParam(':detail',$event,PDO::PARAM_STR, 256);
if($sql->execute()){
$event_id=$dbo->lastInsertId(); 
echo " Event Added ..  id = $event_id ";
}
else{
echo " Not able to add data please contact Admin ";
}
}	

echo "<br><br>
Date: <form method=post action=''><input type=hidden name=todo value=add><input type='text' id='date_picker' name=date> <input type=text name=event size=80><input type=submit value='Add'></form>
<br><br><br>";
$sql="select * from plus2net_event order by date desc ";
echo "<table>";
foreach ($dbo->query($sql) as $row) {
echo "<tr><td>$row[date]</td><td> $row[detail]</td><td><a href=add.php?todo=delete&event_id=$row[event_id]>Delete</a></td></tr>";
}
echo "</table>";
?>

<script>
$(document).ready(function() {
////////////

$(function() {
    $( "#date_picker" ).datepicker({
dateFormat: 'dd-mm-yy'
});
});
//////////////////////////
/////////////
})
</script>

<?Php
require "../footer.php";
?>
</body>
</html>
