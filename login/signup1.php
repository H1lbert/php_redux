<!doctype html>
<html>
    <head>
<title>Login</title>
<?php
require_once("dbcon.php");
$user = filter_input(INPUT_POST, 'user'); //the username written in the form
$passinput = filter_input(INPUT_POST, 'pass'); //the password writen in the form
$pass = password_hash($passinput, PASSWORD_DEFAULT);// the password given to us after it's been through the Hash-


echo 'u='.$user.' psword='.$pass;

$sql = "INSERT INTO testDB (user, pass) VALUES (?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param('ss', $user, $pass);
$stmt->execute();

echo 'xyz';


?>


        
        </head>
    <body>

    
    </body>
</html>