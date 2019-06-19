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
debts.identity_column,
debtor,
creditor,
CONCAT(c.firstName,' ', c.lastName) creditorName,
CONCAT(d.firstName,' ', d.lastName) debtorName,
dateCreated,
dateExpected,
amount,
amountPaid,
lastPaymentDate
FROM debts
left join users c on c.identity_column = creditor
left join users d on d.identity_column = debtor
WHERE paid = 0
AND 
(
debtor = '$userId'
OR 
creditor = '$userId'
)
ORDER BY dateExpected asc
";
if(FALSE === $debts = $conn->query($sql)) {
	print_r($conn->error);
}
echo "
<head>
<meta name='viewport' content='width=device-width, initial-scale=1' /> 
<title>View Debts</title>
</head>
<style>
.homeButton {
	margin-bottom: 15px;
}
.payButton {
	margin-bottom: 5px;
	margin-top: 5px;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
tbody td{
	text-align:center;
}

tbody tr:nth-child(even){
  background-color: #cff4f9;
  color: #000000;
}
</style>";
echo "<script>
	function payDebt(id) {
		var oReq = new XMLHttpRequest(); //New request object
		oReq.onload = function() {
			location.reload(true);
		};
		oReq.open('get', 'payDebt.php?debtId='+id+'&amount='+prompt('Enter Payment Amount'), true);
		oReq.send();
	}
	var mainPageUrl = 'index.php';
</script>";

echo "<button class = 'homeButton' onclick = 'location.href=mainPageUrl'><img src = 'home.png'>Main Page</button>";
echo "<table width = '75%'>
		<tr>
			<th>Debtor</th>
			<th>Creditor</th>
			<th>Date Created</th>
			<th>Date Expected</th>
			<th>Amount</th>
			<th>Amount Paid</th>
			<th>Amount Left</th>
			<th>Last Payment Date</th>
		</tr>";
while($debt = $debts->fetch_assoc()) {
	$debt['dateCreated'] = date("m/d/Y", strtotime($debt['dateCreated']));
	$debt['dateExpected'] = date("m/d/Y", strtotime($debt['dateExpected']));
	$debt['lastPaymentDate'] = date("m/d/Y", strtotime($debt['lastPaymentDate']));
	if ($debt['lastPaymentDate'] == '01/01/1970') {
		$debt['lastPaymentDate'] = "";
	}
	$amountLeft = ($debt['amount'] - $debt['amountPaid']);
	$amountLeft = '$'.number_format(floatval($amountLeft), 2,'.', ',');
	$debt['amount'] = '$'.$debt['amount'];
	$debt['amountPaid'] = '$'.$debt['amountPaid'];
	$id = $debt['identity_column'];
	echo "<tr>
			<td>{$debt['debtorName']}</td>
			<td>{$debt['creditorName']}</td>
			<td>{$debt['dateCreated']}</td>
			<td>{$debt['dateExpected']}</td>
			<td>{$debt['amount']}</td>
			<td>{$debt['amountPaid']}</td>
			<td>{$amountLeft}</td>
			<td>{$debt['lastPaymentDate']}</td>
			<td><button class = 'payButton' type = 'button' onclick = 'payDebt($id)'><img src = 'pay.png'>Pay Debt</button></td>
		  </tr>";
}
echo "</table>";