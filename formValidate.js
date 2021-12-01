/*-------w----------

    Project 3
    Name: Adam Hildebrand
    Date: 4-24-2021
    Description: Form Validate
	
------------------->*/

function validate(e)
	{
		if(formHasErrors())
		{
			e.preventDefault();

			return false;
		}

		return true;
	}

	function formHasErrors()
	{
		let errorFlag = false;	

		let requiredFields = ["username", "password", "email"];

		for(let i=0; i<requiredFields.length; i++)
		{
			let textField = document.getElementById(requiredFields[i]);

			if(!formFieldHasInput(textField))
			{
				document.getElementById(requiredFields[i] + "_error").style.display = "block";

				if(!errorFlag)
				{
					textField.focus();
					textField.select();
				}

				errorFlag = true;
			}
		}

		
		let regEmail = new RegExp(/^.+@.+$/);

		let phone = document.getElementById("password").value;
		let emailAddress = document.getElementById("email").value;
				

		if(!regEmail.test(emailAddress))
		{
			document.getElementById("emailformat_error").style.display = "block";
			document.getElementById("emailformat_error").style.visibility = "visible";

			if(!errorFlag)
				{
					document.getElementById("email").focus();
					document.getElementById("email").select();
				}

				errorFlag = true;
		}

		return errorFlag;
	}

	function resetForm(e){
	// Confirm that the user wants to reset the form.
	if ( confirm('Clear Form?') )
	{
		// Ensure all error fields are hidden
		hideAllErrors();
		
		// Set focus to the first text field on the page
		document.getElementById("fname").focus();
		
		// When using onReset="resetForm()" in markup, returning true will allow
		// the form to reset
		return true;
	}

	// Prevents the form from resetting
	e.preventDefault();
	
	// When using onReset="resetForm()" in markup, returning false would prevent
	// the form from resetting
	return false;
}

	/*
 * Hides all of the error elements.
 */
function hideErrors(){
	// Get an array of error elements
	let error = document.getElementsByClassName("error");

	// Loop through each element in the error array
	for ( let i = 0; i < error.length; i++ ){
		// Hide the error element by setting it's display style to "none"
		error[i].style.display = "none";
	}
}

function trim(str){
	// Uses a regex to remove spaces from a string.
	return str.replace(/^\s+|\s+$/g,"");
}

/*
 * Determines if a text field element has input
 *
 * param   fieldElement A text field input element object
 * return  True if the field contains input; False if nothing entered
 */
function formFieldHasInput(fieldElement){
	// Check if the text field has a value
	if ( fieldElement.value == null || trim(fieldElement.value) == "" )
	{
		// Invalid entry
		return false;
	}
	
	// Valid entry
	return true;
}

function load(){

	hideErrors();

	document.getElementById("orderform").addEventListener("submit", validate);

	document.getElementById("orderform").addEventListener("reset", resetForm);

}

// Add document load event listener
document.addEventListener("DOMContentLoaded", load);
