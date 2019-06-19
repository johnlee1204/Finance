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
$sql = "SELECT
		firstName,
		lastName,
		identity_column
		FROM users";
$users = $conn->query($sql);
$sql = "SELECT
		firstName,
		lastName,
		identity_column
		FROM users";
$usersCopy = $conn->query($sql);

echo "<script>var mainPageUrl = 'index.php'</script>";
echo "<button onclick = 'location.href=mainPageUrl'><img src = 'home.png'>Main Page</button>";
echo "
<head>
<meta name='viewport' content='width=device-width, initial-scale=1' /> 
<title>Create Debt</title>
</head>
<style>
button {
	margin-bottom: 15px;
}

label {
	position:absolute;
}
.topInput {
	position: relative;
	margin-left: 200px;
	margin-bottom: 5px;
}

</style>
<form id = 'form' action = 'addDebt.php' method = 'POST'>
<div>
<label>Debtor:</label> <select class = 'topInput' id = 'debtor' name = 'debtor' required>
<option value='0' selected disabled>(please select:)</option> 
";
while($user = $users->fetch_assoc()) {
	$value = $user['identity_column'];
	$name = $user['firstName']. ' ' . $user['lastName'];
	echo "<option value='$value'>$name</option>";
}
echo "
</select>
</br>
<label>Creditor:</label> <select class = 'topInput' id = 'creditor' name = 'creditor' required> 
	<option value='0' selected disabled>(please select:)</option>
	";
while($user = $usersCopy->fetch_assoc()) {
	$value = $user['identity_column'];
	$name = $user['firstName']. ' ' . $user['lastName'];
	echo "<option value='$value'>$name</option>";
}
echo "
</select>
<br>
<label>Amount:</label> <input class = 'topInput' id = 'amount' name = 'amount' required> <br>
<label>Date Payment Expected:</label> <input class = 'topInput' id = 'dateExpected' name = 'dateExpected' type = 'date' required> <br>
<input type = 'submit'> 
</div>
";