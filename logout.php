<?php
session_start();
$_SESSION['loggedin']='f';
$_SESSION['admin']='f';
header('Location: users.php');
exit;
?>
