<?php 

	$connect = mysqli_connect('localhost', 'aids', 'password', 'str');

	$sql = 'SELECT id, room_name FROM room ORDER BY room_name';
	$result = mysqli_query($connect, $sql);
	$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$errors = array('rooms'=>'');
	if(isset($_POST['submit'])){
		if(empty($_POST['Room'])){
			$errors['rooms'] = 'Room name is required';
		}
		if(array_filter($errors)){
		}
		else{
			$rooms = mysqli_real_escape_string($connect, $_POST['Room']);

			$sql = "INSERT INTO room(room_name) VALUES('$rooms')";

			if(mysqli_query($connect, $sql)){
				//succesful adding
				header('Location: rooms.php');
			}
			else{
				echo mysqli_error($connect);
			}
		}
	}

	if(isset($_GET['id'])){
		$id_to_delete = $_GET['id'];
		$sql = "DELETE FROM room WHERE id = $id_to_delete";
		if(mysqli_query($connect, $sql)){
			header('Location: rooms.php');
		}
		else{
			echo 'room does not exist';
		}
	}
	//end of delete

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
  		<a href="rooms.php" class="selected">Rooms</a>
  		<a href="subjects.php">Subjects</a>
  		<a href="days.php">Days</a>
	</div>
	<div class="row">
		<div class="column main">
			<h1>Rooms Database</h1>
			<table>
				<tr>
					<th width="95%">Rooms</th>
					<th width="5%">Remove</th>
				</tr>
				<?php foreach($rooms as $room){ ?>
				<tr>
					<td width="95%"><?php echo($room['room_name']); ?></td>
					<th width="5%"><a href="rooms.php?id=<?php echo $room['id']?>" style="color:red;text-decoration: none;">X</a></th>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="column side">
			<h1>Add a Room</h1>
			<form action="rooms.php" method="POST">
				Room: <br>
				<input type="text" name="Room"> <br>
				<div class="error" style="color:red;"><?php echo $errors['rooms']?></div><br>
				<br>
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>		
	</div>
	<div class="footer">
		<p>©2B03</p>
	</div>
</body>
</html>