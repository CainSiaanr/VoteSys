//Get the modal
var modal;

window.onload = function initialize() {
	modal = document.getElementById("id02");
}

function myFunction() {
	//Get the header
	var x = document.getElementById("header");
	//Get the main content
	var y = document.getElementById("main-content");
	//If header's class doesn't have responsive in it, add responsive to it (to change it's display) and main content (to change the margins to adjust for header's change in display)
	if (x.className === "header") {
		x.className += " responsive";
		y.className += " responsive";

		//Get all the buttons, dropdowns, and arrow icons
		var y1 = document.getElementById("dropbtn1");
		var y2 = document.getElementById("dropbtn2");

		var z1 = document.getElementById("dropdown1");
		var z2 = document.getElementById("dropdown2");

		var zz1 = document.getElementById("arrow-right1");
		var zz2 = document.getElementById("arrow-right2");

		//It's the same for all 4 functions
		//When one of the buttons is clicked...
		y1.onclick = function () {
			//The function check whether or not the button is on clicked/active mode or not and ads/removes class name according to the situation
			if (z1.className === "dropdown") {
				z1.className += " clicked";
				zz1.className = "fa fa-angle-down arrow-right";

				//Close other tabs
				z2.className = "dropdown";
				zz2.className = "fa fa-angle-right arrow-right";
			} else {
				z1.className = "dropdown";
				zz1.className = "fa fa-angle-right arrow-right";
			}
		}

		y2.onclick = function () {
			if (z2.className === "dropdown") {
				z2.className += " clicked";
				zz2.className = "fa fa-angle-down arrow-right";

				z1.className = "dropdown";
				zz1.className = "fa fa-angle-right arrow-right";
			} else {
				z2.className = "dropdown";
				zz2.className = "fa fa-angle-right arrow-right";
			}
		}
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
