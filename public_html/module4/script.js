function addMovie(movieID) {
window.location.replace("./index.php?action=add&movie_id=" + movieID);

return true;
}

function confirmRemove(title,movieID) {
var tr = true;

if(window.confirm("Are you sure you want to remove " + title + "?")){
	window.location.replace("./index.php?action=remove&movie_id=" + movieID);
} else {
tr = false;
}

return tr;

} 


function confirmCheckout() {
var tr = true;
        
if(window.confirm("Are you sure you wish to checkout?")){
        window.location.replace("./index.php?action=checkout");     
} else {
tr = false; 
}   
    
return tr;
}


function confrimLogout() {
window.location.replace("./logon.php?action=logoff");
}

function test() {

alert('something');
}
