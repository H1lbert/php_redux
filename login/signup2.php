<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<?php include 'menu.php';?>
<h1>Sign up!</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Username:<br>
  <input type="text" name="user" required>
  <br>
  Password:<br>
  <input type="password" name="pass" required>
    <br><br>
    <input type="submit" name="regis" value="Sign Up Now!">
</form>

    
<h1>Login !</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Username:<br>
  <input type="text" name="userlog" required>
  <br>
  Password:<br>
  <input type="password" name="passlog" required>
    <br><br>
    <input type="submit" name="login" value="Login">
</form>
    
    
    <?php 
// connect 
if (isset($_POST['regis'])) {

require_once("dbcon.php"); 


$user = filter_input(INPUT_POST, 'user');
$passinput = filter_input(INPUT_POST, 'pass'); 
$pass = password_hash($passinput, PASSWORD_DEFAULT);
echo password_verify($passinput, $pass) ? 'Bruger oprettet' : 'Noget gik galt!';
 
    $stmt = $link->prepare("INSERT INTO testDB (username, password) VALUES (?,?)"); 
	$stmt->bind_param('ss', $user, $pass);     
    $stmt->execute();
}
?>
    
    
    
    

    <?php
if (isset($_POST['login'])) {

 	// avoiding sql injection (' or 0=0 #) by escaping special characters in sql queries
	$user = filter_input(INPUT_POST, 'userlog'); //the username written in the form
	$passinput = filter_input(INPUT_POST, 'passlog'); //the password writen in the form
    // formulating the sql queri as PHP string
    $sql = "SELECT id, password FROM testDB WHERE username = ?";
    // passing the string on to the query method, executing the query

$stmt = $link->prepare($sql);
$stmt->bind_param('s', $user);
$stmt->execute();

$stmt->bind_result($uid, $pwHash);

    if($stmt->fetch()){		
        $passinput = $passinput;
		$pwHash = $pwHash;
		
		if (password_verify($passinput, $pwHash)) {
			$_SESSION['uid'] = $user;
		?><meta http-equiv="refresh" content="0; url=http://localhost/login/index.html" /> <?php
		} else {
			echo 'Something went terribly wrong !';
		}
	} 
}
    ?>
    
    
    
</body>
</html>