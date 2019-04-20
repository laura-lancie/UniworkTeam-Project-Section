<?php
// Set session path
ini_set("session.save_path", "/home/unn_w18025112/sessionData");

// Start session
session_start();

// Include header, menu and other functions
require_once("functions.php");

// Connect to database
$db = getConnection();

// Display header and create page title
echo makeHeader("Blogbusters | Admin");

// If logged in with administration rights, display content
if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] && getAccessLevel($_SESSION['username']) == "Administrator"){
	// Start main page body
	echo startMain();
		if (!empty($_REQUEST['user'])) {
			$username = $_REQUEST['user'];
			$stmt = $db->query( "SELECT * FROM `users` WHERE `username` = '$username'");
			$obj = $stmt->fetchObject();
?>
			<!-- Create form displaying selected user's data as read only !-->
					<h1 style="text-align: center;">User Admin</h1>
					<form name="displayUser" method="post" action="adminProcess.php">
						<fieldset>
							<h3 style="text-align: center;"><?php echo $obj->username; ?></h3>
							<input type="text" name="username" style="display: none;" value="<?php echo $obj->username; ?>" readonly><br /><br />
							<?php
							// Only display image if there is an appropriate image path
							if ($obj->imageURL!=null){
								echo "<div class='wrapper'>";
								echo "<img class='profileImage' src=".$obj->imageURL." alt=".$obj->username." /><br /><br />";
								echo "</div>";
							}
							?>
							<label for="name"><strong>Name:</strong></label><br />
							<input type="text" name="name" value="<?php echo $obj->firstName; ?> <?php echo $obj->surname; ?>" readonly><br /><br />
							<label for="email"><strong>Email:</strong></label><br />
							<input type="text" name="email" value="<?php echo $obj->email; ?>" readonly><br /><br />
							<label for="bio"><strong>Bio:</strong></label><br />
							<textarea name="bio" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' readonly><?php if ($obj->bio == "") {echo "Not provided";} else{echo $obj->bio;} ?></textarea><br /><br />
							<label for="username"><strong>Facebook:</strong></label><br />
							<input type="text" name="facebook" value="<?php if ($obj->facebook == "") {echo "Not provided";} else{echo "https//www.facebook.com/".$obj->facebook;} ?>" readonly><br /><br />
							<label for="username"><strong>Twitter:</strong></label><br />
							<input type="text" name="twitter" value="<?php if ($obj->twitter == "") {echo "Not provided";} else{echo "https//www.twitter.com/".$obj->twitter;} ?>" readonly><br /><br />
							<label for="username"><strong>Instagram:</strong></label><br />
							<input type="text" name="instagram" value="<?php if ($obj->instagram == "") {echo "Not provided";} else{echo "https//www.instagram.com/".$obj->instagram;} ?>" readonly><br /><br />
						</fieldset>
						<br />
						<fieldset>
							
							<!-- Display whether the user has selected their bio and social media details to be made public !-->
							<label for="display"><strong>Bio and social media displayed to other users?:</strong></label>
							<input type="text" name="display" value="<?php if($obj->display !== '0') {echo "Yes";} else {echo "No";}?>" readonly><br /><br />
							
							<!-- Display the user's current access level !-->
							<label for="access"><strong>Access Level:</strong></label><br />
							<input type="text" name="access" value="<?php echo getAccessLevel($obj->username); ?>" readonly><br /><br />
							
							<?php
							// If user is currently suspended, display the user's suspension end date
							if (date("Y-m-d",strtotime($obj->suspensionEnd))>date("Y-m-d")) {
								echo "<label for='suspension'><strong>Suspension End Date:</strong></label><br />";
								if (date("Y-m-d",strtotime($obj->suspensionEnd)) == "3000-01-01") {
									echo "<input type='text' name='suspension' value='Suspension indefinite' readonly><br /><br />";
								}
								else {
									echo "<input type='text' name='suspension' value='".date("jS F Y",strtotime($obj->suspensionEnd))."' readonly><br /><br />";
								}
							}
							?>
						</fieldset>
						<br />
						
						<?php
						// Do not display suspend, access level change and delete options for primary administrator account
						if ($obj->userID !=1) {
						?>
						<fieldset>
							
							<!-- Display functions to allow administrator to change a user's access level !-->
							<label for="setAccess"><strong>Change user's permission level:</strong></label><br />
							<select name="setAccess">
								
								<?php
									// Display a drop down selection box of access levels, displaying the user's current access as default
									$stmtAccess = $db->query( "SELECT `accessID`, `accessLevel` FROM `userAccess`");
									while ( $objAccess = $stmtAccess->fetchObject()){
										if (getAccessLevel($obj->username)==$objAccess->accessLevel) {
											echo "<option selected='selected' value=". $objAccess->accessID .">". $objAccess->accessLevel ."</option>";
										}
										else {
											echo "<option value=". $objAccess->accessID .">". $objAccess->accessLevel ."</option>";
										}
									}
								?>
							</select>
							<input type='submit' name='accessLevel' value='Amend Profile Permissions'><br /><br />
							
							<!-- Display options to suspend the user's access to the website !-->
							<label for="setSuspension"><strong>Suspend this user account for a fixed term:</strong></label><br />
							<select name="setSuspension">
								
								<?php
									// If the user is currently suspended, show an option to clear the suspension early
									if (date("Y-m-d",strtotime($obj->suspensionEnd))>date("Y-m-d")) {
										echo "<option value='clear'>Clear Suspension</option>";
									}
								?>
								<option value="30 days">30 days</option>
								<option value="60 days">60 days</option>
								<option value="90 days">90 days</option>
								<option value="indefinite">Indefinite</option>
							</select>
							
							<?php
							// If amending an existing suspension, display a button showing 'Update Suspension'
							if (date("Y-m-d",strtotime($obj->suspensionEnd))>date("Y-m-d")) {
								echo "<input type='submit' name='suspend' value='Update Suspension'><br /><br />";
							}
							
							// If creating a new suspension, display a button showing 'Suspend Profile'
							else {
								echo "<input type='submit' name='suspend' value='Suspend Profile'><br /><br />";
							}
							?>
							
							<!-- Display button to delete profile, which will take administrator to a confirmation page requiring their password !-->
							<input type='submit' name='delete' value='Delete Profile' style='background-color: #9e1e20; font-weight: bold'>
						</fieldset>
						<?php
						}
						?>
					</form>
		<?php
		}
		
		// If a user has already been selected to view, display table below user details and ask administrator to select another
		if (!empty($_REQUEST['user'])) {
			echo "<br />";
			echo "<p><strong>Select a different user to modify:</strong></p>";
		}
		
		// If user has not been selected, message to the administrator reflects that
		else {
			echo "<h1 style='text-align: center;'>User Admin</h1>";
			echo "<p>Select a user to modify:</p>";
		}
		
		// Create table of users
		echo "<table>";
			echo "<tr>";
				echo "<th>Username</th>";
				echo "<th>Access Level</th>";
				echo "<th>Edit</th>";
			echo "</tr>";
			
				// Select users from the database to display in the table
				$stmt = $db->query( "SELECT users.username, userAccess.accessLevel FROM `users` INNER JOIN `userAccess` ON users.access = userAccess.accessID ORDER BY users.username" );
				
				// Display each user's data as a row with a select option to view further information
				while ( $obj = $stmt->fetchObject()){
					echo "<tr>";
						echo "<td>". $obj->username ."</td>";
						echo "<td>". $obj->accessLevel ."</td>";
						echo "<td><form method='post'><input type='hidden' name='user' value='". $obj->username ."'><input type='submit' value='Select'></form></td>";
					echo "</tr>";
				}
		echo "</table>";
}

// If not logged in or insufficient access rights, display redirection message
else {
	// Start main page body
	echo startSmallMain();
				echo "<h1>Page Not Accessible</h1>";
				echo "You do not have permission to access this page. Please return to the <a href='index.php'>home page</a>.";
}

echo "<br />";
echo "<p><strong>Add new event:</strong></p>";

echo "<style><head><body>
.na_dates {
    background-color: Green !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style></head><body>";

require "event-calendar/config.php"; // Database Connection 

if(isset($_REQUEST['todo'])) {

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
}
$sql=$dbo->prepare("insert into plus2net_event(date,detail) values(:date,:detail)");
$sql->bindParam(':date',$date,PDO::PARAM_STR, 15);
$sql->bindParam(':detail',$event,PDO::PARAM_STR, 256);
if($sql->execute()){
$event_id=$dbo->lastInsertId(); 
echo " Event Added ..  id = $event_id ";
}
else{
echo " Not able to add data please contact Admin - Gary ";
}
}	

echo "<br><br>
Date: <form method=post action=''><input type=hidden name=todo value=add><input type='text' id='date_picker' name=date> <input type=text name=event size=80><input type=submit value='Add'></form>
<br><br><br>";
$sql="select * from plus2net_event order by date desc ";
echo "<table>";
foreach ($dbo->query($sql) as $row) {
echo "<tr><td>$row[date]</td><td> $row[detail]</td><td><a href=admin.php?todo=delete&event_id=$row[event_id]>Delete</a></td></tr>";
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

<br></br>

<p> Event Attendance List</p>

<table style="border:2px red solid" class="table_data"  cellpadding="5">
	<tr>
		<th>
			Full Name
		</th>
		<th>
			Email
		</th>
		<th>
			Event + Message
		</th>
	</tr>
<?php
$conn = mysql_connect("localhost","unn_w18025112","Gateshead55");
mysql_select_db("unn_w18025112",$conn);
$result= mysql_query("select * from tbl_contact order by tbl_contact_id DESC ") or die (mysql_error());
while ($row= mysql_fetch_array ($result) ){
$id=$row['tbl_contact_id'];
?>
	<tr style="text-align:center;">
		<td style="width:200px;">
			<?php echo $row['fullname']; ?>
		</td>
		<td style="width:200px;">
			<?php echo $row['email']; ?>
		</td>
		<td style="width:200px; color:black;">
			<?php echo $row['user_message']; ?>
		</td>
	</tr>
<?php } ?>
</table>

</body>


<?php
// End main body
echo endMain();

// Display footer
echo makeFooter();
?>