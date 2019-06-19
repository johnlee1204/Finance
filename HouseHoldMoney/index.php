<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "houseFinance";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_COOKIE["UserCookie"])) {
	$userCookie = $_COOKIE["UserCookie"];
} else {
	echo "<script>location.href='login.php'</script>";
}
$sql = "
	SELECT userId FROM session WHERE sessionCookie = '$userCookie'
";
if(NULL === $user = $conn->query($sql)->fetch_assoc()) {
	echo "<script>location.href='login.php'</script>";
}
$userId = $user['userId'];
$sql = "
	SELECT firstName
	FROM users
	WHERE identity_column = $userId
";
$firstName = $conn->query($sql)->fetch_assoc()['firstName'];
echo "
<head>
<meta name='viewport' content='width=device-width, initial-scale=1' /> 
<title>Finance</title>
</head>
<style>
	button {
		margin-right:25px;
	}
</style>
<h2>Hello, $firstName</h2>
<script>
var addDebtPage = 'addDebtPage.php';
var viewDebts = 'viewDebts.php';
</script>
<button onclick = 'location.href=addDebtPage'>Create Debt</button>
<button onclick = 'location.href=viewDebts'>View Debts</button>
";