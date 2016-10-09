function validateData()
{
	var field = document.getEl ementById("submit");
	if (isNaN(field.value))
	{
		alert("You have entered information other than a number.");
	}

}
