<?php 
	
	$connect = mysqli_connect('localhost', 'aids', 'password', 'str');

	$sql = 'SELECT id, room_name FROM room ORDER BY room_name';
	$result = mysqli_query($connect, $sql);
	$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);	

	$sql = 'SELECT id, first, last FROM teacher ORDER BY last';
	$result = mysqli_query($connect, $sql);
	$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($connect);

?>


<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.selected{
			background-color: rgba(178, 219, 191, 1);
		}
	</style>
	<link rel="stylesheet" href="styles.css">
	<title>Scheduling System</title>
</head>
<body>
	<div class="header">
		<a href="index.php"><font size="32">Scheduling System</font></a>
	</div>
	<div class="navbar">
		<a href="teachers.php">Teachers</a>
  		<a href="sections.php">Sections</a>
  		<a href="rooms.php">Rooms</a>
  		<a href="subjects.php" class="selected">Subjects</a>
  		<a href="days.php">Days</a>
	</div>
	<div class="row">
		<div class="column main">
			<h1>Subjects Database</h1>
			<table>
				<tr>
					<th>Subject</th>
					<th>Meetings Per Week</th>
					<th>Teacher</th>
					<th>Room</th>
				</tr>
				<tr>
					<td>Subject 1</td>
					<td>3</td>
					<td>Teacher 1</td>
					<td>Room 101</td>
				</tr>
			</table>
		</div>
		<div class="column side">
			<h1>Add a Subject</h1>
			<form>
				Subject: <br>
				<input type="text" name="Subject"> <br>
				Meetings Per Week: <br>
				<select name="Meetings">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select><br>
				Teacher: <br>
				<select name="Teachers">
					<?php foreach($teachers as $teacher){ ?>
					<option value="$teacher[last]"><?php echo($teacher['last']. ", " . $teacher['first']); ?></option>
					<?php } ?>
				</select><br>
				Room: <br>
				<select name="Rooms">
					<?php foreach($rooms as $room){ ?>
					<option value="$room[room_name]"><?php echo($room['room_name']); ?></option>
					<?php } ?>
				</select><br>
				<input type="submit">
			</form>
		</div>		
	</div>
	<div class="footer">
		<p>©2B03</p>
	</div>
</body>
</html>