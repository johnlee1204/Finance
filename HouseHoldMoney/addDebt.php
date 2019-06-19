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
$debtor = $_POST['debtor'];
$creditor = $_POST['creditor'];

if($debtor === $creditor) {
	echo "<script>alert('Creditor and debtor cannot be the same person')</script>";
	echo "<script>location.href='addDebtPage.php'</script>";
}

if($debtor !== $userId || $creditor === $userId) {
	echo "<script>alert('You can only place debts you owe to others')</script>";
	echo "<script>location.href='addDebtPage.php'</script>";
}



$amount = $_POST['amount'];
$dateExpected = $_POST['dateExpected'];
$sql = "INSERT INTO debts(debtor, creditor, dateExpected, amount, paid)
VALUES('$debtor','$creditor','$dateExpected','$amount',0)";

if(FALSE === $conn->query($sql)) {
	print_r($conn->error);
}
echo "<script>location.href='index.php'</script>";
