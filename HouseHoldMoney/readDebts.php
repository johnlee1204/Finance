<?php


function readDebtsByDebtor($debtor, $orderBy, $dir) {
	$servername = "localhost";
	$username = "johntheadmin";
	$password = "Echo120499!";
	$dbname = "houseFinance";
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT 
		debtor,
		creditor,
		dateCreated,
		dateExpected,
		amount
		FROM debts
		WHERE debtor = $debtor
		ORDER BY $orderBy $dir
		";
	return $conn->query($sql);
}

function readDebtsByCreditor($creditor, $orderBy, $dir) {
	$servername = "localhost";
	$username = "johntheadmin";
	$password = "Echo120499!";
	$dbname = "houseFinance";
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT 
		debtor,
		creditor,
		dateCreated,
		dateExpected,
		amount
		FROM debts
		WHERE debtor = {$creditor}
		ORDER BY {$orderBy} {$dir}
		";
	return $conn->query($sql);
}
