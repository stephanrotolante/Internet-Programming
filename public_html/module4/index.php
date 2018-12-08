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
 
function displayCart() {
$file = "./data/credentials.db";
$document = file_get_contents($file);
$lines = explode(",",$document);
echo 'Welcome, '.$lines[2].' ';
echo '<a href="#" onclick="confrimLogout()">(logout)</a>';
echo '<br>';
echo '<br>';
echo '<h1>myMovies Xpress!</h1>';

$oldArray = file_get_contents('./data/cart.db');
$array = json_decode($oldArray, true);
echo '<br>';
echo sizeof($array).' Movies in Your Shopping Cart';
echo '<br>';
if(sizeof($array)==0){
echo 'Add Some Movies to Your Cart';
}

echo '<table>';
foreach($array as $value) {
  $movie = file_get_contents('http://www.omdbapi.com/?apikey=5d80263a&i='.$value.'&type=movie&r=json');
  $array = json_decode($movie, true);


	echo '<tr>';
		echo '<td>';
		echo '<img height="100" src="'.$array[Poster].'">';
		echo '</td>';

		echo '<td>';
                        echo '<a target="_blank" href="https://www.imdb.com/title/'.$array[imdbID].'">'.$array[Title].'('.$array[Year].')';
                echo '</td>';

		echo '<td>';
                        echo '<a href="#" onclick="confirmRemove(\''.$array[Title].'\',\''.$array[imdbID].'\')">x</a>'; 
		echo '</td>';

	echo '</tr>';
}
echo '</table>';
$go = 'search.php';
echo '<input type="button" value="Add Movies" onclick="window.location=\''.$go.'\';">';
echo '<input type="button" value="Checkout" onclick="confirmCheckout();">';

}

function removeMovieFromCart($movieID){
	$oldArray = file_get_contents('./data/cart.db');
        $array = json_decode($oldArray, true);
	for($x = 0; $x < sizeof($array); $x++) {
		if($array[$x]==$movieID){
			unset($array[$x]);
			break;
		}
	}
	$new = array_values($array);	
	file_put_contents("./data/cart.db",json_encode($new));		
	displayCart();
}

function addMovieToCart($movieID) {
	$oldArray = file_get_contents('./data/cart.db');
  	$array = json_decode($oldArray, true);
	array_push($array,$movieID);
	file_put_contents("./data/cart.db",json_encode($array));
	displayCart();
}

function processPageRequest(){
	
	
if(isset($_GET['action'])){
	if($_GET['action']=='add'){
		addMovieToCart($_GET['movie_id']);
	} else if($_GET['action']=='remove') {
		removeMovieFromCart($_GET['movie_id']);
	} else if($_GET['action']=='checkout') {
		$file = "./data/credentials.db";
		$document = file_get_contents($file);
		$lines = explode(",",$document);
		checkout($lines[2],$lines[3]);
		
	}
} else {
	displayCart();

}

}

function checkout($name,$address) {
$message='<h1>myMovies Xpress!</h1>';
$oldArray = file_get_contents('./data/cart.db');
$array = json_decode($oldArray, true);
$message=$message.'<br>';
$message=$message.sizeof($array);
$message=$message.' Movies in Your Shopping Cart';
$message=$message.'<br>';

$message=$message.'<table>';
foreach($array as $value) {
  $movie = file_get_contents('http://www.omdbapi.com/?apikey=5d80263a&i='.$value.'&type=movie&r=json');
  $array = json_decode($movie, true);
        $message=$message.'<tr>';
                $message=$message.'<td>';
                $message=$message.'<img height="100" src="'.$array[Poster].'">';
                $message=$message.'</td>';
	$message=$message.'</tr>';
}
$message=$message.'</table>';


	sleep(60);
	$result = sendMail('436790198',$address,$name,"Your Receipt from myMovies!",$message);
}
session_start();
require_once '/home/mail.php';
processPageRequest();


?>
