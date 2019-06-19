<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "houseFinance";
$conn = new mysqli($servername, $username, $password, $dbname);
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "INSERT INTO users(username, password, firstName, lastName)
VALUES('$username','$password','$firstName','$lastName')";
$conn->query($sql);
echo "<script>location.href='login.php'</script>";
