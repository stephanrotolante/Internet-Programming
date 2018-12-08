<?php
function processPageRequest() {


	if(isset($_POST['u']) && isset($_POST['p'])) {
		 authenticateUser($_POST['u'],$_POST['p']);
	} else {
		displayLogonForm("");	
	}
}
function displayLogonForm($message="") {
echo '<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
</head>
<body>
<h1>myMovies Xpress!</h1>
<br>
'.$message.'
<form method="post" action="./logon.php">
<table>
<tr>
<td>
Username:
</td>
<td>
<input type="text" name="u" required>
</td>
</tr>
<tr>
<td>
Password:
</td>
<td>
<input type="password" name="p" required>
</td>
</tr>
</table>
<input type="submit" value="Login">
<input type="reset" value="Clear">
</form>
</body>
</html>';
}

function authenticateUser($username,$password) {
$file = "./data/credentials.db";
$document = file_get_contents($file);
$lines = explode(",",$document);

if($username == $lines[0] && $password == $lines[1]){
                  header("Location: http://192.168.100.86/~rs291602/module4/index.php");
			exit;
} else {
displayLogonForm("Please Enter Correct Credendtials");
}

}

processPageRequest(); 
?>
