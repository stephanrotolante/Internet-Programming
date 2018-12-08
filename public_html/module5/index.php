<!DOCTYPE html>
<html>
<head>
    <title>Cart Page</title>
</head>
<body>
	 <script  src="./script.js"></script>
   
</body>
</html>


<?php
session_start();
require_once '/home/dbInterface.php';
require_once '/home/mail.php';
processPageRequest();
function addMovieToCart($movieID){
$result = movieExistsinDB($movieID);
if($result>0){

} else {

$movie = file_get_contents('http://www.omdbapi.com/?apikey=5d80263a&i='.$movieID.'&type=movie&r=json');
$array = json_decode($movie, true);
$result = addMovie($_GET['movie_id'],$array["Title"],$array["Year"],$array["Rating"],$array["Runtime"],$array["Genre"],$array["Actors"],$array["Director"],$array["Writer"],$array["Plot"],$array["Poster"]);
}
addMovieToShoppingCart($_SESSION['id'],$result);
displayCart(false);
}//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

function createMovieList($forEmail){
if($_GET['order']){

$array = getMoviesInCart($_SESSION['id'],$_GET['order']);
} else {

$array = getMoviesInCart($_SESSION['id']);
}

$display = "";
$display=$display.'<table>';
foreach($array as $value){

	$data = getMovieData($value[0]);
	$display=$display.'<tr>'; 
                $display=$display.'<td>'; 
                       $display=$display.'<img height="100" src="'.$data[Poster].'">';
                $display=$display.'</td>';
		$display=$display.'<td>'; 
                       $display=$display.$data['Title'].'('.$data['Year'].')';
                $display=$display.'</td>';
		if($forEmail==false){
		 $display=$display.'<td>';
                       $display=$display.'<a href="javascript:void(0);" onclick="displayMovieInformation(\''.$value[0].'\')">View More Info</a>';
                $display=$display.'</td>';
 		$display=$display.'<td>';
                       $display=$display.'<a href="#" onclick="confirmRemove(\''.$data['Title'].'\',\''.$value[0].'\')">x</a>';

                $display=$display.'</td>';
		}
        $display=$display.'</tr>';

}
$display=$display.'</table>';
return $display;
}

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
function processPageRequest(){
if(isset($_GET['action'])){
	if($_GET['action']=='add'){
	addMovieToCart($_GET['movie_id']);
	} else if($_GET['action']=='remove'){
	removeMovieFromCart($_GET['movie_id']);
	} else if($_GET['action']=='checkout') {
	checkout($_SESSION['name'],$_SESSION['email']);
	} else if($_GET['action']=='update'){
	updateMovieListing($_GET['order']);
	}
} else {
echo displayCart(false);
}

} //77777777777777777777777777777
function removeMovieFromCart($movieID){
removeMovieFromShoppingCart($_SESSION['id'],$movieID);
echo displayCart(false);
} //yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
function checkout($name,$address){
$result = sendMail("436790198",$address,$name,"CHECKOUT",displayCart(true));
} ////555555555555555555555555555555555
function updateMovieListing($order){
echo createMovieList(true);
}
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function displayCart($forEmail){
$display ="";
if($forEmail==false){
$display=$display.'Welcome, '.$_SESSION['name'].' <a href="#"onclick="confirmLogout()">(logout)</a>
        <br>';
}
$result = countMoviesInCart($_SESSION['id']);
$display=$display.'myMovies Xpress!<br>';
if($result == $_SESSION['id']){
} else {
	if($result == 0 ){
	$display=$display.'Add Some Movies in Your Shopping Cart';
	} else if($result > 0){
	$display=$display.'There are '.$result.' Movies in your cart';
	$display=$display.'<br>
	      <select id="select_order" onchange="changeMovieDisplay();">
	      <option value="0" default>Movie Title</option>
	      <option value="1">Runtime (shortest -> longest)</option>
              <option value="2">Runtime (longest -> shortest)</option>
              <option value="3">Year (old -> new)</option>
	      <option value="4">Year (new -> old)</option>
	      </select>';
	$display=$display.'<div id="shopping_cart">';
	$display=$display.createMovieList($forEmail);
		$display=$display.'</div>';

	}
}

if($forEmail==false)
{
$go = 'search.php';
$display=$display.'<br><input type="button" value="Add Movies" onclick="window.location=\''.$go.'\';">';
$display=$display.'<input type="button" value="Checkout" onclick="confirmCheckout()">';
$display=$display.'<div id="modalWindow" class="modal">
    <div id="modalWindowContent"  class="modal-content">
    </div>
</div>';
}
return $display;
}
?>

</body>
</html>


