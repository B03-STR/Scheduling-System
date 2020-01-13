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
  		<a href="subjects.php">Subjects</a>
  		<a href="days.php" class="selected">Days</a>
	</div>
	<div class="row">
		<div class="column main">
			<h1>Days Database</h1>
			<table>
				<tr>
					<th>Day</th>
					<th>Periods</th>
				</tr>
				<tr>
					<td>Monday</td>
					<td>8</td>
				</tr>
			</table>
		</div>
		<div class="column side">
			<h1>Add a Day</h1>
			<form>
				Day: <br>
				<input type="text" name="Day"> <br>
				Periods: <br>
				<select name="Periods">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
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