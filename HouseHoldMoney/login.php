<?php
echo "
<head>
<meta name='viewport' content='width=device-width, initial-scale=1' /> 
<title>Log In</title>
</head>
<style>
        input{
            margin-left:100px;
            margin-bottom: 10px;
        }
        #button{
            margin-left:0;
        }
        label{
            position:absolute;
            margin-bottom: 10px;
        }
        form{

        }
        div{
            text-align:center;
            margin-top:40vh;
            margin-right:auto;
            margin-left:auto;
            display:block;
            background:white;
            padding:20px;
            width:20%;
        }
    </style>

    <script>
	var createAccountUrl = 'createUser.php';
    </script>
    <div>
        <h2>Log In</h2>
        <form action='createSession.php' method='POST'>
            <label>username: </label> <input name='username' placeholder='username'  required><br>
            <label>Password: </label> <input type='password' name='password' placeholder='Password' required><br>
            <input id='button' type='submit'>
        </form>
        <button onclick = 'location.href=createAccountUrl'>Create Account</button>
    </div>
";