//Get the modal
var modal;

window.onload = function initialize() {
	modal = document.getElementById("id02");
}

function myFunction() {
	//Get the header
	var x = document.getElementById("header-colored");
	//Get the main content
	var y = document.getElementById("main-content");
	//If header's class doesn't have responsive in it, add responsive to it (to change it's display) and main content (to change the margins to adjust for header's change in display)
	if (x.className === "header") {
		x.className += " responsive";
		y.className += " responsive";
	} else {
		//If the header has responsive in its name, revert it to normal header and normal content again
		x.className = "header";
		y.className = "main-content";
	}
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
