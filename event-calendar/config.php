<?Php
$host_name = "localhost";
$database = "unn_w18025112"; // database name$username = "unn_w18025112";          // database user id $password = "Gateshead55";          // password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>