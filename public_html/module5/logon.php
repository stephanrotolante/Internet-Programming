<!DOCTYPE html>
<html>
<head>
</head>
<body>
	 <script  src="./script.js"></script>

<?php
function processPageRequest() {
session_destroy();
 

	if(isset($_GET['form'])) {
		if($_GET['form']=='create'){
		displayCreateAccountForm();
		} else if($_GET['form']=='forgot') {
		displayForgotPasswordForm();
		} else if($_GET['form']=='reset') {
		displayResetPasswordForm($_GET['user_id']);
		}
	} else if(isset($_POST['action'])){
		if($_POST['action'] == 'create'){
		createAccount($_POST['user'],$_POST['pass'],$_POST['DN'],$_POST['em']);
		} else if($_POST['action'] == 'forgot'){
		sendForgotPasswordEmail($_POST['user']);
		} else if($_POST['action'] == 'login'){
		authenticateUser($_POST['u'],$_POST['p']);
                } else if($_POST['action'] == 'reset'){

		resetPassword($_POST['user_id'],$_POST['pass']);		
                }
	} else if(isset($_GET['action'])){
		validateAccount($_GET['user_id']);
	}else {
		displayLogonForm("");	
	}
}

function displayCreateAccountForm(){
$message = 'create';
echo '
<title>Create Account</title>
<h1>myMovies Xpress!</h1>
<script  src="./script.js"></script>
Enter in the required information to create a new user account
<form action="./logon.php" onsubmit="return validateCreateAccountForm();" method="post">
Display Name
<input type="text" name="DN" id="DN" required>
<br>
Email Address
<input type="text" name="em" id="em"required>
<br>
Confirm Email
<input type="text"  id="ce" required>
<br>
Usermane
<input type="text" name="user" id="user" required>
<br>
Password
<input type="password" name="pass" id="pass" required>
<br>
Confirm Password
<input type="password" id="cpass" required>
<br>
<input type="submit" value="Create Account">
<input type="reset" value="Clear">
<input type="button" value="Cancel" onclick="confirmCancel(\''.$message.'\')">
<input type="hidden" name="action" value="create">
</form>';
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
Please Enter Your Login Information
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
<input type="hidden" name="action" value="login">
<input type="submit" value="Login">
<input type="reset" value="Clear">
<br>
<a href="./logon.php?form=create">Create Account</a>
<br>
<a href="./logon.php?form=forgot">Forgot Password</a>
<br>
<a  href="../index.html">ePortfolio</a>
</form>
</body>
</html>';
}

function displayResetPasswordForm($userId){
$message = 'reset';
echo '<title>Reset Password</title>
<script  src="./script.js"></script>
<h1>myMovies Xpress!</h1>
Reset Your Password
<form action="./logon.php" onsubmit="return validateResetPasswordForm();" method="post">
Password
<input type="password" name="pass" id="pass" required>
<br>
Confirm Password
<input type="password" id="cpass" required>
<input type="submit" value="Reset Password">
<input type="reset" value="Clear">
<input type="button" value="Cancel" onclick="confirmCancel(\''.$message.'\')">
<input type="hidden" name="action" value="reset">
<input type="hidden" name="user_id" value="'.$userId.'">';
}

function displayForgotPasswordForm(){
$message = 'forgot';
echo '
<title>Forgot Password</title>
<h1>myMovies Xpress!</h1>
Enter Username to recover password
<form action="./logon.php" method="post">
Usermane
<input type="text" name="user" id="user" required>
<br>
<input type="submit" value="Submit">
<input type="reset" value="Clear">
<input type="button" value="Cancel" onclick="confirmCancel(\''.$message.'\')">
<input type="hidden" name="action" value="forgot">
</form>';
}

function createAccount($username,$password,$displayName,$emailAddress){
$result = addUser($username,$password,$displayName,$emailAddress);
if($result>0){
sendValidationEmail($result,$displayName,$emailAddress);
}else {
displayLogonForm("Username Exists");
}

}

function sendValidationEmail($userId,$displayName,$emailAddress){
$message = 'myMovies Xpress
<br>
'.$displayName.'
<br>
Your Account has been created, please click the link below and login using your username 
<a href="http://192.168.100.86/~rs291602/module5/logon.php?action=validate&user_id='.$userId.'">Click Here</a>';

$subject = 'myMovies! Account Validation';

$result = sendMail("436790198",$emailAddress,$displayName,$subject,$message);


}

function authenticateUser($username,$password){
	$result = validateUser($username,$password);

if(is_array($result)){
session_start();
print_r($result);

$_SESSION['id'] = $result[0];
$_SESSION['name'] = $result[1];
$_SESSION['email'] = $result[2];
header("Location: http://192.168.100.86/~rs291602/module5/index.php");
}else {
displayLogonForm("Wrong Information");
}
}

function resetPassword($userId,$password){
$result = resetUserPassword($userId,$password);
if($result){
displayLogonForm("Password was Reset");
} else {
displayLogonForm("Password was not Reset");
}

}

function sendForgotPasswordEmail($username){
$result = getUserData($username);
$message = 'myMovies Xpress!
<br>
'.$result[1].', please click the link below to reset password
<br>
<a href="http://198.168.100.86/~rs291602/module5/logon.php?form=reset&user_id='.$result[0].'">Click Here</a>';
sendMail("436790198",$result[2],$result[1],"RESET PASSWORD",$message);
}

function validateAccount($userId){
$results = activateAccount($userId);
if($results){
displayLogonForm("Account Validated");
} else {
displayLogonForm("Account Not Validated");
}
}

require_once '/home/mail.php'; // Add email functionality
require_once '/home/dbInterface.php'; // Add database functionality
processPageRequest(); 
?>
</body>
</html>
