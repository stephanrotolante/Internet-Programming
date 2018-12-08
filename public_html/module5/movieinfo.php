<!DOCTYPE html>
<html>
<head>
</head>
<body>
	 <script  src="./script.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/site.css"> 
</body>
</html>
<?php
session_start();
require_once '/home/dbInterface.php';
processPageRequest();

function createMessage($movieId){
$result = getMovieData($movieId);
if(is_null($result)){
echo '<div class="modal-header">
    <span class="close">[Close]</span>
    <h2>Title (Year) Rated Rated Runtime<br />Genre</h2>
</div>
<div class="modal-body">
    <p>Actors: Actors<br />Directed By: Director<br />Written By: Writer</p>
</div>
<div class="modal-footer">
    <p>Invalid Movie ID</p>
</div>';
} else {
echo '<div class="modal-header">
    <span class="close">[Close]</span>
    <h2>'.$result['Title'].' ('.$result['Year'].') Rated '.$result['Rated'].' '.$result['Runtime'].'<br />Genre</h2>
</div>
<div class="modal-body">
    <p>Actors: '.$result['Actors'].'<br />Directed By: '.$result['Director'].'<br />Written By: '.$result['Writer'].'</p>
</div>
<div class="modal-footer">
    <p>'.$result['Plot'].'</p>
</div>';
}
}
function processPageRequest(){
if(!isset($_SESSION['name'])){
header("Location: http://192.168.100.86/~rs291602/module5/index.php");
} else if(isset($_GET['movie_id'])){
createMessage($_GET['movie_id']);
} else {
createMessage(0);
}
}
?>
