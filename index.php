<?php
	//$mysql->connect('localhost','root','pw','')


 ?>


<html>
	<head>
		<title>ARDUINO AUTOMATION</title>
		<link href="homepage.css" rel="stylesheet"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</head>

	<body>
		<form id = "tempLevel">
			<input id="temp"  type = "text" placeholder= "  Enter Max Temperature" class="textField" name="temp"/>
			<button type="submit",  name="saveButton" id= "submitButton" class="button">Submit</button>
		</form>
	<form id ="lightLevel">
    
    <br>
    <h2>What is your desired light level?</h2>
    <input type="radio" name="args" value="0">Dark
    <br>
    <input type="radio" name="args" value="11">Dim
    <br>
    <input type="radio" name="args" value="201">Light
    <br>
    <input type="radio" name="args" value="501">Bright
    <br>
    <input type="radio" name="args" value="801">Very Bright
    <br>
    <br>
    <input type="submit" value="Submit">
  </form>
	</body>

<script>

$('#tempLevel').submit(function(event) {
	event.preventDefault();
	var field = document.getElementById("temp");

	if (isNaN(field.value))	{
   		document.getElementById("temp").value = "";
		alert("You have entered information other than a number.");
   	}
   	else {
     	$.ajax({
        	type: 'POST',
        	url: 'https://api.particle.io/v1/devices/350039001747343338333633/setMaxTemp?access_token=e3e9e2eee3feb94de60d0f33aa50c41cbc871543',
        	data: $(this).serialize()
   		});

    	$.ajax({
        	type: 'POST',
        	url: 'addToDB.php',
        	data: $(this).serialize()
   		});

   		document.getElementById("temp").value = "";
   	}

})

$('#lightLevel').submit(function(event) {
	$('input[name="args"]').attr('checked', false);
	event.preventDefault();
   $.ajax({
        type: 'POST',
        url: 'https://api.particle.io/v1/devices/350039001747343338333633/setMaxLight?access_token=e3e9e2eee3feb94de60d0f33aa50c41cbc871543',
        data: $(this).serialize()
   });

   $.ajax({
        type: 'POST',
        url: 'addToDB.php',
        data: $(this).serialize()
   });

})

</script>

</html>