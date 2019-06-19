<?php

echo "<script>var mainPageUrl = 'index.php'</script>";
echo "<button onclick = 'location.href=mainPageUrl'><img src = 'home.png'>Main Page</button>";
echo "
<head>
<meta name='viewport' content='width=device-width, initial-scale=1' /> 
<title>Create User</title>
</head>
<style>
button {
	margin-bottom: 15px;
}
div {
	display: block;
	margin-right: auto;
	margin-left: auto;
}
label {
	position:absolute;
}
.topInput {
	position: relative;
	margin-left: 125px;
	margin-bottom: 5px;
}

</style>
<form id = 'form' action = 'createUserScript.php' method = 'POST'>
<div>
<label>First Name:</label> <input class = 'topInput' id = 'firstName' name = 'firstName' required> <br>
<label>Last Name:</label> <input class = 'topInput' id = 'lastName' name = 'lastName' required> <br>
<label>Username:</label> <input class = 'topInput' id = 'username' name = 'username' required> <br>
<label>Password:</label> <input class = 'topInput' type = 'password' id = 'password' name = 'password' type = 'date' required> <br>
<input type = 'submit'>
</div>
";