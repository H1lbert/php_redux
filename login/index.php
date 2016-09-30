<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">  
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>PHP menu</title>
        
    </head>
<body>

<div class="menu">
<?php include 'menu.php';?>
</div>
<h1>Welcome to my solution!</h1>
<h1>Sign up!</h1>
    <!-- Nedenfor ses de 2 html former som henviser til den PHP kode samt sql formulering der gør at de indskrevne data bliver gemt og opbevaret. De er connected til PHP koden ved brug af "name" funktionen, som bliver benyttet i PHP  -->
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

//Nedenfor ses de filtreringer samt samspillet med formen, skrevet i PHP, hvilket gør at de indskrevne data bliver gemt samt sendt til databasen, så brugeren nemt kan logge ind efterfølgende.
$user = filter_input(INPUT_POST, 'user');
$passinput = filter_input(INPUT_POST, 'pass'); 
$pass = password_hash($passinput, PASSWORD_DEFAULT);
echo password_verify($passinput, $pass) ? 'User has been created Succesfully' : 'Something went wrong :(!';
 
    $stmt = $link->prepare("INSERT INTO testDB (username, password) VALUES (?,?)"); 
	$stmt->bind_param('ss', $user, $pass);     
    $stmt->execute();
}
?>
    
    
    
    

    <?php
if (isset($_POST['login'])) {
    require_once("dbcon.php");

 	// Nedenfor er der givet betingelser for username og password, samt linket til formen.
	$user = filter_input(INPUT_POST, 'userlog'); //PHP koden som beskriver filteret for Username formen, som spiller sammen med formen login
	$passinput = filter_input(INPUT_POST, 'passlog'); //Og her er password formen blevet linket til ovenstående form, samt filtreret.
    // nedenfor ses formulering af sql query som PHP string, så de indskrevede data bliver sat ind i databasen.
    $sql = "SELECT id, password FROM testDB WHERE username = ?";

$stmt = $link->prepare($sql);
$stmt->bind_param('s', $user);
$stmt->execute();

    //Resten af nedenstående kode genererer passwordet som hash, for at brugeren trykt kan oprette sig på siden, uden at passwordet kan ses i phpmyadmin osv. Derudover bliver der, efter brugeren har logget ind, redirected til den side som kun kan finde, hvis man er logget ind.
$stmt->bind_result($uid, $pwHash);

    if($stmt->fetch()){		
        $passinput = $passinput;
		$pwHash = $pwHash;
		
		if (password_verify($passinput, $pwHash)) {
			$_SESSION['uid'] = $user;
		?><meta http-equiv="refresh" content="0; url=http://localhost:8888/login/secretsites/secret.php" /> <?php
		} else {
			echo 'Something went terribly wrong !';
		}
	} 
}
    ?>
</body>
</html>