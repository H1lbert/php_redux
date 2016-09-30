<div class="menu">

<?php
$curpage = basename ($_SERVER['PHP_SELF']);
?>
<?php
//Nedenfor ses PHP funktionen som fortæller hvilken side man i øjeblikket befinder sig på.
$curpage = basename ($_SERVER['PHP_SELF']);
?>
<ul>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Her er curpage funktionen indsat i de forskellige subpages, for at fortælle webserveren hvilken side brugeren befinder sig på--->
    <li><a href="index.php"<?php if ($curpage =='index.php') { echo 'class="active"';} ?>>Home</a> </li>
   <li><a href="about.php" <?php if ($curpage =='about.php') { echo 'class="active"';} ?> >About</a> </li>
   <li><a href="howitworks.php" <?php if ($curpage =='howitworks.php') { echo 'class="active"';} ?> >How it works</a> </li>
</ul>
