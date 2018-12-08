<?php
$message = 'forgot';
echo '
<title>Forgot Password</title>
<h1>myMovies Xpress!</h1>
<script  src="./script.js"></script>
Enter Username to recover password
<form action="./logon.php" method="post">
Usermane
<input type="text" name="user" id="user" required>
<br>
<input type="submit" value="Submit">
<input type="reset" value="Clear">
<input type="button" value="Cancel" onclick="test1(\''.$message.'\')">
<input type="hidden" name="action" value="forgot">
</form>';
?>
