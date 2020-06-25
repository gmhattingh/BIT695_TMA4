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
<div class="subheading"><h2>Board Games</h2></div>
	<center>
		<form action="" method="POST">
			<input type="text" id="board_game" name="board_game" value="Board Game Name" size="30" maxlength="30" /></br>
			</br>
			<input type="text" id="member_id" name="member_id" value="Belong to Member ID" size="30" maxlength="30" /></br>
			</br>
		
			<input type="submit" name="add" value="Add Board Game" tabindex="8" />
			<input type="submit" name="update" value="Update Board Game" tabindex="8" />
			<input type="submit" name="retrieve" value="Board Game Infomation" tabindex="8" />
			<input type="submit" name="delete" value="Remove Board Game" tabindex="8" />
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
if(isset($_POST['add']))
{
	$conn = connect_db($host, $uid, $pwd, $database);
	
	$query = "INSERT INTO board_games (Boardgame, MemberID) 
			VALUES('$_POST[member_id]', '$_POST[board_game]');";
	
	$query_run = mysqli_query($conn, $query);
	
	if ($query_run)
	{
		echo '<script type="text/javascript"> alert("Board Game Added") </script>';
	}
	else 
	{
		echo '<script type="text/javascript"> alert("Board Game NOT Added") </script>';
	}
}

if(isset($_POST['update']))
{
	$conn = connect_db($host, $uid, $pwd, $database);
	
	$query = "UPDATE `board_games` 
	SET MemberID='$_POST[member_id]'
	WHERE Boardgame='$_POST[board_game]'";
	
	$query_run = mysqli_query($conn, $query);
	
	if ($query_run)
	{
		echo '<script type="text/javascript"> alert("Board Game updated") </script>';
	}
	else 
	{
		echo '<script type="text/javascript"> alert("Board Game NOT updated") </script>';
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
	
	$sql = "select * from board_games where Boardgame='$_POST[board_game]'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		echo "<table>";
		while ($row = mysqli_fetch_assoc($result)) {

		echo '<tr><td>Board Game ' . $row['Boardgame'];
		echo '<td><td>belongs to Member ID ' . $row['MemberID'];
		//echo $row['Client'];
	}
	//else {
		//echo 'no results';
	//}

	echo "</table>";
	
	}
}

if(isset($_POST['delete']))
{
	$boardGameName = $_POST['board_game'];
	$onlyLetters = "/[A-Za-z]/";
	if (strlen($boardGameName) == 0 || !preg_match($onlyLetters, $boardGameName) || $boardGameName == "Board Game Name")
	{
		echo "Error: Please go back and enter a vaild Board game name.";
		return;
	}

	$conn = connect_db($host, $uid, $pwd, $database);
	
	$query = "DELETE FROM Board_games WHERE Boardgame='$_POST[board_game]'";
	
	$query_run = mysqli_query($conn, $query);
	
	if ($query_run)
	{
		echo '<script type="text/javascript"> alert("Board Game deleted") </script>';
	}
	else 
	{
		echo '<script type="text/javascript"> alert("Board Game NOT deleted") </script>';
	}
	
}

 ?>

</body>
</html>