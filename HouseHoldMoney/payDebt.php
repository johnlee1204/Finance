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

$debtId = $_GET['debtId'];
$amount = $_GET['amount'];

$sql = "SELECT
debtor,
creditor,
amount,
amountPaid
FROM debts
WHERE identity_column = {$debtId}
";
$debt = $conn->query($sql)->fetch_assoc();
if ($debt['debtor'] !== $userId && $debt['creditor'] !== $userId) {
	echo "<script>alert('You can not pay debts not associated with you')</script>";
	echo "<script>location.href='viewDebts.php'</script>";
}
$newAmountPaid = $debt['amountPaid'] + $amount;
//new payment wont pay the rest of debt
$totalDebt = $debt['amount'];
$date = date('Y-m-d h:m:s');
if ($debt['amount'] - $debt['amountPaid'] > $amount) {

	$sql = "UPDATE debts
	SET 
	amountPaid = '$newAmountPaid',
	lastPaymentDate = '$date'
	WHERE identity_column = '$debtId'
	";
	if(FALSE === $conn->query($sql)) {
		print_r($conn->error);
	}
} else {
	$sql = "UPDATE debts
	SET 
	amountPaid = '$totalDebt',
	paid = 1,
	datePaid = '$date'
	WHERE identity_column = '$debtId'
	";
	if(FALSE === $conn->query($sql)) {
		print_r($conn->error);
	}
}
echo "<script>location.href='viewDebts.php'</script>";