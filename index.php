<!--
<?php
	if(isset($_POST['saveButton']))
	{
		echo $_POST['temp'];
	}


?>

-->


<html>
	<head>
		<title>ARDUINO AUTOMATION</title>
		<link href="homepage.css" rel="stylesheet"/>
		<script src="homepagescript.js" type = "text/javascript"></script>
	</head>

	<body>
		<form method= "post" action="">
			<input id="submit" type = "text" placeholder= "  Enter Max Temperature" class="textField" name="temp"/>
			<button onclick="validateData()" type="submit" name="saveButton" id= "submitButton" class="button">Submit</button>
		</form>
	<form action="https://api.particle.io/v1/devices/350039001747343338333633/led?access_token=e3e9e2eee3feb94de60d0f33aa50c41cbc871543" method="POST">
    
    <br>
    <h2>What is your desired light level?</h2>
    <input type="radio" name="args" value="dark">Dark
    <br>
    <input type="radio" name="args" value="dim">Dim
    <br>
    <input type="radio" name="args" value="light">Light
    <br>
    <input type="radio" name="args" value="bright">Bright
    <br>
    <input type="radio" name="args" value="very bright">Very Bright
    <br>
    <br>
    <input type="submit" value="Do it!">
  </form>
	</body>

</html>