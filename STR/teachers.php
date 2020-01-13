<?php

	$connect = mysqli_connect('localhost', 'aids', 'password', 'str');

	$sql = 'SELECT id, first, last FROM teacher ORDER BY last';
	$result = mysqli_query($connect, $sql);
	$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	
	//Add and check input
	$errors = array('first'=>'', 'last'=>'');
	if(isset($_POST['submit'])){
		if(empty($_POST['first'])){
			$errors['first'] = 'First name is required';
		}
		if(empty($_POST['last'])){
			$errors['last'] = 'Last name is required';
		}
		if(array_filter($errors)){
		}
		else{
			$first = mysqli_real_escape_string($connect, $_POST['first']);
			$last = mysqli_real_escape_string($connect, $_POST['last']);

			$sql = "INSERT INTO teacher(first,last) VALUES('$first','$last')";

			if(mysqli_query($connect, $sql)){
				//succesful adding
				header('Location: teachers.php');
			}
			else{
				echo mysqli_error($connect);
			}
		}
	}
	//end of add

	if(isset($_GET['id'])){
		$id_to_delete = $_GET['id'];
		$sql = "DELETE FROM teacher WHERE id = $id_to_delete";
		if(mysqli_query($connect, $sql)){
			header('Location: teachers.php');
		}
		else{
			echo 'name does not exist';
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
		<a href="teachers.php" class="selected">Teachers</a>
  		<a href="sections.php">Sections</a>
  		<a href="rooms.php">Rooms</a>
  		<a href="subjects.php">Subjects</a>
  		<a href="days.php">Days</a>
	</div>
	<div class="row">
		<div class="column main">
			<h1>Teachers Database</h1>
			<table>
				<tr>
					<th width="47.5%">Last Name</th>
					<th width="47.5%">First Name</th>
					<th width="5%">Remove</th>
				</tr>

				<?php foreach($teachers as $teacher){ ?>
				<tr>
					<td width="47.5%"><?php echo($teacher['last']); ?></td>
					<td width="47.5%"><?php echo($teacher['first']); ?></td>
					<th width="5%"><a href="teachers.php?id=<?php echo $teacher['id']?>" style="color:red;text-decoration: none;">X</a></th>
				</tr>
				<?php } ?>


			</table>	
		</div>
		<div class="column side">
			<h1>Add a Teacher</h1>
			<form action="teachers.php" method="POST">
				First Name: <br>
				<input type="text" name="first"> <br>
				<div class="error" style="color:red;"><?php echo $errors['first']?></div><br>
				Last Name: <br>
				<input type="text" name="last"> <br>
				<div class="error" style="color:red;"><?php echo $errors['last']?></div><br>
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