<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">  
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Secret Page</title>
        
    </head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="submit" name="logout" value="Logout Here">
</form>
</div>

<?php
//Nedenfor ses den PHP kode der henviser til logout filen, som også redirecter til login siden, samt destroyer sessionen. Derudover er den blevet linket til submit knappen som ses ovenfor.
session_start();
if(isset($_POST['logout'])) {
	include("logout.php");
}
?>

    
<div class="menu">
<?php include 'menu.php';?>
</div>
<h1>You have found the secret page</h1>
<p>WELCOME TO THE SECRET PAGE !!!.</p>
</body>
</html>