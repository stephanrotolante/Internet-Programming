function validateCreateAccountForm(){
var set = true;
alert(document.getElementById("em").value.includes(" "));
if(document.getElementById("em").value.includes(" ")){
set = false;
alert("There is a space in the email");
}

if(document.getElementById("ce").value.includes(" ")){
set = false;
alert("There is a space in the email");
}

if(document.getElementById("user").value.includes(" ")){
set = false;
alert("There is a space in the username");
}

if(document.getElementById("pass").value.includes(" ")){
set = false;
alert("There is a space in the password");
}

if(document.getElementById("cpass").value.includes(" ")){
set = false;
alert("There is a space in the password");
}

if(document.getElementById("cpass").value != document.getElementById("pass").value){
set = false;
alert("Passwords do not match");
}

if(document.getElementById("em").value != document.getElementById("ce").value){
set = false;
alert("The emails do not match");
}


return set;

}

function confirmCancel(form){
	var tr = true;
	if(form =="create"){
		if(window.confirm("Are you sure you wish to cancel Create New Account")){
        	window.location.replace("./logon.php");     
		} else {
		tr = false; 
		}  
	} else if(form == "forgot"){
		if(window.confirm("Are you sure you wish to cancel Forgot Password")){
        	window.location.replace("./logon.php");     
		} else {
		tr = false; 
		}  
	} else if(form == "reset"){
		if(window.confirm("Are you sure you wish to cancel Reset Password")){
        	window.location.replace("./logon.php");     
		} else {
		tr = false; 
		}  
        } else if(form == "search"){
		if(window.confirm("Are you wish to cancel the Movie Search")){
        	window.location.replace("./index.php");     
		} else {
		tr = false; 
		}  
        }
return tr;
}

function addMovie(movieID) {
window.location.replace("./index.php?action=add&movie_id=" + movieID);
c
return true;
}



function confirmCheckout() {
var tr = true;
if(window.confirm("Are you sure you wish to checkout?")){
window.location.replace("./index.php?action=checkout");
 }
else { tr = false;
} return tr;
}

function confirmLogout(){
var tr = true;

if(window.confirm("Are you sure to logout")) {
window.location.replace("./index.php?action=logoff");
} else {
tr = false;
}

return tr;
}




function confirmRemove(title,movie_id){
var tr = true;

if(window.confirm("Are you sure to remove " + title)) {
console.log(movie_id);
window.location.replace("./index.php?action=remove&movie_id=" + movie_id);
} else {
tr = false;
}

return tr;
}



function changeMovieDisplay() {
var sel = document.getElementById("select_order").value;

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    document.getElementById("shopping_cart").innerHTML = this.responseText;
	console.log(this.responseText);
    };
xhttp.open("GET", "./index.php?action=update&order="+sel,true);
xhttp.send();
}



function displayMovieInformation(movie_id){
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    document.getElementById("modalWindowContent").innerHTML = this.responseText;
   showModalWindow();
	};
xhttp.open("GET", "./movieinfo.php?movie_id="+movie_id,true);
xhttp.send();
}

function showModalWindow()
{
    var modal = document.getElementById('modalWindow');
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() 
    { 
        modal.style.display = "none";
    }

    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
 
    modal.style.display = "block";
}

function validateResetPasswordForm(){
var set = true;
if(document.getElementById("pass").value.includes(" ")){
set = false;
alert("There is a space in the password");
}
if(document.getElementById("cpass").value.includes(" ")){
set = false;
alert("There is a space in the password");
}

if(document.getElementById("cpass").value != document.getElementById("pass").value){
set = false;
alert("Passwords do not match");
}
return set;
} 

