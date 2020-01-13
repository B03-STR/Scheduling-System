<?php

	$connect = mysqli_connect('localhost', 'aids', 'password', 'str');

	$sql = 'SELECT id, section_name, grade_level FROM section ORDER BY grade_level,section_name';
	$result = mysqli_query($connect, $sql);
	$sections = mysqli_fetch_all($result, MYSQLI_ASSOC);

	
	//Add and check input
	$errors = array('section'=>'');
	if(isset($_POST['submit'])){
		if(empty($_POST['Section'])){
			$errors['section'] = 'Section name is required';
		}
		if(array_filter($errors)){
		}
		else{
			$section = mysqli_real_escape_string($connect, $_POST['Section']);
			$grade = mysqli_real_escape_string($connect, $_POST['GradeLevel']);

			$sql = "INSERT INTO section(section_name,grade_level) VALUES('$section','$grade')";

			if(mysqli_query($connect, $sql)){
				header('Location: sections.php');
			}
			else{
				echo mysqli_error($connect);
			}
		}
	}
	//end of add

	if(isset($_GET['id'])){
		$id_to_delete = $_GET['id'];
		$sql = "DELETE FROM section WHERE id = $id_to_delete";
		if(mysqli_query($connect, $sql)){
			header('Location: sections.php');
		}
		else{
			echo 'section does not exist';
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
  		<a href="sections.php" class="selected">Sections</a>
  		<a href="rooms.php">Rooms</a>
  		<a href="subjects.php">Subjects</a>
  		<a href="days.php">Days</a>
	</div>
	<div class="row">
		<div class="column main">
			<h1>Sections Database</h1>
			<table>
				<tr>
					<th width="70%">Section</th>
					<th width="25%">Grade Level</th>
					<th width="5%"	>Remove</th>
				</tr>
				<?php foreach($sections as $section){ ?>
				<tr>
					<td width="70%"><?php echo($section['section_name']); ?></td>
					<td width="25%"><?php echo($section['grade_level']); ?></td>
					<th width="5%"><a href="sections.php?id=<?php echo $section['id']?>" style="color:red;text-decoration: none;">X</a></th>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="column side">
			<h1>Add a Section</h1>
			<form action="sections.php" method="POST">
				Section: <br>
				<input type="text" name="Section"> <br>
				<div class="error" style="color:red;"><?php echo $errors['section']?></div><br>
				Grade Level: <br>
				<select name="GradeLevel">
					<option value="7">7</option>	
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select><br>
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