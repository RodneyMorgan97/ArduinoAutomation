function validateData()
{
	var field = document.getElementById("temp");
	if (isNaN(field.value))
	{
		event.preventDefault();
		alert("You have entered information xother than a number.");
	}

}
