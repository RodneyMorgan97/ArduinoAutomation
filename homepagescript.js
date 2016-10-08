function validateData()
{
	var field = document.getElementById("submit");
	alert(field.value);
	if (field !== parseInt(field, 10))
	{
		alert("that is not an integer.");
	}


