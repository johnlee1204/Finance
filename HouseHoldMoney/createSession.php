<?php

include_once('Session.php');
$usernameLogin = $_POST['username'];
$userPassword = $_POST['password'];

$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "houseFinance";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->query("SELECT COUNT(identity_column) num FROM users WHERE username = '$usernameLogin' AND password = '$userPassword'")->fetch_assoc()['num'] !== '1') {
	echo "<script>location.href='login.php'</script>";
}
$sql = "
	SELECT
	identity_column
	FROM users 
	WHERE 
	username = '$usernameLogin'
	AND 
	password = '$userPassword'
";
$userInfo = $conn->query($sql)->fetch_assoc();
$userId = $userInfo['identity_column'];
$sql = "
	DELETE FROM session WHERE userId = '$userId'
";
$conn->query($sql);
$sessionCookie = Session::createSession();
$sql = "INSERT INTO session (sessionCookie,userId) VALUES ('$sessionCookie','$userId')";
$conn->query($sql);
setcookie("UserCookie", $sessionCookie, time() + 3600);
echo "<script>location.href='index.php'</script>";
