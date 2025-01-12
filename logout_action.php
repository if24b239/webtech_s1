<?php
session_start();
$_SESSION = [];
setcookie(session_name(), "", time() - 3600);
session_destroy();
session_write_close();


$_SESSION["logged_in"] = 0;

header("Location:index.php");
exit();

?>