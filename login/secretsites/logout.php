<?php
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
?>
<!--Her linkes der tilbage til login siden, samt sessionen bliver ødelagt-->
<meta http-equiv="refresh" content="0; url= http://localhost:8888/login/index.php" />





