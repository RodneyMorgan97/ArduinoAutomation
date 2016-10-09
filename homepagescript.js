function validateData()
{
	var field = document.getElementById("submit");
	if (isNaN(field.value))
	{
		alert("You have entered information other than a number.");
	}

}
