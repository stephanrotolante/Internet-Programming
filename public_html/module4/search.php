<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
</head>
<body>
	 <script  src="./script.js"></script>
</body>
</html>
<?php
function displaySearchResults($searchString){
$results = file_get_contents('http://www.omdbapi.com/?apikey=5d80263a&s='.urlencode($searchString).'&type=movie&r=json');
$array = json_decode($results, true)["Search"];
echo '<table>';
foreach($array as $value){
	$test = "one";
	echo '<tr>';
		echo '<td>';
			echo '<img src="'.$value[Poster].'">';
		echo '</td>';

		echo '<td>';
                        echo '<a target="_blank" href="https://www.imdb.com/title/'.$value[imdbID].'">'.$value[Title].'('.$value[Year].')</a>';
                echo '</td>';

		echo '<td>';
                        echo '<a href="#" onclick="addMovie(\''.$value[imdbID].'\')">+</a>';
		 echo '</td>';
	echo '</tr>';

}
echo '</table>';
$go = 'index.php';
      echo' <input type="button" value="Cancel" onclick="window.location=\''.$go.'\';">';
 }
session_start();
processPageRequest();

function displaySearchForm(){
echo "<html>
	<h1>myMovies Xpress!</h1>
    <form action='./search.php' method='post'>
        Keyword:<input type='text' name='key' required>
        <br>";
$go = 'index.php';
      echo' <input type="button" value="Cancel" onclick="window.location=\''.$go.'\';">';
echo "<input type='submit' value='Search'><input type='reset' value='Clear'>";
echo "</form>
</html>";
}
function processPageRequest() {

if(isset($_POST['key'])){
displaySearchResults($_POST['key']);
} else {
displaySearchForm();
}
}
?>
