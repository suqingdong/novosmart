<?php
session_start();

$_SESSION['username'] = NULL;
setcookie('username', '', time()-1, '/');

echo '<script>window.location.href="index.php";</script>';

?>

