<!DOCTYPE html>
<html lang=”en-GB”>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Board Games Aficionados</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="TMA2style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="TMA2formValidation.js"></script>
 
</head>
<body>
<div class="heading"><h1>Board Games Aficionados</h1></div>
<div class="subheading"><h2>Assign Board Games</h2></div>
	<center>
		<form action="" method="POST">
			<input type="text" id="board_game" name="board_game" value="Board Game Name" size="30" maxlength="30" /></br>
			</br>
			<input type="text" id="member_id" name="member_id" value="Member ID" size="30" maxlength="30" /></br>
			</br>
			<input type="text" id="assign_date" name="assign_date" value="Date Assigned (YYYY-MM-DD)" size="30" maxlength="30" /></br>
			</br>
			<input type="text" id="event" name="event" value="Event" size="30" maxlength="30" /></br>
			</br>
		
			<input type="submit" name="assign" value="Assign Board Game" tabindex="8" />
			<input type="submit" name="return" value="Return Board Game" tabindex="8" />
			<input type="submit" name="retrieve" value="Who borrowed Board Game" tabindex="8" />
		</form>
	</center>
	
 <?php
 
$uid="root";
$pwd="root";
$database="bit695";
$host = 'localhost:3306';

//Connect to DB function
function connect_db($host, $uid, $pwd, $database) {
	$conn = mysqli_connect($host, $uid, $pwd, $database);
// Test Database connection
if (!$conn){
	echo 'Connection Error ' . mysqli_connect_error(); 
	return $conn;
}
else{
	//echo "Connection Successfully";
	return $conn;
}
}
if(isset($_POST['assign']))
{
	
	$boardGameName = $_POST['board_game'];
	$memberID = $_POST['member_id'];
	$assignDate = $_POST['assign_date'];
	$event = $_POST['event'];
	$onlyLetters = "/[A-Za-z]/";
	if (strlen($boardGameName) == 0 || !preg_match($onlyLetters, $boardGameName) || $boardGameName == "Board Game Name")
	{
		echo "Error: Please go back and enter a vaild Board game name.";
		return;
	}
	$onlyNumeric = "/[0-9]/";
	if (strlen($memberID) != 5 || !preg_match($onlyNumeric, $memberID))
	{
	echo "Error: Please go back and enter a vaild Member ID.";
	return;
	}
	//$onlyNumeric = "/[0-9]/";
	//if (strlen($assignDate) != 5 || !preg_match($onlyNumeric, $assignDate))
	//{
	//echo "Error: Please go back and enter a vaild Date.";
	//return;
	//}
	if (strlen($event) == 0 || !preg_match($onlyLetters, $boardGameName) || $event == "Board Game Name")
	{
		echo "Error: Please go back and enter a vaild Board game name.";
		return;
	}
	
	$conn = connect_db($host, $uid, $pwd, $database);
	
	
	
	$query = "INSERT INTO board_games_assigned (Boardgame, MemberID, AssignDate, Event) 
			VALUES('$_POST[board_game]', '$_POST[member_id]', '$_POST[assign_date]', '$_POST[event]');";
	
	$query_run = mysqli_query($conn, $query);
	
	if ($query_run)
	{
		echo '<script type="text/javascript"> alert("Board Game Assigned") </script>';
	}
	else 
	{
		echo '<script type="text/javascript"> alert("Board Game NOT Assigned") </script>';
	}
}


if(isset($_POST['retrieve']))
{
	$boardGameName = $_POST['board_game'];
	$onlyLetters = "/[A-Za-z]/";
	if (strlen($boardGameName) == 0 || !preg_match($onlyLetters, $boardGameName) || $boardGameName == "Board Game Name")
	{
		echo "Error: Please go back and enter a vaild Board game name.";
		return;
	}

	$conn = connect_db($host, $uid, $pwd, $database);
	
	$sql = "select * from board_games_assigned where Boardgame='$_POST[board_game]'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		echo "<table>";
		while ($row = mysqli_fetch_assoc($result)) {

		echo '<tr><td>Board Game ' . $row['Boardgame'];
		echo '<td><td>was borrowed by ID ' . $row['MemberID'];
		echo '<td><td>on ' . $row['AssignDate'];
		echo '<td><td>for ' . $row['Event'];
		echo '<td><td>event.';
		//echo $row['Client'];
	}
	//else {
		//echo 'no results';
	//}

	echo "</table>";
	
	}
}

if(isset($_POST['return']))
{
	$boardGameName = $_POST['board_game'];
	$onlyLetters = "/[A-Za-z]/";
	if (strlen($boardGameName) == 0 || !preg_match($onlyLetters, $boardGameName) || $boardGameName == "Board Game Name")
	{
		echo "Error: Please go back and enter a vaild Board game name.";
		return;
	}

	$conn = connect_db($host, $uid, $pwd, $database);
	
	$query = "DELETE FROM Board_games_assigned WHERE Boardgame='$_POST[board_game]'";
	
	$query_run = mysqli_query($conn, $query);
	
	if ($query_run)
	{
		echo '<script type="text/javascript"> alert("Board Game has been returned") </script>';
	}
	else 
	{
		echo '<script type="text/javascript"> alert("Board Game has NOT been returned") </script>';
	}
	
}

 ?>

</body>
</html>